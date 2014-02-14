<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Admin{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$account = $this->session->userdata('account_admin');
		if (!empty($account)) redirect(base_url() . 'admin/home');
		
		$this->data['menu'] = 'login';
		$this->_default_param(
			"",
			"",
			"",
			"Login - Activorm Connect");
		$this->load->view('n/login/login_view', $this->data);
	}
	
	function logout(){
		$this->load->library('access');
		$this->access->remove_session_admin();
		redirect(base_url() . 'admin');
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