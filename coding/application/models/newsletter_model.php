<?php 

class Newsletter_model extends CI_Model{
	
	var $start = 0;
	var $limit = 10;
	var $page = 0;
	function getNewsletterData($param_url = array(), $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
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
		ns.newsletter_id,
		ns.newsletter_subject,
		ns.newsletter_body,
		ns.newsletter_target,
		ns.newsletter_testing_email,
		ns.newsletter_sending_schedule,
		ns.status
		FROM
		newsletter ns
		WHERE 1
		$where
		AND ns.status IN ('Online', 'Offline', 'Preview')
		ORDER BY ns.newsletter_sending_schedule DESC
		" . $limited;
		
		return $this->db->query($sql)->result();
		
	}
	
	public function countGetdata()	
	{
		 return (int) $this->db->query("SELECT FOUND_ROWS() AS total")->row()->total;	
	}
	
	function registerNewsletter($data = array(), $newsletter_id){
		if (empty($newsletter_id)){
			$this->db->insert('newsletter', $data);
			$newsletter_id = $this->db->insert_id();
		}else{
			$this->db->update('newsletter', $data, array(
				'newsletter_id' => $newsletter_id
			));
		}
		return $newsletter_id;
	}
	
	function getNewsletterDataByNewsletterId($newsletter_id){
		$sql = "
		SELECT
		ns.newsletter_id,
		ns.newsletter_subject,
		ns.newsletter_body,
		ns.newsletter_target,
		ns.newsletter_testing_email,
		ns.newsletter_sending_schedule,
		ns.status
		FROM
		newsletter ns
		WHERE 1
		AND ns.newsletter_id = ?
		";
		
		return $this->db->query($sql, array($newsletter_id))->row();
	}
	
	function removeNewsletter($newsletter_id){
		$sql = "
		UPDATE newsletter SET
		status = 'Deleted'
		WHERE 1
		AND newsletter_id = ?
		";
		$this->db->query($sql, array($newsletter_id));
	}
	
}

?>