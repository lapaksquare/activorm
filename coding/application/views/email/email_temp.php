<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>Your Email Subject or Title</title>

	<style type="text/css">
		/* Based on The MailChimp Reset INLINE: Yes. */  
		/* Client-specific Styles */
		#outlook a {
			padding: 0; /* Force Outlook to provide a "view in browser" menu link. */
			}
		body{
			/* Prevent Webkit and Windows Mobile platforms from changing default font sizes.*/ 
			width: 100%!important;
			margin: 0;
			padding: 0;
			-webkit-text-size-adjust: 100%;
			-ms-text-size-adjust: 100%;
			} 
		.ExternalClass {
			width: 100%; /* Force Hotmail to display emails at full width */
			}
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
			line-height: 100%; /* Forces Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */
			}
		#backgroundTable {
			margin: 0;
			padding: 0;
			width: 100%!important;
			line-height: 100%!important;
			}
		/* End reset */

		/* Some sensible defaults for images
		Bring inline: Yes. */
		img {
			outline: none;
			text-decoration: none;
			-ms-interpolation-mode: bicubic;
			} 
		a img {
			border: none;
			} 
		.image_fix {
			display: block;
			}

		/* Yahoo paragraph fix
		Bring inline: Yes. */
		p {
			margin: 1em 0;
			}

		/* Hotmail header color reset
		Bring inline: Yes. */
		h1, h2, h3, h4, h5, h6 {
			color: #555555!important;
			}
		h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
			color: #1e83c5!important;
			}
		h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
			color: #1e83c5!important; /* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
			}
		h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
			color: #555555!important; /* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */
			}
		table td {
			border-collapse: collapse;
			}

    /* Remove spacing around Outlook 07, 10 tables
    Bring inline: Yes */
    table {
		border-collapse: collapse;
		mso-table-lspace: 0pt;
		mso-table-rspace: 0pt;
		}


 		body {
			color: #4c4c4d;
			font-size: 16px;
			font-family: "Myriad Pro", Arial, Helvetica, sans-serif;
			line-height: 1.6;
			background: #ecf0ef;
			}
		a {
			color: #20b396;
			}
		strong a {
			text-decoration: none;
			}
 		.container {
			padding: 15px 40px;
			}
 		.table-main {
			margin: 50px 0;
			}
 		.header td {
			color: #fff;
			font-size: 14px;
			}
 		.header .container {
			background: #34495c;
			border-top-left-radius: 10px;
			border-top-right-radius: 10px;
			}
 		.footer {
			text-align: center;
			}
 		.main .container {
			padding: 0 40px;
			}
		.content {
			margin: 0 -40px;
			padding: 10px 40px 100px;
			background: #fff url('<?php echo cdn_url(); ?>img/bg-content.png') no-repeat 100% 100%;
			border-bottom-left-radius: 10px;
			border-bottom-right-radius: 10px;
			}
		.content-title {
			margin: 0 0 20px;
			padding: 0 0 10px;
			font-size: 24px;
			border-bottom: 1px solid #e8e8e8;
			}
       </style>
</head>
<body>

<table id="table-background" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td align="center">
        	<table class="table-main" width="600" border="0" cellpadding="0" cellspacing="0">
				<thead class="header">
					<tr>
						<td class="container">
							<table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="300">
										<a href="#">
											<img class="image_fix" src="img/logo.png" alt="activorm" />
										</a>
									</td>
									<td width="220" align="right">
										Monday, 23 february 2013
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</thead>

				<tfoot class="footer">
					<tr>
						<td class="container">&copy; 2013 Activorm</td>
					</tr>
				</tfoot>

				<tbody class="main">
	                <tr>
						<td class="container">
							<table class="section" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td>
										<div class="content">
											<h1 class="content-title">Account Verification</h1>
											<p><strong>Hi Karen!</strong></p>
											<p>Do activate your Activorm account, we need you to copy this activation code below and enter it to Activorm website.</p>
											<p>www.activiom.com/aksjkaskasjksa</p>
											<p>Thank you for registering on Activorm. If you find any problems during signing up, please contact our support at <strong><a href="#">info@activorm.com</a></strong></p>
											<p>P.S If the activation code above doesn't work, please visit the following link to verify your email address</p>
											<p><a href="#">www.activiom.com/aksjkaskasjksa</a></p>
										</div>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
</table>
</body>
</html>