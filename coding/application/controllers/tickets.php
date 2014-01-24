<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$account_id = $this->session->userdata('account_id');
		if (empty($account_id)) redirect(base_url());
	}
	
	var $offset = 10;
	function index(){
		
		$account_id = $this->access->member_account->account_id;
		
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$this->load->model('tiket_model');
		$this->data['tikets'] = $this->tiket_model->getAccountTiket($account_id, $limit = $this->offset, $start = 0, $page);
		
		$uri_page = 'tickets/?page=';
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->tiket_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);
		
		$this->data['menu'] = 'tickets';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Tickets';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/tickets/tickets_view', $this->data);
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