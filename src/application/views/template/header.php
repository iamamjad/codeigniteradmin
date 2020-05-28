<?php
$logged_in = $this->session->userdata('personEmail');
$logged_in.= $this->session->userdata('PersonName');
$logged_in.= $this->session->userdata('personRole');


if(!$logged_in){

 //redirect('Admin','refresh');
  redirect(base_url());
}


 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Web Management</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->

	<!-- Latest compiled and minified CSS -->

	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">



	<!-- Latest compiled and minified JavaScript -->

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>




  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css'); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">

  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css'); ?>">


	<!-- DataTables -->
	<script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>

	<!-- AdminLTE App -->
	<script src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script>
	<script src="<?php echo base_url('assets/src/scripts/index.js'); ?>"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url();?>Admin/welcome" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Web</b>Mangement</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
  

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('personEmail'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg');?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata('PersonName'); ?>
                  <small><?php echo date('d-m-Y')?></small>
                </p>
              </li>
      
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                   <a href="#" class="btn btn-default btn-flat">Profile</a>
<!--                 <button type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#modal-default">-->
<!--                change Password-->
<!--              </button>-->

                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url();?>Admin/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
      
        </ul>
      </div>
    </nav>
  </header>



<!--	<div class="modal fade" id="modal-default">-->
<!--          <div class="modal-dialog">-->
<!--            <div class="modal-content">-->
<!--              <div class="modal-header">-->
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                  <span aria-hidden="true">&times;</span></button>-->
<!--                <h4 class="modal-title">Change Password </h4>-->
<!--              </div>-->
<!--              <div class="modal-body">-->
<!--              --><?php //echo form_open();?>
<!--              <input class="form-control" type="text" name="oldPassword" id="oldPassword" placeholder="Enter you old Password">-->
<!--              <br>-->
<!--              <input class="form-control" name="newPassword" id="newPassword" type="text" placeholder="New Password">-->
<!--              <br>-->
<!--              <input class="form-control" name="confirmNewPassword" id="confirmNewPassword" type="text" placeholder="Confirm New Password">-->
<!---->
<!--				  <input type="hidden" id="dummy" name="dummy" value="--><?php //echo $this->session->userdata('personEmail'); ?><!--">-->
<!--			  </div>-->
<!--              <span id="successMessage1" style="text-align: center; color: red; margin-left: 16px !important;"></span>-->
<!---->
<!--               <span id="passwordNotMatch" style="text-align: center; color: red; margin-left: 1px !important;"></span>-->
<!--				<span  style="text-align: center; color: red; margin-left: 1px !important;">-->
<!--				--><?php //echo $this->session->flashdata('invalidPassword'); ?>
<!--				</span>-->
<!---->
<!---->
<!--              --><?php //echo form_close();?>
<!--              <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>-->
<!--                <button type="Submit" name="saveChanges" id= "saveChanges"class="btn btn-primary">Save changes</button>-->
<!--              </div>-->
<!--            </div>-->
<!--             /.modal-content -->
<!--          </div>-->
<!--           /.modal-dialog -->
<!--        </div>-->


