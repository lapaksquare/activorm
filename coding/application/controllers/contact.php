<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->data['menu'] = 'contact';
		$css = array();
		$js = array(
			'<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>',
			'<script src="'.cdn_url().'js/initmap.min.js"></script>',
			'<script src="'.cdn_url().'js/contactus.js"></script>'
		);
		$meta = array();
		$title = 'Contact Us';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/contact/contactus_view', $this->data);
	}
	
	function submit_contactus(){
		$send_contact = $this->input->get_post('send_contact');
		if (!empty($send_contact)){
			$name = $this->input->get_post('name');
			$email = $this->input->get_post('email');
			$company = $this->input->get_post('company');
			$phone = $this->input->get_post('phone');
			$subject = $this->input->get_post('subject');
			$message = $this->input->get_post('message');
			
			$this->load->library('validate');
			$validateName = $this->validate->validateName($name);
			$validateEmail = $this->validate->validateEmail($email);
			$validateCompany = $this->validate->validateName($company);
			$validatePhone = preg_replace("/[^0-9]/", "", $phone);
			$validateSubject = $this->validate->validateName($subject);
			
			$this->session->set_userdata('cu_name', $name);
			$this->session->set_userdata('cu_email', $email);
			$this->session->set_userdata('cu_company', $company);
			$this->session->set_userdata('cu_phone', $phone);
			$this->session->set_userdata('cu_subject', $subject);
			$this->session->set_userdata('cu_message', $message);
			
			$errors = array();
			if ($validateName == 1){
				$errors[] = "Your name must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 4 characters.";
			}
			if ($validateEmail == 1){
				$errors[] = "Please insert the correct email.";
			}
			if ($validateCompany == 1){
				$errors[] = "Company Name must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 4 characters.";
			}
			if (empty($validatePhone)){
				$errors[] = "Phone Number consists of numbers only.";
			}
			if ($validateSubject == 1){
				$errors[] = "Message Subject must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 4 characters.";
			}
			if (strlen($message) <= 4){
				$errors[] = "Message must contain minimum 4 characters.";
			}
			
			if (count($errors) > 0){
				$this->session->set_userdata('msg_cu_errors', $errors);
			}else{
				
				$this->load->model('bug_model');
				
				$data = array(
					'contact_name' => $name,
					'contact_email' => $email,
					'contact_company' => $company,
					'contact_phone' => $phone,
					'contact_subject' => $subject,
					'contact_message' => $message				
				);
				$this->bug_model->registerContactUs($data);
				
				// sending email
				$this->sending_email($data);
				
				$this->session->set_userdata('msg_cu_success', 1);
				
			}
			
		}

		redirect(base_url() . 'contact');

	}
	
	function sending_email($data){
		// sending email
		require_once APPPATH.'libraries/swiftmailer/swift_required.php';
		$transport = Swift_MailTransport::newInstance();
		//Create the message
        $message = Swift_Message::newInstance();
		//Give the message a subject
		
		$email = "info@activorm.com";
				
		$tmpl = "contactus_view";		
		$data = $this->load->view('email/' . $tmpl, $data, true);
        $message->setSubject("Contact Us - Message")
                ->setFrom(array('info@activorm.com' => 'Activorm'))
                ->setTo($email)
                ->addPart($data, 'text/html')
        ;
		//Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);
        
        //Send the message
        $result = $mailer->send($message);
	}
	
	function _default_param($css = array(), $js = array(), $meta = array(), $title = ""){
		/*$default_css = array(
		);
		if (!empty($css)) $css = array_merge($default_css, $css);
		else $css = $default_css;*/
		//if (!empty($js)) $js = array_merge($default_js, $js);
		$this->default_param($css, $js, $meta, $title);
	}
	
}

?>