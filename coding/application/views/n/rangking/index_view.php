<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-12 lp-header" role="main">
	
	<h2 style="float:left;">Rangking</h2>	
	
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
	
	<table class="table table-hover table-striped">
        <thead>
          <tr>
            <th>Member Join</th>
            <th>Business Name</th>
            <th>Project Title</th>
            <th>Period</th>
            <th>Pageviews</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        	
        	<?php foreach($this->results as $k=>$v){ ?>
        	<?php $startdate = date("d M Y, H:i", strtotime($v->project_period . "-" . $v->project_period_int.'days')); ?>
        	<?php $enddate = date("d M Y, H:i", strtotime($v->project_period)); ?>
        	<tr>
        		<td><?php echo $v->jml_member_join; ?></td>
        		<td><?php echo ucwords($v->business_name); ?></td>
        		<td><?php echo ucwords($v->project_name); ?></td>
        		<td><?php echo ($v->project_period_int); ?> hari. <br /> <small><?php echo $startdate.' s/d '.$enddate; ?></small></td>
        		<td><?php echo (empty($v->pageviews)) ? 0 : $v->pageviews; ?> <br /> <small><a href="<?php echo base_url(); ?>admin/rangking/getDataGA?pid=<?php echo $v->project_id; ?>">GetDataGA</a></small></td>
        		<td>
        			<ul>
        			<?php 
        			$data_action = json_decode($v->project_actions_data);
					foreach($data_action as $a=>$b){
					?>
						<li><?php echo ucwords( $b->type_name ) . ' <b>('.$v->jml_member_join.')</b>'; ?></li>
					<?php	
					}
        			?>
        			</ul>
        		</td>
        	</tr>
        	<?php } ?>
        	
        </tbody>
      </table>

</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>