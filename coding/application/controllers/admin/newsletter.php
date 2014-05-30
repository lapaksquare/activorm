<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends MY_Admin_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	var $offset = 10;
	
	function index(){
		
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$param_url = array(
			'page' => ''
		);
		
		$this->load->model('newsletter_model');
		$this->newsletters = $this->newsletter_model->getNewsletterData($param_url, $this->offset, 0, $page);
		
		$param_url = http_build_query($param_url);
		
		$uri_page = 'admin/newsletter?'.$param_url;
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->newsletter_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);
		
		$this->data['menu'] = 'newsletter';
		$this->data['menu_child'] = '';
		$this->_default_param(
			"",
			"",
			"",
			"Newsletter - Activorm Connect");
		$this->load->view('n/newsletter/index_view', $this->data);
	}
	
	function add_newsletter(){
		
		$this->form_type = "add";
			
		$this->data['menu'] = 'newsletter';
		$this->data['menu_child'] = '';
		$this->_default_param(
			array(
				'<link rel="stylesheet" type="text/css" href="'.cdn_url().'css/bootstrap.datepicker.css" />'
			),
			array(
				'<script src="'.cdn_url().'js/jquery.simplyCountable.js"></script>',
				'<script src="'.cdn_url().'js/jquery.editinplace.js"></script>',
				'<script src="'.cdn_url().'js/bootstrap.datepicker.js"></script>',
				'<script src="'.cdn_url().'js/a_newsletter.js"></script>',
			),
			"",
			"Add Newsletter - Activorm Connect");
		$this->load->view('n/newsletter/newsletter_detail_view', $this->data);
	}
	
	function details(){
		
		$newsletter_id = $this->input->get_post('nid');
		$hash = $this->input->get_post('nidh');
		$hash_ori = sha1($newsletter_id . SALT);
		if ($hash != $hash_ori) redirect(base_url() . 'admin/newsletter');
		
		$this->load->model('newsletter_model');
		$this->newsletter = $this->newsletter_model->getNewsletterDataByNewsletterId($newsletter_id);
		
		$this->form_type = "edit";
			
		$this->data['menu'] = 'newsletter';
		$this->data['menu_child'] = '';
		$this->_default_param(
			array(
				'<link rel="stylesheet" type="text/css" href="'.cdn_url().'css/bootstrap.datepicker.css" />'
			),
			array(
				'<script src="'.cdn_url().'js/jquery.editinplace.js"></script>',
				'<script src="'.cdn_url().'js/bootstrap.datepicker.js"></script>',
				'<script src="'.cdn_url().'js/a_newsletter.js"></script>',
			),
			"",
			"Add Newsletter Detail - Activorm Connect");
		$this->load->view('n/newsletter/newsletter_detail_view', $this->data);
		
	}
	
	function preview(){
		
		$newsletter_id = $this->input->get_post('nid');
		$hash = $this->input->get_post('nidh');
		$hash_ori = sha1($newsletter_id . SALT);
		if ($hash != $hash_ori) redirect(base_url() . 'admin/newsletter');
		
		$this->load->model('newsletter_model');
		$this->newsletter = $this->newsletter_model->getNewsletterDataByNewsletterId($newsletter_id);
		
		$link_back = base_url() . 'admin/newsletter/details?nid='.$newsletter_id.'&nidh='.sha1($newsletter_id . SALT);
		echo '<a href="'.$link_back.'"><< Back to Newsletter Dashboard</a>';
		
		if (!empty($this->newsletter)){
			echo $this->newsletter->newsletter_body;
		}
		
	}
	
	function submit_newsletter(){
		$submit = $this->input->get_post('submit');
		$preview = $this->input->get_post('preview');
		$newsletter_id = $this->input->get_post('newsletter_id');
		$hash = sha1($newsletter_id . SALT);
		$form_type = $this->input->get_post('form_type');
		
		if (!empty($submit) || !empty($preview)){
			
			$newsletter_target = $this->input->get_post('newsletter_target');
			$testing_email_input = $this->input->get_post('testing_email_input');
			$newsletter_subject = $this->input->get_post('newsletter_subject');
			$newsletter_body = $this->input->get_post('newsletter_body');
			$newsletter_date = $this->input->get_post('newsletter_date');
			$status = $this->input->get_post('status');
			
			$this->load->model('newsletter_model');
			$this->load->library('validate');
			
			if (!empty($preview)){
				$status = 'Offline';
			}
			
			$errors = array();
			
			if ($newsletter_target == "testing"){
				//$validateEmail = $this->validate->validateEmail($testing_email_input);
				//if ($validateEmail == 1) {
				//	$errors[] = "Newsletter Email tidak boleh kosong";
				//}
				if (empty($testing_email_input)){
					$errors[] = "Newsletter Email tidak boleh kosong";
				}
			}
			if (empty($newsletter_subject)){
				$errors[] = "Newsletter Subject tidak boleh kosong";
			}
			if (empty($newsletter_body)){
				$errors[] = "Newsletter Body tidak boleh kosong";
			}
			
			if (count($errors) > 0){
				
				$this->session->set_userdata('a_message_error', $errors);
				
				if (!empty($newsletter_id)){
					redirect(base_url() . 'admin/newsletter/details?nid='.$newsletter_id.'&nidh='.sha1($newsletter_id . SALT));
				}else{
					redirect(base_url() . 'admin/newsletter/add_newsletter');	
				}
				
			}else{

				$data = array(
					'newsletter_subject' => $newsletter_subject,
					'newsletter_body' => $newsletter_body,
					'newsletter_target' => $newsletter_target,
					'newsletter_testing_email' => $testing_email_input,
					'newsletter_sending_schedule' => $newsletter_date,
					'status' => $status
				);
				
				$newsletter_id = $this->newsletter_model->registerNewsletter($data, $newsletter_id);
				
				if ($newsletter_target == "testing"){
					//$emails = array();
					$testing_email_input = explode(",", $testing_email_input);
					foreach($testing_email_input as $k=>$v){
						$emails = trim($v);
						$data = array(
							'subject_email' => $newsletter_subject,
							'email' => $emails
						);
						$this->sending_email($data, $newsletter_body);	
					}
				}
				
				$this->session->set_userdata('a_message_success', 1);
				
			}
			
		}
		//if (!empty($submit)){
		//	redirect(base_url() . 'admin/newsletter/add_newsletter');
		//}else if (!empty($preview)){
		//	redirect(base_url() . 'admin/newsletter/details?nid='.$newsletter_id.'&nidh='.sha1($newsletter_id . SALT));
		//}
		
		if (!empty($preview)){
			redirect(base_url() . 'admin/newsletter/preview?nid='.$newsletter_id.'&nidh='.sha1($newsletter_id . SALT));
		}else{
			redirect(base_url() . 'admin/newsletter/details?nid='.$newsletter_id.'&nidh='.sha1($newsletter_id . SALT));
		}
	}
	
	function sending_email($data, $tmpl = "invitation_email_view"){
		// sending email
		require_once APPPATH.'libraries/swiftmailer/swift_required.php';
		$transport = Swift_MailTransport::newInstance();
		//Create the message
        $message = Swift_Message::newInstance();
		//Give the message a subject
		
		$email = $data['email'];
		$subject = $data['subject_email'];
								
		$data = $tmpl; //$this->load->view('email/' . $tmpl, $data, true);
        $message->setSubject($subject)
                ->setFrom(array('info@activorm.com' => 'Activorm'))
                ->setTo($email)
                ->addPart($data, 'text/html')
        ;
		//Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);
        
        //Send the message
        $result = $mailer->send($message);
	}

	function remove(){
		$newsletter_id = $this->input->get_post('nid');
		$hash = $this->input->get_post('nidh');
		$hash_ori = sha1($newsletter_id . SALT);
		if ($hash != $hash_ori) redirect(base_url() . 'admin/newsletter');
		
		$this->load->model('newsletter_model');
		$this->newsletter_model->removeNewsletter($newsletter_id);
		
		redirect(base_url() . 'admin/newsletter');
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