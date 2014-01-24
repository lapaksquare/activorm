<?php 

class A_payment_model extends CI_Model{
	
	var $start = 0;
	var $limit = 10;
	var $page = 0;
	function getOrderAll($param_url = array(), $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
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
			if (!empty($param_url['order_status']) && ($param_url['order_status'] != "all")){
				$where .= " AND oc.order_status = '".$param_url['order_status']."' ";
			}
		}
		
		$sql = "
		SELECT 
		
		SQL_CALC_FOUND_ROWS
		
		oc.order_id,
		oc.order_barcode,
		oc.order_status,
		oc.service_charge,
		oc.gov_charge,
		oc.order_total_price,
		oc.customer_price,
		oc.order_datetime,
		oc.order_type,
		
		ma.account_name,
		ma.address account_address,
		
		ocd.order_name,
		ocd.order_name_detail,
		ocd.point,
		ocd.point_id,
		ocd.order_qty,
		ocd.order_price,
		ocd.order_total_price
		
		FROM
		order__cart oc
		JOIN order__cart_detail ocd ON
			oc.order_id = ocd.order_id
		JOIN member__account ma ON
			ma.account_id = oc.account_id
		WHERE 1
		AND ocd.order_detail_status = 'active'
		$where
		ORDER BY oc.order_datetime DESC
		" . $limited;
		
		return $this->db->query($sql)->result();
		
	}
	
	function getTotalOrderCart(){
		$sql = "
		SELECT 
		SUM(oc.order_total_price) total_omzet
		FROM
		order__cart oc
		WHERE 1
		AND oc.order_status = 'completed'
		";
		return $this->db->query($sql)->row();
	}
	
	public function countGetdata()	
	{
		 return (int) $this->db->query("SELECT FOUND_ROWS() AS total")->row()->total;	
	}
	
}

?>