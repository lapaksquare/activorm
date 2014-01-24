<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Invoice #<?php echo strtoupper($order_cart->order_barcode); ?></title>

	
</head>
<body style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;color: #000;font-size: 16px;font-family: 'Myriad Pro', Arial, Helvetica, sans-serif;line-height: 1.4;background: #fff url(<?php echo cdn_url(); ?>img/bar.png) repeat-x 50% 0;width: 100%;">

<table id="table-background" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
	<tr>
		<td align="center" style="border-collapse: collapse;">
        	<table class="table-main" width="760" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin: 80px 0;text-align: left;">
				<thead class="header">
					<tr>
						<td colspan="3" class="container" style="border-collapse: collapse;width: 760px;margin: 0 auto;">
							<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
								<tr>
									<td width="500" style="border-collapse: collapse;">
										<h1 class="invoice-title" style="margin: -25px 0 0;font-size: 30px;text-transform: uppercase;color: #000;">Invoice</h1>
										<span class="invoice-date" style="padding: 4px 0 0;display: inline-block;font-size: 14px;border-top: 1px solid #232323;"><?php echo date("l, d M Y"); ?></span>
									</td>
									<td width="260" style="border-collapse: collapse;">
										<img class="image_fix" src="<?php echo cdn_url(); ?>img/logo_invoice.png" alt="activorm" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;display: block;">
										<address class="invoice-address" style="margin: 10px 0 0;font-size: 14px;font-style: normal;">
											Graha Tirtadi lantai 1, Jl. Senopati no. 75<br>
											Jakarta Selatan 12110
										</address>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</thead>

				<tbody class="main">
	                <tr>
						<td class="container" style="border-collapse: collapse;width: 760px;margin: 0 auto;padding: 60px 0 0;">
							<table class="section invoice-client" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
								<tr>
									<td style="border-collapse: collapse;padding: 0 0 8px;">
										<h2 class="subtitle" style="margin: 0;font-size: 18px;color: #000;">Bill To</h2>
									</td>
								</tr>
								
								<?php /*
								<tr>
									<td style="border-collapse: collapse;padding: 0 0 8px;">
										Account: <strong>283.644.279</strong>
									</td>
								</tr> */ ?>
								<tr>
									<td style="border-collapse: collapse;padding: 0 0 8px;">
										Business: <strong><?php echo ucwords($order_cart->account_name); ?></strong>
									</td>
								</tr>
								<tr>
									<td style="border-collapse: collapse;padding: 0 0 8px;">
										<?php echo ucfirst($order_cart->account_address); ?>
									</td>
								</tr>
								<?php /*
								<tr>
									<td style="border-collapse: collapse;padding: 0 0 8px;">
										Invoice # FBADS-081-000072482
									</td>
								</tr> */ ?>
							</table>
						</td>
	                </tr>

	                <tr>
						<td class="container" style="border-collapse: collapse;width: 760px;margin: 0 auto;padding: 60px 0 0;">
							<table class="section invoice-details" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
								<tr>
									<td style="border-collapse: collapse;">
										<h2 class="subtitle" style="margin: 0;font-size: 18px;color: #000;">Transaction #<?php echo strtoupper($order_cart->order_barcode); ?></h2>
									</td>
								</tr>
								<tr>
									<td style="border-collapse: collapse;">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin-top: 5px;">
											
											<?php /*
											<tr>
												<td width="30%" style="border-collapse: collapse;padding: 10px 0;border-bottom: 1px dashed #b3b3b3;">Campaign Title</td>
												<td width="70%" style="border-collapse: collapse;padding: 10px 0;border-bottom: 1px dashed #b3b3b3;"><span style="margin-right: 5px;">:</span> Win a Macbook Pro</td>
											</tr> */ ?>
											<tr>
												<td style="border-collapse: collapse;padding: 10px 0;border-bottom: 1px dashed #b3b3b3;">Businesss</td>
												<td style="border-collapse: collapse;padding: 10px 0;border-bottom: 1px dashed #b3b3b3;"><span style="margin-right: 5px;">:</span> <?php echo ucwords($order_cart->account_name); ?></td>
											</tr>
											<tr>
												<td style="border-collapse: collapse;padding: 10px 0;border-bottom: 1px dashed #b3b3b3;">Invoice Date</td>
												<td style="border-collapse: collapse;padding: 10px 0;border-bottom: 1px dashed #b3b3b3;"><span style="margin-right: 5px;">:</span> <?php echo date('d M Y, H:i', strtotime($order_cart->order_datetime)); ?></td>
											</tr>
											<tr>
												<td style="border-collapse: collapse;padding: 10px 0;border-bottom: 1px dashed #b3b3b3;">Total Payment</td>
												<td style="border-collapse: collapse;padding: 10px 0;border-bottom: 1px dashed #b3b3b3;"><span style="margin-right: 5px;">:</span> IDR <?php echo number_format($order_cart->order_total_price, 2, ",", "."); ?></td>
											</tr>
											<?php if (!empty($order_cart->payment_type)){ ?>
											<tr>
												<td style="border-collapse: collapse;padding: 10px 0;border-bottom: 1px dashed #b3b3b3;">Payment Method</td>
												<td style="border-collapse: collapse;padding: 10px 0;border-bottom: 1px dashed #b3b3b3;"><span style="margin-right: 5px;">:</span> <?php echo strtoupper($order_cart->payment_type); ?></td>
											</tr>
											<?php } ?>
											<tr>
												<td style="border-collapse: collapse;padding: 10px 0;border-bottom: 1px dashed #b3b3b3;">Status</td>
												<td style="border-collapse: collapse;padding: 10px 0;border-bottom: 1px dashed #b3b3b3;"><span style="margin-right: 5px;">:</span> <?php echo strtoupper($order_cart->order_status); ?></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
	                </tr>

	                <tr>
						<td class="container" style="border-collapse: collapse;width: 760px;margin: 0 auto;padding: 60px 0 0;">
							<table class="section invoice-activity" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
								<tr>
									<td style="border-collapse: collapse;">
										<h2 class="subtitle" style="margin: 0;font-size: 18px;color: #000;">Detail Activity</h2>
									</td>
								</tr>
								<tr>
									<td style="border-collapse: collapse;">
										<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin-top: 20px;">
											<tr>
												<th width="30%" style="padding: 15px 0;text-align: center;border-right: 1px solid #000;border-bottom: 1px solid #000;background: #eef3f5;">Item</th>
												<th width="30%" style="padding: 15px 0;text-align: center;border-right: 1px solid #000;border-bottom: 1px solid #000;background: #eef3f5;">Quantity</th>
												<th width="70%" style="padding: 15px 0;text-align: center;border-right: 1px solid #000;border-bottom: 1px solid #000;background: #eef3f5;">Price</th>
											</tr>
											
											<?php 
											$total_amount = 0;
											foreach($order_cart_detail as $k=>$v){ 
												
												$total_amount += $v->order_total_price;
												?>
											<tr>
												<td style="border-collapse: collapse;padding: 15px 0;text-align: center;border-right: 1px solid #000;border-bottom: 1px solid #000;"><?php echo $v->order_name; ?></td>
												<td style="border-collapse: collapse;padding: 15px 0;text-align: center;border-right: 1px solid #000;border-bottom: 1px solid #000;"><?php echo $v->order_qty; ?></td>
												<td style="border-collapse: collapse;padding: 15px 0;text-align: center;border-right: 1px solid #000;border-bottom: 1px solid #000;">IDR <?php echo number_format($v->order_total_price, 2, ",", "."); ?></td>
											</tr>
											<?php } ?>
											
											<tr>
												<td colspan="2" style="border-collapse: collapse;padding: 8px 20px;text-align: right;border-right: 1px solid #000;border-bottom: 1px solid #000;font-size:13px;"><b>Total Amount:</b></td>
												<td style="border-collapse: collapse;padding: 8px 20px;text-align: center;border-right: 1px solid #000;border-bottom: 1px solid #000;font-size:13px;"><b>IDR <?php echo number_format($total_amount, 2, ",", "."); ?></b></td>
											</tr>
											<tr>
												<td colspan="2" style="border-collapse: collapse;padding: 8px 20px;text-align: right;border-right: 1px solid #000;border-bottom: 1px solid #000;font-size:13px;"><b>Service Charge 5%:</b></td>
												<td style="border-collapse: collapse;padding: 8px 20px;text-align: center;border-right: 1px solid #000;border-bottom: 1px solid #000;font-size:13px;"><b>IDR <?php echo number_format($order_cart->service_charge, 2, ",", "."); ?></b></td>
											</tr>
											<tr>
												<td colspan="2" style="border-collapse: collapse;padding: 8px 20px;text-align: right;border-right: 1px solid #000;border-bottom: 1px solid #000;font-size:13px;"><b>Government Tax 10%:</b></td>
												<td style="border-collapse: collapse;padding: 8px 20px;text-align: center;border-right: 1px solid #000;border-bottom: 1px solid #000;font-size:13px;"><b>IDR <?php echo number_format($order_cart->gov_charge, 2, ",", "."); ?></b></td>
											</tr>
											<tr>
												<td colspan="2" style="border-collapse: collapse;padding: 8px 20px;text-align: right;border-right: 1px solid #000;border-bottom: 1px solid #000;font-size:13px;"><b>Total Payment:</b></td>
												<td style="border-collapse: collapse;padding: 8px 20px;text-align: center;border-right: 1px solid #000;border-bottom: 1px solid #000;font-size:13px;"><b>IDR <?php echo number_format($order_cart->order_total_price, 2, ",", "."); ?></b></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<p style="margin-bottom: 0px;margin-top: 40px;">Please transfer to one of this following banks:</p>
						</td>
					</tr>
					<tr>
						<td style="border-collapse: collapse;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin-top: 20px;">
								<tr>
									<td>
										<img src="<?php echo cdn_url(); ?>img/bank-mandiri.gif" alt="mandiri" /><br />
										<b>Nama Bank : BANK CENTRAL ASIA (BCA)</b><br />
										Cabang Bank : BCA<br />
										No. Rekening : BCA<br />
										Nama Rekening : BCA<br />
										Di kolom "Berita" cantumkan No. Order: BCA <br />
									</td>
									<td>
										<img src="<?php echo cdn_url(); ?>img/bank-bca.gif" alt="bca" /><br />
										<b>Nama Bank : BANK MANDIRI</b><br />
										Cabang Bank : MANDIRI<br />
										No. Rekening : MANDIRI<br />
										Nama Rekening : MANDIRI<br />
										Di kolom "Berita" cantumkan No. Order: MANDIRI <br />
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<p style="margin-bottom: 0px;margin-top: 40px;">Please complete payment in 2x24 hours via bank transfer and confirm the payment.</p>
						</td>
					</tr>
				</tbody></table>
			</td>
		</tr>
</table>
</body>
</html>