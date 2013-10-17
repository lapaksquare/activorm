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
							<h2 class="box-title title-light">Gender &amp; Age <i class="icon-lock"></i></h2>
						</div>

						<div id="chart-genderage"></div>
					<!-- .box --></div>

					<div class="box">
						<div class="box-header">
							<h2 class="box-title title-light">Geography <i class="icon-lock"></i></h2>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="table-responsive">
									<table class="table table-activorm table-align-alt">
										<thead>
											<tr>
												<th width="60%">Provinsi</th>
												<th width="40%">Views</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Jawa Barat</td>
												<td>5582</td>
											</tr>
											<tr>
												<td>Sumatera Utara</td>
												<td>995</td>
											</tr>
											<tr>
												<td>Kalimantan Selatan</td>
												<td>45</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="table-responsive">
									<table class="table table-activorm table-align-alt">
										<thead>
											<tr>
												<th width="60%">City</th>
												<th width="40%">Views</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Jakarta</td>
												<td>9554</td>
											</tr>
											<tr>
												<td>Bandung</td>
												<td>4528</td>
											</tr>
											<tr>
												<td>Medan</td>
												<td>955</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					<!-- .box --></div>

					<div class="box">
						<div class="box-header">
							<h2 class="box-title title-light">Interest <i class="icon-lock"></i></h2>
						</div>

						<div class="table-responsive">
							<table class="table table-activorm table-align-alt">
								<thead>
									<tr>
										<th width="75%">Interest</th>
										<th width="25%">Views</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Sepak Bola</td>
										<td>2318</td>
									</tr>
									<tr>
										<td>Basket</td>
										<td>1882</td>
									</tr>
									<tr>
										<td>Renang</td>
										<td>95</td>
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