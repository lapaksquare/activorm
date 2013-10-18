<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	var $segments;
	
	function index(){
		$business_view = '';
		$this->segments = $this->uri->segment_array();
		
		//print_r($this->segments);die();
		
		$css = array();
		$js = array();
		$meta = array();
		$title = '';
		
		if (!empty($this->segments[2]) && $this->segments[2] == 'profile'){
			$title = 'Business Profile';
			$business_view = 'business_profile_view';
		}else if (!empty($this->segments[2]) && $this->segments[2] == 'register'){
			$title = 'Register';
			$business_view = 'business_register_view';
			$js = array(
				'<script src="'.cdn_url().'js/business_register.js"></script>'
			);
		}else{
			$title = 'Business';
			$business_view = 'business_view';
		}
		
		$this->data['menu'] = 'business';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/business/' . $business_view, $this->data);
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