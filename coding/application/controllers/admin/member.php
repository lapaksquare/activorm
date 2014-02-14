<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Admin_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->member_account();
	}
	
	var $offset = 10;
	
	/**** MEMBER ACCOUNT - START ****/
	
	function member_account(){
		
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$this->search_by = $this->input->get_post('search_by');
		$this->q = $this->input->get_post('q');
		$param_url = array(
			'search_by' => $this->search_by,
			'q' => $this->q,
			'page' => ''
		);
		
		$this->load->model('a_account_model');
		$this->data['members'] = $this->a_account_model->getMembers($account_type = "user", $param_url, $this->offset, 0, $page);
		
		$param_url = http_build_query($param_url);
		
		$uri_page = 'admin/member/member_account?'.$param_url;
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->a_account_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);
		
		$this->data['menu'] = 'account';
		$this->data['menu_child'] = 'member_account';
		$this->_default_param(
			"",
			"",
			"",
			"Member - Activorm Connect");
		$this->load->view('n/member/member_account_view', $this->data);
	}
	
	function member_account_details(){
		
		$mai = $this->input->get_post('mai');
		$maih = $this->input->get_post('maih');
		$maih_ori = sha1($mai . SALT);
		if ($maih != $maih_ori) redirect(base_url() . 'admin/member/member_account');
		
		$this->load->model('a_account_model');
		$this->member = $this->a_account_model->getMemberByAccountId($mai);
		
		$account_province = $this->member->province_id;
		
		$this->load->model('address_model');
		$this->data['provinces'] = $this->address_model->getAddressProvince();
		
		$kabupatens = $kecamatans = $kelurahans = array();
		
		// kabupaten
		$account_kabupaten = $this->member->kabupaten_id;
		if (!empty($account_kabupaten)){
			$kabupatens = $this->address_model->getKabupatenByProvinceId($account_province);
		}
		
		// kecamatan
		$account_kecamatan = $this->member->kecamatan_id;
		if (!empty($account_kecamatan)){
			$kecamatans = $this->address_model->getKecamatanByKabupatenId($account_kabupaten);
		}
		
		// kelurahan
		$account_kelurahan = $this->member->kelurahan_id;
		if (!empty($account_kelurahan)){
			$kelurahans = $this->address_model->getKelurahanByKecamatanId($account_kecamatan);
		}
		
		$this->data['kabupatens'] = $kabupatens;
		$this->data['kecamatans'] = $kecamatans;
		$this->data['kelurahans'] = $kelurahans;
		
		$this->data['menu'] = 'account';
		$this->data['menu_child'] = 'member_account';
		$this->_default_param(
			"",
			array(
				'<script src="'.cdn_url().'js/a-bday-picker.js"></script>',
				'<script src="'.cdn_url().'js/a_member_account.js"></script>'
			),
			"",
			"Member Details - Activorm Connect");
		$this->load->view('n/member/member_account_details_view', $this->data);
	}

	function update_member_account(){
		$update = $this->input->get_post('update');
		
		/* START KEY */
		$mai = $this->input->get_post('mai');
		$maih = $this->input->get_post('maih');
		$maih_ori = sha1($mai.SALT);
		/* END KEY */
		
		if (!empty($update)){
				
			$account_name = $this->input->get_post('account_name');
			$account_email = $this->input->get_post('account_email');
			$zip_code = $this->input->get_post('zip_code');
			$gender = $this->input->get_post('gender');
			$birthday = $this->input->get_post('birthdate');
			$account_phone = $this->input->get_post('phone_number');
			$user_idcard = $this->input->get_post('card_number');
			$account_address = $this->input->get_post('address');
			$account_province = $this->input->get_post('province_id');
			$account_kabupaten = $this->input->get_post('kabupaten_id');
			$account_kecamatan = $this->input->get_post('kecamatan_id');
			$account_kelurahan = $this->input->get_post('kelurahan_id');
			$account_live = $this->input->get_post('account_live');
			$account_active = $this->input->get_post('account_active');
			
			/********  VALIDASI */ 
			
			$this->load->library('validate');
			$validateName = $this->validate->validateName($account_name);
			$validateEmail = $this->validate->validateEmail($account_email);
			
			$errors = array();
			
			if ($maih != $maih_ori){
				$errors[] = "Something error with key hash.";
			}
			
			if ($account_province == 0){
				$errors[] = "Province can't be emptied";
			}
			$this->session->set_userdata('account_province', $account_province);
			if ($account_kabupaten == 0){
				$errors[] = "Kabupaten can't be emptied";
			}
			$this->session->set_userdata('account_kabupaten', $account_kabupaten);
			if ($account_kecamatan == 0){
				$errors[] = "Kecamatan can't be emptied";
			}
			$this->session->set_userdata('account_kecamatan', $account_kecamatan);
			//if ($account_kelurahan == 0){
			//	$errors[] = "Kelurahan can't be emptied";
			//}
			//$this->session->set_userdata('account_kelurahan', $account_kelurahan);

			if ($validateName == 1){
				$errors[] = 'Your name must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 4 characters.';
			} 
			$this->session->set_userdata('account_name', $account_name);
			if ($validateEmail == 1){
				$errors[] = 'Please insert the correct email.';
			} 
			$this->session->set_userdata('account_email', $account_email);
			
			$birthday_year_ori = date('Y', strtotime($birthday));
			if ($birthday_year_ori < 1970){
				$errors[] = 'Please insert the correct Date of Birth.';
			}
			$this->session->set_userdata('account_birthday', $birthday);
			
			$account_phone = preg_replace("/[^0-9]/", "", $account_phone);
			if (empty($account_phone) || !is_numeric($account_phone)){
				$errors[] = 'Phone Number may consists of numbers only.';
			}
			$this->session->set_userdata('account_phone', $account_phone);
			
			if (strlen($user_idcard) < 10){
				$errors[] = 'ID Card Number must contain minimum 10 numbers.';
			}
			$this->session->set_userdata('account_idcard', $user_idcard);
			
			$this->load->model('account_model');
			if (!is_numeric($user_idcard)){
				$errors[] = 'ID Card Number may  consists of numbers only.';
			}
			$user = $this->account_model->getAccountTaken("ma.card_number", $user_idcard, $account_type = 'user', $mai);
			if (!empty($user)){
				$errors[] = 'Please insert the correct ID Card Number. The one you insert has been used.';
			}
			$this->session->set_userdata('account_idcard', $user_idcard);
			
			$user = $this->account_model->getAccountTaken('ma.account_email', $account_email, $account_type = 'user', $mai);
			if (!empty($user)){
				$errors[] = 'Email has been used by another account.';
			}
			$this->session->set_userdata('account_email', $account_email);
			
			$config['upload_path'] = './images/avatar/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']	= '2024';
			$config['max_width']  = '1200';
			$config['max_height']  = '1200';
			$config['encrypt_name'] = true;
			
			$this->load->library('upload', $config);
			
			$uploaded = $this->upload->do_upload('account_avatar');
			$account_primary_photo = "";
			if ($uploaded){
				//$error = $this->upload->display_errors();
				$data = $this->upload->data();
				//print_r($data);
				//print_r($error);
				
				$account_primary_photo = 'images/avatar/' . $data['file_name'];
				
				$dataUser['account_primary_photo'] = $account_primary_photo;
				
				//$this->session->set_userdata('account_primary_photo', $account_primary_photo);
			}else{
				
				if (!empty($_FILES['account_avatar']['name'])){
					$errors[] = 'You have to upload a Profile Picture in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
					//echo '1';
				}
				//$errors[] = 'You have to upload a Project Image in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
				//echo '2';die();
			}
			
			/******** END VALIDASI */
			
			if (count($errors) > 0){
				
				$this->session->set_userdata('a_message_error', $errors);
				
				/**/
				//print_r($errors);die();
				
			}else{
				
				$birthday = date('Y-m-d', strtotime($birthday));
				
				$dataUser = array(
					'account_name' => $account_name,
					'account_email' => $account_email,
					'gender' => $gender,
					'birthday' => $birthday,
					'phone_number' => $account_phone,
					'card_number' => $user_idcard,
					'address' => $account_address,
					'province_id' => $account_province,
					'kabupaten_id' => $account_kabupaten,
					'kelurahan_id' => $account_kelurahan,
					'kecamatan_id' => $account_kecamatan
				);
				if ($account_primary_photo != "") $dataUser['account_primary_photo'] = $account_primary_photo;

				$this->load->model('account_model');
				$this->account_model->registerAccount($dataUser, $mai);
				
				$this->session->set_userdata('a_message_success', 'Successfully Saved');
			}
			
		}

		redirect(base_url() . 'admin/member/member_account_details?mai='.$mai.'&maih='.$maih_ori);

	}

	/**** MEMBER ACCOUNT - END ****/
	
	
	/**** BUSINESS ACCOUNT - START ****/
	function business_account(){
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$this->search_by = $this->input->get_post('search_by');
		$this->q = $this->input->get_post('q');
		$param_url = array(
			'search_by' => $this->search_by,
			'q' => $this->q,
			'page' => ''
		);
		
		$this->load->model('a_account_model');
		$this->data['members'] = $this->a_account_model->getMembers($account_type = "business", $param_url, $this->offset, 0, $page);
		
		$param_url = http_build_query($param_url);
		
		$uri_page = 'admin/member/business_account?'.$param_url;
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->a_account_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);
		
		$this->data['menu'] = 'account';
		$this->data['menu_child'] = 'business_account';
		$this->_default_param(
			"",
			"",
			"",
			"Business Account - Activorm Connect");
		$this->load->view('n/member/business_account_view', $this->data);
	}
	function business_account_details(){
		
		$bai = $this->input->get_post('bai');
		$mai = $this->input->get_post('mai');
		$h = $this->input->get_post('h');
		$h_ori = sha1($bai . $mai . SALT);
		if ($h != $h_ori) redirect(base_url() . 'admin/member/business_account');
		
		$this->load->model('a_account_model');
		$this->member = $this->a_account_model->getMemberBusinessByAccountId($mai);
		
		$account_province = $this->member->province_id;
		
		$this->load->model('address_model');
		$this->data['provinces'] = $this->address_model->getAddressProvince();
		
		$kabupatens = $kecamatans = $kelurahans = array();
		
		// kabupaten
		$account_kabupaten = $this->member->kabupaten_id;
		if (!empty($account_kabupaten)){
			$kabupatens = $this->address_model->getKabupatenByProvinceId($account_province);
		}
		
		// kecamatan
		$account_kecamatan = $this->member->kecamatan_id;
		if (!empty($account_kecamatan)){
			$kecamatans = $this->address_model->getKecamatanByKabupatenId($account_kabupaten);
		}
		
		// kelurahan
		$account_kelurahan = $this->member->kelurahan_id;
		if (!empty($account_kelurahan)){
			$kelurahans = $this->address_model->getKelurahanByKecamatanId($account_kecamatan);
		}
		
		$this->data['kabupatens'] = $kabupatens;
		$this->data['kecamatans'] = $kecamatans;
		$this->data['kelurahans'] = $kelurahans;
		
		$this->data['menu'] = 'account';
		$this->data['menu_child'] = 'business_account';
		$this->_default_param(
			"",
			array(
				'<script src="'.cdn_url().'js/a-bday-picker.js"></script>',
				'<script src="'.cdn_url().'js/a_member_account.js"></script>'
			),
			"",
			"Business Account Details - Activorm Connect");
		$this->load->view('n/member/business_account_details_view', $this->data);
	}
	function update_business_account(){
		$update = $this->input->get_post('update');
		
		/* START KEY */
		$mai = $this->input->get_post('mai');
		$bai = $this->input->get_post('bai');
		$h = $this->input->get_post('h');
		$h_ori = sha1($bai.$mai.SALT);
		/* END KEY */
		
		if (!empty($update)){
			
			$account_name = $this->input->get_post('account_name');
			$account_email = $this->input->get_post('account_email');
			$account_contact = $this->input->get_post('account_contact');
			$account_position = $this->input->get_post('account_position');
			$account_number = $this->input->get_post('account_number');
			$website = $this->input->get_post('website');
			$account_description = $this->input->get_post('account_description');
			$account_address = $this->input->get_post('account_address');
			$account_need = $this->input->get_post('account_need');
			$account_province = $this->input->get_post('province_id');
			$account_kabupaten = $this->input->get_post('kabupaten_id');
			$account_kecamatan = $this->input->get_post('kecamatan_id');
			$account_kelurahan = $this->input->get_post('kelurahan_id');
			$account_live = $this->input->get_post('account_live');
			$account_active = $this->input->get_post('account_active');
			
			/********  VALIDASI */ 
			
			$this->load->library('validate');
			$validateName = $this->validate->validateName($account_name);
			$validateEmail = $this->validate->validateEmail($account_email);
			
			$errors = array();
			
			if ($h != $h_ori){
				$errors[] = "Something error with key hash.";
			}
			
			if ($account_province == 0){
				$errors[] = "Province can't be emptied";
			}
			$this->session->set_userdata('account_province', $account_province);
			if ($account_kabupaten == 0){
				$errors[] = "Kabupaten can't be emptied";
			}
			$this->session->set_userdata('account_kabupaten', $account_kabupaten);
			if ($account_kecamatan == 0){
				$errors[] = "Kecamatan can't be emptied";
			}
			$this->session->set_userdata('account_kecamatan', $account_kecamatan);
			//if ($account_kelurahan == 0){
			//	$errors[] = "Kelurahan can't be emptied";
			//}
			//$this->session->set_userdata('account_kelurahan', $account_kelurahan);

			if ($validateName == 1){
				$errors[] = 'Your name must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 4 characters.';
			} 
			$this->session->set_userdata('account_name', $account_name);
			if ($validateEmail == 1){
				$errors[] = 'Please insert the correct email.';
			} 
			$this->session->set_userdata('account_email', $account_email);
			
			$this->load->model('account_model');
			$user = $this->account_model->getAccountTaken('ma.account_email', $account_email, $account_type = 'business', $mai);
			if (!empty($user)){
				$errors[] = 'Email has been used by another account.';
			}
			$this->session->set_userdata('account_email', $account_email);
			
			$validateAccountContact = $this->validate->validateName($account_contact);
			if ($validateAccountContact == 1){
				$errors[] = 'Contact Person must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 4 characters.';
			} 
			$this->session->set_userdata('contact_person', $account_contact);
			
			$account_number = preg_replace("/[^0-9]/", "", $account_number);
			if (empty($account_number)){
				$errors[] = 'Phone Number may consists of numbers only.';
			}
			$this->session->set_userdata('contact_number', $account_number);
			
			if (strlen($account_address) < 4){
				$errors[] = "Billing Address must contain minimum 4 characters.";
			}
			$this->session->set_userdata('business_billing_address', $account_address);
			
			if (strlen($account_description) < 50){
				$errors[] = "Please describe your Business in minimum 50 characters.";
			}
			$this->session->set_userdata('business_description', $account_description);
			
			if (strlen($account_need) < 5){
				$errors[] = "Business Needs must contain minimum 5 characters.";
			}
			$this->session->set_userdata('business_needs', $account_need);
			
			if (empty($account_position)){
				$errors[] = "Please insert your Position in the Company.";
			}
			$this->session->set_userdata('position_inthe_company', $account_position);
			
			$this->load->library('util');
			$business_uri = $this->util->url_slug($account_name);
			$this->load->model('business_model');
			$business = $this->business_model->getBusinessTaken('bp.business_uri', $business_uri, $mai, $bai);
			if (!empty($business)){
				$errors[] = 'Your Business Name has been taken.';
			}
			
			if (!empty($website) && trim($website) != "http://"){
				$validateWebsite = $this->validate->valid_url($website);
				if ($validateWebsite == FALSE){
					$errors[] = 'Please insert the correct website URL link.';
				}
			}
			
			
			
			// ACCOUNT AVATAR ========================= START ==================================
			$config['upload_path'] = './images/avatar/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']	= '2024';
			$config['max_width']  = '1200';
			$config['max_height']  = '1200';
			$config['encrypt_name'] = true;
			
			$this->load->library('upload', $config);
			
			$uploaded = $this->upload->do_upload('account_avatar');
			$account_primary_photo = "";
			if ($uploaded){
				//$error = $this->upload->display_errors();
				$data = $this->upload->data();
				//print_r($data);
				//print_r($error);
				
				$account_primary_photo = 'images/avatar/' . $data['file_name'];
				
				$dataUser['account_primary_photo'] = $account_primary_photo;
				
				//$this->session->set_userdata('account_primary_photo', $account_primary_photo);
			}else{
				
				if (!empty($_FILES['account_avatar']['name'])){
					$errors[] = 'You have to upload a Profile Picture in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
					//echo '1';
				}
				//$errors[] = 'You have to upload a Project Image in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
				//echo '2';die();
			}
			// ACCOUNT AVATAR ========================= END ==================================
			
			
			
			// MERCHANT LOGO ========================= START ==================================
			$config['upload_path'] = './images/merchant/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']	= '2024';
			$config['max_width']  = '1200';
			$config['max_height']  = '1200';
			$config['encrypt_name'] = true;
			
			$this->load->library('upload', $config);
			
			$uploaded = $this->upload->do_upload('merchant_logo');
			$merchant_logo = "";
			if ($uploaded){
				//$error = $this->upload->display_errors();
				$data = $this->upload->data();
				//print_r($data);
				//print_r($error);
				
				$merchant_logo = 'images/merchant/' . $data['file_name'];
				
				$dataUser['merchant_logo'] = $merchant_logo;
				
				//$this->session->set_userdata('account_primary_photo', $account_primary_photo);
			}else{
				
				if (!empty($_FILES['merchant_logo']['name'])){
					$errors[] = 'You have to upload a Profile Picture in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
					//echo '1';
				}
				//$errors[] = 'You have to upload a Project Image in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
				//echo '2';die();
			}
			// MERCHANT LOGO ========================= END ==================================
			
			
			/******** END VALIDASI */
			
			if (count($errors) > 0){
				
				$this->session->set_userdata('a_message_error', $errors);
				
				/**/
				//print_r($errors);die();
				
			}else{
								
				// member account				
				$dataUser = array(
					'account_name' => $account_name,
					'account_email' => $account_email,
					'province_id' => $account_province,
					'kabupaten_id' => $account_kabupaten,
					'kelurahan_id' => $account_kelurahan,
					'kecamatan_id' => $account_kecamatan
				);
				if ($account_primary_photo != "") $dataUser['account_primary_photo'] = $account_primary_photo;
				
				$this->account_model->registerAccount($dataUser, $mai);
				
				// business account
				$dataBusiness = array(
					'business_name' => $account_name,
					'business_uri' => $business_uri,
					'business_description' => $account_description,
					'business_billing_address' => $account_address,
					'business_needs' => $account_need,
					'contact_person' => $account_contact,
					'contact_number' => $account_number,
					'position_inthe_company' => $account_position,
					'website' => $website
				);
				if ($merchant_logo != "") $dataBusiness['merchant_logo'] = $merchant_logo;
				
				$this->load->model('business_model');
				$this->business_model->registerBusiness($dataBusiness, $bai);
				
				$this->session->set_userdata('a_message_success', 'Successfully Saved');
			}
			
		}
		
		redirect(base_url() . 'admin/member/business_account_details?bai=' . $bai . '&mai=' . $mai . '&h=' . $h_ori);
		
	}
	/**** BUSINESS ACCOUNT - END ****/
	
	
	/**** MEMBER INVITATION- START ****/
	function add_account(){
		$this->data['menu'] = 'account';
		$this->data['menu_child'] = 'add_invite_member';
		$this->_default_param(
			"",
			"",
			"",
			"Add Account - Activorm Connect");
		$this->load->view('n/member/add_invite_member_view', $this->data);
	}
	function sending_invite_member(){
		$update = $this->input->get_post('update');
		if (!empty($update)){
			$account_name = $this->input->get_post('account_name');
			$account_email = $this->input->get_post('account_email');
			$account_type = $this->input->get_post('account_type');
			
			$errors = array();
			$this->load->library('validate');
			if ($this->validate->validateName($account_name) == 1){
				$errors[] = 'Your name must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 4 characters.';
			} 
			if ($this->validate->validateEmail($account_email) == 1) {
				$errors[] = 'Please insert the correct email.';
			}
			
			if (count($errors) > 0){
				
				$this->session->set_userdata('msg_invite_member', 1);
				
			}else{
				
				$this->load->model('invitation_model');
				$data = array(
					'account_email' => $account_email,
					'account_name' => $account_name,
					'account_type' => $account_type
				);
				$this->invitation_model->addMemberInvite($data);
				
				$email_hash = sha1(SALT.$account_email);
				
				$special_text = "Invitation";
				if ($account_type == "special_quest"){
					$special_text = "Special Invitation";
				}
				
				$subject_email = "Congratulations! Here is your Activorm Private Beta Invitation";
				if ($account_type == "special_quest"){
					$subject_email = "Congratulations! Here is your Special Invitation to Activorm Private Beta";
				}
				
				$this->load->model('prize_model');
				$product_prize = $this->prize_model->getProductPrize(12);
				
				$this->load->model('business_model');
				$merchants = $this->business_model->getMerchantHomePage();
				
				$data = array(
					'account_type' => $account_type,
					'account_email' => $account_email,
					'email_hash' => $email_hash,
					'product_prize' => $product_prize,
					'merchants' => $merchants,
					'special_text' => $special_text,
					'subject_email' => $subject_email
				);
				
				$this->sending_email($data, "invite_email");
				
				$this->session->set_userdata('msg_invite_member', 2);
				
			}
		}
		redirect(base_url().'admin/member/add_account');
	}
	/**** MEMBER INVITATION - END ****/
	
	

	/**** RESEND ACTIVATION CODE - START ****/
	
	function resend_activationcode(){
		/* START KEY */
		$mai = $this->input->get_post('mai');
		$maih = $this->input->get_post('maih');
		$maih_ori = sha1($mai.SALT);
		/* END KEY */
		if ($maih == $maih_ori){
			
			$this->load->model('account_model');
			$account = $this->account_model->getAccount("ma.account_id", $mai, "user");
			
			$dataUser = (array) $account;
			
			// send email
			$this->sending_email($dataUser, "user");
			$this->session->set_userdata('a_msg_resend_activationcode', 2);
		}else{
			$this->session->set_userdata('a_msg_resend_activationcode', 1);
		}
		redirect(base_url() . 'admin/member/member_account_details?mai='.$mai.'&maih='.$maih_ori);
	}
	
	function resend_temp_password(){
		/* START KEY */
		$mai = $this->input->get_post('mai');
		$bai = $this->input->get_post('bai');
		$h = $this->input->get_post('h');
		$h_ori = sha1($bai . $mai . SALT);
		/* END KEY */
		if ($h == $h_ori){
			$this->load->model('account_model');
			$user = $this->account_model->getAccount("ma.account_id", $mai, "business");
			$dataUser = array(
				'account_type' => 'business',
				'account_name' => $user->account_name,
				'account_email' => $user->account_email,
				'account_password' => $user->account_password,
				'account_temp_password' => $user->account_temp_password,
				'verification_code' => $user->verification_code,
				'register_step' => $user->register_step,
				'account_live' => $user->account_live
			);
			// send email
			$this->sending_email($dataUser, "business");
			$this->session->set_userdata('a_msg_resend_password', 2);
		}else{
			$this->session->set_userdata('a_msg_resend_password', 1);
		}
		redirect(base_url() . 'admin/member/business_account_details?bai=' . $bai . '&mai=' . $mai . '&h=' . $h_ori);
	}
	
	/**** RESEND ACTIVATION CODE - END ****/
	
	/**** SENDING EMAIL - START ****/
	
	function sending_email($data, $type = 'user'){
		// sending email
		require_once APPPATH.'libraries/swiftmailer/swift_required.php';
		$transport = Swift_MailTransport::newInstance();
		//Create the message
        $message = Swift_Message::newInstance();
		//Give the message a subject
		
		$email = $data['account_email'];
				
		$subject = "Account Verification";		
		switch($type){
			case "user" :
				$tmpl = "email_activation_account_view"; 
				$subject = "Account Verification";
				break;
			case "business" :
				$tmpl = "email_info_account_view";
				$subject = "Account Verification";
				break;
			case "forgotpassword" :
				$tmpl = "email_forgotpassword_view";
				$subject = "Reset your Activorm Account password‏";
				break; 
			case "invite_email":
				$tmpl = "invitation_email_view";
				$subject = $data['subject_email'];
				break;
		}		
				
		$data = $this->load->view('email/' . $tmpl, $data, true);
        $message->setSubject($subject)
                ->setFrom(array('info@activorm.com' => 'Activorm'))
                ->setTo($email)
                ->addPart($data, 'text/html')
        ;
		//Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);
        
        //Send the message
        $result = $mailer->send($message);
	}

	/**** SENDING EMAIL - END ****/
	
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