<?php 

class Notification_model extends CI_Model{
	
	function getNotificationProjectByLastUpdated(){
		$sql = "
		SELECT
				
		pp.project_id,
		pp.project_name,
		bp.business_id,
		bp.business_name,
		pp.project_live,
		pp.project_posted,
		pp.lastupdate,
		pp.project_period,
		pp.project_period_int,
		
		DATE_FORMAT(pp.lastupdate,'%d %b %Y') lastupdate_string
		
		FROM
		project__profile pp
		JOIN business__profile bp ON
			pp.business_id = bp.business_id
		WHERE 1
		
		AND pp.lastupdate > DATE_SUB(CURDATE(), INTERVAL 2 WEEK)
		
		ORDER BY pp.lastupdate DESC
		";
		
		$result = $this->db->query($sql)->result();
		$return = array();
		foreach($result as $k=>$v){
			$return[$v->lastupdate_string][] = $v;
		}
		
		return $return;
	}
	
	function getNotificationProjectByLastPosted(){
		$sql = "
		SELECT
				
		pp.project_id,
		pp.project_name,
		bp.business_id,
		bp.business_name,
		pp.project_live,
		pp.project_posted,
		pp.lastupdate,
		pp.project_period,
		pp.project_period_int,
		
		DATE_FORMAT(pp.project_posted,'%d %b %Y') project_posted_string
		
		FROM
		project__profile pp
		JOIN business__profile bp ON
			pp.business_id = bp.business_id
		WHERE 1
		
		AND pp.project_posted > DATE_SUB(CURDATE(), INTERVAL 2 WEEK)
		
		ORDER BY pp.project_posted DESC
		";
		
		$result = $this->db->query($sql)->result();
		$return = array();
		foreach($result as $k=>$v){
			$return[$v->project_posted_string][] = $v;
		}
		
		return $return;
	}
	
}

?>