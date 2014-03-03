<?php $this->load->view('a/general/header_view', $this->data); ?>

	<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Business</h1>
				<span class="page-subtitle">You must fill the form cause it's very important.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<form action="<?php echo base_url(); ?>dashboard/submit_paymentconfirmation" method="post">
						<div class="box">
							
							<?php 				
							$message_paymentconfirmation_error = $this->session->userdata('message_paymentconfirmation_error');
							
							$message_paymentconfirmation = $this->session->userdata('message_paymentconfirmation');
							
							if (!empty($message_paymentconfirmation_error)){
								$message_paymentconfirmation = '<li>' . implode('</li><li>', $message_paymentconfirmation_error) . '</li>';
								$this->session->unset_userdata('message_paymentconfirmation_error');
							?>
							<div class="alert alert-danger"><ul><?php echo $message_paymentconfirmation; ?></ul></div>
							<?php }else if ($message_paymentconfirmation == 2){ 
								$this->session->unset_userdata('message_paymentconfirmation');
								?>
							<div class="alert alert-success">Thank you. We will confirm this transaction soon.</div>
							<?php } ?>
								
							<div class="box-header">
								<h2 class="box-title">Payment Confirmation</h2>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<div class="form-label">
										<label for="transaction-date">Payment Date</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-xs-12">
												<input class="form-control form-light datepicker" placeholder="" type="text" name="payment_date" value="" autocomplete="none" />
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-6 col-sm-offset-6 col-sm-pull-6">
									<div class="form-label">
										<label for="transaction-number">Transaction Number</label>
									</div>
									<div class="form-group clearfix">
										<?php if (!empty($payment_checkout)){ ?>
										<select name="transaction_number" class="custom-select light-select transaction-number">
											<?php foreach($payment_checkout as $k=>$v){ ?>
											<option value="<?php echo $v->order_barcode; ?>"><?php echo strtoupper($v->order_barcode); ?></option>
											<?php } ?>
										</select>
										<?php }else{ ?>
											<p>Tidak Ada Transaksi.</p>
										<?php } ?>
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="transaction-amount">Amount</label>
									</div>
									<div class="form-group">
										<input type="text" name="transaction_amount" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="transaction-bank">Payment to Bank</label>
									</div>
									<div class="form-group">
										<select name="transaction_bank" class="custom-select light-select transaction-bank">
											<option>BCA</option>
											<option>BNI</option>
											<option>BRI</option>
											<option>CIMB Niaga</option>
											<option>Mandiri</option>
										</select>
									</div>
								</div>
							</div>
						<!-- .box --></div>

						<div class="box">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-label">
										<label for="sender-bank">From Bank</label>
									</div>
									<div class="form-group">
										<input type="text" name="sender_bank" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6 col-sm-offset-6 col-sm-pull-6">
									<div class="form-label">
										<label for="sender-name">Account Holder Name</label>
									</div>
									<div class="form-group">
										<input type="text" name="sender_name" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="sender-account">Account Number</label>
									</div>
									<div class="form-group">
										<input type="text" name="sender_account" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group clearfix" style="margin:40px 0 0;">
										<input type="submit" name="btn_continue" class="btn btn-big btn-green pull-right" value="Continue" />
									</div>
								</div>
							</div>
						<!-- .box --></div>
					</form>

				<!-- #content --></div>

				<?php $this->load->view('a/dashboard/dashboard_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>