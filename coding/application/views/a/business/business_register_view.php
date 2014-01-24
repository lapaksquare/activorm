<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="row">
				<div id="content" class="col-sm-8 col-sm-offset-2">

					<form class="form-activorm" action="<?php echo base_url(); ?>auth/business_register" method="post">
						<div class="box">
							<h1 class="center-title"><span>Sign Up for Businesss Acount</span></h1>

							<?php 
							$message_register_business_error = $this->session->userdata('message_register_business_error');
							if (!empty($message_register_business_error)){
								$message_register_business_error = '<li>' . implode('</li><li>', $message_register_business_error) . '</li>';
								$this->session->unset_userdata('message_register_business_error');
							?>
							<div class="alert alert-danger"><?php echo $message_register_business_error; ?></div>
							<?php } ?>
			
							<div class="row">
								<div class="col-sm-6">
									<div class="form-label">
										<label for="business-name">Company Name <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<?php 
										$business_name = $this->session->userdata('business_name');
										$this->session->unset_userdata('business_name');
										?>
										<input type="text" name="business_name" placeholder="" value="<?php echo $business_name; ?>" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="business-position">Position in the Company <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<?php 
										$business_position = $this->session->userdata('business_position');
										$this->session->unset_userdata('business_position');
										?>
										<input type="text" name="business_position" placeholder="" value="<?php echo $business_position; ?>" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="business-contact">Contact Person <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<?php 
										$business_contact = $this->session->userdata('business_contact');
										$this->session->unset_userdata('business_contact');
										?>
										<input type="text" name="business_contact" placeholder="" value="<?php echo $business_contact; ?>" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="business-email">Email <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<?php 
										$business_email = $this->session->userdata('business_email');
										$this->session->unset_userdata('business_email');
										?>
										<input type="text" name="business_email" placeholder="" value="<?php echo $business_email; ?>" class="form-control form-light" />
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-label">
										<label for="business-number">Contact Number <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<?php 
										$business_number = $this->session->userdata('business_number');
										$this->session->unset_userdata('business_number');
										?>
										<input type="text" name="business_number" placeholder="" value="<?php echo $business_number; ?>" class="form-control form-light" />
									</div>
								</div>

								<div class="clearfix"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="business-desc">How would you define your business? <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<?php 
										$business_desc = $this->session->userdata('business_desc');
										$this->session->unset_userdata('business_desc');
										?>
										<textarea name="business_desc" placeholder="" class="form-control form-light" rows="5"><?php echo $business_desc; ?></textarea>
									</div>
								</div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="business-needs">How would you describe your business needs? <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<?php 
										$business_needs = $this->session->userdata('business_needs');
										$this->session->unset_userdata('business_needs');
										?>
										<textarea name="business_needs" placeholder="" class="form-control form-light" rows="5"><?php echo $business_needs; ?></textarea>
									</div>
								</div>

								<div class="col-xs-12">
									<div class="row">
										<div class="col-xs-6">
											<p class="help-block"><em>If you have any question, please send us an email to <a href="#">info@activorm.com</a></em></p>
										</div>

										<div class="col-xs-6">
											<input type="submit" name="business_submit" class="btn btn-big btn-mt btn-wd btn-green pull-right" value="Submit" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>

				<!-- #content --></div>
			</div>

		<!-- #main --></div>

<?php $this->load->view('a/business/business_register_modal_view', $this->data); ?>		

<?php $this->load->view('a/general/footer_view', $this->data); ?>