<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Planspricing extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->data['menu'] = 'planspricing';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Plans & Pricing';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/planspricing/planspricing_view', $this->data);
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