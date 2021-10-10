<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo(base_url().'/AdminLTE-3.1.0-rc/pages/examples/../../plugins/fontawesome-free/css/all.min.css')?>"> 
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo(base_url().'/AdminLTE-3.1.0-rc/pages/examples/../../plugins/icheck-bootstrap/icheck-bootstrap.min.css')?>"> 
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo(base_url().'/AdminLTE-3.1.0-rc/pages/examples/../../dist/css/adminlte.min.css')?>"> 

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="AdminLTE-3.1.0-rc/pages/examples/../../index2.html"><b>Demo Puertas Azules</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Logueate para iniciar sesión</p>

      <form method='POST' action='<?php echo(base_url().'/Login/validatelogin')?>'>

          <?php foreach($data['errors'] as $error) { ?>
            <div class="errors_validation">   
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" value="admin" placeholder="user">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" value="admin" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Acceder</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <!-- <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div> -->
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo(base_url().'/AdminLTE-3.1.0-rc/pages/examples/../../plugins/jquery/jquery.min.js')?>"></script>

<!-- Bootstrap 4 -->
<script src="<?php echo(base_url().'/AdminLTE-3.1.0-rc/pages/examples/../../plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo(base_url().'/AdminLTE-3.1.0-rc/pages/examples/../../dist/js/adminlte.min.js')?>"></script>
</body>
</html>
<style>
.card{
  box-shadow: 0 0 10px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%) !important;
}
</style>
