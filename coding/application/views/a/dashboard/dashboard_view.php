<?php $this->load->view('a/general/header_view', $this->data); ?>

	<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Business</h1>
				<span class="page-subtitle">You must fill the form cause it's very important.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<div class="box">
						<div class="box-header">
							<h2 class="box-title title-light">Trend Prize</h2>
						</div>

						<div class="table-responsive">
							<table class="table table-activorm table-scrollable">
								<thead>
									<tr>
										<th>Prize</th>
										<th>Fans</th>
									</tr>
								</thead>
								<tbody class="scrollable-area">
									<tr>
										<td>Macbook Pro</td>
										<td>200 Fans</td>
									</tr>
									<tr>
										<td>Samsung Galaxy Tab</td>
										<td>200 Fans</td>
									</tr>
									<tr>
										<td>iPhone 5S</td>
										<td>200 Fans</td>
									</tr>
									<tr>
										<td>Kursi Kantor</td>
										<td>200 Fans</td>
									</tr>
									<tr>
										<td>Tiket Nonton</td>
										<td>200 Fans</td>
									</tr>
									<tr>
										<td>Macbook Pro</td>
										<td>200 Fans</td>
									</tr>
									<tr>
										<td>Samsung Galaxy Tab</td>
										<td>200 Fans</td>
									</tr>
									<tr>
										<td>iPhone 5S</td>
										<td>200 Fans</td>
									</tr>
									<tr>
										<td>Kursi Kantor</td>
										<td>200 Fans</td>
									</tr>
									<tr>
										<td>Tiket Nonton</td>
										<td>200 Fans</td>
									</tr>
								</tbody>
							</table>
						</div>
					<!-- .box --></div>

					<div class="box dashboard-traffic">
						<div class="box-header">
							<h2 class="box-title title-light">Traffic to Website</h2>
						</div>

						<div id="chart-traffic"></div>

						<div class="btn-group">
							<a class="btn btn-big btn-green" href="#">Daily</a>
							<a class="btn btn-big btn-blue" href="#">Weekly</a>
							<a class="btn btn-big btn-blue" href="#">Monthly</a>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div id="chart-source"></div>
								<div id="chart-type"></div>
							</div>

							<div class="col-sm-6">
								<div class="table-responsive">
									<table class="table table-activorm">
										<thead>
											<tr>
												<th>Referrer</th>
												<th>Visitor</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Facebook</td>
												<td>2820</td>
											</tr>
											<tr>
												<td>Twitter</td>
												<td>1755</td>
											</tr>
											<tr>
												<td>Pinterest</td>
												<td>254</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					<!-- .box --></div>

					<div class="box dashboard-projects">
						<div class="box-header">
							<h2 class="box-title title-light">All Projects</h2>
						</div>

						<div class="table-responsive">
							<table class="table table-activorm">
								<thead>
									<tr>
										<th width="10%">Date</th>
										<th width="40%">Project Title</th>
										<th width="10%">Views</th>
										<th width="40%">Member Join</th>
										<th width="10%">Paid</th>
										<th width="10%">Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>20/11/2013</td>
										<td><a data-toggle="modal" href="#modal-overview">Win an iPad</a></td>
										<td>200</td>
										<td>300</td>
										<td>Free</td>
										<td>Pending</td>
									</tr>
									<tr>
										<td>20/11/2013</td>
										<td><a href="#">Win a Sams...</a></td>
										<td>200</td>
										<td>300</td>
										<td>100.000</td>
										<td>Pending</td>
									</tr>
									<tr>
										<td>20/11/2013</td>
										<td><a href="#">Win an iPad</a></td>
										<td>200</td>
										<td>300</td>
										<td>100.000</td>
										<td>Pending</td>
									</tr>
								</tbody>
							</table>
						</div>
					<!-- .box --></div>
				<!-- #content --></div>

				<?php $this->load->view('a/dashboard/dashboard_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>