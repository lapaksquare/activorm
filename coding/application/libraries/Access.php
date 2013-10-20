<?php 

class Access {

	var $ci;

	function __construct(){
		$this->ci =& get_instance();
	}

	function accessUser(){
		$this->ci->load->library('facebook_library');
		$this->ci->facebook_library->connection();
		$this->facebook = $this->ci->facebook_library->facebook;
		// get user id
		$this->user = $this->facebook->getUser();
		$this->loginUrl = $this->facebook->getLoginUrl(array(
			'scope' => 'email,user_hometown,user_location,user_photos,user_birthday,user_checkins,user_interests',
			'redirect_uri' => base_url() . 'auth/register_facebook'
		));
		$this->logoutUrl = $this->facebook->getLogoutUrl();
		
		$this->ci->load->model('account_model');
		$account_id = $this->ci->session->userdata('account_id');
		$this->member_account = $this->ci->account_model->getAccount("ma.account_id", $account_id);
	}

	function userLogin($dataUser){
		// data user to session
		$this->ci->session->set_userdata('islogin', true);
		$this->ci->session->set_userdata('users', $dataUser);
	}
	
	function registerSocialMedia($socialmedia, $dataUser, $dataLogSocialMedia, $registerNewUser = 1){
		$this->ci->load->library('util');
		$this->ci->load->model('account_model');
				
		// registe new user perlu verification_code	
		if ($registerNewUser == 1){
			$dataUser['verification_code'] = $this->ci->util->create_code(4, "number");
			$dataUser['register_step'] = 1;
		}		
				
		// save photo dari social media
		$dataUser['account_primary_photo'] = "";
		if (!empty($dataUser['avatar'])){
			$avatar = $this->ci->util->get_raw_avatar_url($dataUser['avatar']);
			unset($dataUser['avatar']);
			if ($avatar !== FALSE){
				$file = pathinfo($avatar);
				$save_avatar = "images/avatar/" . $this->ci->util->create_code(10, "number") . "." . $file['extension'];
				$this->ci->util->saveFile($avatar, $save_avatar);
				$dataUser['account_primary_photo'] = $save_avatar;
			}
		}
		
		$account_id = $this->ci->account_model->insertAccount($dataUser);
		
		$this->logIpAddress($account_id);
		
		// masukkan data log fb di database
		$dataLogSocialMedia['account_id'] = $account_id;
		$this->ci->load->model('socialmedia_model');
		$this->ci->socialmedia_model->insertLogSocialMedia($dataLogSocialMedia);
		
		return $account_id;
	}

	function logIpAddress($account_id){
		$this->ci->load->model('account_model');
		// insert log ip address
		$ipAddress = $this->ci->input->ip_address();
		$dataIpAddress = array(
			'account_id' => $account_id,
			'ipaddress' => $ipAddress			
		);
		$this->ci->account_model->logIpAddressUser($dataIpAddress);
	}

	function register_session($account_id, $data){
		$this->ci->session->set_userdata('account_id', $account_id);
		$this->ci->session->set_userdata('register_temp', $data);
	}
	
	function remove_session(){
		$this->ci->session->unset_userdata('account_id');
		$this->ci->session->unset_userdata('register_temp');
	}

}

?>