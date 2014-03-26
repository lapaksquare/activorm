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
			$this->load->model('s_account_model');
			$md5_password = md5($password . SALT);
			$user = $this->s_account_model->getSalesAccess($email, $md5_password);
			if (empty($user) || empty($email) || empty($password)){
				$this->session->set_userdata('msg_s_access', 1);
			}else{
				$this->session->set_userdata('msg_s_access', 2);
				$this->session->set_userdata('account_id_sales', $user->account_id);
				$this->session->set_userdata('account_sales', $user);
				redirect(base_url() . 'sales/home');
			}
		}
		redirect(base_url() . 'sales');
	}

}

?>