<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Payment</h2>	
	
	<hr />
	
	<?php 
	$a_message_error = $this->session->userdata('a_message_error');
	if (!empty($a_message_error)){
		$this->session->unset_userdata('a_message_error');
		$m = '<li>'.implode('</li><li>', $a_message_error) . '</li>';
	?>
	<div class="bs-callout bs-callout-danger">
      <p>
      	<ul>
      		<?php echo $m; ?>
      	</ul>
      </p>
    </div>
    <?php } ?>
    
    <?php 
	$a_message_success = $this->session->userdata('a_message_success');
	if (!empty($a_message_success)){
		$this->session->unset_userdata('a_message_success');
	?>
	<div class="bs-callout bs-callout-info">
      <p>Action Successfull</p>
    </div>
    <?php } ?>
    
	<form class="form-inline" role="form" method="get">
	  <div class="form-group">
	    <label class="sr-only" for="order_status">Order Status</label>
	    <select class="form-control" name="order_status" id="order_status">
	    	<?php 
	    	$sb = array(
				"all" => "All",
				"checkout" => "Checkout",
				"onprogress" => "OnProgress"
			);
			foreach($sb as $k=>$v){
				$class = ($k == $this->order_status) ? "selected" : "";
			?>
			<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
			<?php
			}
	    	?>
	    </select>
	  </div>
	  <div class="form-group">
	    <label class="sr-only" for="search_by">Search By</label>
	    <select class="form-control" name="search_by" id="search_by">
	    	<?php 
	    	$sb = array(
				"oc.order_barcode" => "Transaction/Invoice No"
			);
			foreach($sb as $k=>$v){
				$class = ($k == $this->search_by) ? "selected" : "";
			?>
			<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
			<?php
			}
	    	?>
	    </select>
	  </div>
	  <div class="form-group">
	    <input type="text" class="form-control" id="q" name="q" placeholder="Keyword" value="<?php echo $this->q; ?>">
	  </div>
	  <button type="submit" class="btn btn-default">Search</button>
	</form>
	
	<hr />
	
	<table class="table">
		<tr>
			<td><b>Total Omzet:</b> IDR <?php echo number_format($result_order->total_omzet, 2, ",", "."); ?></td>
		</tr>
	</table>
	
	<table class="table table-hover">
        <thead>
          <tr>
            <th>Order Date</th>
            <th>Transaction No.</th>
            <th>Business Name</th>
            <th>Point</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        	<?php foreach($results as $k=>$v){ ?>
        	<tr>
        		<td><?php echo date('d M Y, H:i', strtotime($v->order_datetime)); ?></td>
        		<td><a href="<?php echo base_url(); ?>admin/payment/details?o=<?php echo $v->order_barcode; ?>&h=<?php echo sha1($v->order_barcode.SALT); ?>"><code><?php echo strtoupper($v->order_barcode); ?></code></a></td>
        		<td><?php echo ucwords($v->account_name); ?></td>
        		<td><?php echo $v->point; ?></td>
        		<td><?php echo strtoupper($v->order_status); ?></td>
        		<td>
        			<?php if ($v->order_status == "checkout"){
        			?>
        			<a href="<?php echo base_url(); ?>admin/payment/resend_email?o=<?php echo $v->order_barcode; ?>&h=<?php echo sha1($v->order_barcode.SALT); ?>" class="btn btn-default">Resend Email</a>
        			<?php	
        			} ?>
        		</td>
        	</tr>
        	<?php } ?>
        </tbody>
    </table>
    
	<?php 
		if (!empty($pagination)) echo $pagination;
	?>
	
</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>	