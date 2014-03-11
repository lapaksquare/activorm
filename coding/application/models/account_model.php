<?php 

class Account_model extends CI_Model{
	
	function getAccount($filter = 'ma.account_email', $q, $account_type = 'user'){
		
		$where_account_type = '';
		if ($account_type != 0){
			$where_account_type = "AND ma.account_type = '$account_type'";
		}
		
		$where = '';
		if (!empty($filter) && !empty($q)){
			$where .= " AND " . $filter . " = '" . $q ."' ";
		}else return FALSE;
		
		$sql = "
		SELECT
		ma.account_id,
		ma.account_type,
		ma.account_name,
		ma.account_email,
		ma.account_password,
		ma.account_temp_password,
		ma.account_primary_photo,
		ma.city_id,
		ma.zip_code,
		ma.gender,
		ma.birthday,
		ma.phone_number,
		ma.card_number,
		ma.address,
		ma.province_id,
		ma.kabupaten_id,
		ma.kecamatan_id,
		ma.kelurahan_id,
		ma.account_live,
		ma.account_active,
		ma.verification_code,
		ma.register_step,
		ma.hash
		FROM member__account ma
		WHERE 1
		$where_account_type
		$where
		";
		
		return $this->db->query($sql)->row();
		
	}
	
	function getAccountTaken($filter = 'ma.account_email', $q, $account_type = 'user', $account_id = ""){
		$where_account_type = '';
		if ($account_type != 0){
			$where_account_type = "AND ma.account_type = '$account_type'";
		}
		
		//$account_id = $this->session->userdata('account_id');
		$account_id_session = $this->session->userdata('account_id');
		if (empty($account_id)){
			$account_id = $account_id_session;
		}
		
		$where = '';
		if (!empty($filter) && !empty($q)){
			$where .= " AND " . $filter . " = '" . $q ."' AND ma.account_id != '$account_id' ";
		}else return FALSE;
		
		$sql = "
		SELECT
		ma.account_id,
		ma.account_type,
		ma.account_name,
		ma.account_email,
		ma.account_password,
		ma.account_temp_password,
		ma.account_primary_photo,
		ma.city_id,
		ma.zip_code,
		ma.gender,
		ma.birthday,
		ma.phone_number,
		ma.card_number,
		ma.address,
		ma.province_id,
		ma.kabupaten_id,
		ma.kecamatan_id,
		ma.kelurahan_id,
		ma.account_live,
		ma.account_active,
		ma.verification_code,
		ma.register_step,
		ma.hash
		FROM member__account ma
		WHERE 1
		$where_account_type
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
	
	function registerAccount($data = array(), $account_id = ""){
		$account_id_session = $this->session->userdata('account_id');
		if (empty($account_id)){
			$account_id = $account_id_session;
		}
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

	function updateAccount($data, $account_id){
		$this->db->update('member__account', $data, array(
			'account_id' => $account_id
		));
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
	
	function registerFBUserInterests($data){
		$interests = $this->checkFBUserInterests($data['cid']);
		if (empty($interests)){
			$this->db->insert('member__interests', $data);
			$interests_id = $this->db->insert_id();
		}else{
			$this->db->update('member__interests', $data, array(
				'interests_id' => $interests->interests_id
			));
			$interests_id = $interests->interests_id;
		}
		return $interests_id;
	}
	
	function checkFBUserInterests($cid){
		$sql = "
		SELECT
		mi.*
		FROM
		member__interests mi 
		WHERE 1
		AND mi.cid = ?
		";
		return $this->db->query($sql, array($cid))->row();
	}
	
	function registerSettingEmail($data){
		$sql = "REPLACE member__email SET
		account_id = ?,
		set1 = ?,
		set2 = ?,
		set3 = ?,
		set4 = ?,
		set5 = ?
		";
		$this->db->query($sql, array($data['account_id'],
		$data['set1'],$data['set2'],$data['set3'],$data['set4'],$data['set5']));
	}
	
	function getSettingMemberEmail($account_id){
		$sql = "
		SELECT
		me.*
		FROM
		member__email me
		WHERE 1
		AND me.account_id = ?
		";
		return $this->db->query($sql, array($account_id))->row_array();
	}
	
	function registerDeleteAccount($data){
		$sql = "
		REPLACE member__delete_account SET
		account_id = ?,
		reason = ?
		";
		$this->db->query($sql, array($data['account_id'], $data['reason']));
	}
		
	function getAccountByHash($hash){
		$sql = "
		SELECT
		ma.account_id,
		ma.account_email,
		ma.hash
		FROM
		member__account ma
		WHERE 1
		AND ma.hash = ?
		";
		return $this->db->query($sql, array($hash))->row();
	}	
		
}

?>