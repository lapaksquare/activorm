<?php 

class A_prize_model extends CI_Model{
	
	function getPrizeProfile($param_url = array(), $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
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
		
		$where = "";
		if (!empty($param_url)){
			if (!empty($param_url['search_by']) && !empty($param_url['q'])){
				$where .= " AND " . $param_url['search_by'] . " LIKE '%". $param_url['q'] ."%' ";
			}
		}
		
		$sql = "
		SELECT
		SQL_CALC_FOUND_ROWS
		
		pp.lastupdate,
		pp.prize_id,
		pp.prize_name,
		pp.prize_primary_photo,
		pp.isactive,
		ppp.project_id,
		ppp.business_id,
		ppp.project_name,
		bp.business_id,
		bp.business_name
		
		FROM
		prize__profile pp
		LEFT JOIN project__prize rpp ON
			rpp.prize_id = pp.prize_id
		LEFT JOIN project__profile ppp ON
			ppp.project_id = rpp.project_id
		LEFT JOIN business__profile bp ON
			bp.business_id = ppp.business_id	
		WHERE 1	
		
		$where
		
		AND pp.status = 'active'
		
		ORDER BY pp.lastupdate DESC
		" . $limited;
		
		return $this->db->query($sql)->result();
	}
	
	public function countGetdata()	
	{
		 return (int) $this->db->query("SELECT FOUND_ROWS() AS total")->row()->total;	
	}
	
	function getBusinessAll(){
		$sql = "
		SELECT
		bp.business_id,
		bp.business_name
		FROM
		business__profile bp
		WHERE 1
		AND bp.business_live = 'Online'
		AND bp.business_active = 1
		ORDER BY bp.business_name ASC
		";
		return $this->db->query($sql)->result();
	}
	
	function getProjectAll(){
		$sql = "
		SELECT
		pp.project_id,
		pp.project_name
		FROM
		project__profile pp
		WHERE 1
		AND pp.project_live = 'Online'
		AND pp.project_active = 1
		ORDER BY pp.project_name ASC
		";
		return $this->db->query($sql)->result();
	}
	
	function getPrizeProfileSelected($prize_id, $project_id){
			
		$where = "";
		if (!empty($project_id)){
			$where .= " AND ppp.project_id = '$project_id' ";
		}	
		
		$sql = "
		SELECT
		
		pp.lastupdate,
		pp.prize_id,
		pp.prize_name,
		pp.prize_primary_photo,
		pp.isactive,
		pp.status,
		ppp.project_id,
		ppp.business_id,
		ppp.project_name,
		bp.business_id,
		bp.business_name
		
		FROM
		prize__profile pp
		LEFT JOIN project__prize rpp ON
			rpp.prize_id = pp.prize_id
		LEFT JOIN project__profile ppp ON
			ppp.project_id = rpp.project_id
		LEFT JOIN business__profile bp ON
			bp.business_id = ppp.business_id	
		WHERE 1	
		AND pp.prize_id = ?
		$where
		";
		
		return $this->db->query($sql, array($prize_id))->row();
	}
	
	function registerPrize($data = array(), $prize_id = ""){
		if (empty($prize_id)){
			$this->db->insert('prize__profile', $data);
			$prize_id = $this->db->insert_id();
		}else{
			$this->db->update('prize__profile', $data, array(
				'prize_id' => $prize_id
			));
		}
		return $prize_id;
	}
	
	function checkPrizeRelProject($prize_id, $project_id){
		$sql = "
		SELECT
		pp.*
		FROM
		project__prize pp
		WHERE 1
		AND pp.prize_id = ?
		AND pp.project_id = ?
		";
		return $this->db->query($sql, array($prize_id, $project_id))->row();
	}
	
	function registerPrizeRelProject($prize_id, $project_id, $ppid){
		$r = $this->checkPrizeRelProject($prize_id, $ppid);
		if (empty($r)){
			$this->db->insert('project__prize', array(
				'prize_id' => $prize_id,
				'project_id' => $project_id
			));
		}else{
			$this->db->update('project__prize', array(
				'project_id' => $project_id
			), array(
				'prize_id' => $prize_id
			));
		}
	}
	
}

?>