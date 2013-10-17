<?php $this->load->view('a/general/header_view', $this->data); ?>

<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Settings</h1>
				<span class="page-subtitle">If you want to delete your account fill this form.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<form class="form-activorm form-user-delete" action="#" method="get">
						<div class="box">
							<div class="box-header">
								<h2 class="box-title">Are you sure you want to delete your account?</h2>
							</div>

							<p><strong>By deleting your Activorm account means:</strong></p>
							<ul class="list-unstyled list-check">
								<li>You want to remove your data information from Activorm database.</li>
								<li>You can activate you account within 30 days. Longer than 30 days you must create a new account.</li>
								<li>You can't claim the prize you win.</li>
							</ul>

							<div class="row">
								<div class="col-xs-12">
									<div class="form-label">
										<label for="delete-reason">Reason you're leaving Activorm</label>
									</div>
									<div class="form-group">
										<textarea name="delete-reason" class="form-control form-light" rows="5"></textarea>
									</div>
								</div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="password">Confirm Password</label>
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group">
										<input type="password" name="password" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-4 col-sm-offset-2">
									<div class="form-submit">
										<button type="submit" class="btn btn-big btn-green pull-right">Delete Account</button>
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