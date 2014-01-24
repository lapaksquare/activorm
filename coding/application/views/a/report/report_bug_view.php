<?php $this->load->view('a/general/header_view', $this->data); ?>	

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Bug Reports Form</h1>
				<span class="page-subtitle">Send information to Activorm about page with problems.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9">

					<div class="box">
						
						<?php 
						$message_report_bug = $this->session->userdata('message_report_bug');
						$this->session->unset_userdata('message_report_bug');
						if (!empty($message_report_bug) && $message_report_bug == 1){
						?>
						
						<div class="alert alert-danger">There is an error while submitting message. Please try again.</div>
						
						<?php
						}else if (!empty($message_report_bug) && $message_report_bug == 2){
						?>
						
						<div class="alert alert-success">Message sent successfully. Thank you!</div>
						
						<?php
						}
						?>
						
						<form class="form-activorm form-bugs" action="<?php echo base_url(); ?>report/submit_bug" method="post">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-label">
										<label for="name">Name</label>
									</div>
									<div class="form-group">
										<input type="text" name="name" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="bug-type">Bug Type</label>
									</div>
									<div class="form-group">
										<input type="text" name="bug-type" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="clearfix"></div>

								<div class="col-xs-12">
									<div class="form-label">
										<label for="bug-url">URL Page Link</label>
									</div>
									<div class="form-group">
										<input type="text" name="bug-url" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="clearfix"></div>

								<div class="col-xs-12">
									<div class="form-group">
										<textarea name="bug-message" placeholder="write message..." class="form-control form-light" rows="5"></textarea>
									</div>
								</div>
								
								<div class="clearfix"></div>


								<div class="col-sm-6">
									<div class="form-label">
										<label for="bug-url">Enter the contents of image <img src="<?php echo base_url(); ?>ajax/captcha" alt="recaptcha goes here"></label>
									</div>
									<div class="form-group">
										<input type="text" name="captcha" placeholder="" class="form-control form-light" />	
									</div>
								</div>
								

								<div class="col-sm-6">
									<div class="form-submit">
										<input type="submit" name="submit_bug" class="btn btn-big btn-wd btn-green" value="Send" />
									</div>
								</div>
							</div>
						</form>


						<?php /*
						<div class="entry-comments">
							<ul class="list-unstyled list-comments">
								<li class="clearfix comment">
									<div class="comment-avatar">
										<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/ladya.jpg" alt="#" />
									</div>

									<div class="comment-body">
										<div class="comment-meta">
											<strong class="comment-author"><a href="#">Karen Kamal</a></strong>
											<span class="comment-date">12 August 2013 12:35</span>
										</div>

										<div class="comment-note">
											<p>Bug Type: Form Error <em><a href="#">(www.activorm.com/create-project)</a></em></p>
										</div>

										<div class="comment-content">
											<p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
										</div>

										<div class="comment-reply">
											<a href="#"><i class="icon-reply"></i> Reply Comment</a>
										</div>
									</div>
								<!-- .comment --></li>

								<li class="clearfix comment">
									<div class="comment-avatar">
										<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/ladya.jpg" alt="#" />
									</div>

									<div class="comment-body">
										<div class="comment-meta">
											<strong class="comment-author"><a href="#">Karen Kamal</a></strong>
											<span class="comment-date">12 August 2013 12:35</span>
										</div>

										<div class="comment-content">
											<p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
										</div>

										<div class="comment-reply">
											<a href="#"><i class="icon-reply"></i> Reply Comment</a>
										</div>
									</div>

									<ul class="children">
										<li class="clearfix comment">
											<div class="comment-avatar">
												<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/ladya.jpg" alt="#" />
											</div>

											<div class="comment-body">
												<div class="comment-meta">
													<strong class="comment-author"><a href="#">Karen Kamal</a></strong>
													<span class="comment-date">12 August 2013 12:35</span>
												</div>

												<div class="comment-content">
													<p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
												</div>
											</div>
										<!-- .comment --></li>
									</ul>
								<!-- .comment --></li>

								<li class="clearfix comment">
									<div class="comment-avatar">
										<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/ladya.jpg" alt="#" />
									</div>

									<div class="comment-body">
										<div class="comment-meta">
											<strong class="comment-author"><a href="#">Karen Kamal</a></strong>
											<span class="comment-date">12 August 2013 12:35</span>
										</div>

										<div class="comment-content">
											<p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
										</div>

										<div class="comment-reply">
											<a href="#"><i class="icon-reply"></i> Reply Comment</a>
										</div>
									</div>
								<!-- .comment --></li>
							<!-- .list-comments --></ul>
						<!-- .entry-comments --></div> */ ?>
						
						<!-- .box --></div>

				<!-- #content --></div>

				<?php /*
				<div id="sidebar" class="col-md-3">
					<div class="widget widget-ads">
						<a href="#"><img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/ad-1.jpg" alt="#" /></a>
					<!-- .widget --></div>
				<!-- #sidebar --></div>*/ ?>

			<!-- .row --></div>

		<!-- #main --></div>
		
<?php $this->load->view('a/general/footer_view', $this->data); ?>