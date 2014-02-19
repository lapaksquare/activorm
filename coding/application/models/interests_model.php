<?php 

class Interests_model extends CI_Model{
	
	function getInterestsCategory(){
		$sql = "
		SELECT mi.category, COUNT( mi.interests_id ) jml_category
		FROM member__interests mi
		WHERE 1 
		GROUP BY mi.category
		ORDER BY jml_category DESC , mi.category ASC 
		";
		return $this->db->query($sql)->result();
	}
	
	function getInterestsName(){
		$sql = "
		SELECT mi.name, COUNT( mi.interests_id ) jml_category
		FROM member__interests mi
		WHERE 1 
		GROUP BY mi.name
		ORDER BY jml_category DESC , mi.name ASC 
		";
		return $this->db->query($sql)->result();
	}
	
}

?>