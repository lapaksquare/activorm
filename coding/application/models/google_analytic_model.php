<?php 

class Google_analytic_model extends CI_Model{
	
	function getEndDateTraffic(){
		$sql = "
		SELECT
		MAX( DATE_FORMAT( at.analytic_date,  '%Y-%m-%d' ) ) date
		FROM
		analytic__traffic at
		WHERE 1
		";
		$result = $this->db->query($sql)->row();
		if (empty($result->date)){
			return "2013-10-27";
		}else{
			return date("Y-m-d", strtotime($result->date . " + 1 days "));
		}
	}
	
	function addTrafficWebsite($data){
		$this->db->insert("analytic__traffic", $data);
	}
	
	function addTrafficContent($data){
		$this->db->insert("analytic__content", $data);
	}
	
	function addTrafficData($type, $data){
		$this->db->update('analytic__data', array(
			'analytic_data' => $data
		), array(
			'analytic_name' => $type
		));
	}
	
	function getAnalticsPageProject($project_id){
		$sql = "
		SELECT
		pa.*
		FROM
		project__analytics pa
		WHERE 1
		AND pa.project_id = ?
		";
		return $this->db->query($sql, array($project_id))->row_array();
	}
	function addAnalyticPageProject($data){
		$this->db->insert("project__analytics", $data);
	}
	function updateAnalyticPageProject($data, $project_id){
		$this->db->update('project__analytics', $data, array(
			'project_id' => $project_id
		));
	}
	
	function getTrafficData($type){
		$sql = "
		SELECT
		ad.analytic_data
		FROM
		analytic__data ad
		WHERE 1
		AND ad.analytic_name = ?
		";
		return $this->db->query($sql, array($type))->row()->analytic_data;
	}
	
	function getTrafficWebsite($type_date = "", $startdate = "", $enddate = ""){
		
		$where_dates = "";
		if (!empty($startdate) && !empty($enddate)){
			$where_dates .= " AND at.analytic_date BETWEEN '$startdate' AND '$enddate' ";
		}
		
		if ($type_date == "weekly"){
			$sql = "
			SELECT
			at.analytic_date,
            SUM(at.analytic_visitors) analytic_visitors, 
            SUM(at.analytic_visit) analytic_visit	
			FROM
			analytic__traffic at
			WHERE 1 
			$where_dates
			GROUP BY WEEK(at.analytic_date)
			ORDER BY at.analytic_date ASC";
		}else if ($type_date == "monthly"){
			$sql = "
			SELECT
			DATE_FORMAT(at.analytic_date, '%Y-%m-%d') analytic_date,
            SUM(at.analytic_visitors) analytic_visitors, 
            SUM(at.analytic_visit) analytic_visit
			FROM
			analytic__traffic at
			WHERE 1 
			$where_dates
			GROUP BY month(at.analytic_date), year(at.analytic_date)
			ORDER BY at.analytic_date ASC";
		}else{
			$sql = "
			SELECT
			at.*
			FROM
			analytic__traffic at
			WHERE 1 
			$where_dates
			ORDER BY at.analytic_date ASC
			";
		}
		return $this->db->query($sql)->result();
	}

	function getEndDateTrafficProject($project_id){
		$sql = "
		SELECT
		MAX( DATE_FORMAT( at.analytic_date,  '%Y-%m-%d' ) ) date
		FROM
		analytic__traffic_project at
		WHERE 1
		AND at.project_id = ?
		";
		$result = $this->db->query($sql, array($project_id))->row();
		if (empty($result->date)){
			return "2013-10-27";
		}else{
			return date("Y-m-d", strtotime($result->date . " + 1 days "));
		}
	}
	
	function addTrafficProject($data){
		$this->db->insert("analytic__traffic_project", $data);
	}

	function getTrafficProject($project_id, $type_date = "", $startdate = "", $enddate = ""){
		
		$where_dates = "";
		if (!empty($startdate) && !empty($enddate)){
			$where_dates .= " AND at.analytic_date BETWEEN '$startdate' AND '$enddate' ";
		}
		
		$sql = "
		SELECT
		at.*
		FROM
		analytic__traffic_project at
		WHERE 1 
		AND at.project_id = ?
		$where_dates
		ORDER BY at.analytic_date ASC
		";
		
		return $this->db->query($sql, array($project_id))->result();
	}
	
	function addTrafficDataProject($project_id, $type_data, $data){
		$cek = $this->checkAnalyticProjectData($project_id, $type_data);
		if (empty($cek)){
			$this->db->insert("analytic__project_data", array(
				'project_id' => $project_id,
				'analytic_name' => $type_data,
				'analytic_data' => $data
			));
		}else{
			$this->db->update('analytic__project_data', array(
				'analytic_data' => $data
			), array(
				'project_id' => $project_id,
				'analytic_name' => $type_data
			));
		}
	}
	
	function checkAnalyticProjectData($project_id, $type_data){
		$sql = "
		SELECT
		ap.*
		FROM
		analytic__project_data ap
		WHERE 1
		AND ap.project_id = ?
		AND ap.analytic_name = ?
		";
		return $this->db->query($sql, array($project_id, $type_data))->row();
	}
	
	function getTrafficProjectData($project_id, $type_data){
		$sql = "
		SELECT
		ad.analytic_data
		FROM
		analytic__project_data ad
		WHERE 1
		AND ad.project_id = ?
		AND ad.analytic_name = ?
		";
		$return = $this->db->query($sql, array($project_id, $type_data))->row();
		if (empty($return)) return array();
		return json_decode( $return->analytic_data );
	}
	
}

?>