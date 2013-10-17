<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Settings</h1>
				<span class="page-subtitle">Check list if you want the notification send to your email.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<form class="form-activorm form-user-email" action="#" method="get">
						<div class="box">
							<div class="box-header">
								<h2 class="box-title">Email notification when...</h2>
							</div>

							<div class="form-group">
								<input type="checkbox" class="custom-checkgrey" value="email-new" name="email-when" data-label="New project posted by publisher" checked />
							</div>
							<div class="form-group">
								<input type="checkbox" class="custom-checkgrey" value="email-winner" name="email-when" data-label="Winner announcement of project I join" checked />
							</div>
							<div class="form-group">
								<input type="checkbox" class="custom-checkgrey" value="email-comment" name="email-when" data-label="Someone reply on my comment in a project I join" />
							</div>
							<div class="form-group">
								<input type="checkbox" class="custom-checkgrey" value="email-other" name="email-when" data-label="Winner announcement of project I join" />
							</div>

							<h3 class="form-subtitle">Newsletter</h3>

							<div class="row">
								<div class="clearfix"></div>

								<div class="col-sm-6">
									<div class="form-group">
										<input type="checkbox" class="custom-checkgrey" value="yes" name="email-newsletter" data-label="I want to receive Activorm newsletter" />
									</div>
								</div>

								<div class="col-sm-4 col-sm-offset-2">
									<div class="form-submit">
										<button type="submit" class="btn btn-big bnt-mt btn-green pull-right">Save Changes</button>
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