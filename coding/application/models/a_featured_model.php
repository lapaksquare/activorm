<?php 

class A_featured_model extends CI_Model{
	
	function getBusinessAll(){
		$sql = "
		SELECT
		bp.business_id,
		bp.business_name,
		brm.account_id
		FROM
		business__profile bp
		JOIN business__rel_member brm ON
			brm.business_id = bp.business_id
		WHERE 1
		AND bp.business_live = 'Online'
		AND bp.business_active = 1
		ORDER BY bp.business_name ASC
		";
		return $this->db->query($sql)->result();
	}
	
	function getPrizeAll(){
		$sql = "
		SELECT
		pp.prize_name,
		pp.prize_id
		FROM
		prize__profile pp
		WHERE 1
		AND pp.isactive = 1
		ORDER BY pp.prize_name ASC
		";
		return $this->db->query($sql)->result();
	}
	
	function getProjectAll($business_id){
		$sql = "
		SELECT
		pp.project_id,
		pp.project_name
		FROM
		project__profile pp
		WHERE 1
		AND pp.business_id = ?
		AND pp.project_active = 1
		";
		return $this->db->query($sql, array($business_id))->result();
	}
	
	function registerConfigFeaturedHomePagePrize($config){
		$this->db->update("config", array(
			'config_data' => $config
		), array(
			'config_name' => 'featured__homepage_prize'
		));
	}
	
	function registerFeaturedHomePagePrize($config){
		$this->db->update("featured", array(
			'featured_detail' => $config
		), array(
			'featured_name' => 'featured__homepage_prize'
		));
	}
	
	function registerFeaturedHomePageLogo($config){
		$this->db->update("featured", array(
			'featured_detail' => $config
		), array(
			'featured_name' => 'featured__homepage_logomerchant'
		));
	}
	
	function getConfigFeaturedHomePagePrize(){
		$sql = "
		SELECT
		c.config_data
		FROM
		config c
		WHERE 1
		AND c.config_name = 'featured__homepage_prize'
		";
		return $this->db->query($sql)->row();
	}
	
	function getFeaturedHomePagePrize(){
		$sql = "
		SELECT
		f.featured_detail
		FROM
		featured f
		WHERE 1
		AND f.featured_name = 'featured__homepage_prize'
		";
		$r = $this->db->query($sql)->row();
		if (empty($r->featured_detail)) return array();
		return $r->featured_detail;
	}
	
	function getFeaturedHomePageLogo(){
		$sql = "
		SELECT
		f.featured_detail
		FROM
		featured f
		WHERE 1
		AND f.featured_name = 'featured__homepage_logomerchant'
		";
		$r = $this->db->query($sql)->row();
		if (empty($r->featured_detail)) return array();
		return $r->featured_detail;
	}
	
	function getFeaturedProductSelected($business_id, $project_id){
		$sql = "
		SELECT
		pp.project_id,
		pp.project_name,
		bp.business_id,
		bp.business_name
		FROM
		project__profile pp
		JOIN business__profile bp ON
			bp.business_id = pp.business_id
		WHERE 1
		AND pp.project_id = ?
		AND pp.business_id = ?
		";
		return $this->db->query($sql, array($project_id, $business_id))->row();
	}
	
	function getFeaturedBusinessSelected($business_id){
		$sql = "
		SELECT
		bp.business_id,
		bp.business_name,
		bp.merchant_logo,
		brm.account_id,
		bp.website,
		bp.contact_number,
		ma.account_email
		FROM
		business__profile bp
		JOIN business__rel_member brm ON
			bp.business_id = brm.business_id
		JOIN member__account ma ON
			ma.account_id = brm.account_id
		WHERE 1
		AND bp.business_id = ?
		";
		return $this->db->query($sql, array($business_id))->row();
	}
	
	function getFeaturedPrizeSelected($prize_id){
		$sql = "
		SELECT
		pp.prize_id,
		pp.prize_name
		FROM
		prize__profile pp 
		WHERE 1
		AND pp.prize_id = ?
		";
		return $this->db->query($sql, array($prize_id))->row();
	}
	
}

?>