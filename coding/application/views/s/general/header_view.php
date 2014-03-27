<!DOCTYPE HTML>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="author" content="">
   
   <link rel="shortcut icon" href="<?php echo cdn_url(); ?>img/75x75.png">
   
   <title><?php echo $title; ?></title>
   <?php echo $css_tags; ?>
   <script type="text/javascript">
      var base_url = "<?php echo base_url(); ?>";
   </script>
</head>
<body>
   <?php if ($menu != "login"){ ?>
   <header class="navbar navbar-default navbar-static-top bs-docs-nav" role="banner">
      <div class="container-fluid">
         <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <a href="<?php echo base_url() ?>sales" class="navbar-brand">
               <img src="<?php echo cdn_url(); ?>img/logo.png" alt="Activorm" /> 
               <span>Sales Dashboard</span>
            </a>
         </div>
         <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav navbar-right">
            <?php 
               $account = $this->session->userdata('account_sales');
               if (!empty($account)){
            ?>
               <li>
                  <a href="<?php echo base_url(); ?>sales/login/logout">Logout</a>
               </li>
            <?php } ?>
            </ul>
         </nav>
      </div>
   </header>
   <?php } ?>