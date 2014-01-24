		<div id="searchbar" class="block block-light">
			<div class="container">

				<form class="row form-activorm" action="<?php echo base_url(); ?>search" method="get">
					<div class="col-sm-6">
						<input type="text" name="q" placeholder="Please type a word" class="form-control form-light" />
					</div>

					<div class="col-sm-4 col-xs-8">
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
						?>
						<select name="category" class="custom-select light-select select-category cs_prize_category">
							<?php 
							foreach($prize_category_cols as $k=>$v){
							?>
							<option value="<?php echo $k; ?>"><?php echo ucwords($v); ?></option>
							<?php
							}
							?>
						</select>
					</div>

					<div class="col-sm-2 col-xs-4">
						<input type="submit" name="search_submit" class="btn btn-big btn-wd btn-blue" value="Search" />
					</div>
				</form>

			</div>
		<!-- #searchbar --></div>