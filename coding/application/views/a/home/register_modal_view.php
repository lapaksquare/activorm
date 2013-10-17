		<div id="modal-user" class="modal modal-activorm fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>

					<div id="user-signup" class="modal-body">
						<h4 class="modal-title">Signup for Activorm</h4>
						<a class="btn btn-big btn-fb" href="#"><i class="icon-facebook"></i> Sign Up with Facebook</a>

						<div class="signup-alt"><strong>or</strong></div>

						<form class="clearfix form-activorm" action="#" method="get">
							<div class="form-group">
								<input type="text" name="name" placeholder="Full Name" class="form-control form-green" />
							</div>

							<div class="form-group">
								<input type="text" name="email" placeholder="Email" class="form-control form-green" />
							</div>

							<div class="form-group">
								<input type="password" name="password" placeholder="Password" class="form-control form-green" />
							</div>

							<div class="row">
								<div class="col-xs-6">
									<p class="help-block">By clicking "Sign Up" you agree to our <a href="#">Term &amp; Conditions</a></p>
								</div>

								<div class="col-xs-6">
									<div class="form-submit">
										<button type="button" class="btn btn-big btn-wd btn-yellow pull-right">Submit</button>
									</div>
								</div>
							</div>
						</form>
					<!-- #user-signup --></div>

					<div id="user-activation" class="modal-body">
						<h4 class="modal-title">Activation</h4>
						<p class="activation-check">Please kindly check your email to activate your account at Activorm</p>

						<form class="clearfix form-activorm" action="#" method="get">
							<div class="row">
								<div class="col-xs-7">
									<div class="form-group">
										<input type="text" name="activation-code" placeholder="Enter Activation Code" class="form-control form-green" />
									</div>
								</div>

								<div class="col-xs-5">
									<div class="form-submit">
										<button type="button" class="btn btn-big btn-block btn-yellow">Submit</button>
									</div>
								</div>
							</div>
						</form>

						<p class="activation-error">Error: Activation code is wrong<br /> Click <a href="#">here</a> to resend activation email</p>
						<p class="activation-spam">If you don't receive the message please check your spam folder</p>
					<!-- #user-activation --></div>

					<div id="user-result" class="modal-body">
						<h4 class="modal-title">Congratulation!</h4>
						<p>You have registered in Activorm.<br /> Please complete your profile information.</p>

						<div class="user-info">
							<div class="user-avatar">
								<img src="<?php echo cdn_url(); ?>img/user-default.gif" alt="username" />
							</div>

							<strong>Karen Kamal</strong>
						</div>

						<a class="btn btn-big btn-yellow" href="#">Continue</a>
					<!-- #user-result --></div>

					<div id="user-signin" class="modal-body">
						<h4 class="modal-title">Log In for Activorm</h4>
						<a class="btn btn-big btn-fb" href="#"><i class="icon-facebook"></i> Log in with Facebook</a>

						<div class="signup-alt"><strong>or</strong></div>

						<form class="clearfix form-activorm" action="#" method="get">
							<div class="form-group">
								<input type="text" name="username" placeholder="Username" class="form-control form-green" />
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
										<button type="button" class="btn btn-big btn-wd btn-yellow pull-right">Log In</button>
									</div>
								</div>
							</div>

							<p class="form-footer">Not a member yet? <a href="#">SIGNUP</a></p>
						</form>
					<!-- #user-signin --></div>

				</div>
			</div>
		<!-- .modal --></div>