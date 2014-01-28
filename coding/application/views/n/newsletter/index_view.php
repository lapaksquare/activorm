<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Newsletter</h2>	
	
	<hr />
	
	<form class="form-inline" role="form" method="get">
		<a href="<?php echo base_url(); ?>admin/newsletter/add_newsletter" class="btn btn-default">Add Newsletter</a>
	</form>
	
	<table class="table table-hover">
        <thead>
          <tr>
            <th>Newsletter Subject</th>
            <th>Newsletter Target</th>
            <th>Sending DateTime</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
        	<?php 
        	foreach($this->newsletters as $k=>$v){
        	?>
        	<tr>
        		<td><?php echo ucwords($v->newsletter_subject); ?></td>
        		<td><?php echo ucwords($v->newsletter_target); ?>
        			
        			<?php if (!empty($v->newsletter_testing_email) && $v->newsletter_target == "testing") { ?>
        			<p>Send Email to <b><i><?php echo $v->newsletter_testing_email; ?></i></b></p>
        			<?php } ?>
        			
        		</td>
        		<td><?php echo date('d M Y', strtotime($v->newsletter_sending_schedule)); ?></td>
        		<td><?php echo ucwords($v->status); ?></td>
        		<td>
        			<a href="<?php echo base_url(); ?>admin/newsletter/details?nid=<?php echo $v->newsletter_id; ?>&nidh=<?php echo sha1($v->newsletter_id . SALT); ?>" class="btn btn-primary">Details</a>
        			<a href="<?php echo base_url(); ?>admin/newsletter/remove?nid=<?php echo $v->newsletter_id; ?>&nidh=<?php echo sha1($v->newsletter_id . SALT); ?>" class="btn btn-xs btn-danger">Remove</a>
        		</td>
        	</tr>
        	<?php	
        	}
        	?>		
        
        </tbody>
      </table>

		<?php 
			if (!empty($pagination)) echo $pagination;
		?>
	
</div>

<?php $this->load->view('n/general/footer_view', $this->data); ?>	