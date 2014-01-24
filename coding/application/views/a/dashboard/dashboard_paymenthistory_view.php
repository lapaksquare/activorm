<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Business</h1>
				<span class="page-subtitle">You must fill the form cause it's very important.</span>
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<?php /*
					<div class="box">
						<div class="box-header">
							<h2 class="box-title">Billing Summary</h2>
						</div>

						<div class="row">
							<div class="col-xs-4">
								<strong>Minimum Spend</strong><br />
								IDR 1.000.000,-
							</div>
							<div class="col-xs-4">
								<strong>Maximum Spend</strong><br />
								IDR 5.000.000,-
							</div>
							<div class="col-xs-4">
								<strong>Total Spend</strong><br />
								IDR 10.000.000,-
							</div>
						</div>
					<!-- .box --></div> */ ?>

					<div class="box">
						<div class="row box-header">
							<div class="col-xs-8">
								<?php /*
								<form class="transaction-select" action="#" method="get">
									<label for="month" class="pull-left">Month:</label>
									<select name="month" class="custom-select dark-select small-select">
										<option value="01">January 2013</option>
										<option value="02">February 2013</option>
										<option value="03">March 2013</option>
										<option value="04">April 2013</option>
										<option value="05">May 2013</option>
										<option value="06">June 2013</option>
										<option value="07">July 2013</option>
										<option value="08">August 2013</option>
										<option value="09">September 2013</option>
										<option value="10">October 2013</option>
										<option value="11">November 2013</option>
										<option value="12">December 2013</option>
									</select>
								</form> */ ?>
							</div>
							<div class="col-xs-4">
								<strong class="pull-right">All currency in IDR</strong>
							</div>
						</div>

						<div class="table-responsive">
							<table class="table table-activorm">
								<thead>
									<tr>
										<th>Transaction No.</th>
										<th>Status</th>
										<th>Total</th>
									</tr>
								</thead>
								
								<tbody>
									<?php 
									$total = 0;
									foreach($payment_history as $k=>$v){ 
										$total += $v->order_total_price;
									?>
									<tr>
										<td><a href="<?php echo base_url(); ?>dashboard/paymenthistory?oid=<?php echo $v->order_barcode; ?>&h=<?php echo sha1($v->order_barcode . SALT); ?>"><?php echo strtoupper($v->order_barcode); ?></a></td>
										<td><?php echo ucfirst($v->order_status); ?></td>
										<td>IDR <?php echo number_format($v->order_total_price, 2, ",", "."); ?></td>
									</tr>
									<?php } ?>
								</tbody>
								
								<tfoot>
									<tr>
										<td class="cspan">Total</td>
										<td></td>
										<td>IDR <?php echo number_format($total, 2, ",", "."); ?></td>
									</tr>
								</tfoot>
								
							</table>
						</div>
					<!-- .box --></div>

					
					
					<?php if (!empty($order_cart)){ ?>
					<div class="box">
						<div class="row box-header">
							<div class="col-xs-9">
								<h2 class="box-title">Transaction # <?php echo strtoupper($order_cart->order_barcode); ?></h2>
							</div>
							<?php /*
							<div class="col-xs-3">
								<a class="pull-right btn btn-blue" href="#">Download PDF</a>
							</div> */ ?>
						</div>

						<ul class="list-unstyled list-details">
							
							<?php /*
							<li class="row">
								<div class="col-xs-5">
									<strong>Campaign Title</strong>
								</div>
								<div class="col-xs-7">
									<strong>:</strong> Win a Macbook Pro
								</div>
							</li> */ ?>
							
							<li class="row">
								<div class="col-xs-5">
									<strong>Business</strong>
								</div>
								<div class="col-xs-7">
									<strong>:</strong> <?php echo ucwords($order_cart->account_name); ?>
								</div>
							</li>
							<li class="row">
								<div class="col-xs-5">
									<strong>Invoice Date</strong>
								</div>
								<div class="col-xs-7">
									<strong>:</strong> <?php echo date('d M Y, H:i', strtotime($order_cart->order_datetime)); ?>
								</div>
							</li>
							<li class="row">
								<div class="col-xs-5">
									<strong>Total Payment</strong>
								</div>
								<div class="col-xs-7">
									<strong>:</strong> IDR <?php echo number_format($order_cart->order_total_price, 2, ",", "."); ?>
								</div>
							</li>
							<li class="row">
								<div class="col-xs-5">
									<strong>Payment Method</strong>
								</div>
								<div class="col-xs-7">
									<strong>:</strong> <?php echo strtoupper($order_cart->payment_type); ?>
								</div>
							</li>
							<li class="row">
								<div class="col-xs-5">
									<strong>Status</strong>
								</div>
								<div class="col-xs-7">
									<strong>:</strong> <?php echo strtoupper($order_cart->order_status); ?>
								</div>
							</li>
						<!-- .transaction-details --></ul>

						<div class="table-responsive">
							<table class="table table-activorm">
								<thead>
									<tr>
										<th width="35%">Item</th>
										<th width="35%">Quantity</th>
										<th width="65%">Total</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($order_cart_detail as $k=>$v){ ?>
									<tr>
										<td><?php echo $v->order_name; ?></td>
										<td><?php echo $v->order_qty; ?></td>
										<td>IDR <?php echo number_format($v->order_total_price, 2, ",", "."); ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					<!-- .box --></div> 
				
				<?php } ?>


				<!-- #content --></div>

				<?php $this->load->view('a/dashboard/dashboard_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>