<?php $this->load->view('s/general/header_view', $this->data); ?>
		
					
		
					<div class="col-md-5">	
						<?php 
						$msg_s_access = $this->session->userdata('msg_s_access');
						if ($msg_s_access == 1){
							$this->session->unset_userdata('msg_s_access');
						?>
						<div class="bs-callout bs-callout-danger">
					      <p>Login failed. Please check your username and password and then try again.</p>
					    </div>
					    <?php } ?>
						
						<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>sales/auth/submit_login">
						  <div class="form-group">
						    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
						    <div class="col-sm-10">
						      <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
						    </div>
						  </div>
						  <div class="form-group">
						    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
						    <div class="col-sm-10">
						      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
						    </div>
						  </div>
						  <div class="form-group">
						    <div class="col-sm-offset-2 col-sm-10">
						      <input type="submit" name="submit" class="btn btn-default" value="Sign in" />
						    </div>
						  </div>
						</form>
					</div>	
				
		
<?php $this->load->view('n/general/footer_view', $this->data); ?>