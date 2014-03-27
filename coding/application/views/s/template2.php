<?php $this->load->view('s/general/header_view', $this->data); ?>

<div class="container-fluid content">
   <div class="wrapper">
      <div class="row">
      
         <div class="col-sm-2 col-md-3 nav-sales">
            <?php $this->load->view('s/general/navbar_view', $this->data); ?>
         </div>
         
         <div class="col-sm-10 col-md-9 content-sales">
            <?php $this->load->view("s/$menu/$menu". "_view", $this->data); ?>
         </div>

      </div>
   <div>
</div>

<?php $this->load->view('s/general/footer_view', $this->data); ?>