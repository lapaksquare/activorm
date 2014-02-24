<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Interests extends MY_Admin_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	function interests_category(){
		
		$this->load->model('interests_model');
		
		$this->interests_category = $this->interests_model->getInterestsCategory();
		$this->parent_interests = $this->interests_model->getParentInterests();
		
		$css = $js = array();
		$js = array(
			'<script type="text/javascript" src="'.base_url().'js/a_member_interests.js"></script>'
		);
		$this->data['menu'] = 'interests';
		$this->data['menu_child'] = '';
		$this->_default_param(
			$css,
			$js,
			"",
			"Interests Category - Activorm Connect");
		$this->load->view('n/interests/interests_category_view', $this->data);
	}
	
	function interests_name(){
		
		$this->load->model('interests_model');
		
		$this->interests_name = $this->interests_model->getInterestsName();
		$this->parent_interests = $this->interests_model->getParentInterests();
		
		$css = $js = array();
		$js = array(
			'<script type="text/javascript" src="'.base_url().'js/a_member_interests.js"></script>'
		);
		$this->data['menu'] = 'interests';
		$this->data['menu_child'] = '';
		$this->_default_param(
			$css,
			$js,
			"",
			"Interests Category - Activorm Connect");
		$this->load->view('n/interests/interests_name_view', $this->data);
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