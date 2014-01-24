<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$account_id = $this->session->userdata('account_id');
		if (empty($account_id)) redirect(base_url());		  
	}
	
	var $segments;
	
	function index(){
		$this->data['menu'] = 'settings';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Tickets';
		
		$view = '';
		$this->segments = $this->uri->segment_array();
		
		if (!empty($this->segments[2]) && $this->segments[2] == "contact"){
			
			$this->contact_overview();
			
			$title = 'Contact Information';
			$view = 'contact_information_view';
			$this->data['submenu'] = 'contact';
			$css = array(
				'<link href="'.cdn_url().'css/font-awesome.css" rel="stylesheet" type="text/css">',
				'<link rel="stylesheet" type="text/css" href="'.cdn_url().'css/bootstrap.datepicker.css" />'
			);
			$js = array(
				'<script src="'.cdn_url().'js/bday-picker.js"></script>',
				//'<script src="'.cdn_url().'js/bootstrap.datepicker.js"></script>',
				'<script src="'.cdn_url().'js/contact.edit.js"></script>',
				'<script src="'.cdn_url().'js/setting_contact.js"></script>'
			);
		}else if (!empty($this->segments[2]) && $this->segments[2] == "socialmedia"){
			
			$this->socialmedia_overview();
			
			$title = 'Social Media Connect';
			$view = 'socialmedia_view';
			$this->data['submenu'] = 'socialmedia';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "email"){
			
			$this->email_overview();
			
			$title = 'Email Preference';
			$view = 'email_preference_view';
			$this->data['submenu'] = 'email';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "password"){
			$title = 'Password';
			$view = 'password_view';
			$this->data['submenu'] = 'password';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "deleteaccount"){
			$title = 'Delete Account';
			$view = 'deleteaccount_view';
			$this->data['submenu'] = 'deleteaccount';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "save_settings_contact"){
			$this->save_settings_contact();
		}else if (!empty($this->segments[2]) && $this->segments[2] == "save_settingsbusiness_contact"){
			$this->save_settingsbusiness_contact();
		}else if (!empty($this->segments[2]) && $this->segments[2] == "disconnect"){
			$this->disconnect_socialmedia();
		}else if (!empty($this->segments[2]) && $this->segments[2] == "save_changepassword"){
			$this->save_changepassword();
		}else if (!empty($this->segments[2]) && $this->segments[2] == "save_settingemail"){
			$this->save_settingemail();
		}else if (!empty($this->segments[2]) && $this->segments[2] == "save_deleteaccount"){
			$this->save_deleteaccount();
		}else{
			redirect(base_url() . '404');
		}
		
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/settings/' . $view, $this->data);
	}

	// contact_overview  =======================================
	function contact_overview(){
		$this->load->model('address_model');
		$this->data['provinces'] = $this->address_model->getAddressProvince();
		
		
		$kabupatens = $kecamatans = $kelurahans = array();
		
		// province
		$account_province = $this->access->member_account->province_id;
		$sess_account_province = $this->session->userdata('account_province');
		if (!empty($sess_account_province)){
			$account_province = $sess_account_province;
		}
		
		// kabupaten
		$account_kabupaten = $this->access->member_account->kabupaten_id;
		$sess_account_kabupaten = $this->session->userdata('account_kabupaten');
		if (!empty($sess_account_kabupaten)){
			$account_kabupaten = $sess_account_kabupaten;
		}
		if (!empty($account_kabupaten)){
			$kabupatens = $this->address_model->getKabupatenByProvinceId($account_province);
		}
		
		// kecamatan
		$account_kecamatan = $this->access->member_account->kecamatan_id;
		$sess_account_kecamatan = $this->session->userdata('account_kecamatan');
		if (!empty($sess_account_kecamatan)){
			$account_kecamatan = $sess_account_kecamatan;
		}
		if (!empty($account_kecamatan)){
			$kecamatans = $this->address_model->getKecamatanByKabupatenId($account_kabupaten);
		}
		
		// kelurahan
		$account_kelurahan = $this->access->member_account->kelurahan_id;
		$sess_account_kelurahan = $this->session->userdata('account_kelurahan');
		if (!empty($sess_account_kelurahan)){
			$account_kelurahan = $sess_account_kelurahan;
		}
		if (!empty($account_kelurahan)){
			$kelurahans = $this->address_model->getKelurahanByKecamatanId($account_kecamatan);
		}
		
		$this->data['kabupatens'] = $kabupatens;
		$this->data['kecamatans'] = $kecamatans;
		$this->data['kelurahans'] = $kelurahans;
		
		$this->load->model('socialmedia_model');
		$account_id = $this->session->userdata('account_id');
		$socialmedia_account = $this->socialmedia_model->socialmedia_connect($account_id);
		$this->data['socialmedia_account'] = $socialmedia_account;
	}

	// save_settings_contact member account ===================================
	function save_settings_contact(){
		
		$save_changes = $this->input->get_post('save_changes');
		
		if (!empty($save_changes)) {
			
			$account_name = $this->input->get_post('account_title');
			$account_email = $this->input->get_post('account_email');
			$account_province = $this->input->get_post('account_province');
			$account_kabupaten = $this->input->get_post('account_kabupaten');
			$account_kecamatan = $this->input->get_post('account_kecamatan');
			$account_kelurahan = $this->input->get_post('account_kelurahan');
			$gender = $this->input->get_post('gender');
			$birthday = $this->input->get_post('birthdate');
			$account_phone = $this->input->get_post('account_phone');
			$user_idcard = $this->input->get_post('user_idcard');
			$account_address = $this->input->get_post('account_address');
			
			$this->session->set_userdata('account_address', $account_address);
			$this->session->set_userdata('gender', $gender);
			
			$this->load->library('validate');
			$validateName = $this->validate->validateName($account_name);
			$validateEmail = $this->validate->validateEmail($account_email);
			
			$errors = array();
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
			if ($account_kelurahan == 0){
				//$errors[] = "Kelurahan can't be emptied";
			}
			$this->session->set_userdata('account_kelurahan', $account_kelurahan);

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
			$user = $this->account_model->getAccountTaken("ma.card_number", $user_idcard, $account_type = 'user');
			if (!empty($user)){
				$errors[] = 'Please insert the correct ID Card Number. The one you insert has been used.';
			}
			$this->session->set_userdata('account_idcard', $user_idcard);
			
			$user = $this->account_model->getAccountTaken('ma.account_email', $account_email, $account_type = 'user');
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

			if (count($errors) > 0){
				
				$this->session->set_userdata('message_settings_contact_error', $errors);
				
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
					'kecamatan_id' => $account_kecamatan,
					'register_step' => 5
				);
				if ($account_primary_photo != "") $dataUser['account_primary_photo'] = $account_primary_photo;

				$this->load->model('account_model');
				$this->account_model->registerAccount($dataUser);
				
				$this->session->set_userdata('message_settings_contact_success', 'Successfully Saved');
				
			}
			
		}

		redirect(base_url().'settings/contact');
		
		/*
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		
		echo '<pre>';
		print_r($_FILES);
		echo '</pre>';
		die();
		 */
	}

	// save_settings_contact business member account ===================================
	function save_settingsbusiness_contact(){
		
		$save_changes = $this->input->get_post('save_changes');
		
		if (!empty($save_changes)) { 
			
			$account_name = $this->input->get_post('account_title');
			$account_email = $this->input->get_post('account_email');
			$account_province = $this->input->get_post('account_province');
			$account_kabupaten = $this->input->get_post('account_kabupaten');
			$account_kecamatan = $this->input->get_post('account_kecamatan');
			$account_kelurahan = $this->input->get_post('account_kelurahan');
			
			$account_contact = $this->input->get_post('account_contact');
			$account_number = $this->input->get_post('account_number');
			$account_address = $this->input->get_post('account_address');
			
			$account_description = $this->input->get_post('account_description');
			$account_position = $this->input->get_post('account_position');
			$account_need = $this->input->get_post('account_need');
			
			$this->load->library('validate');
			$validateName = $this->validate->validateName($account_name);
			$validateNameContact = $this->validate->validateName($account_contact);
			$validateEmail = $this->validate->validateEmail($account_email);
			
			$website = $this->input->get_post('website');
			
			$errors = array();
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
			if ($account_kelurahan == 0){
				//$errors[] = "Kelurahan can't be emptied";
			}
			$this->session->set_userdata('account_kelurahan', $account_kelurahan);

			if ($validateName == 1){
				$errors[] = 'Your name must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 4 characters.';
			} 
			$this->session->set_userdata('account_name', $account_name);
			if ($validateNameContact == 1){
				$errors[] = 'Contact Person must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 4 characters.';
			} 
			$this->session->set_userdata('contact_person', $account_contact);
			if ($validateEmail == 1){
				$errors[] = 'Please insert the correct email.';
			} 
			$this->session->set_userdata('account_email', $account_email);
			
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
			
			/**/
			$this->load->model('account_model');
			$user = $this->account_model->getAccountTaken('ma.account_email', $account_email, $account_type = 'business');
			if (!empty($user)){
				$errors[] = 'Email has been used by another account.';
			}
			$this->session->set_userdata('account_email', $account_email);
			
			$this->load->library('util');
			$business_uri = $this->util->url_slug($account_name);
			$this->load->model('business_model');
			$business = $this->business_model->getBusinessTaken('bp.business_uri', $business_uri, 0, $this->access->business_account->business_id);
			if (!empty($business)){
				$errors[] = 'Your Business Name has been taken.';
			}
			/**/
			
			
			if (!empty($website) && trim($website) != "http://"){
				$validateWebsite = $this->validate->valid_url($website);
				if ($validateWebsite == FALSE){
					$errors[] = 'Please insert the correct website URL link.';
				}
			}
			
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
			}

			if (count($errors) > 0){
				
				$this->session->set_userdata('message_settings_contact_error', $errors);
				
			}else{
							
				// member account				
				$dataUser = array(
					'account_name' => $account_name,
					'account_email' => $account_email,
					'province_id' => $account_province,
					'kabupaten_id' => $account_kabupaten,
					'kelurahan_id' => $account_kelurahan,
					'kecamatan_id' => $account_kecamatan,
					'register_step' => 5
				);
				if ($account_primary_photo != "") $dataUser['account_primary_photo'] = $account_primary_photo;
				
				$this->load->model('account_model');
				$this->account_model->registerAccount($dataUser);
				
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
				
				$this->load->model('business_model');
				$this->business_model->registerBusiness($dataBusiness);
				
				$this->session->set_userdata('message_settings_contact_success', 'Successful Saved!');
				
			}
			
		}

		redirect(base_url().'settings/contact');
		
		/*
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		
		echo '<pre>';
		print_r($_FILES);
		echo '</pre>';
		die();
		 */
	}
	
	function socialmedia_overview(){
		$this->load->model('socialmedia_model');
		$account_id = $this->session->userdata('account_id');
		$socialmedia_account = $this->socialmedia_model->socialmedia_connect($account_id);
		$this->data['socialmedia_account'] = $socialmedia_account;
		
		// connect facebook url
		//$this->access->facebook_connect();
		
		// atur dan get facebook page
		$facebook_pages = array();
		if (array_key_exists("facebook", $socialmedia_account) && $this->access->member_account->account_type == "business"){
			
			if (empty($this->access->user)) redirect(base_url() . 'auth/facebook_connect_ref');
			
			// new token fb
			//$fbauth = $this->session->userdata('fbauth');
			//if (empty($fbauth)){
			//	redirect(base_url() . 'auth/facebook_connect_ref');
			//}
			set_time_limit(1000000);
			$facebook_pages = $this->manageFacebookPages();
		}
		$this->data['facebook_pages'] = $facebook_pages;
	}
	
	function manageFacebookPages(){
		$this->load->library('scache');
		$account_id = $this->access->member_account->account_id; //$this->session->userdata('account_id');
		$key = "#facebook_pages#" . $account_id . "#";
		$facebook_pages = $this->scache->read($key);
		if (empty($facebook_pages)){
			$this->scache->clear($key);
			$facebook_pages = array();
			$fb = $this->access->facebook->api('/me/accounts');
			if (!empty($fb['data'])){
				foreach($fb['data'] as $k=>$v){
					$facebook_pages[] = $v;
				}
			}
			$facebook_pages = json_encode( $facebook_pages );
			$this->scache->write($key, $facebook_pages, 60 * 60 * 12);
			
			// masukkan data log fb di database
			$this->load->model('socialmedia_model');
			//$account_id = $this->session->userdata('account_id');
			$where = array(
				'account_id' => $account_id,
				'social_name' => 'facebook'
			);
			$data = array(
				'social_page_data' => $facebook_pages
			);
			$this->socialmedia_model->updateLogSocialMedia($where, $data);
			
		}
		$facebook_pages = json_decode( $facebook_pages );
		
		/*
		echo '<pre>';
		print_r($facebook_pages);
		echo '</pre>';die();
		*/
		
		return $facebook_pages;
	}
	
	function disconnect_socialmedia(){
		$scid = $this->input->get_post('scid');
		$hash = $this->input->get_post('hash');
		$ori_hash = sha1($scid . SALT);
		if ($hash == $ori_hash){
			$this->load->model('socialmedia_model');
			$this->socialmedia_model->deleteSocialMediaConnect($scid);
			$this->load->library('scache');
			$account_id = $this->access->member_account->account_id; //$this->session->userdata('account_id');
			$key = "#facebook_pages#" . $account_id . "#";
			$this->scache->clear($key);
		}
		redirect(base_url() . 'settings/socialmedia');
	}
	
	function save_changepassword(){
		$submit = $this->input->get_post('submit');
		if (!empty($submit)){
			$new_password = $this->input->get_post('new_password');
			$confirm_new_password = $this->input->get_post('confirm_new_password');
			
			$this->load->library('validate');
			$validateNewPassword = $this->validate->validatePassword($new_password);
			$validateConfirmNewPassword = $this->validate->validatePassword($confirm_new_password);
			
			$current_password = $this->input->get_post('current_password');
			$hash_current_password = md5($current_password . SALT);
			
			$this->load->model('account_model');
			$account_id = $this->access->member_account->account_id;
			$account = $this->account_model->getAccount("ma.account_id", $account_id);
			$errors = array();
			if (empty($account)){
				$errors[] = 'There was an error in your account.';
			}else{
				if ($hash_current_password != $account->account_password){
					$errors[] = 'Old Password may not consist special characters (e.g. - , > , % , $). Minimum 6 characters.';
				}else if ($new_password != $confirm_new_password){
					$errors[] = 'New Password may not consist special characters (e.g. - , > , % , $). Minimum 6 characters.';
				}else if ($validateNewPassword == 1 || $validateConfirmNewPassword == 1){
					$errors[] = 'Password may not consist special characters (e.g. - , > , % , $). Minimum 6 characters.';
				}
			}
			
			if (count($errors) > 0){
				$this->session->set_userdata('message_error_password', $errors);
			}else{
				
				$dataUser = array(
					'account_password' => md5($new_password . SALT)
				);
				$this->account_model->registerAccount($dataUser);
				
				$this->session->set_userdata('message_success_password', 1);
			}
			
		}

		redirect(base_url() . 'settings/password');
	}

	function save_settingemail(){
		$save_changes = $this->input->get_post('save_changes');
		if (!empty($save_changes)){
			$email_new = $this->input->get_post('email-new');
			$email_winner = $this->input->get_post('email-winner');
			$email_comment = $this->input->get_post('email-comment');
			$email_other = $this->input->get_post('email-other');
			$email_newsletter = $this->input->get_post('email-newsletter');
			
			$email_new = (!empty($email_new)) ? 1 : 0;
			$email_winner = (!empty($email_winner)) ? 1 : 0;
			$email_comment = (!empty($email_comment)) ? 1 : 0;
			$email_other = (!empty($email_other)) ? 1 : 0;
			$email_newsletter = (!empty($email_newsletter)) ? 1 : 0;
			
			$data = array(
			 	'account_id' => $this->access->member_account->account_id,
				'set1' => $email_new,
				'set2' => $email_winner,
				'set3' => $email_comment,
				'set4' => $email_other,
				'set5' => $email_newsletter
			);
			$this->load->model('account_model');
			$this->account_model->registerSettingEmail($data);
			
			$this->session->set_userdata('msg_settingemail', 1);
		}
		redirect(base_url().'settings/email');
	}

	function email_overview(){
		$this->load->model('account_model');
		$this->data['member_email'] = $this->account_model->getSettingMemberEmail($this->access->member_account->account_id);
	}
	
	function save_deleteaccount(){
		$submit = $this->input->get_post('submit');
		if (!empty($submit)){
			$delete_reason = $this->input->get_post('delete-reason');
			$password = $this->input->get_post('password');
			$ori_password = $this->access->member_account->account_password;
			$hash_password = md5($password . SALT);
			$this->load->model('account_model');
			if ($ori_password != $hash_password){
				$this->session->set_userdata('msg_deleteaccount_err', 1);
			}else{
				$this->account_model->registerDeleteAccount(array(
					'reason' => $delete_reason,
					'account_id' => $this->access->member_account->account_id
				));
				$this->session->set_userdata('msg_deleteaccount_succ', 1);
			}
		}
		redirect(base_url() . 'settings/deleteaccount');
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