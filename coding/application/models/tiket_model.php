<?php 

class Tiket_model extends CI_Model{
	
	var $start = 0;
	var $limit = 10;
	var $page = 0;
	function getAccountTiket($account_id, $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
		
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
			
		$sql = "
		SELECT
		
		SQL_CALC_FOUND_ROWS
		
		pt.tiket_barcode,
		pt.project_id,
		pt.account_id,
		pt.voucher_data,
		pt.voucher_data_int,
		pt.iswin,
		pp.business_id,
		pp.project_name,
		pp.project_uri,
		pp.project_period,
		pt.lastupdate,
		bp.business_name,
		bp.business_uri
		FROM
		project__tiket pt
		JOIN project__profile pp ON
			pt.project_id = pp.project_id
		JOIN business__profile bp ON
			bp.business_id = pp.business_id
		WHERE 1
		AND pt.account_id = ?
		ORDER BY pt.lastupdate DESC
		" . $limited;
		
		return $this->db->query($sql, array($account_id))->result();
	}
	
	public function countGetdata()	
	{
		 return (int) $this->db->query("SELECT FOUND_ROWS() AS total")->row()->total;	
	}
	
	function getProjectTiket($project_id){
		$sql = "
		SELECT
		pt.*
		FROM 
		project__tiket pt 
		WHERE 1
		AND pt.project_id = ?
		";
		return $this->db->query($sql, array($project_id))->result();
	}
	
	function getCountProjectTiket($project_id){
		$sql = "
		SELECT
		count(pt.tiket_id) jml_tiket
		FROM 
		project__tiket pt 
		WHERE 1
		AND pt.project_id = ?
		";
		return $this->db->query($sql, array($project_id))->row()->jml_tiket;
	}
	
	function getWinProjectTiket($account_id, $project_id){
		$sql = "
		SELECT
		pt.*,ma.account_email,
		ma.account_name
		FROM 
		project__tiket pt 
		JOIN member__account ma ON
			ma.account_id = pt.account_id
		WHERE 1
		AND pt.project_id = ?
		AND pt.iswin = 1
		";
		return $this->db->query($sql, array($project_id))->result();
	}
	
	function getCountPrizeAccount($account_id){
		/*
		 * 		SELECT
		count(pt.tiket_id) jml_tiket
		FROM
		project__tiket pt
		WHERE 1
		AND pt.account_id = ?
		AND DATE_FORMAT(pt.lastupdate,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')
		*/
		$sql = "
		SELECT
		pt.project_id
		FROM
		project__tiket pt
		WHERE 1
		AND pt.account_id = ?
		AND DATE_FORMAT(pt.lastupdate,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')
		group by pt.project_id
		";
		$return = $this->db->query($sql, array($account_id))->result_array();
		return count($return);
	}
	
	function checkTiket($project_id, $account_id){
		$sql = "
		SELECT
		pt.tiket_id,
		pt.tiket_barcode,
		pp.project_file_data,
		pt.voucher_data,
		pt.used_tiket
		FROM
		project__tiket pt
		JOIN project__profile pp ON
			pp.project_id = pt.project_id
		WHERE 1
		AND pt.project_id = ?
		AND pt.account_id = ?
		";
		return $this->db->query($sql, array($project_id, $account_id))->row();
	}
	
	function redeemTiket($tiket_barcode){
		$this->db->update('project__tiket', array(
			'used_tiket	' => 1
		), array(
			'tiket_barcode' => $tiket_barcode
		));
	}
	
}

?>