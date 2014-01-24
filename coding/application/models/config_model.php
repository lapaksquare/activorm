<?php 

class Config_model extends CI_Model{
	
	function addConfig($config_name, $config_data){
		$this->db->update('config', array(
			'config_data' => $config_data
		), array(
			'config_name' => $config_name
		));
	}
	
	function getConfigData($config_name){
		$sql = "
		SELECT
		c.config_data
		FROM
		config c
		WHERE 1
		AND c.config_name = ?
		";
		return $this->db->query($sql, array($config_name))->row()->config_data;
	}
	
}

?>