<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Project Active</h2>	
	
	<hr />
	
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
	
</div>

<?php $this->load->view('n/general/footer_view', $this->data); ?>