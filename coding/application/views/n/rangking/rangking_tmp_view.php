<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
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
	
	<table class="table table-hover">
        <thead>
          <tr>
            <th>Member Join</th>
            <th>Business Name</th>
            <th>Project Title</th>
            <th>Details</th>
          </tr>
        </thead>
        <tbody>
        	
        	<?php foreach($this->results as $k=>$v){ ?>
        	<tr>
        		<td><?php echo $v['jml_member_join']; ?></td>
        		<td><?php echo ucwords($v['business_name']); ?></td>
        		<td><?php echo ucwords($v['project_name']); ?></td>
        		
        		<td>
        			<b>Periode:</b> <?php echo ($v['project_period_int']); ?> hari <br />
        			<b>Actions:</b>
        			<ul>
        			<?php 
        			$data_action = json_decode($v['project_actions_data']);
					foreach($data_action as $a=>$b){
					?>
						<li><?php echo ucwords( $b->type_name ); ?></li>
					<?php	
					}
        			?>
        			</ul>
        			<b>Start Date:</b> <?php echo date("d M Y, H:i", strtotime($v['project_period'] . "-" . $v['project_period_int'].'days')); ?>. <b>End Date:</b> <?php echo date("d M Y, H:i", strtotime($v['project_period'])); ?>
        			<br />
        			<b>Page Views:</b> <?php echo (empty($v['pageviews'])) ? 0 : $v['pageviews']; ?>
        		</td>
        		
        	</tr>
        	<?php } ?>
        	
        </tbody>
      </table>

		<?php 
		if (!empty($pagination)) echo $pagination;
		?>

</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>