<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends MY_Admin_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	var $offset = 10;
	function index(){
		
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$this->project_status = $this->input->get_post('project_status');
		$this->project_status = (empty($this->project_status)) ? "All" : $this->project_status;
		$this->search_by = $this->input->get_post('search_by');
		$this->q = $this->input->get_post('q');
		$param_url = array(
			'project_status' => $this->project_status,
			'search_by' => $this->search_by,
			'q' => $this->q,
			'page' => ''
		);
		
		$this->load->model('a_project_model');
		$this->data['projects'] = $this->a_project_model->getProject($param_url, $this->offset, 0, $page);
				
		$param_url = http_build_query($param_url);
		
		$uri_page = 'admin/project/?'.$param_url;
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->a_project_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);
		
		$this->data['menu'] = 'project';
		$this->data['menu_child'] = 'project_'.strtolower($this->project_status);
		$this->_default_param(
			"",
			"",
			"",
			"Project - Activorm Connect");
		$this->load->view('n/project/index_view', $this->data);
	}

	function project_detail(){
		
		$project_id = $this->input->get_post('pid');
		$h = $this->input->get_post('h');
		$h_ori = sha1($project_id . SALT);
		if ($h != $h_ori) redirect(base_url() . 'admin/project');
		
		$this->load->model('a_project_model');
		$this->project = $this->a_project_model->getProjectDetail($project_id);
		
		$this->load->model('project_model');
		$this->project_photos = $this->project_model->getProjectPhotos($project_id);
		
		$this->data['menu'] = 'project';
		$this->_default_param(
			array(
				'<link rel="stylesheet" type="text/css" href="'.cdn_url().'css/jqueryui/jquery-ui-1.10.0.custom.css" />'
			),
			array(
				'<script src="'.cdn_url().'js/jqueryui/jquery-ui-1.9.2.custom.min.js"></script>',
				'<script src="'.cdn_url().'js/a_project.js"></script>'
			),
			"",
			"Project Details - Activorm Connect");
		$this->load->view('n/project/project_detail_view', $this->data);
	}
	
	function submit_project(){
		$update = $this->input->get_post('update');
		
		/*key ==== start ====*/
		$pid = $this->input->get_post('pid');
		$aid = $this->input->get_post('aid');
		$h = $this->input->get_post('h');
		$h_ori = sha1($pid . SALT);
		/*key ==== end ====*/
		
		/*input ==== start =====*/
		$project_name = $this->input->get_post('project_name');
		$period = $this->input->get_post('period');
		$describe_prize = $this->input->get_post('describe_prize');
		$prize_category = $this->input->get_post('prize_category');
		$describe_project = $this->input->get_post('describe_project');
		$project_tags = $this->input->get_post('project_tags');
		$project_live = $this->input->get_post('project_live');
		$project_active = $this->input->get_post('project_active');
		/*input ==== end =====*/
		
		if (!empty($update)){
					
			/******** start VALIDASI */ 
			$this->load->library('validate');
			
			$errors = array();
			
			if ($h != $h_ori){
				$errors[] = "Something error with key hash.";
			}
			
			$validateProjectName = $this->validate->validateName($project_name);
			//if ($validateProjectName == 1){
			if (strlen($project_name) < 5){	
				$errors[] = "Project Title must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 5 characters.";
			}
			
			$validateProjectPrize = $this->validate->validateName($describe_prize);
			if (strlen($describe_prize) < 5){
				$errors[] = "Project Prize must contain words only. Minimum 5 characters.";
			}
			
			if (strlen($describe_project) <= 0 || strlen($describe_project) > 500){
				$errors[] = "Project Description must be filled. Max 500 characters.";
			}
			
			if ($period < 7 || $period > 30){
				$errors[] = "Terjadi kesalahan dalam pengaturan periode";
			}
			
			$this->load->library('util');
			$project_uri = $this->util->url_slug($project_name);
			$this->load->model('project_model');
			$project = $this->project_model->getProjectTaken('pp.project_uri', $project_uri, $pid);
			if (!empty($project) && !empty($project_name)){
				$errors[] = 'Project Title must be unique for URL link. The one you insert has been used.';
			}
			
			// UPLOAD IMAGES =================== start ============================
			$config['upload_path'] = './images/project/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']	= '2024';
			$config['max_width']  = '2000';
			$config['max_height']  = '2000';
			$config['encrypt_name'] = true;
			
			$this->load->library('upload', $config);
			
			$images_uploaded = array();
			$uploaded = $this->upload->do_multi_upload('project_photo', TRUE);
			$project_primary_photo = $photo_thumb = "";
			if ($uploaded){
				foreach($uploaded as $k=>$v){
					if ($k == 0){
						$project_primary_photo = 'images/project/' . $v['file_name'];
						$photo_thumb = cdn_url() . $this->mediamanager->getPhotoUrl($project_primary_photo, "200x200");
						$dataProject['project_primary_photo'] = $project_primary_photo;
					}
					if ($k < 3){
						$images_uploaded[] = $v;
					}
				}
				//$images_uploaded = $uploaded;
			}else{
				
				if (!empty($_FILES['project_photo']['name'])){
					$errors[] = 'You have to upload a Project Image in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
				}
				
			}
			
			/*
			$uploaded = $this->upload->do_upload('project_photo');
			$project_primary_photo = $photo_thumb = "";
			if ($uploaded){
				//$error = $this->upload->display_errors();
				$data = $this->upload->data();
				//print_r($data);
				//print_r($error);
				
				$project_primary_photo = 'images/project/' . $data['file_name'];
				
				$photo_thumb = cdn_url() . $this->mediamanager->getPhotoUrl($project_primary_photo, "200x200");
				
				$dataProject['project_primary_photo'] = $project_primary_photo;
				
			}else{
				
				if (!empty($_FILES['project_photo']['name'])){
					$errors[] = 'You have to upload a Project Image in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
				}
				
			}*/
			// UPLOAD IMAGES =================== end ============================
			
			
			/******** end VALIDASI */ 	
			
			if (count($errors) > 0){
				
				$this->session->set_userdata('a_message_error', $errors);
								
			}else{
				
				/* === FIX ACTIONS ===*/
				$this->load->model('a_project_model');
				$project = $this->a_project_model->getProjectDetail($pid);
				$project_hashtags = $project->project_hashtags;
				$this->dataStatus = array(
					'project_name' => $project_name,
					'project_description' => $describe_project,
					'project_uri' => base_url() . 'project/' . $project_uri,
					'project_hashtags' => (!empty($project_hashtags)) ? '#'.$project_hashtags : '',
					'project_picture' => $photo_thumb
				);
				$project_actions_data = json_decode($project->project_actions_data);
				
				//echo '<pre>';print_r($project_actions_data);echo '</pre>';die();
				
				$actions = array();
				$actions_string = "";
				if (!empty($project_actions_data)){
					foreach($project_actions_data as $k=>$v){
						$type_step = $v->type_step;
						$aid_selected = $aid;
						if (property_exists($v, "custom_actions") && !empty($v->custom_actions)){
							list($type_step, $type_step_key) = explode("_", $type_step);
							$aid_selected = 14;
							continue;
						}
						$act = $this->func_actions_step($type_step, $aid);
						$actions[] = $act;
					}
					
					/*
					echo '<pre>';
					print_r($actions);
					echo '</pre>';
					die();
					*/
										
					/* CUSTOM ACTIONS ======= START ======= */
					if (count($actions) < 3 && $this->authActions($aid) == 1){
						// follow twitter activorm
						$act = $this->twitter_step("twitter-follow", 14, 1);
						$act['custom_actions'] = 'business_rel_to_action_twitter_follow_activorm';
						$this->type_social = 'twitter';
						$key = array_keys($actions);
						$key = end($key);
						$actions[($key+1)] = $act;
					}
					/* CUSTOM ACTIONS ======= END   ======= */
					
					/*
					echo '<pre>';
					print_r($actions);
					echo '</pre>';
					die();
					*/
					
					$actions_string = json_encode($actions);
				}
				/* === FIX ACTIONS ===*/
				
				//$project_actions_data = json_decode($actions_string);
				
				//echo '<pre>';print_r($project_actions_data);echo '</pre>';die();
				
				//die();
				
				$dataProject = array(
					'project_name' => $project_name,
					'project_description' => $describe_project,
					'project_uri' => $project_uri,
					//'project_period' => date('Y-m-d H:i:s', strtotime("+" . $period . " days")),
					//'project_period_int' => $period,
					'project_prize_detail' => $describe_prize,
					'project_prize_category' => $prize_category,
					'project_tags' => $project_tags,
					'project_live' => $project_live,
					'project_active' => $project_active,
					'project_actions_data' => $actions_string
				);
				
				if (!empty($project) && in_array($project->project_live, array('Offline', 'Draft', 'Closed')) && $project_live == "Online"){
					$dataProject['project_period'] = date('Y-m-d H:i:s', strtotime("+" . $period . " days"));
					$dataProject['project_period_int'] = $period;
					
					/* PROJECT FREE PLAN COUNT */
					$this->load->model('project_model');
					if (empty($project->premium_plan_type)){
						$freeplan = $this->project_model->getCountFreePlan($aid);
						$freeplan -= 1;
						$this->project_model->updateCountFreePlan($aid, $freeplan);
					}else{
					
					/* PROJECT BUDGET */
					//if (!empty($project->premium_plan_type)){
						$project_budget = 100000; //$this->input->get_post('project-budget');
						$project_budget = intval( $project_budget ) / 1000;
						
						$this->load->model('point_model');
						$point = $this->point_model->getAccountPoint($aid);
						$project_point = $point - $project_budget;
											
						$this->point_model->updateMemberPoint(array(
							'point' => $project_point
						), $aid);
					}
					
				}else{
					if ($project->project_period_int > $period){
						$pp = $project->project_period_int - $period;
						$pp_string = "-" . $pp . " days";
					}else{
						$pp = $period - $project->project_period_int;
						$pp_string = "+" . $pp . " days";
					}
					$dataProject['project_period'] = date('Y-m-d H:i:s', strtotime($project->project_period . $pp_string));
					$dataProject['project_period_int'] = $period;
				}
				
				if (!empty($project_primary_photo)) $dataProject['project_primary_photo'] = $project_primary_photo;
				
				$project_id = $this->project_model->registerProject($dataProject, $pid);
				
				if (!empty($images_uploaded)){
					$this->project_model->deleteProjectPhoto($project_id);
					foreach($images_uploaded as $k=>$v){
						$primary_photo = 0;
						$this->project_model->addProjectPhoto(array(
							'project_id' => $project_id,
							'photo_file' => 'images/project/'. $v['file_name'],
							'primary_photo' => $primary_photo
						));
					}
				}
				
				$project_tags = explode(",", $project_tags);
				foreach($project_tags as $k=>$v){
					$tag_uri = $this->util->url_slug($v);
					$this->project_model->insertProjectTags(array(
						'project_id' => $project_id,
						'tag_name' => $v,
						'tag_uri' => $tag_uri
					));
				}
				
				$this->session->set_userdata('a_message_success', 1);
				
			}
			
		}
		
		redirect(base_url() . 'admin/project/project_detail?pid=' . $pid . '&h=' . $h_ori);
	}

	function func_actions_step($actions_step, $account_id){
		$act = array();
				
		$this->type_social = '';
		
		$k = $actions_step;
		
		switch($actions_step){
			
			// for facebook step
			case "facebook-like" : 
				$act = $this->facebook_step($k, $account_id, 0);
				$this->type_social = 'facebook';
				break;
			case "facebook-follow" :
				$act = $this->facebook_step($k, $account_id, 0);
				$this->type_social = 'facebook';
				break;
			case "facebook-send" :
				$act = $this->facebook_step($k, $account_id, 0);
				$this->type_social = 'facebook';
				break; 
				
			// for twitter step
			case "twitter-tweet" :
				$act = $this->twitter_step($k, $account_id, 0);
				$this->type_social = 'twitter';
				break; 
			case "twitter-follow" :
				$act = $this->twitter_step($k, $account_id, 0);
				$this->type_social = 'twitter';
				break; 
			case "twitter-hashtag" :
				$act = $this->twitter_step($k, $account_id, 0);
				$this->type_social = 'twitter';
				break;
			case "twitter-to" :
				$act = $this->twitter_step($k, $account_id, 0);
				$this->type_social = 'twitter';
				break;
					
		}
		
		return $act;
	}

	function authActions($aid){
		$account_id = $aid;
		$account_id_selected = array(962,4,14);
		if (in_array($account_id, $account_id_selected)) return 1;
		return 0;
	}

	function facebook_step($key, $account_id_selected = 0, $custom = 0){
		$this->load->model('socialmedia_model');
		if ($account_id_selected == 0){
			$account_id = $this->session->userdata('account_id');
		}else{
			$account_id = $account_id_selected;
		}
		$socialmedia = $this->socialmedia_model->getSocialMediaConnect($account_id, 'facebook');
		
		if (empty($socialmedia) || empty($socialmedia->social_page_data) || empty($socialmedia->social_page_active)){
			return array();
		}
		
		$return = array();
		switch($key){
			case "facebook-like" :
				$return = (array) json_decode( $socialmedia->social_page_active );
				$return['type_name'] = "Like Facebook Page";
				break; 
			case "facebook-follow" :
				$return = (array) json_decode( $socialmedia->social_data );
				$return['type_name'] = "Follow Facebook User";
				break; 
			case "facebook-send" :				
				$return = array(
				 	//'message' => //'Testing link message',
				 	'name' => $this->dataStatus['project_name'],
				 	'link' => $this->dataStatus['project_uri'],
				 	'description' => $this->dataStatus['project_description'],
				 	//'picture' => $this->dataStatus['project_picture'],
				);
				
				if (!empty($this->dataStatus['facebook_format'])){
					$return['message'] = $this->dataStatus['facebook_format'];
				}
				
				$return['type_name'] = "Share Content to Facebook";
				break;
		}
		if ($custom > 0) $key = $key . "_customactions";
		$return['type_step'] = $key;
		return $return;
	}
	
	function twitter_step($key, $account_id_selected = 0, $custom = 0){
		$this->load->model('socialmedia_model');
		if ($account_id_selected == 0){
			$account_id = $this->session->userdata('account_id');
		}else{
			$account_id = $account_id_selected;
		}
		$socialmedia = $this->socialmedia_model->getSocialMediaConnect($account_id, 'twitter');
		
		if (empty($socialmedia) || empty($socialmedia->social_oauth_data)){
			return array();
		}else{
			$js = json_decode($socialmedia->social_data);
			if (property_exists($js, "errors")){
				return array();
			}
		}
		
		$social_oauth_data = (array) json_decode( $socialmedia->social_oauth_data );
		$return = array();
		
		$tweet_status = $this->dataStatus['project_name'] . ' ' . $this->dataStatus['project_uri'];
		if (!empty($this->dataStatus['twitter_format'])){
			$tweet_status = $this->dataStatus['twitter_format'] .  ' ' . $this->dataStatus['project_uri'];
		}
		
		switch($key){
			case "twitter-tweet" :
				$return = (array) json_decode( $socialmedia->social_data );
				$socialmedia_name = "Activorm"; //$return['screen_name'];
				$return = array(
					'status' => $tweet_status . ' via @' . $socialmedia_name,
					'social_oauth_data' => $social_oauth_data
				);
				$return['type_name'] = "Tweet Something";
				break;
			case "twitter-follow" :
				$return = (array) json_decode( $socialmedia->social_data );
				$socialmedia_name = $return['screen_name']; //"Activorm"; //$return['screen_name'];
				$return['social_oauth_data'] = $social_oauth_data;
				$return['type_name'] = "Follow Twitter @" . $socialmedia_name;
				break;
			case "twitter-hashtag" :
				$return = array(
					'status' => $tweet_status . ' ' . $this->dataStatus['project_hashtags'],
					'social_oauth_data' => $social_oauth_data
				);
				$return['type_name'] = "Tweet Hashtag";
				break;
			case "twitter-to" :
				$social_data = json_decode( $socialmedia->social_data );
				$socialmedia_name = "Activorm"; //$social_data->screen_name;
				$return = array(
					'status' => $tweet_status .' @'.$socialmedia_name,
					'social_data' => (array) $social_data,
					'social_oauth_data' => $social_oauth_data
				);
				$return['type_name'] = "Tweet to @ " . $socialmedia_name;
				break;
		}
		if ($custom > 0) $key = $key . "_customactions";
		$return['type_step'] = $key;
		return $return;
	}
	
	function _default_param($css = array(), $js = array(), $meta = array(), $title = ""){
		/*$default_css = array(
		);
		if (!empty($css)) $css = array_merge($default_css, $css);
		else $css = $default_css;*/
		//if (!empty($js)) $js = array_merge($default_js, $js);
		$this->default_param($css, $js, $meta, $title);
	}
}

?>