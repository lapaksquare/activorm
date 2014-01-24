<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		//$this->session->set_userdata('current_uri', current_url());
	}
	
	var $segments;
	
	function index(){
		
		$this->segments = $this->uri->segment_array();
		$this->data['menu'] = 'project';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Project';
		
		if (!empty($this->segments[2]) && ($this->segments[2] == "create" || $this->segments[2] == "edit")){
			
			$this->load->library('scache');
			
			$account_id = $this->session->userdata('account_id');
			if (empty($account_id) || empty($this->access->member_account) || $this->access->member_account->account_type == "user") redirect(base_url());
			
			$this->data['project_actions_data_arr'] = array();
			if ($this->segments[2] == "edit"){
				$this->edit_project();
			}
			
			// social connect =============================== start ===================================
			$this->load->model('socialmedia_model');
			$account_id = $this->session->userdata('account_id');
			$socialmedia_account = $this->socialmedia_model->socialmedia_connect($account_id);
			$fb_name = "";
			if (!empty($socialmedia_account['facebook']) && !empty($socialmedia_account['facebook']->social_page_active)){
				$social_page_active = json_decode( $socialmedia_account['facebook']->social_page_active );
				$fb_name = $social_page_active->name;
			}
			
			$tw_name = "";
			if (!empty($socialmedia_account['twitter']) && !empty($socialmedia_account['twitter']->social_data)){
				$social_page_active = json_decode( $socialmedia_account['twitter']->social_data );
				$tw_name = $social_page_active->name;
			}
			
			$this->data['actions_label_info'] = array(
				'facebook' => $fb_name,
				'twitter' => $tw_name
			);
			// social connect =============================== end ===================================
			
			$title = 'Create Project';
			$view = 'project_create_view';
			$this->data['submenu'] = 'create';
			
			$css = array(
				'<link href="'.cdn_url().'css/jquery.tagbox.css" rel="stylesheet">'
			);
			$js = array(
				'<script src="'.cdn_url().'js/bootstrap-slider.min.js"></script>',
				'<script src="'.cdn_url().'js/jquery.simplyCountable.js"></script>',
				'<script src="'.cdn_url().'js/jquery.tagbox.js"></script>',
				'<script src="'.cdn_url().'js/create_project.js"></script>'
			);
		
		/*
		}else if (!empty($this->segments[2]) && $this->segments[2] == "details"){
			$title = 'Project Details';
			$view = 'project_details_view';
			$this->data['submenu'] = 'details';
			
			$js = array(
				'<script src="'.cdn_url().'js/jquery.sharrre-1.3.4.min.js"></script>',
				'<script src="'.cdn_url().'js/project_details.js"></script>'
			);
		 */
		  
		}else if (!empty($this->segments[2]) && $this->segments[2] == "pricing"){
			
			$this->pricing_overview();
			
			$title = 'Pricing';
			$view = 'project_pricing_view';
			$this->data['submenu'] = 'pricing';
			
			$js = array(
				'<script src="'.cdn_url().'js/bootstrap-slider.min.js"></script>',
				'<script src="'.cdn_url().'js/jquery.cookie.js"></script>',
				'<script src="'.cdn_url().'js/project_pricing.js"></script>'
			);
			
		/*	
		}else if (!empty($this->segments[2]) && $this->segments[2] == "grid"){
			$title = 'Projects Grid';
			$view = 'project_grid_view';
			$this->data['submenu'] = 'grid';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "list"){
			$title = 'Projects List';
			$view = 'project_list_view';
			$this->data['submenu'] = 'list';
		*/
		}else if (!empty($this->segments[2]) && $this->segments[2] == "submit_createproject"){
			$this->submit_createproject();			
		}else if (!empty($this->segments[2]) && $this->segments[2] == "submit_premiumproject"){
			$this->submit_premiumproject();			
		}else if (!empty($this->segments[2]) && $this->segments[2] == "submit_contactproject"){
			$this->submit_contactproject();
		}else{
			/*	
			$title = 'Projects List';
			$view = 'project_list_view';
			$this->data['submenu'] = 'list';
			*/
			$this->project_overview();
			
			//$title = 'Project Details';
			
			//print_r($this->segments);
			
			if (!empty($this->segments[3]) && $this->segments[3] == "widget"){
				$view = 'project_details_widget_view';
				$css = array(
					'<link href="'.cdn_url().'css/widget.css" rel="stylesheet">'
				);
			}else{
				$view = 'project_details_view';
			}
			
			
			$this->data['submenu'] = 'details';
			
			
			$js = array(
				'<script src="'.cdn_url().'js/jquery.simplyCountable.js"></script>',
				'<script src="'.cdn_url().'js/jquery.sharrre-1.3.4.min.js"></script>',
				'<script src="'.cdn_url().'js/project_details.js"></script>',
				'<script src="'.cdn_url().'js/project_steps.js"></script>'
			);
		}
		
		
		$this->data['title'] = (empty($this->data['title'])) ? $title : $this->data['title'];
		
		$this->_default_param($css, $js, $meta, $this->data['title']);
		$this->load->view('a/project/' . $view, $this->data);
	}
	
	var $dataStatus = array();
	function submit_createproject(){
		
		/*
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		
		die();
		*/
				
		$submit_btn = $this->input->get_post('submit-btn');
		$preview_btn = $this->input->get_post('preview-btn');
		$save_draft = $this->input->get_post('save-draft');
		$premium_submit_draft = $this->input->get_post('premium-submit-draft');
		
		$redirect = base_url() . 'project/create';
		
		if (!empty($submit_btn) || !empty($preview_btn) || !empty($save_draft) || !empty($premium_submit_draft)){
			
			$this->load->library('validate');
			
			// pid
			$pid = intval($this->input->get_post('pid'));
			$hash_pid = $this->input->get_post('pid_hash');
			$ori_hash_pid = sha1($pid . SALT);
			$type = "";
			if ($pid == 0){
				$type = "create";
			}else{
				if ($hash_pid == $ori_hash_pid){
					$type = "edit";
				}else{
					redirect($redirect);
				}
			}
									
			$project_name = $this->input->get_post('project_name');
			$project_prize = $this->input->get_post('project_prize');
			$prize_category = $this->input->get_post('prize_category');
			$project_description = $this->input->get_post('project_description');
			$project_tags = $this->input->get_post('project_tags');
			$project_hashtags = $this->input->get_post('project_hashtags');
			$project_period = $this->input->get_post('project_period');
			
			$step_upgrade = $this->input->get_post('step_upgrade');
			$step_upgrade_hash = $this->input->get_post('step_upgrade_hash');
			$step_upgrade_hash_ori = sha1($step_upgrade . SALT);
			
			$option_share = $this->input->get_post('option_share');
			$facebook_format = $this->input->get_post('facebook_format');
			$twitter_format = $this->input->get_post('twitter_format');
			
			
			/*contact person*/
			if (!empty($submit_btn)){
				//$contact_name = $this->input->get_post('contact_name');
				//$contact_email = $this->input->get_post('contact_email');
				//$contact_phone = $this->input->get_post('contact_phone');
				//$validateContactName = $this->validate->validateName($contact_name);
				//$validateContactEmail = $this->validate->validateEmail($contact_email);
			}
			
			/* actions */
			$actions_step = $this->input->get_post('actions_step');
			//print_r($actions_step);die();
			/**/
			
			$validateProjectName = $this->validate->validateName($project_name);
			$validateProjectPrize = $this->validate->validateName($project_prize);
			
			$errors = array();
			
			/*allow share*/
			if (!empty($option_share) && $option_share == "allow-share"){
				// fb 140	
				if (strlen($facebook_format) <= 0 || strlen($facebook_format) > 140){
					$errors[] = "Share Facebook Format must be (140 Character)";
				}
				// tw 120	
				if (strlen($twitter_format) <= 0 || strlen($twitter_format) > 120){
					$errors[] = "Share Twitter Format must be (120 Character)";
				}
			}
			//print_r($errors);die();
			
			if ($validateProjectName == 1){
				$errors[] = "Project Title must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 5 characters.";
			}
			//if ($validateProjectPrize == 1){
			//	$errors[] = "Project Prize must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 5 characters.";
			//}
			if (strlen($project_prize) < 5){
				$errors[] = "Project Prize must contain words only. Minimum 5 characters.";
			}
			if (strlen($project_description) <= 0 || strlen($project_description) > 500){
				$errors[] = "Project Description must be filled. Max 500 characters.";
			}
			//if (empty($actions_step) || count($actions_step) <= 0 || count($actions_step) > 3){
			//	$errors[] = "You have to pick 3 Actions to create this project.";
			//}
			if ($project_period < 7 || $project_period > 30){
				$errors[] = "Terjadi kesalahan dalam pengaturan periode";
			}
			
			if (!empty($submit_btn)){
				
				/*
				if (!empty($validateContactName) && !empty($validateContactEmail) && !empty($contact_phone)){
					if ($validateContactName == 1){
						$errors[] = "Terjadi kesalahan dalam penulisan Contact Name";
					}
					if ($validateContactEmail == 1){
						$errors[] = "Terjadi kesalahan dalam penulisan Contact Email";
					}
					$contact_phone = preg_replace("/[^0-9]/", "", $contact_phone);
					if (empty($contact_phone) || !is_numeric($contact_phone) || strlen($contact_phone) <= 4){
						$errors[] = 'Format telepon yang Anda masukkan salah.';
					}
				}*/
				
			}
			
			
			$this->load->library('util');
			$project_uri = $this->util->url_slug($project_name);
			$this->load->model('project_model');
			$project = $this->project_model->getProjectTaken('pp.project_uri', $project_uri, $pid);
			if (!empty($project) && !empty($project_name)){
				$errors[] = 'Project Title must be unique for URL link. The one you insert has been used.';
			}
			if ($type == "edit" && empty($submit_btn)){
				$redirect = base_url() . 'project/edit/' . $project_uri;
			}
			
			/*project live status*/
			$project_live = "Offline";
			if ($submit_btn == "Submit"){
				$project_live = "Draft";
				//$redirect = base_url() . 'dashboard/projects';
				$redirect = base_url() . 'project/edit/' . $project_uri;
			} else if ($preview_btn == "Preview"){
				$project_live = "Draft";
				if (!empty($project_uri)) $redirect = base_url() . 'project/' . $project_uri;
			} else if ($save_draft == "Save Draft"){
				$project_live = "Draft";
				$redirect = base_url() . 'project/edit/' . $project_uri;
				//$redirect = base_url() . 'dashboard/projects';
			} else if ($premium_submit_draft == "Continue"){
				$project_live = "Draft";
			}
			/* end */
			
			$premium_plan = 0;
			if (!empty($step_upgrade) && $step_upgrade_hash != $step_upgrade_hash_ori){
				$errors[] = "There is an error while transferring data. Please try again.";
			}else{
				if (!empty($step_upgrade) && $step_upgrade_hash == $step_upgrade_hash_ori) {
					$premium_plan = 1;
					//if (!empty($premium_submit_draft) && !empty($project_uri)) $redirect = base_url() . 'project/pricing/' . $project_uri;
				}
				//$project_live = "Draft";
			}
						
			$business_id = $this->session->userdata('business_id');
			$dataProject = array(
				'project_name' => $project_name,
				'project_uri' => $project_uri,
				'business_id' => $business_id,
				'project_period' => date('Y-m-d H:i:s', strtotime("+" . $project_period . " days")),
				'project_period_int' => $project_period,
				'project_prize_detail' => $project_prize,
				'project_prize_category' => $prize_category,
				'project_tags' => $project_tags,
				'project_hashtags' => $project_hashtags,
				'project_description' => $project_description,
				'project_live' => $project_live,
				'premium_plan' => $premium_plan,
				'project_posted' => date('Y-m-d H:i:s')
			);
			
			
			// UPLOAD IMAGES =================== start ============================
			$config['upload_path'] = './images/project/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size']	= '2024';
			$config['max_width']  = '2000';
			$config['max_height']  = '2000';
			$config['encrypt_name'] = true;
			
			$this->load->library('upload', $config);
			
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
				
			}
			
			//$dataProject['photo_thumb'] = $photo_thumb;
			// UPLOAD IMAGES =================== end ============================
			
			// UPLOAD FILE =================== start ============================
			$config['upload_path'] = './images/project_data/';
			$config['allowed_types'] = 'pdf';
			$config['encrypt_name'] = true;
			$config['max_size']	= '2024';
			
			$this->load->library('upload', $config);
						
			$uploaded = $this->upload->do_upload('attach_file');
			$project_file_data = "";
			if ($uploaded){
				//$error = $this->upload->display_errors();
				$data = $this->upload->data();
				//print_r($data);die();
				//print_r($error);
				
				$project_file_data = 'images/project_data/' . $data['file_name'];
								
				$dataProject['project_file_data'] = $project_file_data;
				
			}else{
				
				if (!empty($_FILES['attach_file']['name'])){
					$errors[] = 'There is an error while uploading file. File must be in jpeg/jpg/png format. Please try again.';
				}
				
			}			
			// UPLOAD FILE =================== end ============================
			
			
			/*actions*/
			if (empty($actions_step) || count($actions_step) < 3 || count($actions_step) >= 4){
				$errors[] = 'You have to pick 3 Actions to create this project.';
			}else{
			
				$this->dataStatus = array(
					'project_name' => $project_name,
					'project_description' => $project_description,
					'project_uri' => base_url() . 'project/' . $project_uri,
					'project_hashtags' => (!empty($project_hashtags)) ? '#'.$project_hashtags : '',
					'facebook_format' => $facebook_format,
					'twitter_format' => $twitter_format,
					'project_picture' => $photo_thumb
				);
			
				$actions_step_data = $this->func_actions_step($actions_step);
				
				$project_actions_data_arr = array();
				if (!empty($actions_step_data)){
					$project_actions_data = json_decode( $actions_step_data );
					foreach($project_actions_data as $k=>$v){
						$project_actions_data_arr[$v->type_step] = $v;
					}
				}
				$this->load->library('scache');
				$pvc = sha1(time());
				$this->session->set_userdata('pvc', $pvc);
				$this->scache->write('project#'. $pvc . '#', json_encode( $project_actions_data_arr ), 60 * 60);
				//$this->data['project_actions_data_arr'] = $project_actions_data_arr;
				
				if (empty($actions_step_data)){
					//$errors[] = 'Terjadi kesalahan dalam Social Media Connect. Koneksi '. $this->type_social . ' Anda mengalami masalah. Periksa kembali di menu <a href="'.base_url().'settings/socialmedia" target="_blank">Settings</a>.';
					$errors[] = 'You must connect Facebook, Twitter to proceed this project. Connect your Social Network Account at <a href="'.base_url().'settings/socialmedia" target="_blank">Settings</a>.';
				}
							
			}
			/**/
			
			
			if (count($errors) > 0){
								
				$this->session->set_userdata('project_name', $project_name);
				$this->session->set_userdata('project_prize', $project_prize);
				$this->session->set_userdata('prize_category', $prize_category);
				$this->session->set_userdata('project_description', $project_description);
				$this->session->set_userdata('project_tags', $project_tags);
				$this->session->set_userdata('project_period', $project_period);
				
				$this->session->set_userdata('message_create_project_error', $errors);
				
				$redirect = base_url() . 'project/create';
				
			}else{
				
				$dataProject['social_format_data'] = json_encode( array(
					'facebook_format' => $facebook_format,
					'twitter_format' => $twitter_format
				) );
				
				$dataProject['project_actions_data'] = $actions_step_data;
				
				/*actions debug*/
				/*
				echo '<pre>';
				print_r($actions_step_data);
				echo '</pre>';
				
				echo '<pre>';
				print_r(json_decode($actions_step_data));
				echo '</pre>';
				
				die();
				
				*/ 
				/**/
				
				$dataProject['project_contact_info'] = 0;
				if (!empty($submit_btn)){
					$dataProject['project_contact_info'] = 1;
				}
				
				$project_id = $this->project_model->registerProject($dataProject, $pid);
				
				$project_tags = explode(",", $project_tags);
				foreach($project_tags as $k=>$v){
					$tag_uri = $this->util->url_slug($v);
					$this->project_model->insertProjectTags(array(
						'project_id' => $project_id,
						'tag_name' => $v,
						'tag_uri' => $tag_uri
					));
				}

				/*
				if (!empty($project_hashtags)){
					foreach($project_hashtags as $k=>$v){
						$tag_uri = $this->util->url_slug($v);
						$this->project_model->insertProjectHashTags(array(
							'project_id' => $project_id,
							'tag_name' => $v,
							'tag_uri' => $tag_uri
						));
					}
				}*/

				if (!empty($submit_btn)){
					//$dataProject['project_contact_info'] = 1;
					/*
					$dataCP = array(
						'project_id' => $project_id,
						'name' => $contact_name,
						'email' => $contact_email,
						'phone_number' => $contact_phone
					);
					$this->project_model->insertProjectContact($dataCP, $pid);*/
				}
				

				$msg_txt = '';
				if ($submit_btn == "Submit"){
					//$msg_txt = "Project sudah disubmit.";
				} else if ($save_draft == "Save Draft"){
					$msg_txt = "Project Draft Saved!";
				}	
				if ($msg_txt != '') $this->session->set_userdata('message_create_project_success', $msg_txt);
					
			}
			
		}

		//echo $redirect;die();

		redirect($redirect);
		
	}

	function func_actions_step($actions_step = array(), $encode = 1){
		$return = array();
		
		$break = 0;
		
		$this->type_social = '';
		
		foreach($actions_step as $k=>$v){
			switch($k){
				
				// for facebook step
				case "facebook-like" : 
					$act = $this->facebook_step($k);
					$this->type_social = 'facebook';
					break;
				case "facebook-follow" :
					$act = $this->facebook_step($k);
					$this->type_social = 'facebook';
					break;
				case "facebook-send" :
					$act = $this->facebook_step($k);
					$this->type_social = 'facebook';
					break; 
					
				// for twitter step
				case "twitter-tweet" :
					$act = $this->twitter_step($k);
					$this->type_social = 'twitter';
					break; 
				case "twitter-follow" :
					$act = $this->twitter_step($k);
					$this->type_social = 'twitter';
					break; 
				case "twitter-hashtag" :
					$act = $this->twitter_step($k);
					$this->type_social = 'twitter';
					break;
				case "twitter-to" :
					$act = $this->twitter_step($k);
					$this->type_social = 'twitter';
					break;
						
			}
						
			if (empty($act)) {
				$break = 1;
				break;
			}
			
			$return[] = $act;
			
		}
						
		if ($break == 1){
			
			return array();
			
		}else{
		
			if ($encode == 1) $return = json_encode($return);
		
			return $return;
		}
	}
	
	function facebook_step($key){
		$this->load->model('socialmedia_model');
		$account_id = $this->session->userdata('account_id');
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
		$return['type_step'] = $key;
		return $return;
	}
	
	function twitter_step($key){
		$this->load->model('socialmedia_model');
		$account_id = $this->session->userdata('account_id');
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
				$socialmedia_name = "Activorm"; //$return['screen_name'];
				$return['social_oauth_data'] = $social_oauth_data;
				$return['type_name'] = "Follow Twitter";
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
		$return['type_step'] = $key;
		return $return;
	}
	
	function project_overview(){
		$this->load->model('project_model');
		$this->project = $this->project_model->getProject('pp.project_uri', $this->segments[2]);
		if (empty($this->project) || empty($this->segments[2])) redirect(base_url() . '404');
		
		$project_id = $this->project->project_id;
		$account_id = $this->session->userdata('account_id');
		$account_id_project = $this->project->account_id;
		
		//(in_array($this->project->project_live, array('Offline', 'Draft')) && ($this->project->project_active == 0 || $this->project->project_active == 1))
		
		if (in_array($this->project->project_live, array('Offline', 'Draft'))){
			if ($account_id != $account_id_project){
				redirect(base_url() . '404');
			}
		}
		
		/*
		echo '<pre>';
		print_r($this->project);
		echo '</pre>';
		 */ 
		
		// project actions 
		$project_actions_data = json_decode($this->project->project_actions_data);
		$this->data['project_actions_data'] = $project_actions_data;
		
		/*
		echo '<pre>';
		print_r($project_actions_data);
		echo '</pre>'; 
		*/
		
		// get action account current
		$this->data['project_actions'] = $this->project_model->checkProjectActions($project_id, $account_id);
		
		// project prize
		$this->data['project_prize'] = $this->project_model->getProjectPrice($project_id);
		
		// jumlah tiket
		$this->load->model('tiket_model');
		$jml_tiket = $this->tiket_model->getCountProjectTiket($project_id);
		$this->data['jml_tiket'] = (empty($jml_tiket)) ? 0 : $jml_tiket;
		$project_win_tiket = $this->tiket_model->getWinProjectTiket($account_id, $project_id);
		$this->data['project_win_tiket'] = $project_win_tiket;
		
		// get social media account current
		$this->load->model('socialmedia_model');
		$this->data['socialmedia'] = $socialmedia = $this->socialmedia_model->socialmedia_connect($account_id_project);
		
		// butuh required
		$socialmedia_user = $this->socialmedia_model->socialmedia_connect($account_id);
		$socialmedia_required = $socialmedia_account_required = array();
		foreach($project_actions_data as $k=>$v){
			list($type, $type_detail) = explode("-", $v->type_step);
			
			// link oauth
			$link_oauth = "#";
			switch($type){
				case "facebook" :
					$link_oauth = base_url() . 'auth/facebook_connect_ref'; //$this->access->fb_connect_url;
					break;
				case "twitter" : 
					$link_oauth = base_url() . 'auth/twitter_connect';
					break;
			}
			
			$socialmedia_required[$type] = array(
				'type_name' => $type,
				'isok' => 0,
				'link_oauth' => $link_oauth
			);
		}
		$isok = 0;
		foreach($socialmedia_user as $k=>$v){
			if (array_key_exists($v->social_name, $socialmedia_required)){
				$socialmedia_required[$v->social_name]['isok'] = 1;
				$isok++;
			}
		}
		$this->data['socialmedia_required'] = $socialmedia_required;
		$this->data['socialmedia_required_isok'] = $isok;
		
		$this->data['jml_tiket_user'] = $this->tiket_model->getCountPrizeAccount($account_id);
		//print_r($this->data['jml_tiket_user']);die();
		
		//if ($isok == 0){		
		//	if (empty($this->access->user)) redirect(base_url() . 'auth/facebook_connect_ref');
		//}
		
		/*
		echo $isok.' '. count($socialmedia_required) . '<pre>';
		print_r($socialmedia_required);
		echo '</pre>';
		*/
		
		/*
		echo '<pre>';
		print_r($this->data['socialmedia']);
		echo '</pre>'; */
		
		// project analytic 
		$this->project_analytic($project_id, $account_id, $account_id_project);
		
		// project comment
		$this->load->model('comment_model');
		$this->data['comments'] = $this->comment_model->getComment($project_id);
		
		/*
		echo '<pre>';
		print_r($this->data['comments']);
		echo '</pre>';
		die();
		*/
				
		// og meta
		$this->data['title'] = $this->project->project_name;
		$this->data['metaDescription'] = $this->project->business_description;
		$photos = $this->mediamanager->getPhotoUrl($this->project->project_primary_photo, "200x200");
		$this->data['metaImage'] = cdn_url() . $photos;
		
	} 

	function edit_project(){
		$this->load->model('project_model');
		
		if (empty($this->segments[3])) redirect(base_url() . '404');
		
		$this->project = $this->project_model->getProject('pp.project_uri', $this->segments[3]);
		
		$business_id = $this->session->userdata('business_id');
		if (empty($this->project) || $this->project->business_id != $business_id || $this->project->project_live != "Draft"){
			redirect(base_url() . '404');
		}
		
		// trigger actions
		$project_actions_data_arr = array();
		if (!empty($this->project->project_actions_data)){
			$project_actions_data = json_decode( $this->project->project_actions_data );
			foreach($project_actions_data as $k=>$v){
				$project_actions_data_arr[$v->type_step] = $v;
			}
		}
		$this->data['project_actions_data_arr'] = $project_actions_data_arr;
		
	}
	
	function pricing_overview(){
		$this->load->model('project_model');
		$this->load->model('point_model');
		
		if (empty($this->segments[3])) redirect(base_url() . '404');
				
		$this->project = $this->project_model->getProject('pp.project_uri', $this->segments[3]);
		
		//print_r($this->project);die();
		
		$business_id = $this->session->userdata('business_id');
		if (empty($this->project) || $this->project->business_id != $business_id || $this->project->project_live != "Draft" || $this->project->premium_plan == 0){
			redirect(base_url() . '404');
		}
		
		$this->data['points_user'] = $this->point_model->getAccountPoint($this->access->member_account->account_id);
	}
	
	function submit_premiumproject(){
		
		/*
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		die(); */
		
		$ref = $_SERVER['HTTP_REFERER'];
		
		$submit_btn = $this->input->get_post('submit-btn');
		if (!empty($submit_btn)){
			
			$this->load->library('validate');
			
			$contact_name = $this->input->get_post('contact_name');
			$contact_email = $this->input->get_post('contact_email');
			$contact_phone = $this->input->get_post('contact_phone');
			$validateContactName = $this->validate->validateName($contact_name);
			$validateContactEmail = $this->validate->validateEmail($contact_email);
			
			$pid = $this->input->get_post('pid');
			$pid_hash = $this->input->get_post('pid_hash');
			$pid_hash_ori = sha1($pid . SALT);
			
			$project_budget = 100000; //$this->input->get_post('project-budget');
			$project_budget = intval( $project_budget ) / 1000;
			
			$errors = array();
			
			if ($validateContactName == 1){
				$errors[] = "Your name must contain words only (you may not use special characters e.g. - , > , % , $). Minimum 4 characters.";
			}
			if ($validateContactEmail == 1){
				$errors[] = "Please insert the correct email.";
			}
			$contact_phone = preg_replace("/[^0-9]/", "", $contact_phone);
			if (empty($contact_phone) || !is_numeric($contact_phone) || strlen($contact_phone) <= 4){
				$errors[] = 'Phone Number may consists of numbers only.';
			}
			
			$cplan = $this->input->get_post('cplan');
			$plan_type = $this->input->get_post('plan_type');
			$plan_type_hash = $this->input->get_post('plan_type_hash');
			$plan_type_hash_ori = sha1($cplan . SALT);
			
			if (empty($cplan) || empty($plan_type[$cplan]) || $plan_type_hash_ori != $plan_type_hash[$cplan] || $pid_hash != $pid_hash_ori){
				$errors[] = 'There is an error while submitting message. Please try again.';
			}
			
			if (count($errors) > 0){
				$this->session->set_userdata('message_submit_premiumproject', 1);
			}else{
				$this->session->set_userdata('message_submit_premiumproject', 2);
				$ref = base_url() . 'dashboard/projects';
				
				$this->load->model('point_model');
				$point = $this->point_model->getAccountPoint($this->access->member_account->account_id);
				$project_point = $point - $project_budget;
				
				$this->point_model->updateMemberPoint(array(
					'point' => $project_point
				), $this->access->member_account->account_id);
				
				$this->load->model('project_model');
				
				$dataCP = array(
					'project_id' => $pid,
					'name' => $contact_name,
					'email' => $contact_email,
					'phone_number' => $contact_phone
				);
				$this->project_model->insertProjectContact($dataCP, $pid);
				
				//print_r($dataCP);die();
				
				$project_live = "Offline";
				$this->project_model->registerProject(array(
					'premium_plan_type' => $cplan,
					'project_live' => $project_live,
					'project_point' => $project_budget
				), $pid);
				
				//$data_premium_plan = $this->dataPremiumPlan($cplan);
				
			}
			
		}

		
		redirect($ref);
		
	}

	function dataPremiumPlan($cplan){
		$data = array();
		switch($cplan){
			case "cpm" :
				break;
			case "ppc" :
				break;
			case "mj" :
				break;  
		}
		return $data;
	}
	
	function project_analytic($project_id, $account_id, $account_id_project){
		
		$this->load->model('project_analytic_model');
		
		if ($account_id != $account_id_project){
			$ip_address = $this->input->ip_address();
			$project_analytic = $this->project_analytic_model->checkProjectAnalytic($project_id, $ip_address);
			$page_views = 0;
			//$page_bounce_rate = 0;
			if (!empty($project_analytic)){
				$page_views = $project_analytic->page_views;
				//$page_bounce_rate = $project_analytic->page_bounce_rate;
			}
			$page_views++;
			//$page_bounce_rate++;
			$data = array(
				'page_views' => $page_views,
				//'page_bounce_rate' => $page_bounce_rate,
				'project_id' => $project_id,
				'ip_address' => $ip_address
			);
			$this->project_analytic_model->addProjectAnalytic($data);
		}
		
		if (!empty($_SERVER['HTTP_REFERER'])){
			
			// kalau dari link trigger klik
			$ref = $_SERVER['HTTP_REFERER'];
			$url_path = parse_url($ref, PHP_URL_PATH);
			$url_path = explode("/", $url_path);
			
			if (!empty($url_path[1]) && ($url_path[1] == "prize" || $url_path[1] == "search")){
				// masuk ke project click
				//echo 'project click';
				$this->project_analytic_model->project_click($project_id);
			}else{
				// masuk ke prize click/fans
				//echo 'prize click';
				$this->load->model('prize_model');
				$prize_id = $this->prize_model->getPrizeId($project_id);
				if ($prize_id > 0) $this->project_analytic_model->prize_click($prize_id);
			}
			
		}else{
				
			// kalau dari webbrowser link	
				
			// masuk ke project click
			//echo 'project click';
			$this->project_analytic_model->project_click($project_id);
			
		}
	}
	
	function submit_contactproject(){
		$contact_name = $this->input->get_post('contact_name');
		$contact_email = $this->input->get_post('contact_email');
		$contact_phone = $this->input->get_post('contact_phone');
		$submit_btn = $this->input->get_post('submit-btn');
		$redirect = base_url() . 'dashboard/projects';
		if (!empty($submit_btn)){
			$this->load->model('project_model');
			// pid
			$pid = intval($this->input->get_post('pid'));
			$hash_pid = $this->input->get_post('pid_hash');
			$ori_hash_pid = sha1($pid . SALT);
						
			if ($hash_pid != $ori_hash_pid) redirect($redirect);
			
			$dataCP = array(
				'project_id' => $pid,
				'name' => $contact_name,
				'email' => $contact_email,
				'phone_number' => $contact_phone
			);
			$this->project_model->insertProjectContact($dataCP, $pid);

			$project_id = $this->project_model->registerProject(array(
				'project_live' => 'Offline'
			), $pid);
			
		}
		redirect($redirect);
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