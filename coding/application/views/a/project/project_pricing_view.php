<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="row">
			<form class="form-activorm" action="#" method="get">
				<div class="col-sm-8 pricing-budget">
					<div class="box">
						<div class="row">
							<div class="col-sm-6 pricing-slider">
								<strong>Budget IDR 100.000 - 1.000.000</strong>
								<input id="project-budget" data-slider-id="slider-period" type="text" data-slider-min="100000" data-slider-max="1000000" data-slider-step="10000" data-slider-value="100000" />
							</div>

							<div class="col-sm-6 pricing-counter">
								<div class="counter-box">
									<span>1 Point IDR 1.000</span>
									<strong class="green">100 Points</strong>
								</div>
							</div>
						</div>
					</div>
				<!-- .pricing-budget --></div>

				<div class="col-sm-4 pricing-balance">
					<div class="box">
						<strong>Your Point Balance Now</strong>
						<span class="balance-box" data-balance="500">500 Points</span>
						<span class="balance-note">You don't have enough balance, please <a href="#">Top Up</a></span>
					</div>
				<!-- .pricing-balance --></div>

				<div class="clearfix"></div>

				<div class="col-xs-12 pricing-plans">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Pricing per Project</h3>
							<a href="#">Calculate Project per Plan</a>
						</div>

						<div class="row pricing-panel">
							<div class="col-sm-4">
								<div class="panel panel-plan">
									<div class="panel-heading">
										<h3 class="panel-title">CPM (Cost per Impression)</h3>
									</div>

									<div class="panel-body">
										<div class="panel-price">
											<span>IDR 150/impression</span>
											<strong>0,15 Points</strong>
											<span class="panel-stars star-1"></span>
										</div>

										<ul>
											<li>Full Dashboard &amp; Analytics</li>
											<li>Campaign in Activorm Newsletter</li>
											<li>Get more tickets by more sharing</li>
											<li>Direct Prize</li>
											<li>Display merchant social accounts</li>
										</ul>

										<button type="submit" class="btn btn-big btn-yellow">Select This Plan</button>
									</div>
								<!-- .panel-plan --></div>
							</div>

							<div class="col-sm-4">
								<div class="panel panel-plan">
									<div class="panel-heading">
										<h3 class="panel-title">PPC (Pay per Click)</h3>
									</div>

									<div class="panel-body">
										<div class="panel-price">
											<span>IDR 1.000/click</span>
											<strong>1 Points</strong>
											<span class="panel-stars star-2"></span>
										</div>

										<ul>
											<li>Full Dashboard &amp; Analytics</li>
											<li>Campaign in Activorm Newsletter</li>
											<li>Get more tickets by more sharing</li>
											<li>Direct Prize</li>
											<li>Display merchant social accounts</li>
											<li>Campaign featured in first 3 pages</li>
										</ul>

										<button type="submit" class="btn btn-big btn-yellow">Select This Plan</button>
									</div>
								<!-- .panel-plan --></div>
							</div>

							<div class="col-sm-4">
								<div class="panel panel-plan">
									<div class="panel-heading">
										<h3 class="panel-title">Member Join</h3>
									</div>

									<div class="panel-body">
										<div class="panel-price">
											<span>IDR 2.500/member join</span>
											<strong>2,5 Points</strong>
											<span class="panel-stars star-3"></span>
										</div>

										<ul>
											<li>Full Dashboard &amp; Analytics</li>
											<li>Campaign in Activorm Newsletter</li>
											<li>Get more tickets by more sharing</li>
											<li>Direct Prize</li>
											<li>Display merchant social accounts</li>
											<li>Campaign featured in first 3 pages</li>
											<li>Free Ads Banner</li>
										</ul>

										<button type="submit" class="btn btn-big btn-yellow">Select This Plan</button>
									</div>
								<!-- .panel-plan --></div>
							</div>
						<!-- .pricing-panel --></div>

						<div class="clearfix row-divider"></div>

						<div class="row pricing-info">
							<div class="col-sm-4">
								<h3>Plan A</h3>
								<strong>100 Points: 1,5 Point = <span class="green">667 fans</span></strong>
								<p>Please pick one of the suggested items below for you project prize:</p>

								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkgrey" value="prize-ipad" name="project-prize" data-label="iPad" />
										</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkgrey" value="prize-iphone" name="project-prize" data-label="iPhone" />
										</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkgrey" value="prize-macbook" name="project-prize" data-label="Macbook" />
										</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkgrey" value="prize-shoes" name="project-prize" data-label="Shoes" />
										</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group">
											<input type="checkbox" class="custom-checkgrey" value="prize-lenovo" name="project-prize" data-label="Lenovo k900" />
										</div>
									</div>
								</div>
							</div>

							<div class="col-sm-4">
								<h3>Plan B</h3>
								<strong>100 Points: 1 Point = <span class="green">100 clicks</span></strong>
								<p>Your project will be exposed within 3 first pages of Activorm until hit 100 clicks on project details page.</p>
							</div>

							<div class="col-sm-4">
								<h3>Plan C</h3>
								<strong>100 Points: 2,5 Points = <span class="green">140 members</span></strong>
								<p>Your project will be exposed within 3 first pages of Activorm and get free ads banner until hit 140 members join in to your project.</p>
							</div>
						<!-- .pricing-abc --></div>

						<a class="btn btn-green btn-back" href="#">Back</a>
					</div>
				<!-- .pricing-plans --></div>
			</form>
			</div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>