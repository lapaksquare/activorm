<?php 

class Featured_model extends CI_Model{
	
	function getFeaturedData($index){
		$sql = "
		SELECT
		f.featured_detail
		FROM 
		featured f
		WHERE 1
		AND f.featured_name = ?
		";
		$result = $this->db->query($sql, array($index))->row();
		if (empty($result)) return array();
		return json_decode($result->featured_detail);
	}
	
	function getFeaturedProductHomePage($data_featured_isi, $type = "project"){
		
		$where_in = "";
		if (!empty($data_featured_isi)){
			$where_in = implode(", ", $data_featured_isi);
		}
		
		$sql = "
		SELECT
		pp.project_id,
		pp.project_name,
		pp.project_description,
		pp.project_uri,
		pp.project_primary_photo,
		pppp.prize_primary_photo
		FROM
		project__profile pp
		JOIN project__prize ppp ON
			ppp.project_id = pp.project_id
		JOIN prize__profile pppp on
			pppp.prize_id = ppp.prize_id
		WHERE 1
		AND pp.project_id IN ($where_in)
		AND pp.project_active = 1 
		ORDER BY FIELD(pp.project_id, $where_in)
		";
		
		return $this->db->query($sql)->result();
	}
	
	function getMerchantLogoHomePage($data_featured_isi){
		$where_in = "";
		if (!empty($data_featured_isi)){
			$where_in = implode(", ", $data_featured_isi);
		}
		$sql = "
		SELECT
		bp.business_name,
		bp.business_uri,
		ma.account_primary_photo,
		bp.merchant_logo
		FROM
		business__profile bp
		JOIN business__rel_member brm ON
			bp.business_id = brm.business_id
		JOIN member__account ma ON
			ma.account_id = brm.account_id
		WHERE 1
		AND bp.business_id IN ($where_in)
		ORDER BY FIELD(bp.business_id, $where_in)
		";
		return $this->db->query($sql)->result();
	}
	
}

?>