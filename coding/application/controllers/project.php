<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		//$this->session->set_userdata('current_uri', current_url());
		$this->load->library('scache');
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
			
			$account_id = $this->session->userdata('account_id');
			if (empty($account_id) || empty($this->access->member_account) || $this->access->member_account->account_type == "user") redirect(base_url());
			
			$this->data['project_actions_data_arr'] = array();
			if ($this->segments[2] == "edit"){
				$this->edit_project();
			}
			
			$this->social_actions_func();
			
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
				$css = array(
					'<link rel="stylesheet" href="'.cdn_url().'js/nivoslider/themes/default/default.css" type="text/css" media="screen" />',
					'<link rel="stylesheet" href="'.cdn_url().'js/nivoslider/themes/light/light.css" type="text/css" media="screen" />',
					'<link rel="stylesheet" href="'.cdn_url().'js/nivoslider/nivo-slider.css" type="text/css" media="screen" />'
				);
			}
			
			
			$this->data['submenu'] = 'details';
			
			
			$js = array(
				'<script src="'.cdn_url().'js/jquery.simplyCountable.js"></script>',
				'<script src="'.cdn_url().'js/jquery.sharrre-1.3.4.min.js"></script>',
				'<script type="text/javascript" src="'.cdn_url().'js/nivoslider/jquery.nivo.slider.js"></script>',
				'<script src="'.cdn_url().'js/project_timer.js"></script>',
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
		
		$this->load->model('point_model');
		$points_user = $this->point_model->getAccountPoint($this->access->member_account->account_id);
		$points_balance = 100;
		
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
			
			$project_name = str_replace('"', "'", $project_name);
			$project_prize = str_replace('"', "'", $project_prize);
			
			//$step_upgrade = $this->input->get_post('step_upgrade');
			//$step_upgrade_hash = $this->input->get_post('step_upgrade_hash');
			//$step_upgrade_hash_ori = sha1($step_upgrade . SALT);
			$cid = $project_plan = $this->input->get_post('project-plan');
			$project_plan_type_string = "";
			$premium_plan = 0;
			switch($project_plan){
				case sha1("FREE".SALT):
					$project_plan_type = 1;
					break;
				case sha1("PREMIUM100K".SALT):
					$project_plan_type = 2;
					$project_plan_type_string = "PREMIUM100K";
					$premium_plan = 1;
					break;
			}
			
			$opt_premium = $this->input->get_post('opt_premium');
			
			$option_share = $this->input->get_post('option_share');
			$facebook_format = $this->input->get_post('facebook_format');
			$twitter_format = $this->input->get_post('twitter_format');
			
			//$redeem_tiket = $this->input->get_post('redeem_tiket');
			$redeem_tiket_merchant = 0;
			if ($opt_premium == "redeem_tiket"){
				$redeem_tiket_merchant = 1;
			}
			
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
			
			//if ($validateProjectName == 1){
			if (strlen($project_name) < 5){	
				$errors[] = "Project Prize must contain words only. Minimum 5 characters.";
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
			
			if ($premium_plan == 1 && $points_user < $points_balance && !empty($preview_btn)){
				$errors[] = "You don't have enough balance, please <a href='".base_url()."dashboard/pointstopup'>Top Up</a>";
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
			
			
			/****
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
			*****/
			
			
			/*********** PREMIUM PLAN ****************/
			
			/*********** PREMIUM PLAN ****************/
			
						
			$business_id = $this->access->business_account->business_id; //$this->session->userdata('business_id');
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
				'project_posted' => date('Y-m-d H:i:s'),
				'redeem_tiket_merchant' => $redeem_tiket_merchant
			);
			
			
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
			
			/* =================== SINGEL UPLOAD =======================
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
			
			//$dataProject['photo_thumb'] = $photo_thumb;
			// UPLOAD IMAGES =================== end ============================
			
			
			if ($opt_premium == "direct-tickets"){
			// UPLOAD FILE =================== start ============================
			$config['upload_path'] = './images/project_data/';
			$config['allowed_types'] = 'jpg|jpeg|png|pdf';
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
					$errors[] = 'There is an error while uploading file. File must be in PDF/JPG/PNG format. Please try again.';
				}
				
			}			
			// UPLOAD FILE =================== end ============================
			}
			
			
			/*actions*/
			if ( (empty($actions_step) || count($actions_step) < 3 || count($actions_step) >= 4) && $this->authActions() == 0){
				$errors[] = 'You have to pick 3 Actions to create this project.';
			}else{
			
				$this->dataStatus = array(
					'project_name' => $project_name,
					'project_description' => $project_description,
					'project_uri' => base_url() . 'project/' . $project_uri,
					'project_hashtags' => (!empty($project_hashtags)) ? '#'.$project_hashtags : '',
					'facebook_format' => $facebook_format,
					'twitter_format' => $twitter_format,
					//'project_picture' => $photo_thumb
				);
				
				if (!empty($photo_thumb)){
					$this->dataStatus['project_picture'] = $photo_thumb;
				}
			
				$actions_step_data = $this->func_actions_step($actions_step);
				
				//echo '<pre>';print_r($actions_step_data);echo '</pre>';die();
				
				$project_actions_data_arr = array();
				if (!empty($actions_step_data)){
					$project_actions_data = json_decode( $actions_step_data );
					foreach($project_actions_data as $k=>$v){
						if (property_exists($v, "type_step"))
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
					$errors[] = 'You must connect Facebook, Twitter to proceed this project. Connect your Social Network Account at <a href="'.base_url().'settings/socialmedia" target="_blank">Settings</a>';
					$errors[] = 'Something Error, Please check again actions that you choose.';
				}else if (count($project_actions_data) < 3 || count($project_actions_data) >= 4){
					$errors[] = 'You have to pick 3 Actions to create this project.';
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
				
				$redirect = base_url() . 'project/create?cid=' . $cid;
				
			}else{
				
				if ($opt_premium == "allow-share"){
					$dataProject['social_format_data'] = json_encode( array(
						'facebook_format' => $facebook_format,
						'twitter_format' => $twitter_format
					) );
				}
				
				$dataProject['project_actions_data'] = $actions_step_data;
				
				if ($project_plan_type == 2){
					$dataProject['premium_plan_type'] = $project_plan_type_string;
				}
				
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
				
				if ($preview_btn == "Preview"){
					$pvc = $this->session->userdata('pvc');
					$this->scache->clear('project#'. $pvc . '#');
					$this->session->unset_userdata('pvc');
				}
					
			}
			
		}

		//echo $redirect;die();

		redirect($redirect);
		
	}

	function func_actions_step($actions_step = array(), $encode = 1){
		$return = array();
		
		$break = 0;
		
		$this->type_social = '';
		
		if (empty($actions_step)) return array();
		
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
					
				// for instagram step
				case "instagram-follow" :
					$act = $this->instagram_step($k);
					$this->type_social = 'instagram';
					break;
				case "instagram-like" :
					$act = $this->instagram_step($k);
					$this->type_social = 'instagram';
					break;
			}
						
			if (empty($act)) {
				$break = 1;
				break;
			}
			
			$return[] = $act;
			
		}
		
		
		/* CUSTOM ACTIONS ======= START ======= */
		if (count($return) < 3 && $this->authActions() == 1){
			// follow twitter activorm
			$act = $this->twitter_step("twitter-follow", 14);
			$act['custom_actions'] = 'business_rel_to_action_twitter_follow_activorm';
			$this->type_social = 'twitter';
			$key = array_keys($return);
			$key = end($key);
			$return[($key+1)] = $act;
		}
		/* CUSTOM ACTIONS ======= END   ======= */
		
						
		if ($break == 1){
			
			return array();
			
		}else{
		
			if ($encode == 1) $return = json_encode($return);
		
			return $return;
		}
	}

	function authActions(){
		$account_id = $this->session->userdata('account_id');
		$account_id_selected = array(962,4,14);
		if (in_array($account_id, $account_id_selected)) return 1;
		return 0;
	}
	
	function facebook_step($key, $account_id_selected = 0){
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
		if ($account_id_selected > 0) $key = $key . "_customactions";
		$return['type_step'] = $key;
		return $return;
	}
	
	function twitter_step($key, $account_id_selected = 0){
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
		if ($account_id_selected > 0) $key = $key . "_customactions";
		$return['type_step'] = $key;
		return $return;
	}
	function instagram_step($key, $account_id_selected = 0){
		$this->load->model('socialmedia_model');
		if ($account_id_selected == 0){
			$account_id = $this->session->userdata('account_id');
		}else{
			$account_id = $account_id_selected;
		}
		$socialmedia = $this->socialmedia_model->getSocialMediaConnect($account_id, 'instagram');
		
		if (empty($socialmedia) || empty($socialmedia->social_oauth_data)){
			return array();
		}
		
		$social_oauth_data = (array) json_decode( $socialmedia->social_oauth_data );
		
		$c = array();
		$url_photo_input = "";
		if ($key == "instagram-like"){
			$url_photo_input = $this->input->get_post('ig_url_photo');
			$url_photo = "http://api.instagram.com/oembed?url=" . $url_photo_input;
			$this->load->library('util');
			$c = $this->util->getDataUrl($url_photo);
			$c = (array) json_decode($c);
			if (empty($c)) return array();
		}
		
		$return = array();
		switch($key){
			case "instagram-follow" :
				$return = (array) json_decode( $socialmedia->social_data );
				$socialmedia_name = $return['user']->username; //"Activorm"; //$return['screen_name'];
				$return['social_oauth_data'] = $social_oauth_data;
				$return['type_name'] = "Follow Instagram @ " . $socialmedia_name;
				break;
			case "instagram-like" :
				$return['photo_url'] = $url_photo_input;
				$return['photo_data'] = $c;
				$return['social_oauth_data'] = $social_oauth_data;
				$return['type_name'] = "Like Instagram Photo";
				break;
		}
		if ($account_id_selected > 0) $key = $key . "_customactions";
		$return['type_step'] = $key;
		return $return;
	}
	
	function project_overview(){
		$this->load->library('instagram_library');
		
		$this->load->model('project_model');
				
		//print_r($this->project);
		if (empty($this->segments[2])) redirect(base_url() . '404');
		
		//$this->project = $this->scache->read('cache#project#' . $this->segments[2]);
		$this->project = $this->cache->get('c#p#' . $this->segments[2]);
		
		if (empty($this->project)){
		
			$this->project = $this->project_model->getProject('pp.project_uri', $this->segments[2]);
			
			//$this->project = json_encode( $this->project );
			//$this->scache->write('c#p#' . $this->segments[2], $this->project, 60 * 60 * 24);
			$this->cache->write($this->project, 'c#p#' . $this->segments[2], 60 * 60 * 24);
			
		}	
		
		//$this->project = json_decode($this->project);		
		//echo '======';	
		//print_r($this->project);die();	
			
		if (empty($this->project) || empty($this->segments[2]) || $this->project->project_active == 0) redirect(base_url() . '404');
		
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
		//$project_prize = $this->scache->read('cache#getProjectPrice#' . $project_id);
		$project_prize = $this->cache->get('cache#getProjectPrice#' . $project_id);
		if (empty($project_prize)){
			$project_prize = $this->project_model->getProjectPrice($project_id);
			
			//$project_prize = json_encode( $project_prize );
			//$this->scache->write('cache#getProjectPrice#' . $project_id, $project_prize, 60 * 60 * 24);
			$this->cache->write($project_prize, 'cache#getProjectPrice#' . $project_id, 60 * 60 * 24);
		}
		//$project_prize = json_decode($project_prize);		
		$this->data['project_prize'] = $project_prize;
		
		// jumlah tiket
		$this->load->model('tiket_model');
		$jml_tiket = $this->tiket_model->getCountProjectTiket($project_id);
		$this->data['jml_tiket'] = (empty($jml_tiket)) ? 0 : $jml_tiket;
		$project_win_tiket = $this->tiket_model->getWinProjectTiket($account_id, $project_id);
		$this->data['project_win_tiket'] = $project_win_tiket;
		
		// get social media account current
		$this->load->model('socialmedia_model');
		
		//$socialmediaconnect = $this->scache->read('cache#socialmedia_connect#' . $account_id_project);
		$socialmediaconnect = $this->cache->get('cache#socialmedia_connect#' . $account_id_project);
		if (empty($socialmediaconnect)){
			$socialmedia = $this->socialmedia_model->socialmedia_connect($account_id_project);
			$socialmedia_cols = array();
			
			foreach($socialmedia as $k=>$v){
				$socialmedia_name = $link = "";
				$social_page_active = $v->social_page_active;
				if ($k == "facebook" && !empty($social_page_active)){
					$social_page_active = json_decode($social_page_active);
					$socialmedia_name = $social_page_active->name;
					$link = "http://www.facebook.com/" . $social_page_active->id;
				}else if ($k == "twitter"){
					$social_data = json_decode($v->social_data);
					$socialmedia_name = $social_data->name;
					$link = "http://www.twitter.com/" . $social_data->screen_name;
				}else if ($k == "instagram"){
					$social_data = json_decode($v->social_data);
					$socialmedia_name = $social_data->user->username;
					$link = "http://www.instagram.com/" . $socialmedia_name;
				}
				$socialmedia_cols[$k] = array(
					'link' => $link,
					'icon' => $k,
					'name' => ucfirst( $socialmedia_name )
				);
			}
			
			$socialmediaconnect = $socialmedia_cols;
			
			//echo '<pre>';print_r($socialmedia_cols);echo '</pre>';die();
			
			//$socialmediaconnect = json_encode( $socialmedia_cols );
			//$this->scache->write('cache#socialmedia_connect#' . $account_id_project, $socialmediaconnect, 60 * 60 * 24);
			$this->cache->write($socialmediaconnect, 'cache#socialmedia_connect#' . $account_id_project, 60 * 60 * 24);
		}
		//$socialmediaconnect = json_decode($socialmediaconnect);
		$this->data['socialmedia'] = $socialmediaconnect;
								
		// butuh required
		$socialmedia_user = $this->socialmedia_model->socialmedia_connect($account_id);
		$socialmedia_required = $socialmedia_account_required = array();
		
		//echo '<pre>';print_r($project_actions_data);echo '</pre>';die();
		
		foreach($project_actions_data as $k=>$v){
			
			if (!property_exists($v, "type_step")) continue;
			
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
				case "instagram" : // instagram
					$link_oauth = base_url() . 'auth/instagram_connect_ref';
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
		
		if (!empty($this->project->redeem_tiket_merchant)){
			$this->checkTiket = $this->tiket_model->checkTiket($project_id, $account_id);
			$this->load->model('prize_model');
			$this->prizeProfile = $this->prize_model->getPrizeProfileByProjectId($project_id);
		}
		
		// project analytic 
		$this->project_analytic($project_id, $account_id, $account_id_project);
		
		// project comment
		$this->load->model('comment_model');
		$this->data['comments'] = $this->comment_model->getComment($project_id);
		$this->data['total_comments'] = $this->comment_model->total_comment;
		
		// project photos
		//$this->project_photos = $this->scache->read('cache#getProjectPhotos#' . $project_id);
		$this->project_photos = $this->cache->get('cache#getProjectPhotos#' . $project_id);
		if (empty($this->project_photos)){
			$this->project_photos = $this->project_model->getProjectPhotos($project_id);
			
			//$this->project_photos = json_encode( $this->project_photos );
			//$this->scache->write('cache#getProjectPhotos#' . $project_id, $this->project_photos, 60 * 60 * 24);
			$this->cache->write($this->project_photos, 'cache#getProjectPhotos#' . $project_id, 60 * 60 * 24);
		}
		//$this->project_photos = json_decode($this->project_photos);		
		$metaImage = $this->project->project_primary_photo;
		if (!empty($this->project_photos)){
			$metaImage = $this->project_photos[0]->photo_file;
		}
		/*
		echo '<pre>';
		print_r($this->data['comments']);
		echo '</pre>';
		die();
		*/
		$freeplan = 0;
		if (!empty($this->access->member_account->account_id)){
			$freeplan = $this->project_model->getCountFreePlan($this->access->member_account->account_id);
		}
		$this->data['freeplan'] = $freeplan;
				
		// og meta
		$this->data['title'] = $this->project->project_name;
		$this->data['metaDescription'] = $this->project->business_description;
		$photos = $this->mediamanager->getPhotoUrl($metaImage, "200x200");
		$this->data['metaImage'] = cdn_url() . $photos;
		
	} 

	function edit_project(){
		$this->load->model('project_model');
		
		if (empty($this->segments[3])) redirect(base_url() . '404');
		
		$this->project = $this->project_model->getProject('pp.project_uri', $this->segments[3]);
		
		$business_id = $this->session->userdata('business_id');
		if (empty($this->project) || $this->project->business_id != $business_id){
			redirect(base_url() . '404');
		}
		
		// trigger actions
		$project_actions_data_arr = array();
		if (!empty($this->project->project_actions_data)){
			$project_actions_data = json_decode( $this->project->project_actions_data );
			foreach($project_actions_data as $k=>$v){
				if (!property_exists($v, "type_step")) continue;
				$project_actions_data_arr[$v->type_step] = $v;
			}
		}
		$this->data['project_actions_data_arr'] = $project_actions_data_arr;
		
		//echo '<pre>';print_r($project_actions_data_arr);echo '</pre>';
		
		$this->project_photos = $this->project_model->getProjectPhotos($this->project->project_id);
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
		
		/*
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
		}*/
		
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
			
			$this->project = $this->project_model->getProject('pp.project_id', $pid);
			
			$project_budget = 0;
			if (!empty($this->project)){
				if (!empty($this->project->premium_plan_type)){
					$project_budget = 100000; //$this->input->get_post('project-budget');
					$project_budget = intval( $project_budget ) / 1000;
					
					/*
					$this->load->model('point_model');
					$point = $this->point_model->getAccountPoint($this->access->member_account->account_id);
					$project_point = $point - $project_budget;
										
					$this->point_model->updateMemberPoint(array(
						'point' => $project_point
					), $this->access->member_account->account_id);*/
				}
			}
			
			$dataCP = array(
				'project_id' => $pid,
				'name' => $contact_name,
				'email' => $contact_email,
				'phone_number' => $contact_phone
			);
			$this->project_model->insertProjectContact($dataCP, $pid);

			$project_id = $this->project_model->registerProject(array(
				'project_live' => 'Offline',
				'project_point' => $project_budget
			), $pid);
			
			$this->cache->delete('c#p#' . $this->project->project_uri);
				
		}
		redirect($redirect);
	}
	
	/* =========== STEP FUNCTION ============= */
	function step_function(){
		$this->step_create = 1;
		
		$this->cid = $this->input->get_post('cid');
		
		if (!empty($this->project)){
			if (!empty($this->project->premium_plan_type)){
				$this->cid = sha1("PREMIUM100K" . SALT);
			}else{
				$this->cid = sha1("FREE" . SALT);
			}
		}
		
		switch($this->cid){
			case sha1("FREE".SALT) : 
				$this->step_create = 2;
				$this->cid_type = "FREE";
				break;
			case sha1("PREMIUM100K".SALT) :
				$this->step_create = 2;
				$this->cid_type = "PREMIUM100K";
				break;
		}
		
		$this->load->model('point_model');
		$this->data['points_user'] = $this->point_model->getAccountPoint($this->access->member_account->account_id);
		
		$this->load->model('project_model');
		$this->data['freeplan'] = $this->project_model->getCountFreePlan($this->access->member_account->account_id);
	}
	
	function social_actions_func(){
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
		
		$ig_name = "";
		if (!empty($socialmedia_account['instagram']) && !empty($socialmedia_account['instagram']->social_data)){
			$social_page_active = json_decode( $socialmedia_account['instagram']->social_data );
			$ig_name = $social_page_active->user->username;
		}
		
		$this->step_function();
		
		$this->data['actions_label_info'] = array(
			'facebook' => $fb_name,
			'twitter' => $tw_name,
			'instagram' => $ig_name
		);
		// social connect =============================== end ===================================
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