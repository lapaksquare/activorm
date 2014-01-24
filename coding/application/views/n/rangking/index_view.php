<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Rangking</h2>	
	
	<hr />
	
	<table class="table table-hover">
        <thead>
          <tr>
            <th>Member Join</th>
            <th>Business Name</th>
            <th>Project Title</th>
            <th>Lama Hari</th>
            <th>3 Actions</th>
          </tr>
        </thead>
        <tbody>
        	
        	<?php foreach($this->results as $k=>$v){ ?>
        	<tr>
        		<td><?php echo $v->jml_member_join; ?></td>
        		<td><?php echo ucwords($v->business_name); ?></td>
        		<td><?php echo ucwords($v->project_name); ?></td>
        		<td><?php echo ($v->project_period_int); ?> hari</td>
        		<td>
        			<ul>
        			<?php 
        			$data_action = json_decode($v->project_actions_data);
					foreach($data_action as $k=>$v){
					?>
						<li><?php echo ucwords( $v->type_name ); ?></li>
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