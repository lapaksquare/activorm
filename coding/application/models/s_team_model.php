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
         SELECT DISTINCT
           t.team_id,
           t.team_name,
           t.leader_id
         FROM
            sales__team t
            JOIN sales__team_detail td ON t.team_id = td.team_id
         WHERE 1
            AND(
               td.member_id = ? OR t.leader_id = ?
            )
		";
		return $this->db->query($sql, array($account_id, $account_id))->result();
   }
   
   function getTeamByMember($account_id){
      $sql = "
         SELECT DISTINCT
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
         SELECT DISTINCT
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
   
   function getTeamMembers($team_id){
      $sql = "
         SELECT DISTINCT
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

      $res = $this->db->query($sql, array($team_id))->result();
      $arr = array();
      
      foreach($res as $r){
         $arr[] = (object)array(
            'account_id'               => $r->account_id,
            'account_name'             => $r->account_name,
            'account_email'            => $r->account_email,
            'account_primary_photo'    => $r->account_primary_photo,
            'team_role'                => 'member'
         );
      }
      
      return $arr;
   }
   	
   function getTeamLeader($team_id){
      $sql = "
         SELECT DISTINCT
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
      
      $res = $this->db->query($sql, array($team_id))->result();
      
      foreach($res as $r){
         return (object)array(
            'account_id'               => $r->account_id,
            'account_name'             => $r->account_name,
            'account_email'            => $r->account_email,
            'account_primary_photo'    => $r->account_primary_photo,
            'team_role'                => 'leader'
         );
      }
      
      return $arr;
   }
   
   function getTeamMembersExclude($team_id, $accounts){
      if(!is_array($accounts) || empty($accounts)) return null;
      
      $params = array($team_id);
      $params = array_merge($params, $accounts);
      
      $in_string = str_replace(' ', ',', trim(str_repeat("? ", count($accounts))));
      
      $sql = "
         SELECT DISTINCT
            a.account_id,
            a.account_name,
            a.account_email,
            a.account_primary_photo
         FROM
            sales__team_detail td
            JOIN member__account a ON td.member_id = a.account_id
         WHERE 1
            AND td.team_id = ?
            AND td.member_id NOT IN ($in_string)
		";
      
		$res = $this->db->query($sql, $params)->result();
      $arr = array();
      
      foreach($res as $r){
         $arr[] = (object)array(
            'account_id'               => $r->account_id,
            'account_name'             => $r->account_name,
            'account_email'            => $r->account_email,
            'account_primary_photo'    => $r->account_primary_photo,
            'team_role'                => 'member'
         );
      }
      
      return $arr;
   }
}

?>