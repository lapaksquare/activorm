<?php 

class Testimonial_model extends CI_Model{
	
	function getTestimonials(){
		$sql = "
		SELECT
		tt.messages,
		ma.account_name,
		pp.project_name,
		ma.account_primary_photo
		FROM
		testimonial tt
		JOIN member__account ma ON
			ma.account_id = tt.account_id
		JOIN project__profile pp ON
			pp.project_id = tt.project_id
		WHERE 1
		AND tt.isactive = 1
		ORDER BY ma.account_name ASC
		";
		return $this->db->query($sql)->result();
	}
	
}

?>