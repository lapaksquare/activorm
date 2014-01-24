<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	var $data = array();
	
	function index(){
		$this->load->view('email/email_activation_account_view', $this->data);
	}
	function invoice(){
		$this->load->view('email/invoice_view', $this->data);
	}
	
	function sending_email(){
		// sending email
		require_once APPPATH.'libraries/swiftmailer/swift_required.php';
		$transport = Swift_MailTransport::newInstance();
		//Create the message
        $message = Swift_Message::newInstance();
		//Give the message a subject
		
		$email = 'junaidyanton@hotmail.com';
				
		$data = $this->load->view('email/email_activation_account_view', array(
			'verification_code' => 'XXOO',
			'account_name' => 'Anton Junaidi'
		), true);
        $message->setSubject("Account Verification")
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