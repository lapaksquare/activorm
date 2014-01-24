<?php 

class Comment_model extends CI_Model{
	
	function addComment($data){
		$this->db->insert('project__comment', $data);
		return $this->db->insert_id();
	}
	
	function getComment($pid){
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
		AND pc.isactive = 1
		AND pc.comment_type = 'comment'
		ORDER BY pc.parent_comment ASC, pc.postdate DESC
		";
		$result = $this->db->query($sql, array($pid))->result();
		$return = array();
		foreach($result as $k=>$v){
			if ($v->parent_comment > 0){
				$return[$v->parent_comment]['reply'][strtotime($v->postdate)] = $v;
			}else{
				$return[$v->comment_id]['comment'] = $v;
			}
		}
		return $return;
	}
	
}

?>