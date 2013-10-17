<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Settings</h1>
				<span class="page-subtitle">Fill this form to change your password.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<form class="form-activorm form-user-pass" action="#" method="get">
						<div class="box">
							<div class="box-header">
								<h2 class="box-title">Change Password</h2>
							</div>

							<div class="row">
								<div class="clearfix"></div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="password">Current Password</label>
									</div>
									<div class="form-group">
										<input type="password" name="password" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6 col-sm-pull-6 col-sm-offset-6">
									<div class="form-label">
										<label for="new-password">New Password</label>
									</div>
									<div class="form-group">
										<input type="password" name="new-password" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="new-password">Confirm New Password</label>
									</div>
									<div class="form-group">
										<input type="password" name="new-password" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-4 col-sm-offset-2">
									<div class="form-submit">
										<button type="submit" class="btn btn-big btn-green pull-right">Save Changes</button>
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