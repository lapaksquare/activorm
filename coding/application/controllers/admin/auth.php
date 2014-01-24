<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Admin{
	
	function __construct(){
		parent::__construct();
	}
	
	function submit_login(){
		$submit = $this->input->get_post('submit');
		$email = $this->input->get_post('email');
		$password = $this->input->get_post('password');
		if (!empty($submit)){
			$this->load->model('a_account_model');
			$md5_password = md5($password . SALT);
			$user = $this->a_account_model->getAdminAccess($email, $md5_password);
			if (empty($user) || empty($email) || empty($password)){
				$this->session->set_userdata('msg_a_access', 1);
			}else{
				$this->session->set_userdata('msg_a_access', 2);
				$this->session->set_userdata('account_id_admin', $user->account_id);
				$this->session->set_userdata('account_admin', $user);
				redirect(base_url() . 'admin/home');
			}
		}
		redirect(base_url() . 'admin');
	}

}

?>