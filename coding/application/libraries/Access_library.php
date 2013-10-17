<?php 

class Access_library{
	
	var $CI = "";
	function __construct(){
		$this->CI =& get_instance();
	}
	
	function accessAdmin($email, $password, $withPassword = TRUE){
		$this->CI->load->model('access_model');
		$flag = 1;
		if ($withPassword == TRUE && !empty($password)) {
			$user = $this->CI->access_model->getAccount($email, $password);
			if (!empty($user)) {
				// save to session
				$this->CI->session->set_userdata('account', $user);
				$this->CI->session->set_userdata('account_id', $user->account_id);
				$flag = 0;
			}
		}
		
		if ($flag == 1){
			$this->CI->session->set_userdata('msg_error_access', "OMG!... Something Error.");
		}
		
		return TRUE;
	}
	
	function removeAccessSession(){
		$this->CI->session->unset_userdata('account');
		$this->CI->session->unset_userdata('account_id');
	}
	
}

?>