<?php 

require_once "instagram/instagram.class.php";

class Instagram_library {

	var $instagram;

	function __construct(){
		$this->instagram = new Instagram(array(
			'apiKey' => INSTAGRAM_CLIENT_ID,
			'apiSecret' => INSTAGRAM_CLIENT_SECRET,
			'apiCallback' => INSTAGRAM_CALLBACK
		));
	}

}

?>