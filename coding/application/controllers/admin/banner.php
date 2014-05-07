<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Banner extends MY_Admin_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		
		$this->load->model('banner_model');
		$this->banners = $this->banner_model->getBannerList();
		
		$this->data['menu'] = 'banner';
		$this->data['menu_child'] = '';
		$this->_default_param(
			"",
			"",
			"",
			"Banner - Activorm Connect");
		$this->load->view('n/banner/index_view', $this->data);
	}
	
	function submit_upload_banner(){
		$banner_name = $this->input->get_post('banner_name');
		$banner_link = $this->input->get_post('banner_link');
		$banner_detail = $this->input->get_post('banner_detail');
		
		$dataBanner = array();
		
		$config['upload_path'] = './images/banner/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size']	= '2024';
		$config['max_width']  = '3000';
		$config['max_height']  = '3000';
		$config['encrypt_name'] = true;
		
		$this->load->library('upload', $config);
		
		$uploaded = $this->upload->do_upload('banner_image');
		$banner_image = "";
		if ($uploaded){
			
			$data = $this->upload->data();
			
			$banner_image = 'images/banner/' . $data['file_name'];
			
			$dataBanner['banner_image'] = $banner_image;
						
		}else{
			
			if (!empty($_FILES['banner_image']['name'])){
				$errors[] = 'You have to upload a Profile Picture in jpg/jpeg, gif, or png smaller than 2 MB';
			}
			
		}
		
		if (empty($banner_image)){
			$this->session->set_userdata('a_message_error', "Anda harus mengupload sebuah gambar.");
		}else{
			
			$dataBanner['banner_name'] = $banner_name;
			$dataBanner['banner_link'] = $banner_link;
			$dataBanner['banner_detail'] = $banner_detail;
			
			$this->load->model('banner_model');
			$this->banner_model->insertBanner($dataBanner);
			
		}
		
		redirect(base_url() . 'admin/banner');
		
	}

	function submit_summery_banner(){
		$this->load->model('banner_model');
		$banner_id = $this->input->get_post('banner_id');
		$banner_priority = $this->input->get_post('banner_priority');
		$isactive = $this->input->get_post('isactive');
		foreach($banner_id as $k=>$v){
			$data = array(
				'banner_priority' => $banner_priority[$v],
				'isactive' => $isactive[$v]
			);
			$where = array(
				'banner_id' => $v
			);
			$this->banner_model->updateBanner($data, $where);
		}
		redirect(base_url() . 'admin/banner');
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