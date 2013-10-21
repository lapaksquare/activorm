<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct(){
		parent::__construct();
	}
	
	function index(){
		redirect(base_url());
	}
	
	// register untuk facebook =================================================
	function register_facebook(){

		// datang dari facebook
		$state = $this->input->get_post('state');
		$code = $this->input->get_post('code');

		// save uri
		$redirect_uri = $this->session->userdata('redirect_uri');
		$redirect_uri = (empty($redirect_uri)) ? base_url() : $redirect_uri;
		$this->session->unset_userdata('redirect_uri');

		if (empty($state) || empty($code)) redirect($redirect_uri);

		// extract fb
		$this->dataFB = $this->access->facebook->api('/me');

		$this->load->model('account_model');
		$user = $this->account_model->getAccount("ma.account_email", $this->dataFB['email']);
		if (!empty($user)){
						
			if ($user->account_active == 0) redirect(base_url());			
												
			// redirect ke halaman depan lagi utk register tombol tekan
			$this->access->register_session($user->account_id, array(
				'account_id' => $user->account_id,
				'fullname' => $user->account_name,
				'email' => $user->account_email,
				'step' => $user->register_step
			));
			
			// ip address
			$this->access->logIpAddress($user->account_id);									
												
			// offline berarti belum verifikasi dan belum masuk ke dashboard usernya
			if ($user->account_live == "Offline"){
					
				redirect(base_url());
						
			}else{
				
				if ($user->register_step == 4) redirect(base_url() . 'settings/contact');
				
			}
			
		}else{
						
			// get photo facebook profile pictures
			$avatar_facebook = "https://graph.facebook.com/".$this->dataFB['id']."/picture?type=large";
			
			// masukkan data fb nya ke member account
			$birthday = "";
			if (!empty($this->dataFB['birthday'])){
				list($bulan, $tanggal, $tahun) = explode('/', $this->dataFB['birthday']);
				$birthday = $tahun.'-'.$bulan.'-'.$tanggal;
			}
			$dataUser = array(
				'account_name' => $this->dataFB['name'],
				'account_email' => $this->dataFB['email'],
				'account_primary_photo' => $avatar_facebook,
				'gender' => $this->dataFB['gender'],
				'birthday' => $birthday,
				'avatar' => $avatar_facebook,
				'account_type' => 'user'
			);
									
			// masukkan data log fb di database
			$dataLogSocialMedia = array(
				'social_name' => 'facebook',
				'social_data' => json_encode($this->dataFB),
				'social_active' => 1
			);
			
			$account_id = $this->access->registerSocialMedia("facebook", $dataUser, $dataLogSocialMedia);
			
			// redirect ke halaman depan lagi utk register tombol tekan
			$this->access->register_session($account_id, array(
				'account_id' => $account_id,
				'fullname' => $this->dataFB['name'],
				'email' => $this->dataFB['email'],
				'step' => 1
			));
			
			redirect(base_url());
			
			/*
			echo '<pre>';
			print_r($this->dataFB);
			echo '</pre>';
			
			die();
			*/
		}

	}

	
	// register untuk normal ========================================
	function register(){
		$submit_register = $this->input->get_post('submit_register');
		if (!empty($submit_register)){
			$fullname = $this->input->get_post('name');
			$email = $this->input->get_post('email');
			$password = $this->input->get_post('password');
			$salt_password = md5($password . SALT);
			$this->load->library('validate');
			$validateName = $this->validate->validateName($fullname);
			$validateEmail = $this->validate->validateEmail($email);
			$validatePassword = $this->validate->validatePassword($password);
			$errors = array();
			if ($validateName == 1){
				$errors[] = 'penulisan nama';
			} 
			if ($validateEmail == 1){
				$errors[] = 'penulisan email';
			} 
			if ($validatePassword == 1){
				$errors[] = 'penulisan password';
			} 
			
			$user = $this->account_model->getAccount("ma.account_email", $email);
			if (!empty($user)){
				$errors[] = 'email yang digunakan sudah dipakai';
			}
			
			if (!empty($errors)){
				$errors = implode(", ", $errors);
				$this->session->set_userdata('message_register_error', "Terjadi kesalahan pada " . $errors . ".");
			}else{
				
				$register_step = 2;
				$this->load->library('util');
				
				// register normal
				$verification_code = $this->util->create_code(4, "number");
				$dataUser = array(
					'account_name' => $fullname,
					'account_email' => $email,
					'account_password' => $salt_password,
					'verification_code' => $verification_code,
					'register_step' => $register_step,
					'account_type' => 'user'
				);
				
				$this->load->model('account_model');
				$account_id = $this->account_model->registerAccount($dataUser);
				
				// update step register
				$register_temp = $this->session->userdata('register_temp');
				if (!empty($register_temp)){
					$register_temp['step'] = $register_step;
				}else{
					$register_temp =  array(
						'account_id' => $account_id,
						'fullname' => $fullname,
						'email' => $email,
						'step' => $register_step
					);
				}
				$this->access->register_session($account_id, $register_temp);
				
				// ip address
				$this->access->logIpAddress($account_id);
				
			}
		}

		redirect(base_url());
	}
	
	function verify_code(){
		$submit_verify = $this->input->get_post('submit_verify');
		if (!empty($submit_verify)){
			$this->load->model('account_model');
			$activation_code = $this->input->get_post('activation_code');
			$user = $this->account_model->getAccount("ma.verification_code", $activation_code);
			if (empty($user)){
				$this->session->set_userdata('message_register_error', "Code aktivasi yang Anda masukkan salah.");
			}else{
				$account_id = $user->account_id;
				$register_step = $user->register_step + 1;
				$register_temp = $this->session->userdata('register_temp');
				$register_temp['step'] = $register_step;
				$dataUser = array(
					'register_step' => $register_step
				);
				$this->load->model('account_model');
				$account_id = $this->account_model->registerAccount($dataUser);
						
				$this->access->register_session($account_id, $register_temp);
			}
		}
		redirect(base_url());
	}

	function login(){
		$login = $this->input->get_post('login');
		if (!empty($login)){
			$email = $this->input->get_post('email');
			$password = $this->input->get_post('password');
			$salt_password = md5($password . SALT);
			$user = $this->account_model->getAccountLogin($email, $salt_password);
			if (empty($user)){
				$this->session->set_userdata('message_register_error', "Email dan Password yang Anda tulis terdapat kesalahan.");
			}else{
				
				if ($user->account_active == 0) redirect(base_url());			
				
				// redirect ke halaman depan lagi utk register tombol tekan
				$this->access->register_session($user->account_id, array(
					'account_id' => $user->account_id,
					'fullname' => $user->account_name,
					'email' => $user->account_email,
					'step' => $user->register_step
				));
				
				// ip address
				$this->access->logIpAddress($user->account_id);
				
				if ($user->account_live == "Offline"){
							
				}else{
					
					if ($user->register_step == 4) redirect(base_url() . 'settings/contact');
					
				}
			}
		}
		redirect(base_url());
	}
	
	function register_completed(){
		$vc = $this->input->get_post('vc');
		$hash = $this->input->get_post('hash');
		$ori_hash = sha1($vc . date('Y-m-d'));
		if ($hash == $ori_hash){
			$register_step = 4;
			$dataUser = array(
				'register_step' => $register_step,
				'account_live' => 'Online'
			);
			$this->load->model('account_model');
			$account_id = $this->account_model->registerAccount($dataUser);
			$register_temp = $this->session->userdata('register_temp');
			$register_temp['step'] = $register_step;
			$this->access->register_session($account_id, $register_temp);
			redirect(base_url() . 'settings/contact');
		}
		redirect(base_url());
	}

	function logout(){
		$this->access->remove_session();
		redirect(base_url());
	}

}

?>