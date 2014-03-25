<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->library('scache');
	}
	
	function index(){
		
		//$product_prize = $this->scache->read('cache#product_prize#');
		//$featured_type = $this->scache->read('cache#featured_type#');
		$product_prize = $this->cache->get('cache#product_prize#');
		$featured_type = $this->cache->get('cache#featured_type#');
		
		$this->load->model('featured_model');
		
		if (empty($product_prize)){
			$data_featured = $this->featured_model->getFeaturedData('featured__homepage_prize');
			$product_prize = array();
			if (!empty($data_featured)){
				
				if ($data_featured->type == "manual"){
					
					if ($data_featured->model == "project"){
						
						$data_featured_isi = array();
						foreach($data_featured->isi as $k=>$v){
							$data_featured_isi[] = $v->project_id;
						}
						
						$product_prize = $this->featured_model->getFeaturedProductHomePage($data_featured_isi, $data_featured->model);
						$featured_type = 1;
						
					}
					
				}
				
			}
			
			if (empty($product_prize)){
				$this->load->model('prize_model');
				$product_prize = $this->prize_model->getProductPrize(16);
				$featured_type = 3;
			}
			
			//$product_prize = json_encode( $product_prize );
			//$this->scache->write('cache#product_prize#', $product_prize, 60 * 60 * 24);
			//$this->scache->write('cache#featured_type#', $featured_type, 60 * 60 * 24);
			$this->cache->write($product_prize, 'cache#product_prize#', 60 * 60 * 24);
			$this->cache->write($featured_type, 'cache#featured_type#', 60 * 60 * 24);
			
		}
				
		//$product_prize = json_decode($product_prize);			
		$this->data['product_prize'] = $product_prize;
		$this->data['featured_type'] = $featured_type;
		
		$this->load->model('business_model');
		
		//$merchants = $this->scache->read('cache#merchants#');
		$merchants = $this->cache->get('cache#merchants#');
		
		if (empty($merchants)){
			$data_featured = $this->featured_model->getFeaturedData('featured__homepage_logomerchant');
			$merchants = array();
			if (!empty($data_featured)){
				if ($data_featured->type == "manual"){
					$data_featured_isi = array();
					foreach($data_featured->isi as $k=>$v){
						$data_featured_isi[] = $v;
					}
					$merchants = $this->featured_model->getMerchantLogoHomePage($data_featured_isi);
				}
			}
			if (empty($merchants)){
				$merchants = $this->business_model->getMerchantHomePage();
			}
			
			//$merchants = json_encode( $merchants );
			//$this->scache->write('cache#merchants#', $merchants, 60 * 60 * 24);
			$this->cache->write($merchants, 'cache#merchants#', 60 * 60 * 24);
			
		}
		
		//$merchants = json_decode($merchants);		
				
		$this->data['merchants'] = $merchants;
		
		$this->data['menu'] = 'home';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Home';
		$this->_default_param($css, $js, $meta, $title);
		//$this->load->view('a/home/home_invitation_view', $this->data);
		$this->load->view('a/home/home_view', $this->data);
	}
	
	function invitation(){
		
		$account_id = $this->session->userdata('account_id');
		$register_temp = $this->session->userdata('register_temp');
		$invitation_only = $this->session->userdata('invitation_only');
		if (!empty($account_id) || !empty($register_temp) || !empty($invitation_only)) redirect(base_url() . 'home');
		
		$this->data['menu'] = 'home';
		$css = array(
			'<link rel="stylesheet" type="text/css" href="'.cdn_url().'css/home_invitation.css" />'
		);
		$js = array();
		$meta = array();
		$title = 'Home';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/home/home_invitation_view', $this->data);
		//$this->load->view('a/home/home_view', $this->data);
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