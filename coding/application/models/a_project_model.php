<?php 

class A_project_model extends CI_Model{
	
	var $start = 0;
	var $limit = 10;
	var $page = 0;
	function getProject($param_url = array(), $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
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
			if (!empty($param_url['project_status']) && ($param_url['project_status'] != "All")){
				$where .= " AND pp.project_live = '".$param_url['project_status']."' ";
			}
		}
		
		$sql = "
		SELECT
		
		SQL_CALC_FOUND_ROWS
		
		pp.project_id,
		pp.project_name,
		bp.business_id,
		bp.business_name,
		pp.project_live,
		pp.project_posted,
		pp.project_period,
		pp.project_period_int
		
		FROM
		project__profile pp
		JOIN business__profile bp ON
			pp.business_id = bp.business_id
		WHERE 1
		
		$where
		
		ORDER BY pp.project_posted DESC
		" . $limited;
				
		return $this->db->query($sql)->result();
	}	

	public function countGetdata()	
	{
		 return (int) $this->db->query("SELECT FOUND_ROWS() AS total")->row()->total;	
	}
	
	function getProjectDetail($project_id){
		$sql = "
		SELECT
		pp.project_id,
		pp.project_uri,
		pp.project_name,
		pp.project_description,
		pp.project_primary_photo,
		pp.project_period,
		pp.project_period_int,
		pp.project_prize_detail,
		pp.project_prize_category,
		pp.project_tags,
		pp.project_actions_data,
		pp.project_hashtags,
		pp.project_live,
		pp.project_active,
		pp.project_posted,
		pp.business_id,
		pp.jml_winner,
		bp.business_name,
		brm.account_id
		FROM
		project__profile pp
		JOIN business__profile bp ON
			bp.business_id = pp.business_id
		JOIN business__rel_member brm ON
			brm.business_id = bp.business_id
		WHERE 1
		AND pp.project_id = ?
		";
		return $this->db->query($sql, array($project_id))->row();
	}
	
	function getProjectActiveWinner($param_url = array(), $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
		
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
		if (!empty($param_url['business_id'])){
			$where .= " AND bp.business_id = '". $param_url['business_id'] ."' ";
		}
		
		if (!empty($param_url['search_by']) && !empty($param_url['q'])){
			if ($param_url['search_by'] != "both"){
				$where .= " AND ( ". $param_url['search_by'] ." LIKE '%". $param_url['q'] ."%' ) ";
			}else{
				$where .= " AND ( pp.project_name LIKE '%". $param_url['q'] ."%' OR bp.business_name LIKE '%". $param_url['q'] ."%' ) ";
			}
		}
		
		$sql = "
		SELECT
		SQL_CALC_FOUND_ROWS
		pp.project_name,
		pp.project_id,
		bp.business_name,
		bp.business_id,
		pp.project_period,
        ma.account_id,
        ma.account_name,
        ma.account_email, 
        IFNULL(x.jml_tiket,0) jml_tiket
		FROM
		project__profile pp
		JOIN business__profile bp ON
			pp.business_id = bp.business_id
		JOIN business__rel_member brm ON
			brm.business_id = bp.business_id
		JOIN member__account ma ON
			ma.account_id = brm.account_id
        LEFT JOIN 
			(SELECT 
				project_id, 
				COUNT(tiket_barcode) jml_tiket 
				FROM project__tiket pt 
				WHERE 1 GROUP BY project_id
			) x ON x.project_id = pp.project_id
		WHERE 1
		AND pp.project_live = ?
		AND pp.project_active = 1
		$where
        GROUP BY x.project_id
		ORDER BY `pp`.`project_name`  ASC
		" . $limited;
		
		$results = $this->db->query($sql, array($param_url['project_live']))->result();
		return $results;
	}
	
	function getMemberProjectActiveWinner($project_id){
		$sql = "
		SELECT
		pt.tiket_id,
		pt.tiket_barcode,
		ma.account_id,
		ma.account_name,
		ma.phone_number,
		pp.project_name,
		ma.account_email,
		cs.social_data,
		cs.social_name,
		ma.address,
		ap.province_name, 
		ak.kecamatan_name
		FROM
		project__tiket pt
		JOIN member__account ma ON
			ma.account_id = pt.account_id
		JOIN project__profile pp ON
			pp.project_id = pt.project_id
		JOIN connect__socialmedia cs ON
			cs.account_id = ma.account_id
		LEFT JOIN address__province ap ON 
			ap.province_id = ma.province_id
		LEFT JOIN address__kecamatan ak ON 
			ak.kecamatan_id = ma.kecamatan_id
		WHERE 1
		AND pt.project_id = ?
		ORDER BY pt.iswin DESC, ma.account_name ASC
		";
		$results = $this->db->query($sql, array($project_id))->result();
		return $results;
	}
	
	function getMemberWinProjectActiveWinner($project_id){
		$sql = "
		SELECT
		pt.tiket_id,
		pt.tiket_barcode,
		pt.voucher_data,
		pt.voucher_data_int,
		pp.project_id,
		pp.project_name,
		pp.project_description,
		pp.project_uri,
		ma.account_id,
		ma.account_type,
		ma.account_name,
		ma.account_email,
		ma.phone_number,
		ma.address,
		ap.province_name, 
		ak.kecamatan_name
		FROM
		project__tiket pt
		JOIN member__account ma ON
			ma.account_id = pt.account_id
		JOIN project__profile pp ON
			pp.project_id = pt.project_id
		LEFT JOIN address__province ap ON 
			ap.province_id = ma.province_id
		LEFT JOIN address__kecamatan ak ON 
			ak.kecamatan_id = ma.kecamatan_id
		WHERE 1
		AND pt.project_id = ?
		AND pt.iswin = 1
		";
		$results = $this->db->query($sql, array($project_id))->result();
		$return = array();
		foreach($results as $k=>$v){
			$return[$v->account_id] = $v;
		}
		return $return;
	}
	
	function getRandomMemberWinner($project_id, $not_account_id, $limit = 1){
		$sql = "
		SELECT
		pt.tiket_barcode,
		ma.account_name,
		pp.project_name,
		ma.account_email,
		ma.phone_number,
		pt.tiket_id,
		pp.project_id,
		ma.account_id,
		ma.address,
		ap.province_name, 
		ak.kecamatan_name
		FROM
		project__tiket pt
		JOIN member__account ma ON
			ma.account_id = pt.account_id
		JOIN project__profile pp ON
			pp.project_id = pt.project_id
		LEFT JOIN address__province ap ON 
			ap.province_id = ma.province_id
		LEFT JOIN address__kecamatan ak ON 
			ak.kecamatan_id = ma.kecamatan_id
		WHERE 1
		AND pt.project_id = ?
		AND ma.account_id != ?
		AND pt.iswin = 0
		ORDER BY RAND() LIMIT $limit
		";
		$results = $this->db->query($sql, array($project_id, $not_account_id))->result();
		return $results;
	}
	
	function getDataWinnerAccountByTiketId($tiket_id){
		$sql = "
		SELECT
		ma.account_email,
		ma.account_name,
		ppz.prize_name,
        bp.business_name
		FROM
		project__tiket pt
		JOIN member__account ma ON
			ma.account_id = pt.account_id
		JOIN project__prize pp ON
			pp.project_id = pt.project_id
		JOIN prize__profile ppz ON
			ppz.prize_id = pp.prize_id
        JOIN project__profile ppp ON
            ppp.project_id = pp.project_id
        JOIN business__profile bp ON
            bp.business_id = ppp.business_id
		WHERE 1
		AND pt.tiket_id = ?
		";
		return $this->db->query($sql, array($tiket_id))->row();
	}
	
	function registerProject($data = array(), $project_id = ''){
		if (empty($project_id)){
			$this->db->insert('project__profile', $data);
			$project_id = $this->db->insert_id();
		}else{
			$this->db->update('project__profile', $data, array(
				'project_id' => $project_id
			));
		}
		return $project_id;
	}
	
}

?>