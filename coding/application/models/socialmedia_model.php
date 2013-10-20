<?php 

class Socialmedia_model extends CI_Model{
	
	function insertLogSocialMedia($data){
		$this->db->insert('connect__socialmedia', $data);
	}
	
}

?>