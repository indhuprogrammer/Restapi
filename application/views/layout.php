<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8" />
		<title>Mpower</title>
		<meta name="description" content="mpower application" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/bower_components/Ionicons/css/ionicons.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/base.css?v=3.2" type="text/css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/jquery.dataTables.min.css">
		<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery-1.9.1-min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/bootstrap.min.js"></script>
<style>
.hide-calendar .ui-datepicker-calendar { display: none; }
button.ui-datepicker-current { display: none; }
.ui-datepicker-calendar { display: none; }
.dept_section{ width:100%; float:left; margin:20px 0 0 0; }
.dept_section div{ width:49%; }
.dept_section div:first-child{ margin-right:2% }
table.bu-tbl th{ text-align:center; }
table.bu-tbl{ width:70%; }
table.bu-tbl-inr th{ text-align:center; }
.clearfix{ clear: both;}
.drill-data th, tr.row-header td {
  background: url(../img/toolbar_hover.png) repeat-x scroll 0 bottom orange;
    border: 1px solid white;
    color: #FFFFFF;
}
.filter-box th, tr.row-header td {
  background: url(../img/toolbar_hover.png) repeat-x scroll 0 bottom grey;
    border: 1px solid grey;
    color: #FFF;
}
</style>	
</head>	
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper"> 
<header class="main-header">
    <!-- Logo -->
 <a href="#" class="logo">
      <span class="logo-mini"><img src="<?php echo base_url(); ?>assets/dist/image/logo.png" style="width: 93%;"></span>
      <span class="logo-lg"><img src="<?php echo base_url(); ?>assets/dist/image/logo.png" style="width: 33%;"></span>
  </a>
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>assets/dist/image/admin.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"></span>
            </a>
             <ul class="dropdown-menu">
             <li class="user-header">
                <img src="<?php echo base_url(); ?>assets/dist/image/admin.jpg" class="img-circle" alt="User Image">
                <p>
                 Mpower
                </p>
              </li> 
             <li class="user-footer">            
                <div class="pull-right">
                  <a href="<?php echo base_url() ?>examples/logout" class="btn btn-default btn-flat">log out</a>
                </div>
              </li> 
            </ul>
			 </li>
            </ul>
      </div>
    </nav>
 </header>   
<aside class="main-sidebar">
<section class="sidebar">
<ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="<?php echo base_url(); ?>dashboard">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span><span class="pull-right-container">
            </span>           
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>employee_report/employee_project_meter">
            <i class="fa fa-files-o"></i>
            <span>Project Meter</span><span class="pull-right-container">
            </span>           
          </a>
        </li>
        <li>
          <a href="<?php echo base_url(); ?>employee_report/monthly_employee_effort">
            <i class="fa fa-laptop"></i>
            <span>Monthly Effort</span><span class="pull-right-container">
            </span>
          </a>
        </li>
         <!--<li class="treeview">
          <a href="">
            <i class="fa fa-laptop"></i>
            <span>Add</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
           
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Add </a></li>
            <li><a href=""><i class="fa fa-circle-o"></i>List</a></li>          
          </ul>
        </li>-->   
      </ul>
</section>
</aside> 
<?php echo $content_for_layout; ?>
 <footer class="main-footer">  
    <strong>Copyright &copy; 2021 <a href="https://enoahisolution.com" target="_blank">Enoah isolution</a>.</strong> All rights
    reserved.
  </footer>
</div>

</body>
</html>