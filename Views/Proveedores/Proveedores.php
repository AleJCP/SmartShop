<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-edit"></i> Administrar Proveedores
      </h1>
      <ol class="breadcrumb">
        <li><a href="/SmartShop/Proveedores"><i class="fa fa-dashboard"></i> Proveedores</a></li>
        <li class="active">Ver Proveedores</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

     <div class="row">                      
       <div class="col-xs-12">         
        <div id="box-loader" class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Proveedores</h3>                            
              <div class="box-tools">               
                  <div class="col-md-4 col-xs-12">
                    
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-addProveedor"><i class="fa fa-plus"></i> Nuevo Proveedor</button>               
                  
                  </div>
                                
                  <div class="col-md-4 col-xs-12">
                     <select id="showElementsby" type="form-control" class="btn btn-default" >
                      <option value="5">Mostrar 5</option>
                      <option value="10">Mostrar 10</option>
                      <option value="50">Mostrar 50</option>
                      <option value="100">Mostrar 100</option>
                      <option value="<?php echo $data['totalProveedores']; ?>">Todos</option>
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


      <div class="modal fade" id="modal-addProveedor" style="display: none;">
          <form id="form_AddProveedores" class="form-horizontal" action="" role="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-briefcase"></i> Añadir Proveedor</h4>
              </div>
              <?php if($_SESSION['user_group']['permisos']['agregar']['proveedores'] == 'true'): ?>
              <div id="loaderForm_1" class="modal-body">

                <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Empresa</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Contacto</a></li>
              <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Dirección</a></li>
            </ul>            
            <div  class="tab-content">            
              <div class="tab-pane active" id="tab_1">
                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Nombre de la empresa</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" name="nombre_empresa" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">CI/RIF</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" id="InputRif" name="rif" type="text" pattern="[V|J|P|E][-][0-9]{8,9}" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Sitio WEB</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" name="sitio_web" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                
                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Nombres</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" name="nombre" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Apellidos</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" name="apellido" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                   
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Teléfono</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" id="InputTelefono" name="telefono" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">                  
                  </div>
                </div>

                  <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Email</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" name="email" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                
                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Local Nro</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" name="local_nro" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Calle</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" name="calle" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Sector/Urb</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" name="sector" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Ciudad</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" name="ciudad" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Estado</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" name="estado" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Cod - Postal</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" name="cod_postal" type="text" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">País</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" name="pais" type="text" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

              </div>
              <!-- /.tab-pane -->
            </div>            
            <!-- /.tab-content -->
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
                <?php if($_SESSION['user_group']['permisos']['agregar']['proveedores'] == 'true'): ?>
                <button type="submit" class="btn btn-primary"><i class="fa fa-user"></i> Añadir Proveedor</button>
              <?php endif; ?>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
          </form> 
      </div>

      <div class="modal fade" id="modal-editProveedor" style="display: none;">
          <form id="form_editProveedor" class="form-horizontal" action="" role="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-briefcase"></i> Editar Proveedor</h4>
              </div>
              <div id="loaderForm_Edit" class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-user"></i> Editar Proveedor</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
          </form> 
      </div>

      <div class="modal fade" id="modal-dropProveedor" style="display: none;">          
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-close"></i> Eliminar Proveedor</h4>
              </div>
              <div id="loaderForm_Delete" class="modal-body">                
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button id="Btn_DropClient" type="submit" class="btn btn-danger"><i class="fa fa-close"></i> Eliminar Proveedor</button>
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


   //InputMask's
   $(document).ready(function(){
      $("#InputRif").inputmask({mask: "A-99999999[9]", greedy: false});      
      $("#InputTelefono").inputmask({mask: "(999)-9999999"});

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
      url: '/SmartShop/Proveedores/MostrarItemsAJAX',
      
      
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

  $('#form_AddProveedores').submit(function(ev){

    ev.preventDefault();
    var formData = new FormData(document.getElementById('form_AddProveedores'));

    $.ajax({    
      data: formData,      
      type: 'POST',      
      url: '/SmartShop/proveedores/addProveedoresAJAX',
      contentType: false,
      processData: false,
            
      beforeSend: function(){
        $("#loaderForm_1").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();       
        load(); 
        $('#loaderForm_1').append(datos);  
        document.getElementById('form_AddProveedores').reset();
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });  
  });

  $('#form_editProveedor').submit(function(ev){
    ev.preventDefault();    
    var formData = new FormData(document.getElementById('form_editProveedor'));
    $.ajax({    
      data: formData,      
      type: 'POST',      
      url: '/SmartShop/Proveedores/editProveedoresAJAX',
      contentType: false,
      processData: false,            
      beforeSend: function(){
        $("#loaderForm_Edit").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();       
        load(); 
        $('#loaderForm_Edit').append(datos);  
        // document.getElementById('form_editProveedor').reset();
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
  });

  function editarProveedor(id){
    $.ajax({
      data: {"id":id},
      type: 'POST',
      url: '/SmartShop/proveedores/getDATAProveedorbyIDAJAX',       
      beforeSend: function(){
        //Abrimos el modal y Mostramos el loader
        $("#loaderForm_Edit").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();
        //Mostramos los datos
        $('#loaderForm_Edit').html(datos);              
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
  }



  function modal_dropProveedor(id){   
  //Modal    
    $("#loaderForm_Delete").html('<p class="text-center"> ¿Estás seguro de eliminar este registro? <br></p><p class="help-block">(*) Todos los datos relacionados a este registro se eliminaran, compras, ventas.<br>(*) Esta acción es irreversible <br> </p>');
    $('#Btn_DropClient').show();
    $('#Btn_DropClient').attr('onclick', 'dropProveedor('+id+')');
  }

  function dropProveedor(id){    
    $.ajax({
      data: {"id":id},
      type: 'POST',
      url: '/SmartShop/proveedores/dropProveedorbyIDAJAX',
      beforeSend: function(){
        //Mostramos el loader en el modal
        $("#loaderForm_Delete").html('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        //Mostramos los datos en el Modal
        $("#loaderForm_Delete").html(datos);
        $('#Btn_DropClient').hide();
        //Actualizamos la paginacion
        load(1);
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
  }

  $(document).ready(function(){
    $('#Inicio').removeClass('active');
    $('#Compras').removeClass('active');
    $('#Ventas').removeClass('active');
    $('#Productos').removeClass('active');
    $('#Contactos').addClass('active');
    $('#Reportes').removeClass('active');
    $('#Configuracion').removeClass('active');
    $('#Accesos').removeClass('active');
  });
</script>
<?php require_once("Assets/footer.php") ?>