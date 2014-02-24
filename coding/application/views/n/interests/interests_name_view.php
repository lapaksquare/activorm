<?php $this->load->view('n/general/header_view', $this->data); ?>

<div class="col-md-12 lp-header" id="main" role="main">
	
	<div class="box-header">
		<h2 style="float:left;">Interests Category</h2>	
	</div>
	
	<div class="clearfix"></div>
	
	<hr />

	<div class="graph_signup">
		<div class="box-header">
			
			<table class="table table-hover" id="table">
		        <thead>
		          <tr>
					<th>Interests Name</th>
					<th>Jumlah Interests</th>
					<th>Parent Interests</th>
		          </tr>
		        </thead>
		        <tbody>
		        	<?php 					
					foreach($this->interests_name as $k=>$v){
					?>
					
					<tr>
						<td><?php echo ucwords( $v->name ); ?></td>
						<td><?php echo $v->jml_category; ?></td>
						<td>
							<select name="parent_interests" id="parent_interests" 
							data-interest_id="<?php echo $v->interests_id; ?>" 
							data-name="<?php echo ( $v->name ); ?>">
							<option value="0">Pilih</option>
							<?php 
							foreach($this->parent_interests as $a=>$b){
								$class = (!empty($v->mip_id) && $v->mip_id == $b->mip_id) ? "selected" : "";
							?>
								<option value="<?php echo $b->mip_id; ?>" <?php echo $class; ?>><?php echo ucwords($b->mip_name); ?></option>
							<?php	
							}
							?>
							</select>
							<span class="glyphicon" id="glyphicon"></span>
						</td>
					</tr>
					
					<?php	
					}
		        	?>
		        </tbody>
			</table>	
			
		</div>
	</div>	
	
</div>

<?php $this->load->view('n/general/footer_view', $this->data); ?>