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
      
/* 
   ====================
   === TEAM PROCESS ===
   ====================
*/      
      // GET TEAM DATA
      $this->load->model('s_team_model', 'team');
      
      $teams = $this->team->getTeamByAccount($this->account_sales->account_id);
      foreach($teams as $t){
         if(empty($t->team_name)) $t->team_name = "Team $t->team_id";
         
         $leader = $this->team->getTeamLeader($t->team_id);
         $members = $this->team->getTeamMembersExclude($t->team_id, array($this->account_sales->account_id));

         $items = array();
         
         if(!empty($leader) && $leader->account_id != $this->account_sales->account_id){
            array_push($items, $leader);
         }
         
         if(!empty($members)){
            $items = array_merge($items, $members);
         }
         
         $t->members = $items;
      }
            
      // PUT TO PAGE
      $this->data['teams'] = $teams;
      
      /*
      echo '<pre>';
      print_r($this->data['teams']);
      echo '</pre>';
      */
/* 
   ========================
   === TEAM PROCESS END ===
   ========================
*/

      // PROCESS PAGE
		$this->data['menu'] = 'home';
		$this->_default_param(
			array(
            '<link href="'.cdn_url().'css/sales/jquery.jqplot.min.css" rel="stylesheet" type="text/css">',
            '<link href="'.cdn_url().'css/sales/home.css" rel="stylesheet" type="text/css">'
         ),
			array(
            '<script src="'.cdn_url().'js/third-party/jQueryPlot/jquery.jqplot.min.js"></script>',
            '<script src="'.cdn_url().'js/third-party/jQueryPlot/plugins/jqplot.barRenderer.min.js"></script>',
            '<script src="'.cdn_url().'js/third-party/jQueryPlot/plugins/jqplot.categoryAxisRenderer.min.js"></script>',
            '<script src="'.cdn_url().'js/s_home.js"></script>'
         ),
			"",
			"Home - Activorm Connect");
		
      $this->initiate($this->data);
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