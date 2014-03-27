<div class="container login-container border-radius-10">
   <div class="row" style="margin-bottom:15px">
      <div class="col-sm-12">
         <img src="<?php echo cdn_url(); ?>img/logo_invoice.png" alt="logo" />	
         <h2>Sales Dashboard</h2>
         <p>Please login using your Activorm member account.</p>	
      </div>      
   </div>
   <div class="row">
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
          <div class="col-sm-12">
            <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <input type="submit" name="submit" class="btn btn-default" value="Sign in" />
          </div>
        </div>
      </form>
   </div>
</div>