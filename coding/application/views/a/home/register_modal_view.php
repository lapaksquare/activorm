		<div id="modal-user" class="popup-modal-user-login modal modal-activorm fade">
			
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
			
					<div id="user-signin" class="modal-body" style="display:block;">
						<h4 class="modal-title">Log In for Activorm</h4>
						<a class="btn btn-big btn-fb" href="<?php echo $this->access->loginUrl; ?>"><i class="icon-facebook"></i> Log in with Facebook</a>

						<div class="signup-alt"><strong>or</strong></div>

						<form class="clearfix form-activorm" action="<?php echo base_url(); ?>auth/login" method="post">
							<div class="form-group">
								<input type="text" name="email" placeholder="Email" class="form-control form-green" />
							</div>

							<div class="form-group">
								<input type="password" name="password" placeholder="Password" class="form-control form-green" />
							</div>

							<div class="row">
								<div class="col-xs-6">
									<p class="help-block"><a href="#"><em>Forgot Password</em></a></p>
									<input type="checkbox" class="custom-checksmall" name="remember" value="yes" data-label="Remember Me" />
								</div>

								<div class="col-xs-6">
									<div class="form-submit">
										<input type="submit" name="login" class="btn btn-big btn-wd btn-yellow pull-right" value="Log In" /> 
									</div>
								</div>
							</div>

							<p class="form-footer">Not a member yet? <a href="#" id="btn-signup">SIGNUP</a></p>
						</form>
					<!-- #user-signin --></div>
				</div>
			</div>
			
		</div>
		
		
		<div id="modal-user" class="popup-modal-user modal modal-activorm fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>

					<?php  
					$register_temp = $this->session->userdata('register_temp');
					if (empty($register_temp) && ($register_temp['step'] == 1 || empty($register_temp['step']))){
					?>
					<div id="user-signup" class="modal-body" style="display:block;">
						<h4 class="modal-title">Signup for Activorm</h4>
						
						<?php 
						$message_register_error = $this->session->userdata('message_register_error');
						if (!empty($message_register_error)){
							$this->session->unset_userdata('message_register_error');
						?>
						<div class="alert alert-danger"><?php echo $message_register_error; ?></div>
						<?php } ?>
						
						<?php  
						if (empty($register_temp['step'])){
						?>
						<a class="btn btn-big btn-fb" href="<?php echo $this->access->loginUrl; ?>"><i class="icon-facebook"></i> Sign Up with Facebook</a>

						<div class="signup-alt"><strong>or</strong></div>

						<?php } ?>

						<form class="clearfix form-activorm" action="<?php echo base_url(); ?>auth/register" method="post">
							<div class="form-group">
								<input type="text" name="name" placeholder="Full Name" class="form-control form-green" value="<?php echo $register_temp['fullname']; ?>" />
							</div>

							<div class="form-group">
								<input type="text" name="email" placeholder="Email" class="form-control form-green" value="<?php echo $register_temp['email']; ?>" />
							</div>

							<div class="form-group">
								<input type="password" name="password" placeholder="Password" class="form-control form-green" />
							</div>

							<div class="row">
								<div class="col-xs-6">
									<p class="help-block">By clicking "Sign Up" you agree to our <a href="<?php echo base_url(); ?>terms">Term &amp; Conditions</a></p>
								</div>

								<div class="col-xs-6">
									<div class="form-submit">
										<input type="submit" name="submit_register" class="btn btn-big btn-wd btn-yellow pull-right" value="Submit" />
									</div>
								</div>
							</div>
						</form>
					<!-- #user-signup --></div>
					<?php } ?>

					<?php if (!empty($register_temp) && $register_temp['step'] == 2){ ?>
					<div id="user-activation" class="modal-body" style="display:block;">
						<h4 class="modal-title">Activation</h4>
						
						<?php 
						$message_register_error = $this->session->userdata('message_register_error');
						if (!empty($message_register_error)){
							$this->session->unset_userdata('message_register_error');
						?>
						<div class="alert alert-danger"><?php echo $message_register_error; ?></div>
						<?php } ?>
						
						<p class="activation-check">Please kindly check your email to activate your account at Activorm</p>

						<form class="clearfix form-activorm" action="<?php echo base_url(); ?>auth/verify_code" method="post">
							<div class="row">
								<div class="col-xs-7">
									<div class="form-group">
										<input type="text" name="activation_code" placeholder="Enter Activation Code" class="form-control form-green" />
									</div>
								</div>

								<div class="col-xs-5">
									<div class="form-submit">
										<input type="submit" name="submit_verify" value="Submit" class="btn btn-big btn-block btn-yellow" />
									</div>
								</div>
							</div>
						</form>

						<p class="activation-error">Error: Activation code is wrong<br /> Click <a href="#">here</a> to resend activation email</p>
						<p class="activation-spam">If you don't receive the message please check your spam folder</p>
					<!-- #user-activation --></div>
					<?php } ?>
					
					
					<?php if (!empty($register_temp) && $register_temp['step'] == 3){ ?>
					<div id="user-result" class="modal-body" style="display:block;">
						<h4 class="modal-title">Congratulation!</h4>
						<p>You have registered in Activorm.<br /> Please complete your profile information.</p>

						<div class="user-info">
							<div class="user-avatar">
								<?php 
								$photo = (empty($this->access->member_account->account_primary_photo)) ? 'img/user-default.gif' : $this->access->member_account->account_primary_photo;
								?>
								<img src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $this->access->member_account->account_name; ?>" />
							</div>

							<strong><?php echo $this->access->member_account->account_name; ?></strong>
						</div>

						<a class="btn btn-big btn-yellow" href="<?php echo base_url(); ?>auth/register_completed?vc=<?php echo $this->access->member_account->verification_code; ?>&hash=<?php echo sha1($this->access->member_account->verification_code . date('Y-m-d')); ?>">Continue</a>
					<!-- #user-result --></div>
					<?php } ?>

				</div>
			</div>
		<!-- .modal --></div>