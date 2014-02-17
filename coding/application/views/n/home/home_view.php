<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">

	<h2>Welcome in Activorm Connect</h2>
	<p><b>Activorm.com</b> An Activation Platform for Your Social Media Network. Activorm will help your business improve more results.</p>	
	
	<hr />

	<?php  
	$access_list = explode(",", $this->account_admin->access_list);
	if (!empty($this->account_admin) && ($this->account_admin->access_list == "all" || in_array("admin_home", $access_list))){
	?>
	
	<h2>Home</h2>	

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" id="home_tabs">
	  <li class="active"><a href="#last_post_project" data-toggle="tab">Last Post Project</a></li>
	  <li><a href="#last_edited_project" data-toggle="tab">Last Edited Project</a></li>
	</ul>
	
	<!-- Tab panes -->
	<div class="tab-content">
	  <div class="tab-pane fade in active" id="last_post_project">
	  	<p>
		  	<ul>
		  		<?php 		  		
		  		foreach($project_lastposted as $k=>$v){ ?>
		  		<li>
		  			<b><?php echo $k; ?></b>
		  			<ol>
		  			<?php foreach($v as $a=>$b){ ?>
		  				<li>Project <i>'<?php echo ucwords($b->project_name) ?>'</i> dibuat oleh <b><i><?php echo $b->business_name; ?></i></b>, pada jam <small><?php echo date("G:i A", strtotime($b->project_posted)); ?></small></li>
		  			<?php } ?>	
		  			</ol>
		  		</li>
		  		<?php } ?>
		  	</ul>
		</p>
	  </div>
	  <div class="tab-pane fade" id="last_edited_project">
	  	<p>
		  	<ul>
		  		<?php 		  		
		  		foreach($project_lastupdated as $k=>$v){ 
		  			
					$label_header = (date('Y-m-d') == date('Y-m-d', strtotime($k))) ? 'Today' : $k;
		  			
		  			?>
		  		<li>
		  			<b><?php echo $label_header; ?></b>
		  			<ol>
		  			<?php foreach($v as $a=>$b){ ?>
		  				<li>Project <i>'<?php echo ucwords($b->project_name) ?>'</i> diedit oleh <b><i><?php echo $b->business_name; ?></i></b>, pada jam <small><?php echo date("G:i A", strtotime($b->lastupdate)); ?></small></li>
		  			<?php } ?>	
		  			</ol>
		  		</li>
		  		<?php } ?>
		  	</ul>
		</p>
	  </div>
	</div>
	
	<?php } ?>

</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>