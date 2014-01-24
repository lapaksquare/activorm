<?php 

class Point_model extends CI_Model{
	
	function getPointProfileActive(){
		$sql = "
		SELECT
		pp.*
		FROM
		points__profile pp
		WHERE 1 
		AND pp.isactive = 1
		";
		return $this->db->query($sql)->result();
	}
	
	function getAccountPoint($account_id){
		$sql = "
		SELECT
		mp.point
		FROM 
		member__points mp
		WHERE 1
		AND mp.account_id = ?
		";
		$result = $this->db->query($sql, array($account_id))->row();
		if (empty($result)){
			return 0;
		}
		return $result->point;
	}
	
	function getPointByPointId($pid){
		$sql = "
		SELECT
		pp.*
		FROM
		points__profile pp 
		WHERE 1
		AND pp.point_id = ?
		";
		return $this->db->query($sql, array($pid))->row();
	}
	
	function updateMemberPoint($data = array(), $account_id){
		$this->db->update('member__points', $data, array(
			'account_id' => $account_id
		));
	}
	
}

?>