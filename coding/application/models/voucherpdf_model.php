<?php 

class Voucherpdf_model extends CI_Model{

	var $start = 0;
	var $limit = 10;
	var $page = 0;
	function getVoucherPDFAll($param_url = array(), $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
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
		
		$sql = "
		SELECT
		SQL_CALC_FOUND_ROWS
		vd.voucher_id,
		vd.voucher_price_line1,
		vd.voucher_price_line2,
		vd.valid_until,
		vd.voucher_merchant_data,
		vd.business_id,
		vd.project_id,
		vd.syarat_dan_ketentuan,
		vd.cara_penggunaan,
		bp.business_name,
		pp.project_name
		FROM
		voucher__data vd
		JOIN business__profile bp ON
			bp.business_id = vd.business_id
		JOIN project__profile pp ON
			pp.project_id = vd.project_id
		WHERE 1
		$where
		ORDER BY vd.lastupdate DESC
		" . $limited;
		
		return $this->db->query($sql)->result();
	}
	
	public function countGetdata()	
	{
		 return (int) $this->db->query("SELECT FOUND_ROWS() AS total")->row()->total;	
	}

	function registerVoucherPDF($data = array(), $vid = ""){
		if (empty($vid)){
			$this->db->insert('voucher__data', $data);
			return $this->db->insert_id();	
		}else{
			$this->db->update('voucher__data', $data, array(
				'voucher_id' => $vid
			));
			return $vid;
		}
	}
	
	function getVoucherDataProfile($voucher_id){
		$sql = "
		SELECT
		vd.voucher_id,
		vd.voucher_price_line1,
		vd.voucher_price_line2,
		vd.valid_until,
		vd.voucher_merchant_data,
		vd.business_id,
		vd.project_id,
		vd.syarat_dan_ketentuan,
		vd.cara_penggunaan
		FROM
		voucher__data vd
		WHERE 1
		AND vd.voucher_id = ?
		";
		$results = $this->db->query($sql, array($voucher_id))->row();
		return $results;
	}

	function getVoucherPDFDataByProjectId($project_id){
		$sql = "
		SELECT
		vd.voucher_id,
		vd.voucher_price_line1,
		vd.voucher_price_line2,
		vd.valid_until,
		vd.voucher_merchant_data,
		vd.business_id,
		vd.project_id,
		vd.syarat_dan_ketentuan,
		vd.cara_penggunaan
		FROM
		voucher__data vd
		WHERE 1
		AND vd.project_id = ?
		";
		$results = $this->db->query($sql, array($project_id))->row();
		return $results;
	}
	
}

?>