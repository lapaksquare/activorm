<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	var $segments;
	
	function index(){
		
		$this->segments = $this->uri->segment_array();
		$this->data['menu'] = 'project';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Project';
		
		if (!empty($this->segments[2]) && $this->segments[2] == "create"){
			$title = 'Create Project';
			$view = 'project_create_view';
			$this->data['submenu'] = 'create';
			
			$css = array(
				'<link href="css/jquery.tagbox.css" rel="stylesheet">'
			);
			$js = array(
				'<script src="'.cdn_url().'js/bootstrap-slider.min.js"></script>',
				'<script src="'.cdn_url().'js/jquery.simplyCountable.js"></script>',
				'<script src="'.cdn_url().'js/jquery.tagbox.js"></script>',
				'<script src="'.cdn_url().'js/jquery.cookie.js"></script>',
				'<script src="'.cdn_url().'js/project.create.js"></script>',
				'<script src="'.cdn_url().'js/create_project.js"></script>'
			);
		}else if (!empty($this->segments[2]) && $this->segments[2] == "details"){
			$title = 'Project Details';
			$view = 'project_details_view';
			$this->data['submenu'] = 'details';
			
			$js = array(
				'<script src="'.cdn_url().'js/jquery.sharrre-1.3.4.min.js"></script>',
				'<script src="'.cdn_url().'js/project_details.js"></script>'
			);
		}else if (!empty($this->segments[2]) && $this->segments[2] == "pricing"){
			$title = 'Pricing';
			$view = 'project_pricing_view';
			$this->data['submenu'] = 'pricing';
			
			$js = array(
				'<script src="'.cdn_url().'js/bootstrap-slider.min.js"></script>',
				'<script src="'.cdn_url().'js/jquery.cookie.js"></script>',
				'<script src="'.cdn_url().'js/project_pricing.js"></script>'
			);
		}else if (!empty($this->segments[2]) && $this->segments[2] == "grid"){
			$title = 'Projects Grid';
			$view = 'project_grid_view';
			$this->data['submenu'] = 'grid';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "list"){
			$title = 'Projects List';
			$view = 'project_list_view';
			$this->data['submenu'] = 'list';
		}
		
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/project/' . $view, $this->data);
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