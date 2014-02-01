<?php 

class Rangking_model extends CI_Model{
	
	function getRangkingMerchant($param_url = array()){

		$sql = "
		SELECT
		bp.business_name,
		pp.project_name,
		pp.project_period_int,
		pp.project_period,
		pp.project_actions_data,
		COUNT(pt.tiket_barcode) jml_member_join,
		pa.pageviews,
		pp.project_uri,
		pp.project_id
		FROM
		business__profile bp
		JOIN project__profile pp ON
			bp.business_id = pp.business_id
		JOIN project__tiket pt ON
			pt.project_id = pp.project_id
		LEFT JOIN project__analytics pa ON
			pa.project_id = pp.project_id
		WHERE 1
		AND bp.business_live = 'Online'
		AND bp.business_active = 1
		AND pp.project_live = ?
		AND pp.project_active = 1
		GROUP BY bp.business_id
		ORDER BY COUNT(pt.tiket_barcode) DESC
		";
		
		return $this->db->query($sql, array($param_url['project_live']))->result();
	}

	public function countGetdata()	
	{
		 return (int) $this->db->query("SELECT FOUND_ROWS() AS total")->row()->total;	
	}
	
}

?>