<div id="sidebar" class="col-md-3 col-md-pull-9">
	<div class="widget widget-pages">
		<ul class="list-unstyled">
			
			<?php 
			$menus = array(
				'contact' => array(
					'name' => 'Contact Information',
					'link' => base_url() . 'settings/contact'
				),
				'socialmedia' => array(
					'name' => 'Social Media Connect',
					'link' => base_url() . 'settings/socialmedia'
				),
				
				'email' => array(
					'name' => 'Email Preference',
					'link' => base_url() . 'settings/email'
				),
				'password' => array(
					'name' => 'Password',
					'link' => base_url() . 'settings/password'
				),
				
				'deleteaccount' => array(
					'name' => 'Delete Account',
					'link' => base_url() . 'settings/deleteaccount'
				)
			);
						
			foreach($menus as $k=>$v){
				
				$class = ($k == $submenu) ? 'active' : '';
				
				if (in_array($k, array('email', 'password', 'deleteaccount')) && $this->access->member_account->register_step < 5 && count($socialmedia_account) < 1) continue;
				
			?>
			
			<li class="<?php echo $class; ?>"><a href="<?php echo $v['link']; ?>"><?php echo $v['name']; ?></a></li>
			
			<?php } ?>

		</ul>
	<!-- .widget --></div>
<!-- #sidebar --></div>