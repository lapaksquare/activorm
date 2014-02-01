<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rangking extends MY_Admin_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	var $offset = 10;
	
	function index(){
				
		$this->project_live = $this->input->get_post('project_live');
		$this->project_live = (empty($this->project_live)) ? 'Online' : $this->project_live;
		
		//$this->load->library('pagination_tmpl');
		//$page = intval($this->input->get_post('page'));
		
		$param_url = array(
			'project_live' => $this->project_live,
			//'page' => ''
		);
		
		$this->load->model('rangking_model');
		$this->results = $this->rangking_model->getRangkingMerchant($param_url);

		/*
		$param_url = http_build_query($param_url);
		
		$uri_page = 'admin/rangking?'.$param_url;
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->rangking_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);*/
		
		//$this->results = $this->project_analytics($this->results);
		
		/*echo '<pre>';
		print_r($this->results);
		echo '</pre>';die();*/
		
		$this->data['menu'] = 'rangking';
		$this->_default_param(
			"",
			array(
				'<script type="text/javascript" src="'.cdn_url().'js/a_rangking.js"></script>'
			),
			"",
			"Admin Login");
		$this->load->view('n/rangking/index_view', $this->data);
	}
	
	function getDataGA(){
		$project_id = $this->input->get_post('pid');
		$this->load->model('a_project_model');
		$project = $this->a_project_model->getProjectDetail($project_id);
		//print_r($project);
		if (!empty($project)) $this->project_analytics($project);
		$ref = $_SERVER['HTTP_REFERER'];
						
		if (empty($ref)){
			redirect(base_url().'admin/rangking');
		}else{
			redirect($ref);
		}
	}
	
	function project_analytics($results){
		$ga_session = $this->gaAuth();
		if (empty($ga_session)) return 0;
		
		$this->load->library("google_analytic_library");	
		$this->load->model("google_analytic_model");
				
		$ga_session = $this->gaAuth();
		$accessToken = $ga_session->auth->access_token;
		$this->google_analytic_library->ga->setAccessToken($accessToken);
		$this->google_analytic_library->ga->setAccountId('ga:78298628');
		// Set the default params. For example the start/end dates and max-results
		$defaults = array(
		    'end-date' => date('Y-m-d', strtotime('- 1 days')),
		);
		$this->google_analytic_library->ga->setDefaultQueryParams($defaults);
		
		$return = array();
		//foreach($results as $k=>$v){
			$project_uri = $results->project_uri;
			$params = array(
				'metrics' => 'ga:pageviews,ga:visitBounceRate,ga:bounces,ga:visits',
				'dimensions' => 'ga:pagePath',
				'start-date' => "2013-10-27",
				'filters' => 'ga:pagePath==/project/' . $project_uri,
				'max-results' => 500,
				'sort' => '-ga:pageviews'
			);
			$this->traffics = $this->google_analytic_library->ga->query($params);
			$data = array();
			if (!empty($this->traffics['rows'])){
				foreach($this->traffics['rows'] as $a=>$b){
					$data = $this->google_analytic_model->getAnalticsPageProject($results->project_id);
					if (empty($data)){
						$data = array(
							'project_id' => $results->project_id,
							'pageviews' => $b[1],
							'bouncerate' => $b[2],
							'bounces' => $b[3],
							'visits' => $b[4]
						);
						$this->google_analytic_model->addAnalyticPageProject($data);
					}else{
						$t = date('Y-m-d', strtotime($data['lastupdate']));
						$n = date('Y-m-d');
						if ($t != $n){
							$data = array(
								'pageviews' => $b[1],
								'bouncerate' => $b[2],
								'bounces' => $b[3],
								'visits' => $b[4]
							);
							$this->google_analytic_model->updateAnalyticPageProject($data, $results->project_id);
							$data['project_id'] = $results->project_id;
						}
					}
				}
			}	
			if (!empty($data)){
				$data = array_merge((array)$results, $data);
			}
			$return[$results->project_id] = $data;
		//}
		
		/*
		echo '<pre>';
		print_r($return);
		echo '</pre>';
		*/
		
		//return $return;
	}
	function gaAuth(){
		try{
			$this->load->library("google_analytic_library");	
			$this->load->model('config_model');
			
			$config = $this->config_model->getConfigData("google_analytic_session");
			$ga_session = json_decode($config);
			
			//echo '<pre>';print_r($ga_session);echo '</pre>';die();
			
			// Check if the accessToken is expired
			$tokenExpires = $ga_session->auth->expires_in;
			$refreshToken = $ga_session->auth->refresh_token;
			if ((time() - $ga_session->token_created) >= $tokenExpires) {
			    $auth = $this->google_analytic_library->ga->auth->refreshAccessToken($refreshToken);
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
				
				$this->config_model->addConfig("google_analytic_session", $ga_session);
				
				//$this->session->set_userdata("ga_session", $ga_session);
				//redirect(base_url() . 'auth/ga_testing2');
				
				$ga_session = json_decode($ga_session);
			}
			return $ga_session;
		}catch (exception $e){
			return array();
		}
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