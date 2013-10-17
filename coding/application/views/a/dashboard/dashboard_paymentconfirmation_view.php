<?php $this->load->view('a/general/header_view', $this->data); ?>

	<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Business</h1>
				<span class="page-subtitle">You must fill the form cause it's very important.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<form action="#" method="get">
						<div class="box">
							<div class="box-header">
								<h2 class="box-title">Payment Confirmation</h2>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<div class="form-label">
										<label for="transaction-date">Payment Date</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-xs-4">
												<select name="transaction-date" class="custom-select light-select select-date">
													<option>Date</option>
													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
													<option>6</option>
													<option>7</option>
													<option>8</option>
													<option>9</option>
													<option>10</option>
												</select>
											</div>
											<div class="col-xs-4">
												<select name="transaction-month" class="custom-select light-select select-month">
													<option>Month</option>
													<option>Jan</option>
													<option>Feb</option>
													<option>Mar</option>
													<option>Apr</option>
													<option>May</option>
													<option>Jun</option>
													<option>Jul</option>
													<option>Aug</option>
													<option>Sep</option>
													<option>Oct</option>
													<option>Nov</option>
													<option>Dec</option>
												</select>
											</div>
											<div class="col-xs-4">
												<select name="transaction-year" class="custom-select light-select select-year">
													<option>Year</option>
													<option>2010</option>
													<option>2011</option>
													<option>2012</option>
													<option>2013</option>
													<option>2014</option>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="col-sm-6 col-sm-offset-6 col-sm-pull-6">
									<div class="form-label">
										<label for="transaction-number">Transaction Number</label>
									</div>
									<div class="form-group clearfix">
										<select name="transaction-number" class="custom-select light-select transaction-number">
											<option>14512121548</option>
											<option>14518415215</option>
											<option>14508454567</option>
											<option>14508411215</option>
										</select>
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="transaction-amount">Amount</label>
									</div>
									<div class="form-group">
										<input type="text" name="transaction-amount" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="transaction-bank">Payment to Bank</label>
									</div>
									<div class="form-group">
										<select name="transaction-bank" class="custom-select light-select transaction-bank">
											<option>BCA</option>
											<option>BNI</option>
											<option>BRI</option>
											<option>CIMB Niaga</option>
											<option>Mandiri</option>
										</select>
									</div>
								</div>
							</div>
						<!-- .box --></div>

						<div class="box">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-label">
										<label for="sender-bank">From Bank</label>
									</div>
									<div class="form-group">
										<input type="text" name="sender-bank" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6 col-sm-offset-6 col-sm-pull-6">
									<div class="form-label">
										<label for="sender-name">Account Holder Name</label>
									</div>
									<div class="form-group">
										<input type="text" name="sender-name" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-label">
										<label for="sender-account">Account Number</label>
									</div>
									<div class="form-group">
										<input type="text" name="sender-account" placeholder="" class="form-control form-light" />
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group clearfix" style="margin:40px 0 0;">
										<button type="submit" class="btn btn-big btn-green pull-right">Continue</button>
									</div>
								</div>
							</div>
						<!-- .box --></div>
					</form>

				<!-- #content --></div>

				<?php $this->load->view('a/dashboard/dashboard_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>