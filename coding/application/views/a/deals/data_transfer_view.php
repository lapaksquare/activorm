<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="row">
				<div id="content" class="col-sm-5" style="margin-left:29%;">
					
					<form class="form-activorm" action="" method="post">
						<h1 class="center-title" style="margin-bottom:8px;border-bottom:0;color:#4c4c4d;"><span style="font-weight:normal;font-size:20px;border-bottom:0;">Your Data Has been Submit!</span></h1>
						<p style="text-align:center;width:300px;margin:0 auto;font-size:14px;color:#4c4c4d;">Please, make a payment based on the following, and thank you for shopping here</p>
						
						<div class="box" style="margin-top:20px;padding:20px;">
							<h5 style="color:#969696;font-size:14px;font-weight:normal;margin:0;border-bottom: 1px dashed #e8e8e8;padding-bottom:8px;">Your Shopping</h5>
							<table class="table table-activorm table-deal-transfer" style="margin-top:10px;">
								<tbody>
									<tr>
										<td>Vintage shoes Roxxor</td>
										<td class="deal_price">IDR 125.000</td>
									</tr>
									<tr>
										<td>Total:</td>
										<td class="deal_price"><span>IDR 125.000</span></td>
									</tr>
								</tbody>
							</table>
							
							<div class="deal_tranfer_info">
								Payment Method Tranfer Via<br />
								<img src="<?php echo cdn_url(); ?>img/bank-bca.gif" /><br />
								<span>52342 23234 an activorm.com</span>
							</div>	
							
							<div class="deal_transfer_footer">
								<div class="pull-left">
									Contact
									<i>M. 0933 3434 3434</i>
								</div>
								<div class="pull-right">
									<input type="submit" name="save_changes" value="Back to All deals" class="btn btn-mt btn-green pull-right" />
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
						</div>	
						
					</form>		
					
				</div>
			</div>
			
		</div>			

<?php $this->load->view('a/general/footer_view', $this->data); ?>