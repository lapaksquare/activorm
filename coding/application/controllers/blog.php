<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	var $segments;
	
	function index(){
		
		$view = '';
		$this->segments = $this->uri->segment_array();
		
		if (empty($this->segments[2])){
			$view = 'blog_view';
		}else{
			$view = 'blog_detail_view';
		}
		
		$this->data['menu'] = 'blog';
		$css = array();
		$js = array(
			'<script src="'.cdn_url().'js/jquery.sharrre-1.3.4.min.js"></script>',
			'<script src="'.cdn_url().'js/blog_share.js"></script>'
		);
		$meta = array();
		$title = 'Blog';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/blog/' . $view, $this->data);
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