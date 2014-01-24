<?php 

class Dashboard_model extends CI_Model{
	
	var $start = 0;
	var $limit = 10;
	var $page = 0;
	function getBusinessProject($business_id, $param_url = array(), $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
		
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
		
		pp.project_id,
		pp.business_id,
		pp.project_posted,
		pp.project_name,
		pp.project_uri,
		pp.project_period,
		pp.project_period_int,
		pp.project_actions_data,
		pp.premium_plan,
		pp.project_live,
		COUNT(pt.tiket_barcode) member_join,
		pp.premium_plan
		FROM
		project__profile pp
		JOIN project__tiket pt ON
			pt.project_id = pp.project_id
		WHERE 1
		AND pp.business_id = ?
		AND pp.project_live IN ('Online', 'Closed')
		GROUP BY pt.project_id
		ORDER BY pp.project_posted DESC
		" . $limited;
		
		return $this->db->query($sql, array($business_id))->result();
	}
	
	public function countGetdata()	
	{
		 return (int) $this->db->query("SELECT FOUND_ROWS() AS total")->row()->total;	
	}
	
	function getBusinessProjectByProjectId($project_id){
		$sql = "
		SELECT
		SQL_CALC_FOUND_ROWS
		
		pp.project_id,
		pp.business_id,
		pp.project_posted,
		pp.project_name,
		pp.project_period,
		pp.project_period_int,
		pp.project_actions_data,
		pp.premium_plan,
		pp.project_live,

		COUNT(pt.tiket_barcode) member_join,
		pp.premium_plan, 
		x.jml_action1, x.jml_action2, x.jml_action3
		
		FROM
		project__profile pp
		JOIN project__tiket pt ON
			pt.project_id = pp.project_id
		JOIN (
            SELECT pat.project_id, COUNT(pat.action_1) jml_action1,
			COUNT(pat.action_2) jml_action2,
			COUNT(pat.action_3) jml_action3 
			FROM project__actions pat 
			WHERE 1 
			AND pat.action_1 = 1
			AND pat.action_2 = 1
			AND pat.action_3 = 1
			GROUP BY pat.project_id
        ) x ON x.project_id = pp.project_id
		WHERE 1
		AND pp.project_id = ?
		GROUP BY pt.project_id
		";
		
		return $this->db->query($sql, array($project_id))->row();
	}
	
	function getBusinessProjectByProjectUri($projecturi){
		$sql = "
		SELECT
		SQL_CALC_FOUND_ROWS
		
		pp.project_id,
		pp.project_name,
		pp.project_uri,
		pp.project_posted,
		pp.project_period,
		pp.project_actions_data,
		
		ma.verification_code,
		
		COUNT(pt.tiket_barcode) member_join,
		x.jml_action1, x.jml_action2, x.jml_action3
		
		FROM
		project__profile pp
		JOIN project__tiket pt ON
			pt.project_id = pp.project_id
		JOIN business__rel_member brm ON
			brm.business_id = pp.business_id
		JOIN member__account ma ON
			ma.account_id = brm.account_id	
		JOIN (
            SELECT pat.project_id, COUNT(pat.action_1) jml_action1,
			COUNT(pat.action_2) jml_action2,
			COUNT(pat.action_3) jml_action3 
			FROM project__actions pat 
			WHERE 1 
			AND pat.action_1 = 1
			AND pat.action_2 = 1
			AND pat.action_3 = 1
			GROUP BY pat.project_id
        ) x ON x.project_id = pp.project_id
		WHERE 1
		AND pp.project_uri = ?
		AND pp.project_live IN ('Online', 'Closed')
		GROUP BY pt.project_id
		";
		
		return $this->db->query($sql, array($projecturi))->row_array();
	}
	
}

?>