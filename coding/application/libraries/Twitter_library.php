<?php 

require_once('twitteroauth/twitteroauth.php');

class Twitter_library{
	
	var $ci;

	function __construct(){
		$this->ci =& get_instance();
	}
	
	var $connection;
	var $content;
	function connection_start(){
		
		$this->connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET);
		
		$request_token = $this->connection->getRequestToken(TWITTER_OAUTH_CALLBACK);
		$token = $request_token['oauth_token'];
	
		$this->ci->session->set_userdata('tw_oauth_token', $request_token['oauth_token']);
		$this->ci->session->set_userdata('tw_oauth_token_secret', $request_token['oauth_token_secret']);
		$url = $this->connection->getAuthorizeURL($token);
		return $url;
		
	}
	
	function connection_callback(){
		
		$tw_oauth_token = $this->ci->session->userdata('tw_oauth_token');
		$tw_oauth_token_secret = $this->ci->session->userdata('tw_oauth_token_secret');
		
		$this->connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $tw_oauth_token, $tw_oauth_token_secret);
		$access_token = $this->connection->getAccessToken($_REQUEST['oauth_verifier']);
		
		$this->ci->session->set_userdata('tw_access_token', $access_token);
		
	}
	
	var $tw_access_token;
	function connection($oauth_token = "", $oauth_token_secret = ""){
		
		if (!$oauth_token || !$oauth_token_secret){
			$this->tw_access_token = $this->ci->session->userdata('tw_access_token');
			$oauth_token = $this->tw_access_token['oauth_token'];
			$oauth_token_secret = $this->tw_access_token['oauth_token_secret'];
		}
		$this->connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
		$this->content = $this->connection->get('account/verify_credentials');
		
	}
	
	function statusesUpdate($status){
		$return = $this->connection->post('statuses/update', array('status' => $status));
		return $return;
	}

	function twitterFollow($user_id){
		$return = $this->connection->post('friendships/create', array('user_id' => $user_id, 'follow' => true));
		return $return;
	}
	
}

?>