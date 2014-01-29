<?php $this->load->view('a/general/head_view', $this->data); ?>
		
		<body class="<?php echo $menu; ?>">
			
			<div class="loading-bar-top" id="loading-bar-top">
				<div class="loading-text">Loading <span class="loading-img"></span></div>
			</div>
			
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
					
					<?php 
					if (!empty($this->access->member_account)){
					?>
					
					<div class="navbar-collapse collapse">
						
						<ul class="nav navbar-nav">
						
							<?php /*
							<li><a href="<?php echo base_url(); ?>guestlist"><span class="navbar-gl">Guest List</span></a></li> */ ?>
						<?php 
						if ($this->access->member_account->account_type == "business" || ( !empty($menu) && $menu == 'business' ) ){
						?>
						
							
							<?php /*
							<li><a href="#">Benefits</a></li>
							<li><a href="#">Plans &amp; Pricing</a></li>
							<li><a href="#">Our Clients</a></li> */ ?>
							<li><a href="<?php echo base_url(); ?>benefits">Benefits</a></li>
							<li><a href="<?php echo base_url(); ?>about">About</a></li>
							
								
						<?php } ?>
							
						<?php if (!empty($this->access->member_account)){ ?>	
							<li><a href="<?php echo base_url(); ?>report/bug">Report Bugs</a></li>
						<?php } ?>	
							
						</ul>
						
						<ul class="nav navbar-nav navbar-right">
							
							
							<?php /*
							<li>
								<form action="#" method="get">
									<div class="form-group">
										<input type="text" placeholder="" class="form-control">
									</div>
								</form>
							</li> */ ?>
							
							<?php if ($this->access->member_account->account_type == "business"){ ?>
							<li class="navbar-learn">
								<a href="<?php echo base_url(); ?>project/create">Create Project</a>
							</li>
							<?php } ?>
							
							<li class="dropdown navbar-user navbar-logout">
								
								<?php  
								$register_temp = $this->session->userdata('register_temp');
								$flag = 0;
								if (empty($register_temp) || ($register_temp['step'] > 0 && $register_temp['step'] < 4)){
									$flag = 1;
								}
								?>
								
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									
									<?php 
									$photo = (empty($this->access->member_account->account_primary_photo)) ? 'img/user-default.gif' : $this->access->member_account->account_primary_photo;
									$photo = $this->mediamanager->getPhotoUrl($photo, "30x30");
									?>
									
									<img src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $this->access->member_account->account_name; ?>" />
									<span><?php echo $this->access->member_account->account_name; ?></span>
									<i class="icon-down-dir"></i>
								</a>
								
								<?php if ($flag == 0){ ?>
								<ul class="dropdown-menu">
									
									<?php 
									
									if ($this->access->member_account->account_type == "user"){
									
										$menus = array(
											/*'profile' => array(
												'name' => 'profile',
												'uri' => base_url() 
											),*/
											'tickets' => array(
												'name' => 'Tickets',
												'uri' => base_url() . 'tickets'
											),
											'settings' => array(
												'name' => 'Settings',
												'uri' => base_url() . 'settings/contact'
											)
										);
									
									}else if ($this->access->member_account->account_type == "business"){
										
										$menus = array(
											'profile' => array(
												'name' => 'profile',
												'uri' => base_url() . $this->access->business_account->business_uri
											),
											'dashboard' => array(
												'name' => 'Dashboard',
												'uri' => base_url() . 'dashboard/projects'
											),
											'settings' => array(
												'name' => 'Settings',
												'uri' => base_url() . 'settings/contact'
											)
										);
										
									}
									
									foreach($menus as $k=>$v){
										$class = ($k == $menu) ? 'active' : '';
									?>
									
									<li class="<?php echo $class; ?>"><a href="<?php echo $v['uri']; ?>"><?php echo ucwords($v['name']); ?></a></li>
									
									<?php
									}
									
									?>
									<li><a href="<?php echo base_url(); ?>auth/logout">Log Out</a></li>
								</ul>
								<?php }else{ ?>
								<ul class="dropdown-menu">	
									<li><a href="<?php echo base_url(); ?>auth/logout">Log Out</a></li>
								</ul>
								<?php } ?>	
								
							</li>
						</ul>
					<!--.nav-collapse --></div>
					
					<?php }else{ ?>
					
					<div class="navbar-collapse collapse">
						
						<ul class="nav navbar-nav">
							
							<?php /*
							<li><a href="<?php echo base_url(); ?>guestlist"><span class="navbar-gl">Guest List</span></a></li>
							*/ ?>
							
						<?php 
						if (!empty($menu) && $menu == 'business'){
						?>
						
							
							<li><a href="<?php echo base_url(); ?>benefits">Benefits</a></li>
							
							<?php /*
							<li><a href="<?php echo base_url(); ?>planspricing">Plans &amp; Pricing</a></li>
							<li><a href="#">Our Clients</a></li>
							*/ ?>
							<li><a href="<?php echo base_url(); ?>about">About</a></li>
							
						
						<?php } ?>
						
						<?php if (!empty($this->access->member_account)){ ?>	
							<li><a href="<?php echo base_url(); ?>report/bug">Report Bugs</a></li>
						<?php } ?>	
							
						</ul>
		
						<ul class="nav navbar-nav navbar-right">
							
							<?php /*
							<li class="navbar-learn">
								<a href="#">want to learn?</a>
							</li> */ ?>
							
							<li class="dropdown navbar-user navbar-login">
								<a href="#" id="navbar-login-button"><i class="icon-lock"></i> Log In</a>
							</li>
						</ul>
					<!--.nav-collapse --></div>
					
					<?php } ?>
					
				</div>
			<!-- #header --></div>
