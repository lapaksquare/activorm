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
	
}

?>