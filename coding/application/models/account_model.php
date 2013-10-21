<?php 

class Account_model extends CI_Model{
	
	function getAccount($filter = 'ma.account_email', $q){
		
		$where = '';
		if (!empty($filter) && !empty($q)){
			$where .= " AND " . $filter . " = '" . $q ."' ";
		}else return FALSE;
		
		$sql = "
		SELECT
		ma.* 
		FROM member__account ma
		WHERE 1
		$where
		";
		
		return $this->db->query($sql)->row();
		
	}
	
	function logIpAddressUser($data = array()){
		$sql = "
		REPLACE member__ipaddress SET
		account_id = ?,
		ipaddress = ?
		";
		$this->db->query($sql, array($data['account_id'], $data['ipaddress']));
	}
	
	function insertAccount($data = array()){
		$this->db->insert('member__account', $data);
		return $this->db->insert_id();
	}
	
	function registerAccount($data = array()){
		$account_id = $this->session->userdata('account_id');
		if (empty($account_id)){
			$this->db->insert('member__account', $data);
			$account_id = $this->db->insert_id();
		}else{
			$this->db->update('member__account', $data, array(
				'account_id' => $account_id
			));
		}
		return $account_id;
	}
	
	function getAccountLogin($email, $password){
		$sql = "
		SELECT
		ma.*
		FROM member__account ma
		WHERE 1
		AND ma.account_email = ?
		AND ma.account_password = ?
		";
		return $this->db->query($sql, array($email, $password))->row();
	}
		
}

?>