<?php 

class Socialmedia_model extends CI_Model{
	
	function insertLogSocialMedia($data){
		$cek = $this->getSocialMediaConnect($data['account_id'], $data['social_name']);
		if (empty($cek)){
			$this->db->insert('connect__socialmedia', $data);
		}
	}
	
	function updateLogSocialMedia($where, $data){
		$this->db->update('connect__socialmedia', $data, $where);
	}
	
	function socialmedia_connect($account_id){
		$sql = "
		SELECT
		cs.*
		FROM
		connect__socialmedia cs
		WHERE 1
		AND cs.account_id = ?
		AND cs.social_active = 1
		";
		$results = $this->db->query($sql, array($account_id))->result();
		$return = array();
		foreach($results as $k=>$v){
			
			$js = json_decode($v->social_data);
			
			if (!property_exists($js, "errors")){
				$return[$v->social_name] = $v;
			}
		}
				
		return $return;
	}
	
	function getSocialMediaConnect($account_id, $type){
		$sql = "
		SELECT
		cs.*
		FROM
		connect__socialmedia cs
		WHERE 1
		AND cs.account_id = ?
		AND cs.social_name = ?
		AND cs.social_active = 1
		";
		$results = $this->db->query($sql, array($account_id, $type))->row();
		return $results;
	}
	
	function deleteSocialMediaConnect($scid){
		$sql = "
		DELETE FROM connect__socialmedia WHERE 1 AND social_id = ?
		";
		$this->db->query($sql, array($scid));
	}
	
}

?>