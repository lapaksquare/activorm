<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// ini untuk Controller Front
class MY_Controller extends CI_Controller{

	var $data = array();
	var $ismobile = FALSE;
	var $session_lang = '';
	
	function __construct(){
		parent::__construct();
		
		// invitation
		if (DEV_INVITATION == 1){
			$this->segments = $this->uri->segment_array();
						
			// invitation only
			$invitation_only = $this->session->userdata('invitation_only');
			
			//echo $invitation_only . ' aaa';die();
			
			if ( (!empty($this->segments) && empty($invitation_only)) && (!in_array($this->segments[1], array('business', 'benefits', 'about', 'auth', 'project', 'guestlist', 'admin', 'cron'))) ){
				redirect(base_url());
			}
		}
		
		$this->data['default_title'] = default_title;
		$this->data['css_tags'] = array();
		$this->data['js_tags'] = array();
		
		// for smartphone
		//$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		//if(stripos($ua,'android') !== false ||
		//strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || 
		//strstr($_SERVER['HTTP_USER_AGENT'],'iPod')) { // && stripos($ua,'mobile') !== false) {
		if ($this->detect_mobile() === TRUE){
			$this->ismobile = TRUE;
		}
		
		$this->data['session_lang'] = $this->session_lang = $this->session->userdata('session_lang');
		
		//$this->segments_uri = $this->uri->segment_array();
		//if (!empty($this->segments[2]) && !in_array($this->segments[2], array('auth', 'ajax', 'actions'))){
		//$this->session->set_userdata('current_uri', current_url());
		//}
				
		// access user
		$this->load->library('access');
		$this->access->accessUser();
	}
	
	function detect_mobile(){
		if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
			return true;
		else
			return false;
	}
	
	function default_param($css = array(), $js = array(), $meta = array(), $title = ""){
				
		$default_meta = "";
		if (!empty($meta)) $default_meta = implode("", $meta);
		
		$default_css = array(
			'<link href="'.cdn_url().'css/bootstrap.min.css" rel="stylesheet" type="text/css">',
			'<link href="'.cdn_url().'css/dropkick.min.css" rel="stylesheet" type="text/css">',
			//'<link href="http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic|PT+Sans+Caption:400,700" rel="stylesheet" type="text/css">',
			'<link href="'.cdn_url().'css/settings.css" rel="stylesheet" type="text/css">',
			'<link href="'.cdn_url().'css/activorm.css" rel="stylesheet" type="text/css">',
			'<link href="'.cdn_url().'css/pagination.css" rel="stylesheet" type="text/css">',
		);
		
		if (!empty($css)) $css = array_merge($default_css, $css);
		else $css = $default_css;
		
		$default_js = array(
			'<script src="'.cdn_url().'js/jquery.min.js"></script>',
			'<script src="'.cdn_url().'js/bootstrap.min.js"></script>',
			'<script src="'.cdn_url().'js/checkable.min.js"></script>',
			'<script src="'.cdn_url().'js/dropkick.min.js"></script>',
			'<script src="'.cdn_url().'js/settings.js"></script>',
			'<script src="'.cdn_url().'js/home.js"></script>'
		);
		
		if (!empty($js)) $js = array_merge($default_js, $js);
		else $js = $default_js;
		
		$collect_js = array();
		foreach($js as $k=>$v){
			preg_match('/src="([^"]+)"/', $v, $matches);
			$collect_js[] = str_replace(cdn_url(), "", $matches[1]);
		}

		/*
		echo '<pre>';
		print_r( $collect_js );
		echo '</pre>';
		
		echo '<br /><br />';
		*/
		
		$collect_css = array();
		foreach($css as $k=>$v){
			preg_match('/href="([^"]+)"/', $v, $matches);
			$collect_css[] = str_replace(cdn_url(), "", $matches[1]);
		}
		
		/*
		echo '<pre>';
		print_r( $collect_css );
		echo '</pre>';
		*/
		
		//$this->data['css_tags'] = implode('', $css);
		//$this->data['js_tags'] = implode('', $js);
		/*<link rel="stylesheet" href="<?php echo $css_tags; ?>">
		 * <script type="text/javascript" src="<?php echo $js_tags; ?>"></script>
		 * */
		
		$this->data['css_tags'] = '<link rel="stylesheet" href="' . cdn_url() . 'min/?f=' . implode(',', $collect_css) . '" />';
		$this->data['js_tags'] = '<script type="text/javascript" src="' . cdn_url() . 'min/?f=' . implode(',', $collect_js) . '"></script>';
		
		$this->data['meta_tags'] = $default_meta;
		$this->data['title'] = $title . " - " . default_title;
	}

}


class MY_Admin extends CI_Controller {
	
	var $data = array();
	var $ismobile = FALSE;
	
	function __construct(){
		parent::__construct();
		$this->data['default_title'] = default_title;
		$this->data['css_tags'] = array();
		$this->data['js_tags'] = array();
		
		// for smartphone
		//$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		//if(stripos($ua,'android') !== false ||
		//strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || 
		//strstr($_SERVER['HTTP_USER_AGENT'],'iPod')) { // && stripos($ua,'mobile') !== false) {
		if ($this->detect_mobile() === TRUE){
			$this->ismobile = TRUE;
		}
	}
		
	function detect_mobile(){
		if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
			return true;
		else
			return false;
	}
	
	function default_param($css = array(), $js = array(), $meta = array(), $title = ""){
				
		$default_meta = "";
		if (!empty($meta)) $default_meta = implode("", $meta);
		
		$default_css = array(
			'<link href="'.cdn_url().'css/admin/bootstrap.css" rel="stylesheet" type="text/css">',
			'<link href="'.cdn_url().'css/pagination.css" rel="stylesheet" type="text/css">',
			'<link href="'.cdn_url().'css/admin/style.css" rel="stylesheet" type="text/css">',
		);
		
		if (!empty($css)) $css = array_merge($default_css, $css);
		else $css = $default_css;
		
		$default_js = array(
			'<script src="'.cdn_url().'js/jquery.min.js"></script>',
			'<script src="'.cdn_url().'js/bootstrap.min.js"></script>'
		);
		
		if (!empty($js)) $js = array_merge($default_js, $js);
		else $js = $default_js;
		
		$this->data['css_tags'] = implode('', $css);
		$this->data['js_tags'] = implode('', $js);
		$this->data['meta_tags'] = $default_meta;
		$this->data['title'] = $title . " | " . default_title;
	}
	
}

class MY_Admin_Access extends MY_Admin {
	function __construct(){
		parent::__construct();
		$this->account_admin = $account = $this->session->userdata('account_admin');
		if (empty($account)) redirect(base_url() . 'admin/login');		
	}
}


?>