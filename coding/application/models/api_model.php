<?php 

class Api_model extends CI_Model{
	
	function createPartner($data = array()){
		$this->db->insert('business__partner', $data);
	}
	
	function getPartnerByPartnerCode($partnercode){
		$sql = "
		SELECT
		bp.partner_id,
		bp.partner_name,
		bp.partner_email,
		bp.partner_phone,
		bp.isactive,
		bp.partner_code
		FROM business__partner bp
		WHERE 1
		AND bp.partner_code = ?
		";
		return $this->db->query($sql, array($partnercode))->row();
	}
	
}

?>