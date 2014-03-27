<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Merchant extends MY_Controller{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		
		$this->load->model('business_model');
		
		$merchants = $this->cache->get('cache#merchants_page#');
		
		if (empty($merchants)){
			
			$merchants = $this->business_model->getAllMerchantByPhotoMerchant();

			$this->cache->write($merchants, 'cache#merchants_page#', 60 * 60 * 24);
			
		}
						
		$this->data['merchants'] = $merchants;
		
		$this->data['menu'] = 'merchant';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Merchant';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/merchant/merchant_view', $this->data);
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