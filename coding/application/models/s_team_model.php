<?php 

class S_team_model extends CI_Model{
	
	function getTeam($team_id){
		$sql = "
         SELECT
           t.team_id,
           t.team_name,
           t.leader_id
         FROM
            sales__team t
         WHERE 1
            AND t.team_id = ?
		";
		return $this->db->query($sql, array($team_id))->row();
	}
      
   function getTeamByAccount($account_id){
      $sql = "
         SELECT
           t.team_id,
           t.team_name,
           t.leader_id
         FROM
            sales__team t
            JOIN sales__team_detail td ON t.team_id = td.team_id
         WHERE 1
            AND td.member_id = ?
		";
		return $this->db->query($sql, array($account_id))->result();
   }
   
   function getTeamByLeader($account_id){
      $sql = "
         SELECT
           t.team_id,
           t.team_name,
           t.leader_id
         FROM
            sales__team t
         WHERE 1
            AND t.leader_id = ?
		";
		return $this->db->query($sql, array($account_id))->result();
   }
   
   function getTeamMember($team_id){
      $sql = "
         SELECT
            a.account_id,
            a.account_name,
            a.account_email,
            a.account_primary_photo
         FROM
            sales__team_detail td
            JOIN member__account a ON td.member_id = a.account_id
         WHERE 1
            AND td.team_id = ?
		";
		return $this->db->query($sql, array($team_id))->result();
   }
	
   function getTeamLeader($team_id){
      $sql = "
         SELECT
            a.account_id,
            a.account_name,
            a.account_email,
            a.account_primary_photo
         FROM
            sales__team t
            JOIN member__account a ON t.leader_id = a.account_id
         WHERE 1
            AND t.team_id = ?
		";
		return $this->db->query($sql, array($team_id))->row();
   }
}

?>