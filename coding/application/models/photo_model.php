<?php 

class Photo_model extends CI_Model{
	
	function addPhotoTemp($data){
		$this->db->insert('project__photo_temp', $data);
	}
	
	function getPhotoTemp($token, $business_id){
		$sql = "
		SELECT 
		GROUP_CONCAT(ppt.photo SEPARATOR '/:/') photos
		FROM
		project__photo_temp ppt
		WHERE 1
		AND ppt.token = ?
		AND ppt.business_id = ?
		AND ppt.isactive = 0
		ORDER BY ppt.tid ASC
		";
		$return = $this->db->query($sql, array($token, $business_id))->row();
		if (empty($return)) return array();
		return $return->photos;
	}
	
	function setPhotoTempNonActive($token, $business_id){
		$sql = "
		UPDATE project__photo_temp SET
		isactive = 1
		WHERE 1
		AND token = ?
		AND business_id = ?
		";
		$this->db->query($sql, array($token, $business_id));
	}
	
}

?>