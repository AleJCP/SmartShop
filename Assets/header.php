<!-- HEADER -->
<!DOCTYPE html>
<html lang="ES">
<head>
  <meta charset="UTF-8">  
    <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="">

<!-- Dependencias Locales -->
 <!--SCRIPS JS -->
  <!-- jQuery 3 -->
  <script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
 <!-- <script src="<?php // echo ASSETS."Dependencias/bower_components/jquery/dist/jquery.min.js" ?>"></script> -->
 
 <!-- Bootstrap 3.3.7 -->
 <script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- <script src="<?php // echo ASSETS."Dependencias/bower_components/bootstrap/dist/js/bootstrap.min.js" ?>"></script> -->
 
 <!-- AdminLTE App -->
 <script src="https://adminlte.io/themes/AdminLTE/dist/js/adminlte.min.js"></script>
 <!-- <script src="<?php// echo ASSETS."Dependencias/dist/js/adminlte.min.js" ?>"></script> -->
 

  <!--DEPENDENCIAS CSS -->
  <!-- DATE  RANGE -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- <link rel="stylesheet" href="<?php // echo ASSETS."Dependencias/bower_components/bootstrap-daterangepicker/daterangepicker.css" ?>"> -->
  <!-- DATE  PICKER -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- <link rel="stylesheet" href="<?php // echo ASSETS."Dependencias/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" ?>"> -->
  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="<?php // echo ASSETS."Dependencias/bower_components/bootstrap/dist/css/bootstrap.min.css" ?>"> -->
  <!-- SELECT2 -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/select2/dist/css/select2.min.css">
  <!-- <link rel="stylesheet" href="<?php // echo ASSETS."Dependencias/bower_components/select2/dist/css/select2.min.css" ?>"> -->
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css"> -->
 <link rel="stylesheet" href="<?php  echo ASSETS."Dependencias/bower_components/font-awesome/css/font-awesome.min.css" ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- <link rel="stylesheet" href="<?php // echo ASSETS."Dependencias/dist/css/AdminLTE.min.css" ?>"> -->
  
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?php echo ASSETS."Dependencias/dist/css/skins/skin-green.min.css" ?>">    
  <title>SmartShop</title>
  <link rel="stylesheet" href="">  
</head>
 <body class="hold-transition skin-green sidebar-mini sidebar-collapse">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/SmartShop" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Smart</b>Shop</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-dollar"></i>
              <!-- <span class="label label-warning">10</span> -->
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tasa del Dolar - BsS</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a>
                      <i class="fa fa-calendar text-aqua"></i>Marcaje: 
                      <div class="dolar_API" id="marcaje_DB"></div>                      


                    </a>

                  </li>
                  <!-- end notification -->                      
                  <!-- end notification -->
                  <li><!-- start notification -->
                    <a>
                      <div class="input-group">
                        <span class="input-group-addon">                          
                          <i class="fa fa-dollar text-aqua"></i>
                        </span>                                                                   
                            <input id="dolar_DB" type="text" class="form-control">
                      </div>
                      
                      <!-- <div class="dolar_API" id="paralelo"></div> -->
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><button class="btn btn-default center-block" type="button" onclick="get_DolarfromDB()"><i class="fa fa-refresh"></i>Actualizar</button></li>
            </ul>
          </li>
          <!-- Tasks Menu -->
         
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo UPLOADS . "SSlogo.png" ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php  echo $_SESSION['nombre']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo UPLOADS . "SSlogo.png" ?>" class="img-circle" alt="User Image">

                <p>
                  <?php  echo $_SESSION['nombre']; ?>
                  <small><?php echo $_SESSION['user_group']['nombre']; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div> -->
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">                
                <div class="pull-right">
                  <button onclick="javascript:window.location = '/SmartShop/Usuarios/LogOut';" class="btn btn-default btn-flat">Cerrar Sesión</button>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->        
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo UPLOADS . "SSlogo.png" ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php  echo $_SESSION['nombre']; ?></p>                  
        </div>        
      </div>
        
      <!-- search form (Optional) -->              
      
        
      
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->

        <!-- PERMISOS -->
      
        <li id="Inicio" class=""><a href="/SmartShop/home"><i class="fa fa-home"></i> <span>Inicio</span></a></li>                      
      <?php if($_SESSION['user_group']['permisos']['agregar']['compras'] == 'true' || $_SESSION['user_group']['permisos']['visualizar']['compras'] == 'true'): ?>
		    <li id="Compras" class="treeview">
          <a href="#"><i class="fa fa-truck"></i> <span>Compras</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <?php if($_SESSION['user_group']['permisos']['agregar']['compras'] == 'true'): ?>
              <li><a href="/SmartShop/Compras/NuevaCompra"><i class="fa fa-shopping-cart"></i>Nueva Compra</a></li>
            <?php endif; ?>             
            <?php if($_SESSION['user_group']['permisos']['visualizar']['compras'] == 'true'): ?>
              <li><a href="/SmartShop/Compras"><i class="fa fa-list"></i>Administrar Compras</a></li>
            <?php endif; ?>             
          </ul>
        </li>
      <?php endif; ?>             

      

      
      <?php if($_SESSION['user_group']['permisos']['visualizar']['productos'] == 'true' || $_SESSION['user_group']['permisos']['agregar']['productos'] == 'true' || $_SESSION['user_group']['permisos']['visualizar']['categorias'] == 'true'): ?>
        <li id="Productos" class="treeview">
          <a href="#"><i class="fa fa-dropbox"></i> <span>Inventario</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
          <?php if($_SESSION['user_group']['permisos']['visualizar']['productos'] == 'true'): ?>
            <li><a href="/SmartShop/Productos/AdministrarProductos"><i class="fa fa-barcode"></i>Administrar Productos</a></li>
          <?php endif; ?>
          <?php if($_SESSION['user_group']['permisos']['agregar']['productos'] == 'true'): ?>
            <li><a href="/SmartShop/Productos/NuevoProducto"><i class="fa fa-plus"></i>Nuevo Producto</a></li>
          <?php endif; ?>
          <?php if($_SESSION['user_group']['permisos']['visualizar']['categorias'] == 'true'): ?>
            <li><a href="/SmartShop/Productos/Categorias"><i class="fa fa-tag"></i>Categorías</a></li>
          <?php endif; ?>          
          </ul>          
        </li>
      <?php endif; ?>

      

      
      <?php if($_SESSION['user_group']['permisos']['agregar']['facturacion'] == 'true' || $_SESSION['user_group']['permisos']['visualizar']['facturacion'] == 'true'): ?>
        <li id="Ventas" class="treeview">
          <a href="#"><i class="fa  fa-dollar"></i> <span>Facturación</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <?php if($_SESSION['user_group']['permisos']['agregar']['facturacion'] == 'true'): ?>
              <li><a href="/SmartShop/Ventas/NuevaVenta"><i class="fa fa-shopping-cart"></i>Nueva Venta</a></li>
            <?php endif; ?>
            <?php if($_SESSION['user_group']['permisos']['visualizar']['facturacion'] == 'true'): ?>
              <li><a href="/SmartShop/Ventas"><i class="fa fa-list"></i>Administrar Ventas</a></li>
            <?php endif; ?>
          </ul>
        </li>
      <?php endif; ?>

      

      
      <?php if($_SESSION['user_group']['permisos']['visualizar']['clientes'] == 'true' || $_SESSION['user_group']['permisos']['visualizar']['proveedores'] == 'true'): ?>
        <li id="Contactos" class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Contactos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <?php if($_SESSION['user_group']['permisos']['visualizar']['clientes'] == 'true'): ?>
              <li><a href="/SmartShop/Clientes"><i class="fa fa-user"></i>Clientes</a></li>
            <?php endif; ?>
            <?php if($_SESSION['user_group']['permisos']['visualizar']['proveedores'] == 'true'): ?>
              <li><a href="/SmartShop/Proveedores"><i class="fa fa-briefcase"></i>Proveedores</a></li>
            <?php endif; ?>
          </ul>          
        </li>    
      <?php endif; ?>

      <?php if($_SESSION['user_group']['permisos']['visualizar']['reportes'] == 'true'): ?>
  
        <li id="Reportes" class="treeview">
          <a href="#"><i class="fa fa-line-chart"></i> <span>Reportes</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">            
              <li><a href="/SmartShop/Ventas/Reportes"><i class="fa fa fa-line-chart"></i>Reporte de Ventas</a></li>                      
              <li><a href="/SmartShop/Compras/Reportes"><i class="fa fa fa-line-chart"></i>Reporte de Compras</a></li>
              <li><a href="/SmartShop/Productos/Reportes"><i class="fa fa fa-line-chart"></i>Reporte de Inventario</a></li>
            
          </ul>          
        </li>    

      <?php endif; ?>

      <?php if($_SESSION['user_group']['permisos']['visualizar']['configuracion'] == 'true'): ?>

        <li id="Configuracion" class="treeview">
          <a href="#"><i class="fa fa-gears"></i> <span>Configuración</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/SmartShop/Settings/AjustesGenerales"><i class="fa fa-gear"></i>Ajustes Generales</a></li>
            <li><a href="/SmartShop/Settings/PerfilEmpresa"><i class="fa fa-briefcase"></i>Perfil de la Empresa</a></li>            
          </ul>          
        </li>    

      <?php endif; ?>

      <?php if($_SESSION['user_group']['permisos']['visualizar']['control_usuarios'] == 'true'): ?>

        <li id="Accesos" class="treeview">
          <a href="#"><i class="fa fa-lock"></i> <span>Control de usuarios</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">            
            <li><a href="/SmartShop/Usuarios/AdministrarUsuarios"><i class="fa fa-users"></i>Administrar usuarios</a></li>
            <li><a href="/SmartShop/Usuarios/GruposUsuarios"><i class="fa fa-briefcase"></i>Grupos de usuarios</a></li>
          </ul>          
        </li>    

      <?php endif; ?>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
   

  

  