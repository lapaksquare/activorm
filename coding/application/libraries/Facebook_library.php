<?php 

require_once "facebook/facebook.php";

class Facebook_library {

	var $facebook;

	function connection(){
		$this->facebook = new Facebook(array(
			'appId' => FACEBOOK_APP_ID,
			'secret' => FACEBOOK_APP_SECRET
		));
	}

	function getFacebook(){
		return $this->facebook;
	}

}

?>