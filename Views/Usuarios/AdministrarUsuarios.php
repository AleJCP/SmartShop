<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> Administrar Usuarios
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="/SmartShop/Clientes"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
<div class="row">                      
       <div class="col-xs-12">         
        <div id="box-loader" class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Clientes</h3>                            
              <div class="box-tools">               
                  <div class="col-md-4 col-xs-12">
                    
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-addUsuario"><i class="fa fa-plus"></i> Nuevo Usuario</button>                                 
                  </div>
                                
                  <div class="col-md-4 col-xs-12">
                     <select id="showElementsby" type="form-control" class="btn btn-default" >
                      <option value="5">Mostrar 5</option>
                      <option value="10">Mostrar 10</option>
                      <option value="50">Mostrar 50</option>
                      <option value="100">Mostrar 100</option>
                      <option value="<?php echo $data['totalUsuarios']; ?>">Todos</option>
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

  <div class="modal fade" id="modal-addUsuario" style="display: none;">
    
          <form id="form_addUsuarios" class="form-horizontal" action="" role="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-user"></i> Añadir Usuario</h4>
              </div>              
              <?php if($_SESSION['user_group']['permisos']['agregar']['control_usuarios'] == 'true'): ?>
            <div id="loader_Form_Add" class="modal-body">                      
                <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Datos Personales</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Datos de Usuario</a></li>
            </ul>            
            <div  class="tab-content">            
              <div class="tab-pane active" id="tab_1">
                
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Nombre</label>
                  <div class="col-sm-10">
                    <input name="nombre" type="text"  class="form-control" placeholder="Ingresa el Nombre"  required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>  
                </div>
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Apellido</label>
                  <div class="col-sm-10">
                    <input name="apellido" type="text"  class="form-control" placeholder="Ingresa el Apellido" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>  
                </div>
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Email</label>
                  <div class="col-sm-10">
                    <input name="email" type="email"  class="form-control" placeholder="Ingresa el Email"  onkeyup="this.value = this.value.toUpperCase();">
                  </div>  
                </div>
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">CI</label>
                  <div class="col-sm-10">
                    <input name="cedula" type="text" id="InputRif" class="form-control" pattern="[V|J|P|E][-][0-9]{8,9}" placeholder="Ingresa la Cédula" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                  </div>  
                </div>
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Teléfono</label>
                  <div class="col-sm-10">
                    <input name="telefono" type="text" id="InputTelefono" class="form-control" placeholder="Ingresa el Teléfono" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                  </div>  
                </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                                
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Usuario</label>
                  <div class="col-sm-10">
                    <input name="usuario" type="text"  class="form-control" placeholder="Ingresa el Usuario" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>  
                </div>

                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Contraseña</label>
                  <div class="col-sm-10">
                    <input name="contraseña" type="password"  class="form-control" placeholder="******" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">                  
                  </div>  
                </div>
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Repite Contraseña</label>
                  <div class="col-sm-10">
                    <input name="contraseña2" type="password"  class="form-control" placeholder="******" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">                  
                  </div>  
                </div>
                
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Estado</label>
                  <div class="col-sm-10">
                    <select name="estado" id="" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                      <option value="1">Activo</option>
                      <option value="0">Suspendido</option>                                            
                    </select>               
                  </div>  
                </div>
                 <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Grupo Usuario</label>
                  <div class="col-sm-10">
                    <select name="gusuario" id="Select_GUsuario" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                                           
                    </select>               
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
                <?php if($_SESSION['user_group']['permisos']['agregar']['control_usuarios'] == 'true'): ?>
                <button type="submit" class="btn btn-primary"><i class="fa fa-user"></i> Añadir Usuario</button>
                <?php endif;?>    
              </div>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
          </form>            
      </div>

    <div class="modal fade" id="modal-editUsuario" style="display: none;">
          <form id="form_editUsuarios" class="form-horizontal" action="" role="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-user"></i> Editar Usuario</h4>
              </div>
              <div id="loader_Form_edit" class="modal-body">
                <div id="AJAX_Response">
                  
                </div> 
              
                  
              </div>                                             
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar Cambios</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
          </form> 
      </div>

    <div class="modal fade" id="modal-dropUsuario" style="display: none;">          
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-close"></i> Eliminar Usuario</h4>
              </div>
              <div id="loaderForm_Delete" class="modal-body">                
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button id="Btn_DropUsuario" type="submit" class="btn btn-danger"><i class="fa fa-close"></i> Eliminar Usuario</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->          
      </div>
<script type="text/javascript">
  $(document).ready(function (){
    load(1);
    options_GUsuarios();

     //InputMask's
      $("#InputRif").inputmask({mask: "A-99999999[9]", greedy: false});      
      $("#InputTelefono").inputmask({mask: "(999)-9999999"});  
  });

  $('#showElementsby').change(function(){       
    var ibypage = $('#showElementsby option:selected').val();
    load(1);
  });

    function options_GUsuarios(){
      $.ajax({      
      type: 'POST',      
      url: '/SmartShop/Usuarios/getGrupoUsuariosAJAX',          
      beforeSend: function(){
        
      },
      success: function(datos){                         
        $('#Select_GUsuario').html(datos);  
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Error al cargar los Niveles de Usuario por: ' + textStatus);
      }
    });  
    }

    function load(page,itemsbypage){    
    var query = $('#query').val(); 
    var itemsbypage = $('#showElementsby option:selected').val();
    $.ajax({
      data: {"pagina":page,"artporpagina":itemsbypage,"query":query},
      type: 'POST',      
      url: '/SmartShop/Usuarios/MostrarItemsAJAX',          
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

  function editUsuario(id){    
    
    $.ajax({
      data: {"id":id},
      type: 'POST',      
      url: '/SmartShop/Usuarios/getFORM_EDIT',          
      beforeSend: function(){
        $("#loader_Form_edit").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();      
        $("#tabs").remove();
        $('#loader_Form_edit').append(datos);
        $('#AJAX_Response').html('');
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
  }

function modal_dropUsuario(id){   
  //Modal    
    $("#loaderForm_Delete").html('<p class="text-center"> ¿Estás seguro de eliminar este registro? <br></p><p class="help-block">(*) Todos los datos relacionados a este registro se eliminaran, compras, ventas.<br>(*) Esta acción es irreversible <br> </p>');
    $('#Btn_DropUsuario').show();
    $('#Btn_DropUsuario').attr('onclick', 'dropUsuario('+id+')');
  }

  function dropUsuario(id){    
    $.ajax({
      data: {"id":id},
      type: 'POST',
      url: '/SmartShop/usuarios/dropUsuariobyIDAJAX',
      beforeSend: function(){
        //Mostramos el loader en el modal
        $("#loaderForm_Delete").html('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        //Mostramos los datos en el Modal
        $("#loaderForm_Delete").html(datos);
        $('#Btn_DropUsuario').hide();
        //Actualizamos la paginacion
        load(1);
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
  }


  $('#form_addUsuarios').submit(function(ev){
    ev.preventDefault();
    var formData = new FormData(document.getElementById('form_addUsuarios'));
    $.ajax({
      data: formData,
      type: 'POST',
      url: '/SmartShop/usuarios/addUsuariosAJAX',
      contentType: false,
      processData: false,

      beforeSend: function(){
        $('#loader_Form_Add').append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){
        $('#loader1').remove();        
        $('#loader_Form_Add').append(datos);
        load(1);
        document.getElementById('form_addUsuarios').reset();
      },
      error: function(){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
  });

  $('#form_editUsuarios').submit(function(ev){
    ev.preventDefault();
    var formData = new FormData(document.getElementById('form_editUsuarios'));
    $.ajax({
      data: formData,
      type: 'POST',
      url: '/SmartShop/usuarios/editUsuariosAJAX',
      contentType: false,
      processData: false,

      beforeSend: function(){
        $('#loader_Form_edit').append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){
        $('#loader1').remove();        
        $('#AJAX_Response').html(datos);
        load(1);        
      },
      error: function(){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
  });

  $(document).ready(function(){
    $('#Inicio').removeClass('active');
    $('#Compras').removeClass('active');
    $('#Ventas').removeClass('active');
    $('#Productos').removeClass('active');
    $('#Contactos').removeClass('active');
    $('#Reportes').removeClass('active');
    $('#Configuracion').removeClass('active');
    $('#Accesos').addClass('active');
  });
</script>
<?php require_once("Assets/footer.php") ?>