<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-3">

<?php $this->load->view('n/general/sidebar_view', $this->data); ?>

</div>

<div class="col-md-9 lp-header" role="main">
	
	<h2>Add Banner</h2>	
	
	<hr />
	
	<form role="form" method="post" action="<?php echo base_url(); ?>admin/banner/submit_upload_banner" enctype="multipart/form-data">
	  <div class="form-group">
	    <label for="banner_name">Banner Name</label>
	    <input type="text" class="form-control" name="banner_name" id="banner_name" placeholder="">
	  </div>
	  <div class="form-group">
	    <label for="banner_link">Banner Link</label>
	    <input type="text" class="form-control" name="banner_link" id="banner_link" placeholder="">
	  </div>
	  <div class="form-group">
	    <label for="banner_detail">Banner Detail</label>
	    <input type="text" class="form-control" name="banner_detail" id="banner_detail" placeholder="">
	  </div>
	  <div class="form-group">
	    <label for="banner_image">Banner Image</label>
	    <input type="file" name="banner_image" id="banner_image" />
	  </div>
	  <button type="submit" class="btn btn-default" name="banner_submit">Submit</button>
	</form>
	
	<hr />
	
	<h2>List Banner</h2>	
	
	<form role="form" method="post" action="<?php echo base_url(); ?>admin/banner/submit_summery_banner" enctype="multipart/form-data">
	
	<table class="table">
		<thead>
			<tr>
				<th>Image</th>
				<th>Detail</th>
				<th>IsActive</th>
				<th>Priority</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($this->banners as $k=>$v){ 
				
				$photo_resize = $this->mediamanager->getPhotoUrl($v->banner_image, "200x200");
				
				?>
				<tr>
					<td><img src="<?php echo cdn_url() . $photo_resize; ?>" /></td>
					<td>
						<b>Banner Name: </b><?php echo (empty($v->banner_name)) ? "-" : $v->banner_name; ?><br />
						<b>Banner Link: </b><?php echo (empty($v->banner_link)) ? "-" : $v->banner_link; ?><br />
						<b>Banner Detail: </b><?php echo (empty($v->banner_detail)) ? "-" : $v->banner_detail; ?><br />
					</td>
					<td>
						<?php 
						$isactive_array = array(
							0 => 'Deleted',
							1 => 'Active'
						);
						?>
						<select name="isactive[<?php echo $v->banner_id; ?>]">
							<?php foreach($isactive_array as $a=>$b){
								$class = ($a == $v->isactive) ? 'selected' : '';
							?>
							<option value="<?php echo $a; ?>" <?php echo $class; ?>><?php echo $b; ?></option>
							<?php	
							} ?>
						</select>
					</td>
					<td>
						<input type="text" class="form-control" name="banner_priority[<?php echo $v->banner_id; ?>]" value="<?php echo $v->banner_priority; ?>" style="width:100px;" />
						<input type="hidden" name="banner_id[]" value="<?php echo $v->banner_id; ?>" />
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	
	<button type="submit" class="btn btn-success" name="banner_submit">Save</button>
	
	</form>	
	
</div>

</div>	

<?php $this->load->view('n/general/footer_view', $this->data); ?>