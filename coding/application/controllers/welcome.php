<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Academic Free License version 3.0
 *
 * This source file is subject to the Academic Free License (AFL 3.0) that is
 * bundled with this package in the files license_afl.txt / license_afl.rst.
 * It is also available through the world wide web at this URL:
 * http://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)
 * @license		http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//echo date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 3, date('Y')));
		//die();
		//$this->load->view('welcome_message');
		
		
		
		/*
		$file = "http://codeigniter.com/user_guide/database/helpers.jpg";
		$file = pathinfo($file);
		print_r($file);
		echo '<br /><br />';
		$file = "user_guide/database/helpers.jpg";
		$file = pathinfo($file);
		print_r($file);
		 */
		 
		/* 
		$project_hashtags_text = 'bola, jersey, kompas';
		$project_hashtags_text = explode(",",$project_hashtags_text);
		$project_hashtags_text = array_map("trim", $project_hashtags_text);
		echo "#" . implode(" #", $project_hashtags_text);*/
		
		/*
		$data = (object) array(
			'name' => 'a',
			'detail' => 'b'
		);
		echo '<pre>';
		print_r($data);
		echo '</pre>';*/
		
		//$url = "http://www.example.com";
		//$this->load->library('validate');
		//$r = $this->validate->valid_url($url);
		//var_dump($r);

		//echo sha1(SALT . "5753");
		
		//$hash = "kjkw0738";
		//echo base_url() . 'auth/resetpassword?h=' . $hash . '&hs=' . sha1(SALT . $hash);
		
	}
	
	function test_invite(){
		//$this->load->model('invitation_model');
		//$return = $this->invitation_model->getInvitationByCustom("merchant");
		//echo '<pre>';
		//print_r($return);
		//echo '</pre>';
		$this->load->view('email/invoice_view');
		//var_dump( is_file('images/merchant/Email-Logo-activorm.png') );
	}
	
	function test_pdf(){
		$this->load->library('fpdf_library');
		$this->fpdf_library->fpdf = new FPDF('L', 'cm', array(29,29));
		$this->fpdf_library->fpdf->AddPage();
		
		// bg image
		$this->fpdf_library->fpdf->Image(cdn_url() . '/images/voucher/voucher_basic_edited.jpg', 0, 0);
		
		// nomor order
		$this->fpdf_library->fpdf->SetFont('Arial', 'I', 23); 
		$text = "XXXX0000"; 
		$this->fpdf_library->fpdf->Text(6, 2.45, $text); 
		
		$this->fpdf_library->fpdf->SetTextColor(52,73,93);
		$this->fpdf_library->fpdf->SetFont('helvetica', 'B', 50); 
		$text = "VOUCHER"; 
		$mid_x = 8.5; // the middle of the "PDF screen", fixed by now.
		$this->fpdf_library->fpdf->Text($mid_x - ($this->fpdf_library->fpdf->GetStringWidth($text) / 2), 6, $text); 
		
		$this->fpdf_library->fpdf->SetTextColor(52,73,93);
		$this->fpdf_library->fpdf->SetFont('helvetica', 'B', 40); 
		$text = "BUY 1 GET 1 FREE"; 
		$mid_x = 8.5; // the middle of the "PDF screen", fixed by now.
		$this->fpdf_library->fpdf->Text($mid_x - ($this->fpdf_library->fpdf->GetStringWidth($text) / 2), 8.3, $text);
		
		$this->fpdf_library->fpdf->SetTextColor(255,255,255);
		$this->fpdf_library->fpdf->SetFont('helvetica', '', 22); 
		$text = "31 Maret 2014"; 
		$this->fpdf_library->fpdf->Text(8.2, 12.4, $text); 
		
		$image_merchant = "images/merchant/email-logo-virginius-affair_185x90.png";
		$image_merchant = $this->mediamanager->getPhotoUrl($image_merchant, "100x100");
		$this->fpdf_library->fpdf->Image(cdn_url() . $image_merchant, 25, 1.6);
		
		$this->fpdf_library->fpdf->SetTextColor(0,0,0);
		$this->fpdf_library->fpdf->SetFont('helvetica', '', 17); 
		$text = "Lapaksquare"; 
		$this->fpdf_library->fpdf->Text(18.1, 7.6, $text); 
		
		$text = "www.lapaksquare.com"; 
		$this->fpdf_library->fpdf->Text(18.1, 8.8, $text); 
		
		$text = "Email: lapaksquare@gmail.com"; 
		$this->fpdf_library->fpdf->Text(18.1, 9.9, $text); 
		
		$text = "Phone: +62-821-6350-4980"; 
		$this->fpdf_library->fpdf->Text(18.1, 11.1, $text); 
		
		$this->fpdf_library->fpdf->SetTextColor(105,206,187);
		$this->fpdf_library->fpdf->SetFont('helvetica', 'U', 17); 
		$text = "winner@activorm.com"; 
		$this->fpdf_library->fpdf->Text(18.1, 14, $text); 
		
		$this->fpdf_library->fpdf->SetTextColor(152,153,153);
		$this->fpdf_library->fpdf->SetFont('helvetica', '', 12); 
		$text = "- Ongkos kirim ditanggung pemenang atau konfirmasi terlebih dahulu saat diambil dari kantor Activorm.\n- Voucher tidak dapat dipindah-tangankan.\n- Voucher hanya berlaku untuk satu kali request.\n- Voucher tidak berlaku untuk Reseller atau Dropship.
		"; 
		$this->fpdf_library->fpdf->SetLeftMargin(1.5);
		$this->fpdf_library->fpdf->SetXY(1.5, 16.5);
		$this->fpdf_library->WordWrap($text, 12);
		$this->fpdf_library->fpdf->Write(0.6, $text);
		
		$text = "- Informasikan pihak Kaos Loe nomor voucher untuk konfirmasi spesifikasi kaos pilihan.\n- Pilihan kaos dapat dilihat di album foto \nFacebook Fanpage KaosLoe : Ready to Print! KaosLoe
		"; 
		$this->fpdf_library->fpdf->SetLeftMargin(15.3);
		$this->fpdf_library->fpdf->SetXY(15.3, 16.5);
		$this->fpdf_library->WordWrap($text, 12);
		$this->fpdf_library->fpdf->Write(0.6, $text);
		
		$d = $this->input->get_post("d");
		$time = sha1(time().SALT);
		if (!empty($d)){
			$this->fpdf_library->fpdf->Output($time . ".pdf", "D");
		}else{
			$this->fpdf_library->fpdf->Output();
		}
	}
	
	function generate_link_vc(){
		$account_id = $this->input->get_post('account_id');
		$verify_code = $this->input->get_post('vc_code');
		echo base_url() . 'auth/vccode_next?acid=' . $account_id . '&vccode=' . $verify_code . '&h=' . sha1($account_id . $verify_code . SALT);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */