<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="row">
				<div id="content" class="col-sm-8 col-sm-offset-2">

					<form class="form-activorm" action="<?php echo base_url(); ?>auth/process_resetpassword" method="post">
						<div class="box">
							<h1 class="center-title"><span>Reset your password?</span></h1>
							
							<?php 
							$msg_resetpassword_error = $this->session->userdata('msg_resetpassword_error');
							if (!empty($msg_resetpassword_error)){
								$msg_resetpassword_error = '<li>' . implode('</li><li>', $msg_resetpassword_error) . '</li>';
								$this->session->unset_userdata('msg_resetpassword_error');
							?>
							<div class="alert alert-danger"><?php echo $msg_resetpassword_error; ?></div>
							<?php } ?>
							
							<?php 
							$msg_resetpassword_success = $this->session->userdata('msg_resetpassword_success');
							if (!empty($msg_resetpassword_success)){
								$this->session->unset_userdata('msg_resetpassword_success');
							?>
							<div class="alert alert-success"><?php echo $msg_resetpassword_success; ?></div>
							<?php } ?>
							
							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-label">
										<label for="business-name">Enter new password <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="password" name="new_password" placeholder="" value="" class="form-control form-light" />
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-label">
										<label for="business-name">Confirm your password <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="password" name="confirm_password" placeholder="" value="" class="form-control form-light" />
									</div>
								</div>
								
								<div class="clearfix"></div>
								
								<div class="col-xs-12">
									<div class="row">
										<div class="col-xs-6">
											<p class="help-block"><em>If you have any question, please send us an email to <a href="#">info@activorm.com</a></em></p>
										</div>

										<div class="col-xs-6">
											<input type="submit" name="resetpassword" class="btn btn-big btn-mt btn-wd btn-green pull-right" value="Submit" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>

				<!-- #content --></div>
			</div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>