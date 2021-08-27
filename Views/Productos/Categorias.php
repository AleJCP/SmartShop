<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tags"></i> Categorías        
      </h1>
      <ol class="breadcrumb">
        <li><a href="/SmartShop/Productos"><i class="fa fa-dashboard"></i> Productos</a></li>
        <li class="active">Categorías</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

     <div class="row">
       <div class="col-xs-12">
         
        <div id="box-loader" class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Categorías</h3>
              
              
              <div class="box-tools">
               

                  <div class="col-md-4 col-xs-12">                    
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-addCategoria"><i class="fa fa-plus"></i> Nueva Categoría</button>                
                  </div>                   
                                
                  <div class="col-md-4 col-xs-12">
                     <select id="showElementsby" type="form-control" class="btn btn-default" >
                      <option value="5">Mostrar 5</option>
                      <option value="10">Mostrar 10</option>
                      <option value="50">Mostrar 50</option>
                      <option value="100">Mostrar 100</option>
                      <option value="<?php echo $data['totalCategorias']; ?>">Todos</option>
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

  <div class="modal fade" id="modal-addCategoria">
  <form id="form_AddCategoria" action="" role="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-tag"></i>Añadir Categoría</h4>
              </div>
              <?php if($_SESSION['user_group']['permisos']['agregar']['categorias'] == 'true'): ?>
              <div id="loaderForm_1" class="modal-body">

                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" name="nombre" class="form-control"required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">                  
                </div>
                <div class="form-group">
                  <div class="row">
                <div class="col-xs-6">                
                  <label>IVA</label>
                  <div class="input-group">
                       <span class="input-group-addon">%</span>
                      <input type="text" name="iva" id="iva" class="form-control" pattern="[0-9]+|([0-9]+[.][0-9]+)" required oninvalid="setCustomValidity('Rellena este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">                                
                    </div>
                  
                </div>                                
                <div class="col-xs-6">                
                  <label>Estado</label>
                  <select name="estado" class="form-control">
                  <option value="1">Activo</option>                    
                  <option value="0">Desactivado</option>
                  </select>
                </div>  
                </div>
                </div>

              </div>
              <?php else: ?>                 
                <div class="box-body table-responsive">
                  <div class="callout callout-danger">
                    <h4>¡No tienes permisos para realizar esta operación!</h4>
                    <p></p>
                  </div>
                </div>
               <?php endif;?> 
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <?php if($_SESSION['user_group']['permisos']['agregar']['categorias'] == 'true'): ?>
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Añadir Categoria</button>
                <?php endif;?> 
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
  </form>
</div>

<div class="modal fade" id="modal-editCategoria">
  <form id="form_editCategoria" action="" role="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-tag"></i>Añadir Categoría</h4>
              </div>
              <div id="loaderForm_edit" class="modal-body">

               <!--  AJAX -->
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button id="Btn_EditCategoria" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Editar Categoria</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
  </form>
</div>

<div class="modal fade" id="modal-dropCategoria" style="display: none;">          
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-close"></i> Eliminar Categoría</h4>
              </div>
              <div id="loaderForm_Delete" class="modal-body">                
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button id="Btn_DropCategoria" type="submit" class="btn btn-danger"><i class="fa fa-close"></i> Eliminar Categoría</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->          
</div>

<script>  
  $(document).ready(function (){
   load(1);
  });

  //Escuchar Select para cambiar la vista de elementos en la tabla
  $('#showElementsby').change(function(){       
    var ibypage = $('#showElementsby option:selected').val();
    load(1);
  })

  function load(page,itemsbypage){    
    var query = $('#query').val(); 
    var itemsbypage = $('#showElementsby option:selected').val();
    $.ajax({

      data: {"pagina":page,"artporpagina":itemsbypage,"query":query},
      type: 'POST',      
      url: '/SmartShop/Productos/MostrarItemsCategoriaAJAX',
      
      
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

    $('#form_AddCategoria').submit(function(ev){

    ev.preventDefault();
    var formData = new FormData(document.getElementById('form_AddCategoria'));

    $.ajax({    
      data: formData,      
      type: 'POST',      
      url: '/SmartShop/productos/addCategoriasAJAX',
      contentType: false,
      processData: false,
            
      beforeSend: function(){
        $("#loaderForm_1").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();               
        $('#loaderForm_1').append(datos);  
        load();
        document.getElementById('form_AddCategoria').reset();
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });  
  });

    $('#form_editCategoria').submit(function(ev){

    ev.preventDefault();
    var formData = new FormData(document.getElementById('form_editCategoria'));

    $.ajax({    
      data: formData,      
      type: 'POST',      
      url: '/SmartShop/productos/editCategoriasAJAX',
      contentType: false,
      processData: false,
            
      beforeSend: function(){
        $("#loaderForm_edit").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();               
        $('#loaderForm_edit').append(datos);  
        load();                
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });  
  });

    function editCategoria(id){      
      $.ajax({
        data: {"id":id},
        type: 'POST',
        url: '/SmartShop/productos/getFormEdit_CategoriabyID',        
        beforeSend: function(){
          $('#loaderForm_edit').append('<div id="loader1" class="overlay><i class="fa fa-refresh fa spin"></i></div>');
        },
        success: function(datos){
          $('#loader1').remove();
          $('#loaderForm_edit').html(datos);          
        },
        error: function(xhr, textStatus, error){
          $('#loader1').remove();
          alert('Ha fallado la consulta por :' + textStatus);
        }
      });
    }

    function modal_DropCategoria(id){   
  //Modal    
    $("#loaderForm_Delete").html('<p class="text-center"> ¿Estás seguro de eliminar este registro? <br></p><p class="help-block">(*) Esta acción es irreversible <br> </p>');
    $('#Btn_DropCategoria').show();
    $('#Btn_DropCategoria').attr('onclick', 'dropCategoria('+id+')');
  }

  function dropCategoria(id){    
    $.ajax({
      data: {"id":id},
      type: 'POST',
      url: '/SmartShop/Productos/dropCategoriabyIDAJAX',
      beforeSend: function(){
        //Mostramos el loader en el modal
        $("#loaderForm_Delete").html('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        //Mostramos los datos en el Modal
        $("#loaderForm_Delete").html(datos);
        $('#Btn_DropCategoria').hide();
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