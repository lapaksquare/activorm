<?php $this->load->view('a/general/header_view', $this->data); ?>

		<div id="main" class="container">

			<div class="page-header">
				<h1 class="pull-left page-title">Settings</h1>
				<!--<span class="page-subtitle">If you want to delete your account fill this form.</span>-->
				<div class="clearfix"></div>
			</div>

			<div class="row">

				<div id="content" class="col-md-9 col-md-push-3">

					<div class="box">
						<div class="box-header">
							<h2 class="box-title">Social Media Accounts</h2>
						</div>

						<p>Any connection is only under your permission.</p>

						<?php 
						$social_media = array(
							'facebook' => array(
								'name' => 'Facebook',
								'link_connect' => base_url() . 'auth/facebook_connect_ref' // $this->access->fb_connect_url
							),
							'twitter' => array(
								'name' => 'Twitter',
								'link_connect' => base_url() . 'auth/twitter_connect'
							)
						);
						?>

						<div class="row user-connect">
							
							<?php 
							
							//echo '<pre>';
							//print_r($socialmedia_account);
							//echo '</pre>';
							
							foreach($social_media as $k=>$v){
								$array_key_exists = array_key_exists($k, $socialmedia_account);
								
								$social_page_active = (!empty($socialmedia_account[$k]->social_page_active)) ? json_decode($socialmedia_account[$k]->social_page_active) : '';
								
							?>
							<div class="col-xs-6">
								<i class="icon-<?php echo $k; ?>"></i> <?php echo ucwords($v['name']); ?>
							</div>
							<div class="col-xs-6">
								<?php 
								if ($array_key_exists){
								?>
								<a class="btn btn-mt btn-blue pull-right" href="<?php echo base_url(); ?>settings/disconnect?scid=<?php echo $socialmedia_account[$k]->social_id; ?>&hash=<?php echo sha1($socialmedia_account[$k]->social_id . SALT); ?>">Disconnect</a>
								<?php
								}else{
								?>
								<a class="btn btn-mt btn-green pull-right" href="<?php echo $v['link_connect']; ?>">Connect</a>
								<?php } ?>
							</div>
							
							<div class="clearfix"></div>
							
								<?php 
								
								$flag_fp = 0;
								$fp = "";
								if (!empty($socialmedia_account[$k])){
								
								$js = json_decode($socialmedia_account[$k]->social_data);
								$fp = ucwords( $js->name );
								
								if ($k == "facebook" && $this->access->member_account->account_type == "business" && !empty($facebook_pages)){
									$flag_fp = 1;
								?>
								<div style="width: 635px;margin: 0 15px;">
									<b style="text-align:left;">Pages</b>
									<table class="table">
										<?php 
										
										foreach($facebook_pages as $a=>$b){ 											
											?>
										<tr>
											<td><b><?php echo ucwords( $b->name ); ?></b></td>
											<td><?php echo ucwords( $b->category ); ?></td>
											<?php  
											
											$flag = (!empty($social_page_active) && $social_page_active->id == $b->id) ? 1 : 0;
											
											if ($flag == 1){
												$fp = ucwords( $b->name );
											}
											
											$activate_page_name = ($flag == 1) ? 'Non Aktifkan' : 'Aktifkan';
											$activate_page_name_class = ($flag == 1) ? 'btn-slide-active' : 'btn-slide-non-active';
											$link_activate_page = ($flag == 1) ? base_url() . 'auth/setfacebookpage?fpid=' . $b->id . '&hash=' . sha1($b->id . SALT) . '&set=0' : base_url() . 'auth/setfacebookpage?fpid=' . $b->id . '&hash=' . sha1($b->id . SALT) . '&set=1';
											?>
											<td><a href="<?php echo $link_activate_page; ?>" class="label-green btn-slider <?php echo $activate_page_name_class; ?>"><?php echo $activate_page_name; ?></a></td>
										</tr>
										<?php } ?>
									</table>
								</div>
								<?php } 
								
								}
								?>
							
								<?php if ($k == "facebook"){ ?>
								<div style="width: 635px;margin: 0 15px;">
									<p style="line-height:18px;"><small>Please allow or click "Okay" to allow Activorm to access your public profile, email address, to post to Facebook and to manage your pages. We will never post any content without your permission.</small></p>
								</div>
								<?php } ?>
								
								<?php if ($flag_fp == 0 && !empty($fp)){ ?>
								<div style="width: 635px;margin: 0 15px;">
									<p style="line-height:18px;"><b>User Connect</b> : <code class="blue-code"><?php echo $fp; ?></code></p>
								</div>
								<?php } ?>
							
							<div class="clearfix row-divider"></div>
							<?php
							}
							?>
							
							<?php /*
							<div class="col-xs-6">
								<i class="icon-facebook"></i> Facebook
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-green pull-right" href="#">Connect</a>
							</div>

							<div class="clearfix row-divider"></div>

							<div class="col-xs-6">
								<i class="icon-twitter"></i> Twitter
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-green pull-right" href="#">Connect</a>
							</div>

							<div class="clearfix row-divider"></div>

							<div class="col-xs-6">
								<i class="icon-gplus"></i> Google+
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-green pull-right" href="#">Connect</a>
							</div>

							<div class="clearfix row-divider"></div>

							<div class="col-xs-6">
								<i class="icon-tumblr"></i> Tumblr
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-green pull-right" href="#">Connect</a>
							</div>

							<div class="clearfix row-divider"></div>

							<div class="col-xs-6">
								<i class="icon-flickr"></i> Flickr
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-grey pull-right" href="#">Connect</a>
							</div>

							<div class="clearfix row-divider"></div>

							<div class="col-xs-6">
								<i class="icon-pinterest"></i> Pinterest
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-grey pull-right" href="#">Connect</a>
							</div>

							<div class="clearfix row-divider"></div>

							<div class="col-xs-6">
								<i class="icon-foursquare"></i> Foursquare
							</div>
							<div class="col-xs-6">
								<a class="btn btn-mt btn-green pull-right" href="#">Connect</a>
							</div>
							 * 
							 */ ?>
						</div>
					</div>

				<!-- #content --></div>

				<?php $this->load->view('a/settings/settings_sidebar_view', $this->data); ?>

			<!-- .row --></div>

		<!-- #main --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>