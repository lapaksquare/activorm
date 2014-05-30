<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Deals extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		
		$this->load->model('banner_model');
		$this->banners = $this->banner_model->getBannerActive();
		
		$this->data['menu'] = 'deals';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Deals';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/deals/deals_view', $this->data);
	}
	
	function deals_single(){

		$this->data['menu'] = 'deals_single';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Deals';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/deals/deals_single_view', $this->data);
	}
	
	function data_confirm(){

		$this->data['menu'] = 'data_confirm';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Data Confirm';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/deals/data_confirm_view', $this->data);
	}
	
	function data_confirm_transfer(){

		$this->data['menu'] = 'data_transfer';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Data Transfer';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/deals/data_transfer_view', $this->data);
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