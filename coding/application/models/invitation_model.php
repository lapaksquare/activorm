<?php 

class Invitation_model extends CI_Model{
	
	function checkMemberInvite($filter = "mai.account_email", $q = ""){
		
		$where = "";
		if (!empty($filter) && !empty($q)){
			$where .= " AND $filter = '$q' ";
		}
		
		$sql = "
		SELECT
		mai.*
		FROM
		member__account_invitation mai
		WHERE 1
		$where
		";
		return $this->db->query($sql)->row();
		
	}
	
	function addMemberInvite($data = array()){
		$c = $this->checkMemberInvite("mai.account_email", $data['account_email']);
		if (empty($c)){
			$this->db->insert('member__account_invitation', $data);
			$account_id = $this->db->insert_id();
		}else{
			$account_id = $c->account_id;
		}
		return $account_id;
	}
	
	function getInvitation($account_email){
		$sql = "
		SELECT
		mai.*
		FROM
		member__account_invitation mai
		WHERE 1
		AND mai.account_email = ?
		";
		return $this->db->query($sql, array($account_email))->row();
	}
	
	function guestInvitation(){
		$sql = "
		SELECT
		mai.*
		FROM
		member__account_invitation mai
		WHERE 1
		AND mai.isactive = 1
		AND mai.account_type <> ''
		ORDER BY mai.account_name ASC
		";
		$results = $this->db->query($sql)->result();
		$return = array();
		foreach($results as $k=>$v){
			$type = (!empty($v->account_type) && $v->account_type == "special_quest") ? 'specialguests' : 'invitation';
			$return[$type][] = $v;
		}
		return $return;
	}
	
	function getInvitationByCustom($account_type = "all", $account_email = ""){
		$where = "";
		if (!empty($account_email)){
			$where .= " AND mai.account_email = '$account_email' ";
		}	
		if ($account_type != "all"){
			$where .= " AND mai.account_type = '$account_type' ";
		}
		$sql = "
		SELECT
		mai.*
		FROM
		member__account_invitation mai
		WHERE 1
		$where
		AND mai.isactive = 1
		";
		return $this->db->query($sql)->result();
	}
	
	function sendInvitationEmail($page){
		//$start = ($page - 1) * 5;
		//$limited = " LIMIT " . $start . " , 5";
		$sql = "
		SELECT
		mai.*
		FROM
		member__account_invitation mai
		WHERE 1
		AND mai.account_type != 'merchant'
		AND mai.isactive = 1
		";//. $limited;
		return $this->db->query($sql)->result();
	}
	
}

?>