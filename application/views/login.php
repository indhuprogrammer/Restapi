<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <p class="login-box-msg">LOGIN</p>
   <form method="POST" action="login.php">
      <div class="form-group has-feedback">
        <input type="text" id="username" name="username" required class="form-control" placeholder="Username or Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
      <input type="password" id="password" name="password" required class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit"  id="submit" name="submit" value="Log in" class="btn btn-primary btn-block btn-flat login_btn">Sign In</button>
        </div>
        <!-- /.col -->
        
          
       
        <!-- /.col -->
      </div>
    </form>
    <a href="#" class="text-right clr_change">Forgot Password?</a><br>
   <!--  <a href="register.html" class="text-center">Register</a> -->
