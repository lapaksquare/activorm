<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prize extends MY_Admin_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	var $offset = 10;
	
	function index(){
		
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$this->search_by = $this->input->get_post('search_by');
		$this->q = $this->input->get_post('q');
		$param_url = array(
			'search_by' => $this->search_by,
			'q' => $this->q,
			'page' => ''
		);
		
		$this->load->model('a_prize_model');
		$this->data['prizes'] = $this->a_prize_model->getPrizeProfile($param_url, $this->offset, 0, $page);
		
		$param_url = http_build_query($param_url);
		
		$uri_page = 'admin/prize/?'.$param_url;
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->a_prize_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);
		
		$this->data['menu'] = 'prize';
		$this->_default_param(
			"",
			"",
			"",
			"Prize - Activorm Connect");
		$this->load->view('n/prize/index_view', $this->data);
	}
	
	function prize_detail(){
		
		$prize_id = $this->input->get_post('prid');
		$project_id = $this->input->get_post('ppid');
		$h = $this->input->get_post('h');
		$h_ori = sha1($prize_id . $project_id . SALT);
		if ($h != $h_ori) redirect(base_url() . 'admin/prize');
		
		$this->load->model('a_prize_model');
		$this->data['business'] = $this->a_prize_model->getBusinessAll();
		$this->data['action_type'] = "update";
		
		$this->prize = $this->a_prize_model->getPrizeProfileSelected($prize_id, $project_id);
		
		$this->data['menu'] = 'prize';
		$this->_default_param(
			"",
			array(
				'<script src="'.cdn_url().'js/a_prize.js"></script>',
			),
			"",
			"Prize Details - Activorm Connect");
		$this->load->view('n/prize/prize_detail_view', $this->data);
	}
	
	function add_prize(){
		
		$this->load->model('a_prize_model');
		$this->data['business'] = $this->a_prize_model->getBusinessAll();
		$this->data['action_type'] = "add";
		
		$this->data['menu'] = 'prize';
		$this->_default_param(
			"",
			array(
				'<script src="'.cdn_url().'js/a_prize.js"></script>',
			),
			"",
			"Add Prize - Activorm Connect");
		$this->load->view('n/prize/prize_detail_view', $this->data);
	}
	
	function submit_prize(){
		$submit = $this->input->get_post('submit');
		
		$prize_name = $this->input->get_post('prize_name');
		$business_id = $this->input->get_post('business_id');
		$project_id = $this->input->get_post('project_id');
		$prize_active = $this->input->get_post('prize_active');
		$action_type = $this->input->get_post('action_type');
		$prize_status = $this->input->get_post('prize_status');
		
		$prid = $this->input->get_post('prid');
		$ppid = $this->input->get_post('ppid');
		$h = $this->input->get_post('h');
		$h_ori = sha1($prid . $ppid . SALT);
		if ($action_type == "update"){
			if ($h != $h_ori) redirect(base_url() . 'admin/prize');
		}
				
		if (!empty($submit)){
			
			$dataPrize = array();
			$this->load->model('a_prize_model');
			
			/*validasi ===== START*/
			$this->load->library('validate');
			$validatePrizeName = $this->validate->validateName($prize_name);
			$errors = array();
			if ($validatePrizeName == 1){
				$errors[] = 'Your name must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 4 characters.';
			} 
			$this->session->set_userdata('prize_name', $prize_name);
			
			$this->load->library('util');
			$prize_uri = $this->util->url_slug($prize_name);
			$this->load->model('prize_model');
			$prize = $this->prize_model->getPrizeProfileTaken('pp.prize_uri', $prize_uri, $prid);
			if (!empty($prize)){
				$errors[] = 'Your Business Name has been taken.';
			}
			
			$config['upload_path'] = './images/prize/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']	= '2024';
			$config['max_width']  = '1200';
			$config['max_height']  = '1200';
			$config['encrypt_name'] = true;
			
			$this->load->library('upload', $config);
			
			$uploaded = $this->upload->do_upload('prize_photo');
			$prize_primary_photo = "";
			if ($uploaded){
				//$error = $this->upload->display_errors();
				$data = $this->upload->data();
				//print_r($data);
				//print_r($error);
				
				$prize_primary_photo = 'images/prize/' . $data['file_name'];
				
				$dataPrize['prize_primary_photo'] = $prize_primary_photo;
				
				//$this->session->set_userdata('account_primary_photo', $account_primary_photo);
			}else{
				
				if (!empty($_FILES['prize_photo']['name'])){
					$errors[] = 'You have to upload a Profile Picture in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
					//echo '1';
				}
				//$errors[] = 'You have to upload a Project Image in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
				//echo '2';die();
			}
			
			if (count($errors) > 0){
				
				$this->session->set_userdata('a_message_error', $errors);
				
				if ($action_type == "add"){
					redirect(base_url() . 'admin/prize');
				}

				/**/
				//print_r($errors);die();
				
			}else{
				
				$dataPrize['prize_name'] = $prize_name;
				$dataPrize['prize_uri'] = $prize_uri;
				$dataPrize['isactive'] = $prize_active;
				$dataPrize['status'] = $prize_status;
				
				$prize_id = $this->a_prize_model->registerPrize($dataPrize, $prid);
				
				if (!empty($business_id) && !empty($project_id)){
					$this->a_prize_model->registerPrizeRelProject($prize_id, $project_id, $ppid);
				}
				
				$this->session->set_userdata('a_message_success', 1);
				
			}
			
			/*validasi ===== END*/
			
		}
		
		if ($action_type == "add"){
			redirect(base_url() . 'admin/prize');
		}else{
			redirect(base_url() . 'admin/prize/prize_detail?prid='.$prize_id.'&ppid='.$project_id.'&h=' . sha1($prize_id . $project_id . SALT));
		}
	}

	function deleteprize(){
		$this->load->model('a_prize_model');
		$prize_id = $this->input->get_post('p');
		$project_id = $this->input->get_post('pid');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($prize_id . $project_id . SALT);
		if ($hash != $hash_ori) redirect(base_url() . 'admin/prize');
		
		$dataPrize = array();
		$dataPrize['status'] = 'deleted';
		
		$prize_id = $this->a_prize_model->registerPrize($dataPrize, $prize_id);
		
		$this->session->set_userdata('msg_delete_prize', 1);
		
		redirect(base_url() . 'admin/prize/prize_detail?prid='.$prize_id.'&ppid='.$project_id.'&h=' . sha1($prize_id . $project_id . SALT));
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