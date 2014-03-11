<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Project</h2>	
	
	<hr />
	
	<form class="form-inline" role="form" method="get">
	  <div class="form-group">
	    <label class="sr-only" for="search_by">Filter</label>
	    <select class="form-control" name="project_status" id="project_status">
	    	<?php 
	    	$sb = array(
				"All" => "All",
				"Online" => "On-Going/Online",
				"Offline" => "Pending/Offline",
				"Draft" => "Draft",
				"Closed" => "Closed"
			);
			foreach($sb as $k=>$v){
				$class = ($k == $this->project_status) ? "selected" : "";
			?>
			<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
			<?php
			}
	    	?>
	    </select>
	  </div>
	  <div class="form-group">
	    <label class="sr-only" for="search_by">Search By</label>
	    <select class="form-control" name="search_by" id="search_by">
	    	<?php 
	    	$sb = array(
				"pp.project_id" => "Project Id",
				"pp.project_name" => "Project Name",
				"bp.business_id" => "Business Id",
				"bp.business_name" => "Business Name"
			);
			foreach($sb as $k=>$v){
				$class = ($k == $this->search_by) ? "selected" : "";
			?>
			<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
			<?php
			}
	    	?>
	    </select>
	  </div>
	  <div class="form-group">
	    <input type="text" class="form-control" id="q" name="q" placeholder="Keyword" value="<?php echo $this->q; ?>">
	  </div>
	  <button type="submit" class="btn btn-default">Search</button>
	</form>
	
	<hr />
	
	<table class="table table-hover">
        <thead>
          <tr>
            <th>Posted</th>
            <th>Project Name</th>
            <th>Business Name</th>
            <th>Period</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        	<?php foreach($projects as $k=>$v){ 
        		
				$project_live = $v->project_live;
				if ($project_live == "Online"){
					$project_period = strtotime($v->project_period);
					$project_now = strtotime(date('Y-m-d H:i:s'));
					$period = $project_period - $project_now;
					$period = ($period > 0) ? date('d', $period) : 0;
				}
				
				if ($this->project_status != "All"){
					if ($this->project_status != $project_live) continue;
				}
				
        		?>
        	<tr>
        		<td><?php echo date("d M Y, H:i", strtotime($v->project_posted)); ?></td>
        		<td><a href="<?php echo base_url(); ?>project/<?php echo $v->project_uri; ?>?Preview=1" target="_blank"><?php echo ucwords($v->project_name); ?></a></td>
        		<td><?php echo ucwords($v->business_name); ?></td>
        		<td>
        			<?php if ($project_live == "Online"){ ?>
        			<?php if ($period > 0){ ?>
					<?php echo $period; ?> Day<?php echo ($period == 1) ? '' : 's'; ?> Left
					<?php } ?>
					<?php }else echo "-"; ?>
        		</td>
        		<td><?php echo ucwords($project_live); ?></td>
        		<td><a href="<?php echo base_url(); ?>admin/project/project_detail?pid=<?php echo $v->project_id; ?>&h=<?php echo sha1($v->project_id . SALT); ?>" class="btn btn-primary">Details</a></td>
        	</tr>	
        	<?php } ?>	
        </tbody>
      </table>

		<?php 
			if (!empty($pagination)) echo $pagination;
		?>

</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>