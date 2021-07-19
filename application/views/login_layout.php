<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
		<title>Mpower</title>
		<meta name="description" content="iview application" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
<div class="login-box-body">
     <div class="login-logo">
    <a href=""><img src="<?php echo base_url(); ?>assets/dist/image/logo.png" style="width: 70%;"></a>
      </div>

<br>
  <?php echo $content_for_layout; ?>
   <!--  <a href="register.html" class="text-center">Register a new membership</a> -->
  </div>
  <!-- /.login-box-body -->
</div>

<!-- /.login-box -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
