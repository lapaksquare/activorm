<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Settings</h1>
				<!--<span class="page-subtitle">Fill this form to change your password.</span>-->
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<form class="form-activorm form-user-pass" action="<?php echo base_url(); ?>settings/save_changepassword" method="post">
						<div class="box">
							
							<?php 
							$message_error_password = $this->session->userdata('message_error_password');
							if (!empty($message_error_password)){
								$message_error_password = '<li>' . implode('</li><li>', $message_error_password) . '</li>';
								$this->session->unset_userdata('message_error_password');
							?>
							<div class="alert alert-danger"><?php echo $message_error_password; ?></div>
							<?php } ?>
							
							<?php 
							$message_success_password = $this->session->userdata('message_success_password');
							if (!empty($message_success_password)){
								$this->session->unset_userdata('message_success_password');
							?>
							<div class="alert alert-success">Change password saved!.</div>
							<?php
							}
							?>
							
							<div class="box-header">
								<h2 class="box-title">Change Password</h2>
							</div>

							<div class="row">
								<div class="clearfix"></div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="current_password">Current Password</label>
									</div>
									<div class="form-group">
										<input type="password" name="current_password" id="current_password" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6 col-sm-pull-6 col-sm-offset-6">
									<div class="form-label">
										<label for="new_password">New Password</label>
									</div>
									<div class="form-group">
										<input type="password" name="new_password" id="new_password" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="confirm_new_password">Confirm New Password</label>
									</div>
									<div class="form-group">
										<input type="password" name="confirm_new_password" id="confirm_new_password" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-4 col-sm-offset-2">
									<div class="form-submit">
										<input type="submit" name="submit" value="Save Changes" class="btn btn-big btn-green pull-right" />
									</div>
								</div>
							</div>
						</div>
					</form>

				<!-- #content --></div>

				<?php $this->load->view('a/settings/settings_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>