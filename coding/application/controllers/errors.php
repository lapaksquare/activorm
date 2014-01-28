<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function errors404(){
		$this->data['menu'] = 'error_404';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Error 404';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('errors/404_view', $this->data);
	}
	
	function redirect(){
		$ref = $_SERVER['HTTP_REFERER'];
		//echo $ref;die();				
		if (empty($ref)){
			redirect(base_url());
		}else{
			redirect($ref);
		}
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