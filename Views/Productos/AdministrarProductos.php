<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-edit"></i> Administrar Productos        
      </h1>
      <ol class="breadcrumb">
        <li><a href="/SmartShop/Productos"><i class="fa fa-dashboard"></i> Productos</a></li>
        <li class="active">Ver Productos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

     <div class="row">                      
       <div class="col-xs-12">         
        <div id="box-loader" class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Productos</h3>                            
              <div class="box-tools">               
                  <div class="col-md-4 col-xs-12">
                    <a href="/SmartShop/Productos/NuevoProducto" class="btn btn-default"><i class="fa fa-plus"></i> Añadir Producto</a>                
                  </div>
                                
                  <div class="col-md-4 col-xs-12">
                     <select id="showElementsby" type="form-control" class="btn btn-default" >
                      <option value="5">Mostrar 5</option>
                      <option value="10">Mostrar 10</option>
                      <option value="50">Mostrar 50</option>
                      <option value="100">Mostrar 100</option>
                      <option value="<?php echo $data['totalProductos']; ?>">Todos</option>
                    </select>                   
                  </div>

                  <div class="col-md-4 col-xs-12">
                    <div class="input-group input-group-md" style="width: 150px;">
                  <input id="query" type="text" name="table_search" class="form-control pull-right" placeholder="Buscar">

                  <div class="input-group-btn">
                    <button onclick="load(1)" class="btn btn-default"><i class="fa fa-search"></i></button>
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
  <div class="modal fade" id="modal_dropProducto" style="display: none;">          
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-close"></i> Eliminar Producto</h4>
              </div>
              <div id="loaderForm_Delete" class="modal-body">                
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button id="Btn_DropProducto" type="submit" class="btn btn-danger"><i class="fa fa-close"></i> Eliminar Producto</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->          
      </div>

  <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });
</script>
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
      url: '/SmartShop/Productos/MostrarItemsAJAX',
      
      
      beforeSend: function(){
        $("#box-loader").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();
        $('#box-loader > .box-body').remove(); 
        $('#box-loader').append(datos);  
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });

  }


function modal_dropProducto(id){   
  //Modal    
    $("#loaderForm_Delete").html('<p class="text-center"> ¿Estás seguro de eliminar este registro? <br></p><p class="help-block">(*) Esta acción es irreversible <br> </p>');
    $('#Btn_DropProducto').show();
    $('#Btn_DropProducto').attr('onclick', 'dropProducto('+id+')');
  }

  function dropProducto(id){    
    $.ajax({
      data: {"id":id},
      type: 'POST',
      url: '/SmartShop/Productos/dropProductobyIDAJAX',
      beforeSend: function(){
        //Mostramos el loader en el modal
        $("#loaderForm_Delete").html('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        //Mostramos los datos en el Modal
        $("#loaderForm_Delete").html(datos);
        $('#Btn_DropProducto').hide();
        //Actualizamos la paginacion
        load(1);
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
    $('#Ventas').removeClass('active');
    $('#Productos').addClass('active');
    $('#Contactos').removeClass('active');
    $('#Reportes').removeClass('active');
    $('#Configuracion').removeClass('active');
    $('#Accesos').removeClass('active');
  });
</script>
<?php require_once("Assets/footer.php") ?>