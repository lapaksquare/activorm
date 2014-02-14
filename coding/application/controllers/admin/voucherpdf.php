<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucherpdf extends MY_Admin_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	var $offset = 10;
	
	function index(){
		
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$param_url = array(
			'page' => ''
		);
		
		$this->load->model('voucherpdf_model');
		$this->vouchers = $this->voucherpdf_model->getVoucherPDFAll($param_url, $this->offset, 0, $page);
		
		$param_url = http_build_query($param_url);
		$uri_page = 'admin/voucherpdf/?'.$param_url;
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->voucherpdf_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);
		
		$this->data['menu'] = 'voucher_pdf';
		$this->_default_param(
			"",
			"",
			"",
			"Voucher PDF - Activorm Connect");
		$this->load->view('n/voucherpdf/index_view', $this->data);
	}
	
	function add_voucherpdf(){
		
		$this->load->model('a_featured_model');
		$this->business = $this->a_featured_model->getBusinessAll();
		
		$this->data['action_type'] = 'add';
		$this->data['menu'] = 'voucher_pdf';
		$this->_default_param(
			array(
				'<link rel="stylesheet" type="text/css" href="'.cdn_url().'css/bootstrap.datepicker.css" />'
			),
			array(
				'<script src="'.cdn_url().'js/jquery.editinplace.js"></script>',
				'<script src="'.cdn_url().'js/bootstrap.datepicker.js"></script>',
				'<script src="'.cdn_url().'js/a_voucherpdf.js"></script>',
			),
			"",
			"Add Voucher PDF - Activorm Connect");
		$this->load->view('n/voucherpdf/add_voucher_pdf_view', $this->data);
	}
	
	function details(){
		$vpid = $this->input->get_post('vpid');
		$h = $this->input->get_post('h');
		$h_ori = sha1($vpid . SALT);
		if ($h_ori != $h) redirect(base_url() . 'admin/voucherpdf/');
		$this->hash = $h_ori;
		
		$this->load->model('a_featured_model');
		$this->business = $this->a_featured_model->getBusinessAll();
		
		$this->load->model('voucherpdf_model');
		$this->voucher_data = $this->voucherpdf_model->getVoucherDataProfile($vpid);
		$this->merchant_data = json_decode($this->voucher_data->voucher_merchant_data);
		
		$this->projects = $this->a_featured_model->getProjectAll($this->voucher_data->business_id);
		
		$this->data['action_type'] = 'edit';
		$this->data['menu'] = 'voucher_pdf';
		$this->_default_param(
			array(
				'<link rel="stylesheet" type="text/css" href="'.cdn_url().'css/bootstrap.datepicker.css" />'
			),
			array(
				'<script src="'.cdn_url().'js/jquery.editinplace.js"></script>',
				'<script src="'.cdn_url().'js/bootstrap.datepicker.js"></script>',
				'<script src="'.cdn_url().'js/a_voucherpdf.js"></script>',
			),
			"",
			"Voucher PDF Details - Activorm Connect");
		$this->load->view('n/voucherpdf/add_voucher_pdf_view', $this->data);
	}
	
	function submit_voucherpdf(){
		$submit = $this->input->get_post('submit');
		$preview = $this->input->get_post('preview');
		
		/* VALIDASI ================= START ================= */
		$prize_name_line1 = $this->input->get_post('prize_name_line1');
		$prize_name_line2 = $this->input->get_post('prize_name_line2');
		$valid_until = $this->input->get_post('valid_until');
		$business_id = $this->input->get_post('business_id');
		$voucher_email = $this->input->get_post('voucher_email');
		$voucher_website = $this->input->get_post('voucher_website');
		$voucher_phone = $this->input->get_post('voucher_phone');
		$project_id = $this->input->get_post('project_id');
		$syarat_ketentuan = $this->input->get_post('syarat_ketentuan');
		$cara_penggunaan = $this->input->get_post('cara_penggunaan');
		
		$action_type = $this->input->get_post('action_type');
		$vid = $this->input->get_post('vid');
		$h = $this->input->get_post('h');
		/* VALIDASI ================= END   ================= */
		
		$errors = array();
		if (empty($prize_name_line1)){
			$errors[] = "Prize Name Line 1 is Empty";
		}
		if (empty($prize_name_line2)){
			$errors[] = "Prize Name Line 2 is Empty";
		}
		if (empty($valid_until)){
			$errors[] = "Valid Until is Empty";
		}
		if (empty($voucher_email)){
			$errors[] = "Voucher Email is Empty";
		}
		//if (empty($voucher_website)){
		//	$errors[] = "Voucher Website is Empty";
		//}
		if (empty($voucher_phone)){
			$errors[] = "Voucher Phone is Empty";
		}
		if (empty($syarat_ketentuan)){
			$errors[] = "Syarat & Ketentuan is Empty";
		}
		if (empty($cara_penggunaan)){
			$errors[] = "Cara Penggunaan is Empty";
		}
		if (empty($business_id)){
			$errors[] = "Pilihlah Business";
		}
		if (empty($project_id)){
			$errors[] = "Pilihlah Project";
		}
		
		if (count($errors) > 0){
			
			$this->session->set_userdata('a_message_error', $errors);
			
			if ($action_type == "add"){
				redirect(base_url() . 'admin/voucherpdf/add_voucherpdf');
			}else if ($action_type == "edit"){
				redirect(base_url() . 'admin/voucherpdf/details?vpid=' . $vid . '&h=' . $h);
			}
			
		}else{
			
			$this->load->model('a_featured_model');
			$ds = $this->a_featured_model->getFeaturedBusinessSelected($business_id);
			
			$this->data = array(
				'prize_name_line1' => $prize_name_line1,
				'prize_name_line2' => $prize_name_line2,
				'valid_until' => $valid_until,
				'valid_until_string' => date("d F Y", strtotime($valid_until)),
				'business_id' => $business_id,
				'voucher_email' => $voucher_email,
				'voucher_website' => $voucher_website,
				'voucher_phone' => $voucher_phone,
				'project_id' => $project_id,
				'syarat_ketentuan' => $syarat_ketentuan,
				'cara_penggunaan' => $cara_penggunaan,
				'merchant_logo' => $ds->merchant_logo,
				'business_name' => $ds->business_name,
				'no_voucher' => 'XXXX0000'
			);
			
			
			if (!empty($preview)){
			
				$this->load->library('fpdf_library');
				$this->fpdf_library->generatePDF($this->data);
				
			}else if (!empty($submit)){
				
				$voucher_merchant_data = array(
					'business_id' => $business_id,
					'voucher_email' => $voucher_email,
					'voucher_website' => $voucher_website,
					'voucher_phone' => $voucher_phone,
					'project_id' => $project_id,
					'merchant_logo' => $ds->merchant_logo,
					'business_name' => $ds->business_name,
				);
				$data = array(
					'voucher_price_line1' => $prize_name_line1,
					'voucher_price_line2' => $prize_name_line2,
					'valid_until' => $valid_until,
					'voucher_merchant_data' => json_encode($voucher_merchant_data),
					'business_id' => $business_id,
					'project_id' => $project_id,
					'syarat_dan_ketentuan' => $syarat_ketentuan,
					'cara_penggunaan' => $cara_penggunaan
				);
				$this->load->model('voucherpdf_model');
				$this->voucherpdf_model->registerVoucherPDF($data, $vid);
				
				$this->session->set_userdata('a_message_success', 1);
				
				redirect(base_url() . 'admin/voucherpdf/');
				
			}
				
		}
		
	}

	function details_see_pdf(){
		$vpid = $this->input->get_post('vpid');
		$h = $this->input->get_post('h');
		$h_ori = sha1($vpid . SALT);
		if ($h_ori != $h) redirect(base_url() . 'admin/voucherpdf/');
		
		$this->load->model('voucherpdf_model');
		$data = $this->voucherpdf_model->getVoucherDataProfile($vpid);
		
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
			'no_voucher' => 'XXXX0000'
		);
		
		$this->load->library('fpdf_library');
		$this->fpdf_library->generatePDF($data_pdf);
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