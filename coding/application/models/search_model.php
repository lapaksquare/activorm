<?php 

class Search_model extends CI_Model{
	
	var $start = 0;
	var $limit = 10;
	var $page = 0;
	function getSearch($data = array(), $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
		
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
		
		$q = $data['q'];
		$category = $data['category'];
		//if (empty($q) || empty($category)) return false;
		
		$where_project_prize_category = "";
		if (!empty($category)){
			if (is_array($category) && !in_array("all_prize", $category)){
				$category = "'" . implode("','", $category) . "'";
				$where_project_prize_category = " AND pp.project_prize_category IN (".$category.") ";
			}else if (!is_array($category) && $category != "all_prize"){
				$where_project_prize_category = " AND pp.project_prize_category = '$category' ";
			}
		}
		
		$sql = "
		SELECT
		
		SQL_CALC_FOUND_ROWS
		
		pp.project_id,
		pp.business_id,
		pp.project_name,
		pp.project_description,
		pp.project_uri,
		pp.project_primary_photo,
		pp.project_period,
		pp.project_period_int,
		pp.project_prize_detail,
		pp.project_prize_category,
		pp.project_tags,
		pp.project_hashtags,
		pp.project_posted,
		bp.business_name,
		bp.business_uri
		
		FROM
		
		project__profile pp
		
		JOIN business__profile bp ON
			bp.business_id = pp.business_id AND
			bp.business_live = 'Online' AND
			bp.business_active = 1
		
		WHERE 1
		
		AND (
			pp.project_name LIKE '%$q%' OR
			pp.project_description LIKE '%$q%' OR 
			pp.project_prize_detail LIKE '%$q%' OR
			pp.project_tags LIKE '%$q%' OR
			bp.business_name LIKE '%$q%'
		) 
		
		$where_project_prize_category
		
		AND (pp.project_live = 'Online' || pp.project_live = 'Closed')
		AND pp.project_active = 1
		";
		
		//echo $sql;die();
		
		return $this->db->query($sql)->result();
		
	}
	
	public function countGetdata()	
	{
		 return (int) $this->db->query("SELECT FOUND_ROWS() AS total")->row()->total;	
	}
	
	function registerSuggest($suggest_name){
		$cek_suggest = $this->checkSuggest($suggest_name);
		if (empty($cek_suggest)){
			$this->db->insert('search__suggestions', array(
				'suggest_name' => $suggest_name,
				'suggest_count' => 1
			));
			return $this->db->insert_id();
		}else{
			$suggest_count = $cek_suggest->suggest_count + 1;
			$this->db->update('search__suggestions', array(
				'suggest_count' => $suggest_count 
			), array(
				'suggest_id' => $cek_suggest->suggest_id
			));
			return $cek_suggest->suggest_id;
		}
	}
	
	function checkSuggest($suggest_name){
		$sql = "
		SELECT 
		ss.suggest_id,
		ss.suggest_name,
		ss.suggest_count
		FROM
		search__suggestions ss
		WHERE 1
		AND ss.suggest_name = ?
		";
		return $this->db->query($sql, array($suggest_name))->row();
	}
	
	function registerKeyword($q){
		$cek_suggest = $this->checkSearchKeyword($q);
		if (empty($cek_suggest)){
			$this->db->insert('search__keywords', array(
				'key_name' => $q,
				'key_count' => 1
			));
			return $this->db->insert_id();
		}else{
			$key_count = $cek_suggest->key_count + 1;
			$this->db->update('search__keywords', array(
				'key_count' => $key_count 
			), array(
				'key_id' => $cek_suggest->key_id
			));
			return $cek_suggest->key_id;
		}
	}
	
	function checkSearchKeyword($q){
		$sql = "
		SELECT 
		sk.key_id,
		sk.key_name,
		sk.key_count
		FROM
		search__keywords sk
		WHERE 1
		AND sk.key_name = ?
		";
		return $this->db->query($sql, array($q))->row();
	}
	
}

?>