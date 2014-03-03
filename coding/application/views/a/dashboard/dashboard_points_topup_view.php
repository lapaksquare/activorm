<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Business</h1>
				<span class="page-subtitle">You must fill the form cause it's very important.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<form action="<?php echo base_url(); ?>dashboard/submit_pointtopup" method="post">
						<div class="box">
							<h2 class="box-title">Your Point Balance Now <span class="green"><?php echo $points_user; ?> Points</span></h2>
						<!-- .box --></div>

						<?php 
						$pointtopup_error = $this->session->userdata('pointtopup_error');
						$this->session->unset_userdata('pointtopup_error');
						if ($pointtopup_error == 1){
						?>
						<div class="alert alert-danger">Something error when send your data.</div>
						<?php } ?>
						
						<?php 
						$note_topup_amount_error = $this->session->userdata('note_topup_amount_error');
						$this->session->unset_userdata('note_topup_amount_error');
						if (!empty($note_topup_amount_error)){
						?>
						<div class="alert alert-danger"><?php echo $note_topup_amount_error; ?></div>
						<?php } ?>

						<div class="box">
							<div class="box-header">
								<h2 class="box-title title-light">Pick one of the amount below</h2>
							</div>

							<div class="table-responsive">
								<table class="table table-activorm" id="table_point">
									<thead>
										<tr>
											<th width="5%"></th>
											<th width="20%">Points</th>
											<th class="table-darker" width="25%">Price</th>
											<th width="25%">Period</th>
										</tr>
									</thead>
									<tbody>
										
										<?php 
										foreach($points as $k=>$v){
										?>
										
										<tr>
											<td class="table-darker">
												<div>
													<input type="hidden" name="pid[<?php echo $v->point_id; ?>]" id="pid" value="<?php echo $v->point_id; ?>" />
													<input type="hidden" name="pid_hash[<?php echo $v->point_id; ?>]" id="pid_hash" value="<?php echo sha1($v->point_id . SALT); ?>" />
													
													<?php /*	
													<input type="text" name="quantity[<?php echo $v->point_id; ?>]" placeholder="" id="point_qty" class="form-control input-sm input-nr">
													*/ ?>
													
													<input type="radio" value="<?php echo $v->point_id; ?>" name="choice_pid" placeholder="" id="choice_pid" class="input-sm input-nr" 
													 <?php echo ($k==0) ? 'checked="checked"' : ''; ?>
													 />
												
												</div>
											</td>
											<td><?php echo $v->point_name; ?></td>
											<td	class="table-darker">IDR <?php echo number_format($v->point_price, 2, ",", "."); ?></td>
											<td><?php echo $v->point_period; ?> Month</td>
										</tr>
										
										<?php 
										}
										?>
										
									</tbody>
								</table>
							</div>

							
							<?php 
							$qty = 1;
							$total_amount = 200000;
							$service_charge = 5 * 200000 / 100;
							$goverment_tax = 10 * 200000 / 100;
							$total_payment = $total_amount + $service_charge + $goverment_tax;
							?>

							<br />
							<ul class="list-unstyled list-details">
								<li class="row">
									<div class="col-xs-5">
										Quantity:
									</div>
									<div class="col-xs-7">
										<span class="pull-right">
											<input type="text" name="quantity" placeholder="" value="1" id="point_qty" class="form-control input-sm input-nr" autocomplete="off" style="text-align:right;"  />
										</span>
									</div>
								</li>
								<li class="row">
									<div class="col-xs-5">
										Total Amount:
									</div>
									<div class="col-xs-7">
										<span class="pull-right" id="totalamount" data-totalamount="0">IDR <?php echo number_format($total_amount, 2, ",", "."); ?></span>
									</div>
								</li>
								<li class="row">
									<div class="col-xs-5">
										Service Charge 5%:
									</div>
									<div class="col-xs-7">
										<span class="pull-right" id="servicecharge" data-servicecharge="0">IDR <?php echo number_format($service_charge, 2, ",", "."); ?></span>
									</div>
								</li>
								<li class="row">
									<div class="col-xs-5">
										Government Tax 10%:
									</div>
									<div class="col-xs-7">
										<span class="pull-right" id="governmenttax" data-governmenttax="0">IDR <?php echo number_format($goverment_tax, 2, ",", "."); ?></span>
									</div>
								</li>
								<li class="row list-total">
									<div class="col-xs-5">
										<strong>Total Payment:</strong>
									</div>
									<div class="col-xs-7">
										<span class="pull-right"><strong class="green" id="totalpayment" data-totalpayment="0">IDR <?php echo number_format($total_payment, 2, ",", "."); ?></strong></span>
									</div>
								</li>
							<!-- .transaction-details --></ul>
							
							<a data-toggle="modal" class="btn btn-block btn-blue more-topup" href="#modal-topup" id="btn-modal-topup">Need more points than listed above?</a>

							<div class="topup-payment">
								<strong>Choose Payment Method</strong>
								Transfer Bank:
								<div class="topup-bank">
									<?php if (REK_MANDIRI == 1){ ?>
									<img src="<?php echo cdn_url(); ?>img/bank-mandiri.gif" alt="mandiri" />
									<?php } ?>
									<?php if (REK_BCA == 1){ ?>
									<img src="<?php echo cdn_url(); ?>img/bank-bca.gif" alt="bca" />
									<?php } ?>
								</div>
							</div>
							
							<div class="clearfix">
								<input type="submit" name="btn_submit_topup" class="btn btn-blue pull-right" value="Okay, Submit!" />
							</div>
							
						<!-- .box --></div>
					</form>

				<!-- #content --></div>

				<?php $this->load->view('a/dashboard/dashboard_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>	
		
<script>
	<?php 
	$note_topup_amount = $this->session->userdata('note_topup_amount');
	$this->session->unset_userdata('note_topup_amount');
	?>
	var note_topup_amount = "<?php echo (empty($note_topup_amount)) ? 0 : $note_topup_amount; ?>";
</script>		
		
<?php $this->load->view('a/dashboard/pointstopup_modal_view', $this->data); ?>		

<?php $this->load->view('a/dashboard/pointstopup_confirmation_modal_view', $this->data); ?>

<?php $this->load->view('a/general/footer_view', $this->data); ?>