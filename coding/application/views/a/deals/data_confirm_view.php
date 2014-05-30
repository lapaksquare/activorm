<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="block block-light">
			<div class="container">

				<ol class="breadcrumb">
					<li><a href="##">All Deals</a></li>
					<li><a href="##">Deals Name</a></li>
					<li class="active">Data Confirm</li>
				</ol>
				
				<div class="row" >
					<div id="content" class="col-md-9" style="margin:0 auto;float:none;">

						<div class="box dashboard-projects">
							<div class="box-header">
								<h2 class="box-title title-light">Lorem</h2>
							</div>
	
							<div class="table-responsive" style="padding-bottom:20px;border-bottom: 1px dashed #e8e8e8;">
								<table class="table table-activorm" id="dashboard_data_confirm">
									<thead>
										<tr>
											<th width="35%">Product Name</th>
											<th width="25%">Amount</th>
											<th width="20%">Price</th>
											<th width="20%">Total</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Vintage Shoes Roxxor</td>
											<td>
												<select name="" class="form-control">
													<option value="1">1</option>
												</select>
											</td>
											<td>125.000</td>
											<td>125.000</td>
										</tr>
										<tr>
											<td colspan="3" style="text-align:right;font-size:18px;font-weight:normal;background-color:#e8e9ea;border-right:1px solid #e8e9ea;">Total Amount:</td>
											<td style="background-color:#e8e9ea;"><span class="total-amount" style="text-decoration:underline;color:#23b496;font-size:20px;font-weight: bold;">125.000</span></td>
										</tr>
									</tbody>
								</table>
							</div>
							
							<form method="post" class="form-deals">
							
								<div class="row" style="padding:10px 0;border-bottom: 1px dashed #e8e8e8;">
									<div class="col-md-6">
										<h4 style="margin-bottom:20px;">Buyer</h4>
											<div class="form-group">
												<input type="text" name="fullname" placeholder="Full Name" class="form-control form-light" value="" />
											</div>	
											<div class="form-group">
												<input type="text" name="email" placeholder="Email" class="form-control form-light" value="" />
											</div>	
											<div class="form-group">
												<input type="text" name="mobilephone" placeholder="Mobile Phone" class="form-control form-light" value="" />
											</div>	
											<div class="form-group">
												Payment Method Tranfer Via<br />
												<img src="<?php echo cdn_url(); ?>img/bank-bca.gif" />
											</div>	
									</div>
	
									<div class="col-md-6">
										<h4 style="margin-bottom:20px;">Reciepent</h4>
											<div class="form-group">
												<input type="text" name="fullname" placeholder="Full Name" class="form-control form-light" value="" />
											</div>	
											<div class="form-group">
												<input type="text" name="email" placeholder="Email" class="form-control form-light" value="" />
											</div>	
											<div class="form-group">
												<div class="col-md-6" style="padding-left:0;">
													<select class="form-control form-light">
														<option value="1">Select Province</option>
													</select>
												</div>	
												<div class="col-md-6" style="padding-right:0;">
													<select class="form-control form-light">
														<option value="1">Select City</option>
													</select>
												</div>	
												<div class="clearfix"></div>
											</div>	
											
											<div class="form-group">
												<textarea class="form-control form-light"></textarea>
											</div>	
									</div>
								</div>
								
								<div class="pull-right">
									<div class="form-submit">
										<input type="submit" name="save_changes" value="Submit" class="btn btn-big btn-mt btn-green pull-right" />
									</div>
								</div>
								<div class="clearfix"></div>
							</form>	
							
							
						</div>
						
					</div>			
				</div>		
				
			</div>
		</div>		

<?php $this->load->view('a/general/footer_view', $this->data); ?>