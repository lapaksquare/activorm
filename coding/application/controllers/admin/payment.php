<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends MY_Admin_Access{
	
	function __construct(){
		parent::__construct();
	}
	
	var $offset = 10;
	
	function index(){
		
		$this->load->library('pagination_tmpl');
		$page = intval($this->input->get_post('page'));
		
		$this->order_status = $this->input->get_post('order_status');
		$this->search_by = $this->input->get_post('search_by');
		$this->q = $this->input->get_post('q');
		$param_url = array(
			'order_status' => $this->order_status,
			'search_by' => $this->search_by,
			'q' => $this->q,
			'page' => ''
		);
		
		$this->load->model('a_payment_model');
		$this->data['results'] = $this->a_payment_model->getOrderAll($param_url, $this->offset, 0, $page);
		
		$param_url = http_build_query($param_url);
		
		$uri_page = 'admin/payment/?'.$param_url;
		$this->data['page'] = (!empty($page)) ? $page : $page+1;
		$this->data['total_data'] = $total_data = $this->a_payment_model->countGetdata();
		$this->data['pagination'] = $this->pagination_tmpl->getPaginationString(
			$page, 
			$total_data, 
			$this->offset, 
			1, 
			base_url(), 
			$uri_page
		);
		
		$this->data['result_order'] = $this->a_payment_model->getTotalOrderCart();
		
		$this->data['menu'] = 'payment';
		$this->data['menu_child'] = 'payment_'.strtolower($this->order_status);
		$this->_default_param(
			"",
			"",
			"",
			"Payment - Activorm Connect");
		$this->load->view('n/payment/index_view', $this->data);
	}

	function resend_email(){
		$order_barcode = $this->input->get_post('o');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($order_barcode . SALT);
		if ($hash != $hash_ori) redirect(base_url().'admin/payment');
		
		$this->load->model('order_model');
		$order_cart = $this->order_model->getDataOrderCart($order_barcode);
		$order_id = $order_cart->order_id;
		$order_cart_detail = $this->order_model->getDataOrderCartDetail($order_id);
		
		$title_email = ($order_cart->order_status == "completed") ? 'Receipt' : 'Invoice';
		
		// sending email
		$dataEmail = array(
			'account_email' => $order_cart->account_email,
			'email_subject' => strtoupper($title_email) . ' #' . $order_cart->order_barcode,
			'email_tmpl' => 'invoice_view',
			'order_cart' => $order_cart,
			'order_cart_detail' => $order_cart_detail
		);
		$this->sending_email($dataEmail);
		
		$this->session->set_userdata('a_message_success', 1);
		
		redirect(base_url() . 'admin/payment');
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
	
	function details(){
		$order_barcode = $this->input->get_post('o');
		$hash = $this->input->get_post('h');
		$hash_ori = sha1($order_barcode . SALT);
		if ($hash != $hash_ori) redirect(base_url().'admin/payment');
		
		$this->load->model('order_model');
		$this->data['order_cart'] = $order_cart = $this->order_model->getDataOrderCart($order_barcode);
		$order_id = $order_cart->order_id;
		$this->data['order_cart_detail'] = $this->order_model->getDataOrderCartDetail($order_id);
		
		$this->data['menu'] = 'payment';
		$this->_default_param(
			array(
				'<link rel="stylesheet" type="text/css" href="'.cdn_url().'css/bootstrap.datepicker.css" />'
			),
			array(
				'<script src="'.cdn_url().'js/bootstrap.datepicker.js"></script>',
				'<script src="'.cdn_url().'js/a_payment_detail.js"></script>',
			),
			"",
			"Payment Details - Activorm Connect");
		$this->load->view('n/payment/payment_detail_view', $this->data);
	}
	
	function update_order_payment(){
		$update_order_payment = $this->input->get_post('update_order_payment');
		$type = $this->input->get_post('type');
		$order_id = $this->input->get_post('order_id');
		$order_status = $this->input->get_post('order_status');
		if (!empty($update_order_payment)){
			
			$this->load->model('order_model');
			
			if ($type == "payment_completed"){
				
				// ganti order status ============ start ===============
				$data = array(
					'order_status' => $order_status
				);
				$where = array(
					'order_id' => $order_id
				);
				$this->order_model->updateOrderCart($data, $where);
				
				$order_cart = $this->order_model->getDataOrderCart($order_id, "oc.order_id");
				$order_cart_detail = $this->order_model->getDataOrderCartDetail($order_id);
				// ganti order status ============ end ===============
				
				// sending email ============ start ===============
				$title_email = ($order_cart->order_status == "completed") ? 'Receipt' : 'Invoice';
				$dataEmail = array(
					'account_email' => $order_cart->account_email,
					'email_subject' => strtoupper($title_email) . ' #' . $order_cart->order_barcode,
					'email_tmpl' => 'invoice_view',
					'order_cart' => $order_cart,
					'order_cart_detail' => $order_cart_detail
				);
				$this->sending_email($dataEmail);
				// sending email ============ end ===============
				
				// total point ============ start ===============
				$this->upgradeTotalPoint($order_cart, $order_cart_detail);
				// total point ============ end ===============
				
				$this->session->set_userdata('a_message_payment', 2);
				
			}else if ($type == "payment_confirmation"){
				
				$order_cart = $this->order_model->getDataOrderCart($order_id, "oc.order_id");
				
				$payment_date = $this->input->get_post('payment_date');	
				$transaction_amount = (int) $this->input->get_post('transaction_amount');
				$transaction_bank = $this->input->get_post('transaction_bank');
				$sender_bank = $this->input->get_post('sender_bank');
				$sender_name = $this->input->get_post('sender_name');
				$sender_account = $this->input->get_post('sender_account');
				
				if ($transaction_amount < $order_cart->order_total_price){
					$this->session->set_userdata('a_message_payment', 1);
				}else{
				
					// update payment ======== start ==========
					$data = array(
						'order_id' => $order_cart->order_id,
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
						'order_status' => $order_status
					);
					$where = array(
						'order_id' => $order_cart->order_id,
					);
					$this->order_model->updateOrderCart($data, $where);
					// update payment ======== end ==========
					
					$order_cart = $this->order_model->getDataOrderCart($order_id, "oc.order_id");
					$order_cart_detail = $this->order_model->getDataOrderCartDetail($order_cart->order_id);
					
					// sending email ============ start ===============
					$dataEmail = array(
						'account_email' => $order_cart->account_email,
						'email_subject' => 'INVOICE #' . $order_cart->order_barcode,
						'email_tmpl' => 'invoice_view',
						'order_cart' => $order_cart,
						'order_cart_detail' => $order_cart_detail
					);
					$this->sending_email($dataEmail);
					// sending email ============ end ===============
					
					// total point ============ start ===============
					$this->upgradeTotalPoint($order_cart, $order_cart_detail);
					// total point ============ end ===============
					
					$this->session->set_userdata('a_message_payment', 2);
						
				}
				
			}
		}

		$order_barcode = $this->input->get_post('order_barcode');
		$order_hash = $this->input->get_post('order_hash');
		
		redirect(base_url() . 'admin/payment/details?o='.$order_barcode.'&h='.$order_hash);

	}

	function upgradeTotalPoint($order_cart, $order_cart_detail){
		$this->load->model('order_model');
		$total_point = 0;
		foreach($order_cart_detail as $k=>$v){
			$total_point += $v->point * $v->order_qty;
		}
		if ($total_point > 0){
			$this->load->model('point_model');
			$currentPoint = $this->point_model->getAccountPoint($order_cart->account_id);
			$newPoint = $currentPoint + $total_point; 
			$data = array(
				'point' => $newPoint
			);
			$this->point_model->updateMemberPoint($data, $order_cart->account_id);
		}
	}
	
	function ordermanual(){
		$this->load->model('a_featured_model');
		$this->data['business'] = $this->a_featured_model->getBusinessAll();
		
		$this->load->model('point_model');
		$this->data['points'] = $this->point_model->getPointProfileActive();
		
		$this->data['menu'] = 'payment';
		$this->data['menu_child'] = 'payment_order_manual';
		$this->_default_param(
			"",
			array(
				'<script type="text/javascript" src="'.cdn_url().'js/a_topuppoint.js"></script>'
			),
			"",
			"Payment Order Manual - Activorm Connect");
		$this->load->view('n/payment/order_manual_view', $this->data);
	}
	
	function submit_ordermanual(){
		$this->load->model('point_model');
		$this->load->model('order_model');
		
		$order = $this->input->get_post('order');
		if (!empty($order)){
			$account_id = $this->input->get_post('account_id');
			$point_id = $this->input->get_post('point_id');
			$quantity = $this->input->get_post('quantity');
			
			$this->load->model('a_account_model');
			$accounts = $this->a_account_model->getMemberByAccountId($account_id);
			
			$errors = array();
			$order_cart = array();
			$order_cart_detail = array();
			$order_total_price = 0;
			
			if ($quantity > 0){
				$point = $this->point_model->getPointByPointId($point_id);
				$total_price = $quantity * $point->point_price;
				$order_total_price += $total_price;
				$point_expired = $point->point_period * 31;
				$order_cart_detail[$point_id] = array(
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
			
			if (empty($order_cart_detail)){
				$errors[] = 'Something error when send your data.';
			}
			if ($account_id <= 0){
				$errors[] = 'Anda harus memilih salah satu Business Account yang tersedia.';
			}
			
			$order_barcode = "";
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
					'account_id' => $account_id,
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
					'account_email' => $accounts->account_email,
					'email_subject' => 'INVOICE #' . $order_barcode,
					'email_tmpl' => 'invoice_view',
					'order_cart' => $order_cart,
					'order_cart_detail' => $order_cart_detail
				);
				$this->sending_email($dataEmail);
				
				$this->session->set_userdata('pointtopup_error', 2);
				$this->session->set_userdata('pointtopup_success_msg', 'Orderan nya berhasil diproses. Silahkan <a href="'.base_url().'admin/payment/details?o='.$order_barcode.'&h='.sha1($order_barcode . SALT).'" target="_blank">Klik ini</a> untuk melihat detailnya.');
			}
			
		}
		redirect(base_url() . 'admin/payment/ordermanual');
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