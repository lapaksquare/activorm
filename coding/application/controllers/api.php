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
		$output = $this->input->get_post('output');
		$preview = $this->input->get_post('preview');
		$preview = (empty($preview)) ? 0 : $preview;
		//$results = (empty($preview)) ? json_encode( $this->data ) : $this->data;
		$results = $this->data;
		if (empty($preview)){
			$output = (empty($output)) ? 'json' : $output;
			switch($output){
				case "json" :
					$results = json_encode( $this->data );
					break;
				case "xml" :
					$xml = $this->array_to_xml($this->data, new SimpleXMLElement('<root/>'))->asXML();
			        //$results = $xml;
			        
			        $dom = new DOMDocument;
			        $dom->preserveWhiteSpace = FALSE;
			        $dom->loadXML($xml);
			        $dom->formatOutput = TRUE;
			        $results = $dom->saveXml();
			        
					break;
				default :
					$results = json_encode( $this->data );
					break;
			}
		}
		echo ($preview == 1) ? '<pre>' : '';
		if ($preview == 0){
			echo $results;
		} else {
			print_r($results);
		}
		echo ($preview == 1) ? '</pre>' : '';
	}
	function array_to_xml(array $arr, SimpleXMLElement $xml) {
        foreach ($arr as $k => $v) {

            $attrArr = array();
            $kArray = explode(' ',$k);
            $tag = array_shift($kArray);

            if (count($kArray) > 0) {
                foreach($kArray as $attrValue) {
                    $attrArr[] = explode('=',$attrValue);                   
                }
            }

            if (is_array($v)) {
                if (is_numeric($k)) {
                    $this->array_to_xml($v, $xml);
                } else {
                    $child = $xml->addChild($tag);
                    if (isset($attrArr)) {
                        foreach($attrArr as $attrArrV) {
                            $child->addAttribute($attrArrV[0],$attrArrV[1]);
                        }
                    }                   
                    $this->array_to_xml($v, $child);
                }
            } else {
                $child = $xml->addChild($tag, $v);
                if (isset($attrArr)) {
                    foreach($attrArr as $attrArrV) {
                        $child->addAttribute($attrArrV[0],$attrArrV[1]);
                    }
                }
            }               
        }

        return $xml;
    }
	
	/* CONFIG API ================== END ====================*/
	
}

?>