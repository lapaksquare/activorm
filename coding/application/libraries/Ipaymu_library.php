<?php 

class Ipaymu_library {
	
	var $CI = "";
	function __construct(){
		$this->CI =& get_instance();
	}
	
	function send_payment($order_id, $total_price, $quantity, $attr,
	$ureturn = '', $unotify = '', $ucancel = ''){
		$url = 'https://my.ipaymu.com/payment.htm';
		$params = array(
			'key'      => API_KEY_IPAYMU, // API Key Merchant / Penjual
            'action'   => 'payment',
            'product'  => $order_id,
            'price'    => $total_price, // Total Harga
            'quantity' => $quantity,
            'comments' => $attr, // Optional
            'ureturn'  => $ureturn,
            'unotify'  => $unotify,
            'ucancel'  => $ucancel,
 
 			'invoice_number' => $order_id,
 			'paypal_email' => PAYPAL_EMAIL,
 			'paypal_price' => (double) $total_price / 10000,
 
            'format'   => 'json' // Format: xml / json. Default: xml
		);
		$params_string = http_build_query($params);
		//open connection
		$ch = curl_init();
		 
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($params));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		 
		//execute post
		$request = curl_exec($ch);
		
		$this->CI->load->model('ipaymu_model');
		
		if ( $request === false ) {
		    //echo 'Curl Error: ' . curl_error($ch);
		    $this->CI->ipaymu_model->insertLog(array(
				'log_name' => 'send_payment',
				'log_param' => json_encode($params),
				'log_results' => curl_error($ch)
			));
		} else {
		 
		    $result = json_decode($request, true);
			
			$this->CI->ipaymu_model->insertLog(array(
				'log_name' => 'send_payment',
				'log_param' => json_encode($params),
				'log_results' => json_encode($result)
			));
		 
		    if( isset($result['url']) ){
		        //header('location: '. $result['url']);
		        return $result['url'];
		    } else {
		        //echo "Request Error ". $result['Status'] .": ". $result['Keterangan'];
		    }
		}
		 
		//close connection
		curl_close($ch);
		
		return false;
	}
	
}

?>