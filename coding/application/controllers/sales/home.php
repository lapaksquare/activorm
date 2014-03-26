<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Sales_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
      /*
		$this->load->model('notification_model');
		$this->data['project_lastposted'] = $this->notification_model->getNotificationProjectByLastPosted();
		$this->data['project_lastupdated'] = $this->notification_model->getNotificationProjectByLastUpdated();
		$this->data['account_lastupdated'] = $this->notification_model->getNotificationLastEditedAccount();
		*/
      
		$this->data['menu'] = 'home';
		$this->_default_param(
			"",
			"",
			"",
			"Home - Activorm Connect");
		$this->load->view('s/home/home_view', $this->data);
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