<?php 

class A_graph_model extends CI_Model{
	
	function getTrafficGraphSignUp($startdate, $enddate){
		$sql = "
		SELECT
		DATE_FORMAT( ma.lastupdate,  '%Y-%m-%d' ) date,
		COUNT( ma.account_id ) jml_member
		FROM
		member__account ma
		WHERE 1
		AND DATE_FORMAT( ma.lastupdate,  '%Y-%m-%d' ) BETWEEN '$startdate' AND '$enddate'
		GROUP BY DATE_FORMAT( ma.lastupdate,  '%Y-%m-%d' )
		";
		return $this->db->query($sql)->result();
	}
	
	function getTrafficGraphSignIn($startdate, $enddate){
		$sql = "
		SELECT
		DATE_FORMAT( mi.lastupdate,  '%Y-%m-%d' ) date,
		COUNT(mi.account_id) jml_member
		FROM
		member__ipaddress mi
		WHERE 1
		AND DATE_FORMAT( mi.lastupdate,  '%Y-%m-%d' ) BETWEEN '$startdate' AND '$enddate'
		AND mi.account_id != 0
		GROUP BY DATE_FORMAT( mi.lastupdate,  '%Y-%m-%d' )
		";
		return $this->db->query($sql)->result();
	}
	
	function getAVGJmlProjectDiIkutiUser(){
		$sql = "
		SELECT
		AVG(jml_project) avg_jml_project
		FROM(
		SELECT
		    pt.account_id account_id,
		    COUNT(pt.tiket_barcode) jml_project
		    FROM
		    project__tiket pt
		    JOIN member__account ma ON
		    	ma.account_id = pt.account_id
		    JOIN project__profile pp ON
		    	pp.project_id = pt.project_id
		    WHERE 1
		    	AND ma.account_live = 'Online'
		    	AND ma.account_active = 1
		    	AND pp.project_live IN ('Online', 'Closed')
		    	AND pp.project_active = 1
		    GROUP BY pt.account_id
		) t
		";
		return $this->db->query($sql)->row()->avg_jml_project;
	}
	
	function getTop3UserActiveKontestProject(){
		$sql = "
		SELECT
		ma.account_id,
		ma.account_name,
		ma.account_email,
	    pt.account_id account_id,
	    COUNT(pt.tiket_barcode) jml_project
	    FROM
	    project__tiket pt
	    JOIN member__account ma ON
	    	ma.account_id = pt.account_id
	    JOIN project__profile pp ON
	    	pp.project_id = pt.project_id	
	    WHERE 1
	    	AND ma.account_live = 'Online'
	    	AND ma.account_active = 1
	    	AND pp.project_live IN ('Online', 'Closed')
	    	AND pp.project_active = 1
	    GROUP BY pt.account_id
		ORDER BY jml_project DESC
		LIMIT 3
		";
		return $this->db->query($sql)->result();
	}
	
}

?>