<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->data['menu'] = 'home';
		$css = array();
		$js = array(
			'<script src="'.cdn_url().'js/home.js"></script>'
		);
		$meta = array();
		$title = 'Home';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/home/home_view', $this->data);
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