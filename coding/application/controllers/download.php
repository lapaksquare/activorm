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
		$voucher_id = $this->input->get_post('v');
		$hash = $this->input->get_post('h');
		
		if (empty($voucher_id)){
			$hash_ori = sha1($project_id.$account_id.SALT);
		}else{
			$hash_ori = sha1($project_id.$account_id.$voucher_id.SALT);
		}
		
		if ($hash != $hash_ori) redirect(base_url());		  
		
		$this->load->model('tiket_model');
		$tiket = $this->tiket_model->checkTiket($project_id, $account_id);
		if (empty($tiket)) redirect(base_url());		  
		
		if (empty($voucher_id)){
			
			$this->load->helper('download');
			
			//print_r($tiket);
			
			$pathinfo = pathinfo(cdn_url() . $tiket->voucher_data);
			
			//print_r($pathinfo);
			
			$data = file_get_contents(cdn_url() . $tiket->voucher_data); // Read the file's contents
			$name = $pathinfo['basename'];
			
			force_download($name, $data);
		}else{
			
			$this->load->model('voucherpdf_model');
			$data = $this->voucherpdf_model->getVoucherDataProfile($voucher_id);
			
			$merchant_data = json_decode($data->voucher_merchant_data);
			
			$data_pdf = array(
				'prize_name_line1' => $data->voucher_price_line1,
				'prize_name_line2' => $data->voucher_price_line2,
				'valid_until' => $data->valid_until,
				'valid_until_string' => date("d F Y", strtotime($data->valid_until)),
				'business_id' => $data->business_id,
				'voucher_email' => $merchant_data->voucher_email,
				'voucher_website' => $merchant_data->voucher_website,
				'voucher_phone' => $merchant_data->voucher_phone,
				'project_id' => $data->project_id,
				'syarat_ketentuan' => $data->syarat_dan_ketentuan,
				'cara_penggunaan' => $data->cara_penggunaan,
				'merchant_logo' => $merchant_data->merchant_logo,
				'business_name' => $merchant_data->business_name,
				'no_voucher' => $tiket->tiket_barcode
			);
			
			$this->load->library('fpdf_library');
			$this->fpdf_library->generatePDF($data_pdf, 1);
			
		}
	}
	
}

?>