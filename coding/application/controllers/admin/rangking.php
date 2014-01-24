<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rangking extends MY_Admin_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->load->model('rangking_model');
		$this->results = $this->rangking_model->getRangkingMerchant();
		
		$this->data['menu'] = 'rangking';
		$this->_default_param(
			"",
			"",
			"",
			"Admin Login");
		$this->load->view('n/rangking/index_view', $this->data);
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