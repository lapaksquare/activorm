<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	var $data = array();
	
	function index(){
		$this->load->view('email/email_view', $this->data);
	}
	function invoice(){
		$this->load->view('email/invoice_view', $this->data);
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