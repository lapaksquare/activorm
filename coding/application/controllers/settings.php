<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	var $segments;
	
	function index(){
		$this->data['menu'] = 'settings';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Tickets';
		
		$view = '';
		$this->segments = $this->uri->segment_array();
		
		if (!empty($this->segments[2]) && $this->segments[2] == "contact"){
			$title = 'Contact Information';
			$view = 'contact_information_view';
			$this->data['submenu'] = 'contact';
			$js = array(
				'<script src="'.cdn_url().'js/contact.edit.js"></script>'
			);
		}else if (!empty($this->segments[2]) && $this->segments[2] == "socialmedia"){
			$title = 'Social Media Connect';
			$view = 'socialmedia_view';
			$this->data['submenu'] = 'socialmedia';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "email"){
			$title = 'Email Preference';
			$view = 'email_preference_view';
			$this->data['submenu'] = 'email';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "password"){
			$title = 'Password';
			$view = 'password_view';
			$this->data['submenu'] = 'password';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "deleteaccount"){
			$title = 'Delete Account';
			$view = 'deleteaccount_view';
			$this->data['submenu'] = 'deleteaccount';
		}
		
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/settings/' . $view, $this->data);
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