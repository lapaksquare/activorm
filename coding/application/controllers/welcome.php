<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Academic Free License version 3.0
 *
 * This source file is subject to the Academic Free License (AFL 3.0) that is
 * bundled with this package in the files license_afl.txt / license_afl.rst.
 * It is also available through the world wide web at this URL:
 * http://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)
 * @license		http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//echo date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 3, date('Y')));
		//die();
		//$this->load->view('welcome_message');
		
		
		
		/*
		$file = "http://codeigniter.com/user_guide/database/helpers.jpg";
		$file = pathinfo($file);
		print_r($file);
		echo '<br /><br />';
		$file = "user_guide/database/helpers.jpg";
		$file = pathinfo($file);
		print_r($file);
		 */
		 
		/* 
		$project_hashtags_text = 'bola, jersey, kompas';
		$project_hashtags_text = explode(",",$project_hashtags_text);
		$project_hashtags_text = array_map("trim", $project_hashtags_text);
		echo "#" . implode(" #", $project_hashtags_text);*/
		
		/*
		$data = (object) array(
			'name' => 'a',
			'detail' => 'b'
		);
		echo '<pre>';
		print_r($data);
		echo '</pre>';*/
		
		//$url = "http://www.example.com";
		//$this->load->library('validate');
		//$r = $this->validate->valid_url($url);
		//var_dump($r);

		//echo sha1(SALT . "5753");
		
		//$hash = "kjkw0738";
		//echo base_url() . 'auth/resetpassword?h=' . $hash . '&hs=' . sha1(SALT . $hash);
		
	}
	
	function test_invite(){
		//$this->load->model('invitation_model');
		//$return = $this->invitation_model->getInvitationByCustom("merchant");
		//echo '<pre>';
		//print_r($return);
		//echo '</pre>';
		$this->load->view('email/invoice_view');
		//var_dump( is_file('images/merchant/Email-Logo-activorm.png') );
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */