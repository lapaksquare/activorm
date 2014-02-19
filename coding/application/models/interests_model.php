<?php 

class Interests_model extends CI_Model{
	
	function getInterestsCategory(){
		$sql = "
		SELECT mi.interests_id, mi.category, COUNT( mi.interests_id ) jml_category,
		mir.mip_id
		FROM member__interests mi
		LEFT JOIN member__interests_rel mir ON
			mir.iname = mi.category
		WHERE 1 
		GROUP BY mi.category
		ORDER BY jml_category DESC , mi.category ASC 
		";
		return $this->db->query($sql)->result();
	}
	
	function getInterestsName(){
		$sql = "
		SELECT mi.interests_id, mi.name, COUNT( mi.interests_id ) jml_category,
		mir.mip_id
		FROM member__interests mi
		LEFT JOIN member__interests_rel mir ON
			mir.iname = mi.name
		WHERE 1 
		GROUP BY mi.name
		ORDER BY jml_category DESC , mi.name ASC 
		";
		return $this->db->query($sql)->result();
	}
	
	function getParentInterests(){
		$sql = "
		SELECT
		mip.mip_id,
		mip.mip_name,
		mip.mip_details
		FROM
		member__interests_parent mip
		WHERE 1
		AND mip.mip_isactive = 1
		ORDER BY mip.mip_name ASC
		";
		return $this->db->query($sql)->result();
	}
	
	function registerInterestsRel($interest_id, $name, $mip_id){
		$cek = $this->checkInterestsRel($interest_id, $name);
		if (empty($cek)){
			$this->db->insert('member__interests_rel', array(
				'mip_id' => $mip_id,
				'interest_id' => $interest_id,
				'iname' => $name
			));
		}else{
			$this->db->update('member__interests_rel', array(
				'mip_id' => $mip_id,
				'interest_id' => $interest_id,
				'iname' => $name
			), array(
				'rel_id' => $cek->rel_id
			));
		}
	}
	
	function checkInterestsRel($interest_id, $name){
		$sql = "
		SELECT
		mir.rel_id,
		mir.mip_id,
		mir.interest_id,
		mir.iname
		FROM
		member__interests_rel mir
		WHERE 1
		AND mir.interest_id = ?
		AND mir.iname = ?
		";
		return $this->db->query($sql, array($interest_id, $name))->row();
	}
	
}

?>