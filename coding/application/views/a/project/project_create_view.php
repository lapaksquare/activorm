<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Create Project</h1>
				<span class="page-subtitle">Fill in the form and complete it.</span>
				<div class="clearfix"></div>
			</div>

			<form action="action.php" method="post">
				<div id="step-1" class="box step">
					<h2 class="step-title">Step 1: <span class="green">Add Project Title</span></h2>

					<div class="form-group">
						<input type="text" name="project-name" placeholder="write in here..." class="form-control form-light limiter" maxlength="60" />
						<div class="counter pull-right">
							<strong><span></span> characters</strong>
						</div>
						<p class="help-block"><strong>Tips:</strong> <em>try to make a short title so it will be easier to be shared</em></p>
					</div>
				<!-- #step-1 --></div>

				<div id="step-2" class="box step">
					<h2 class="step-title">Step 2: <span class="green">Upload Project Image</span></h2>

					<div class="row">
						<div class="col-sm-4">
							<div class="project-thumbnail">
								<img src="" alt="#" />
							</div>
						</div>

						<div class="col-sm-8">
							<div class="form-group file-upload">
								<input type="file" name="direct-file" class="real-file" style="display:none;" />
								<div class="row">
									<div class="col-xs-5">
										<input type="text" placeholder="Choose an Image" class="form-control form-light fake-file" />
									</div>
									<div class="col-xs-3">
										<a class="btn btn-green" onclick="$('.real-file').click();">Upload</a>
									</div>
								</div>

								<p class="help-block"><strong>Tips:</strong> <em>Project images could be your logo or other image that will boost this project exposure must be <strong>jpg/jpeg, gif, or png</strong> smaller than <strong>2 MB</strong>, dimension are limeted to <strong>200x200 pixels</strong> image larger than this will be resized.</em></p>
							</div>
						</div>
					</div>
				<!-- #step-2 --></div>

				<div id="step-3" class="box step">
					<h2 class="step-title">Step 3: <span class="green">Set Period</span></h2>

					<div class="row slider-progress">
						<div class="col-sm-6">
							<span class="slider-label label-left">7 d</span>
							<span class="slider-label label-right">30 d</span>

							<input id="project-period" data-slider-id="slider-period" type="text" data-slider-min="7" data-slider-max="30" data-slider-step="1" data-slider-value="20" />
							<p class="help-block"><strong>Tips:</strong> <em>your project may valid for maximum 30 days</em></p>

							<div class="slider-start"></div>
						</div>
					</div>
				<!-- #step-3 --></div>

				<div id="step-4" class="box step">
					<h2 class="step-title">Step 4: <span class="green">Describe Prize</span></h2>

					<div class="row">
						<div class="col-sm-9">
							<div class="form-group">
								<input type="text" name="project-prize" placeholder="" class="form-control form-light" />
								<p class="help-block"><strong>Example:</strong> <em>"macbook pro 13inch retina display"</em></p>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="form-group">
								<select name="prize-category" class="custom-select light-select select-category">
									<option>Voucher</option>
									<option>Cash</option>
									<option>Stuff</option>
									<option>Other</option>
								</select>
								<div class="clearfix"></div>
								<p class="help-block"><em>select prize category</em></p>
							</div>
						</div>
					</div>
				<!-- #step-4 --></div>

				<div id="step-5" class="box step">
					<h2 class="step-title">Step 5: <span class="green">Select 3 Actions</span></h2>
					<p class="step-subtitle">Select 3 actions that have to be followed by your fans to join this project.</p>

					<div class="action-steps">
						<ul class="row pick-0">
							<li class="col-sm-4 action-ready">
								<div class="step-no">1.</div>
								<div class="step-ico"><span></span></div>
								<strong class="step-desc">Unknown</strong>
							</li>
							<li class="col-sm-4">
								<div class="step-no">2.</div>
								<div class="step-ico"><span></span></div>
								<strong class="step-desc">Unknown</strong>
							</li>
							<li class="col-sm-4">
								<div class="step-no">3.</div>
								<div class="step-ico"><span></span></div>
								<strong class="step-desc">Unknown</strong>
							</li>
						</ul>
					<!-- .action-steps --></div>

					<div class="action-select">
						<ul class="list-unstyled">
							<li class="select-facebook">
								<i class="icon-facebook"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="facebook-like" name="action-facebook" data-label="Like Facebook Page" data-icon="action-fb-like" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="facebook-follow" name="action-facebook" data-label="Follow Facebook User" data-icon="action-fb-follow" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="facebook-send" name="action-facebook" data-label="Send Content to Friend" data-icon="action-fb-share" />
										</div>
									</div>
								</div>
							<!-- .select-facebook --></li>

							<li class="select-twitter">
								<i class="icon-twitter"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="twitter-tweet" name="action-twitter" data-label="Tweet Something" data-icon="action-tw-tweet" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="twitter-follow" name="action-twitter" data-label="Follow @ ..." data-icon="action-tw-follow" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="twitter-hashtag" name="action-twitter" data-label="Tweet #hashtag ..." data-icon="action-tw-hashtag" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="twitter-to" name="action-twitter" data-label="Tweet to @ ..." data-icon="action-tw-tweetto" />
										</div>
									</div>
								</div>
							<!-- .select-twitter --></li>

							<li class="select-tumblr">
								<i class="icon-tumblr"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="tumblr-follow" name="action-tumblr" data-label="Follow Blog" data-icon="action-tb-follow" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="tumblr-share" name="action-tumblr" data-label="Share Blog Content" data-icon="action-tb-share" />
										</div>
									</div>
								</div>
							<!-- .select-tumblr --></li>

							<li class="select-foursquare">
								<i class="icon-foursquare"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="foursquare-like" name="action-foursquare" data-label="Like a Venue" data-icon="action-fs-like" />
										</div>
									</div>
								</div>
							<!-- .select-foursquare --></li>

							<li class="select-pinterest">
								<i class="icon-pinterest"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="pinterest-pin" name="action-pinterest" data-label="Pin an Image" data-icon="action-pn-pin" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="pinterest-follow" name="action-pinterest" data-label="Follow Pinterest User" data-icon="action-pn-follow" />
										</div>
									</div>
								</div>
							<!-- .select-pinterest --></li>

							<li class="select-instagram">
								<i class="icon-instagram"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="instagram-follow" name="action-instagram" data-label="Follow Instagram User" data-icon="action-ig-follow" />
										</div>
									</div>
								</div>
							<!-- .select-instagram --></li>

							<li class="select-gplus">
								<i class="icon-gplus"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="gplus-follow" name="action-gplus" data-label="Follow Google+ Account" data-icon="action-gp-follow" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="gplus-plus" name="action-gplus" data-label="+1 for Post" data-icon="action-gp-plus" />
										</div>
									</div>
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="gplus-share" name="action-gplus" data-label="Share Content Circle" data-icon="action-gp-share" />
										</div>
									</div>
								</div>
							<!-- .select-gplus --></li>

							<li class="select-youtube">
								<i class="icon-youtube"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="youtube-subscribe" name="action-youtube" data-label="Subscribe to Channel" data-icon="action-yt-subscribe" />
										</div>
									</div>
								</div>
							<!-- .select-youtube --></li>

							<li class="select-email">
								<i class="icon-email"></i>
								<div class="row">
									<div class="col-md-4 col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkstep" value="email-send" name="action-email" data-label="Send an Email" data-icon="action-em-send" />
										</div>
									</div>
								</div>
							<!-- .select-email --></li>
						</ul>
					<!-- .action-select --></div>
				<!-- #step-5 --></div>

				<div id="step-6" class="box step">
					<h2 class="step-title">Step 6: <span class="green">Describe Program</span></h2>

					<div class="row">
						<div class="col-sm-9">
							<div class="form-group">
								<textarea name="project-description" placeholder="write in here" class="form-control form-light" rows="5"></textarea>
								<p class="help-block">Max 200 words</p>
							</div>
						</div>

						<div id="tags" class="col-sm-3">
							<div class="form-group">
								<p class="help-block"><em>Use comma to separate tags</em></p>
								<input type="text" name="project-tags" placeholder="" class="form-control form-light" />
							</div>
						</div>
					</div>
				<!-- #step-6 --></div>

				<div id="step-7" class="box step">
					<h2 class="step-title">Additional Step:</h2>

					<div class="form-group">
						<input type="checkbox" class="custom-checkupgrade" value="upgrade-premium" name="step-upgrade" data-label="Upgrade to Premium Plan" />
					</div>

					<div class="upgrade-divider"></div>

					<ul class="list-unstyled upgrade-options">
						<li>
							<div class="form-group">
								<input type="checkbox" class="custom-checkwhite" value="allow-share" name="option-share" data-label="Allow fans to share more about your business to get more tickets (max 3 tickets)" />
							</div>

							<div class="sub-options">
								<div class="form-label">
									<label for="facebook-format">Share Facebook Format (140 Character)</label>
								</div>
								<div class="form-group">
									<input type="text" name="facebook-format" placeholder="" class="form-control form-light" />
								</div>

								<div class="form-label">
									<label for="twitter-format">Share Twitter Format (120 Character)</label>
								</div>
								<div class="form-group">
									<input type="text" name="twitter-format" placeholder="" class="form-control form-light" />
								</div>
							</div>
						</li>

						<li>
							<div class="form-group">
								<input type="checkbox" class="custom-checkwhite" value="direct-tickets" name="option-tickets" data-label="Direct tickets/price for completed actions (e.g voucher images or ebook PDF)" />
							</div>

							<div class="sub-options">
								<div class="form-group file-upload">
									<input type="file" name="direct-file" class="real-file" style="display:none;" />
									<div class="row">
										<div class="col-xs-4">
										<input type="text" placeholder="Choose an Image" class="form-control form-light fake-file" />
										</div>
										<div class="col-xs-3">
											<a class="btn btn-green" onclick="$('.real-file').click();">Upload</a>
										</div>
									</div>
								</div>
							</div>
						</li>

						<li>
							<div class="form-group">
								<input type="checkbox" class="custom-checkwhite" value="display-social" name="option-social" data-label="Display social media channels on this project (Facebook, Twitter, etc.)" />
							</div>
						</li>
					<!-- .upgrade-options --></ul>

					<div class="clearfix form-submit">
						<button type="submit" class="btn btn-blue pull-right">Preview</button>
						<button type="submit" class="btn btn-green pull-right">Submit</button>
						<button type="submit" class="btn btn-blue pull-right">Save Draft</button>
					</div>
				<!-- #step-7 --></div>
			</form>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>