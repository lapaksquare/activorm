<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Prize extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	var $offset = 12;
	function index(){
		
		$this->segments = $this->uri->segment_array();
		
		$css = array();
		$js = array();
		$meta = array();
		
		if (!empty($this->segments[2])){
			$this->prize_detail_overview();
			$view = 'prize_detail_view';
		}else{
			$this->prize_overview();
			$view = 'prize_view';
			$js = array(
				'<script type="text/javascript" src="'.cdn_url().'js/prize_landingpage.js"></script>'
			);
		}
		
		$this->data['menu'] = 'prize';
		$title = 'Prize';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/prize/' . $view, $this->data);
	}
	
	function prize_overview(){
		$this->load->model('prize_model');
		
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		$this->project_live = $this->input->get_post('pl');
		$this->project_live = (empty($this->project_live)) ? 'Online' : $this->project_live;
		
		$param_url = array(
			'pl' => $this->project_live,
			'page' => ''
		);
		$param_url = http_build_query($param_url);
		
		$this->data['product_prize'] = $this->prize_model->getProductPrize(16, 0, $page, FALSE, $this->project_live);
		
		$uri_page = 'prize?' . $param_url;
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->prize_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			16, 
			1, 
			base_url(), 
			$uri_page
		);
	}
	
	function prize_detail_overview(){
		$this->load->model('prize_model');
		$this->prize_profile = $this->prize_model->getPrizeProfile($this->segments[2]);
		if (empty($this->prize_profile)) redirect(base_url() . '404');
		
		$view_type_session = $this->session->userdata('view_type_session');
		$view_type = (empty($view_type_session)) ? 'list' : $view_type_session;
		$this->data['view_type'] = $view_type;
		
		$this->project_prize = $this->prize_model->getProductPrizeRel($this->prize_profile->prize_id, 12);
		
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$uri_page = 'prize?page=';
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->prize_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			12, 
			1, 
			base_url(), 
			$uri_page
		);
		
		// analytic
		$this->project_analytic($this->prize_profile->prize_id);
		
		//echo '<pre>';
		//print_r($this->project_prize);
		//echo '</pre>';
	}
	
	function project_analytic($prize_id){
		// masuk ke prize click
		//echo 'prize click';
		$this->load->model('project_analytic_model');
		$this->project_analytic_model->prize_click($prize_id);
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