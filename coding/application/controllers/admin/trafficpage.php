<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trafficpage extends MY_Admin_Access {
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		
		$ga_session = $this->gaAuth();
		$accessToken = $ga_session->auth->access_token;
		$this->google_analytic_library->ga->setAccessToken($accessToken);
		$this->google_analytic_library->ga->setAccountId('ga:78298628');
		// Set the default params. For example the start/end dates and max-results
		
		/* TRAFFIC HALAMAN ====== START ====== */
		$startdate = $this->input->get_post('s');
		$enddate = $this->input->get_post('e');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($startdate.$enddate.SALT);
		if (empty($startdate) || empty($enddate) || empty($hash) || $hash != $hash_ori){
			$startdate = date("Y-m-d", strtotime("- 7 days"));
			$enddate = date("Y-m-d", strtotime("- 1 days"));
		}
		$this->keyal = "s=" . $startdate . "&e=" . $enddate . "&h=" . $hash;
		$this->load->library("google_analytic_library");
		$defaults = array(
		    'end-date' => date('Y-m-d', strtotime($enddate)),
		);
		$this->google_analytic_library->ga->setDefaultQueryParams($defaults);
		$params = array(
			'metrics' => 'ga:pageviews',
			'dimensions' => 'ga:hostname,ga:pagePath',
			'max-results' => 500,
			'start-date' => date('Y-m-d', strtotime($startdate)),
			'filters' => 'ga:hostname==activorm.com;ga:pagePath==/,ga:pagePath==/tickets',
			'sort' => '-ga:pageviews',
			'max-results' => 50,
		);
		$this->traffic_website = $this->google_analytic_library->ga->query($params);
		/*
		echo 'Traffic Halaman : <pre>';
		print_r($this->traffic_website);
		echo '</pre>';die();*/
		/* TRAFFIC HALAMAN ====== END ====== */
		
		
		/* TRAFFIC NEWSLETTER ===== START ===== */
		$dateutm = $this->input->get_post('dateutm');
		$dateutm = (empty($dateutm)) ? date('Y-m-d') : $dateutm;
		$defaults = array(
		    'end-date' => date('Y-m-d', strtotime($dateutm)),
		);
		$this->dateutm = date('Y-m-d', strtotime($dateutm));
		$this->google_analytic_library->ga->setDefaultQueryParams($defaults);
		$params = array(
			'metrics' => 'ga:pageviews',
			'dimensions' => 'ga:campaign,ga:source,ga:medium,ga:sourceMedium',
			'max-results' => 500,
			'start-date' => date('Y-m-d', strtotime($dateutm)),
			'filters' => 'ga:campaign!=(not set)',
			'sort' => '-ga:pageviews',
			'max-results' => 10,
		);
		$this->traffic_website_utm = $this->google_analytic_library->ga->query($params);
		/*echo 'Traffic Halaman : <pre>';
		print_r($this->traffic_website_utm);
		echo '</pre>';die();*/
		/* TRAFFIC NEWSLETTER ===== END ===== */
		
		$css = $js = array();
		$js = array(
			'<script src="'.cdn_url().'js/bootstrap.datepicker.js"></script>',
			'<script src="'.cdn_url().'js/a_trafficpage.js"></script>'
		);
		$css = array(
			'<link rel="stylesheet" type="text/css" href="'.cdn_url().'css/bootstrap.datepicker.css" />'
		);
		$this->data['menu'] = 'trafficpage';
		$this->data['menu_child'] = '';
		$this->_default_param(
			$css,
			$js,
			"",
			"Traffic Page - Activorm Connect");
		$this->load->view('n/trafficpage/trafficpage_view', $this->data);
	}
	
	function index1(){
		$this->load->library("google_analytic_library");
		$ga_session = $this->gaAuth();
		$accessToken = $ga_session->auth->access_token;
		$this->google_analytic_library->ga->setAccessToken($accessToken);
		$this->google_analytic_library->ga->setAccountId('ga:78298628');
		// Set the default params. For example the start/end dates and max-results
		$defaults = array(
		    'end-date' => date('Y-m-d', strtotime('- 1 days')),
		);
		$this->google_analytic_library->ga->setDefaultQueryParams($defaults);
		
		$params = array(
			'metrics' => 'ga:pageviews',
			'dimensions' => 'ga:campaign,ga:source,ga:medium,ga:sourceMedium',
			'max-results' => 500,
			'start-date' => "2013-10-27",
			'filters' => 'ga:campaign!=(not set)',
			'sort' => '-ga:pageviews',
			'max-results' => 10,
		);
		$this->traffic_website = $this->google_analytic_library->ga->query($params);
		
		
		echo 'Traffic Newsletter/3rd : <pre>';
		print_r($this->traffic_website);
		echo '</pre>';
		
		echo '======================= <br /><br /> ';
		
		$params = array(
			'metrics' => 'ga:pageviews',
			'dimensions' => 'ga:hostname,ga:pagePath',
			'max-results' => 500,
			'start-date' => "2013-10-27",
			'sort' => '-ga:pageviews',
			'max-results' => 50,
		);
		$this->traffic_website = $this->google_analytic_library->ga->query($params);
		echo 'Traffic Halaman : <pre>';
		print_r($this->traffic_website);
		echo '</pre>';
		
	}
	
	function gaAuth(){
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