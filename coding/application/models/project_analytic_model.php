<?php 

class Project_analytic_model extends CI_Model {
	
	function checkProjectAnalytic($project_id, $ip_address){
		$sql = "
		SELECT
		pa.*
		FROM project__analytic pa
		WHERE 1
		AND pa.project_id = ?
		AND pa.ip_address = ?
		";
		return $this->db->query($sql, array($project_id, $ip_address))->row();
	}
	
	function addProjectAnalytic($data = array()){
		$project = $this->checkProjectAnalytic($data['project_id'], $data['ip_address']);
		if (empty($project)){
			$this->db->insert('project__analytic', $data);
		}else{
			$this->db->update('project__analytic', $data, array(
				'analytic_id' => $project->analytic_id
			));
		}
	}
	
	function currentProjectClick($project_id){
		$sql = "
		SELECT
		pc.jml_click,
		pc.page_views
		FROM
		project__click pc
		WHERE 1
		AND pc.project_id = ?
		";
		$result = $this->db->query($sql, array($project_id))->row();
		if (empty($result)) return array();
		return $result;
	}
	
	function currentPrizeClick($prize_id){
		$sql = "
		SELECT
		pc.jml_click
		FROM
		prize__click pc
		WHERE 1
		AND pc.prize_id = ?
		";
		$result = $this->db->query($sql, array($prize_id))->row();
		if (empty($result)) return array();
		return $result;
	}
	
	function registerProjectClick($click, $page_views, $project_id){
		$project = $this->currentProjectClick($project_id);
		if (empty($project)){
			$this->db->insert("project__click", array(
				'project_id' => $project_id,
				'jml_click' => $click,
				'page_views' => $page_views
			));
		}else{
			$this->db->update("project__click", array(
				'jml_click' => $click,
				'page_views' => $page_views
			), array(
				'project_id' => $project_id
			));
		}
	}

	function registerPrizeClick($click, $prize_id){
		$prize = $this->currentPrizeClick($prize_id);
		if (empty($prize)){
			$this->db->insert("prize__click", array(
				'prize_id' => $prize_id,
				'jml_click' => $click
			));
		}else{
			$this->db->update("prize__click", array(
				'jml_click' => $click
			), array(
				'prize_id' => $prize_id
			));
		}
	}
	
	function project_click($project_id){
		$currentProjectClick = $this->currentProjectClick($project_id);
		$jml_click = $page_views = 0;
		if (!empty($currentProjectClick)){
			$jml_click = $currentProjectClick->jml_click;
			$page_views = $currentProjectClick->page_views;
		}
		$click = $jml_click + 1;
		$page_views = $page_views + 1;
		$this->registerProjectClick($click, $page_views, $project_id);
	}
	
	function prize_click($prize_id){
		$currentPrizeClick = $this->currentPrizeClick($prize_id);
		$jml_click = 0;
		if (!empty($currentPrizeClick)){
			$jml_click = $currentPrizeClick->jml_click;
		}
		$click = $jml_click + 1;
		$this->registerPrizeClick($click, $prize_id);
	}
	
	function getTrendPrizeData(){
		$sql = "
		SELECT
		pc.jml_click,
		pp.prize_name
		FROM
		prize__click pc
		JOIN prize__profile pp ON
			pc.prize_id = pp.prize_id
		WHERE 1
		ORDER BY pc.jml_click DESC
		";
		return $this->db->query($sql)->result();
	}
	
}

?>