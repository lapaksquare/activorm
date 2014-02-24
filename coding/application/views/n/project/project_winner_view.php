<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2 style="float:left;">Project Winner</h2>	
	
	<div class="pull-right">
		<select id="prize_drop" class="form-control">
			<?php 
			$prize_drop = array(
				'Online' => 'On-Going Projects',
				'Closed' => 'Closed'
			);
			foreach($prize_drop as $k=>$v){
				$class = ($k == $this->project_live) ? 'selected' : '';
			?>
			<option value="<?php echo $k; ?>" <?php echo $class; ?>><?php echo $v; ?></option>
			<?php } ?>
		</select>
	</div>
	
	<div class="clearfix"></div>
	
	<hr />
	
	<form class="form-inline" role="form" method="get">
	  <div class="form-group">
	    <label class="sr-only" for="search_by">Search By</label>
	    <select class="form-control" name="search_by" id="search_by">
	    	<?php 
	    	$sb = array(
				"pp.project_name" => "Project Name",
				"bp.business_name" => "Business Name",
				"both" => "Both"
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
	  <input type="hidden" name="project_live" value="<?php echo $this->project_live; ?>" />
	  <button type="submit" class="btn btn-default">Search</button>
	</form>
	
	<table class="table table-hover">
        <thead>
          <tr>
			<th>Project Name</th>
			<th>Business Name</th>
			<th>Account Name/Email</th>
			<th>Period</th>
			<th>Jumlah Tiket/Member</th>
			<th>Actions</th>
          </tr>
        </thead>
        <tbody>
        	
        	<?php foreach($projects as $k=>$v){
        		
				$project_period = strtotime($v->project_period);
				$project_now = strtotime(date('Y-m-d H:i:s'));
				$period = $project_period - $project_now;
				$period = ($period > 0) ? (int)date('d', $period) : 0;
					
				$period_string = "";	
		    	if ($period > 0){
					$period_string .= $period .' Day';
					$period_string .= ($period == 1) ? '' : 's';
					$period_string .= " Left";
				}
        		
				echo '<tr>
					<td>'.ucwords($v->project_name).'</td>
					<td>'.ucwords($v->business_name).'</td>
					<td>'.ucwords($v->account_name).' / '.$v->account_email.'</td>
					<td>'.$period_string.'</td>
					<td>'.$v->jml_tiket.'</td>
					<td><a href="'.base_url().'admin/project_winner/details?pid='.$v->project_id.'&h='.sha1($v->project_id . SALT).'" class="btn btn-default">Details</a></td>
				</tr>';	
			?>		 

        	<?php } ?>
        	
        </tbody>
    </table>
	
	<?php 
	if (!empty($pagination)) echo $pagination;
	?>
	
</div>

<?php $this->load->view('n/general/footer_view', $this->data); ?>