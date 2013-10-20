<?php $this->load->view('a/general/head_view', $this->data); ?>
		
		<body class="<?php echo $menu; ?>">

			<div id="header" class="navbar navbar-default navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo cdn_url(); ?>img/logo.png" alt="activorm" /></a>
					</div>
					
					<?php /*
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<form action="#" method="get">
									<div class="form-group">
										<input type="text" placeholder="" class="form-control">
									</div>
								</form>
							</li>
							<li class="dropdown navbar-user navbar-logout">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<img src="<?php echo cdn_url(); ?>img/content/user-avatar.gif" alt="karen kamal" />
									<span>Karen Kamal</span>
									<i class="icon-down-dir"></i>
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">Profile</a></li>
									<li class="active"><a href="#">Tickets</a></li>
									<li><a href="#">Settings</a></li>
									<li><a href="#">Log Out</a></li>
								</ul>
							</li>
						</ul>
					<!--.nav-collapse --></div>
					*/ ?>
					
					<?php /**/ ?>
					
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a href="#">Benefits</a></li>
							<li><a href="#">Plans &amp; Pricing</a></li>
							<li><a href="#">Our Clients</a></li>
							<li><a href="#">About</a></li>
						</ul>
	
						<ul class="nav navbar-nav navbar-right">
							<li class="navbar-learn">
								<a href="#">want to learn?</a>
							</li>
							<li class="dropdown navbar-user navbar-login">
								<a href="#" id="navbar-login-button"><i class="icon-lock"></i> Log In</a>
							</li>
						</ul>
					<!--.nav-collapse --></div>
					
				</div>
			<!-- #header --></div>
