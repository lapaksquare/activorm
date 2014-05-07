<div class="td-sidebar hidden-print">

	<?php 
	$menus = array(
		'home' => array(
			'name' => 'Home',
			'url' => base_url() . 'admin/home'
		),
		'account' => array(
			'name' => 'Account',
			'url' => '#',
			'child' => array(
				'member_account' => array(
					'name' => 'Member Account',
					'url' => base_url() . 'admin/member/member_account'
				),
				'business_account' => array(
					'name' => 'Business Account',
					'url' => base_url() . 'admin/member/business_account'
				),
				'add_invite_member' => array(
					'name' => 'Add/Invite Member',
					'url' => base_url() . 'admin/member/add_account'
				),
				'member_point' => array(
					'name' => 'Member Point',
					'url' => base_url() . 'admin/member/member_point'
				)
			)
		),
		'featured' => array(
			'name' => 'Featured',
			'url' => '#',
			'child' => array(
				'prize_homepage' => array(
					'name' => 'Prize in Homepage',
					'url' => base_url() . 'admin/featured/prize_homepage',
				),
				'logo_homepage' => array(
					'name' => 'Logo in Homepage',
					'url' => base_url() . 'admin/featured/logo_homepage'
				)
			)
		),
		'prize' => array(
			'name' => 'Prize',
			'url' => base_url() . 'admin/prize'		
		),
		'project_winner' => array(
			'name' => 'Project Winner',
			'url' => base_url() . 'admin/project_winner'		
		),
		'voucher_pdf' => array(
			'name' => 'Voucher PDF',
			'url' => base_url() . 'admin/voucherpdf',
		),
		'project' => array(
			'name' => 'Project',
			'url' => base_url() . 'admin/project',
			'child' => array(
				'project_draft' => array(
					'name' => 'Draft',
					'url' => base_url() . 'admin/project?project_status=Draft'
				),
				'project_offline' => array(
					'name' => 'Pending/Offline',
					'url' => base_url() . 'admin/project?project_status=Offline'
				),
				'project_online' => array(
					'name' => 'On-Going/Online',
					'url' => base_url() . 'admin/project?project_status=Online'
				),
				'project_closed' => array(
					'name' => 'Closed',
					'url' => base_url() . 'admin/project?project_status=Closed'
				)
			)		
		),
		'payment' => array(
			'name' => 'Payment',
			'url' => base_url() . 'admin/payment',
			'child' => array(
				'payment_checkout' => array(
					'name' => 'Checkout',
					'url' => base_url() . 'admin/payment?order_status=checkout'
				),
				'payment_onprogress' => array(
					'name' => 'OnProgress',
					'url' => base_url() . 'admin/payment?order_status=onprogress'
				),
				'payment_completed' => array(
					'name' => 'Completed',
					'url' => base_url() . 'admin/payment?order_status=completed'
				),
				'payment_order_manual' => array(
					'name' => 'Payment Order Manual',
					'url' => base_url() . 'admin/payment/ordermanual'
				),
			)
		),
		'rangking' => array(
			'name' => 'Rangking',
			'url' => base_url() . 'admin/rangking',
		),
		'newsletter' => array(
			'name' => 'Newsletter',
			'url' => base_url() . 'admin/newsletter',
		),
		'graph' => array(
			'name' => 'Graph',
			'url' => base_url() . 'admin/graph',
		),
		'banner' => array(
			'name' => 'Banner',
			'url' => base_url() . 'admin/banner',
		),
	);
	
	?>

	<ul class="nav td-sidenav">
		
		<?php 
		foreach($menus as $k=>$v){
			$class = ($menu == $k) ? 'class="active"' : '';
			$access_list = explode(",", $this->account_admin->access_list);
			if (!empty($this->account_admin) && ($this->account_admin->access_list == "all" || in_array("admin_" . $k, $access_list))){
		?>
		<li <?php echo $class; ?>><a href="<?php echo $v['url']; ?>"><?php echo $v['name']; ?></a>
			
			<?php if (!empty($v['child'])){ ?>
			<ul class="nav">
				<?php foreach($v['child'] as $a=>$b){ 
					$class = (!empty($menu_child) && $menu_child == $a) ? 'class="active"' : '';
					?>
		    	<li <?php echo $class; ?>><a href="<?php echo $b['url']; ?>"><?php echo $b['name']; ?></a></li>
		    	<?php } ?>
		  	</ul>
			<?php } 
			?>
			
		</li>
		<?php 	
			}
		}
		?>
		
		<?php /*
		 * <ul class="nav">
		    	<li><a href="#">Draft <span class="badge pull-right">5</span></a></li>
		    	<li><a href="#">Pending <span class="badge pull-right">2</span></a></li>
		    	<li><a href="#">On-Going <span class="badge pull-right">2</span></a></li>
		    	<li><a href="#">Closed <span class="badge pull-right">2</span></a></li>
		  	</ul>
		 * */ ?>
		
	</ul>

</div>