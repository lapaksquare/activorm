<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Settings</h1>
				<span class="page-subtitle">If you want to delete your account fill this form.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<div class="box">
						<div class="box-header">
							<h2 class="box-title">Social Media Accounts</h2>
						</div>

						<p>Any connection is only under your permission.</p>

						<div class="row user-connect">
							<div class="col-xs-6">
								<i class="icon-facebook"></i> Facebook
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-green pull-right" href="#">Connect</a>
							</div>

							<div class="clearfix row-divider"></div>

							<div class="col-xs-6">
								<i class="icon-twitter"></i> Twitter
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-green pull-right" href="#">Connect</a>
							</div>

							<div class="clearfix row-divider"></div>

							<div class="col-xs-6">
								<i class="icon-gplus"></i> Google+
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-green pull-right" href="#">Connect</a>
							</div>

							<div class="clearfix row-divider"></div>

							<div class="col-xs-6">
								<i class="icon-tumblr"></i> Tumblr
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-green pull-right" href="#">Connect</a>
							</div>

							<div class="clearfix row-divider"></div>

							<div class="col-xs-6">
								<i class="icon-flickr"></i> Flickr
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-grey pull-right" href="#">Connect</a>
							</div>

							<div class="clearfix row-divider"></div>

							<div class="col-xs-6">
								<i class="icon-pinterest"></i> Pinterest
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-grey pull-right" href="#">Connect</a>
							</div>

							<div class="clearfix row-divider"></div>

							<div class="col-xs-6">
								<i class="icon-foursquare"></i> Foursquare
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-green pull-right" href="#">Connect</a>
							</div>
						</div>
					</div>

				<!-- #content --></div>

				<?php $this->load->view('a/settings/settings_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>