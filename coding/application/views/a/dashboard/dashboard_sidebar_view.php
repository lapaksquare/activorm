<div id="sidebar" class="col-md-3 col-md-pull-9">
	<div class="widget widget-pages">
		<ul class="list-unstyled">
			
			<?php 
			$menus = array(
				'projects' => array(
					'id' => 'projects',
					'name' => 'Projects',
					'link' => base_url(),
					'childs' => array()
				),
				'dashboard' => array(
					'id' => 'dashboard',
					'name' => 'Dashboard',
					'link' => base_url(),
					'childs' => array(
						'overview' => array(
							'name' => 'Overview',
							'link' => base_url()
						),
						'demographic' => array(
							'name' => 'Demographic',
							'link' => base_url()
						),
						'searchengine' => array(
							'name' => 'Search Engine',
							'link' => base_url()
						),
						'survey' => array(
							'name' => 'Survey',
							'link' => base_url()
						)
					)
				),
				'points_topup' => array(
					'id' => 'points_topup',
					'name' => 'Points &amp; Top Up',
					'link' => base_url(),
					'childs' => array()		
				),
				'payment_confirmation' => array(
					'id' => 'payment_confirmation',
					'name' => 'Payment Confirmation',
					'link' => base_url(),
					'childs' => array()		
				),
				'payment_history' => array(
					'id' => 'payment_history',
					'name' => 'Payment History',
					'link' => base_url(),
					'childs' => array()
				)
			);
			?>
			
			<?php 
				foreach($menus as $k=>$v){
					$class_menu = ($k == $menu) ? 'active' : '';
					$has_child = (!empty($v['childs']) && !empty($submenu) && array_key_exists($submenu, $v['childs'])) ? 'has-child' : '';
			?>
			
				<li class="<?php echo $class_menu . ' ' . $has_child; ?>"><a href="<?php echo $v['link']; ?>"><?php echo $v['name']; ?></a>
				
				<?php if (!empty($v['childs']) && !empty($submenu) && array_key_exists($submenu, $v['childs'])){ ?>
					<ul class="children">
						<?php 
							foreach($v['childs'] as $a=>$b){ 
								$class_menu = ($a == $submenu) ? 'active' : '';
						?>
							<li class="<?php echo $class_menu; ?>"><a href="<?php echo $b['link']; ?>"><?php echo $b['name']; ?></a></li>
						<?php } ?>
					</ul>
				<?php } ?>
				
				</li>
			
			<?php		
				}
			?>
			
		</ul>
	<!-- .widget --></div>
<!-- #sidebar --></div>