<?php 

class Project_model extends CI_Model{
	
	function getProject($filter = '', $q = ''){
		$where = '';
		if (!empty($filter) && !empty($q)){
			$where .= " AND " . $filter . " = '" . $q ."' ";
		}
		
		$sql = "
		SELECT
		pp.* , 
		ma.account_id,
		ma.account_primary_photo,
		ma.account_name,
		bp.business_name,
		bp.business_description,
		bp.website
		FROM project__profile pp
		JOIN business__rel_member brm ON
			brm.business_id = pp.business_id
		JOIN member__account ma ON
			ma.account_id = brm.account_id
		JOIN business__profile bp ON
			bp.business_id = pp.business_id
		WHERE 1
		$where
		";
		
		return $this->db->query($sql)->row();
	}
	
	function getProjectTaken($filter = '', $q = '', $project_id = 0){
		
		$where = '';
		if (!empty($filter) && !empty($q)){
			$where .= " AND " . $filter . " = '" . $q ."' ";
		}
		
		if (!empty($project_id)){
			$where .= " AND pp.project_id != '" . $project_id . "' ";
		}
		
		$sql = "
		SELECT
		pp.* 
		FROM project__profile pp
		WHERE 1
		$where
		";
		
		return $this->db->query($sql)->row();
	}
	
	function registerProject($data = array(), $project_id = ''){
		if (empty($project_id)){
			$this->db->insert('project__profile', $data);
			$project_id = $this->db->insert_id();
		}else{
			$this->db->update('project__profile', $data, array(
				'project_id' => $project_id
			));
		}
		return $project_id;
	}
	
	function insertProjectTags($data = array()){
		$checkTags = $this->checkTags($data['project_id'], $data['tag_uri']);
		if (empty($checkTags)){
			$this->db->insert('project__tags', $data);
			return $this->db->insert_id();
		}
		return $checkTags->tag_id;
	}
	
	function insertProjectHashTags($data = array()){
		$checkTags = $this->checkHashTags($data['project_id'], $data['tag_uri']);
		if (empty($checkTags)){
			$this->db->insert('project__hashtags', $data);
			return $this->db->insert_id();
		}
		return $checkTags->tag_id;
	}
	
	function checkTags($project_id, $tag_uri){
		$sql = "
		SELECT 
		pt.*
		FROM
		project__tags pt
		WHERE 1
		AND pt.project_id = ?
		AND pt.tag_uri = ?
		";
		return $this->db->query($sql, array($project_id, $tag_uri))->row();
	}
	
	function checkHashTags($project_id, $tag_uri){
		$sql = "
		SELECT 
		pt.*
		FROM
		project__hashtags pt
		WHERE 1
		AND pt.project_id = ?
		AND pt.tag_uri = ?
		";
		return $this->db->query($sql, array($project_id, $tag_uri))->row();
	}
	
	function registerActions($projectid, $account_id, $actions, $return){
		$checkActions = $this->checkProjectActions($projectid, $account_id);
		if (empty($checkActions)){
			$this->db->insert('project__actions', array(
				'project_id' => $projectid,
				'account_id' => $account_id,
				'action_' . $actions => $return
			));
		}else{
			$this->db->update('project__actions', array(
				'action_' . $actions => $return
			), array(
				'project_id' => $projectid,
				'account_id' => $account_id
			));
		}
	}
	
	function checkProjectActions($projectid, $account_id){
		$sql = "
		SELECT 
		pa.*
		FROM project__actions pa
		WHERE 1
		AND pa.project_id = ?
		AND pa.account_id = ?
		";
		return $this->db->query($sql, array($projectid, $account_id))->row_array();
	}
	
	var $start = 0;
	var $limit = 10;
	var $page = 0;
	function getProjectBusinessCurrent($business_id, $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
		
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
		
		$sql = "
		SELECT
		SQL_CALC_FOUND_ROWS
		pp.*
		FROM
		project__profile pp
		WHERE 1
		AND pp.business_id = ?
		ORDER BY pp.project_posted DESC
		" . $limited;
		
		return $this->db->query($sql, array($business_id))->result();
	}
	
	function getProjectBusinessOnline($business_id, $limit = 10, $start = 0, $page = 0, $nolimit = FALSE){
		
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
		/*
		 * pphx.photo_id,
		pphx.photo_file
		FROM
		project__profile pp
		LEFT JOIN (
			SELECT
			pph.project_id,
			pph.photo_id,
			pph.photo_file
			FROM 
			project__photo pph
			ORDER BY pph.photo_id ASC
			LIMIT 1
		) pphx ON pphx.project_id = pp.project_id
		 * */
		$sql = "
		SELECT
		SQL_CALC_FOUND_ROWS
		pp.*
		FROM
		project__profile pp
		WHERE 1
		AND pp.business_id = ?
		AND pp.project_active = 1
		AND (pp.project_live IN ('Online', 'Closed'))
		-- AND pp.project_period > NOW()
		ORDER BY pp.project_posted DESC
		" . $limited;
		
		return $this->db->query($sql, array($business_id))->result();
	}
	
	function insertProjectContact($dataCP = array(), $project_id = ''){
		$project = $this->checkProjectContact($project_id);
		if (empty($project)){
			$this->db->insert('project__contact', $dataCP);
		}else{
			$this->db->update('project__contact', $dataCP, array(
				'project_id' => $project_id
			));
		}
		
	}
	
	function checkProjectContact($project_id){
		$sql = "
		SELECT
		pc.*
		FROM
		project__contact pc
		WHERE 1
		AND pc.project_id = ?
		";
		return $this->db->query($sql, array($project_id))->row();
	}
	
	public function countGetdata()	
	{
		 return (int) $this->db->query("SELECT FOUND_ROWS() AS total")->row()->total;	
	}
	
	function registerTiket($data, $tiket_premium = 0){
		// check tiket
		$checkTiket = $this->checkProjectTiket($data['project_id'], $data['account_id'], $tiket_premium);
		if ($checkTiket == 0) {
			$data['tiket_premium'] = $tiket_premium;
			$this->db->insert('project__tiket', $data);
		}
	}
	
	function checkProjectTiket($project_id, $account_id, $tiket_premium = 0){
		$sql = "
		SELECT
		pt.tiket_barcode
		FROM
		project__tiket pt
		WHERE 1
		AND pt.project_id = ?
		AND pt.account_id = ?
		AND pt.tiket_premium = ?
		";
		$result = $this->db->query($sql, array($project_id, $account_id, $tiket_premium))->row();
		if (empty($result)){
			return 0;
		}else{
			return $result->tiket_barcode;
		}
	}
	
	function getProjectPrice($project_id){
		$sql = "
		SELECT
		pp2.*,
		pp1.project_id
		FROM
		project__prize pp1 
		JOIN prize__profile pp2 ON
			pp1.prize_id = pp2.prize_id
		WHERE 1
		AND pp1.project_id = ?
		";
		return $this->db->query($sql, array($project_id))->row();
	}
	
	function getProjectAllByBusinessId($business_id){
		$sql = "
		SELECT		
		pp.project_id,
		pp.business_id,
		pp.project_posted,
		pp.project_name,
		pp.project_uri,
		pp.project_period,
		pp.project_period_int,
		pp.project_actions_data,
		pp.premium_plan,
		pp.project_live,
		COUNT(pt.tiket_barcode) member_join,
		pp.premium_plan
		FROM
		project__profile pp
		JOIN project__tiket pt ON
			pt.project_id = pp.project_id
		WHERE 1
		AND pp.business_id = ?
		AND pp.project_live IN ('Online', 'Closed')
		AND pp.project_active = 1
		GROUP BY pt.project_id
		ORDER BY pp.project_posted DESC
		";
		return $this->db->query($sql, array($business_id))->result();
	}
	
	function addProjectPhoto($data){
		$this->db->insert('project__photo', $data);
	}
	
	function deleteProjectPhoto($project_id){
		$sql = "
		DELETE
		FROM
		project__photo
		WHERE 1
		AND project_id = ?
		";
		return $this->db->query($sql, array($project_id));
	}
	
	function getProjectPhotos($project_id){
		$sql = "
		SELECT
		pp.*
		FROM
		project__photo pp
		WHERE 1
		AND pp.project_id = ?
		ORDER BY pp.photo_id ASC
		";
		return $this->db->query($sql, array($project_id))->result();
	}
	
	function deletePhotoProjectByPhotoId($photo_id){
		$sql = "
		DELETE
		FROM
		project__photo
		WHERE 1
		AND photo_id = ?
		";
		return $this->db->query($sql, array($photo_id));
	}
	
	function getCountFreePlan($account_id){
		$sql = "
		SELECT
		pf.jml_free jml
		FROM
		project__freeplan pf
		WHERE 1
		AND pf.account_id = ?
		";
		$return = $this->db->query($sql, array($account_id))->row();
		if (empty($return)){
			return 3;
		}else{
			return $return->jml;
		}
	}
	
	function cekCountFreePlan($account_id){
		$sql = "
		SELECT
		pf.jml_free jml
		FROM
		project__freeplan pf
		WHERE 1
		AND pf.account_id = ?
		";
		$return = $this->db->query($sql, array($account_id))->row();
		if (empty($return)){
			return 0;
		}else{
			return 1;
		}
	}
	
	function updateCountFreePlan($account_id, $freeplan){
		$cek = $this->cekCountFreePlan($account_id);
		if ($cek == 0){
			$this->db->insert('project__freeplan', array(
				'account_id' => $account_id,
				'jml_free' => $freeplan
			));
		}else{
			$this->db->update('project__freeplan', array(
				'jml_free' => $freeplan
			), array(
				'account_id' => $account_id
			));
		}
	}
	
}

?>