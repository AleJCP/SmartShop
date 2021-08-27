<?php  ?>

<html>
<head>
  <meta charset="UTF-8">  
  <link rel="stylesheet" href="">

 <!--SCRIPS JS -->
  <!-- jQuery 3 -->
 <script src="<?php echo ASSETS."Dependencias/bower_components/jquery/dist/jquery.min.js" ?>"></script>
 <!-- Bootstrap 3.3.7 -->
 <script src="<?php echo ASSETS."Dependencias/bower_components/bootstrap/dist/js/bootstrap.min.js" ?>"></script>
 <!-- AdminLTE App -->
 <script src="<?php echo ASSETS."Dependencias/dist/js/adminlte.min.js" ?>"></script>

 <!--/SCRIPS JS -->

  <!-- Dependencias ADMINLTE -->
  	<!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="<?php echo ASSETS."Dependencias/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" ?>">

  <link rel="stylesheet" href="<?php echo ASSETS."Dependencias/bower_components/bootstrap/dist/css/bootstrap.min.css" ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo ASSETS."Dependencias/bower_components/font-awesome/css/font-awesome.min.css" ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo ASSETS."Dependencias/bower_components/Ionicons/css/ionicons.min.css" ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo ASSETS."Dependencias/dist/css/AdminLTE.min.css" ?>">
  
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?php echo ASSETS."Dependencias/dist/css/skins/skin-green.min.css" ?>">
  <!-- ADMIN LTE Tables -->
  <!-- <link rel="stylesheet" href="/SmartShop/Assets/Dependencias/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css"> -->
 <!-- SELECT2 -->
  <link rel="stylesheet" href="<?php echo ASSETS."Dependencias/bower_components/select2/dist/css/select2.min.css" ?>">

  <title>SmartShop</title>
  <link rel="stylesheet" href="">  
</head>
<body class="hold-transition login-page">  
<div class="login-box">
  <div class="login-logo">
    <a href="/SmartShop/"><b>Smart</b>Shop</a>
  </div>
  <!-- /.login-logo -->

  <?php if(isset($data['errores']) && $data['errores'] != ''): ?>

    <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error</h4>
                 <ul>
                   <?php echo $data['errores']; ?>
                 </ul>
    </div>

  <?php endif; ?>

 
  <div class="login-box-body">
    <p class="login-box-msg">Inicia sesión para entrar al sistema</p>

    <form id="formulario-login" action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row ">
        
        <!-- /.col -->
        <div class="col-xs-12 ">
          <button id="btn-ingresar" type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  <!--   <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->  
    <p class="help-block">(*)Para Registrar un Usuario debe hacerlo un administrador desde el Sistema</p>
    <p>SmartShop Todos los derechos reservados - by ALEJCP</p>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- <script type="text/javascript">

  $('#btn-ingresar').click(function(e){
    
    var url = "/SmartShop/Usuarios/login"

    e.preventDefault();

    $.ajax({
      type: "POST",     
      url: url,
      data: $("#formulario-login").serialize(),
      success: function(data)
      {
        console.log(data);
      }
    });

  });


  
</script> -->

</body></html>