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
	
}

?>