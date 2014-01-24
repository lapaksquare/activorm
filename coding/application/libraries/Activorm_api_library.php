<?php 

class Activorm_api_library{
	
	var $ci;

	function __construct(){
		$this->ci =& get_instance();
	}
	
	function getAnalyticProject($projecturi, $businesstoken){
		$this->ci->load->model('dashboard_model');
		$this->project = $this->ci->dashboard_model->getBusinessProjectByProjectUri($projecturi);
		
		if (empty($this->project)){
			return array(
				'status' => 400,
				'message' => 'Project tidak terindentifikasi.'
			);
		}
		$verification_code = substr( sha1($this->project['verification_code'] . SALT) , 0, 10);
		if ($businesstoken != $verification_code){
			return array(
				'status' => 400,
				'message' => 'Business Token tidak terindentifikasi.'
			);
		}
		
		$project_actions_data_cols = array();
		$project_actions_data = json_decode( $this->project['project_actions_data'] );
		foreach($project_actions_data as $k=>$v){
			$j = 'jml_action'.($k+1);
			$project_actions_data_cols['project_actions'][] = array(
				'action_name' => ucwords($v->type_name),
				'action_count' => $this->project['member_join'] 
			);
		}
		
		$project_analytics = $this->project_analytics($this->project['project_id'], $this->project['project_uri']);
		$project_analytics_cols = array();
		if (!empty($project_analytics)){
			$project_analytics_cols['analytic'] = array(
				'pageviews' => $project_analytics['pageviews'],
				'bouncerate' =>  $project_analytics['bouncerate'] . '%'
			);
			$this->project = array_merge($this->project, $project_analytics_cols);
		}
		
		$array1 = array_merge($this->project, $project_actions_data_cols);
		$array2 = array(
			'project_name' => '',
			'project_uri' => '',
			'project_posted' => '',
			'project_period' => '',
			'project_actions' => '',
			'member_join' => '',
			'analytic' => ''
		);
		$result = array_intersect_key($array1, $array2);
		
		return $result;
	}
	
	
	
	
	
	
	
	
	/* PROJECT ANALYTICS ================= START ======================= */
	function project_analytics($project_id, $project_uri){
		
		$this->ci->load->library("google_analytic_library");	
		$this->ci->load->model("google_analytic_model");
				
		$data = $this->ci->google_analytic_model->getAnalticsPageProject($project_id);
		if (empty($data)){
			
			$data = $this->getGAProjectAnalytics($project_id, $project_uri);
			
			if (!empty($data)) $this->ci->google_analytic_model->addAnalyticPageProject($data);
			
		}else{
			$t = date('Y-m-d', strtotime($data['lastupdate']));
			$n = date('Y-m-d');
			if ($t != $n){
				
				$data = $this->getGAProjectAnalytics($project_id, $project_uri);
				if (!empty($data)){
					unset($data['project_id']);
					$this->ci->google_analytic_model->updateAnalyticPageProject($data, $project_id);
					$data['project_id'] = $project_id;
				}
				
			}
		}
			
		
		$return = $data;
		return $return;
	}
	function getGAProjectAnalytics($project_id, $project_uri){
		$ga_session = $this->gaAuth();
		if (empty($ga_session)) return array();
		
		$accessToken = $ga_session->auth->access_token;
		$this->ci->google_analytic_library->ga->setAccessToken($accessToken);
		$this->ci->google_analytic_library->ga->setAccountId('ga:78298628');
		// Set the default params. For example the start/end dates and max-results
		$defaults = array(
		    'end-date' => date('Y-m-d', strtotime('- 1 days')),
		);
		$this->ci->google_analytic_library->ga->setDefaultQueryParams($defaults);
		
		$return = array();
		$params = array(
			'metrics' => 'ga:pageviews,ga:visitBounceRate,ga:bounces,ga:visits',
			'dimensions' => 'ga:pagePath',
			'start-date' => "2013-10-27",
			'filters' => 'ga:pagePath==/project/' . $project_uri,
			'max-results' => 500,
			'sort' => '-ga:pageviews'
		);
		$this->traffics = $this->ci->google_analytic_library->ga->query($params);
		$data = array();
		if (!empty($this->traffics['rows'])){
			foreach($this->traffics['rows'] as $a=>$b){
		
				$data = array(
					'project_id' => $project_id,
					'pageviews' => $b[1],
					'bouncerate' => $b[2],
					'bounces' => $b[3],
					'visits' => $b[4]
				);
				
				
			}
			
		}
		return $data;
	}
	function gaAuth(){
		try{
			$this->ci->load->library("google_analytic_library");	
			$this->ci->load->model('config_model');
			
			$config = $this->ci->config_model->getConfigData("google_analytic_session");
			$ga_session = json_decode($config);
			
			//echo '<pre>';print_r($ga_session);echo '</pre>';die();
			
			// Check if the accessToken is expired
			$tokenExpires = $ga_session->auth->expires_in;
			$refreshToken = $ga_session->auth->refresh_token;
			if ((time() - $ga_session->token_created) >= $tokenExpires) {
			    $auth = $this->ci->google_analytic_library->ga->auth->refreshAccessToken($refreshToken);
			    // Get the accessToken as above and save it into the Database / Session
			    //echo '<pre>';print_r($auth);echo '</pre>';
			    $accessToken = $auth['access_token'];
			    $refreshToken = (empty($auth['refresh_token'])) ? $refreshToken : $auth['refresh_token'];
				$auth['refresh_token'] = $refreshToken;
			    $tokenExpires = $auth['expires_in'];
			    $tokenCreated = time();
				
				$ga_session = json_encode(array(
					'auth' => $auth,
					'token_created' => $tokenCreated
				));
				
				$this->ci->config_model->addConfig("google_analytic_session", $ga_session);
				
				//$this->session->set_userdata("ga_session", $ga_session);
				//redirect(base_url() . 'auth/ga_testing2');
				
				$ga_session = json_decode($ga_session);
			}
			return $ga_session;
		}catch (exception $e){
			return array();
		}
	}
	/* PROJECT ANALYTICS ================= END ======================= */

}

?>