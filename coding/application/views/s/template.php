<?php $this->load->view('s/general/header_view', $this->data); ?>

<?php
   if($this->data['menu'] == 'login'){
      $this->load->view('s/login/login_view', $this->data);
   }
   else{
?>

<div class="container-fluid notification">
</div>

<?php
   if($this->data['menu'] == 'home'){
      $this->load->view('s/home/team_view', $this->data);
   }
?>

<div class="container-fluid content">
   <div class="row content-row">
   
      <div class="col-sm-2 col-md-3 nav-sales">
         <?php $this->load->view('s/general/navbar_view', $this->data); ?>
      </div>
      
      <div class="col-sm-10 col-md-9 content-sales">
         <?php $this->load->view("s/$menu/$menu". "_view", $this->data); ?>
      </div>

   </div>
</div>

<?php
   }
?>

<?php $this->load->view('s/general/footer_view', $this->data); ?>