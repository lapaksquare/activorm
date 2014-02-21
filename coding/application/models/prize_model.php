<?php 

class Prize_model extends CI_Model{
	
	var $start = 0;
	var $limit = 10;
	var $page = 0;
	function getProductPrize($limit = 10, $start = 0, $page = 0, $nolimit = FALSE, $project_live = 'Online'){
		
		if(empty($start)) {
			$this->start = 0;
		} else {
			$this->start = $start;
		}
		if(empty($limit)) {
			$this->limit = 20;
		} else {
			$this->limit = $limit;
		}
		if(!empty($page) && $page > 0) {
			$this->page = $page;
			$this->start = ($this->page - 1) * $this->limit;
		} else {
			$this->page = 1;
		}	
		
		$limited = "";
		if ($nolimit == FALSE){
			$limited = " LIMIT " . $this->start . " , " .$this->limit;
		}
		
		/*
		$sql = "
		SELECT
		SQL_CALC_FOUND_ROWS
		pp.*
		FROM
		prize__profile pp
		WHERE 1
		AND pp.isactive = 1
		ORDER BY pp.prize_name ASC
		" . $limited; */
		
		$sql = "
		SELECT
		
		SQL_CALC_FOUND_ROWS
		
		ppro.project_name,
		ppro.project_live,
		ppf.*,
        bp.business_name,
        bp.business_uri
		FROM
		project__prize ppr
		JOIN project__profile ppro ON
		ppr.project_id = ppro.project_id
		JOIN prize__profile ppf ON
		ppf.prize_id = ppr.prize_id
        JOIN business__profile bp ON
        bp.business_id = ppro.business_id
		WHERE 1
		AND ppf.isactive = 1
		AND (ppro.project_live = '$project_live')
		AND ppro.project_active = 1
		ORDER BY ppf.priority ASC
		" . $limited;
		
		return $this->db->query($sql)->result();
	}
	
	public function countGetdata()	
	{
		 return (int) $this->db->query("SELECT FOUND_ROWS() AS total")->row()->total;	
	}
	
	function getPrizeProfile($prize_uri){
		$sql = "
		SELECT
		pp.*
		FROM
		prize__profile pp
		WHERE 1
		AND pp.prize_uri = ?
		";
		return $this->db->query($sql, array($prize_uri))->row();
	}
	
	function getProductPrizeRel($prize_id, $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
		if(empty($start)) {
			$this->start = 0;
		} else {
			$this->start = $start;
		}
		if(empty($limit)) {
			$this->limit = 20;
		} else {
			$this->limit = $limit;
		}
		if(!empty($page) && $page > 0) {
			$this->page = $page;
			$this->start = ($this->page - 1) * $this->limit;
		} else {
			$this->page = 1;
		}	
		
		$limited = "";
		if ($nolimit == FALSE){
			$limited = " LIMIT " . $this->start . " , " .$this->limit;
		}
		
		$sql = "
		SELECT
		SQL_CALC_FOUND_ROWS
		pp.*,
		bp.business_name,
		bp.business_uri,
		pphx.photo_id,
		pphx.photo_file
		FROM
		project__profile pp
		JOIN business__profile bp ON
			pp.business_id = bp.business_id
		JOIN project__prize ppr ON
			ppr.project_id = pp.project_id
		LEFT JOIN (
			SELECT
			pph.project_id,
			pph.photo_id,
			pph.photo_file
			FROM 
			project__photo pph
			ORDER BY pph.photo_id ASC
			LIMIT 1
		) pphx ON pphx.project_id = pp.project_id
		WHERE 1
		AND ppr.prize_id = ?
		AND (pp.project_live = 'Online' || pp.project_live = 'Closed')
		AND pp.project_active = 1
		-- AND pp.project_period > NOW()
		ORDER BY pp.project_name ASC
		" . $limited;
		
		return $this->db->query($sql, array($prize_id))->result();
	}
	
	function registerPrize($data){
		$prize = "";
		if (!empty($data['prize_uri'])){
			$prize = $this->getPrizeProfile($data['prize_uri']);
		}
		if ($prize == ""){
			$this->db->insert('prize__profile', $data);
			$prize_id = $this->db->insert_id();
		}else{
			$this->db->update('prize__profile', $data, array(
				'prize_id' => $prize->prize_id
			));
			$prize_id = $prize->prize_id;
		}
		return $prize_id;
	}
	
	function getPrizeProfileTaken($filter = '', $q = '', $prize_id = 0){
		$where = '';
		if (!empty($filter) && !empty($q)){
			$where .= " AND " . $filter . " = '" . $q ."' ";
			if (!empty($prize_id)){
				$where .= " AND pp.prize_id != '". $prize_id ."' ";
			}
		}else if (empty($prize_id)) return FALSE;
		
		$sql = "
		SELECT
		pp.* 
		FROM prize__profile pp
		WHERE 1
		$where
		";
		
		return $this->db->query($sql)->row();
	}
	
	function getPrizeId($project_id){
		$sql = "
		SELECT
		pp.prize_id
		FROM
		project__prize pp
		WHERE 1
		AND pp.project_id = ?
		";
		$result = $this->db->query($sql, array($project_id))->row();
		if (empty($result)) return 0;
		return $result->prize_id;
	}
	
}

?>