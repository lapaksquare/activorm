<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct(){
		parent::__construct();
	}
	
	function index(){
		redirect(base_url());
	}
	
	// register untuk facebook =================================================
	function register_facebook(){
		
		set_time_limit(1000000);
	
		// datang dari facebook
		$state = $this->input->get_post('state');
		$code = $this->input->get_post('code');

		if (empty($state) || empty($code)) redirect(base_url());
		if (empty($this->access->user)) redirect($this->access->loginUrl);

		// extract fb
		$this->dataFB = $this->access->facebook->api('/me');				

		$this->load->model('account_model');
		$user = $this->account_model->getAccount("ma.account_email", $this->dataFB['email']);
		
		$this->session->set_userdata('fbauth', 1);
		
		if (!empty($user)){
						
			if ($user->account_active == 0) redirect(base_url());			
												
			// redirect ke halaman depan lagi utk register tombol tekan
			$this->access->register_session($user->account_id, array(
				'account_id' => $user->account_id,
				'fullname' => $user->account_name,
				'email' => $user->account_email,
				'step' => $user->register_step
			));
			
			// ip address
			$this->access->logIpAddress($user->account_id);										
								
			// fb user interests									
			$this->fb_user_interest();						
												
			// offline berarti belum verifikasi dan belum masuk ke dashboard usernya
			if ($user->account_live == "Offline"){
					
				redirect(base_url());
						
			}else{
				
				// invitation
				if (DEV_INVITATION == 1){
					$this->session->set_userdata('invitation_only', 1);
				}
				
				if ($user->register_step == 4) redirect(base_url() . 'settings/contact');
				else {
					$ref = $_SERVER['HTTP_REFERER'];
						
					if (empty($ref)){
						redirect(base_url());
					}else{
						redirect($ref);
					}
				}
			}
			
		}else{
						
			// get photo facebook profile pictures
			$avatar_facebook = "https://graph.facebook.com/".$this->dataFB['id']."/picture?type=large";
			
			// masukkan data fb nya ke member account
			$birthday = "";
			if (!empty($this->dataFB['birthday'])){
				list($bulan, $tanggal, $tahun) = explode('/', $this->dataFB['birthday']);
				$birthday = $tahun.'-'.$bulan.'-'.$tanggal;
			}
			
			$this->load->library('util');
			$verification_code = $this->util->create_code(4, "number");
			$dataUser = array(
				'account_name' => $this->dataFB['name'],
				'account_email' => $this->dataFB['email'],
				'account_primary_photo' => $avatar_facebook,
				'gender' => $this->dataFB['gender'],
				'birthday' => $birthday,
				'avatar' => $avatar_facebook,
				'account_type' => 'user',
				'verification_code' => $verification_code
			);
									
			// masukkan data log fb di database
			$dataLogSocialMedia = array(
				'social_name' => 'facebook',
				'social_data' => json_encode($this->dataFB),
				'social_active' => 1
			);
			
			$account_id = $this->access->registerSocialMedia("facebook", $dataUser, $dataLogSocialMedia);
			
			// send email
			//$this->sending_email($dataUser);
			
			// redirect ke halaman depan lagi utk register tombol tekan
			$this->access->register_session($account_id, array(
				'account_id' => $account_id,
				'fullname' => $this->dataFB['name'],
				'email' => $this->dataFB['email'],
				'step' => 1
			));
			
			// invitation
			if (DEV_INVITATION == 1){
				$this->session->set_userdata('invitation_only', 1);
			}
			
			redirect(base_url());
			
			/*
			echo '<pre>';
			print_r($this->dataFB);
			echo '</pre>';
			
			die();
			*/
		}

	}

	
	// register untuk normal ========================================
	function register(){
		$submit_register = $this->input->get_post('submit_register');
		if (!empty($submit_register)){
			$fullname = $this->input->get_post('name');
			$email = $this->input->get_post('email');
			$password = $this->input->get_post('password');
			$salt_password = md5($password . SALT);
			$this->load->library('validate');
			$validateName = $this->validate->validateName($fullname);
			$validateEmail = $this->validate->validateEmail($email);
			$validatePassword = $this->validate->validatePassword($password);
			$errors = array();
			if ($validateName == 1){
				$errors[] = 'Your name must contain words only (you may not user special characters e.g. -, > , %, $). Minumum 5 characters.';
			} 
			if ($validateEmail == 1){
				$errors[] = 'Please insert a correct email address';
			} 
			if ($validatePassword == 1){
				$errors[] = 'Password must contain minimum 5 characters';
			} 
			
			$user = $this->account_model->getAccountTaken("ma.account_email", $email);
			if (!empty($user)){
				$errors[] = 'Your email is taken.';
			}
			
			if (!empty($errors)){
				//$errors = implode(", ", $errors);
				$this->session->set_userdata('message_register_error', $errors);
			}else{
				
				$register_step = 2;
				$this->load->library('util');
				
				// register normal
				$verification_code = $this->util->create_code(4, "number");
				$dataUser = array(
					'account_name' => $fullname,
					'account_email' => $email,
					'account_password' => $salt_password,
					'verification_code' => $verification_code,
					'register_step' => $register_step,
					'account_type' => 'user'
				);
				
				$this->load->model('account_model');
				$account_id = $this->account_model->registerAccount($dataUser);
				
				// update step register
				$register_temp = $this->session->userdata('register_temp');
				if (!empty($register_temp)){
					$register_temp['step'] = $register_step;
				}else{
					$register_temp =  array(
						'account_id' => $account_id,
						'fullname' => $fullname,
						'email' => $email,
						'step' => $register_step
					);
				}
				$this->access->register_session($account_id, $register_temp);
				
				// ip address
				$this->access->logIpAddress($account_id);
				
				// send email
				$this->sending_email($dataUser);
				
				// invitation
				if (DEV_INVITATION == 1){
					$this->session->set_userdata('invitation_only', 1);
				}
				
			}
		}

		redirect(base_url());
	}

	function resend_activationcode(){
		$h = $this->input->get_post('h');
		$c = $this->input->get_post('c');
		$ori_h = sha1(SALT . $c);
		if ($h == $ori_h){
			$dataUser = (array) $this->access->member_account;
			// send email
			$this->sending_email($dataUser);
			$this->session->set_userdata('msg_resend_activationcode', 2);
		}else{
			$this->session->set_userdata('msg_resend_activationcode', 1);
		}
		redirect(base_url());
	}
	
	function resend_businessaccount(){
		$e = $this->input->get_post('e');
		$eh = $this->input->get_post('eh');
		$eh_ori = sha1(SALT . $e);
		if ($eh == $eh_ori){
			$user = $this->account_model->getAccount("ma.account_email", $e);
			$dataUser = array(
				'account_type' => 'business',
				'account_name' => $user->account_name,
				'account_email' => $user->account_email,
				'account_password' => $user->account_password,
				'account_temp_password' => $user->account_temp_password,
				'verification_code' => $user->verification_code,
				'register_step' => $user->register_step,
				'account_live' => $user->account_live
			);
			// send email
			$this->sending_email($dataUser, "business");
			$this->session->set_userdata('msg_resend_businessaccount', 2);
		}else{
			$this->session->set_userdata('msg_resend_businessaccount', 1);
		}
		redirect(base_url() . 'business/register');
	}

	function sending_email($data, $type = 'user'){
		// sending email
		require_once APPPATH.'libraries/swiftmailer/swift_required.php';
		$transport = Swift_MailTransport::newInstance();
		//Create the message
        $message = Swift_Message::newInstance();
		//Give the message a subject
		
		$email = $data['account_email'];
				
		$subject = "Account Verification";		
		switch($type){
			case "user" :
				$tmpl = "email_activation_account_view"; 
				$subject = "Account Verification";
				break;
			case "business" :
				$tmpl = "email_info_account_view";
				$subject = "Account Verification";
				break;
			case "forgotpassword" :
				$tmpl = "email_forgotpassword_view";
				$subject = "Reset your Activorm Account password‏";
				break; 
		}		
				
		$data = $this->load->view('email/' . $tmpl, $data, true);
        $message->setSubject($subject)
                ->setFrom(array('info@activorm.com' => 'Activorm'))
                ->setTo($email)
                ->addPart($data, 'text/html')
        ;
		//Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);
        
        //Send the message
        $result = $mailer->send($message);
	}
	
	function verify_code(){
		$submit_verify = $this->input->get_post('submit_verify');
		if (!empty($submit_verify)){
			$this->load->model('account_model');
			$activation_code = $this->input->get_post('activation_code');
			$register_temp = $this->session->userdata('register_temp');
			$email = $this->session->userdata('account_email'); //$register_temp['email'];
			$user = $this->account_model->getAccount("ma.account_email", $email);
			if (empty($user)){
				$this->session->set_userdata('message_register_error', "Code aktivasi yang Anda masukkan salah.");
			}else{
				
				if ($user->verification_code == $activation_code){
				
					$account_id = $user->account_id;
					$register_step = $user->register_step + 1;
					$register_temp = $this->session->userdata('register_temp');
					$register_temp['step'] = $register_step;
					$dataUser = array(
						'register_step' => $register_step
					);
					$this->load->model('account_model');
					$account_id = $this->account_model->registerAccount($dataUser);
							
					$this->access->register_session($account_id, $register_temp);
					
				}else{
					
					$this->session->set_userdata('message_register_error', "Code aktivasi yang Anda masukkan salah.");
					
				}
			}
		}
		redirect(base_url());
	}

	function login(){		
		$login = $this->input->get_post('login');
		if (!empty($login)){
			$email = $this->input->get_post('email');
			$password = $this->input->get_post('password');
			$salt_password = md5($password . SALT);
			$user = $this->account_model->getAccountLogin($email, $salt_password);
			if (empty($user)){
				$this->session->set_userdata('message_register_login_error', 1);
				$this->session->set_userdata('message_login_error', "Please insert the correct email and password.");
			}else{
				
				if (
					($user->account_live == "Offline" && $user->account_type == "business") ||
					$user->account_active == 0
				) redirect(base_url());			
				
				// for business saja
				$business_id = "";
				if (!empty($user) && $user->account_type == "business"){
					$this->load->model('business_model');
					$business_account =  $this->business_model->getBusiness("", "", $user->account_id);
					$business_id = $business_account->business_id;
				}
				
				// redirect ke halaman depan lagi utk register tombol tekan
				$this->access->register_session($user->account_id, array(
					'account_id' => $user->account_id,
					'fullname' => $user->account_name,
					'email' => $user->account_email,
					'step' => $user->register_step
				), $business_id);
				
				// invitation
				if (DEV_INVITATION == 1){
					$this->session->set_userdata('invitation_only', 1);
				}
				
				// ip address
				$this->access->logIpAddress($user->account_id);
				
				if ($user->account_live == "Offline"){
							
				}else{
					
					if ($user->register_step == 4) redirect(base_url() . 'settings/contact');
					else {
						
						//$current_uri = $this->session->userdata('current_uri');
						$ref = $_SERVER['HTTP_REFERER'];
						
						if (empty($ref)){
							redirect(base_url());
						}else{
							redirect($ref);
						}
						
					}
					
				}
			}
		}
		redirect(base_url());
	}
	
	function register_completed(){
		$vc = $this->input->get_post('vc');
		$hash = $this->input->get_post('hash');
		$ori_hash = sha1($vc . date('Y-m-d'));
		if ($hash == $ori_hash){
			$register_step = 4;
			$dataUser = array(
				'register_step' => $register_step,
				'account_live' => 'Online'
			);
			$this->load->model('account_model');
			$account_id = $this->account_model->registerAccount($dataUser);
			$register_temp = $this->session->userdata('register_temp');
			$register_temp['step'] = $register_step;
			$this->access->register_session($account_id, $register_temp);
			redirect(base_url() . 'settings/contact');
		}
		redirect(base_url());
	}

	function logout(){
		$this->access->remove_session();
		redirect(base_url());
	}
	
	// hanya yang sudah login saja
	function auth_connection(){
		$account_id = $this->session->userdata('account_id');
		if (empty($account_id)) redirect(base_url());
	}
	
	// business register
	function business_register(){
		
		$business_submit = $this->input->get_post('business_submit');
		if (!empty($business_submit)){
			$business_name = $this->input->get_post('business_name');
			$business_position = $this->input->get_post('business_position');
			$business_contact = $this->input->get_post('business_contact');
			$business_email = $this->input->get_post('business_email');
			$business_number = $this->input->get_post('business_number');
			$business_desc = $this->input->get_post('business_desc');
			$business_needs = $this->input->get_post('business_needs');

			$this->load->library('validate');
			$validateBusinessName = $this->validate->validateName($business_name);
			$validateBusinessContact = $this->validate->validateName($business_contact);
			$validateBusinessEmail = $this->validate->validateEmail($business_email);
			$business_number = preg_replace("/[^0-9]/", "", $business_number);
			
			$errors = array();
			if ($validateBusinessName == 1){
				$errors[] = "Company Name must contain words only (you may not use special characters e.g. - , > , % , $)";
			}
			if ($validateBusinessContact == 1){
				$errors[] = "Person In Charge must contain words only (you may not use special characters e.g. - , > , % , $)";
			}
			if ($validateBusinessEmail == 1){
				$errors[] = "Please insert the correct email.";
			}
			if (empty($business_number)){
				$errors[] = "Contact Number may consists of numbers only.";
			}
			if (strlen($business_desc) < 50){
				$errors[] = "Please describe your Business in minimum 50 characters.";
			}
			if (strlen($business_needs) < 5){
				$errors[] = "Business Needs must contain minimum 5 characters.";
			}
			if (empty($business_position)){
				$errors[] = "Please insert your Position in the Company.";
			}
			
			$this->load->model('account_model');
			$user = $this->account_model->getAccount('ma.account_email', $business_email, $account_type = 'business');
			if (!empty($user)){
				$errors[] = 'Email has been used by another account.';
			}
			
			$this->load->library('util');
			$business_uri = $this->util->url_slug($business_name);
			$this->load->model('business_model');
			$business = $this->business_model->getBusiness('bp.business_uri', $business_uri);
			if (!empty($business)){
				$errors[] = 'Your Business Name has been taken.';
			}
			
			if (count($errors) > 0){
				$this->session->set_userdata('message_register_business_error', $errors);
				
				$this->session->set_userdata('business_name', $business_name);
				$this->session->set_userdata('business_position', $business_position);
				$this->session->set_userdata('business_contact', $business_contact);
				$this->session->set_userdata('business_email', $business_email);
				$this->session->set_userdata('business_number', $business_number);
				$this->session->set_userdata('business_desc', $business_desc);
				$this->session->set_userdata('business_needs', $business_needs);
				
			}else{
				
				// masukkan business data
				$dataBusiness = array(
					'business_name' => $business_name,
					'business_uri' => $business_uri,
					'business_description' => $business_desc,
					'business_needs' => $business_needs,
					'contact_person' => $business_contact,
					'contact_number' => $business_number,
					'position_inthe_company' => $business_position,
					'business_live' => 'Online',
					'business_active' => 1
				);
				$business_id = $this->business_model->registerBusiness($dataBusiness);
				
				// masukkan account member data
				$password = $this->util->create_code(6, "number");
				$md5_password = md5($password . SALT);
				$verification_code = $this->util->create_code(4, "number");
				
				$dataUser = array(
					'account_type' => 'business',
					'account_name' => $business_name,
					'account_email' => $business_email,
					'account_password' => $md5_password,
					'account_temp_password' => $password,
					'verification_code' => $verification_code,
					'register_step' => 4,
					'account_live' => 'Online'
				);
				$account_id = $this->account_model->registerAccount($dataUser);
				
				// send email
				$this->sending_email($dataUser, 'business');
				$this->session->set_userdata('tmp_email_business', $business_email);
				
				// masukkan relationnya
				$data = array(
					'business_id' => $business_id,
					'account_id' => $account_id,
				);
				$this->business_model->registerRelBusinessMember($data);
				
				$this->session->set_userdata('message_register_business_success', 1);
				
			}
			
		}
		
		redirect(base_url() . 'business/register');
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/* SOCIAL MEDIA CONNECT =============================== **/
	
	// TWITTER CONNECT =================================================
	function twitter_connect(){
		$this->auth_connection();
		$this->load->library('twitter_library');
		$ref = $_SERVER['HTTP_REFERER'];
		$this->session->set_userdata('HTTP_REFERER', $ref);
		redirect( $this->twitter_library->connection_start() );
	}
	
	function twitter_callback(){
		$this->auth_connection();
		$this->load->library('twitter_library');
		$this->twitter_library->connection_callback();
		$this->twitter_library->connection();
		
		/*save db*/
		$this->load->model('socialmedia_model');
		$account_id = $this->session->userdata('account_id');
		$tw_access_token = json_encode( $this->twitter_library->tw_access_token );
		$tw_content = json_encode( $this->twitter_library->content );
		$data = array(
			'account_id' => $account_id,
			'social_name' => 'twitter',
			'social_data' => $tw_content,
			'social_oauth_data' => $tw_access_token,
			'social_active' => 1
		);
		$this->socialmedia_model->insertLogSocialMedia($data);
		
		$ref = $this->session->userdata('HTTP_REFERER');
		$this->session->unset_userdata('HTTP_REFERER');
		redirect($ref);
	}
	
	/*
	function twitter_se(){
		$this->load->library('twitter_library');
		$this->twitter_library->connection();
	}*/
	
	// FACEBOOK CONNECT =================================================
	function facebook_connect_ref(){
		$ref = $_SERVER['HTTP_REFERER'];
		$this->session->set_userdata('HTTP_REFERER', $ref);
		// connect facebook url
		$this->access->facebook_connect();
		$this->session->set_userdata('fbauth', 1);
		redirect($this->access->fb_connect_url);
	}
	function facebook_connect(){
		$this->auth_connection();
		
		// datang dari facebook
		$state = $this->input->get_post('state');
		$code = $this->input->get_post('code');

		if (empty($state) || empty($code)) redirect(base_url());

		// extract fb
		$this->dataFB = $this->access->facebook->api('/me');
		// fb user interests									
		$this->fb_user_interest();					
		
		// masukkan data log fb di database
		$this->load->model('socialmedia_model');
		$account_id = $this->session->userdata('account_id');
		$data = array(
			'account_id' => $account_id,
			'social_name' => 'facebook',
			'social_data' => json_encode($this->dataFB),
			'social_active' => 1
		);
		$this->socialmedia_model->insertLogSocialMedia($data);
		
		$ref = $_SERVER['HTTP_REFERER'];
		if (empty($ref)) $ref = base_url() . 'settings/socialmedia';
		//redirect(base_url() . 'settings/socialmedia');
		
		$this->session->set_userdata('fbauth', 1);
		
		//$ref = $this->session->userdata('HTTP_REFERER');
		//$this->session->unset_userdata('HTTP_REFERER');
		redirect($ref);
	}
	
	function setfacebookpage(){
		$fpid = $this->input->get_post('fpid');
		$hash = $this->input->get_post('hash');
		$set = $this->input->get_post('set');
		$account_id = $this->session->userdata('account_id');
		$orihash = sha1($fpid . SALT);
				
		if ($hash == $orihash && !empty($account_id)){
			$this->load->model('socialmedia_model');
			$socialmedia = $this->socialmedia_model->getSocialMediaConnect($account_id, 'facebook');
			if (!empty($socialmedia) || !empty($socialmedia->social_page_data)){
				$fbpages = json_decode($socialmedia->social_page_data);
				$return = array();
				foreach($fbpages as $k=>$v){
					if ($v->id == $fpid){
						if ($set == 1){
							$return = $v;
						}
						$where = array(
							'account_id' => $account_id,
							'social_name' => 'facebook'
						);
						$data = array(
							'social_page_active' => json_encode($return),
						);
						$this->socialmedia_model->updateLogSocialMedia($where, $data);
						break;
					}
				}
			}
		}
		
		redirect(base_url() . 'settings/socialmedia');
		
	}

	function fb_user_interest(){
		$account_id = $this->session->userdata('account_id');
		$this->dataFBUserInterests = $this->access->facebook->api('/me/interests');
		if (!empty($this->dataFBUserInterests['data'])){
			$this->load->model('account_model');
			foreach($this->dataFBUserInterests['data'] as $k=>$v){
				unset($v['created_time']);
				$vid = (!empty($v['id'])) ? $v['id'] : 0;
				$v['cid'] = $vid;
				unset($v['id']);
				$v['account_id'] = $account_id;
				
				$data = array(
					'cid' => $vid,
					'account_id' => $account_id,
					'category' => $v['category'],
					'name' => $v['name']
				);
				
				$this->account_model->registerFBUserInterests($data);
			}
		}
	}
	
	
	
	
	
	function vcautoauth(){
		$vc = $this->input->get_post('vc');
		$vch = $this->input->get_post('vch');
		$vch_ori = sha1(SALT . $vc);
		if ($vch == $vch_ori){
			$account_id = $this->session->userdata('account_id');
			if (empty($account_id)){
				$this->load->model('account_model');
				$user = $this->account_model->getAccount("ma.verification_code", $vc, 0);
				if (!empty($user)){
					$this->session->set_userdata('invitation_only', 1);
					// redirect ke halaman depan lagi utk register tombol tekan
					$this->access->register_session($user->account_id, array(
						'account_id' => $user->account_id,
						'fullname' => $user->account_name,
						'email' => $user->account_email,
						'step' => $user->register_step
					));
				}
			} 
		}	
		redirect(base_url());		
	}
	
	
	
	
	function forgotpassword(){
		$account_id = $this->session->userdata('account_id');
		if (!empty($account_id)) redirect(base_url());
		$this->data['nopopuplogin'] = 1;
		$this->data['menu'] = 'forgotpassword';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Home';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/auth/forgotpassword_view', $this->data);
	}
	
	function process_forgotpassword(){
		$forgotpassword = $this->input->get_post('forgotpassword');
		$email = $this->input->get_post('email');
		$this->load->model('account_model');
		$user = $this->account_model->getAccount("ma.account_email", $email);
		if (!empty($user)){
			$this->load->library('util');
			$hash1 = $this->util->create_code("4","text");
			$hash2 = $this->util->create_code("4","number");
			$hash = $hash1.$hash2;
			$data = array(
				'hash' => $hash
			);
			$this->account_model->updateAccount($data, $user->account_id);
			$this->session->set_userdata('msg_forgotpassword_success', 'Reset password information successfully sent.');
			
			$data_email = array(
				'account_email' => $user->account_email,
				'account_name' => $user->account_name,
				'link_reset_password' => base_url() . 'auth/resetpassword?h=' . $hash . '&hs=' . sha1(SALT . $hash)
			);
			$this->sending_email($data_email, "forgotpassword");
			
		}else{
			$this->session->set_userdata('msg_forgotpassword_error', 'It looks like you entered invalid information. Please try again.');
		}
		redirect(base_url().'auth/forgotpassword');
	}
	
	
	function resetpassword(){
		$account_id = $this->session->userdata('account_id');
		if (!empty($account_id)) redirect(base_url());
		
		$h = $this->input->get_post('h');
		$hs = $this->input->get_post('hs');
		$hs_ori = sha1(SALT . $h);
		
		if (empty($h) || empty($hs) || $hs != $hs_ori) redirect(base_url());
		
		$this->load->model('account_model');
		$user = $this->account_model->getAccountByHash($h);
		if (empty($user)) redirect(base_url());
		
		$this->session->set_userdata('resetpassword_accountid', $user->account_id);
		$this->session->set_userdata('resetpassword_h', $h);
		$this->session->set_userdata('resetpassword_hs', $hs);
		
		$msg_resetpassword_success = $this->session->userdata('msg_resetpassword_success');
		if (!empty($msg_resetpassword_success)){
			$data = array(
				'hash' => ''
			);
			$this->account_model->updateAccount($data, $user->account_id);
		}
		
		$this->data['nopopuplogin'] = 1;
		$this->data['menu'] = 'resetpassword';
		$css = array();
		$js = array();
		$meta = array();
		$title = 'Home';
		$this->_default_param($css, $js, $meta, $title);
		$this->load->view('a/auth/resetpassword_view', $this->data);
	}
	
	function process_resetpassword(){
		
		$h = $this->session->userdata('resetpassword_h');
		$hs = $this->session->userdata('resetpassword_hs');
		
		$account_id = $this->session->userdata('resetpassword_accountid');
		$newpassword = $this->input->get_post('new_password');
		$confirmpassword = $this->input->get_post('confirm_password');
		$this->load->library('validate');
		
		$errors = array();
		
		if ($newpassword != $confirmpassword){
			$errors[] = "Terjadi kesalahan dalam penulisan confirm password Anda.";
		}
		$validatePassword = $this->validate->validatePassword($newpassword);
		if ($validatePassword == 1){
			$errors[] = "Terjadi kesalahan dalam penulisan format password Anda.";
		}
		
		if (count($errors) > 0){
			$this->session->set_userdata('msg_resetpassword_error', $errors);
		}else{
			
			$data = array(
				'account_password' => md5($newpassword . SALT)
			);
			$this->account_model->updateAccount($data, $account_id);
			
			$this->session->set_userdata('msg_resetpassword_success', "Password successfully changed. Please proceed to login.");
		}
		
		redirect(base_url().'auth/resetpassword?h=' . $h . '&hs=' . $hs);
	}
	
	
	
	
	
	/* ======== GOOGLE ANALYTIC API =============== start ============= */
	function ga(){
		$this->load->library("google_analytic_library");
		$url = $this->google_analytic_library->oauth();
		//echo $url;
		redirect($url);
	}
	function ga_oauth(){
		$this->load->library("google_analytic_library");
		$code = $this->input->get_post('code');
		$auth = $this->google_analytic_library->ga->auth->getAccessToken($code);
		
		// Try to get the AccessToken
		if ($auth['http_code'] == 200) {
		    $accessToken = $auth['access_token'];
		    $refreshToken = $auth['refresh_token'];
		    $tokenExpires = $auth['expires_in'];
		    $tokenCreated = time();
			
			$ga_session = array(
				'auth' => $auth,
				'token_created' => $tokenCreated
			);
			
			$this->load->model('config_model');
			$this->config_model->addConfig("google_analytic_session", json_encode($ga_session));
			
			$this->session->set_userdata("ga_session", $ga_session);
			
			redirect(base_url().'auth/ga_testing2');
			
		} else {
		    // error..
		    echo 'ERROR';
		}
	}
	function ga_testing2(){
		$this->load->library("google_analytic_library");	
		
		$ga_session = $this->session->userdata("ga_session");
		
		// Check if the accessToken is expired
		$tokenExpires = $ga_session['auth']['expires_in'];
		$refreshToken = $ga_session['auth']['refresh_token'];
		if ((time() - $ga_session['token_created']) >= $tokenExpires) {
		    $auth = $this->google_analytic_library->ga->auth->refreshAccessToken($refreshToken);
		    // Get the accessToken as above and save it into the Database / Session
		    //echo '<pre>';print_r($auth);echo '</pre>';
		    $accessToken = $auth['access_token'];
		    $refreshToken = (empty($auth['refresh_token'])) ? $refreshToken : $auth['refresh_token'];
			$auth['refresh_token'] = $refreshToken;
		    $tokenExpires = $auth['expires_in'];
		    $tokenCreated = time();
			
			$ga_session = array(
				'auth' => $auth,
				'token_created' => $tokenCreated
			);
			
			$this->session->set_userdata("ga_session", $ga_session);
			redirect(base_url() . 'auth/ga_testing2');
		}
		
		echo '<pre>';
		print_r($ga_session);
		echo '</pre>';
		
		// Set the accessToken and Account-Id
		$accessToken = $ga_session['auth']['access_token'];
		$this->google_analytic_library->ga->setAccessToken($accessToken);
		//$this->google_analytic_library->ga->setAccountId('ga:UA-45183446-1');
		echo $accessToken;
		
		$profiles = $this->google_analytic_library->ga->getProfiles();
		echo '<pre>';
		print_r($profiles);
		echo '</pre>';
	}
	function ga_testing(){
				
		$this->load->library("google_analytic_library");	
		
		$ga_session = $this->session->userdata("ga_session");
		echo '<pre>';
		print_r($ga_session);
		echo '</pre>';
		
		// Check if the accessToken is expired
		$tokenExpires = $ga_session['auth']['expires_in'];
		$refreshToken = $ga_session['auth']['refresh_token'];
		if ((time() - $ga_session['token_created']) >= $tokenExpires) {
		    $auth = $this->google_analytic_library->ga->auth->refreshAccessToken($refreshToken);
		    // Get the accessToken as above and save it into the Database / Session
		}
		
		// Set the accessToken and Account-Id
		$accessToken = $ga_session['auth']['access_token'];
		$this->google_analytic_library->ga->setAccessToken($accessToken);
		//$this->google_analytic_library->ga->setAccountId('ga:UA-45183446-1');
		
		
		/*
		// start ========================= find account ===========================
		// Load profiles
		$profiles = $this->google_analytic_library->ga->getProfiles();
		echo '<pre>';
		print_r($profiles);
		echo '</pre>';
		$accounts = array();
		foreach ($profiles['items'] as $item) {
		    $id = "ga:{$item['id']}";
		    $name = $item['name'];
		    $accounts[$id] = $name;
		}
		// Print out the Accounts with Id => Name. Save the Id (array-key) of the account you want to query data. 
		// See next chapter how to set the account-id.
		echo '<pre>';
		print_r($accounts);
		echo '</pre>';
		// end ========================= find account ===========================
		*/
		
		$this->google_analytic_library->ga->setAccountId('ga:78298628');
		// Set the default params. For example the start/end dates and max-results
		$defaults = array(
		    'start-date' => date('Y-m-d', strtotime('-1 month')),
		    'end-date' => date('Y-m-d', strtotime('- 1 days')),
		);
		$this->google_analytic_library->ga->setDefaultQueryParams($defaults);
		
		// Example1: Get visits by date
		// ga:visitors,ga:newVisits,ga:visits,ga:bounces,ga:visitBounceRate,ga:timeOnSite,ga:avgTimeOnSite,ga:pageviews,ga:pageviewsPerVisit,ga:uniquePageviews,ga:timeOnPage,ga:avgTimeOnPage,ga:percentNewVisits
		$params = array(
		    'metrics' => 'ga:visitors,ga:newVisits,ga:visits,ga:bounces,ga:visitBounceRate,ga:timeOnSite,ga:avgTimeOnSite,ga:percentNewVisits',
		    'dimensions' => 'ga:date',
		);
		$this->visits = $this->google_analytic_library->ga->query($params);
		
		echo '<pre>';
		print_r($this->visits);
		echo '</pre>';
		
		$params = array(
			'metrics' => 'ga:pageviews,ga:pageviewsPerVisit,ga:uniquePageviews,ga:timeOnPage,ga:avgTimeOnPage',
			'dimensions' => 'ga:date',
		);
		$this->visits2 = $this->google_analytic_library->ga->query($params);
		
		echo '<pre>';
		print_r($this->visits2);
		echo '</pre>';
		
		$params = array(
			'metrics' => 'ga:visitors,ga:percentNewVisits,ga:newVisits,ga:visits,ga:visitBounceRate,ga:avgTimeOnSite,ga:timeOnSite,ga:bounces',
			'dimensions' => 'ga:source,ga:medium',
			'sort' => '-ga:visits'
		);
		$this->visits3 = $this->google_analytic_library->ga->query($params);
		
		echo '<pre>';
		print_r($this->visits3);
		echo '</pre>';
		
		$this->load->view("welcome_message");
		
	}
	function ga_testing_final(){
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
		
		
		/*
		echo '<pre>';
		print_r($ga_session);
		echo '</pre>';
		
		// Set the accessToken and Account-Id
		$accessToken = $ga_session->auth->access_token;
		$this->google_analytic_library->ga->setAccessToken($accessToken);
		//$this->google_analytic_library->ga->setAccountId('ga:UA-45183446-1');
		echo $accessToken;
		
		$profiles = $this->google_analytic_library->ga->getProfiles();
		echo '<pre>';
		print_r($profiles);
		echo '</pre>';
		*/ 
		
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
			'start-date' => '2013-10-27'
		);
		$this->test1 = $this->google_analytic_library->ga->query($params);
		
		$params = array(
			'metrics' => 'ga:percentNewVisits,ga:visits,ga:newVisits',
			'dimensions' => 'ga:sourceMedium,ga:medium,ga:source',
			'max-results' => 10,
			'start-date' => date('Y-m-d', strtotime('-1 month')),
			'sort' => '-ga:visits'
		);
		$this->test2 = $this->google_analytic_library->ga->query($params);
		
		$this->load->view('welcome_testing');
	}
	/* ======== GOOGLE ANALYTIC API =============== end ============= */
	
	
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