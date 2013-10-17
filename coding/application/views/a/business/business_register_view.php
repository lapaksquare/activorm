<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="row">
				<div id="content" class="col-sm-8 col-sm-offset-2">

					<form class="form-activorm" action="#" method="get">
						<div class="box">
							<h1 class="center-title"><span>Sign Up for Businesss Acount</span></h1>

							<div class="row">
								<div class="col-sm-6">
									<div class="form-label">
										<label for="business-name">Company Name <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="business-name" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="business-position">Position in the Company <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="business-position" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="business-contact">Contact Person <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="business-contact" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="business-email">Email <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="business-email" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="business-number">Contact Number <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="business-number" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="clearfix"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="business-desc">How would you define your business? <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<textarea name="business-desc" placeholder="" class="form-control form-light" rows="5"></textarea>
									</div>
								</div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="business-needs">How would you describe your business needs? <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<textarea name="business-needs" placeholder="" class="form-control form-light" rows="5"></textarea>
									</div>
								</div>

								<div class="col-xs-12">
									<div class="row">
										<div class="col-xs-6">
											<p class="help-block"><em>If you have any question, please send us an email to <a href="#">info@activorm.com</a></em></p>
										</div>

										<div class="col-xs-6">
											<button type="submit" class="btn btn-big btn-mt btn-wd btn-green pull-right">Submit</button>
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