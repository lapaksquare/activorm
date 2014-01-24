<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- If you delete this meta tag, Half Life 3 will never be released. -->
<meta name="viewport" content="width=device-width" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Account Verification</title>

	
</head>
<body style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;color: #4c4c4d;font-size: 16px;font-family: 'Myriad Pro', Arial, Helvetica, sans-serif;line-height: 1.6;background: #fff;width: 100%;">

<table id="table-background" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
	<tr>
		<td align="center" style="border-collapse: collapse;">
        	<table class="table-main" width="600" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;margin: 50px 0;">
				<thead class="header">
					<tr>
						<td class="container" style="border-collapse: collapse;padding: 15px 40px;color: #fff;font-size: 14px;background: #34495c;">
							<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
								<tr>
									<td width="300" style="border-collapse: collapse;color: #fff;font-size: 14px;">
										<a href="#" style="color: #20b396;">
											<img class="image_fix" src="<?php echo cdn_url(); ?>img/logo.png" alt="activorm" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;border: none;display: block;">
										</a>
									</td>
									<td width="220" align="right" style="border-collapse: collapse;color: #fff;font-size: 14px;">
										<?php echo date("l, d M Y"); ?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</thead>

				<tfoot class="footer" style="text-align: center;">
					<tr>
						<td class="container" style="border-collapse: collapse;padding: 15px 40px;">&copy; 2013 Activorm</td>
					</tr>
				</tfoot>

				<tbody class="main">
	                <tr>
						<td class="container" style="border-collapse: collapse;padding: 0 40px;">
							<table class="section" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;">
								<tr>
									<td style="border-collapse: collapse;">
										<div class="content" style="margin: 0 -40px;padding: 10px 40px 100px;background: #fff;border-bottom-left-radius: 10px;border-bottom-right-radius: 10px;">
											<h1 class="content-title" style="margin: 0 0 20px;padding: 0 0 10px;font-size: 24px;border-bottom: 1px solid #e8e8e8;color: #555555;">Account Activation</h1>
											<p style="margin: 1em 0;"><strong>Hi <?php echo $account_name; ?>!</strong></p>
											<p style="margin: 1em 0;">Please insert this information to login</p>
											<p style="margin: 1em 0;"><b>Email</b> : <b><?php echo $account_email; ?></b></p>
											<p style="margin: 1em 0;"><b>Password</b> : <b><?php echo $account_temp_password; ?></b></p>
											<p style="margin: 1em 0;">Please <b>change password</b> after you login.
											<br />
											<a href="<?php echo base_url(); ?>" class="button" style="padding: 5px 15px;display: inline-block;color: #fff;font-size: 13px;margin:8px 0;font-weight: bold;text-decoration: none;background: #20b396;border-bottom: 2px solid #1fa88c;border-radius: 5px;">Activate My Account</a>
											<br />
											</p>
											<p style="margin: 1em 0;">Thank you for registering on Activorm. If you find any problems during signing up, please contact our support at <strong><a href="mailto:beta@activorm.com" style="color: #20b396;text-decoration: none;">beta@activorm.com</a></strong></p>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</tbody></table>
			</td>
		</tr>
</table>
</body>
</html>