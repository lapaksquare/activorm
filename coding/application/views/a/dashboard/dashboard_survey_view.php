<?php $this->load->view('a/general/header_view', $this->data); ?>

	<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Business</h1>
				<span class="page-subtitle">You must fill the form cause it's very important.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<div class="box dashboard-projects">
						<div class="box-header">
							<h2 class="box-title title-light">Survey List</h2>
						</div>

						<div class="table-responsive">
							<table class="table table-activorm">
								<thead>
									<tr>
										<th width="10%">Date</th>
										<th width="40%">Survey Title</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>20/11/2013</td>
										<td><a href="#">Lorem Ipsum sit domet uyeee</a></td>
									</tr>
									<tr>
										<td>20/11/2013</td>
										<td><a href="#">Lorem Ipsum sit domet uyeee</a></td>
									</tr>
									<tr>
										<td>20/11/2013</td>
										<td><a href="#">Lorem Ipsum sit domet uyeee</a></td>
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