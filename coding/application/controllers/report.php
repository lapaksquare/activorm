<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$account_id = $this->session->userdata('account_id');
		if (empty($account_id) || empty($this->access->member_account)) redirect(base_url());
	}
	
	function bug(){
		$this->data['menu'] = 'report_bug';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Bug Reports';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/report/report_bug_view', $this->data);
	}
	
	function submit_bug(){
		$submit_bug = $this->input->get_post('submit_bug');
		if (!empty($submit_bug)){
			$name = $this->input->get_post('name');
			$bug_type = $this->input->get_post('bug-type');
			$bug_url = $this->input->get_post('bug-url');
			$bug_message = $this->input->get_post('bug-message');
			$captcha = $this->input->get_post('captcha');
			
			$email = $this->access->member_account->account_email;
			$account_id = $this->access->member_account->account_id;
			
			$c_cap_code = $this->session->userdata('c_cap_code');
			
			if (empty($name) || empty($bug_type) || empty($bug_url) || empty($bug_message) || empty($captcha) || empty($email) || empty($account_id) || ($captcha != $c_cap_code) ){
				$this->session->set_userdata('message_report_bug', 1);
			}else{
			
				$this->load->model('bug_model');
				$data = array(
					'name' => $name,
					'bug_type' => $bug_type,
					'bug_url' => $bug_url,
					'bug_message' => $bug_message,
					'account_email' => $email,
					'account_id' => $account_id
				);
				$this->bug_model->registerBug($data);
				$this->sending_email($data);
				
				$this->session->set_userdata('message_report_bug', 2);
				
			}
		}
		redirect(base_url() . 'report/bug');
	}

	function sending_email($data){
		// sending email
		require_once APPPATH.'libraries/swiftmailer/swift_required.php';
		$transport = Swift_MailTransport::newInstance();
		//Create the message
        $message = Swift_Message::newInstance();
		//Give the message a subject
		
		$email = "info@activorm.com";
				
		$tmpl = "report_bug_view";		
		$data = $this->load->view('email/' . $tmpl, $data, true);
        $message->setSubject("Report Bug")
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