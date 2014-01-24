<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	
	var $partner;
	var $data;
	
	function __construct(){
		parent::__construct();
		$this->load->model('api_model');
	}	
	
	/* CREATE PARTNER ================== START ====================*/
	function createPartner(){
		$partner_email = 'junaidyanton@hotmail.com';
		$data = array(
			'partner_name' => 'Anton Junaidi',
			'partner_email' => 'junaidyanton@hotmail.com',
			'partner_phone' => '082163504980',
			'partner_address' => 'Jalan Kebun Jeruk Raya No.9',
			'partner_code' => substr(sha1($partner_email . SALT), 0, 10),
			'isactive' => 1
		);
		$this->api_model->createPartner($data);
	}
	/* CREATE PARTNER ================== END ====================*/
	
	
	function getAnalyticProject(){
		$checkApi = $this->checkApi();
		if ($checkApi == 1){
			
			$this->segments = $this->uri->segment_array();
			//print_r($this->segments);
			
			if (empty($this->segments) || empty($this->segments[3])){
				$this->data['response'] = array(
					'status' => 400,
					'message' => 'Project uri tidak terindentifikasi.'
				);
			}else{
				$projecturi = $this->segments[3];
				$businesstoken = $this->input->get_post('businesstoken');
				$partnercode = $this->input->get_post('partnercode');
				$this->load->library('activorm_api_library');
				$results = $this->activorm_api_library->getAnalyticProject($projecturi, $businesstoken);
				if (!empty($results) && empty($results['status'])){
					$this->data['results'] = $results;
					$this->data['response'] = array(
						'status' => 200,
						'message' => 'OK'
					);
				}else{
					$this->data['response'] = $results;
				}
			}
		}
		$this->resultsApi();
	}
	
	
	
	/* BUSINESS TOKEN =============== START =================== */
	function createBusinessToken(){
		$vc = $this->input->get_post('vc');
		echo "VC : " . $vc  . " , H : " . substr( sha1($vc . SALT) , 0, 10);
	}
	/* BUSINESS TOKEN =============== END =================== */
	
	/* CONFIG API ================== START ====================*/
	function checkApi(){
		$partnercode = $this->input->get_post('partnercode');
		$this->partner = $this->api_model->getPartnerByPartnerCode($partnercode);
		if (empty($this->partner)){
			$this->data['response'] = array(
				'status' => 400,
				'message' => 'Partner Code tidak ditemukan'
			);
			return 0;
		}else if ($this->partner->isactive == 0){
			$this->data['response'] = array(
				'status' => 400,
				'message' => 'Partner Code belum Live. Silahkan hubungi contact kami di alamat email info@activorm.com'
			);
			return 0;
		}
		return 1;
	}
	
	function resultsApi(){
		$preview = $this->input->get_post('preview');
		$preview = (empty($preview)) ? 0 : $preview;
		$results = (empty($preview)) ? json_encode( $this->data ) : $this->data;
		echo ($preview == 1) ? '<pre>' : '';
		if ($preview == 0){
			echo $results;
		} else {
			print_r($results);
		}
		echo ($preview == 1) ? '</pre>' : '';
	}
	/* CONFIG API ================== END ====================*/
	
}

?>