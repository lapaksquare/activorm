<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends MY_Controller{
	
	function projectlivesnap(){
		$pid = $this->input->get_post('pid');
		if (empty($pid)) redirect(base_url());
		$this->load->model('project_model');
		$this->project = $this->project_model->getProject("pp.project_id", $pid);
		if (empty($this->project)) redirect(base_url());
		
		$project_period_int = $this->project->project_period_int;
		$project_period = date('Y-m-d H:i:s', strtotime("+" . $project_period_int . " days"));
		$project_live = "Online";
		$project_active = 1;
		$data = array(
			'project_period' => $project_period,
			'project_live' => $project_live,
			'project_active' => $project_active
		);
		$this->project_model->registerProject($data, $pid);
		echo 'Success';
	}
	
	function addPrizeProfile(){
		$data = array(
			'activorm' => array(
				'prize_name' => 'MAP Voucher IDR 500K',
				'prize_primary_photo' => 'images/prize/Homepage-Activorm.png'
			),
			'espa' => array(
				'prize_name' => 'BABOR Skinovage Facial',
				'prize_primary_photo' => 'images/prize/Homepage-ESPA.png'
			),
			'lolabox' => array(
				'prize_name' => 'Front Cover Makeup Kit',
				'prize_primary_photo' => 'images/prize/Homepage-Lolabox.jpeg'
			),
			'sens' => array(
				'prize_name' => 'Gift Voucher IDR 2.5M',
				'prize_primary_photo' => 'images/prize/Homepage-SENS.png'
			),
			'kipaskudingin' => array(
				'prize_name' => 'Shopping Voucher IDR 150K',
				'prize_primary_photo' => 'images/prize/Homepage-Kipaskudingin.png'
			),
			'fashion-epicentrum' => array(
				'prize_name' => 'Shopping Voucher 150K',
				'prize_primary_photo' => 'images/prize/Homepage-prize-FashionEpicentrum.png'
			),
			'hanny-purple-shop' => array(
				'prize_name' => 'Ray Ban Classic Aviator',
				'prize_primary_photo' => 'images/prize/Homepage-HannyPS.png'
			),
			'orderlagi' => array(
				'prize_name' => 'Powerbank VIVAN 2200mAh',
				'prize_primary_photo' => 'images/prize/Homepage-orderlagi.png'
			)
		);
		
		$this->load->library('util');
		$this->load->model('prize_model');
		foreach($data as $k=>$v){
			$v['prize_uri'] = $this->util->url_slug($v['prize_name']);
			$this->prize_model->registerPrize($v);
		}
		
	}

	function send_email_invitation(){
		$this->load->model('prize_model');
		$this->data['product_prize'] = $this->prize_model->getProductPrize(12);
		
		//echo '<pre>';
		//print_r($this->data['product_prize']);
		//echo '</pre>';
		
		$this->load->model('business_model');
		$this->data['merchants'] = $this->business_model->getMerchantHomePage();
		$this->load->model('invitation_model');
		$page = $this->input->get_post('page');
		$emails = $this->invitation_model->sendInvitationEmail($page);
		
		$this->load->library('validate');
		
		$this->data['special_text'] = "Invitation";
		$this->data['subject_email'] = "Congratulations! Here is your Activorm Private Beta Invitation";
		$this->data['email'] = $email = 'aa@e.com';
		$this->data['email_hash'] = sha1(SALT.$email);
		
		/*
		foreach($emails as $k=>$v){
		
			$email = $v->account_email;
			$email_hash = sha1(SALT.$email);
			
			if ($this->validate->validateEmail($email) == 1) continue;
			
			$special_text = "Invitation";
			if ($v->account_type == "special_quest"){
				$special_text = "Special Invitation";
			}
			
			$subject_email = "Congratulations! Here is your Activorm Private Beta Invitation";
			if ($v->account_type == "special_quest"){
				$subject_email = "Congratulations! Here is your Special Invitation to Activorm Private Beta";
			}
			
			$data = array(
				'account_type' => $v->account_type,
				'email' => $email,
				'email_hash' => $email_hash,
				'product_prize' => $this->data['product_prize'],
				'merchants' => $this->data['merchants'],
				'special_text' => $special_text,
				'subject_email' => $subject_email
			);
			
		
			echo '<pre>';
			print_r($v);
			echo '</pre>';
			
			
			$this->sending_email($data);
		
		}
		 */ 
		
		$this->load->view('email/invitation_email_view', $this->data);
	}
	
	function sending_email($data, $tmpl = "invitation_email_view", $type_tmpl = "html"){
		// sending email
		require_once APPPATH.'libraries/swiftmailer/swift_required.php';
		$transport = Swift_MailTransport::newInstance();
		//Create the message
        $message = Swift_Message::newInstance();
		//Give the message a subject
		
		$email = $data['email'];
		$subject = $data['subject_email'];
		
		if ($type_tmpl == "html"){						
			$data = $this->load->view('email/' . $tmpl, $data, true);
        }else if ($type_tmpl == "text"){
        	$data = $tmpl;
        }
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
	
	function cekActionsProjectProfile(){
		$sql = "
		SELECT
		pp.project_name,
		pp.project_actions_data
		FROM
		project__profile pp
		WHERE 1
		AND pp.project_live = 'Online'
		AND pp.project_active = 1
		";
		$results = $this->db->query($sql)->result();
		foreach($results as $k=>$v){
			$data = json_decode($v->project_actions_data);
			echo 'project_name : ' . $v->project_name . '<br />';
			echo 'project_actions_data : ';
			echo '<pre>';
			print_r($data);
			echo '</pre>';
			echo '===================================== <br />';
		}
	}
	
	
	/* crack =================== start crack ==================== 
	 * 
	 * http://activorm.com/cron/crackProjectProfile
	 * http://activorm.com/cron/crackProjectTiket?pid=51
	 * 
	 * */
	function crackProjectProfile(){
		$sql = "
		SELECT
		pp.project_name,
		pp.project_id,
		bp.business_name,
		bp.business_id,
		pp.project_period,
        COUNT(pt.tiket_barcode) jml_tiket
		FROM
		project__profile pp
		JOIN business__profile bp ON
			pp.business_id = bp.business_id
        LEFT JOIN project__tiket pt ON
                pt.project_id = pp.project_id
		WHERE 1
		AND pp.project_live = 'Online'
		AND pp.project_active = 1
                GROUP BY pt.project_id
ORDER BY `pp`.`project_name`  DESC
		";
		$results = $this->db->query($sql)->result();
		echo '<table border="1">';
		echo '<thead>
		<tr>
			<th>Project Id</th>
			<th>Project Name</th>
			<th>Business Id</th>
			<th>Business Name</th>
			<th>Period</th>
			<th>Jumlah Tiket/Member</th>
		</tr>
		</thead></tbody>';
		
		foreach($results as $k=>$v){
			
			$project_period = strtotime($v->project_period);
			$project_now = strtotime(date('Y-m-d H:i:s'));
			$period = $project_period - $project_now;
			$period = ($period > 0) ? (int)date('d', $period) : 0;
				
			$period_string = "";	
        	if ($period > 0){
				$period_string .= $period .' Day';
				$period_string .= ($period == 1) ? '' : 's';
				$period_string .= " Left";
			}
					
			echo '<tr>
				<td>'.$v->project_id.'</td>
				<td>'.ucwords($v->project_name).'</td>
				<td>'.$v->business_id.'</td>
				<td>'.ucwords($v->business_name).'</td>
				<td>'.$period_string.'</td>
				<td>'.$v->jml_tiket.'</td>
			</tr>';	
			
		}
		
		echo '</tbody></table>';
	}
	function crackProjectTiket(){
		$project_id = $this->input->get_post('pid');
		if (empty($project_id)) return false;
		
		$sql = "
		SELECT
		pt.tiket_barcode,
		ma.account_id,
		ma.account_name,
		pp.project_name,
		ma.account_email,
		cs.social_data,
		cs.social_name
		FROM
		project__tiket pt
		JOIN member__account ma ON
			ma.account_id = pt.account_id
		JOIN project__profile pp ON
			pp.project_id = pt.project_id
			AND pp.project_win = 0
		JOIN connect__socialmedia cs ON
			cs.account_id = ma.account_id
		WHERE 1
		AND pt.project_id = ?
		ORDER BY ma.account_name ASC
		";
		$results = $this->db->query($sql, array($project_id))->result();
		
		if (!empty($results)){
			
			echo "========================= <br />";
			echo "PESERTA <br />";
			echo "========================= <br />";
			
			echo '<table border="1">';
			echo '<thead>
			<tr>
				<th>Tiket Barcode</th>
				<th>Project Name</th>
				<th>Account Name</th>
				<th>Account Email</th>
				<th>Facebook</th>
				<th>Twitter</th>
			</tr>
			</thead></tbody>';
			
			$this->load->model('socialmedia_model');
			
			$return = array();
			foreach($results as $k=>$v){
						
				if (empty($return[$v->account_id])){
					$social_data = json_decode($v->social_data);
					$return[$v->account_id] = array(
						'tiket_barcode' => $v->tiket_barcode,
						'project_name' => $v->project_name,
						'account_name' => $v->account_name,
						'account_email' => $v->account_email,
						$v->social_name => $social_data
					);
				}else{
					if (!empty($v->social_data)){
						$social_data = json_decode($v->social_data);
						$return[$v->account_id][$v->social_name] = $social_data;
					}
				}	
				
			}

			foreach($return as $k=>$v){
					
				$facebook_url = (!empty($v['facebook'])) ? 'LINK : <a href="http://facebook.com/'.$v['facebook']->id.'" target="_blank">LINK</a>' : "";
				$twitter_url = (!empty($v['twitter'])) ? 'LINK : <a href="http://twitter.com/'.$v['twitter']->screen_name.'" target="_blank">LINK</a>' : "";
				$twitter_followers_count = (!empty($v['twitter'])) ? '<br />Followers Count : '.$v['twitter']->followers_count : 0;
				
				echo '<tr>
					<td>'.strtoupper($v['tiket_barcode']).'</td>
					<td>'.ucwords($v['project_name']).'</td>
					<td>'.ucwords($v['account_name']).'</td>
					<td>'.$v['account_email'].'</td>
					<td>'.$facebook_url.'</td>
					<td>'.$twitter_url.$twitter_followers_count.'</td>
				</tr>';	
			}
			
			
			echo '</tbody></table>';
			
			echo "========================= <br />";
			echo "NAMA PEMENANG <br />";
			echo "========================= <br />";
			
			$sql = "
			SELECT
			pt.tiket_barcode,
			ma.account_name,
			pp.project_name,
			ma.account_email,
			pt.tiket_id,
			pp.project_id
			FROM
			project__tiket pt
			JOIN member__account ma ON
				ma.account_id = pt.account_id
			JOIN project__profile pp ON
				pp.project_id = pt.project_id
				AND pp.project_win = 0
			WHERE 1
			AND pt.project_id = ?
			ORDER BY RAND() LIMIT 1
			";
			$results = $this->db->query($sql, array($project_id))->result();
			
			echo '<table border="1">';
			echo '<thead>
			<tr>
				<th>Tiket Barcode</th>
				<th>Project Name</th>
				<th>Account Name</th>
				<th>Account Email</th>
			</tr>
			</thead></tbody>';
			
			foreach($results as $k=>$v){
				
				echo '<tr>
					<td>'.strtoupper($v->tiket_barcode).'</td>
					<td>'.ucwords($v->project_name).'</td>
					<td>'.ucwords($v->account_name).'</td>
					<td>'.$v->account_email.'</td>
					<td><a href="'.base_url().'cron/crackConfirmProjectTiket?pid='.$v->project_id.'&tid='.$v->tiket_id.'">Confirm</a></td>
				</tr>';	
				
			}
			
			echo '</tbody></table>';
			
		}else{
			echo '<p>Tidak ada data</p>';
			
			$sql = "
			SELECT
			pt.tiket_id,
			pt.tiket_barcode,
			pp.project_id,
			pp.project_name,
			pp.project_description,
			pp.project_uri,
			ma.account_id,
			ma.account_type,
			ma.account_name,
			ma.account_email
			FROM
			project__tiket pt
			JOIN member__account ma ON
				ma.account_id = pt.account_id
			JOIN project__profile pp ON
				pp.project_id = pt.project_id
			WHERE 1
			AND pt.project_id = ?
			AND pt.iswin = 1
			";
			$results = $this->db->query($sql, array($project_id))->row();
			
			echo '<p>Oooppsss... sudah ada yang menang nih : </p>';
			echo '<pre>';
			print_r($results);
			echo '</pre>';
			
		}
	}
	function crackConfirmProjectTiket(){
		$tiket_id = $this->input->get_post('tid');
		$project_id = $this->input->get_post('pid');
		if (empty($tiket_id)) redirect(base_url());
		
		$sql = "
		UPDATE project__tiket SET
		iswin = 0
		WHERE 1
		AND project_id = ?
		";
		$this->db->query($sql, array($project_id));
		
		$sql = "
		UPDATE project__tiket SET
		iswin = 1
		WHERE 1
		AND project_id = ?
		AND tiket_id = ?
		";
		$this->db->query($sql, array($project_id, $tiket_id));
		
		$sql = "
		UPDATE project__profile SET
		project_win = 1
		WHERE 1
		AND project_id = ? 
		";
		$this->db->query($sql, array($project_id));
		
		echo 'SUCCESS';
	}
	/* crack =================== end crack ==================== */
	
	function checkTriggerActionProject(){
		$sql = "
		SELECT
		pp.project_id,
		pp.project_name,
		pp.project_actions_data
		FROM
		project__profile pp
		WHERE 1
		AND pp.project_active = 1
		AND pp.project_live = 'Online'
		";
		$results = $this->db->query($sql)->result();
		foreach($results as $k=>$v){
			echo "<br /> ============================== <br />";
			echo "project_name : " . $v->project_name . '<br />';
			$project_actions_data = json_decode($v->project_actions_data);
			echo "<pre>";
			print_r($project_actions_data);
			echo "</pre>";
			echo "<br /> ============================== <br /><br />";
		}
	}
	
	
	/* crack sending email =================== start crack ==================== */
	function crackSendingEmail(){
		$subject = "WIN Alfabet Varsity Jacket from Tees.co.id, 100K Voucher from ESPA, and Durian Pancake from Tokocondet.com";
		$tmpl = "newsletter/newsletter_27jan2014_view";
		
		$set = $this->input->get_post('set');
		
		$emails = array(
			'junaidyanton@hotmail.com',
			'lapaksquare@gmail.com'
		);
		// testing
		if ($set == 1){
			$emails = array(
				'junaidyanton@hotmail.com',
				'sondanghutauruk@ymail.com',
				'hello@karenkamal.com',
				'ilhamopano@gmail.com',
				'wiccoseptyasteven@gmail.com',
				'lapaksquare@gmail.com',
				'wenznike@gmail.com',
				'sondanghutauruk@ymail.com'
			);
		// business account	
		}else if ($set == 2){
					
			$sql = "
			SELECT
			ma.account_email
			FROM
			member__account ma
			WHERE 1
			AND ma.account_type = 'business'
			AND ma.account_active = 1
			AND ma.account_live = 'Online'
			ORDER BY ma.account_id ASC
			";
			$emails = $this->db->query($sql)->result_array();	
						
		// member account	
		}else if ($set == 3){
		
			$sql = "
			SELECT
			ma.account_email
			FROM
			member__account ma
			WHERE 1
			AND ma.account_type = 'user'
			AND ma.account_active = 1
			AND ma.account_live = 'Online'
			ORDER BY ma.account_id ASC
			";
			$emails = $this->db->query($sql)->result_array();
		
		// member invitation	
		}else if ($set == 4){
			
			$sql = "
			SELECT
			ma.account_email
			FROM
			member__account_invitation ma
			WHERE 1
			AND ma.isactive = 1
			ORDER BY ma.account_id ASC
			";
			$emails = $this->db->query($sql)->result_array();
			
		}
		
		//echo '<pre>';print_r($emails);echo '</pre>';die();
		
		$this->load->library('validate');
				
		foreach($emails as $k=>$v){
					
			$email = ($set == 1 || empty($set)) ? $v : $v['account_email'];	
			$validateEmail = $this->validate->validateEmail($email);
			if ($validateEmail == 1) {
				echo $email . '<br />';
				continue;
			}
			
			$data = array(
				'subject_email' => $subject,
				'email' => $email
			);
			$this->sending_email($data, $tmpl);	
				
		}
	}
	/* crack sending email =================== end crack ==================== */
	
	
	// set project expired
	function setProjectExpired(){
		$sql = "
		SELECT
		pp.project_id,
		pp.project_period,
		pp.project_period_int,
		pp.project_name
		FROM
		project__profile pp
		WHERE 1
		AND pp.project_live = 'Online'
		";
		$result = $this->db->query($sql)->result();
		$msg = "";
		foreach($result as $k=>$v){
			$project_period = strtotime($v->project_period);
			$project_now = strtotime(date('Y-m-d H:i:s'));
			$period = $project_period - $project_now;
			$period = ($period > 0) ? date('d', $period) : 0;
			if ($period <= 0){
				$sql = "
				UPDATE 
				project__profile
				SET
				project_live = 'Closed'
				WHERE 1
				AND project_id = ?
				";
				$this->db->query($sql, array($v->project_id));
				$msg .= "==================================<br />";
				$msg .= "PROJECT ID : " . $v->project_id . "<br />";
				$msg .= "PROJECT NAME : " . $v->project_name . "<br />";
				$msg .= "==================================<br />";
			}
		}
		
		echo 'CHECK : ' . $msg;
		
		if ($msg != ""){
			// ===========================================
			$to = array(
				'beta@activorm.com', 'junaidyanton@hotmail.com', 'hello@karenkamal.com'
			);
			$this->sending_email_manual($to, '[ACTIVORM] PROJECT EXPIRED LIST', $msg);
			// ===========================================
		}
		
	}
	
	// set notify new project
	function setNotifyNewProject(){
		$date = date('Y-m-d', strtotime('-1 days'));
		$sql = "
		SELECT
		pp.project_id,
		pp.project_period,
		pp.project_period_int,
		pp.project_name,
		pp.project_posted
		FROM
		project__profile pp
		WHERE 1
		AND DATE_FORMAT(pp.project_posted, '%Y-%m-%d') = ? 
		";
		$results = $this->db->query($sql, array($date))->result();
		$msg = "";
		foreach($results as $k=>$v){
			$msg .= "==================================<br />";
			$msg .= "PROJECT ID : " . $v->project_id . "<br />";
			$msg .= "PROJECT NAME : " . $v->project_name . "<br />";
			$msg .= "PROJECT POSTED : " . date('d F Y', strtotime($v->project_posted)) . "<br />";
			$msg .= "==================================<br />";
		}
		
		echo 'CHECK : ' . $msg;
		
		if ($msg != ""){
			// ===========================================
			$to = array(
				'beta@activorm.com', 'junaidyanton@hotmail.com', 'hello@karenkamal.com'
			);
			$this->sending_email_manual($to, '[ACTIVORM] NEW PROJECT LIST', $msg);
			// ===========================================
		}
	}

	function sending_email_manual($to, $title, $msg){
		
		if (is_array($to)){
			$to = implode(", ", $to);
		}
		
		$headers = 'From: beta@activorm.com' . "\r\n" .
	    'Reply-To: beta@activorm.com' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();
		
		mail($to, $title, $msg, $headers);
	}
	
	
	/* google analytic */
	function gaAuth(){
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
	}
	function cronGATrafficWebsite(){
		$this->load->library("google_analytic_library");	
		$this->load->model("google_analytic_model");
		
		$endDateTraffic = $this->google_analytic_model->getEndDateTraffic();
		
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
			'start-date' => $endDateTraffic
		);
		$this->traffic_website = $this->google_analytic_library->ga->query($params);
				
		if (!empty($this->traffic_website['rows'])){
			foreach($this->traffic_website['rows'] as $k=>$v){
				$data = array(
					'analytic_date' => date('Y-m-d', strtotime($v[0])),
					'analytic_visitors' => $v[1],
					'analytic_newvisits' => $v[2],
					'analytic_visit' => $v[3],
					'analytic_percentnewvisits' => $v[4]
				);
				$this->google_analytic_model->addTrafficWebsite($data);
			}
		}
	}	
	function cronGATrafficContent(){
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
			'metrics' => 'ga:percentNewVisits,ga:visits,ga:newVisits',
			'dimensions' => 'ga:sourceMedium,ga:medium,ga:source',
			'max-results' => 10,
			'start-date' => date('Y-m-d', strtotime('-1 month')),
			'sort' => '-ga:visits'
		);
		$this->traffic_content = $this->google_analytic_library->ga->query($params);
		if (!empty($this->traffic_content['rows'])){
			foreach($this->traffic_content['rows'] as $k=>$v){
				$data = array(
					'analytic_medium' => $v[1],
					'analytic_source' => $v[2],
					'analytic_percentnewvisits' => $v[3],
					'analytic_visits' => $v[4],
					'analytic_newvisits' => $v[5]
				);
				$this->google_analytic_model->addTrafficContent($data);
			}
		}
	}
	function cronGATrafficDataNewReturnVisitors(){
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
			'max-results' => 500
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
				$this->google_analytic_model->addTrafficData("new_vs_return_visitors", $data);
			}
		}
	}
	function cronGATrafficDataMediumContent(){
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
			'filters' => 'ga:medium!=facebook;ga:medium!=twitter;ga:medium!=social',
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
				$this->google_analytic_model->addTrafficData("medium_data", $data);
			}
		}
	}
	function cronGATrafficDataSourceContent(){
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
			'filters' => 'ga:source==facebook.com,ga:source==m.facebook.com,ga:source==t.co,ga:source=~startupbisnis.com,ga:source=~techinasia.com,ga:source=~dailysocial.net,ga:source=~google,ga:source=~direct;ga:source!~blogspot.com;ga:source!~plus.url.google.com',
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
				$this->google_analytic_model->addTrafficData("source_data", $data);
			}
		}
	}
		
		
	/**** CRON SEND EMAIL NEWSLETTER NEW PROJECT 
	 * CHECK PER DAY JAM 10:00 ****/	
	function sendNewsletterNewProject_EmailDaily_10AM(){
		
		$sql = "
		SELECT
		ns.*
		FROM newsletter ns
		WHERE 1
		AND ns.newsletter_sending_schedule = DATE_FORMAT(NOW(),'%Y-%m-%d')
		AND ns.status = 'Online'
		AND ns.newsletter_subject != ''
		AND ns.newsletter_body != ''
		";
		
		$results = $this->db->query($sql)->result();
		
		if (!empty($results)){
			
			foreach($results as $k=>$v){
			
				$emails = array();
			
				// business account	
				if ($v->newsletter_target == "business"){
							
					$sql = "
					SELECT
					ma.account_email
					FROM
					member__account ma
					WHERE 1
					AND ma.account_type = 'business'
					AND ma.account_active = 1
					AND ma.account_live = 'Online'
					ORDER BY ma.account_id ASC
					";
					$emails = $this->db->query($sql)->result_array();	
								
				// member account	
				}else if ($v->newsletter_target == "user"){
				
					$sql = "
					SELECT
					ma.account_email
					FROM
					member__account ma
					WHERE 1
					AND ma.account_type = 'user'
					AND ma.account_active = 1
					AND ma.account_live = 'Online'
					ORDER BY ma.account_id ASC
					";
					$emails = $this->db->query($sql)->result_array();
				
				// all member and business
				}else if ($v->newsletter_target == "all"){
					
					$sql = "
					SELECT
					ma.account_email
					FROM
					member__account ma
					WHERE 1
					AND ma.account_active = 1
					AND ma.account_live = 'Online'
					ORDER BY ma.account_id ASC
					";
					$emails = $this->db->query($sql)->result_array();
				
				// testing	
				}else if ($v->newsletter_target == "testing"){
						
					$email = $v->newsletter_testing_email;			
					$email = explode(",", $email);
					foreach($email as $c=>$d){
						$emails[]['account_email'] = trim($d);
					}
					
				}
				
				//echo '<pre>';print_r($emails);echo '</pre>';die();
				
				$this->load->library('validate');
				
				$subject = $v->newsletter_subject;
				$tmpl = $v->newsletter_body;	
										
				foreach($emails as $a=>$b){
							
					$email = $b['account_email'];	
					$validateEmail = $this->validate->validateEmail($email);
					if ($validateEmail == 1) {
						echo $email . '<br />';
						continue;
					}
					
					$data = array(
						'subject_email' => $subject,
						'email' => $email
					);
					
					$this->sending_email($data, $tmpl, "text");	
						
				}
				
			}
			
		}
		
		// update newsletter expired
		$sql = "
		UPDATE newsletter SET
		status = 'Offline'
		WHERE 1
		AND newsletter_sending_schedule < DATE_FORMAT( NOW( ) ,  '%Y-%m-%d' ) 
		AND status =  'Online'
		";
		$this->db->query($sql);
		
	}
		
}

?>