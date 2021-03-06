<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Newsletter</h2>	
	
	<hr />
	
	<?php 
	$a_message_error = $this->session->userdata('a_message_error');
	if (!empty($a_message_error)){
		$this->session->unset_userdata('a_message_error');
		$m = '<li>'.implode('</li><li>', $a_message_error) . '</li>';
	?>
	<div class="bs-callout bs-callout-danger">
      <p>
      	<ul>
      		<?php echo $m; ?>
      	</ul>
      </p>
    </div>
    <?php } ?>
    
    <?php 
	$a_message_success = $this->session->userdata('a_message_success');
	if (!empty($a_message_success)){
		$this->session->unset_userdata('a_message_success');
	?>
	<div class="bs-callout bs-callout-info">
      <p>Save Successfull</p>
    </div>
    <?php } ?>
    
    <form class="form-horizontal" role="form" method="post" 
	enctype="multipart/form-data"
	action="<?php echo base_url(); ?>admin/newsletter/submit_newsletter"
	>
	  
	  <div class="form-group" id="featured_prize">
	    <label for="newsletter_target" class="col-sm-2 control-label">Target</label>
	    <div class="col-sm-10">
	      <?php 
	      $newsletter_target_array = array(
		  	'all' => 'All',
		  	'business' => 'Business',
		  	'user' => 'User',
		  	'testing' => 'Testing'
		  );
	      ?>
	      <select name="newsletter_target" class="form-control" id="newsletter_target">
			<?php 
			foreach($newsletter_target_array as $k=>$v){
				$class = (!empty($this->newsletter) && $this->newsletter->newsletter_target == $k) ? 'selected' : '';
			?>
			<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
			<?php
			}
			?>
		  </select>
		  
		  <div class="testing_email" id="testing_email" <?php if ((!empty($this->newsletter) && $this->newsletter->newsletter_target == "testing")){ ?>style="display:block;" <?php }else{ ?> style="display:none;" <?php } ?>>
		  	<input type="text" class="form-control" id="testing_email_input" name="testing_email_input" 
	      	value="<?php echo (!empty($this->newsletter)) ? $this->newsletter->newsletter_testing_email : ""; ?>" placeholder="Your Email" />
		  </div>
		  
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="newsletter_subject" class="col-sm-2 control-label">Newsletter Subject</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control description_limiter" id="newsletter_subject" name="newsletter_subject" 
	      value="<?php echo (!empty($this->newsletter)) ? $this->newsletter->newsletter_subject : ""; ?>" 
	      autocomplete="off"
	      />
	      <p class="help-block" id="counter_description"><span>140</span> characters</p>
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="newsletter_body" class="col-sm-2 control-label">Newsletter Body</label>
	    <div class="col-sm-10">
	      <?php 
	      
	      $utm = array(
		  	'utm_source' => 'newsletter',
		  	'utm_medium' => 'email',
		  	'utm_campaign' => 'campaign name'
		  );
		  $utm_query = http_build_query($utm);
	      /*
	      $newsletter_tmpl = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title></title>

	
</head>
<body style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;color: #4c4c4d;font-size: 16px;font-family:Arial, Helvetica, sans-serif;line-height: 1.6;background: #fff;width: 100%;">

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
										<a href="http://activorm.com?'.$utm_query.'" style="color: #20b396;">
											<img class="image_fix" src="http://activorm.com/img/email/img/logo.png" alt="activorm" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;border: none;display: block;">
										</a>
									</td>
									<td width="330" align="right" style="border-collapse: collapse;color: #fff;font-size: 14px;">
									 Mondday, 27 Jan 2014									</td>
								</tr>
							</table>
						</td>
					</tr>
				</thead>


				<tbody class="main">
	                <tr>
						<td class="container" style="border-collapse: collapse;padding: 0 40px;">
							<table class="section" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin-bottom: 70px;">
								<tr>
									<td style="border-collapse: collapse;">
										<div class="content" style="margin: 0 -40px;padding: 10px 40px 10px;text-align: left;background: #fff;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
											<h1 class="content-title" style="margin: 20px 0;padding: 0 0 10px;font-size: 24px;line-height: 1.2;border-bottom: 1px solid #e8e8e8;color: #555555;">Alfabet Varsity Jacket, 100K Voucher Spa & Reflexiology, and Durian Pancake</h1>
											<p style="margin: 1em 0;"><strong>Monday? No worries!</strong></p>
											<p style="margin: 1em 0;"><em>Apabila Newsletter ini masuk ke folder spam, mohon pastikan Activorm dimasukkan ke dalam daftar safe-senders agar newsletter berikutnya sukses masuk ke Inbox emailmu.</em></p>
											<p style="margin: 1em 0;">Karena di hari Senin ini kalian bisa kembali memenangkan hadiah-hadiah yang tidak kalah menarik dari project lainnya di Activorm. Minggu ini project terbaru di Activorm berasal dari Tees.co.id, ESPA, dan Tokocondet.com</strong> </p>

																						<table class="prize" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;margin: 30px -5px 20px;">
																												
													<tr>												
																									
													<td style="border-collapse: collapse;width: 25%;padding: 5px 5px 15px;text-align: center;">
														<div class="prize-logo" style="width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;background: #fff;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><a href="http://activorm.com/project/menangkan-alfabet-varsity-jacket-dari-tees-co-id?'.$utm_query.'" target="_blank"><img src="http://activorm.com/images/email/email-prize-tees-jaket.png" alt="Tees.co.id" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></a></span>
														</div>
														<p style="margin: 0 10px;color: #4c4c4d;font-size: 10px;line-height: 1.4;">Alfabet Varsity Jacket<br><b>Tees.co.id</b></p>
                                                    </td>
													
													
												   <td style="border-collapse: collapse;width: 25%;padding: 5px 5px 15px;text-align: center;">
														<div class="prize-logo" style="width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;background: #fff;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><a href="http://activorm.com/project/win-a-gift-voucher-idr-100k-from-espa-spa-reflexiology?'.$utm_query.'" target="_blank"><img src="http://activorm.com/images/email/email-prize-espa-babor.png" alt="ESPA" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></a></span>
														</div>
														<p style="margin: 0 10px;color: #4c4c4d;font-size: 10px;line-height: 1.4;">Gift Voucher 100K<br><b>ESPA</b></p>
                                                    </td>
																									
																										
													<td style="border-collapse: collapse;width: 25%;padding: 5px 5px 15px;text-align: center;">
														<div class="prize-logo" style="width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;background: #fff;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><a href="http://activorm.com/project/menangkan-pancake-duren-ajiieb-6pcs?'.$utm_query.'" target="_blank"><img src="http://activorm.com/images/email/email-prize-tokocondet-pancake-durian.png" alt="Tokocondet.com" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></a></span>
														</div>
														<p style="margin: 0 10px;color: #4c4c4d;font-size: 10px;line-height: 1.4;">Durian Pancake<br><b>Tokocondet.com</b></p>
                                                    </td>
													
													
																												
																									
																										
													
													
													
																												
													</tr>																								
																							
																							</table>
											
											<p style="margin: 1em 0;"><strong>Tees.co.id</strong> adalah tempat dimana kamu bisa menemukan beragam produk kaos dan kanvas dengan desain unik yang bisa kamu beli dengan harga terjangkau. <strong>ESPA</strong> menyediakan treatment paling efektif untuk perawatan kulit dengan harga terjangkau. <strong>Tokocondet.com</strong> menjual segala barang impor dari timur tengah dengan kemudahan dalam berbelanja, serta pengiriman yang cepat .</p>
                                            <p style="margin: 1em 0;">Jangan lewatkan kesempatan untuk memenangkan hadiah-hadiah menarik lainnya di <strong><a href="http://activorm.com/?'.$utm_query.'" target="_blank" style="color: #20b396;">Activorm</a></strong>. Kalian hanya perlu melakukan 3 Engagement-Actions seperti Like Facebook Fanpage, Follow Twitter, atau Share. </p>
                                            <p style="margin: 1em 0;">Untuk teman-teman yang ingin bergabung di Activorm sebagai merchant atau business account, kamu bisa mendaftarkan brand atau bisnis tersebut di <strong><a href="http://www.activorm.com/business/register?utm_source=newsletter&utm_medium=email&utm_campaign=campaign%20name" style="color: #20b396;">www.activorm.com/business/register</a></strong></p>
											<p style="margin: 1em 0;"><strong>Good luck!</strong></p>
											<p class="signup" style="margin: 40px 0 -60px;"><a class="button" href="http://activorm.com?'.$utm_query.'" style="color: #fff;padding: 10px 30px;display: inline-block;font-size: 18px;font-weight: bold;text-decoration: none;background: #20b396;border-bottom: 2px solid #1fa88c;border-radius: 5px;">Go To Activorm</a></p>
										
									</div></td>
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
												
												
																										
													<tr>																									
													
													<td style="padding: 5px 10px 15px;border-collapse: collapse;width: 25%;text-align: center;">
														<div class="sponsor-logo" style="background: none;width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle; margin-top: 5px;"><img src="http://activorm.com/images/merchant/email-logo-activorm_140x95.png" alt="Activorm" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0px 10px;color: #a3a3a3;font-size: 12px;line-height: 1.4;">Activorm</p>
                                                    </td>
                                                    
                                                   														
																																						
													
													<td style="padding: 5px 10px 15px;border-collapse: collapse;width: 25%;text-align: center;">
														<div class="sponsor-logo" style="background: none;width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/merchant/98d086e50fabf036efc6ef6a55873d71_100x100.png" alt="Tees.co.id" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #a3a3a3;font-size: 12px;line-height: 1.4;">Tees.co.id</p>
                                                    </td>
                                                    
                                                   														
																																						
													
													<td style="padding: 5px 10px 15px;border-collapse: collapse;width: 25%;text-align: center;">
														<div class="sponsor-logo" style="background: none;width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/merchant/beaaf524f56972e7d7e92c404c0663ee_100x100.png" alt="ESPA" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #a3a3a3;font-size: 12px;line-height: 1.4;">ESPA</p>
                                                    </td>
                                                    
                                                   														
																																						
													
													<td style="padding: 5px 10px 15px;border-collapse: collapse;width: 25%;text-align: center;">
														<div class="sponsor-logo" style="background: none;width: 100%;height: 95px;margin: 0 0 10px;display: table;vertical-align: middle;border-radius: 10px;">
															<span style="display: table-cell;vertical-align: middle;"><img src="http://activorm.com/images/merchant/email-logo-tokocondet_100x100.png" alt="Tokocondet.com" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;"></span>
														</div>
														<p style="margin: 0 10px;color: #a3a3a3;font-size: 12px;line-height: 1.4;">Tokocondet.com</p>
                                                    </td>
                                                    
                                                   														
													</tr>
                                                   								
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
						<td class="container" style="border-collapse: collapse;padding: 20px;color: #fff;font-size: 12px;background: #34495c;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
							&copy; 2013 Activorm. All rights reserved.<br>
							Jl. Senopati 75, Graha Tirtadi lt.1, Jakarta Selatan, 12110
						</td>
					</tr>
				</tfoot>
					
				</table>
</td></tr></table>

</body>
</html>';*/

		$newsletter_tmpl = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title></title>

</head>
<body style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;color: #4c4c4d;font-size: 16px;font-family: "Myriad Pro", Arial, Helvetica, sans-serif;line-height: 1.6;">

<div style="background:url(http://activorm.com/img/bar_small.png); background-repeat: repeat-x; background-position: top left;width:100%;height:8px;display:block;"></div>

<table id="table-background" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
	<tr>
		<td align="center" style="border-collapse: collapse;">
        	<table class="table-main" width="600" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin: 50px 0;">
				<thead class="header">
					<tr>
						<td class="container" style="border-collapse: collapse;padding: 15px 40px;color: #fff;font-size: 14px;border-top-left-radius: 10px;border-top-right-radius: 10px;">
							<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
								<tr>
									<td width="600" style="border-collapse: collapse;color: #fff;font-size: 14px;" align="center">
										<a href="'.base_url().'?'.$utm_query.'" style="color: #20b396;">
											<img src="'.cdn_url().'img/logo_invoice.png" />
										</a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</thead>


				<tbody class="main">
	                <tr>
						<td class="container" style="border-collapse: collapse;padding: 0 40px;">
							<table class="section" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin-bottom: 70px;">
								<tr>
									<td style="border-collapse: collapse;">
										<div class="content" style="margin: 0 -40px;padding: 10px 40px 10px;text-align: left;background: #fff;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
											<h1 class="content-title" style="margin: 20px 0;padding:25px;font-size: 30px;line-height: 1.2;border-bottom: 1px solid #b5b5b5;border-top: 1px solid #b5b5b5;color: #676767;text-align:center;font-weight:normal;">Wow! You can easily get awesome prizes below!....</h1>
											
											<table class="prize" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;width: 100%;margin: 30px 0px 20px;">
																											
													<tr>												
																										
													<td style="border-collapse: collapse;width: 240px;height:335px;padding: 5px 5px 15px;text-align: center;">
														<div style="border:1px solid #ececec;border-bottom:4px solid #ececec;width:230;">
															<img src="'.cdn_url().'img/img-newsletter4.jpg" alt="" width="100%" />
															<p style="text-align:center;line-height:1.4;margin:8px 0 10px;"><a href="'.base_url().'?'.$utm_query.'" style="text-decoration:none;color:#454545;font-size:18px;"><b>Sun Glasses 2122</b><span style="display:block;color:#868686;font-size:14px;">by Curiostowear</span></a></p>
														</div>
                                                    </td>
													
													<td style="border-collapse: collapse;width: 240px;height:335px;padding: 5px 5px 15px;text-align: center;">
														<div style="border:1px solid #ececec;border-bottom:4px solid #ececec;width:230;">
															<img src="'.cdn_url().'img/img-newsletter4.jpg" alt="" width="100%" />
															<p style="text-align:center;line-height:1.4;margin:8px 0 10px;"><a href="'.base_url().'?'.$utm_query.'" style="text-decoration:none;color:#454545;font-size:18px;"><b>Sun Glasses 2122</b><span style="display:block;color:#868686;font-size:14px;">by Curiostowear</span></a></p>
														</div>
                                                    </td>
														
													</tr>	
													
													<tr>
														
													<td style="border-collapse: collapse;width: 240px;height:335px;padding: 5px 5px 15px;text-align: center;">
														<div style="border:1px solid #ececec;border-bottom:4px solid #ececec;width:230;">
															<img src="'.cdn_url().'img/img-newsletter4.jpg" alt="" width="100%" />
															<p style="text-align:center;line-height:1.4;margin:8px 0 10px;"><a href="'.base_url().'?'.$utm_query.'" style="text-decoration:none;color:#454545;font-size:18px;"><b>Sun Glasses 2122</b><span style="display:block;color:#868686;font-size:14px;">by Curiostowear</span></a></p>
														</div>
                                                    </td>
                                                    
                                                    <td style="border-collapse: collapse;width: 240px;height:335px;padding: 5px 5px 15px;text-align: center;">
														<div style="border:1px solid #ececec;border-bottom:4px solid #ececec;width:230;">
															<img src="'.cdn_url().'img/img-newsletter4.jpg" alt="" width="100%" />
															<p style="text-align:center;line-height:1.4;margin:8px 0 10px;"><a href="'.base_url().'?'.$utm_query.'" style="text-decoration:none;color:#454545;font-size:18px;"><b>Sun Glasses 2122</b><span style="display:block;color:#868686;font-size:14px;">by Curiostowear</span></a></p>
														</div>
                                                    </td>	
														
													</tr>																							
																							
																							</table>
											
											<p style="margin: 1em 0;text-align:center;font-size:18px;">loren ipsum sit domet ajegile and somewhrehouse  of ther rule by the way how meeet your always in my dream how dare you</p>
											<p class="signup" style="margin: 20px 0 -20px;text-align:center;"><a class="button" href="'.base_url().'?'.$utm_query.'" style="color: #fff;padding: 10px 30px;display: inline-block;font-size: 18px;font-weight: bold;text-decoration: none;background: #20b396;border-bottom: 4px solid #199b87;border-radius: 5px;font-weight:normal;">Go to Activorm</a></p>
											
										
									</div></td>
								</tr>
							</table>
						</td>
					</tr>

					</tbody>
					
					
					<tfoot class="footer footer-dark" style="text-align: center;">
					<tr>
						<td class="container" style="border-collapse: collapse;padding: 30px;color: #fff;font-size: 14px;background: #34495c;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
							
							<ul class="social" style="list-style:none;margin:0 0 20px;padding:0;">
								<li class="facebook" style="list-style:none;display:inline;"><img src="'.cdn_url().'img/icon_social_small_fb.png" style="margin-top:-4px;" /><a href="https://www.facebook.com/activorm" style="text-decoration:none;color:white;font-size:14px;font-weight:normal;vertical-align:top;padding-right:70px;padding-left:8px;">Activorm</a></li>
								<li class="twitter" style="list-style:none;display:inline;"><img src="'.cdn_url().'img/icon_social_small_tw.png" style="margin-top:-4px;" /><a href="https://twitter.com/Activorm" style="text-decoration:none;color:white;font-size:14px;font-weight:normal;vertical-align:top;padding-right:70px;padding-left:8px;">@Activorm</a></li>
								<li class="instagram" style="list-style:none;display:inline;"><img src="'.cdn_url().'img/icon_social_small_ig.png" style="margin-top:-4px;" /><a href="http://instagram.com/activorm" style="text-decoration:none;color:white;font-size:14px;font-weight:normal;vertical-align:top;padding-right:0px;padding-left:8px;">Activorm</a></li>
							</ul>
							
							&copy; 2013 Activorm. All rights reserved.
						</td>
					</tr>
				</tfoot>
					
				</table>
</td></tr></table>

</body>
</html>';	
			
			

	      ?>
	      
	      
	      <textarea class="form-control" name="newsletter_body" id="newsletter_body" style="height:400px;"><?php echo (!empty($this->newsletter)) ? $this->newsletter->newsletter_body : $newsletter_tmpl; ?></textarea>
		   
		   
		   
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Newsletter Sending DateTime</label>
	    <div class="col-sm-10">
	       <input type="text" id="newsletter_date" class="newsletter_date form-control" name="newsletter_date" value="<?php echo (!empty($this->newsletter->newsletter_sending_schedule)) ? date('Y-m-d', strtotime($this->newsletter->newsletter_sending_schedule)) : date('Y-m-d'); ?>" />
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <label for="status" class="col-sm-2 control-label">Status</label>
	    <div class="col-sm-10" >
	    	
	    	<?php 
	    	$status = array(
				//'Preview' => 'Preview',
				'Offline' => 'Offline',
				'Online' => 'Online',
			);
	    	?>
	    	
	      <select class="form-control" name="status">
	      	
	      	<?php 
	      	foreach($status as $k=>$v){
	      		$class = (!empty($this->newsletter) && $this->newsletter->status == $k) ? 'selected' : '';
	      	?>
	      	<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
	      	<?php	
	      	}
	      	?>
	      	
	      </select>
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	    	
	    	<input type="hidden" name="form_type" value="<?php echo $this->form_type; ?>" />
	    	<input type="hidden" name="newsletter_id" value="<?php echo (!empty($this->newsletter)) ? $this->newsletter->newsletter_id : ""; ?>" />
	        <input type="submit" class="btn btn-default" name="submit" id="submit" value="Submit" />
	        
	        <?php //if (!empty($this->newsletter)){ ?>
	        <input type="submit" class="btn btn-default" name="preview" id="preview" value="Preview" data-toggle="modal" data-target="#myModal" />
	        <?php //} ?>
	        
	    </div>
	  </div>
	  
	</form>	  
	
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" style="width:700px;">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel">Preview Email</h4>
	      </div>
	      <div class="modal-body">
	      		<div class="overlay_modal"></div>
	        	<p id="editme2"></p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
		
</div>

<?php $this->load->view('n/general/footer_view', $this->data); ?>	