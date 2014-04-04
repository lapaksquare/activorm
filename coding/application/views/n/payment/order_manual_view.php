<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Payment Order Manual</h2>	
	
	<hr />
	
	<?php 
	$pointtopup_error = $this->session->userdata('pointtopup_error');
	$this->session->unset_userdata('pointtopup_error');
	if ($pointtopup_error == 1){
	?>
	<div class="alert alert-danger">Something error when send your data.</div>
	<?php }else if ($pointtopup_error == 2){
		$msg_success = $this->session->userdata('pointtopup_success_msg');
		$this->session->unset_userdata('pointtopup_success_msg');
	?>
	<div class="alert alert-success"><?php echo $msg_success; ?></div>		
	<?php	
	} ?>
	
	<form id="content" class="form-horizontal" role="form" action="<?php echo base_url(); ?>admin/payment/submit_ordermanual">
		
		<div class="form-group">
	    	<label for="account_id" class="col-sm-3 control-label">Business Name</label>
	    	<div class="col-sm-5">
	    		<select class="form-control" name="account_id" id="account_id">
	    			<option value="0">Pilih Business</option>
	    			<?php foreach($business as $k=>$v){ ?>
	    			<option value="<?php echo $v->account_id; ?>"><?php echo ucwords($v->business_name); ?></option>
	    			<?php } ?>
	    		</select>	
			</div>
		</div>	
		
		<div class="form-group">
	    	<label for="point_id" class="col-sm-3 control-label">Point</label>
	    	<div class="col-sm-5">
	    		<select class="form-control" name="point_id" id="point_id">
	    			<?php 
	    			foreach($points as $k=>$v){
	    			?>
	    			<option value="<?php echo $v->point_id; ?>"><?php echo $v->point_name; ?></option>
	    			<?php	
	    			}
	    			?>
	    		</select>	
			</div>
		</div>	
		
		<?php 
		$qty = 1;
		$total_amount = 200000;
		$service_charge = 5 * $total_amount / 100;
		$goverment_tax = 10 * $total_amount / 100;
		$total_payment = $total_amount + $service_charge + $goverment_tax;
		?>
		
		<div class="form-group">
		    <label for="quantity" class="col-sm-3 control-label">Quantity</label>
		    <div class="col-sm-5">
		       <input type="text" id="point_qty" class="quantity form-control" name="quantity" value="<?php echo $qty; ?>" autocomplete="off" />
		    </div>
		</div>
		
		<div class="form-group">
		    <label class="col-sm-3 control-label">Total Amount:</label>
		    <div class="col-sm-5">
		       <?php /*
		       <p class="form-control-static" id="totalamount">IDR <?php echo number_format($total_amount, 2, ",", "."); ?></p>
			    * 
			    */ ?>
			    <input type="text" id="totalamount" class="totalamount form-control" name="totalamount" value="<?php echo $total_amount; ?>" autocomplete="off" />
		    </div>
		</div>
		
		<div class="form-group">
		    <label class="col-sm-3 control-label">Service Charge 5%:</label>
		    <div class="col-sm-5">
		       <p class="form-control-static" id="servicecharge">IDR <?php echo number_format($service_charge, 2, ",", "."); ?></p>
		    </div>
		</div>
		
		<div class="form-group">
		    <label class="col-sm-3 control-label">Government Tax 10%:</label>
		    <div class="col-sm-5">
		       <p class="form-control-static" id="governmenttax">IDR <?php echo number_format($goverment_tax, 2, ",", "."); ?></p>
		    </div>
		</div>
		
		<div class="form-group">
		    <label class="col-sm-3 control-label">Total Payment:</label>
		    <div class="col-sm-5">
		       <p class="form-control-static" id="totalpayment">IDR <?php echo number_format($total_payment, 2, ",", "."); ?></p>
		    </div>
		</div>
			
		<div class="form-group">
		    <div class="col-sm-offset-3 col-sm-5">
		    	
		        <input type="submit" class="btn btn-default" name="order" id="order" value="Order" />
		        
		    </div>
		 </div>	
				
	</form>	
	
</div>

<?php $this->load->view('n/general/footer_view', $this->data); ?>