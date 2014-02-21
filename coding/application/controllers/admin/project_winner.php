<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_winner extends MY_Admin_Access{
	
	function __construct(){
		parent::__construct();
		$this->data['menu'] = $menu = 'project_winner';
		
		$this->load->library('access');
		$this->access->checkAdminAccess($menu);
	}
	
	var $offset = 10;
	
	function index(){
		
		$this->project_live = $this->input->get_post('project_live');
		$this->project_live = (empty($this->project_live)) ? 'Online' : $this->project_live;
		
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$this->search_by = $this->input->get_post('search_by');
		$this->q = $this->input->get_post('q');
		
		$param_url = array(
			'business_id' => $this->access->business_id,
			'project_live' => $this->project_live,
			'search_by' => $this->search_by,
			'q' => $this->q,
			'page' => ''
		);
		
		$this->load->model('a_project_model');
		$this->data['projects'] = $this->a_project_model->getProjectActiveWinner($param_url, $this->offset, 0, $page);
		
		$param_url = http_build_query($param_url);
		
		$uri_page = 'admin/project_winner?'.$param_url;
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->a_project_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);
		
		$this->_default_param(
			"",
			array(
				'<script type="text/javascript" src="'.cdn_url().'js/a_project_winner.js"></script>'
			),
			"",
			"Project Winner - Activorm Connect");
		$this->load->view('n/project/project_winner_view', $this->data);
	}
	
	function details(){
		$project_id = $this->input->get_post('pid');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($project_id . SALT);
		if ($hash != $hash_ori) redirect(base_url() . 'admin/project_winner');
		
		$this->data['project_id'] = $project_id;
		
		$this->load->model('a_project_model');
		$this->load->model('socialmedia_model');
		
		$this->project = $this->a_project_model->getProjectDetail($project_id);
		
		$members = $this->a_project_model->getMemberProjectActiveWinner($project_id);
		$this->data['members'] = $members;
				
		$member_winner = $this->a_project_model->getMemberWinProjectActiveWinner($project_id);
		$this->data['member_winner'] = $member_winner;
		
		$jml_winner = $this->jml_winner = $this->project->jml_winner;
		$limit = (count($member_winner) == 0) ? $jml_winner : ($jml_winner - count($member_winner));		
				
		$winner = $this->a_project_model->getRandomMemberWinner($project_id, $this->project->account_id, $limit);
		$this->data['winner'] = $winner;
		
		$this->load->model('voucherpdf_model');
		$this->voucher_pdf_exists = $this->voucherpdf_model->getVoucherPDFDataByProjectId($project_id);
		
		$this->_default_param(
			"",
			array(
				'<script type="text/javascript" src="'.base_url().'js/a_project_winner_details.js"></script>'
			),
			"",
			"Project Winner Details - Activorm Connect");
		$this->load->view('n/project/project_winner_details_view', $this->data);
	}
	
	function confirmWinnerProjectTiket(){
		$project_id = $this->input->get_post('pid');
		$tiket_id = $this->input->get_post('tid');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($project_id . $tiket_id . SALT);
		if ($hash != $hash_ori) redirect(base_url().'admin/project_winner/details?pid=' . $project_id . '&h=' . sha1($project_id . SALT));
		
		/*
		$sql = "
		UPDATE project__tiket SET
		iswin = 0
		WHERE 1
		AND project_id = ?
		";
		$this->db->query($sql, array($project_id));
		*/
		
		
		$sql = "
		UPDATE project__tiket SET
		iswin = 1
		WHERE 1
		AND project_id = ?
		AND tiket_id = ?
		";
		$this->db->query($sql, array($project_id, $tiket_id));
		
				
		/*
		$sql = "
		UPDATE project__profile SET
		project_win = 1
		WHERE 1
		AND project_id = ? 
		";
		$this->db->query($sql, array($project_id));
		*/
		
		$this->load->model('a_project_model');
		$dataAccount = $this->a_project_model->getDataWinnerAccountByTiketId($tiket_id);
		$data = array(
			'subject_email' => "Congratulations! You Win a ". ucwords( $dataAccount->prize_name ) ." from " . ucwords( $dataAccount->business_name ),
			'email' => (ENVIRONMENT == "production") ? $dataAccount->account_email : 'winner@activorm.com',
			'account_name' => $dataAccount->account_name,
			'prize_name' => $dataAccount->prize_name,
			'business_name' => $dataAccount->business_name
		);
		$tmpl = "winner_email_view";
		$this->sending_email($data, $tmpl);	
		
		redirect(base_url().'admin/project_winner/details?pid=' . $project_id . '&h=' . sha1($project_id . SALT));
	}
	
	
	
	function sending_email($data, $tmpl){
		// sending email
		require_once APPPATH.'libraries/swiftmailer/swift_required.php';
		$transport = Swift_MailTransport::newInstance();
		//Create the message
        $message = Swift_Message::newInstance();
		//Give the message a subject
		
		$email = $data['email']; //array('karen.qer.kamal@gmail.com', 'lapaksquare@gmail.com', 'info@activorm.com'); //$data['email'];
		$subject = $data['subject_email'];
								
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
	
	function submit_voucher(){
		$voucher_submit = $this->input->get_post('voucher_submit');
		$project_id = $this->input->get_post('project_id');
		$tiket_id = $this->input->get_post('tiket_id');
		$hash = sha1($project_id . SALT);
			
		if (!empty($voucher_submit)){
			
			$config['upload_path'] = './images/voucher/';
			$config['allowed_types'] = 'jpg|jpeg|png|pdf';
			$config['max_size']	= '2024';
			$config['encrypt_name'] = true;
			
			$this->load->library('upload', $config);
			
			$uploaded = $this->upload->do_upload('voucher_data');
			$voucher_data = "";
			if ($uploaded){
				//$error = $this->upload->display_errors();
				$data = $this->upload->data();
				//print_r($data);
				//print_r($error);
				
				$voucher_data = 'images/voucher/' . $data['file_name'];
				
				$dataUser['account_primary_photo'] = $voucher_data;
				
				//$this->session->set_userdata('account_primary_photo', $account_primary_photo);
			}else{
				
				if (!empty($_FILES['voucher_data']['name'])){
					$errors[] = 'You have to upload a Profile Picture in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
					//echo '1';
				}
				//$errors[] = 'You have to upload a Project Image in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
				//echo '2';die();
			}

			if (!empty($voucher_data)){
				$sql = "
				UPDATE project__tiket SET
				voucher_data = ?,
				voucher_data_int = ''
				WHERE 1
				AND tiket_id = ?
				AND project_id = ?
				";
				$this->db->query($sql, array($voucher_data, $tiket_id, $project_id));
			}
			
		}
		
		redirect(base_url() . 'admin/project_winner/details?pid=' . $project_id . '&h=' . $hash);
	}

	function generate_voucher(){
		$project_id = $this->input->get_post('project_id');
		$tiket_id = $this->input->get_post('tiket_id');
		$voucher_id = $this->input->get_post('voucher_id');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($project_id . $tiket_id . $voucher_id . SALT);
		
		$hash_project = sha1($project_id . SALT);
		
		if ($hash == $hash_ori){
		
			$sql = "
			UPDATE project__tiket SET
			voucher_data = '',
			voucher_data_int = ?
			WHERE 1
			AND tiket_id = ?
			AND project_id = ?
			";
			$this->db->query($sql, array($voucher_id, $tiket_id, $project_id));
		
		}
		
		redirect(base_url() . 'admin/project_winner/details?pid=' . $project_id . '&h=' . $hash_project);
	}
	
	function export_excel(){
		$project_id = $this->input->get_post('pid');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($project_id . SALT);
		if ($hash != $hash_ori) redirect(base_url() . 'admin/project_winner');
		
		$this->data['project_id'] = $project_id;
	
		$this->load->model('a_project_model');		

		$this->project = $this->a_project_model->getProjectDetail($project_id);
		$this->data['project'] = $this->project;
		
		$member_winner = $this->a_project_model->getMemberWinProjectActiveWinner($project_id);
		$this->data['member_winner'] = $member_winner;
		
		//echo '<pre>';
		//print_r($member_winner);
		//echo '</pre>';
		
		$this->data['title'] = sha1(time().SALT);
		$this->data['content'] = 'reporting_winner_excel_view';
		
		$this->load->view('n/excel/template_excel_view', $this->data);
	}
	
	function submit_voucher_coll(){
		$config['upload_path'] = './images/voucher/';
		$config['allowed_types'] = 'jpg|jpeg|png|pdf';
		$config['max_size']	= '2024';
		$config['encrypt_name'] = true;
		
		$this->load->library('upload', $config);
		
		$voucher_submit = $this->input->get_post('voucher_submit');
		$uploaded = $this->upload->do_upload('voucher_data');
		$project_id = $this->input->get_post('project_id');
		$voucher_id = $this->input->get_post('voucher_id');
		$members = $this->input->get_post('members');
		
		/*
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		
		echo '<pre>';
		print_r($_FILES);
		echo '</pre>';
		die();
		*/
		
		if (!empty($members)){
			$this->load->model('a_project_model');
			foreach($members as $k=>$v){
				$sql = "
				UPDATE project__tiket SET
				iswin = 1
				WHERE 1
				AND project_id = ?
				AND tiket_id = ?
				";
				$this->db->query($sql, array($project_id, $v));
				$dataAccount = $this->a_project_model->getDataWinnerAccountByTiketId($v);
				$data = array(
					'subject_email' => "Congratulations! You Win a ". ucwords( $dataAccount->prize_name ) ." from " . ucwords( $dataAccount->business_name ),
					'email' => (ENVIRONMENT == "production") ? $dataAccount->account_email : 'winner@activorm.com',
					'account_name' => $dataAccount->account_name,
					'prize_name' => $dataAccount->prize_name,
					'business_name' => $dataAccount->business_name
				);
				$tmpl = "winner_email_view";
				$this->sending_email($data, $tmpl);	
			}
		
		
			if (!empty($_FILES['voucher_data']['name'])){
				
				// upload voucher
				
				foreach($members as $k=>$v){
					
					$voucher_data = "";
					if ($uploaded){
						//$error = $this->upload->display_errors();
						$data = $this->upload->data();
						//print_r($data);
						//print_r($error);
						
						$voucher_data = 'images/voucher/' . $data['file_name'];
						
						$dataUser['account_primary_photo'] = $voucher_data;
						
						//$this->session->set_userdata('account_primary_photo', $account_primary_photo);
					}else{
						
						if (!empty($_FILES['voucher_data']['name'])){
							$errors[] = 'You have to upload a Profile Picture in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
							//echo '1';
						}
						//$errors[] = 'You have to upload a Project Image in jpg/jpeg, gif, or png smaller than 2 MB, dimension are limited to 200x200 pixels image';
						//echo '2';die();
						
						$this->session->set_userdata('msg_error', 'Terjadi kesalahan dalam pengupload-an.');
					}
		
					if (!empty($voucher_data)){
						$sql = "
						UPDATE project__tiket SET
						voucher_data = ?,
						voucher_data_int = ''
						WHERE 1
						AND tiket_id = ?
						AND project_id = ?
						";
						$this->db->query($sql, array($voucher_data, $v, $project_id));
						$this->session->set_userdata('msg_success', 'Upload Voucher berhasil dan terkirim ke member terpilih');
					}
					
					
				}
				
			}else{
				
				// generate voucher
				foreach($members as $k=>$v){
					$sql = "
					UPDATE project__tiket SET
					voucher_data = '',
					voucher_data_int = ?
					WHERE 1
					AND tiket_id = ?
					AND project_id = ?
					";
					$this->db->query($sql, array($voucher_id, $v, $project_id));
				}
				
				$this->session->set_userdata('msg_success', 'Generate Voucher berhasil dan terkirim ke member terpilih');	
			
				
			}
			
		}else{
					
			$this->session->set_userdata('msg_error', 'Member belum dipilih oleh Anda. Silahkan pilih member yang akan dijadikan pemenang. :(');	
			
		}
		
		redirect(base_url() . 'admin/project_winner/details?pid=' . $project_id . '&h=' . sha1($project_id . SALT));
		
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