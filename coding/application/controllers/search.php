<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	var $offset = 10;
	function index(){
				
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$this->q = $this->input->get_post('q');
		$this->category = $this->input->get_post('category');
		
		$this->load->model('search_model');
		$param_url = array(
			'q' => $this->q,
			'category' => $this->category
		);
		
		//echo '<pre>';
		//print_r($this->category);
		//echo '</pre>'; //die();
		
		$search_data = $this->search_model->getSearch($param_url, 12);
		$this->data['search_data'] = $search_data;
		//echo '<pre>';
		//print_r($search_data);
		//echo '</pre>';die();
		
		$param_url = http_build_query($param_url);
		
		$uri_page = 'search?'. $param_url .'&page=';
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->search_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);
		
		$this->data['menu'] = 'search';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Search';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/search/search_view', $this->data);
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