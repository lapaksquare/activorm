<?php 

require_once "GoogleAnalyticsAPI.class.php";

class Google_analytic_library {

	var $ci;
	var $ga;
	function __construct(){
		$this->ci =& get_instance();
		$this->ga = new GoogleAnalyticsAPI(); 
		$this->ga->auth->setClientId(GA_CLIENT_ID); // From the APIs console
		$this->ga->auth->setClientSecret(GA_CLIENT_SECRET); // From the APIs console
		$this->ga->auth->setRedirectUri(base_url().'auth/ga_oauth/'); // Url to your app, must match one in the APIs console
	}

	function oauth(){
		// Get the Auth-Url
		$url = $this->ga->auth->buildAuthUrl();
		return $url;
	}

}