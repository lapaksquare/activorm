<?php 

class Banner_model extends CI_Model{
	
	function insertBanner($data = array()){
		$this->db->insert('banner', $data);
	}
	
	function getBannerList(){
		$sql = "
		SELECT
		b.banner_id,
		b.banner_name,
		b.banner_link,
		b.banner_detail,
		b.banner_image,
		b.banner_priority,
		b.isactive
		FROM
		banner b 
		WHERE 1
		ORDER BY b.banner_priority ASC
		";
		return $this->db->query($sql)->result();
	}
	
	function updateBanner($data, $where){
		$this->db->update('banner', $data, $where);
	}
	
	function getBannerActive(){
		$sql = "
		SELECT
		b.banner_id,
		b.banner_name,
		b.banner_link,
		b.banner_detail,
		b.banner_image,
		b.banner_priority,
		b.isactive
		FROM
		banner b
		WHERE 1
		AND b.isactive = 1
		ORDER BY b.banner_priority ASC
		";
		return $this->db->query($sql)->result();
	}
	
}

?>