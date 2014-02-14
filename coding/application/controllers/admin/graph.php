<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Graph extends MY_Admin_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		
		$this->load->model('a_graph_model');
		$this->load->model('socialmedia_model');
		
		$startdate = $this->input->get_post('s');
		$enddate = $this->input->get_post('e');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($startdate.$enddate.SALT);
		if (empty($startdate) || empty($enddate) || empty($hash) || $hash != $hash_ori){
			$startdate = date("Y-m-d", strtotime("- 7 days"));
			$enddate = date("Y-m-d", strtotime("- 1 days"));
		}
		$this->keyal = "s=" . $startdate . "&e=" . $enddate . "&h=" . $hash;
		
		$this->graph_signup = $this->a_graph_model->getTrafficGraphSignUp($startdate, $enddate);
		//$this->graph_signin = $this->a_graph_model->getTrafficGraphSignIn($startdate, $enddate);
		$this->avg_jml_project = $this->a_graph_model->getAVGJmlProjectDiIkutiUser();
		$this->top3_user_active = $this->a_graph_model->getTop3UserActiveKontestProject();
		
		$css = $js = array();
		$js = array(
			'<script type="text/javascript" src="https://www.google.com/jsapi"></script>',
			'<script src="'.cdn_url().'js/a_graph_overview.js"></script>'
		);
		$this->data['menu'] = 'graph';
		$this->data['menu_child'] = '';
		$this->_default_param(
			$css,
			$js,
			"",
			"Admin Login");
		$this->load->view('n/graph/graph_view', $this->data);
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