<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$business_view = '';
		$this->segments = $this->uri->segment_array();
		
		//print_r($this->segments);die();
		
		$css = array();
		$js = array();
		$meta = array();
		$title = ''; 
		$this->data['title'] = 'Business Profile';
		
		$this->load->model('business_model');
		$this->segments = $this->uri->segment_array();
		if (empty($this->segments) || empty($this->segments[1])) redirect(base_url() . '404');
		$this->business = $this->business_model->getBusinessProfile('bp.business_uri', $this->segments[1]);
		if (empty($this->business) || $this->business->business_live == 'Offline' || $this->business->business_active == 0) redirect(base_url() . '404');
		
		$this->business_overview();
		
		$business_view = 'business_profile_view';
		
		$this->data['menu'] = 'business';
		$this->_default_param($css, $js, $meta, $this->data['title']);
		$this->load->view('a/business/' . $business_view, $this->data);
	}
	
	var $offset = 10;
	function business_overview(){
		
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$this->load->model('project_model');
		$this->projects = $this->project_model->getProjectBusinessOnline($this->business->business_id, $limit = $this->offset, $start = 0, $page);
	
		$uri_page = $this->business->business_uri.'?page=';
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->project_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);
		
		// get social media account current
		$this->load->model('socialmedia_model');
		$this->data['socialmedia'] = $this->socialmedia_model->socialmedia_connect($this->business->account_id);
		
		// og meta
		$this->data['title'] = $this->business->business_name;
		$this->data['metaDescription'] = $this->business->business_description;
		$photos = $this->mediamanager->getPhotoUrl($this->business->account_primary_photo, "200x200");
		$this->data['metaImage'] = cdn_url() . $photos;
		
		// type
		$this->type = "business";
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