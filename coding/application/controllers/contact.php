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