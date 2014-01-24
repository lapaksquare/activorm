<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Featured extends MY_Admin_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->prize_homepage();
	}
	
	function prize_homepage(){
		
		$this->load->model('a_featured_model');
		
		$this->data['business'] = $this->a_featured_model->getBusinessAll();
		$this->data['prizes'] = $this->a_featured_model->getPrizeAll();
		
		$data_featured = $this->a_featured_model->getFeaturedHomePagePrize();
		$data_isi = array();
		if (!empty($data_featured)){
			$data_featured = json_decode($data_featured);
			/*echo '<pre>';
			print_r($data_featured);
			echo '</pre>';*/
			if (property_exists($data_featured, "isi") && property_exists($data_featured, "model")){
				if ($data_featured->model == "project"){
					foreach($data_featured->isi as $k=>$v){
						$ds = $this->a_featured_model->getFeaturedProductSelected($v->business_id, $v->project_id);
						$data_isi[] = $ds;
					}
				}else if ($data_featured->model == "prize"){
					foreach($data_featured->isi as $k=>$v){
						$ds = $this->a_featured_model->getFeaturedPrizeSelected($v);
						$data_isi[] = $ds;
					}
				}
			}
			/*
			echo '<pre>';
			print_r($data_isi);
			echo '</pre>';*/
		}
		$this->data['data_featured'] = $data_featured;
		$this->data['data_isi'] = $data_isi;
		
		$this->data['menu'] = 'featured';
		$this->data['menu_child'] = 'prize_homepage';
		$this->_default_param(
			"",
			array(
				'<script src="'.cdn_url().'js/a_featured_prize.js"></script>',
			),
			"",
			"Admin Login");
		$this->load->view('n/featured/prize_homepage_view', $this->data);
	}
	
	function submit_prize_homepage(){
		$update = $this->input->get_post('update');
		
		$type = $this->input->get_post('type');
		$model = $this->input->get_post('model');
		
		$bn = $this->input->get_post('bn');
		$pt = $this->input->get_post('pt');
		$pn = $this->input->get_post('pn');
		
		if (!empty($update)){
			
			$this->load->model('a_featured_model');
			
			if (empty($type) || empty($model)){
				$this->session->set_userdata('a_message_error', 'Failed Saved');
			}else{
				
				$return_isi = array();
				$jml = 0;
				if ($model == "project"){
					foreach($bn as $k=>$v){
						if ($v == 0 || $pt[$k] == 0) continue;
						$return_isi[] = array(
							'business_id' => $v,
							'project_id' => $pt[$k]
						);
						$jml++;
					}
				}else if ($model == "prize"){
					foreach($pn as $k=>$v){
						if ($v == 0) continue;
						$return_isi[] = $v;
						$jml++;
					}
				}
				
				if ($jml == 0){
					$r = $this->a_featured_model->getFeaturedHomePagePrize();
					if (!empty($r)){
						$r = json_decode($r);
						if (!empty($r) && property_exists($r, "isi") && $r->model == $model){
							$isi = $r->isi;
							$return_isi = $isi;
						}
					}
				}
				
				$return = array(
					'type' => $type,
					'model' => $model,
					'isi' => $return_isi
				);				
				
				/*
				echo '<pre>';
				print_r($return);
				echo '</pre>';
				
				die();
				*/
				
				$return = json_encode($return);
				
				$this->a_featured_model->registerFeaturedHomePagePrize($return);
				
				$this->session->set_userdata('a_message_success', 'Successfully Saved');
				
			}
			
		}
		redirect(base_url() . 'admin/featured/prize_homepage');
	}

	function logo_homepage(){
		
		$this->load->model('a_featured_model');
		
		$this->data['business'] = $this->a_featured_model->getBusinessAll();
		
		$data_featured = $this->a_featured_model->getFeaturedHomePageLogo();
		$data_isi = array();
		if (!empty($data_featured)){
			$data_featured = json_decode($data_featured);
			/*echo '<pre>';
			print_r($data_featured);
			echo '</pre>';*/
			if (property_exists($data_featured, "isi")){
				foreach($data_featured->isi as $k=>$v){
					$ds = $this->a_featured_model->getFeaturedBusinessSelected($v);
					$data_isi[] = $ds;
				}
			}
			/*
			echo '<pre>';
			print_r($data_isi);
			echo '</pre>';*/
		}
		$this->data['data_featured'] = $data_featured;
		$this->data['data_isi'] = $data_isi;
		
		$this->data['menu'] = 'featured';
		$this->data['menu_child'] = 'logo_homepage';
		$this->_default_param(
			"",
			array(
				'<script type="text/javascript" src="'.cdn_url().'js/a_featured_logo.js"></script>'
			),
			"",
			"Admin Login");
		$this->load->view('n/featured/logo_homepage_view', $this->data);
	}
	
	function submit_logo_homepage(){
		$update = $this->input->get_post('update');
		
		$type = $this->input->get_post('type');
		
		$bn = $this->input->get_post('bn');
		
		if (!empty($update)){
			$this->load->model('a_featured_model');
			
			if (empty($type) || empty($bn)){
				$this->session->set_userdata('a_message_error', 'Failed Saved');
			}else{
				
				$return_isi = array();
				$jml = 0;
				foreach($bn as $k=>$v){
					if ($v == 0) continue;
					$return_isi[] = $v;
					$jml++;
				}
				
				if ($jml == 0){
					$r = $this->a_featured_model->getFeaturedHomePageLogo();
					if (!empty($r)){
						$r = json_decode($r);
						if (!empty($r) && property_exists($r, "isi")){
							$isi = $r->isi;
							$return_isi = $isi;
						}
					}
				}
				
				$return = array(
					'type' => $type,
					'isi' => $return_isi
				);	
				
				$return = json_encode($return);
				
				$this->a_featured_model->registerFeaturedHomePageLogo($return);
				
				$this->session->set_userdata('a_message_success', 'Successfully Saved');			
					
			}
			
		}
		
		redirect(base_url() . 'admin/featured/logo_homepage');
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