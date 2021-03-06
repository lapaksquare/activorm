<?php 

class Socialmedia_model extends CI_Model{
	
	function insertLogSocialMedia($data){
		$cek = $this->getSocialMediaConnect($data['account_id'], $data['social_name']);
		if (empty($cek)){
			$this->db->insert('connect__socialmedia', $data);
		}else{
			$this->db->update('connect__socialmedia', $data, array(
				'social_id' => $cek->social_id
			));
		}
	}
	
	function updateLogSocialMedia($where, $data){
		$this->db->update('connect__socialmedia', $data, $where);
	}
	
	function socialmedia_connect($account_id){
		$sql = "
		SELECT
		cs.social_id,
		cs.account_id,
		cs.social_name,
		cs.social_data,
		cs.social_oauth_data,
		cs.social_page_data,
		cs.social_page_active,
		cs.social_active
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
		cs.social_id,
		cs.account_id,
		cs.social_name,
		cs.social_data,
		cs.social_oauth_data,
		cs.social_page_data,
		cs.social_page_active,
		cs.social_active
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