<?php require_once("Assets/header.php") ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-edit"></i> Administrar Ventas        
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
        <div id="box-loader" class="box">
          <div class="box-header">
              <h3 class="box-title">Listado de Ventas</h3>                                       
              <div class="box-tools"> 

                 <div class="col-md-4">
                    <a href="/SmartShop/Ventas/NuevaVenta" class="btn btn-default"><i class="fa fa-plus"></i> Añadir Venta</a>                
                  </div>
                                
                  <div class="col-md-4">
                     <select id="showElementsby" type="form-control" class="btn btn-default" >
                      <option value="5">Mostrar 5</option>
                      <option value="10">Mostrar 10</option>
                      <option value="50">Mostrar 50</option>
                      <option value="100">Mostrar 100</option>
                      <option value="<?php echo $data['totalVentas']; ?>">Todos</option>
                    </select>                   
                  </div>

                  <div class="col-md-4">
                    <div class="input-group input-group-md" style="width: 150px;">
                      <input id="query" type="text" name="table_search" class="form-control pull-right" placeholder="Buscar">

                      <div class="input-group-btn">
                        <button onclick="load(1)" class="btn btn-default"><i class="fa fa-search"></i></button  >
                      </div>
                    </div>                   
                  </div> 
                                                            
              </div>              
          </div>
          <!-- /.box-header -->

        </div>
      </div> 
    </div>    
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script type="text/javascript">


  $(document).ready(function (){
   load(1);
  });

  //Escuchar Select para cambiar la vista de elementos en la tabla
  $('#showElementsby').change(function(){       
    
    load(1);
  })

  function load(page,itemsbypage){    
    var query = $('#query').val(); 
    var itemsbypage = $('#showElementsby option:selected').val();
    $.ajax({

      data: {"pagina":page,"artporpagina":itemsbypage,"query":query},
      type: 'POST',      
      url: '/SmartShop/ventas/MostrarItemsAJAX',
      
      
      beforeSend: function(){
        $("#box-loader").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();
        $('#box-loader > .box-body').remove(); 
        $('#box-loader').append(datos);  
        
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
  }
//Menu Context
  $(document).ready(function(){
    $('#Inicio').removeClass('active');
    $('#Compras').removeClass('active');
    $('#Ventas').addClass('active');
    $('#Productos').removeClass('active');
    $('#Contactos').removeClass('active');
    $('#Reportes').removeClass('active');
    $('#Configuracion').removeClass('active');
    $('#Accesos').removeClass('active');
  });
</script>

<?php require_once("Assets/footer.php") ?>
