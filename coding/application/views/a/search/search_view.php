<?php $this->load->view('a/general/header_view', $this->data); ?>

<?php $this->load->view('a/home/searchbar_view', $this->data); ?>

		<div id="content" class="block block-white">
			<div class="container">

				<?php /*
				<div class="page-header">
					<h1 class="page-title">"Starbucks"</h1>
					<p>Sorry, the prize or publisher you are looking for is unavailable at the moment.<br /> Do you want to submit a suggestion?</p>
					<a class="btn btn-green" href="#">Cancel</a>				
					<a class="btn btn-green" href="#">Submit</a>				
				</div> */ ?>
				
				<?php if (!empty($search_data)){ ?>

				<div class="page-header">
					<h1 class="page-title">
						<?php if (!empty($this->q)){ ?>
						Search for <i>"<?php echo $this->q; ?>"</i>
						<?php }else{ ?>
						Search Category for <i>"<?php echo ucwords( str_replace(array("-", "_"), " ", $this->category) ); ?>"</i>
						<?php } ?>
					</h1>
					<?php /*
					<p>Sorry, the prize or publisher you are looking for is unavailable at the moment.<br /> Do you want to submit a suggestion?</p>
					<a class="btn btn-green" href="#">Cancel</a>				
					<a class="btn btn-green" href="#">Submit</a> */ ?>	
				</div>

				<div class="row">
					<div class="col-md-9 col-md-push-3">

						<div class="row list-items">
							
							<?php foreach($search_data as $k=>$v){ ?>
							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<?php $photo = $this->mediamanager->getPhotoUrl($v->project_primary_photo, "211x155"); ?>
									<img style="margin: 0 auto;" class="img-responsive" src="<?php echo cdn_url() . $photo; ?>" alt="<?php echo $v->project_name; ?>" />
								</div>

								<h3 class="item-title"><?php echo ucwords($v->project_name); ?></h3>

								<a class="btn btn-green" href="<?php echo base_url(); ?>project/<?php echo $v->project_uri; ?>">Enter Now</a>
							<!-- .item --></div>
							<?php } ?>

							<?php /*
							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-02.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-03.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-04.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-05.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro with a Very Long Title Could Go Here for Testing Purpose Only</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-06.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-07.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-08.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>

							<div class="col-md-4 col-sm-6 item">
								<div class="item-thumbnail">
									<img class="img-responsive" src="<?php echo cdn_url(); ?>img/content/item-01.jpg" alt="#" />
								</div>

								<h3 class="item-title">Win a Macbook Pro</h3>

								<a class="btn btn-green" href="#">Enter Now</a>
							<!-- .item --></div>
							 */ ?> 
						<!-- .list-items --></div>

						<div class="content-nav project-nav" style="margin-left: 12px;">
						<?php 
						if (!empty($pagination)) echo $pagination;
						?>
						</div>	

						<?php /*
						<div class="content-nav product-nav">
							<span class="current">1</span>
							<a href="#">2</a>
							<a href="#">3</a>
							<a href="#">4</a>
							<a href="#">5</a>
						<!-- .content-nav --></div> */ ?>
						
					</div>

					<div class="col-md-3 col-md-pull-9">
						<div class="widget widget-filter">
							<h3 class="widget-title">Category</h3>

							<form class="form-activorm" action="<?php echo base_url(); ?>search" method="get">
								<div class="form-label">
									<label for="prize" class="form-label">Prize</label>
								</div>
								<div class="form-group">
									<?php 
									$prize_category_cols = array(
										'all_prize' => 'All Prize',
										'gadget' => 'Gadget',
										'voucher-discounts' => 'Voucher & Discounts',
										'event_tickets' => 'Event Tickets',
										'promotional_items' => 'Promotional Items',
										'cash' => 'Cash',
										'other' => 'Other'
									);
									$is_array_category = FALSE;
									if (is_array($this->category)){
										$is_array_category = TRUE;
									}
									foreach($prize_category_cols as $k=>$v){
										$checked = "";
										if ($is_array_category == TRUE){
											if (in_array($k, $this->category)){
												$checked = 'checked="checked"';
											}
										}else{
											if ($k == $this->category){
												$checked = 'checked="checked"';
											}
										}
									?>
									<input <?php echo $checked; ?> type="checkbox" class="custom-checkwhite" value="<?php echo $k; ?>" name="category[]" data-label="<?php echo $v; ?>" />
									<?php } ?>
								</div>

								<?php /*
								<div class="form-label">
									<label for="prize" class="form-label">Interest/Publishers</label>
								</div>
								<div class="form-group">
									<input type="checkbox" class="custom-checkwhite" value="prize-food" name="search-interest" data-label="Food" />
									<input type="checkbox" class="custom-checkwhite" value="prize-fashion" name="search-interest" data-label="Fashion" />
									<input type="checkbox" class="custom-checkwhite" value="prize-tech" name="search-interest" data-label="Tech" />
									<input type="checkbox" class="custom-checkwhite" value="prize-social" name="search-interest" data-label="Social" />
									<input type="checkbox" class="custom-checkwhite" value="prize-automotive" name="search-interest" data-label="Automotive" />
									<input type="checkbox" class="custom-checkwhite" value="prize-travel" name="search-interest" data-label="Travel" />
									<input type="checkbox" class="custom-checkwhite" value="prize-politic" name="search-interest" data-label="Politic" />
								</div>*/ ?>

								<div class="form-submit">
									<input type="hidden" name="q" value="<?php echo $this->q; ?>" />
									<input type="submit" name="search_submit" class="btn btn-big btn-wd btn-blue" value="Search" />
								</div>
							</form>
						<!-- .widget-filter --></div>
					</div>
				</div>

				<?php }else{ ?>

				<div class="page-header">
					<h1 class="page-title">
						<?php if (!empty($this->q)){ ?>
						Search Not Result for <i>"<?php echo $this->q; ?>"</i>
						<?php }else{ ?>
						Search Not Result for Category <i>"<?php echo ucwords( str_replace(array("-", "_"), " ", $this->category) ); ?>"</i>
						<?php } ?>
					</h1>
					
					<div class="" style="margin-top:10px;">
						<p>Sorry, the prize or publisher you are looking for is unavailable at the moment.<br /> Do you want to submit a suggestion?</p>
						<div>
							<!--
							<a class="btn btn-green" href="#" id="btn-suggest-submit">Submit</a> -->
							<p><!-- Thanks for submit! :)--><a class="btn btn-green" href="#" id="btn-suggest-submit" data-sq="<?php echo $this->q; ?>">Submit</a></p>
						</div>			
					</div>
					
					<?php /*
					<p>Sorry, the prize or publisher you are looking for is unavailable at the moment.<br /> Do you want to submit a suggestion?</p>
					<a class="btn btn-green" href="#">Cancel</a>				
					<a class="btn btn-green" href="#">Submit</a> */ ?>	
				</div>

				<?php } ?>

			</div>
		<!-- #content --></div>

<?php $this->load->view('a/general/footer_view', $this->data); ?>