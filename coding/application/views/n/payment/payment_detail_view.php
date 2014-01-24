<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Payment Detail #<?php echo strtoupper($order_cart->order_barcode); ?></h2>	
	
	<hr />
	
	<?php 
	$a_message_payment = $this->session->userdata('a_message_payment');
	if (!empty($a_message_payment)){
		$this->session->unset_userdata('a_message_payment');
		
		if ($a_message_payment == 2){
	?>
	<div class="bs-callout bs-callout-info">
      <p>Action Successfull</p>
    </div>
    <?php }
		
		if ($a_message_payment == 1){
	?>
	<div class="bs-callout bs-callout-danger">
      <p>Action Failed</p>
    </div>
	<?php		
		} 
	}
    ?>
	
	<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>admin/payment/update order_status">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Tanggal</label>
	    <div class="col-sm-10">
	      <p class="form-control-static"><?php echo date('d M Y, H:i', strtotime($order_cart->order_datetime)); ?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Business</label>
	    <div class="col-sm-10">
	      <p class="form-control-static"><?php echo ucwords($order_cart->account_name); ?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Billing Address</label>
	    <div class="col-sm-10">
	      <p class="form-control-static"><?php echo ucfirst($order_cart->account_address); ?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Order Status</label>
	    <div class="col-sm-10">
	      <p class="form-control-static"><?php echo strtoupper($order_cart->order_status); ?></p>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Orderan:</label>
	    <div class="col-sm-10">
	      
	      <table class="table">
	      	<thead>
				<tr>
					<th width="35%">Item</th>
					<th width="35%">Quantity</th>
					<th width="65%">Total</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$total_amount = 0;
				foreach($order_cart_detail as $k=>$v){ 
					$total_amount += $v->order_total_price;
				?>
				<tr>
					<td><?php echo $v->order_name; ?></td>
					<td><?php echo $v->order_qty; ?></td>
					<td>IDR <?php echo number_format($v->order_total_price, 2, ",", "."); ?></td>
				</tr>
				<?php } ?>
				<tr>
					<td colspan="2" style="text-align: right;font-weight:bold;">Total Amount:</td>
					<td>IDR <?php echo number_format($total_amount, 2, ",", "."); ?></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: right;font-weight:bold;">Service Charge 5%:</td>
					<td>IDR <?php echo number_format($order_cart->service_charge, 2, ",", "."); ?></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: right;font-weight:bold;">Government Tax 10%:</td>
					<td>IDR <?php echo number_format($order_cart->gov_charge, 2, ",", "."); ?></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: right;font-weight:bold;">Total Payment:</td>
					<td>IDR <?php echo number_format($order_cart->order_total_price, 2, ",", "."); ?></td>
				</tr>
			</tbody>
	      </table>
	      
	    </div>
	  </div>
    </form>
	
	<h3>Order Payment</h3>
	
	<form class="form-horizontal" role="form" action="<?php echo base_url(); ?>admin/payment/update_order_payment">
		
		<?php if (empty($order_cart->payment_date)){ ?>
		
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Tanggal</label>
		    <div class="col-sm-10">
		       <input type="text" id="payment_date" class="payment_date form-control" name="payment_date" />
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Amount</label>
		    <div class="col-sm-10">
		       <input type="text" name="transaction_amount" id="transaction_amount" class="form-control" />
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Payment to Bank</label>
		    <div class="col-sm-10">
		       <input type="text" name="transaction_bank" id="transaction_bank" class="form-control" />
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">From Bank</label>
		    <div class="col-sm-10">
		       <input type="text" name="sender_bank" id="sender_bank" class="form-control" />
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Account Holder Name</label>
		    <div class="col-sm-10">
		       <input type="text" name="sender_name" id="sender_name" class="form-control" />
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Account Number</label>
		    <div class="col-sm-10">
		       <input type="text" name="sender_account" id="sender_account" class="form-control" />
		    </div>
		  </div>
		  
		  <div class="form-group">
	    	<div class="col-sm-offset-2 col-sm-10">
	    		<input type="hidden" name="order_id" value="<?php echo $order_cart->order_id; ?>" />
	    		<input type="hidden" name="order_status" value="completed" />
	    		<input type="hidden" name="type" value="payment_confirmation" />
		  		<input type="submit" name="update_order_payment" class="btn btn-default" value="Submit" />
		  	</div>
		  </div>
		 
		 <?php }else{ ?> 
		 
		 <div class="form-group">
		    <label class="col-sm-2 control-label">Tanggal</label>
		    <div class="col-sm-10">
		       <p class="form-control-static"><?php echo date('d M Y, H:i', strtotime($order_cart->payment_datetime)); ?></p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Amount</label>
		    <div class="col-sm-10">
		       <p class="form-control-static">IDR <?php echo number_format($order_cart->payment_amount, 2, ",", "."); ?></p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Payment to Bank</label>
		    <div class="col-sm-10">
		       <p class="form-control-static"><?php echo ucwords($order_cart->payment_bank); ?></p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">From Bank</label>
		    <div class="col-sm-10">
		       <p class="form-control-static"><?php echo ucwords($order_cart->from_bank); ?></p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Account Holder Name</label>
		    <div class="col-sm-10">
		       <p class="form-control-static"><?php echo ucwords($order_cart->account_holder_name); ?></p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-2 control-label">Account Number</label>
		    <div class="col-sm-10">
		       <p class="form-control-static"><?php echo ucwords($order_cart->account_number); ?></p>
		    </div>
		  </div>
		  
		  
		  <?php if ($order_cart->order_status != "completed"){ ?>
		  <div class="form-group">
	    	<div class="col-sm-offset-2 col-sm-10">
	    		<input type="hidden" name="order_id" value="<?php echo $order_cart->order_id; ?>" />
	    		<input type="hidden" name="order_status" value="completed" />
	    		<input type="hidden" name="type" value="payment_completed" />
		  		<input type="submit" name="update_order_payment" class="btn btn-default" value="Confirmed" />
		  	</div>
		  </div>
		  <?php } ?>
		 
		 <?php } ?>
		 
		 <input type="hidden" name="order_barcode" value="<?php echo $order_cart->order_barcode; ?>" />
		 <input type="hidden" name="order_hash" value="<?php echo sha1($order_cart->order_barcode . SALT); ?>" /> 
		  
	</form>	
	
</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>	