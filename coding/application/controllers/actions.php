<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Actions extends MY_Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	var $project;
	
	function trigger_actions(){
		
		$projectid = $this->input->get_post('projectid');
		$hash = $this->input->get_post('hash');
		$actions = $this->input->get_post('actions');
		$hashactions = $this->input->get_post('hashactions');
		
		$hash_ori = sha1($projectid . SALT);
		$hashactions_ori = sha1($actions . SALT);
		
		$ref = $_SERVER['HTTP_REFERER'];
		if ($hash != $hash_ori || $hashactions != $hashactions_ori){
			redirect($ref);
		}
		
		$this->load->model('project_model');
		$this->project = $this->project_model->getProject('pp.project_id', $projectid);
		$project_actions_data = json_decode($this->project->project_actions_data);
		
		//if ($isok == 0){		
			if (empty($this->access->user)) redirect(base_url() . 'auth/facebook_connect_ref');
		//}
		
		$message = "Something Error!. Please try again.";
		
		//echo '<pre>';print_r($project_actions_data);echo '</pre>';
		
		foreach($project_actions_data as $k=>$v){
			if ($k == $actions){
				
				$type_step = $v->type_step;
				list($type_step) = explode("_", $v->type_step);
				
				//echo $type_step;die();
				
				switch($type_step){
					
					// facebook
					case "facebook-like" :
						$return = $this->checkFacebookLikePage($v->id); 
						if ($return == 0){
							$message = "Like Facebook failed caused by session timeout or you missed to hit Like button before continue. Please try again.";
						}
						break;
					case "facebook-follow" :
						$return = $this->checkFacebookFollowUser(array(
							'id' => $v->id,
							'link' => $v->link
						)); 
						break; 
					case "facebook-send" :
						$return = $this->checkFacebookPost($v); 
						break; 
					
					// twitter
					case "twitter-tweet" :
						$return = $this->checkTwitterTweet($v); 
						if ($return == 0){
							$message = "Oops you already did this action with the same account before.";
						}
						break; 
					case "twitter-follow" :
						$return = $this->checkTwitterFollow($v); 
						if ($return == 0){
							$message = "Follow Twitter Account action failed caused by session timeout or you follow your own account. Please try again.";
						}
						break; 
					case "twitter-to" :
						$return = $this->checkTwitterTweet($v); 
						if ($return == 0){
							$message = "Oops you already did this action with the same account before.";
						}
						break; 
					case "twitter-hashtag" :
						$return = $this->checkTwitterTweet($v); 
						if ($return == 0){
							$message = "Oops you already did this action with the same account before.";
						}
						break; 
						
				}
				
				break;
			}
		}
		
		if ($return == 0){
			$this->session->set_userdata('message_project_actions_error', $message);
		}else{
			$this->session->set_userdata('message_project_actions_success', 'Action succeed!');
		}
		
		$account_id = $this->session->userdata('account_id');
		$this->project_model->registerActions($projectid, $account_id, $actions+1, $return);
		
		//if ($this->project->redeem_tiket_merchant == 0){
			$generate_tiket = $this->generateTiket($projectid, $account_id);
		//}
		
		// project analytic
		//$this->project_analytic($projectid, $account_id, $this->project->account_id);
		
		redirect($ref);
		
	}

	function project_analytic($project_id, $account_id, $account_id_project){
		if ($account_id != $account_id_project){
			$ip_address = $this->input->ip_address();
			$this->load->model('project_analytic_model');
			$project_analytic = $this->project_analytic_model->checkProjectAnalytic($project_id, $ip_address);
			//$page_views = 0;
			$page_bounce_rate = 0;
			if (!empty($project_analytic)){
				//$page_views = $project_analytic->page_views;
				$page_bounce_rate = $project_analytic->page_bounce_rate;
			}
			//$page_views++;
			$page_bounce_rate++;
			$data = array(
				//'page_views' => $page_views,
				'page_bounce_rate' => $page_bounce_rate,
				'project_id' => $project_id,
				'ip_address' => $ip_address
			);
			$this->project_analytic_model->addProjectAnalytic($data);
		}
	}

	function generateTiket($project_id, $account_id, $action_premium = 0){
		$project_actions = $this->project_model->checkProjectActions($project_id, $account_id);
		if ( ($project_actions['action_1'] == 1 && $project_actions['action_2'] == 1 && $project_actions['action_3'] == 1) ){
			$this->load->library('util');	
			$barcode1 = $this->util->create_code(4, "text");
			$barcode2 = $this->util->create_code(4, "number");
			$data = array(
				'tiket_barcode' => $barcode1 . $barcode2,
				'project_id' => $project_id,
				'account_id' => $account_id
			);
			$this->project_model->registerTiket($data, $action_premium);
		}
	}
	
	function checkFacebookLikePage($idPage){
		//$dataFB = $this->access->facebook->api('/me/likes/' . $idPage);
		
		$dataFB = $this->access->facebook->api(array(
		  "method" => "fql.query",
		  "query"  => "SELECT uid FROM page_fan WHERE page_id = '".$idPage."' AND uid = '".$this->access->user."'"
		));//echo '<pre>';print_r($dataFB);echo '</pre>';die();
		
		// log
		$this->addLogData(array(
			'account_id' => $this->session->userdata('account_id'),
			'log_name' => '/me/likes/' . $idPage,
			'log_detail' => json_encode($dataFB)
		));		
				
		//if (!empty($dataFB) && !empty($dataFB['data'])){
		if (!empty($dataFB) && !empty($dataFB[0]['uid'])){
			return 1;	
		}
		
		return 1;
		
		/*
		echo '<pre>';
		print_r($dataFB);
		echo '</pre>';
		 * 
		 */
	}
	
	function checkFacebookFollowUser($user){
		
		try{
			$dataFB = $this->access->facebook->api('/me/og.follows', 'POST', array(
				'profile' => $user['link']
			));
		}catch(Exception $e){
			$dataFB = 0;
		}
		
		if (!empty($dataFB) && !empty($dataFB['data'])){
			return 1;	
		}
		
		return 0;
		
	}
	
	function checkFacebookPost($data){
				
		try{
			$dataFB = $this->access->facebook->api('/me/feed', 'POST', (array) $data);
			
			// log
			$this->addLogData(array(
				'account_id' => $this->session->userdata('account_id'),
				'log_name' => '/me/feed',
				'log_detail' => json_encode($dataFB)
			));		
			
		}catch(Exception $e){
			$dataFB = 0;
		}
				
		if (!empty($dataFB) && !empty($dataFB['id'])){
			return 1;	
		}
		
		return 0;
		
	}
	
	function checkTwitterOAuth(){
		$oauth_token = $oauth_token_secret = "";
		
		$account_id = $this->session->userdata('account_id');
		
		$this->load->model('socialmedia_model');
		$socialmedia = $this->socialmedia_model->getSocialMediaConnect($account_id, 'twitter');
		$social_oauth_data = json_decode( $socialmedia->social_oauth_data );
		$oauth_token = $social_oauth_data->oauth_token;
		$oauth_token_secret = $social_oauth_data->oauth_token_secret;
		
		return array(
			'oauth_token' => $oauth_token,
			'oauth_token_secret' => $oauth_token_secret
		);
	}
	
	function checkTwitterTweet($data){
		
		$oauth = $this->checkTwitterOAuth();
			
		$this->load->library('twitter_library');
		$this->twitter_library->connection($oauth['oauth_token'], $oauth['oauth_token_secret']);
		$return = $this->twitter_library->statusesUpdate($data->status);
		
		// log
		$this->addLogData(array(
			'account_id' => $this->session->userdata('account_id'),
			'log_name' => 'checkTwitterTweet - statusesUpdate',
			'log_detail' => json_encode($return)
		));		
		
		//print_r($return);die();
		if (!empty($return) && property_exists($return, 'id_str')){
			return 1;
		}
		
		return 0;
		
		/*
		echo '<pre>';
		print_r($return);
		echo '</pre>';
		
		die();	
		*/
	}
	
	function checkTwitterFollow($data){
		
		$oauth = $this->checkTwitterOAuth();
			
		$this->load->library('twitter_library');
		$this->twitter_library->connection($oauth['oauth_token'], $oauth['oauth_token_secret']);
		$return = $this->twitter_library->twitterFollow($data->id_str);
		
		// log
		$this->addLogData(array(
			'account_id' => $this->session->userdata('account_id'),
			'log_name' => 'checkTwitterFollow - twitterFollow',
			'log_detail' => json_encode($return)
		));		
		
		if (!empty($return) && property_exists($return, 'id_str') && property_exists($return, 'id')){
			return 1;
		}
		
		return 0;
		
		/*
		echo '<pre>';
		print_r($return);
		echo '</pre>';
		
		die();	
		*/
	}

	function premium(){
		$type = $this->input->get_post('type');
		$hash = $this->input->get_post('hash');
		$pid = $this->input->get_post('pid');
		$hash_ori = sha1($pid . $type . SALT);
		$ref = $_SERVER['HTTP_REFERER'];
		if ($hash != $hash_ori) redirect($ref);
		
		$account_id = $this->session->userdata('account_id');
		$this->load->model('project_model');
		$this->project = $this->project_model->getProject('pp.project_id', $pid);
		if ($this->project->premium_plan == 0) redirect($ref);
		$actions = $this->project_model->checkProjectActions($pid, $account_id);
		if ($actions['action_premium'] >= 2) redirect($ref);
		$action_premium_count = $actions['action_premium'] + 1;	
			
		$account_id_project = $this->project->account_id;
		
		$this->dataStatus = array(
			'project_name' => $this->project->project_name,
			'project_description' => $this->project->project_description,
			'project_uri' => base_url() . 'project/' . $this->project->project_uri
		);
		
		$social_media_data = "";
		if (!empty($this->project->social_format_data)){
			$social_media_data = json_decode($this->project->social_format_data);
		}
		
		/*
		echo '<pre>';
		print_r($social_media_data);
		echo '</pre>';die();
		*/
		
		switch($type){
			case "facebook" :
				
				$action_premium_fb = $actions['action_premium_fb'] + 1;	
				
				$data = array(
				 	//'message' => //'Testing link message',
				 	'name' => $this->dataStatus['project_name'],
				 	'link' => $this->dataStatus['project_uri'],
				 	'description' => $this->dataStatus['project_description'],
				);
				if (!empty($social_media_data->facebook_format) && $social_media_data->facebook_format != "null"){
					$data['message'] = $social_media_data->facebook_format;
				}
				
				$data = (object) $data;
				
				$this->checkFacebookPost($data);
				
				$this->project_model->registerActions($pid, $account_id, "premium_fb", $action_premium_fb);
				
				$generate_tiket = $this->generateTiket($pid, $account_id, $action_premium_fb);
								
				break;
			case "twitter" :		
				
				$action_premium_tw = $actions['action_premium_tw'] + 1;	
				
				$this->load->model('socialmedia_model');
				$socialmedia = $this->socialmedia_model->getSocialMediaConnect($account_id_project, 'twitter');
				$return = (array) json_decode( $socialmedia->social_data );
				$socialmedia_name = $return['name'];
				
				$tweet_status = $this->dataStatus['project_name'] . ' ' . $this->dataStatus['project_uri'];
				$tweet_status_completed = $tweet_status . ' via @' . $socialmedia_name;
				
				if (!empty($social_media_data->twitter_format) && $social_media_data->twitter_format != "null"){
					$tweet_status_completed = $social_media_data->twitter_format;
				}
				
				$data = (object) array(
					'status' => $tweet_status_completed
				);
				
				$this->checkTwitterTweet($data);
				
				$this->project_model->registerActions($pid, $account_id, "premium_tw", $action_premium_tw);
				
				$generate_tiket = $this->generateTiket($pid, $account_id, $action_premium_tw);
				
				break;
		}
		
		$this->project_model->registerActions($pid, $account_id, "premium", $action_premium_count);
		
		redirect($ref);
	}
	
	
	function addLogData($data){
		$this->load->model('log_model');
		$this->log_model->insertLog($data);
	}
	
	function redeem_tiket(){
		$tiket_barcode = $this->input->get_post('tid');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($tiket_barcode . SALT);
		if ($hash != $hash_ori) redirect(base_url() . '404');
		
		$this->load->model('tiket_model');
		$this->tiket_model->redeemTiket($tiket_barcode);
		
		$ref = $_SERVER['HTTP_REFERER'];
		redirect($ref);
	}
	
}

?>