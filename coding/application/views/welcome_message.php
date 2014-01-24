<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Academic Free License version 3.0
 *
 * This source file is subject to the Academic Free License (AFL 3.0) that is
 * bundled with this package in the files license_afl.txt / license_afl.rst.
 * It is also available through the world wide web at this URL:
 * http://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)
 * @license		http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }
	::-webkit-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		-moz-box-shadow: 0 0 8px #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>

	<table border="1">
		<thead>
			<tr>
				<th>date</th>
				<th>visitors</th>
				<th>newVisits</th>
				<th>visits</th>
				<th>bounces</th>
				<th>visitBounceRate</th>
				<th>timeOnSite</th>
				<th>avgTimeOnSite</th>
				<th>percentNewVisits</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->visits['rows'] as $k=>$v){ ?>
				<tr>
					<td><?php echo date("d M Y", strtotime($v[0])); ?></td>
					<td><?php echo $v[1]; ?></td>
					<td><?php echo $v[2]; ?></td>
					<td><?php echo $v[3]; ?></td>
					<td><?php echo $v[4]; ?></td>
					<td><?php echo $v[5]; ?></td>
					<td><?php echo $v[6]; ?></td>
					<td><?php echo $v[7]; ?></td>
					<td><?php echo $v[8]; ?></td>
				</tr>
			<?php } ?>	
		</tbody>
	</table>
	
	<hr />
	
	<table border="1">
		<thead>
			<tr>
				<th>date</th>
				<th>pageviews</th>
				<th>pageviewsPerVisit</th>
				<th>uniquePageviews</th>
				<th>timeOnPage</th>
				<th>avgTimeOnPage</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->visits2['rows'] as $k=>$v){ ?>
				<tr>
					<td><?php echo date("d M Y", strtotime($v[0])); ?></td>
					<td><?php echo $v[1]; ?></td>
					<td><?php echo $v[2]; ?></td>
					<td><?php echo $v[3]; ?></td>
					<td><?php echo $v[4]; ?></td>
					<td><?php echo $v[5]; ?></td>
				</tr>
			<?php } ?>	
		</tbody>
	</table>
	
	<hr />
	
	<table border="1">
		<thead>
			<tr>
				<th>source</th>
				<th>medium</th>
				<th>visitors</th>
				<th>percentNewVisits</th>
				<th>newVisits</th>
				<th>visits</th>
				<th>visitBounceRate</th>
				<th>avgTimeOnSite</th>
				<th>timeOnSite</th>
				<th>bounces</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->visits3['rows'] as $k=>$v){ ?>
				<tr>
					<td><?php echo $v[0]; ?></td>
					<td><?php echo $v[1]; ?></td>
					<td><?php echo $v[2]; ?></td>
					<td><?php echo $v[3]; ?></td>
					<td><?php echo $v[4]; ?></td>
					<td><?php echo $v[5]; ?></td>
					<td><?php echo $v[6]; ?></td>
					<td><?php echo $v[7]; ?></td>
					<td><?php echo $v[8]; ?></td>
					<td><?php echo $v[9]; ?></td>
				</tr>
			<?php } ?>	
		</tbody>
	</table>
	
</div>

</body>
</html>