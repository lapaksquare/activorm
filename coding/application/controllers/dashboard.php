<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$account_id = $this->session->userdata('account_id');
		if (empty($account_id) || empty($this->access->member_account) || $this->access->member_account->account_type == "user") redirect(base_url());	
	}
	
	var $segments;
	
	function index(){
		
		$view = '';
		$this->segments = $this->uri->segment_array();
		
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Blog';
		
		$this->data['menu'] = 'dashboard';
		
		if (!empty($this->segments[2]) && $this->segments[2] == "projects"){
			
			$this->projects_overview();
			
			$title = $this->title = 'Projects';
			$view = 'dashboard_projects_view';
			$this->data['menu'] = 'projects';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "pointstopup"){
			
			$this->pointstopup();
			
			$js = array(
				'<script type="text/javascript" src="'.cdn_url().'js/topuppoint.js"></script>'
			);
			
			$title = $this->title = 'Points &amp; Top Up';
			$view = 'dashboard_points_topup_view';
			$this->data['menu'] = 'points_topup';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "paymentconfirmation"){
			
			$this->paymentconfirmation();
			
			$title = $this->title = 'Payment Confirmation';
			$view = 'dashboard_paymentconfirmation_view';
			$this->data['menu'] = 'payment_confirmation';
			
			$css = array(
				'<link href="'.cdn_url().'css/font-awesome.css" rel="stylesheet" type="text/css">',
				'<link rel="stylesheet" type="text/css" href="'.cdn_url().'css/bootstrap.datepicker.css" />'
			);
			$js = array(
				'<script src="'.cdn_url().'js/bootstrap.datepicker.js"></script>',
				'<script src="'.cdn_url().'js/paymentconfirmation.js"></script>',
			);
			
		}else if (!empty($this->segments[2]) && $this->segments[2] == "paymenthistory"){
			
			$this->paymenthistory();
			
			$title = $this->title = 'Payment History';
			$view = 'dashboard_paymenthistory_view';
			$this->data['menu'] = 'payment_history';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "demographic"){
			
			$this->demographic();
			
			$view = 'dashboard_demographic_view';
			$js = array(
				'<script type="text/javascript" src="'.cdn_url().'js/dashboard_demographic.js"></script>'
			);
			$title = $this->title = 'Demographic';
			$this->data['submenu'] = 'demographic';
		}else if (!empty($this->segments[2]) && $this->segments[2] == "searchengine"){
			$view = 'dashboard_searchengine_view';
			$css = array(
				'<link href="'.cdn_url().'css/jquery.mCustomScrollbar.css" rel="stylesheet">'
			);
			$js = array(
				'<script src="'.cdn_url().'js/jquery.mCustomScrollbar.min.js"></script>',
				'<script src="'.cdn_url().'js/dashboard_searchengine.js"></script>'
			);
			$title = $this->title = 'Search Engine';
			$this->data['submenu'] = 'searchengine';
		
		}else if (!empty($this->segments[2]) && $this->segments[2] == "allproject"){
			
			$this->dashboard_allproject();	
				
			$view = 'dashboard_allproject_view';
			$title = $this->title = 'All Project';
			$this->data['submenu'] = 'allproject';
			
			$js = array(
				'<script src="'.cdn_url().'js/dashboard_allproject.js"></script>'
			);
			
		}else if (!empty($this->segments[2]) && $this->segments[2] == "survey"){
			$view = 'dashboard_survey_view';
			$title = $this->title = 'Survey';
			$this->data['submenu'] = 'survey';	
		
		/*submit ed form*/
		}else if (!empty($this->segments[2]) && $this->segments[2] == "submit_pointtopup"){
			$this->submit_pointtopup();
		}else if (!empty($this->segments[2]) && $this->segments[2] == "submit_paymentconfirmation"){
			$this->submit_paymentconfirmation();
		}else if (!empty($this->segments[2]) && $this->segments[2] == "submit_pointtopup_needed"){
			$this->submit_pointtopup_needed();
		/**/
		}else if (!empty($this->segments[2]) && $this->segments[2] == "project"){
			//print_r($this->segments);
			//die();
			$this->dashboard_project();
			$this->data['submenu'] = 'allproject';
			$view = 'dashboard_project_select_view.php';
			
			$css = array(
				'<link href="'.cdn_url().'css/jquery.mCustomScrollbar.css" rel="stylesheet">'
			);
			$js = array(
				'<script src="'.cdn_url().'js/jquery.mCustomScrollbar.min.js"></script>',
				'<script src="'.cdn_url().'js/dashboard_project_select.js"></script>'
			);
		}else{
					
			$this->dashboard_overview();	
			
			$view = 'dashboard_view';
			$css = array(
				'<link href="'.cdn_url().'css/jquery.mCustomScrollbar.css" rel="stylesheet">'
			);
			$js = array(
				'<script src="'.cdn_url().'js/jquery.mCustomScrollbar.min.js"></script>',
				'<script src="'.cdn_url().'js/dashboard_overview.js"></script>'
			);
			$title = $this->title = 'Overview';
			$this->data['submenu'] = 'overview';
		}
		
		$this->_default_param($css, $js, $meta, $this->title);
		$this->load->view('a/dashboard/' . $view, $this->data);
	}

	// projects_overview
	var $offset = 10;
	function projects_overview(){
		
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$business_id = $this->session->userdata('business_id');
		$this->load->model('project_model');
		$this->data['projects'] = $this->project_model->getProjectBusinessCurrent($business_id, $limit = $this->offset, $start = 0, $page);
		
		$uri_page = 'dashboard/projects/?page=';
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->project_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);
		
	}

	function pointstopup(){
				
		//echo '<pre>';print_r($this->access->business_account);echo '</pre>';
		
		$this->load->model('point_model');
		$this->data['points'] = $this->point_model->getPointProfileActive();
		$this->data['points_user'] = $this->point_model->getAccountPoint($this->access->member_account->account_id);
	}
	
	function submit_pointtopup(){
		
		$btn_submit_topup = $this->input->get_post('btn_submit_topup');
		if (!empty($btn_submit_topup)){
			$pid = $this->input->get_post('pid');
			$pid_hash = $this->input->get_post('pid_hash');
			$quantity = $this->input->get_post('quantity');
			$note_topup_amount = $this->input->get_post('note_topup_amount');
			
			$errors = array();
			$order_cart = array();
			$order_cart_detail = array();
			$order_total_price = 0;
			
			$this->load->model('point_model');
			$this->load->model('order_model');
			
			$error_hash = 0;
			$choice_pid = $this->input->get_post('choice_pid');
			$pid_hash_choice = (!empty($pid_hash[$choice_pid])) ? $pid_hash[$choice_pid] : 0;
			$pid_hash_ori = sha1($choice_pid . SALT);
			if ($pid_hash_choice != $pid_hash_ori) { $error_hash++; }
			
			if ($quantity > 0){
				$point = $this->point_model->getPointByPointId($choice_pid);
				$total_price = $quantity * $point->point_price;
				$order_total_price += $total_price;
				$point_expired = $point->point_period * 31;
				$order_cart_detail[$choice_pid] = array(
					'order_name' => 'Order ' . $point->point_name,
					'order_name_detail' => 'Order ' . $point->point_name,
					'point_id' => $point->point_id,
					'point' => $point->point,
					'point_expired' => date('Y-m-d H:i:s', strtotime('+'. $point_expired .' days')),
					'order_qty' => $quantity,
					'order_price' => $point->point_price,
					'order_total_price' => $total_price,
					'order_detail_status' => 'active'
				);
			}
			
			if ($error_hash > 0 || empty($order_cart_detail)){
				$errors[] = 'Something error when send your data.';
			}
			
			if (!empty($order_cart_detail)){
				$service_charge = 5/100 * $order_total_price;
				$gov_charge = 10/100 * $order_total_price;
				$total_payment = $order_total_price + $service_charge + $gov_charge;
					
				$this->load->library('util');	
				$barcode1 = 'POIN'; //$this->util->create_code(4, "text");
				$barcode2 = $this->util->create_code(4, "number");	
				$order_barcode = $barcode1 . $barcode2;	
				$order_cart = array(
					'order_barcode' => $order_barcode,
					'order_status' => 'checkout',
					'account_id' => $this->access->member_account->account_id,
					'service_charge' => $service_charge,
					'gov_charge' => $gov_charge,
					'order_total_price' => $total_payment,
					'order_datetime' => date('Y-m-d H:i:s'),
					'order_expired' => date('Y-m-d H:i:s', strtotime('+7 days')),
					'notes_point' => 0//$note_topup_amount
				);	
			}
			
			if (count($errors) > 0){
				$this->session->set_userdata('pointtopup_error', 1);
			}else{
				
				$order_id = $this->order_model->addOrderCart($order_cart);
				
				foreach($order_cart_detail as $k=>$v){
					$v['order_id'] = $order_id;
					$this->order_model->addOrderCartDetail($v);
				}
				
				$order_cart = $this->order_model->getDataOrderCart($order_barcode);
				$order_cart_detail = $this->order_model->getDataOrderCartDetail($order_id);
				
				// sending email
				$dataEmail = array(
					'account_email' => $this->access->member_account->account_email,
					'email_subject' => 'INVOICE #' . $order_barcode,
					'email_tmpl' => 'invoice_view',
					'order_cart' => $order_cart,
					'order_cart_detail' => $order_cart_detail
				);
				$this->sending_email($dataEmail);
				
				$this->session->set_userdata('pointtopup_error', 2);
			}
			
			/*			
			echo '<pre>';
			print_r($_POST);
			echo '</pre>';
			die();*/
		}
		redirect(base_url() . 'dashboard/pointstopup');
	}

	function submit_pointtopup_needed(){
		$submit_needed_topup = $this->input->get_post('submit_needed_topup');
		if (!empty($submit_needed_topup)){
			$note_topup_amount = $this->input->get_post('note_topup_amount');
			if (empty($note_topup_amount)){
				$this->session->set_userdata('note_topup_amount_error', 'Points must be filled.');
			}else{
				
				// sending email
				$dataEmail = array(
					'account_email' => "business@activorm.com", //$this->access->member_account->account_email,
					'email_subject' => 'Need More Point',
					'email_tmpl' => 'need_more_point_view',
					'note_topup_amount' => $note_topup_amount,
					'business' => $this->access->business_account
				);
				$this->sending_email($dataEmail);
				
				$this->session->set_userdata('note_topup_amount', 1);
			}
		}
		redirect(base_url() . 'dashboard/pointstopup');
	}

	function paymenthistory(){
		$this->load->model('order_model');
		$account_id = $this->access->member_account->account_id;
		$this->data['payment_history'] = $this->order_model->getPaymentHistory($account_id);
		
		$oid = $this->input->get_post('oid');
		$oid_hash = $this->input->get_post('h');
		$oid_hash_ori = sha1($oid . SALT);
		if (!empty($oid) && !empty($oid_hash) && $oid_hash != $oid_hash_ori) redirect(base_url() . 'dashboard/paymenthistory');
		else{
			
			$this->load->model('order_model');
			$this->data['order_cart'] = $order_cart = $this->order_model->getDataOrderCart($oid);
			if (!empty($order_cart)){
				$this->data['order_cart_detail'] = $this->order_model->getDataOrderCartDetail($order_cart->order_id);
			}
			
		}
	}

	function paymentconfirmation(){
		$this->load->model('order_model');
		$account_id = $this->access->member_account->account_id;
		$this->data['payment_checkout'] = $this->order_model->getPaymentCheckout($account_id);
	}
	
	function submit_paymentconfirmation(){
		
		$btn_continue = $this->input->get_post('btn_continue');
		if (!empty($btn_continue)){
			$this->load->model('order_model');
			$transaction_number = $this->input->get_post('transaction_number');
			$order = $this->order_model->getOrderCart("oc.order_barcode", $transaction_number);
			$errors = array();
			if (empty($order)){
				$errors[] = "No Transaction";
				$this->session->set_userdata('message_paymentconfirmation_error', $errors);
			}else{
				$payment_date = $this->input->get_post('payment_date');	
				$transaction_amount = (int) $this->input->get_post('transaction_amount');
				$transaction_bank = $this->input->get_post('transaction_bank');
				$sender_bank = $this->input->get_post('sender_bank');
				$sender_name = $this->input->get_post('sender_name');
				$sender_account = $this->input->get_post('sender_account');
				
				if (empty($payment_date)){
					$errors[] = "Payment Date must be filled.";
				}
				if (empty($transaction_amount)){
					$errors[] = "Transaction Amount must be filled and may consists of numbers only.";
				}
				if ($transaction_amount < $order->order_total_price){
					$errors[] = "Please insert the correct Payment Amount.";
				}
				if (empty($sender_bank)){
					$errors[] = "Bank Name must be filled.";
				}
				if (empty($sender_name)){
					$errors[] = "Bank Account Holder Name must be filled and contain words only (you may not use special characters e.g. - , > , % , $).";
				}
				if (empty($sender_account)){
					$errors[] = "Bank Account Number must be filled and may consists of numbers only.";
				}
				
				if (count($errors) > 0){
					$this->session->set_userdata('message_paymentconfirmation_error', $errors);
				}else{
				
					$data = array(
						'order_id' => $order->order_id,
						'payment_date' => date('Y-m-d H:i:s', strtotime($payment_date)),
						'payment_amount' => $transaction_amount,
						'payment_bank' => $transaction_bank,
						'payment_type' => 'banktransfer',
						'from_bank' => $sender_bank,
						'account_holder_name' => $sender_name,
						'account_number' => $sender_account,
						'payment_datetime' => date('Y-m-d H:i:s')
					);
					$this->order_model->insertOrderPayment($data);
					
					$data = array(
						'customer_price' => $transaction_amount,
						'order_status' => 'onprogress'
					);
					$where = array(
						'order_id' => $order->order_id,
					);
					$this->order_model->updateOrderCart($data, $where);
				
					$this->session->set_userdata('message_paymentconfirmation', 2);
						
				}
			}
		}
		
		/*
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		die();
		*/
		
		redirect(base_url() . 'dashboard/paymentconfirmation');
	}
	
	function sending_email($data){
		// sending email
		require_once APPPATH.'libraries/swiftmailer/swift_required.php';
		$transport = Swift_MailTransport::newInstance();
		//Create the message
        $message = Swift_Message::newInstance();
		//Give the message a subject
		
		$email = $data['account_email'];	
		$tmpl =  $data['email_tmpl'];	
		$subject = $data['email_subject'];	
				
		$data = $this->load->view('email/' . $tmpl, $data, true);
        $message->setSubject($subject)
                ->setFrom(array('business@activorm.com' => 'Activorm'))
                ->setTo($email)
                ->addPart($data, 'text/html')
        ;
		//Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);
        
        //Send the message
        $result = $mailer->send($message);
	}
	
	
	/* dashboard_allproject ======= start ======== **/
	function dashboard_allproject(){
		
		$account_id = $this->access->member_account->account_id;
		$business_id = $this->access->business_account->business_id;
		
		$this->load->model('dashboard_model');
		
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$param_url = array(
			'page' => ''
		);
		
		$this->results = $this->dashboard_model->getBusinessProject($business_id, $param_url, $this->offset, 0, $page);
		
		$param_url = http_build_query($param_url);
		
		$uri_page = 'dashboard/allproject?'.$param_url;
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->dashboard_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);
		
		$this->results_project_analytics = $this->project_analytics($this->results);
		//echo '<pre>';print_r($this->results_project_analytics);echo '</pre>';
		
		$this->load->model('project_model');
		$this->data['freeplan'] = $this->project_model->getCountFreePlan($this->access->member_account->account_id);
	}
	function project_analytics($results){
		$ga_session = $this->gaAuth();
		if (empty($ga_session)) return 0;
		
		$this->load->library("google_analytic_library");	
		$this->load->model("google_analytic_model");
				
		$ga_session = $this->gaAuth();
		$accessToken = $ga_session->auth->access_token;
		$this->google_analytic_library->ga->setAccessToken($accessToken);
		$this->google_analytic_library->ga->setAccountId('ga:78298628');
		// Set the default params. For example the start/end dates and max-results
		$defaults = array(
		    'end-date' => date('Y-m-d', strtotime('- 1 days')),
		);
		$this->google_analytic_library->ga->setDefaultQueryParams($defaults);
		
		$return = array();
		foreach($results as $k=>$v){
			$project_uri = $v->project_uri;
			$params = array(
				'metrics' => 'ga:pageviews,ga:visitBounceRate,ga:bounces,ga:visits',
				'dimensions' => 'ga:pagePath',
				'start-date' => "2013-10-27",
				'filters' => 'ga:pagePath==/project/' . $project_uri,
				'max-results' => 500,
				'sort' => '-ga:pageviews'
			);
			$this->traffics = $this->google_analytic_library->ga->query($params);
			$data = array();
			if (!empty($this->traffics['rows'])){
				foreach($this->traffics['rows'] as $a=>$b){
					$data = $this->google_analytic_model->getAnalticsPageProject($v->project_id);
					if (empty($data)){
						$data = array(
							'project_id' => $v->project_id,
							'pageviews' => $b[1],
							'bouncerate' => $b[2],
							'bounces' => $b[3],
							'visits' => $b[4]
						);
						$this->google_analytic_model->addAnalyticPageProject($data);
					}else{
						$t = date('Y-m-d', strtotime($data['lastupdate']));
						$n = date('Y-m-d');
						if ($t != $n){
							$data = array(
								'pageviews' => $b[1],
								'bouncerate' => $b[2],
								'bounces' => $b[3],
								'visits' => $b[4]
							);
							$this->google_analytic_model->updateAnalyticPageProject($data, $v->project_id);
							$data['project_id'] = $v->project_id;
						}
					}
				}
			}	
			$return[$v->project_id] = $data;
		}
		return $return;
	}
	function gaAuth(){
		try{
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
		}catch (exception $e){
			return array();
		}
	}
	/* dashboard_allproject ======= end ======== **/
	
	function dashboard_overview(){
		$ct = $this->input->get_post("ct");
		$cth = $this->input->get_post("ha");
		$cth_ori = sha1($ct . SALT);
		$ct = ($cth != $cth_ori) ? "daily" : $ct;
		$this->gchart_type = (empty($ct)) ? "daily" : $ct;
		
		$this->load->model('project_analytic_model');
		$this->load->model('google_analytic_model');
		$this->trendprizedata = $this->project_analytic_model->getTrendPrizeData();
		$this->reffererdata = json_decode( $this->google_analytic_model->getTrafficData("source_data") );
		$this->contentdata = json_decode( $this->google_analytic_model->getTrafficData("medium_data") );
		$this->visitorsdata = json_decode( $this->google_analytic_model->getTrafficData("new_vs_return_visitors") );
		
		/*
		$startdate = date('Y-m-d', strtotime('-1 month'));
		$enddate = date("Y-m-d");
		*/
		$startdate = $this->input->get_post('s');
		$enddate = $this->input->get_post('e');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($startdate.$enddate.SALT);
		if (empty($startdate) || empty($enddate) || empty($hash) || $hash != $hash_ori){
			$startdate = date("Y-m-d", strtotime("- 7 days"));
			$enddate = date("Y-m-d", strtotime("- 1 days"));
		}
		$this->keyal = "s=" . $startdate . "&e=" . $enddate . "&h=" . $hash;
		$this->trafficwebsite = $this->google_analytic_model->getTrafficWebsite($this->gchart_type, $startdate, $enddate);
	}
	
	function demographic(){
		$this->load->model('project_analytic_model');
		//$this->load->model('google_analytic_model');
		$this->gender_data = $this->project_analytic_model->getGenderTrafficData();
		//$this->region_data = $this->google_analytic_model->getTrafficData("data_region");
		//$this->city_data = $this->google_analytic_model->getTrafficData("data_city");
		$this->province_data = $this->project_analytic_model->getProvinceTrafficData();
		$this->city_data = $this->project_analytic_model->getCityKabupatenTrafficData();
		
		
		$this->load->model('interests_model');
		$this->interests = $this->interests_model->getInterestsOverview();
	}
	
	function dashboard_project(){
		$this->title = "Dashboard Project";
				
		if (empty($this->segments[1]) || empty($this->segments[2]) || empty($this->segments[3])) redirect(base_url() . '404');		
				
		$this->load->model('project_model');		
		$this->project = $this->project_model->getProject('pp.project_uri', $this->segments[3]);
		
		$access = 1;
		$limit_time = "2014-03-03 18:00";
		$limit_time = strtotime($limit_time);
		$project_posted = strtotime($this->project->project_posted);
		$freeplan = $this->project_model->getCountFreePlan($this->access->member_account->account_id);
		if ($this->project->premium_plan == 0 && $freeplan <= 0 && $limit_time < $project_posted){
			$access = 0;
		}
		
		if (empty($this->project) || empty($this->segments[2]) || $access == 0) redirect(base_url() . '404');
		
		$project_id = $this->project->project_id;
		$account_id = $this->access->member_account->account_id;
		$business_id = $this->access->business_account->business_id;
		
		$this->projects = $this->project_model->getProjectAllByBusinessId($business_id);
		
		$this->load->model('dashboard_model');
		$this->result = $this->dashboard_model->getBusinessProjectByProjectId($project_id);
			
		$this->load->model('google_analytic_model');
		$this->project_analytic = $this->google_analytic_model->getAnalticsPageProject($project_id);
		
		$this->load->model('project_analytic_model');
		$this->gender_data = $this->project_analytic_model->getGenderTrafficDataByProjectId($project_id);
		$this->province_data = $this->project_analytic_model->getProvinceTrafficDataByProjectId($project_id);
		$this->city_data = $this->project_analytic_model->getCityKabupatenTrafficDataByProjectId($project_id);
		
		$this->cronGATrafficProject($project_id, $this->project->project_uri, $this->project);
		
		$this->load->model('interests_model');
		$this->interests = $this->interests_model->getInterestsByProjectId($project_id);
		
		if ($this->project->redeem_tiket_merchant == 1){
			$startdate = $this->input->get_post('redeem_s');
			$enddate = $this->input->get_post('redeem_e');
			$hash = $this->input->get_post('redeem_h');
			$hash_ori = sha1($startdate.$enddate.SALT);
			if (empty($startdate) || empty($enddate) || empty($hash) || $hash != $hash_ori){
				$startdate = date("Y-m-d", strtotime("- 5 days"));
				$enddate = date("Y-m-d", strtotime("- 1 days"));
			}
			$this->keyal = "redeem_s=" . $startdate . "&redeem_e=" . $enddate . "&redeem_h=" . $hash;
			
			$this->redeem_startdate = $startdate;
			$this->redeem_enddate = $enddate;
			
			$this->load->model('tiket_model');
			$this->tikets = $this->tiket_model->getRedeemDataTiket($project_id, $startdate, $enddate);			
		}
		
		/*
		echo '<pre>';
		print_r($this->result);
		echo '</pre>';
		
		echo '<pre>';
		print_r($this->project_analytic);
		echo '</pre>';*/
	}
	
	/* CRON */
	function cronGATrafficProject($project_id, $project_uri, $projects){
		$this->load->library("google_analytic_library");	
		$this->load->model("google_analytic_model");
		
		$endDateTraffic = $this->google_analytic_model->getEndDateTrafficProject($project_id);
		
		if ($endDateTraffic != date("Y-m-d")){
		
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
				'metrics' => 'ga:visitors,ga:newVisits,ga:visits,ga:percentNewVisits',
				'dimensions' => 'ga:date',
				'max-results' => 500,
				'start-date' => $endDateTraffic,
				'filters' => 'ga:pagePath==/project/' . $project_uri
			);
			$this->traffic_website = $this->google_analytic_library->ga->query($params);
					
			if (!empty($this->traffic_website['rows'])){
				foreach($this->traffic_website['rows'] as $k=>$v){
					$data = array(
						'project_id' => $project_id,
						'analytic_date' => date('Y-m-d', strtotime($v[0])),
						'analytic_visitors' => $v[1],
						'analytic_newvisits' => $v[2],
						'analytic_visit' => $v[3],
						'analytic_percentnewvisits' => $v[4]
					);
					$this->google_analytic_model->addTrafficProject($data);
				}
			}
			
			$this->cronGATrafficDataNewReturnVisitors($project_id, $project_uri);
			$this->cronGATrafficDataMediumContent($project_id, $project_uri);
			$this->cronGATrafficDataSourceContent($project_id, $project_uri);
			
		}

		$this->gchart_type = "daily";
		$startdate = $this->input->get_post('s');
		$enddate = $this->input->get_post('e');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($startdate.$enddate.SALT);
		if (empty($startdate) || empty($enddate) || empty($hash) || $hash != $hash_ori){
			//$startdate = date("Y-m-d", strtotime("- 7 days"));
			//$enddate = date("Y-m-d", strtotime("- 1 days"));
			
			$c = $projects->project_period_int;
			if ($c < 7){
				$startdate = date('Y-m-d', strtotime($this->project->project_period . "- ".$c." days"));
				$enddate = date('Y-m-d', strtotime($this->project->project_period));
			}else{
				$ca = 7;
				$startdate = date('Y-m-d', strtotime($this->project->project_period . "- ".$ca." days"));
				$enddate = date('Y-m-d', strtotime($this->project->project_period));
			}
			
		}
		$this->keyal = "s=" . $startdate . "&e=" . $enddate . "&h=" . $hash;
		$this->trafficwebsite = $this->google_analytic_model->getTrafficProject($project_id, $this->gchart_type, $startdate, $enddate);
		
		$this->reffererdata = $this->google_analytic_model->getTrafficProjectData($project_id, "source_data") ;
		$this->contentdata = $this->google_analytic_model->getTrafficProjectData($project_id, "medium_data") ;
		$this->visitorsdata = $this->google_analytic_model->getTrafficProjectData($project_id, "new_vs_return_visitors") ;

	}	
	function cronGATrafficDataNewReturnVisitors($project_id, $project_uri){
		$this->load->library("google_analytic_library");	
		$this->load->model("google_analytic_model");
				
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
			'metrics' => 'ga:visits',
			'dimensions' => 'ga:visitorType',
			'start-date' => "2013-10-27",
			'max-results' => 500,
			'filters' => 'ga:pagePath==/project/' . $project_uri
		);
		$this->traffics = $this->google_analytic_library->ga->query($params);
		if (!empty($this->traffics['rows'])){
			$data = array();
			foreach($this->traffics['rows'] as $k=>$v){
				$data[] = array(
					'visitor_type' => $v[0],
					'visits' => $v[1]
				);
			}
			if (!empty($data)){
				$data = json_encode($data);
				$this->google_analytic_model->addTrafficDataProject($project_id, "new_vs_return_visitors", $data);
			}
		}
	}
	function cronGATrafficDataMediumContent($project_id, $project_uri){
		$this->load->library("google_analytic_library");	
		$this->load->model("google_analytic_model");
				
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
			'metrics' => 'ga:visits',
			'dimensions' => 'ga:medium',
			'start-date' => "2013-10-27",
			'filters' => 'ga:medium!=facebook;ga:medium!=twitter;ga:medium!=social;ga:pagePath==/project/' . $project_uri,
			'max-results' => 500
		);
		$this->traffics = $this->google_analytic_library->ga->query($params);
		if (!empty($this->traffics['rows'])){
			$data = array();
			foreach($this->traffics['rows'] as $k=>$v){
				$data[] = array(
					'medium' => ($v[0] == "(none)") ? 'direct' : $v[0],
					'visits' => $v[1]
				);
			}
			if (!empty($data)){
				$data = json_encode($data);
				$this->google_analytic_model->addTrafficDataProject($project_id, "medium_data", $data);
			}
		}
	}
	function cronGATrafficDataSourceContent($project_id, $project_uri){
		$this->load->library("google_analytic_library");	
		$this->load->model("google_analytic_model");
				
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
			'metrics' => 'ga:visits',
			'dimensions' => 'ga:source',
			'start-date' => "2013-10-27",
			'filters' => 'ga:source==facebook.com,ga:source==m.facebook.com,ga:source==t.co,ga:source=~startupbisnis.com,ga:source=~techinasia.com,ga:source=~dailysocial.net,ga:source=~google,ga:source=~direct;ga:source!~blogspot.com;ga:source!~plus.url.google.com;ga:pagePath==/project/' . $project_uri,
			'max-results' => 500,
			'sort' => '-ga:visits'
		);
		$this->traffics = $this->google_analytic_library->ga->query($params);
		if (!empty($this->traffics['rows'])){
			$data = array();
			foreach($this->traffics['rows'] as $k=>$v){
				
				$source = $v[0];
				switch($v[0]){
					case "(direct)":
						$source = "activorm.com";
						break;
					case "t.co":
						$source = "twitter.com (t.co)";
				}
				
				$data[] = array(
					'source' => $source,
					'visits' => $v[1]
				);
			}
			if (!empty($data)){
				$data = json_encode($data);
				$this->google_analytic_model->addTrafficDataProject($project_id, "source_data", $data);
			}
		}
	}
	/* CRON */
	
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