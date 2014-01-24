<?php 

class Order_model extends CI_Model{
	
	function addOrderCart($data){
		$this->db->insert('order__cart', $data);
		return $this->db->insert_id();
	}
	
	function addOrderCartDetail($data){
		$this->db->insert('order__cart_detail', $data);
		return $this->db->insert_id();		
	}
	
	function getPaymentHistory($account_id){
		$sql = "
		SELECT 
		oc.*
		FROM order__cart oc
		WHERE 1
		AND oc.account_id = ?
		AND oc.order_status = 'completed'
		ORDER BY oc.order_datetime DESC
		";
		return $this->db->query($sql, array($account_id))->result();
	}
	
	function getPaymentCheckout($account_id){
		$sql = "
		SELECT 
		oc.*
		FROM order__cart oc
		WHERE 1
		AND oc.account_id = ?
		AND oc.order_status = 'checkout'
		ORDER BY oc.order_datetime DESC
		";
		return $this->db->query($sql, array($account_id))->result();
	}
	
	function getOrderCart($type = 'oc.order_barcode', $q = ''){
		$where = " AND " . $type . " = '" . $q . "'";
		$sql = "
		SELECT
		oc.*
		FROM
		order__cart oc
		WHERE 1 
		$where
		";
		return $this->db->query($sql)->row();
	}
	
	function insertOrderPayment($data){
		$cek = $this->checkOrderIdPayment($data['order_id']);
		if (empty($cek)){
			$this->db->insert('order__payment', $data);
		}else{
			$this->db->update('order__payment', $data, array(
				'order_id' => $data['order_id']
			));
		}
	}
	
	function checkOrderIdPayment($order_id){
		$sql = "
		SELECT
		op.*
		FROM
		order__payment op 
		WHERE 1
		AND op.order_id = ?
		";
		return $this->db->query($sql, array($order_id))->row();
	}
	
	function updateOrderCart($data, $where){
		$this->db->update('order__cart', $data, $where);
	}
	
	function getDataOrderCart($order_id, $type = "oc.order_barcode"){
		$sql = "
		SELECT
		
		oc.order_id,
		oc.order_barcode,
		oc.order_status,
		oc.service_charge,
		oc.gov_charge,
		oc.order_total_price,
		oc.customer_price,
		oc.order_datetime,
		oc.order_type,
		
		op.payment_date,
		op.payment_amount,
		op.payment_bank,
		op.payment_type,
		op.from_bank,
		op.account_holder_name,
		op.account_number,
		op.payment_datetime,
		
		ma.account_id,
		ma.account_name,
		ma.address account_address,
		ma.account_email
		
		FROM
		order__cart oc
		JOIN member__account ma ON
			ma.account_id = oc.account_id
		LEFT JOIN order__payment op ON
			op.order_id = oc.order_id
		WHERE 1
		AND $type = ?
		";
		return $this->db->query($sql, array($order_id))->row();
	}
	
	function getDataOrderCartDetail($order_id){
		$sql = "
		SELECT
		ocd.order_name,
		ocd.order_name_detail,
		ocd.point,
		ocd.point_id,
		ocd.order_qty,
		ocd.order_price,
		ocd.order_total_price
		FROM
		order__cart_detail ocd
		WHERE 1
		AND ocd.order_id = ?
		AND ocd.order_detail_status = 'active'
		";
		return $this->db->query($sql, array($order_id))->result();
	}
	
}

?>