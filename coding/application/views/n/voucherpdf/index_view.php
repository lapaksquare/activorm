<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Voucher Data</h2>	
	
	<hr />
	
	<a href="<?php echo base_url(); ?>admin/voucherpdf/add_voucherpdf" class="btn btn-default">Add VoucherPDF</a>
	
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
      <p>Save Successfull</p>
    </div>
    <?php } ?>
		
	<table class="table table-hover">
        <thead>
          <tr>
            <th>Voucher Price Name</th>
            <th>Business Name</th>
            <th>Project Name</th>
            <th>Valid Until</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        	<?php foreach($this->vouchers as $k=>$v){ ?>
        		<tr>
        			<td><?php echo ucwords($v->voucher_price_line1 . ' ' . $v->voucher_price_line2); ?></td>
        			<td><?php echo ucwords($v->business_name); ?></td>
        			<td><?php echo ucwords($v->project_name); ?></td>
        			<td><?php echo date("d M Y", strtotime($v->valid_until)); ?></td>
        			<td><a href="<?php echo base_url(); ?>admin/voucherpdf/details?vpid=<?php echo $v->voucher_id; ?>&h=<?php echo sha1($v->voucher_id . SALT); ?>" class="btn btn-primary">Details</a>
        				<a href="<?php echo base_url(); ?>admin/voucherpdf/details_see_pdf?vpid=<?php echo $v->voucher_id; ?>&h=<?php echo sha1($v->voucher_id . SALT); ?>" target="_blank" class="btn btn-primary">See</a>
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