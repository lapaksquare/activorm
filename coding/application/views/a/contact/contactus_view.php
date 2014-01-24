<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Contact Us</h1>
				<span class="page-subtitle">Please fill in the form and we'll get back to you soon.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9">

						<div class="box">
							<div class="row">
								
								<?php 
								$msg_cu_errors = $this->session->userdata('msg_cu_errors');
								if (!empty($msg_cu_errors)){
									$msg_cu_errors = '<li>' . implode('</li><li>', $msg_cu_errors) . '</li>';
									$this->session->unset_userdata('msg_cu_errors');
								?>
								<div class="alert alert-danger"><?php echo $msg_cu_errors; ?></div>
								<?php } ?>
								
								<?php 
								$msg_cu_success = $this->session->userdata('msg_cu_success');
								if (!empty($msg_cu_success)){
									$this->session->unset_userdata('msg_cu_success');
								?>
								<div class="alert alert-success">Message sent successfully. Thank you!</div>
								<?php
								}
								?>
								
								<form action="<?php echo base_url(); ?>contact/submit_contactus" method="post">
								
								<div class="col-sm-6">
									<div class="form-label">
										<label for="name">Name <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="name" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="email">Email <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="email" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="company">Company <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="company" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="phone">Phone <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="phone" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="clearfix"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="subject">Subject <span class="req">*</span></label>
									</div>
									<div class="form-group">
										<input type="text" name="subject" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-xs-12">
									<div class="form-group">
										<textarea name="message" placeholder="write message..." class="form-control form-light" rows="5"></textarea>
									</div>
								</div>

								<div class="col-xs-12">
									<div class="form-submit">
										<input type="submit" name="send_contact" id="send_contact" class="btn btn-big btn-wd btn-green" value="Send" />
									</div>
								</div>
								
								</form>
								
							</div>
						<!-- .box --></div>

				<!-- #content --></div>

				<div id="sidebar" class="col-md-3">
					<div class="widget widget-map">
						<div id="office-map"></div>

						<div id="office-address">
							<strong>P. (021) 2942 8723 ext. 208</strong>
							<strong>E. Info@activorm.com</strong>
							<span>Monday - Friday, 10.00 - 16.00</span>

							<strong>Office</strong>
							Graha Tirtadi Floor 1. <br /> Jalan Senopati No.75
						</div>
					<!-- .widget --></div>
				<!-- #sidebar --></div>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>