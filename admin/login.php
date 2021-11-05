<?php
  session_start();
  $cerrar_sesion=isset($_SESSION['cerrar_sesion'])? $_SESSION['cerrar_sesion'] : '' ;
  if ($cerrar_sesion) {
    session_destroy();
  }
  include_once 'templates/header.php'; 
  include_once 'funciones/funciones.php';
?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>GDL</b>WebCamp</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Iniciar Sesión</p>

    <form name="login-admin" id="login-admin" action="login-admin.php" method="post">


      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

      </div>


      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">

        <div class="col-xs-12">

          <input type="hidden" value="1" name="login-admin">
          <button name="login-admin" type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>

        </div>
        <!-- /.col -->
      </div>


    </form>

  </div>
  <!-- /.login-box-body -->
</div>

<?php 
  include 'templates/footer.php';
?>


