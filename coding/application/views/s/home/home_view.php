<?php $this->load->view('s/general/header_view', $this->data); ?>

<div class="col-sm-2 col-md-3">
   <ul class="nav nav-sidebar">
      <li>
         <a href="">a</a>
      </li>
      <li>
         <a href="">b</a>
      </li>
      <li>
         <a href="">c</a>
      </li>
   </ul>
</div>

<div class="col-sm-10 col-md-9">
   <pre>
   <?php print_r($this->session->userdata('account_sales')); ?>
   </pre>
</div>

<?php $this->load->view('s/general/footer_view', $this->data); ?>