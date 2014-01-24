<?php 

class Rangking_model extends CI_Model{
	
	function getRangkingMerchant(){
		$sql = "
		SELECT
		bp.business_name,
		pp.project_name,
		pp.project_period_int,
		pp.project_actions_data,
		COUNT(pt.tiket_barcode) jml_member_join
		FROM
		business__profile bp
		JOIN project__profile pp ON
			bp.business_id = pp.business_id
		JOIN project__tiket pt ON
			pt.project_id = pp.project_id
		WHERE 1
		AND bp.business_live = 'Online'
		AND bp.business_active = 1
		AND pp.project_live IN ('Online', 'Closed')
		AND pp.project_active = 1
		GROUP BY bp.business_id
		ORDER BY COUNT(pt.tiket_barcode) DESC
		";
		
		return $this->db->query($sql)->result();
	}
	
}

?>