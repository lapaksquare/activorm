<?php $this->load->view('a/general/header_view', $this->data); ?>	

		<?php $this->load->view('a/general/header_blog_view', $this->data); ?>
		
		<div id="main" class="container">

			<div class="row">
				<div id="content" class="col-md-9">

					<div class="box entry">
						<div class="entry-header">
							<h2 class="entry-title"><a href="#">LINE GAME Achieves 200 Million Downloads, Celebrates with 7-day GAME Fest!</a></h2>
							<span class="entry-meta">1 August 2013 by <a href="#">Karen Kamal</a></span>
						<!-- .entry-header --></div>

						<div class="entry-content">
							<p>Hi everyone! We've released the latest version of LINE for Android (ver 3.8.0) today! Have you downloaded it yet? In addition to improvements to the basic messaging and call functions in this update, we have also added a brand new Brown theme and new Emoji, and increased the maximum length of each message to 10,000 characters!</p>
							<p>*iPhone users, don't worry! A similar update will be available for you soon.</p>
							<p>A new design featuring LINE's popular character, Brown, has been added to the themes! In case you're not aware yet, Themes is a feature that can change the look and feel of the entire app, including your Friends list, Chats list, and menu buttons. Unlike the pink, girly Cony.</p>
							<a class="more-link" href="#">Read More</a>
						<!-- .entry-content --></div>

						<div class="entry-tags">
							<strong>Tags:</strong> <a href="#">Ideas</a>, <a href="#">Gadget</a>, <a href="#">Design</a>, <a href="#">Mobile</a>, <a href="#">Interface</a>
						</div>

						<div class="entry-footer">
							<ul class="clearfix list-unstyled entry-share">
								<li class="share-facebook" data-url="http://google.com" data-text="Sharing text goes here" data-title="share"></li>
								<li class="share-twitter" data-url="http://google.com" data-text="Sharing text goes here" data-title="tweet"></li>
								<li class="share-googleplus" data-url="http://google.com" data-text="Sharing text goes here" data-title="+1"></li>
								<li class="share-comments sharrre">
									<div class="box">
										<a class="count" href="#">999</a>
										<a class="share" href="#">comments</a>
									</div>
								</li>
							</ul>
						<!-- .entry-footer --></div>

						<div class="entry-comments">
							<form class="form-activorm form-comment" action="#" method="get">
								<div class="form-group">
									<textarea name="comment" class="form-control form-light" placeholder="write in here" rows="4"></textarea>
								</div>
								<div class="clearfix form-submit">
									<button type="submit" class="pull-right btn btn-green">Post Comment</button>
									<p class="pull-right help-block">300 characters</p>
								</div>
							</form>

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
						<!-- .entry-comments --></div>
					<!-- .entry --></div>

					<div class="clearfix blog-nav">
						<div class="nav-prev"><a href="#">&lt; Older Entries</a></div>
						<div class="nav-next"><a href="#">Newer Entries &gt;</a></div>
					<!-- .blog-nav --></div>
				<!-- #content --></div>

				<?php $this->load->view('a/general/sidebar_blog_view', $this->data); ?>
				
			</div>

		<!-- #main --></div>
		
<?php $this->load->view('a/general/footer_view', $this->data); ?>