<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	var $segments;
	
	function index(){
		
		$view = '';
		$this->segments = $this->uri->segment_array();
		
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Blog';
		
		$this->data['menu'] = 'dashboard';
		
		if (!empty($this->segments[2]) && $this->segments[2] == "projects"){
			$title = 'Projects';
			$view = 'dashboard_projects_view';
			$this->data['menu'] = 'projects';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "pointstopup"){
			$title = 'Points &amp; Top Up';
			$view = 'dashboard_points_topup_view';
			$this->data['menu'] = 'points_topup';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "paymentconfirmation"){
			$title = 'Payment Confirmation';
			$view = 'dashboard_paymentconfirmation_view';
			$this->data['menu'] = 'payment_confirmation';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "paymenthistory"){
			$title = 'Payment History';
			$view = 'dashboard_paymenthistory_view';
			$this->data['menu'] = 'payment_history';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "demographic"){
			$view = 'dashboard_demographic_view';
			$js = array(
				'<script type="text/javascript" src="https://www.google.com/jsapi"></script>',
				'<script type="text/javascript" src="'.cdn_url().'js/dashboard_demographic.js"></script>'
			);
			$title = 'Demographic';
			$this->data['submenu'] = 'demographic';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "searchengine"){
			$view = 'dashboard_searchengine_view';
			$css = array(
				'<link href="'.cdn_url().'css/jquery.mCustomScrollbar.css" rel="stylesheet">'
			);
			$js = array(
				'<script src="'.cdn_url().'js/jquery.mCustomScrollbar.min.js"></script>',
				'<script src="'.cdn_url().'js/dashboard_searchengine.js"></script>'
			);
			$title = 'Search Engine';
			$this->data['submenu'] = 'searchengine';
		}else{
			$view = 'dashboard_view';
			$css = array(
				'<link href="'.cdn_url().'css/jquery.mCustomScrollbar.css" rel="stylesheet">'
			);
			$js = array(
				'<script type="text/javascript" src="https://www.google.com/jsapi"></script>',
				'<script src="'.cdn_url().'js/jquery.mCustomScrollbar.min.js"></script>',
				'<script src="'.cdn_url().'js/dashboard_overview.js"></script>'
			);
			$title = 'Overview';
			$this->data['submenu'] = 'overview';
		}
		
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/dashboard/' . $view, $this->data);
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