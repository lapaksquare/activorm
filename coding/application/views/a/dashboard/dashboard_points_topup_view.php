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
							<h2 class="box-title">Your Point Balance Now <span class="green">1000 Points</span></h2>
						<!-- .box --></div>

						<div class="box">
							<div class="box-header">
								<h2 class="box-title title-light">Pick one of the amount below</h2>
							</div>

							<div class="table-responsive">
								<table class="table table-activorm">
									<thead>
										<tr>
											<th width="20%">Points</th>
											<th class="table-darker" width="25%">Price</th>
											<th width="25%">Period</th>
											<th class="table-darker" width="30%">Quantity</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>200</td>
											<td	class="table-darker">200.000</td>
											<td>1 Month</td>
											<td class="table-darker"><input type="text" name="quantity-200" placeholder="" class="form-control input-sm input-nr"></td>
										</tr>
										<tr>
											<td>500 <small>free + 25 points</small></td>
											<td class="table-darker">500.000</td>
											<td>2 Month</td>
											<td class="table-darker"><input type="text" name="quantity-500" placeholder="" class="form-control input-sm input-nr"></td>
										</tr>
										<tr>
											<td>1000 <small>free + 100 points</small></td>
											<td class="table-darker">1.000.000</td>
											<td>3 Month</td>
											<td class="table-darker"><input type="text" name="quantity-1000" placeholder="" class="form-control input-sm input-nr"></td>
										</tr>
									</tbody>
								</table>
							</div>

							<a data-toggle="modal" class="btn btn-block btn-blue more-topup" href="#modal-topup">Need more points than listed above?</a>

							<ul class="list-unstyled list-details">
								<li class="row">
									<div class="col-xs-5">
										Total Amount:
									</div>
									<div class="col-xs-7">
										<span class="pull-right">2.000.000</span>
									</div>
								</li>
								<li class="row">
									<div class="col-xs-5">
										Service Charge 5%:
									</div>
									<div class="col-xs-7">
										<span class="pull-right">100.000</span>
									</div>
								</li>
								<li class="row">
									<div class="col-xs-5">
										Government Tax 10%:
									</div>
									<div class="col-xs-7">
										<span class="pull-right">200.000</span>
									</div>
								</li>
								<li class="row list-total">
									<div class="col-xs-5">
										<strong>Total Payment:</strong>
									</div>
									<div class="col-xs-7">
										<span class="pull-right"><strong class="green">2.300.000</strong></span>
									</div>
								</li>
							<!-- .transaction-details --></ul>

							<div class="topup-payment">
								<strong>Choose Payment Method</strong>
								Transfer Bank:
								<div class="topup-bank">
									<img src="<?php echo cdn_url(); ?>img/bank-mandiri.gif" alt="mandiri" />
									<img src="<?php echo cdn_url(); ?>img/bank-bca.gif" alt="bca" />
								</div>
							</div>

							<div class="clearfix">
								<button type="submit" class="btn btn-green pull-right">Continue</button>
							</div>
						<!-- .box --></div>
					</form>

				<!-- #content --></div>

				<?php $this->load->view('a/dashboard/dashboard_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>