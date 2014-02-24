<?php 

class Ajax extends CI_Controller {
	
	function getFeaturedProjectAll(){
		$business_id = $this->input->get_post('business_id');
		$project_id = $this->input->get_post('project_id');
		$this->load->model('a_featured_model');
		$projects = $this->a_featured_model->getProjectAll($business_id);
		$return = '<option value="0">Pilih Project</option>';
		foreach($projects as $k=>$v){
			$class = (!empty($project_id) && $project_id == $v->project_id) ? "selected" : "";
			$return .= '<option value="'.$v->project_id.'" '.$class.'>'.ucwords( $v->project_name ).'</option>';
		}
		echo $return;
	}
	
	function getFeaturedBusinessSelected(){
		$business_id = $this->input->get_post('business_id');
		$this->load->model('a_featured_model');
		$ds = $this->a_featured_model->getFeaturedBusinessSelected($business_id);
		//print_r($ds);
		if (!empty($ds->merchant_logo)){
			$photo = $this->mediamanager->getPhotoUrl($ds->merchant_logo, "100x100");
			echo '<img src="'.cdn_url() . $photo.'" alt="photo" />';
		}else{
			echo '<a href="'.base_url().'admin/member/business_account_details?bai='.$ds->business_id.'&mai='.$ds->account_id.'&h='.sha1($ds->business_id.$ds->account_id.SALT).'" target="_blank">Upload your logo</a>';
		}
	}
	
	function getInfoBusinessAccount(){
		$business_id = $this->input->get_post('business_id');
		$this->load->model('a_featured_model');
		$ds = $this->a_featured_model->getFeaturedBusinessSelected($business_id);
		$return = array();
		if (!empty($ds)){
			$return = array(
				'status' => 1,
				'results' => $ds
			);
		}else{
			$return = array(
				'status' => 0,
				'results' => array()
			);
		}
		
		$projects = $this->a_featured_model->getProjectAll($business_id);
		$return_project_html = '<option value="0">Pilih Project</option>';
		foreach($projects as $k=>$v){
			$return_project_html .= '<option value="'.$v->project_id.'">'.ucwords( $v->project_name ).'</option>';
		}		
		
		$return['projects'] = $return_project_html;
		
		echo json_encode($return);
	}

	function registerInterestsRel(){
		$interest_id = $this->input->get_post('interest_id');
		$name = $this->input->get_post('name');
		$mip_id = $this->input->get_post('mip_id');
		$this->load->model('interests_model');
		$this->interests_model->registerInterestsRel($interest_id, $name, $mip_id);
		echo json_encode(array(
			'msg' => 1
		));
	}

	function delete_photo_project(){
		$pid = $this->input->get_post('pid');
		$h = $this->input->get_post('h');
		$h_ori = sha1($pid . SALT);
		$msg = 0;
		if ($h == $h_ori){
			$this->load->model('project_model');
			$this->project_model->deletePhotoProjectByPhotoId($pid);
			$msg = 1;
		}
		echo json_encode(array(
			'msg' => $msg
		));
	}
	
	function save_actions_tweet(){
		$project_id = $this->input->get_post('project_id');
		$type = $this->input->get_post('type');
		$tw_tweet = $this->input->get_post('tw_tweet');
		
		$this->load->model('a_project_model');
		$this->project = $this->a_project_model->getProjectDetail($project_id);
		
		$msg = 0;
		$actions = $this->project->project_actions_data;
		if (!empty($actions)){
			$actions = json_decode($actions);
			$act = array();
			foreach($actions as $k=>$v){
				$a = (array)$v;
				$act[$k] = $a;
				if ($v->type_step == $type){
					$act[$k]['status'] = $tw_tweet;
				}
			}
			
			$act_json = json_encode($act);
			
			$data = array(
				'project_actions_data' => $act_json
			);
			$this->a_project_model->registerProject($data, $project_id);
			$msg = 1;
		}
		
		echo json_encode(array(
			'msg' => $msg
		));
	}
	
	function save_actions_fb(){
		$project_id = $this->input->get_post('project_id');
		$type = $this->input->get_post('type');
		$fb_link_name = $this->input->get_post('fb_link_name');
		$fb_link_linka = $this->input->get_post('fb_link_linka');
		$fb_link_description = $this->input->get_post('fb_link_description');
		
		$this->load->model('a_project_model');
		$this->project = $this->a_project_model->getProjectDetail($project_id);
		
		$msg = 0;
		$actions = $this->project->project_actions_data;
		if (!empty($actions)){
			$actions = json_decode($actions);
			$act = array();
			foreach($actions as $k=>$v){
				$a = (array)$v;
				$act[$k] = $a;
				if ($v->type_step == $type){
					$act[$k]['name'] = $fb_link_name;
					$act[$k]['link'] = $fb_link_linka;
					$act[$k]['description'] = $fb_link_description;
				}
			}
			
			$act_json = json_encode($act);
			
			$data = array(
				'project_actions_data' => $act_json
			);
			$this->a_project_model->registerProject($data, $project_id);
			$msg = 1;
		}
		
		echo json_encode(array(
			'msg' => $msg
		));
	}
	
}

?>