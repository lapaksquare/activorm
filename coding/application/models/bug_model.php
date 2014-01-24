<?php 

class Bug_model extends CI_Model{
	
	function registerBug($data, $bug_id = ""){
		if (empty($bug_id)){
			$this->db->insert('report__bug', $data);
			$bug_id = $this->db->insert_id();
		}else{
			$this->db->update('report__bug', $data, array(
				'bug_id' => $bug_id
			));
		}
		return $bug_id;	
	}
	
	function registerContactUs($data, $contact_id = ""){
		if (empty($contact_id)){
			$this->db->insert('report__contactus', $data);
			$contact_id = $this->db->insert_id();
		}else{
			$this->db->update('report__contactus', $data, array(
				'contact_id' => $contact_id
			));
		}
		return $contact_id;	
	}
	
}

?>