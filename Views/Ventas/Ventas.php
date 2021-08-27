<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-edit"></i> Administrar Ventas
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/SmartShop/Ventas"><i class="fa fa-dashboard"></i> Ventas</a></li>
        <li class="active">Administrar Ventas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

     <div class="row">
       <div class="col-xs-12">
         
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Ventas</h3>
              
              
              <div class="box-tools">
               

                  <div class="col-xs-4">
                    <a href="/SmartShop/Compras/NuevaCompra" class="btn btn-default"><i class="fa fa-plus"></i> Nueva Ventas</a>                
                  </div>
                                
                  <div class="col-xs-4">
                    <div class="btn btn-default"><i class="fa fa-arrow-down"></i> Mostrar por</div>                
                  </div>

                  <div class="col-xs-4">
                    <div class="btn btn-default"><i class="fa fa-search"></i> Buscar por</div>                
                  </div>
                              
                

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive no-padding"> 
              <table class="table table-hover table-striped">
                <tbody><tr>
                  <th>Venta Nro</th>
                  <th>Cliente</th>
                  <th>Fecha</th>
                  <th>Usuario</th>
                  <th>SubTotal</th>
                  <th>IVA</th>
                  <th>Total $</th>
                  <th>Total BsS</th>
                  <th>Acciones</th>
                </tr>
                <tr>
                  <td>18113</td>
                  <td>Pedro Perez</td>
                  <td>03/03/2021</td>
                  <td>Admin 2</td>                  
                  <td>10,00 $</td>
                  <td>10 %</td>
                  <td>11,00 $</td>
                  <td>19.000.000,00 BsS</td>
                  <td>
                     <div class="btn-group">
                        <div type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">                        
                          Acciones  <span class="caret"> </span>
                        </div>
                        <ul class="dropdown-menu">
                          <li><a href="#"><i class="fa fa-edit"></i>Editar Compra</a></li>
                          <li><a href="#"><i class="fa fa-close"></i>Eliminar Compra</a></li>
                          <li><a href="#"><i class="fa fa-print"></i>Imprimir Reporte</a></li>
                        </ul>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td>18113</td>
                  <td>La Fundadora</td>
                  <td>03/03/2021</td>
                  <td>Admin 2</td>                  
                  <td>10,00 $</td>
                  <td>10 %</td>
                  <td>11,00 $</td>
                  <td>19.000.000,00 BsS</td>
                  <td>
                     <div class="btn-group">
                        <div type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">                        
                          Acciones  <span class="caret"> </span>
                        </div>
                        <ul class="dropdown-menu">
                          <li><a href="#"><i class="fa fa-edit"></i>Editar Compra</a></li>
                          <li><a href="#"><i class="fa fa-close"></i>Eliminar Compra</a></li>
                          <li><a href="#"><i class="fa fa-print"></i>Imprimir Reporte</a></li>
                        </ul>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td>18113</td>
                  <td>La Fundadora</td>
                  <td>03/03/2021</td>
                  <td>Admin 2</td>                  
                  <td>10,00 $</td>
                  <td>10 %</td>
                  <td>11,00 $</td>
                  <td>19.000.000,00 BsS</td>
                  <td>
                     <div class="btn-group">
                        <div type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">                        
                          Acciones  <span class="caret"> </span>
                        </div>
                        <ul class="dropdown-menu">
                          <li><a href="#"><i class="fa fa-edit"></i>Editar Compra</a></li>
                          <li><a href="#"><i class="fa fa-close"></i>Eliminar Compra</a></li>
                          <li><a href="#"><i class="fa fa-print"></i>Imprimir Reporte</a></li>
                        </ul>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td>18113</td>
                  <td>La Fundadora</td>
                  <td>03/03/2021</td>
                  <td>Admin 2</td>                  
                  <td>10,00 $</td>
                  <td>10 %</td>
                  <td>11,00 $</td>
                  <td>19.000.000,00 BsS</td>
                  <td>
                     <div class="btn-group">
                        <div type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">                        
                          Acciones  <span class="caret"> </span>
                        </div>
                        <ul class="dropdown-menu">
                          <li><a href="#"><i class="fa fa-edit"></i>Editar Compra</a></li>
                          <li><a href="#"><i class="fa fa-close"></i>Eliminar Compra</a></li>
                          <li><a href="#"><i class="fa fa-print"></i>Imprimir Reporte</a></li>
                        </ul>
                    </div>
                  </td>
                </tr>


                
                
              </tbody>
              </table>
              </div>
              <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
              </div>
            </div>
            <!-- /.box-body -->
          </div>      

       </div>
     </div>     
    </section>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once("Assets/footer.php") ?>