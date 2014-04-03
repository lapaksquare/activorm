<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Sales_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
      $this->load->library('pchart');
      
      $this->pchart->ding();
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