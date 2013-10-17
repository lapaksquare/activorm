<?php $this->load->view('a/general/header_view', $this->data); ?>	

<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Settings</h1>
				<span class="page-subtitle">You must fill the form cause it's very important.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<form class="form-activorm" action="#" method="get">
						<div class="box">
							<div class="row">
								<div class="col-sm-7">
									<h2 class="acc-input account-title"><span>Starbucks</span> <a href="#"><i class="icon-pencil" data-edit="title"></i></a></h2>
									<div class="acc-input account-email"><span>info@starbucks.com</span> <a href="#"><i class="icon-pencil" data-edit="email"></i></a></div>

									<div class="form-group file-upload">
										<input type="file" name="account-avatar" class="real-file" style="display:none;" />
										<div class="row">
											<div class="col-xs-8">
											<input type="text" placeholder="Choose an Image" class="form-control form-light fake-file" />
											</div>
											<div class="col-xs-4">
												<a class="btn btn-green" onclick="$('.real-file').click();">Upload</a>
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-5">
									<div class="account-avatar">
										<<?php echo cdn_url(); ?>img/ src="<?php echo cdn_url(); ?>img//company-avatar.gif" alt="starbucks" />
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-contact">Contact Person <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="account-contact" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-position">Position in the Company <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="account-position" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-number">Contact Number <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="account-number" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="account-description">Business Description <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<textarea name="account-description" class="form-control form-light" rows="5"></textarea>
									</div>
								</div>

								<div class="row-divider"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="account-address">Business Billing Address <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<textarea name="account-address" class="form-control form-light" rows="5"></textarea>
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-city">City <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="account-city" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="account-zipcode">Zip Code <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="account-zipcode" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="clearfix row-divider"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="account-need">Business Needs (optional)</label>
									</div>
									<div class="form-group">
										<textarea name="account-need" class="form-control form-light" rows="5"></textarea>
									</div>
								</div>

								<div class="col-sm-7">
									<p class="help-block"><strong>Note:</strong> <em>We ensure none of your personal information will be given to the third party for any use.</em></p>
								</div>

								<div class="col-sm-5">
									<div class="form-submit">
										<button type="submit" class="btn btn-big btn-mt btn-green pull-right">Save Changes</button>
									</div>
								</div>
							</div>
						</div>
					</form>

				<!-- #content --></div>

				<div id="sidebar" class="col-md-3 col-md-pull-9">
					<div class="widget widget-pages">
						<ul class="list-unstyled">
							<li class="active"><a href="#">Contact Information</a></li>
							<li><a href="#">Social Media Connect</a></li>
							<li><a href="#">Email Preference</a></li>
							<li><a href="#">Password</a></li>
							<li><a href="#">Delete Account</a></li>
						</ul>
					<!-- .widget --></div>
				<!-- #sidebar --></div>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>