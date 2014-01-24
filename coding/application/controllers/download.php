<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$account_id = $this->session->userdata('account_id');
		if (empty($account_id)) redirect(base_url());		  
	}
	
	function index(){
		$project_id = $this->input->get_post('p');
		$account_id = $this->input->get_post('a');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($project_id.$account_id.SALT);
				
		if ($hash != $hash_ori) redirect(base_url());		  
		
		$this->load->model('tiket_model');
		$tiket = $this->tiket_model->checkTiket($project_id, $account_id);
		
		if (empty($tiket)) redirect(base_url());		  
		
		$this->load->helper('download');
		
		//print_r($tiket);
		
		$pathinfo = pathinfo(cdn_url() . $tiket->project_file_data);
		
		//print_r($pathinfo);
		
		$data = file_get_contents(cdn_url() . $tiket->project_file_data); // Read the file's contents
		$name = $pathinfo['basename'];
		
		force_download($name, $data);
	}	 
	
	function claim_tiket(){
		$project_id = $this->input->get_post('p');
		$account_id = $this->input->get_post('a');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($project_id.$account_id.SALT);
				
		if ($hash != $hash_ori) redirect(base_url());		  
		
		$this->load->model('tiket_model');
		$tiket = $this->tiket_model->checkTiket($project_id, $account_id);
		
		if (empty($tiket)) redirect(base_url());		  
		
		$this->load->helper('download');
		
		//print_r($tiket);
		
		$pathinfo = pathinfo(cdn_url() . $tiket->voucher_data);
		
		//print_r($pathinfo);
		
		$data = file_get_contents(cdn_url() . $tiket->voucher_data); // Read the file's contents
		$name = $pathinfo['basename'];
		
		force_download($name, $data);
	}
	
}

?>