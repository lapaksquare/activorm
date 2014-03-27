<?php 

class Business_model extends CI_Model{
	
	function getBusiness($filter = '', $q = '', $rel_account_id = 0, $business_id = 0){
		$where = '';
		if (!empty($filter) && !empty($q)){
			$where .= " AND " . $filter . " = '" . $q ."' ";
		}else if (empty($rel_account_id)) return FALSE;
		
		$rel_join = "";
		$rel_where = "";
		if ($rel_account_id > 0){
			$rel_join = "JOIN business__rel_member bm ON bm.business_id = bp.business_id";
			$rel_where = "AND bm.account_id = '$rel_account_id'";
		}
		
		$sql = "
		SELECT
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
		bp.business_live,
		bp.business_active,
		bp.show_homepage
		FROM business__profile bp
		$rel_join
		WHERE 1
		$where
		$rel_where
		";
		
		return $this->db->query($sql)->row();
	}
	
	function getBusinessProfile($filter = '', $q = ''){
		$where = '';
		if (!empty($filter) && !empty($q)){
			$where .= " AND " . $filter . " = '" . $q ."' ";
		}
		$sql = "
		SELECT
		bp.*,
		ma.account_primary_photo,
		ma.account_id
		FROM
		business__profile bp
		JOIN business__rel_member bm ON bm.business_id = bp.business_id
		JOIN member__account ma ON ma.account_id = bm.account_id
		WHERE 1
		$where
		AND bp.business_live = 'Online'
		AND bp.business_active = 1
		AND ma.account_live = 'Online'
		AND ma.account_active = 1
		";
		return $this->db->query($sql)->row();
	}
	
	function getBusinessTaken($filter = '', $q = '', $rel_account_id = 0, $business_id = 0){
		$where = '';
		if (!empty($filter) && !empty($q)){
			$where .= " AND " . $filter . " = '" . $q ."' ";
			if (!empty($business_id)){
				$where .= " AND bp.business_id != '". $business_id ."' ";
			}
		}else if (empty($rel_account_id)) return FALSE;
		
		$rel_join = "";
		$rel_where = "";
		if ($rel_account_id > 0){
			$rel_join = "JOIN business__rel_member bm ON bm.business_id = bp.business_id";
			$rel_where = "AND bm.account_id = '$rel_account_id'";
		}
		
		$sql = "
		SELECT
		bp.* 
		FROM business__profile bp
		$rel_join
		WHERE 1
		$where
		$rel_where
		";
		
		return $this->db->query($sql)->row();
	}
	
	function registerBusiness($data = array(), $business_id = ""){
		$business_id_session = $this->session->userdata('business_id');
		if (empty($business_id)){
			$business_id = $business_id_session;
		}
		if (empty($business_id)){
			$this->db->insert('business__profile', $data);
			$business_id = $this->db->insert_id();
		}else{
			$this->db->update('business__profile', $data, array(
				'business_id' => $business_id
			));
		}
		return $business_id;
	}
	
	function registerRelBusinessMember($data = array()){
		$this->db->insert('business__rel_member', $data);
		$rel_id = $this->db->insert_id();
		return $rel_id;
	}
	
	function getMerchantHomePage(){
		$sql = "
		SELECT
		bp.business_name,
		bp.business_uri,
		ma.account_primary_photo,
		bp.merchant_logo
		FROM
		business__profile bp
		JOIN business__rel_member brm ON
			brm.business_id = bp.business_id
		JOIN member__account ma ON
			ma.account_id = brm.account_id
		WHERE 1
		AND bp.show_homepage = 1
		GROUP BY bp.business_id
		ORDER BY bp.business_name ASC
		";
		return $this->db->query($sql)->result();
	}
	
	function getAllMerchantByPhotoMerchant(){
		$sql = "
		SELECT
		bp.business_name,
		bp.business_uri,
		bp.merchant_logo
		FROM
		business__profile bp
		JOIN business__rel_member brm ON
			brm.business_id = bp.business_id
		JOIN member__account ma ON
			ma.account_id = brm.account_id
		WHERE 1
		AND ma.account_type = 'business'
		AND ma.account_active = 1
		AND ma.account_live = 'Online'
		AND bp.merchant_logo IS NOT NULL
		GROUP BY bp.business_id
		ORDER BY bp.business_name ASC
		";
		return $this->db->query($sql)->result();
	}
	
}

?>