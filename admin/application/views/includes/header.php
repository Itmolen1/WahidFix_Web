<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title><?php echo $pageTitle; ?></title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
      <style>
         .error{
         color:red;
         font-weight: normal;
         }
      </style>
      <script type="text/javascript" src="<?php echo base_url().'ckeditor/ckeditor.js' ?>"></script>
      <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
      <script type="text/javascript">
         var baseURL = "<?php echo base_url(); ?>";
      </script>
      <link href="<?php echo base_url(); ?>assets/css/jquery.fancybox.min.css" rel="stylesheet" type="text/css" />
      <script src="<?php echo base_url(); ?>assets/js/jquery.fancybox.min.js"></script>
      <script type="text/javascript">
         //$('.image-link').zoomify('zoomIn');
         //$('img').zoomify();
         /*$('img').zoomify({
         duration: 200,
         easing:   'linear',
         scale:    0.9
         });*/
      </script>
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">
      <header class="main-header">
         <a href="<?php echo base_url(); ?>" class="logo">
         <span class="logo-mini"><b>CI</b>AS</span>
         <span class="logo-lg"><b><?php echo APP_NAME; ?></b>AS</span>
         </a>
         <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
               <ul class="nav navbar-nav">
                  <li class="dropdown tasks-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                     <i class="fa fa-history"></i>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="header"> Last Login : <i class="fa fa-clock-o"></i> <?= empty($last_login) ? "First Time Login" : $last_login; ?></li>
                     </ul>
                  </li>
                  <li class="dropdown user user-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="user-image" alt="User Image"/>
                     <span class="hidden-xs"><?php echo $name; ?></span>
                     </a>
                     <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                           <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="User Image" />
                           <p>
                              <?php echo $name; ?>
                              <small><?php echo $role_text; ?></small>
                           </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                           <div class="pull-left">
                              <a href="<?php echo base_url(); ?>profile" class="btn btn-warning btn-flat"><i class="fa fa-user-circle"></i> Profile</a>
                           </div>
                           <div class="pull-right">
                              <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                           </div>
                        </li>
                     </ul>
                  </li>
               </ul>
            </div>
         </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
         <!-- sidebar: style can be found in sidebar.less -->
         <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
               <li class="header">MAIN NAVIGATION</li>
               <li>
                  <a href="<?php echo base_url(); ?>dashboard">
                  <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
                  </a>
               </li>
              
               <?php 
                  $flag=0;
                  $last = $this->uri->total_segments();
                  $record_num = $this->uri->segment($last);
                    
                   if($record_num=='vendor_listing' || $record_num=='item_master_listing' || $record_num=='item_unit_listing' || $record_num=='vehicle_listing' || $record_num=='time_slot_listing' || $record_num=='item_category_listing' || $record_num=='module_master_listing' || $record_num=='role_master_listing')
                   {
                     $flag=1;
                   }
                   if($record_num=='userListing' || $record_num=='guest_user_listing' || $record_num=='r_user_listing')
                   {
                     $flag=2;
                   }
                   if($record_num=='servicesListing' || $record_num=='sub_service_listing' || $record_num=='service_request_listing' || $record_num=='guest_service_request_listing')
                   {
                     $flag=3;
                   }
                   if($record_num=='sliderListing' || $record_num=='contact_us_listing' || $record_num=='careers_listing' || $record_num=='partner_listing')
                   {
                     $flag=4;
                   }
                   if($record_num=='purchase_order_listing' || $record_num=='purchase_master_listing')
                   {
                     $flag=5;
                   }
                   if($record_num=='sales_quotation_listing' || $record_num=='sales_master_listing')
                   {
                     $flag=6;
                   }

                   ///echo "<pre>";print_r($this->session->userdata['role']);die;
               		// menu loads according to rights for users except super admin
                  
                  $alldata=$this->session->all_userdata();
                  $alluserdata=$this->session->userdata['rights'];                 
                  if(isset($alldata['role']) || $alldata['role']!=1)
                  {
                     
                     $modulestodisplay=array_column($alluserdata, 'module_id');


                     ///////////////////////////////masters////////////////////////////////////


                     if(isset($this->session->userdata['myfinal']['module_master_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['module_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['module_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['module_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['role_master_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['role_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['role_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['role_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_delete']==1 ||
                        isset($this->session->userdata['myfinal']['vendor_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['vendor_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['vendor_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['vendor_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['item_master_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['item_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['item_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['item_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_delete']==1 ||
                        isset($this->session->userdata['myfinal']['item_unit_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['item_unit_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['item_unit_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['item_unit_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['item_unit_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['item_unit_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['item_unit_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['item_unit_listing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['vehicle_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['vehicle_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['vehicle_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['vehicle_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['vehicle_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['vehicle_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['vehicle_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['vehicle_listing']['p_delete']==1 ||
                        isset($this->session->userdata['myfinal']['time_slot_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['time_slot_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['time_slot_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['time_slot_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['time_slot_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['time_slot_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['time_slot_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['time_slot_listing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['item_category_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['item_category_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['item_category_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['item_category_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['item_category_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['item_category_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['item_category_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['item_category_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {
                        
                     ?>
                     <li class="<?php if($flag==1){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                        <a href="#">
                        <i class="fa fa-superpowers"></i> <span>Masters</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                           <?php if(isset($this->session->userdata['myfinal']['module_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['module_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['module_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['module_master_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>

                           <li><a href="<?php echo base_url(); ?>module_master_listing"><i class="fa fa-folder-open"></i>Module Master </a></li>

                           <?php } if(isset($this->session->userdata['myfinal']['role_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['role_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['role_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['role_master_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>role_master_listing"><i class="fa fa-handshake-o"></i>Role Management </a></li>

                           <?php } if(isset($this->session->userdata['myfinal']['vendor_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['vendor_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['vendor_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['vendor_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>vendor_listing"><i class="fa fa-address-book"></i>Vendor Master </a></li>

                              <?php } if(isset($this->session->userdata['myfinal']['item_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['item_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['item_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['item_master_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>item_master_listing"><i class="fa fa-indent"></i>Item Master </a></li>

                           <?php } if(isset($this->session->userdata['myfinal']['item_unit_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['item_unit_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['item_unit_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['item_unit_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['item_unit_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['item_unit_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>item_unit_listing"><i class="fa fa-thermometer-empty"></i> Item Unit</a></li>

                           <?php } if(isset($this->session->userdata['myfinal']['vehicle_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['vehicle_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['vehicle_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['vehicle_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['vehicle_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['vehicle_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>vehicle_listing"><i class="fa fa-bus"></i> Vehicle</a></li>

                           <?php } if(isset($this->session->userdata['myfinal']['time_slot_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['time_slot_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['time_slot_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['time_slot_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['time_slot_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['time_slot_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>time_slot_listing"><i class="fa fa-clock-o"></i>Time Slot</a></li>

                           <?php } if(isset($this->session->userdata['myfinal']['item_category_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['item_category_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['item_category_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['item_category_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['item_category_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['item_category_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>item_category_listing"><i class="fa fa-bar-chart"></i>Item Category</a></li>
                           
                           <?php } ?>
                        </ul>
                     </li>

                     <?php 
                     }

                     /////////////////////////users////////////////////////////

                     if(isset($this->session->userdata['myfinal']['userListing']['p_view']) && 
                        $this->session->userdata['myfinal']['userListing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['userListing']['p_add']) && 
                        $this->session->userdata['myfinal']['userListing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['userListing']['p_update']) && 
                        $this->session->userdata['myfinal']['userListing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['userListing']['p_delete']) && 
                        $this->session->userdata['myfinal']['userListing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_delete']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {
                        
                     ?>
                     <li class="<?php if($flag==2){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                        <a href="#">
                        <i class="fa-asterisk"></i> <span>Users</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                           <?php if(isset($this->session->userdata['myfinal']['userListing']['p_add']) && 
                        $this->session->userdata['myfinal']['userListing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['userListing']['p_update']) && 
                        $this->session->userdata['myfinal']['userListing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['userListing']['p_delete']) && 
                        $this->session->userdata['myfinal']['userListing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>

                           <li><a href="<?php echo base_url(); ?>userListing"><i class="fa fa-users"></i>Admin User</a></li>

                           <?php } if(isset($this->session->userdata['myfinal']['guest_user_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['guest_user_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['guest_user_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>guest_user_listing"><i class="fa fa-external-link-square"></i>Guest User</a></li>

                              <?php } if(isset($this->session->userdata['myfinal']['r_user_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['r_user_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['r_user_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>r_user_listing"><i class="fa fa-handshake-o"></i>Registered User</a></li>
                           
                           <?php } ?>
                        </ul>
                     </li>

                     <?php 
                     }

                     /////////////////////////services/////////////////////


                     //echo "<pre>";print_r($modulestodisplay);
                     if(isset($this->session->userdata['myfinal']['servicesListing']['p_view']) && 
                        $this->session->userdata['myfinal']['servicesListing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['servicesListing']['p_add']) && 
                        $this->session->userdata['myfinal']['servicesListing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['servicesListing']['p_update']) && 
                        $this->session->userdata['myfinal']['servicesListing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['servicesListing']['p_delete']) && 
                        $this->session->userdata['myfinal']['servicesListing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['sub_service_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['sub_service_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['sub_service_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['sub_service_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['sub_service_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['sub_service_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['sub_service_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['sub_service_listing']['p_delete']==1 ||
                        isset($this->session->userdata['myfinal']['service_request_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['service_request_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['service_request_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['service_request_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['service_request_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['service_request_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['service_request_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['service_request_listing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['guest_service_request_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['guest_service_request_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['guest_service_request_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['guest_service_request_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['guest_service_request_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['guest_service_request_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['guest_service_request_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['guest_service_request_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {
                        
                     ?>
                     <li class="<?php if($flag==3){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                        <a href="#">
                        <i class="fa fa-bullseye"></i> <span>Services Master</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                           <?php if(isset($this->session->userdata['myfinal']['servicesListing']['p_add']) && 
                        $this->session->userdata['myfinal']['servicesListing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['servicesListing']['p_update']) && 
                        $this->session->userdata['myfinal']['servicesListing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['servicesListing']['p_delete']) && 
                        $this->session->userdata['myfinal']['servicesListing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>

                           <li><a href="<?php echo base_url(); ?>servicesListing"><i class="fa fa-list"></i>Main Services</a></li>

                       		<?php } if(isset($this->session->userdata['myfinal']['sub_service_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['sub_service_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['sub_service_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['sub_service_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['sub_service_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['sub_service_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>sub_service_listing"><i class="fa fa-list-alt"></i>Sub Services</a></li>

                           	<?php } if(isset($this->session->userdata['myfinal']['service_request_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['service_request_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['service_request_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['service_request_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['service_request_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['service_request_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>service_request_listing"><i class="fa fa-truck"></i>Service Request</a></li>

                           <?php } if(isset($this->session->userdata['myfinal']['guest_service_request_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['guest_service_request_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['guest_service_request_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['guest_service_request_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['guest_service_request_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['guest_service_request_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>guest_service_request_listing"><i class="fa fa-truck"></i>Guest Service Request</a></li>
                           
                           <?php } ?>
                        </ul>
                     </li>

                     <?php 
                     }

                     /////////////////////////WEB/////////////////////


                     //echo "<pre>";print_r($modulestodisplay);
                     if(isset($this->session->userdata['myfinal']['sliderListing']['p_view']) && 
                        $this->session->userdata['myfinal']['sliderListing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['sliderListing']['p_add']) && 
                        $this->session->userdata['myfinal']['sliderListing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['sliderListing']['p_update']) && 
                        $this->session->userdata['myfinal']['sliderListing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['sliderListing']['p_delete']) && 
                        $this->session->userdata['myfinal']['sliderListing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['contact_us_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['contact_us_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['contact_us_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['contact_us_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['contact_us_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['contact_us_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['contact_us_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['contact_us_listing']['p_delete']==1 ||
                        isset($this->session->userdata['myfinal']['careers_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['careers_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['careers_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['careers_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['careers_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['careers_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['careers_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['careers_listing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['partner_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['partner_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['partner_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['partner_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['partner_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['partner_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['partner_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['partner_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {
                        
                     ?>
                     <li class="<?php if($flag==4){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                        <a href="#">
                        <i class="fa fa-snowflake-o"></i> <span>Web</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                           <?php if(isset($this->session->userdata['myfinal']['sliderListing']['p_add']) && 
                        $this->session->userdata['myfinal']['sliderListing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['sliderListing']['p_update']) && 
                        $this->session->userdata['myfinal']['sliderListing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['sliderListing']['p_delete']) && 
                        $this->session->userdata['myfinal']['sliderListing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>

                           <li><a href="<?php echo base_url(); ?>sliderListing"><i class="fa fa-sliders"></i>Slider</a></li>

                           <?php } if(isset($this->session->userdata['myfinal']['contact_us_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['contact_us_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['contact_us_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['contact_us_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['contact_us_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['contact_us_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>contact_us_listing"><i class="fa fa-share"></i>Contact Us</a></li>

                              <?php } if(isset($this->session->userdata['myfinal']['careers_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['careers_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['careers_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['careers_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['careers_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['careers_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>careers_listing"><i class="fa fa-calendar-check-o"></i>Careers</a></li>

                           <?php } if(isset($this->session->userdata['myfinal']['partner_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['partner_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['partner_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['partner_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['partner_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['partner_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>partner_listing"><i class="fa fa-handshake-o"></i>Partner</a></li>
                           
                           <?php } ?>
                        </ul>
                     </li>

                     <?php 
                     } 


                     /////////////////////////Purchase/////////////////////


                     //echo "<pre>";print_r($modulestodisplay);
                     if(isset($this->session->userdata['myfinal']['purchase_order_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['purchase_order_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['purchase_order_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['purchase_order_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['purchase_order_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['purchase_order_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['purchase_order_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['purchase_order_listing']['p_delete']==1 || 
                        isset($this->session->userdata['myfinal']['purchase_master_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['purchase_master_listing']['p_view']==1 || 
                        isset($this->session->userdata['myfinal']['purchase_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['purchase_master_listing']['p_add']==1 ||  
                        isset($this->session->userdata['myfinal']['purchase_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['purchase_master_listing']['p_update']==1 || 
                        isset($this->session->userdata['myfinal']['purchase_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['purchase_master_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {
                        
                     ?>
                     <li class="<?php if($flag==5){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                        <a href="#">
                        <i class="fa fa-file-powerpoint-o"></i> <span>Purchase</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                           <?php if(isset($this->session->userdata['myfinal']['purchase_order_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['purchase_order_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['purchase_order_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['purchase_order_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['purchase_order_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['purchase_order_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>

                           <li><a href="<?php echo base_url(); ?>purchase_order_listing"><i class="fa fa-shopping-cart"></i>Purchase Order</a></li>

                           <?php } if(isset($this->session->userdata['myfinal']['purchase_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['purchase_master_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['purchase_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['purchase_master_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['purchase_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['purchase_master_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>purchase_master_listing"><i class="fa-credit-card"></i>Purchase Master</a></li>                              
                           
                           <?php } ?>
                        </ul>
                     </li>

                     <?php 
                     } 


                     /////////////////////////SALES/////////////////////


                     //echo "<pre>";print_r($modulestodisplay);
                     if($this->session->userdata['role']==1 || $this->session->userdata['myfinal']['sales_quotation_listing']['p_add']==1 ||  $this->session->userdata['myfinal']['sales_quotation_listing']['p_update']==1 ||  $this->session->userdata['myfinal']['sales_quotation_listing']['p_delete']==1 || $this->session->userdata['myfinal']['sales_master_listing']['p_add']==1 ||  $this->session->userdata['myfinal']['sales_master_listing']['p_update']==1 ||  $this->session->userdata['myfinal']['sales_master_listing']['p_delete']==1)
                     {
                        
                     ?>
                     <li class="<?php if($flag==6){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                        <a href="#">
                        <i class="fa fa-file-powerpoint-o"></i> <span>Sales</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                           <?php if(isset($this->session->userdata['myfinal']['sales_quotation_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['sales_quotation_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['sales_quotation_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['sales_quotation_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['sales_quotation_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['sales_quotation_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>

                           <li><a href="<?php echo base_url(); ?>sales_quotation_listing"><i class="fa fa-shopping-cart"></i>Sales Quotation</a></li>

                           <?php } if(isset($this->session->userdata['myfinal']['sales_master_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['sales_master_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['sales_master_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['sales_master_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['sales_master_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['sales_master_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                           
                           <li><a href="<?php echo base_url(); ?>sales_master_listing"><i class="fa-credit-card"></i>Sales</a></li>                              
                           
                           <?php } ?>
                        </ul>
                     </li>

                     <?php 
                     }

                     /////////////////////////EMPLOYEES/////////////////////


                     //echo "<pre>";print_r($modulestodisplay);
                     if(isset($this->session->userdata['myfinal']['employee_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['employee_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['employee_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['employee_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['employee_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['employee_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['employee_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['employee_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {                        
                     ?>
	               		<li>
						  <a href="<?php echo base_url(); ?>employee_listing">
						  <i class="fa fa-user"></i>
						  <span>Employees</span>
						  </a>
						</li>

                     <?php 
                     }  

                     /////////////////////////Reports/////////////////////


                     //echo "<pre>";print_r($modulestodisplay);
                     if(isset($this->session->userdata['myfinal']['Reports_listing']['p_view']) && 
                        $this->session->userdata['myfinal']['Reports_listing']['p_view']==1 ||
                        isset($this->session->userdata['myfinal']['Reports_listing']['p_add']) && 
                        $this->session->userdata['myfinal']['Reports_listing']['p_add']==1 ||
                        isset($this->session->userdata['myfinal']['Reports_listing']['p_update']) && 
                        $this->session->userdata['myfinal']['Reports_listing']['p_update']==1 ||
                        isset($this->session->userdata['myfinal']['Reports_listing']['p_delete']) && 
                        $this->session->userdata['myfinal']['Reports_listing']['p_delete']==1 ||
                        $this->session->userdata['role']==1)
                     {                        
                     ?>
	               		<li>
						  <a href="<?php echo base_url(); ?>Reports_listing">
						  <i class="fa fa-files-o"></i>
						  <span>Reports</span>
						  </a>
						</li>

                     <?php 
                     }             
                  }




                  /////////////////////////////this is for admin////////////////////
                  else
                  {
                      $last = $this->uri->total_segments();
                      $record_num = $this->uri->segment($last);
                       
                      if($record_num=='vendor_listing' || $record_num=='item_master_listing' || $record_num=='item_unit_listing' || $record_num=='vehicle_listing' || $record_num=='time_slot_listing' || $record_num=='item_category_listing' || $record_num=='module_master_listing')
                      {
                        $flag=1;
                      }
                      if($record_num=='userListing' || $record_num=='guest_user_listing' || $record_num=='r_user_listing')
                      {
                        $flag=2;
                      }
                      if($record_num=='servicesListing' || $record_num=='sub_service_listing' || $record_num=='service_request_listing' || $record_num=='guest_service_request_listing')
                      {
                        $flag=3;
                      }
                      if($record_num=='sliderListing' || $record_num=='contact_us_listing' || $record_num=='careers_listing' || $record_num=='partner_listing')
                      {
                        $flag=4;
                      }
                      if($record_num=='purchase_order_listing' || $record_num=='purchase_master_listing')
                      {
                        $flag=5;
                      }
                      if($record_num=='sales_quotation_listing' || $record_num=='sales_master_listing')
                      {
                        $flag=6;
                      }
                  
                      ?>
               

               <li class="<?php if($flag==1){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                  <a href="#">
                  <i class="fa fa-superpowers"></i> <span>Masters</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li><a href="<?php echo base_url(); ?>module_master_listing"><i class="fa fa-folder-open"></i>Module Master </a></li>
                     <li><a href="<?php echo base_url(); ?>vendor_listing"><i class="fa fa-address-book"></i>Vendor Master </a></li>
                     <li><a href="<?php echo base_url(); ?>item_master_listing"><i class="fa fa-indent"></i>Item Master </a></li>
                     <li><a href="<?php echo base_url(); ?>item_unit_listing"><i class="fa fa-thermometer-empty"></i> Item Unit</a></li>
                     <li><a href="<?php echo base_url(); ?>vehicle_listing"><i class="fa fa-bus"></i> Vehicle</a></li>
                     <li><a href="<?php echo base_url(); ?>time_slot_listing"><i class="fa fa-clock-o"></i>Time Slot</a></li>
                     <li><a href="<?php echo base_url(); ?>item_category_listing"><i class="fa fa-bar-chart"></i>Item Category</a></li>
                  </ul>
               </li>

               <li>
                  <a href="<?php echo base_url(); ?>employee_listing">
                  <i class="fa fa-user"></i>
                  <span>Employees</span>
                  </a>
               </li>

               <li class="<?php if($flag==2){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                  <a href="#">
                  <i class="fa-asterisk"></i> <span>Users</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li><a href="<?php echo base_url(); ?>userListing"><i class="fa fa-users"></i>Admin User</a></li>
                     <li><a href="<?php echo base_url(); ?>guest_user_listing"><i class="fa fa-external-link-square"></i>Guest User</a></li>
                     <li><a href="<?php echo base_url(); ?>r_user_listing"><i class="fa fa-handshake-o"></i>Registered User</a></li>
                  </ul>
               </li>

               <li class="<?php if($flag==3){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                  <a href="#">
                  <i class="fa fa-bullseye"></i> <span>Services Master</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li><a href="<?php echo base_url(); ?>servicesListing"><i class="fa fa-list"></i>Main Services</a></li>
                     <li><a href="<?php echo base_url(); ?>sub_service_listing"><i class="fa fa-list-alt"></i>Sub Services</a></li>
                     <li><a href="<?php echo base_url(); ?>service_request_listing"><i class="fa fa-truck"></i>Service Request</a></li>
                     <li><a href="<?php echo base_url(); ?>guest_service_request_listing"><i class="fa fa-truck"></i>Guest Service Request</a></li>
                  </ul>
               </li>

               <li class="<?php if($flag==4){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                  <a href="#">
                  <i class="fa fa-snowflake-o"></i> <span>Web</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li><a href="<?php echo base_url(); ?>sliderListing"><i class="fa fa-sliders"></i>Slider</a></li>
                     <li><a href="<?php echo base_url(); ?>contact_us_listing"><i class="fa fa-share"></i>Contact Us</a></li>
                     <li><a href="<?php echo base_url(); ?>careers_listing"><i class="fa fa-calendar-check-o"></i>Careers</a></li>
                     <li><a href="<?php echo base_url(); ?>partner_listing"><i class="fa fa-handshake-o"></i>Partner</a></li>
                  </ul>
               </li>

               <li class="<?php if($flag==5){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                  <a href="#">
                  <i class="fa fa-file-powerpoint-o"></i> <span>Purchase</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li><a href="<?php echo base_url(); ?>purchase_order_listing"><i class="fa fa-shopping-cart"></i>Purchase Order</a></li>
                     <li><a href="<?php echo base_url(); ?>purchase_master_listing"><i class="fa-credit-card"></i>Purchase Master</a></li>
                  </ul>
               </li>

               <li class="<?php if($flag==6){ echo 'treeview active menu-open'; } else echo 'treeview'; ?>" style="height: auto;">
                  <a href="#">
                  <i class="fa fa-file-powerpoint-o"></i> <span>Sales</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                  </a>
                  <ul class="treeview-menu">
                     <li><a href="<?php echo base_url(); ?>sales_quotation_listing"><i class="fa fa-shopping-cart"></i>Sales Quotation</a></li>
                     <li><a href="<?php echo base_url(); ?>sales_master_listing"><i class="fa-credit-card"></i>Sales</a></li>
                  </ul>
               </li>

               <li>
                  <a href="#" >
                  <i class="fa fa-files-o"></i>
                  <span>Reports</span>
                  </a>
               </li>

               <?php 
                  }
                  ?>
            </ul>
         </section>
         <!-- /.sidebar -->
      </aside>