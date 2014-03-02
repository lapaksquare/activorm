<?php 

class A_account_model extends CI_Model{
	
	function getAdminAccess($email, $password, $admin_role = 1){
		$sql = "
		SELECT
		ma.account_id,
		ma.account_name,
		ma.account_email,
		ma.account_primary_photo,
		mrr.role_id,
		mrr.access_list,
		mrr.access_list_detail
		FROM
		member__account ma 
		JOIN member__rel_role mrr ON
			ma.account_id = mrr.account_id
		WHERE 1
		AND mrr.role_id = ?
		AND ma.account_email = ?
		AND ma.account_password = ?
		";
		return $this->db->query($sql, array($admin_role, $email, $password))->row();
	}
	
	var $start = 0;
	var $limit = 10;
	var $page = 0;
	function getMembers($account_type = 'user', $param_url = array(), $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
		
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
		
		$where = $order_by = $sort_by = "";
		
		if ($account_type == "user"){
			$order_by = "ORDER BY ma.account_name ASC";
		}else if ($account_type == "business"){
			$order_by = "ORDER BY bp.business_name ASC";
		}
		
		if (!empty($param_url)){
			if (!empty($param_url['search_by']) && !empty($param_url['q'])){
				$where .= " AND " . $param_url['search_by'] . " LIKE '%". $param_url['q'] ."%' ";
			}
			if (!empty($param_url['order_by']) && !empty($param_url['sort_by'])){
				$sort_by = (!empty($param_url['sort_by'])) ? $param_url['sort_by'] : 'asc';
				$order_by = "ORDER BY " . $param_url['order_by'] . " " . $sort_by;
			}
		}
		
		if ($account_type == "user"){
			$sql = "
			SELECT
			SQL_CALC_FOUND_ROWS
			ma.account_id,
			ma.account_name,
			ma.account_email,
			ma.account_live
			FROM
			member__account ma
			WHERE 1
			AND ma.account_type = 'user'
			AND ma.account_email != ''
			$where
			$order_by
			" . $limited;
		}else if ($account_type == "business"){
			$sql = "
			SELECT
			SQL_CALC_FOUND_ROWS
			bp.business_id,
			bp.business_name,
			ma.account_id,
			ma.account_email,
			ma.account_live,
			IFNULL(mp.point, 0) point,
			IFNULL(pf.jml_free, 0) jml_free_plan
			FROM
			business__profile bp
			JOIN business__rel_member brm ON
				bp.business_id = brm.business_id
			JOIN member__account ma ON
				ma.account_id = brm.account_id
			LEFT JOIN member__points mp ON
				mp.account_id = ma.account_id
			LEFT JOIN project__freeplan pf ON
				pf.account_id = mp.account_id
			WHERE 1
			AND ma.account_type = 'business'
			AND ma.account_email != ''
			$where
			GROUP BY bp.business_id
			$order_by
			" . $limited;
		}
				
		return $this->db->query($sql)->result();
	}
	
	public function countGetdata()	
	{
		 return (int) $this->db->query("SELECT FOUND_ROWS() AS total")->row()->total;	
	}
	
	function getMemberByAccountId($account_id){
		$sql = "
		SELECT
		ma.account_id,
		ma.account_name,
		ma.account_email,
		ma.account_primary_photo,
		ma.city_id,
		ma.zip_code,
		ma.gender,
		ma.birthday,
		ma.phone_number,
		ma.card_number,
		ma.address,
		ma.province_id,
		ma.kabupaten_id,
		ma.kecamatan_id,
		ma.kelurahan_id,
		ma.account_live,
		ma.account_active,
		ma.verification_code,
		ma.register_step
		FROM
		member__account ma
		WHERE 1
		AND ma.account_id = ?
		";
		return $this->db->query($sql, array($account_id))->row();
	}
	
	function getMemberBusinessByAccountId($account_id){
		$sql = "
		SELECT
		ma.account_id,
		ma.account_name,
		ma.account_email,
		ma.account_primary_photo,
		ma.city_id,
		ma.zip_code,
		ma.gender,
		ma.birthday,
		ma.phone_number,
		ma.card_number,
		ma.address,
		ma.province_id,
		ma.kabupaten_id,
		ma.kecamatan_id,
		ma.kelurahan_id,
		ma.account_live,
		ma.account_active,
		ma.verification_code,
		ma.register_step,
		
		bp.business_id,
		bp.business_name,
		bp.business_uri,
		bp.business_description,
		bp.business_billing_address,
		bp.business_needs,
		bp.contact_person,
		bp.contact_number,
		bp.position_inthe_company,
		bp.website,
		bp.merchant_logo,
		ma.account_temp_password,
		ma.account_password
		
		FROM
		member__account ma
		JOIN business__rel_member brm ON
			ma.account_id = brm.account_id
		JOIN business__profile bp ON
			bp.business_id = brm.business_id
		WHERE 1
		AND ma.account_id = ?
		";
		return $this->db->query($sql, array($account_id))->row();
	}
	
	function getMembersPoint($param_url = array(), $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
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
		
		$where = $order_by = $sort_by = "";
		
		if (!empty($param_url)){
			if (!empty($param_url['search_by']) && !empty($param_url['q'])){
				$where .= " AND " . $param_url['search_by'] . " LIKE '%". $param_url['q'] ."%' ";
			}
		}
		
		$sql = "
		SELECT
		SQL_CALC_FOUND_ROWS
		
		bp.business_id,
		bp.business_name,
		ma.account_id,
		ma.account_email,
		ma.account_live,
		IFNULL(mp.point, 0) point
		
		FROM
		member__points mp
		JOIN member__account ma ON
			ma.account_id = mp.account_id
		JOIN business__rel_member brm ON
			brm.account_id = ma.account_id
		JOIN business__profile bp ON
			bp.business_id = brm.business_id
		WHERE 1
		$where
		" . $limited;
		
		return $this->db->query($sql)->result();
		
	}
	
}

?>