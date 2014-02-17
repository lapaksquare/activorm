<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?php echo $title; ?></title>
		<?php echo $css_tags; ?>
		<script type="text/javascript">
			var base_url = "<?php echo base_url(); ?>";
		</script>
	</head>
	<body>
		
		<?php if ($menu != "login"){ ?>
		<header class="navbar navbar-default navbar-fixed-top bs-docs-nav" role="banner">
		  <div class="container">
		    <div class="navbar-header">
		      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a href="<?php echo base_url() ?>admin" class="navbar-brand">Activorm Connect</a>
		    </div>
		    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
		      
		      <?php /*
		      <ul class="nav navbar-nav">
		        <li>
		          <a href="./getting-started">Getting started</a>
		        </li>
		        <li>
		          <a href="./css">CSS</a>
		        </li>
		        <li>
		          <a href="./components">Components</a>
		        </li>
		        <li>
		          <a href="./javascript">JavaScript</a>
		        </li>
		        <li>
		          <a href="./customize">Customize</a>
		        </li>
		      </ul>
			   * 
			   */ ?>
			   
			  <ul class="nav navbar-nav navbar-right">
			  	<?php 
			  	$account = $this->session->userdata('account_admin');
				if (!empty($account)){
			  	?>
		        <li>
		          <a href="<?php echo base_url(); ?>admin/login/logout">Logout</a>
		        </li>
		        <?php } ?>
		      </ul>
			   
		    </nav>
		  </div>
		</header>
		<?php } ?>
		
		<?php 
		$style = "";
		if ($menu == "login"){
			$style = "padding-top:0;";
		}
		?>
		
		<div class="bs-header" id="content" <?php echo $style; ?>>
			<div class="container">
				<div class="row">
					
					<?php if ($menu == "login"){ ?>
					<img src="<?php echo cdn_url(); ?>img/logo_invoice.png" alt="logo" />	
					<h2>Welcome in Activorm Connect</h2>
					<p><b>Activorm.com</b>, An Activation Platform for Your Social Media Network. Activorm will help your business improve more results.</p>	
					
					<hr />	
					<?php } ?>
