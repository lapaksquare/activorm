<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Email Invitation</title>

	
</head>
<body style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;color: #4c4c4d;font-size: 16px;font-family: &quot;Myriad Pro&quot;, Arial, Helvetica, sans-serif;line-height: 1.6;background: #fff;width: 100%;">

<table id="table-background" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
	<tr>
		<td align="center" style="border-collapse: collapse;">
        	<table class="table-main" width="600" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin: 50px 0;">
				<thead class="header">
					<tr>
						<td class="container" style="border-collapse: collapse;padding: 15px 40px;color: #fff;font-size: 14px;background: #34495c;border-top-left-radius: 10px;border-top-right-radius: 10px;">
							<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
								<tr>
									<td width="300" style="border-collapse: collapse;color: #fff;font-size: 14px;">
										<a href="#" style="color: #20b396;">
											<img class="image_fix" src="<?php echo cdn_url(); ?>img/email/img/logo.png" alt="activorm" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;border: none;display: block;">
										</a>
									</td>
									<td width="220" align="right" style="border-collapse: collapse;color: #fff;font-size: 14px;">
										<?php echo date("l, d M Y"); ?>									</td>
								</tr>
							</table>
						</td>
					</tr>
				</thead>


				<tbody class="main">
	                <tr>
						<td class="container" style="border-collapse: collapse;padding: 0 40px;">
							<table class="section" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin-bottom: 20px;">
								<tr>
									<td style="border-collapse: collapse;">
										<div class="content" style="margin: 0 -40px;padding: 10px 40px 10px;text-align: left;background: #fff;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
											<h1 class="content-title" style="margin: 20px 0;padding: 0 0 10px;font-size: 24px;line-height: 1.2;border-bottom: 1px solid #e8e8e8;color: #555555;">Congratulations! Here is your Activorm Private Beta Invitation</h1>
											<p style="margin: 1em 0;"><strong>Hello!</strong></p>
											<p style="margin: 1em 0;">This is an <?php echo $special_text; ?> to private beta testing of Activorm. Thanks for your patience in waiting. Activorm is a platform for people to win prizes from their favorite brands. Simply follow 3 actions in the projects to enter prize draws.</p>
											<p style="margin: 1em 0;">During Private Beta, you can win prizes from <?php foreach($merchants as $k=>$v){echo ucwords($v->business_name); ?><?php if ($k != count($merchants)-1){ echo ($k == count($merchants)-2) ? " and " : ', '; } ?><?php echo ($k == count($merchants)-1) ? "." : ''; ?>
			<?php } ?>
			</p>

																						<table class="prize" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;margin: 30px -5px 20px;">
													<?php $c = 0; foreach($product_prize as $k=>$v){ ?>
															
													<?php 
													if ($c == 4){
														$c = 0;
														echo '</tr>';
													}
													if ($c == 0){
														echo '<tr>';
													}
													
													//$photo = 'images/email/email-prize-'.$v->business_uri.'.jpg';
													//if (!is_file($photo)) continue;
													$photo = $v->prize_primary_photo;
													$photo = $this->mediamanager->getPhotoUrl($photo, "110x126");
													
													?>												
																										
													<td style="border-collapse: collapse;width: 25%;padding: 5px 5px 15px;text-align: center;">
														<div class="prize-logo" style="width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;background: #fff;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $v->business_name; ?>" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #4c4c4d;font-size: 10px;line-height: 1.4;"><?php echo ucwords($v->prize_name); ?> <br /><b><?php echo ucwords($v->business_name); ?></b></p>
                                                    </td>
													
													
													<?php $c++; } 
													
													if ($c == 4){
														$c = 0;
														echo '</tr>';
													}
													
													?>
																									
													<?php /*													
													<td style="border-collapse: collapse;width: 25%;padding: 5px 5px 15px;text-align: center;">
														<div class="prize-logo" style="width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;background: #fff;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/email/email-prize-espa_110x126.jpg" alt="ESPA" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #4c4c4d;font-size: 10px;line-height: 1.4;">BABOR Skinovage Facial <br><b>ESPA</b></p>
                                                    </td>
													
																									
																										
													<td style="border-collapse: collapse;width: 25%;padding: 5px 5px 15px;text-align: center;">
														<div class="prize-logo" style="width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;background: #fff;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/email/email-prize-lolabox_110x126.jpg" alt="Lolabox" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #4c4c4d;font-size: 10px;line-height: 1.4;">Front Cover Makeup Kit <br><b>Lolabox</b></p>
                                                    </td>
													
																									
																										
													<td style="border-collapse: collapse;width: 25%;padding: 5px 5px 15px;text-align: center;">
														<div class="prize-logo" style="width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;background: #fff;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/email/email-prize-sens-event-organizer_110x126.jpg" alt="SENS Event Organizer" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #4c4c4d;font-size: 10px;line-height: 1.4;">Gift Voucher IDR 2.5M <br><b>SENS Event Organizer</b></p>
                                                    </td>
													
																									
													</tr><tr>													
													<td style="border-collapse: collapse;width: 25%;padding: 5px 5px 15px;text-align: center;">
														div class="prize-logo">
															<span><img src="http://activorm.com/images/email/email-prize-kipaskudingin_110x126.jpg" alt="Kipaskudingin" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</td></tr></table></div>
														<p style="margin: 1em 0;">Shopping Voucher IDR 150K <br><b>Kipaskudingin</b></p>
                                                    </td>
													
																									
																										
													<td style="border-collapse: collapse;">
														<div class="prize-logo" style="width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;background: #fff;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/email/email-prize-fashion-epicentrum_110x126.jpg" alt="Fashion Epicentrum" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 1em 0;">Shopping Voucher 150K <br><b>Fashion Epicentrum</b></p>
                                                    </td>
													
																									
																										
													<td style="border-collapse: collapse;">
														<div class="prize-logo" style="width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;background: #fff;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/email/email-prize-hanny-ps_110x126.jpg" alt="Hanny PS" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 1em 0;">Ray Ban Classic Aviator <br><b>Hanny PS</b></p>
                                                    </td>
													
																									
																										
													<td style="border-collapse: collapse;">
														<div class="prize-logo" style="width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;background: #fff;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/email/email-prize-orderlagi_110x126.jpg" alt="ORDERLAGI" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 1em 0;">Powerbank VIVAN 2200mAh <br><b>ORDERLAGI</b></p>
                                                    </td>
													
												</tr>		*/ ?>										
																							</table>
											
											<p style="margin: 1em 0;">At the moment, we serve only for desktop site. Mobile apps are coming soon. Please note that Activorm is still in development stage, and we appreciate your understanding when you encounter bugs or other issues. We're looking forward to hear all feedbacks and excitements about our website. Help us create a better Activorm for everyone to enjoy by reporting them at <a href="http://www.activorm.com/report/bug" style="color: #20b396;">www.activorm.com/report/bug</a></p>
											<p style="margin: 1em 0;"><strong>Good Luck!</strong></p>
											<p class="signup" style="margin: 40px 0 -60px;"><a class="button" href="http://activorm.com/ajax/signup_invitation?email=<?php echo $email; ?>&hash=<?php echo $email_hash; ?>" style="color: #fff;padding: 10px 30px;display: inline-block;font-size: 18px;font-weight: bold;text-decoration: none;background: #20b396;border-bottom: 2px solid #1fa88c;border-radius: 5px;">Sign Me Up Now!</a></p>
										
									</td>
								</tr>
							</table>
						</td>
					</tr>

	                <tr>
						<td class="container" style="border-collapse: collapse;padding: 15px 40px;">
							<table class="section" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin-bottom: 20px;">
								<tr>
									<td style="border-collapse: collapse;">
										<div class="sponsor" style="margin: 0 -45px;">
											<h2 class="sponsor-title" style="margin: 0 0 15px;color: #555555;font-size: 12px;text-align: center;">Powered by:</h2>
											<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
												
												
													<?php $c = 0; foreach($merchants as $k=>$v){
													?>
													
													<?php 
													
													if ($c == 4){
														$c = 0;
														echo '</tr>';
													}
													if ($c == 0){
														echo '<tr>';
													}
													
													$photo = 'images/merchant/email-logo-'.$v->business_uri.'.png';
													if (!is_file($photo)) continue;
													$photo = $this->mediamanager->getPhotoUrl($photo, "140x95");
													?>
																									
													
													<td style="padding: 5px 10px 15px;border-collapse: collapse;width: 25%;text-align: center;">
														<div class="sponsor-logo" style="background: none;width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $v->business_name; ?>" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #a3a3a3;font-size: 12px;line-height: 1.4;"><?php echo ucwords($v->business_name); ?></p>
                                                    </td>
                                                    
                                                   	<?php $c++; } 
													
													if ($c == 4){
														$c = 0;
														echo '</tr>';
													}
													
													?> 												
																										
																									
													<?php /*
													<td style="padding: 5px 10px 15px;border-collapse: collapse;width: 25%;text-align: center;">
														<div class="sponsor-logo" style="background: none;width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/merchant/email-logo-espa_140x95.png" alt="ESPA" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #a3a3a3;font-size: 12px;line-height: 1.4;">ESPA</p>
                                                    </td>
                                                    
                                                    												
																										
																									
													
													<td style="padding: 5px 10px 15px;border-collapse: collapse;width: 25%;text-align: center;">
														<div class="sponsor-logo" style="background: none;width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/merchant/email-logo-fashion-epicentrum_140x95.png" alt="Fashion Epicentrum" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #a3a3a3;font-size: 12px;line-height: 1.4;">Fashion Epicentrum</p>
                                                    </td>
                                                    
                                                    												
																										
																									
													
													<td style="padding: 5px 10px 15px;border-collapse: collapse;width: 25%;text-align: center;">
														<div class="sponsor-logo" style="background: none;width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/merchant/email-logo-hanny-ps_140x95.png" alt="Hanny PS" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #a3a3a3;font-size: 12px;line-height: 1.4;">Hanny PS</p>
                                                    </td>
                                                    
                                                    												
																										
													</tr><tr>												
													
													<td style="padding: 5px 10px 15px;border-collapse: collapse;width: 25%;text-align: center;">
														<div class="sponsor-logo" style="background: none;width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/merchant/email-logo-kipaskudingin_140x95.png" alt="Kipaskudingin" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #a3a3a3;font-size: 12px;line-height: 1.4;">Kipaskudingin</p>
                                                    </td>
                                                    
                                                    												
																										
																									
													
													<td style="padding: 5px 10px 15px;border-collapse: collapse;width: 25%;text-align: center;">
														<div class="sponsor-logo" style="background: none;width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/merchant/email-logo-lolabox_140x95.png" alt="Lolabox" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #a3a3a3;font-size: 12px;line-height: 1.4;">Lolabox</p>
                                                    </td>
                                                    
                                                    												
																										
																									
													
													<td style="padding: 5px 10px 15px;border-collapse: collapse;width: 25%;text-align: center;">
														<div class="sponsor-logo" style="background: none;width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/merchant/email-logo-orderlagi_140x95.png" alt="ORDERLAGI" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #a3a3a3;font-size: 12px;line-height: 1.4;">ORDERLAGI</p>
                                                    </td>
                                                    
                                                    												
																										
																									
													
													<td style="padding: 5px 10px 15px;border-collapse: collapse;width: 25%;text-align: center;">
														<div class="sponsor-logo" style="background: none;width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/merchant/email-logo-sens-event-organizer_140x95.png" alt="SENS Event Organizer" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #a3a3a3;font-size: 12px;line-height: 1.4;">SENS Event Organizer</p>
                                                    </td>
                                                    
                                                    												
													</tr>		*/ ?>											
											</table>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					</tbody>
					
					
					<tfoot class="footer footer-dark" style="text-align: center;">
					<tr>
						<td class="container" style="border-collapse: collapse;padding: 20px;color: #fff;font-size: 12px;background: #34495c;border-top-left-radius: 10px;border-top-right-radius: 10px;">
							&copy; 2013 Activorm. All rights reserved.<br>
							Jl. Senopati 75, Graha Tirtadi lt.1, Jakarta Selatan, 12110
						</td>
					</tr>
				</tfoot>
					
				</table>
			
				

</body>
</html>