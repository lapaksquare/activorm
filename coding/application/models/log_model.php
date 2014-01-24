<?php 

class Log_model extends CI_Model{
	
	function insertLog($data = array()){
		$this->db->insert('log__data', $data);
	}
	
}

?>