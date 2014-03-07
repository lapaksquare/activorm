<?php 

class Comment_model extends CI_Model{
	
	function addComment($data){
		$this->db->insert('project__comment', $data);
		return $this->db->insert_id();
	}
	
	var $total_comment = 0;
	function getComment($pid, $lastcommentid = 0){
		
		$where = "";
		if ($lastcommentid > 0){
			$where .= "AND pc.comment_id < $lastcommentid";
		}
		
		$sql = "
		SELECT
		SQL_CALC_FOUND_ROWS
		pc.comment_id,
		pc.parent_comment,
		pc.account_id,
		pc.project_id,
		pc.comment_text,
		ma.account_name,
		ma.account_email,
		ma.account_primary_photo,
		pc.postdate
		FROM
		project__comment pc
		JOIN member__account ma ON
			ma.account_id = pc.account_id
		WHERE 1
		AND pc.project_id = ?
		$where
		AND pc.parent_comment = 0
		AND pc.isactive = 1
		AND pc.comment_type = 'comment'
		ORDER BY pc.postdate DESC
		LIMIT 10
		";
		$result = $this->db->query($sql, array($pid))->result();
		$this->total_comment = $this->countGetdata();
		$return = array();
		foreach($result as $k=>$v){
			$return[$v->comment_id]['comment'] = $v;
			
			$replys = $this->getReplyComment($pid, $v->comment_id);
			if (!empty($replys)){
				foreach($replys as $a=>$b){
					$return[$v->comment_id]['reply'][strtotime($b->postdate)] = $b;	
				}
			}
			
			/*
			if ($v->parent_comment > 0){
				$return[$v->parent_comment]['reply'][strtotime($v->postdate)] = $v;
			}else{
				$return[$v->comment_id]['comment'] = $v;
			}*/
		}
		return $return;
	}
	
	function getReplyComment($project_id, $comment_id){
		$sql = "
		SELECT
		pc.comment_id,
		pc.parent_comment,
		pc.account_id,
		pc.project_id,
		pc.comment_text,
		ma.account_name,
		ma.account_email,
		ma.account_primary_photo,
		pc.postdate
		FROM
		project__comment pc
		JOIN member__account ma ON
			ma.account_id = pc.account_id
		WHERE 1
		AND pc.project_id = ?
		AND pc.parent_comment = ?
		AND pc.isactive = 1
		AND pc.comment_type = 'comment'
		ORDER BY pc.postdate DESC
		";
		$result = $this->db->query($sql, array($project_id, $comment_id))->result();
		return $result;
	}
	
	public function countGetdata()	
	{
		 return (int) $this->db->query("SELECT FOUND_ROWS() AS total")->row()->total;	
	}
	
}

?>