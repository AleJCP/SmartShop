<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> Grupos de usuarios
        
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
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-addGUsuario"><i class="fa fa-plus"></i> Nuevo Nivel de Usuario</button>               
                  </div>
                                
                  <div class="col-md-4 col-xs-12">
                     <select id="showElementsby" type="form-control" class="btn btn-default" >
                      <option value="5">Mostrar 5</option>
                      <option value="10">Mostrar 10</option>
                      <option value="50">Mostrar 50</option>
                      <option value="100">Mostrar 100</option>
                      <option value="<?php echo $data['total_GUsuarios']; ?>">Todos</option>
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

        <div class="modal fade" id="modal-addGUsuario" style="display: none;">
          <form id="formAddUserGroup" class="form-horizontal" role="form" method="post">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-user"></i> Añadir Grupo de usuario</h4>
              </div>
              <?php if($_SESSION['user_group']['permisos']['agregar']['control_usuarios'] == 'true'): ?>
              <div id="loaderForm_add" class="modal-body">                
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Nombre</label>
                  <div class="col-sm-10">
                    <input id="nombre_gu" type="text" name="nombre_gu" class="form-control" placeholder="Ingresa el Nombre" maxlength="20" required>
                  </div>  
                </div>

                <div class="table-responsive no-padding">
                <table class="table table-hover table-striped">
                  <tbody>
                  <tr>
                    <th>
                      Modulo
                    </th>
                    <th>
                      <div class="form-check form-check-inline">
                        <input id="checkAllVisualizar" name="checkAllVisualizar" class="form-check-input" type="checkbox"> 
                        <label for="checkAllVisualizar" class="form-check-label">Visualizar</label>
                      </div>
                    </th>
                    <th>
                      <div class="form-check form-check-inline">
                        <input id="checkAllAgregar" name="checkAllAgregar" class="form-check-input" type="checkbox"> 
                        <label for="checkAllAgregar" class="form-check-label">Agregar</label>
                      </div>
                    </th>
                    <th>
                      <div class="form-check form-check-inline">
                        <input id="checkAllEditar" name="checkAllEditar" class="form-check-input" type="checkbox"> 
                        <label for="checkAllEditar" class="form-check-label">Editar</label>
                      </div>
                    </th>
                    <th>
                      <div class="form-check form-check-inline">
                        <input id="checkAllEliminar" name="checkAllEliminar" class="form-check-input" type="checkbox"> 
                        <label for="checkAllEliminar" class="form-check-label">Eliminar</label>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <td>
                      Inicio
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkInicioVisualizar" name="checkInicioVisualizar" type="checkbox"> Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkInicioAgregar" name="checkInicioAgregar" type="checkbox"> Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkInicioEditar" name="checkInicioEditar" type="checkbox"> Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkInicioEliminar" name="checkInicioEliminar" type="checkbox"> Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Compras
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkComprasVisualizar" name="checkComprasVisualizar" type="checkbox"> Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkComprasAgregar" name="checkComprasAgregar" type="checkbox"> Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkComprasEditar" name="checkComprasEditar" type="checkbox"> Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkComprasEliminar" name="checkComprasEliminar" type="checkbox"> Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      Productos
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkProductosVisualizar" name="checkProductosVisualizar" type="checkbox"> Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkProductosAgregar" name="checkProductosAgregar" type="checkbox"> Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkProductosEditar" name="checkProductosEditar" type="checkbox"> Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkProductosEliminar" name="checkProductosEliminar" type="checkbox"> Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Categorías
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkCategoriasVisualizar" name="checkCategoriasVisualizar" type="checkbox"> Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkCategoriasAgregar" name="checkCategoriasAgregar" type="checkbox"> Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkCategoriasEditar" name="checkCategoriasEditar" type="checkbox"> Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkCategoriasEliminar" name="checkCategoriasEliminar" type="checkbox"> Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Facturación
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkFacturacionVisualizar" name="checkFacturacionVisualizar" type="checkbox"> Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkFacturacionAgregar" name="checkFacturacionAgregar" type="checkbox"> Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkFacturacionEditar" name="checkFacturacionEditar" type="checkbox"> Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkFacturacionEliminar" name="checkFacturacionEliminar" type="checkbox"> Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Clientes
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkClientesVisualizar" name="checkClientesVisualizar" type="checkbox"> Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkClientesAgregar" name="checkClientesAgregar" type="checkbox"> Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkClientesEditar" name="checkClientesEditar" type="checkbox"> Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkClientesEliminar" name="checkClientesEliminar" type="checkbox"> Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      Proveedores
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkProveedoresVisualizar" name="checkProveedoresVisualizar" type="checkbox"> Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkProveedoresAgregar" name="checkProveedoresAgregar" type="checkbox"> Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkProveedoresEditar" name="checkProveedoresEditar" type="checkbox"> Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkProveedoresEliminar" name="checkProveedoresEliminar" type="checkbox"> Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      Reportes
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkReportesVisualizar" name="checkReportesVisualizar" type="checkbox"> Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkReportesAgregar" name="checkReportesAgregar" type="checkbox"> Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkReportesEditar" name="checkReportesEditar" type="checkbox"> Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkReportesEliminar" name="checkReportesEliminar" type="checkbox"> Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Configuración
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkConfigVisualizar" name="checkConfigVisualizar" type="checkbox"> Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkConfigAgregar" name="checkConfigAgregar" type="checkbox"> Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkConfigEditar" name="checkConfigEditar" type="checkbox"> Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkConfigEliminar" name="checkConfigEliminar" type="checkbox"> Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Control de Usuarios
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkControlUsuVisualizar" name="checkControlUsuVisualizar" type="checkbox"> Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkControlUsuAgregar" name="checkControlUsuAgregar" type="checkbox"> Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkControlUsuEditar" name="checkControlUsuEditar" type="checkbox"> Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <input id="checkControlUsuEliminar" name="checkControlUsuEliminar" type="checkbox"> Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  </tbody>
                </table>
                </div>
               
                <div id="AJAX_Response">
                  
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
                  <button type="submit" class="btn btn-primary"><i class="fa fa-user"></i> Añadir Grupo de Usuario</button>
                <?php endif;?> 
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
          </form> 
      </div>

      <div class="modal fade" id="modal-editGUsuario" style="display: none;">
          <form id="formEditUserGroup" class="form-horizontal" role="form" method="post">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-user"></i> Añadir Grupo de usuario</h4>
              </div>
              <div id="ModalBody_Edit" class="modal-body">

                  <div id="loaderForm_Edit"> 

                  </div>
                  <div id="AJAX_Response_Edit">
                    
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
      <div class="modal fade" id="modaldrop_GUsuario" style="display: none;">          
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-close"></i> Eliminar Grupo de Usuario</h4>
              </div>
              <div id="loaderForm_Delete" class="modal-body">                
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <button id="Btn_DropGUsuario" type="submit" class="btn btn-danger"><i class="fa fa-close"></i> Eliminar</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->          
      </div>

  <script type="text/javascript">
    
    $("#checkAllVisualizar").change(function(){

      if($('#checkAllVisualizar').is(':checked') == true){
        $('#checkInicioVisualizar').prop("checked", true);
        $('#checkComprasVisualizar').prop("checked", true);
        $('#checkProductosVisualizar').prop("checked", true);
        $('#checkCategoriasVisualizar').prop("checked", true);
        $('#checkFacturacionVisualizar').prop("checked", true);
        $('#checkClientesVisualizar').prop("checked", true);
        $('#checkProveedoresVisualizar').prop("checked", true);
        $('#checkReportesVisualizar').prop("checked", true);
        $('#checkConfigVisualizar').prop("checked", true);
        $('#checkControlUsuVisualizar').prop("checked", true);
        
      }else if($('#checkAllVisualizar').is(':checked') == false){
        $('#checkInicioVisualizar').prop("checked", false);
        $('#checkComprasVisualizar').prop("checked", false);
        $('#checkProductosVisualizar').prop("checked", false);
        $('#checkCategoriasVisualizar').prop("checked", false);
        $('#checkFacturacionVisualizar').prop("checked", false);
        $('#checkClientesVisualizar').prop("checked", false);
        $('#checkProveedoresVisualizar').prop("checked", false);
        $('#checkReportesVisualizar').prop("checked", false);
        $('#checkConfigVisualizar').prop("checked", false);
        $('#checkControlUsuVisualizar').prop("checked", false);
      }
    });

      $("#checkAllAgregar").change(function(){

      if($('#checkAllAgregar').is(':checked') == true){
        $('#checkInicioAgregar').prop("checked", true);
        $('#checkComprasAgregar').prop("checked", true);
        $('#checkProductosAgregar').prop("checked", true);
        $('#checkCategoriasAgregar').prop("checked", true);
        $('#checkFacturacionAgregar').prop("checked", true);
        $('#checkClientesAgregar').prop("checked", true);
        $('#checkProveedoresAgregar').prop("checked", true);
        $('#checkReportesAgregar').prop("checked", true);
        $('#checkConfigAgregar').prop("checked", true);
        $('#checkControlUsuAgregar').prop("checked", true);
        
      }else if($('#checkAllAgregar').is(':checked') == false){
        $('#checkInicioAgregar').prop("checked", false);
        $('#checkComprasAgregar').prop("checked", false);
        $('#checkProductosAgregar').prop("checked", false);
        $('#checkCategoriasAgregar').prop("checked", false);
        $('#checkFacturacionAgregar').prop("checked", false);
        $('#checkClientesAgregar').prop("checked", false);
        $('#checkProveedoresAgregar').prop("checked", false);
        $('#checkReportesAgregar').prop("checked", false);
        $('#checkConfigAgregar').prop("checked", false);
        $('#checkControlUsuAgregar').prop("checked", false);
      }
    });

      $("#checkAllEditar").change(function(){

      if($('#checkAllEditar').is(':checked') == true){
        $('#checkInicioEditar').prop("checked", true);
        $('#checkComprasEditar').prop("checked", true);
        $('#checkProductosEditar').prop("checked", true);
        $('#checkCategoriasEditar').prop("checked", true);
        $('#checkFacturacionEditar').prop("checked", true);
        $('#checkClientesEditar').prop("checked", true);
        $('#checkProveedoresEditar').prop("checked", true);
        $('#checkReportesEditar').prop("checked", true);
        $('#checkConfigEditar').prop("checked", true);
        $('#checkControlUsuEditar').prop("checked", true);
        
      }else if($('#checkAllEditar').is(':checked') == false){
        $('#checkInicioEditar').prop("checked", false);
        $('#checkComprasEditar').prop("checked", false);
        $('#checkProductosEditar').prop("checked", false);
        $('#checkCategoriasEditar').prop("checked", false);
        $('#checkFacturacionEditar').prop("checked", false);
        $('#checkClientesEditar').prop("checked", false);
        $('#checkProveedoresEditar').prop("checked", false);
        $('#checkReportesEditar').prop("checked", false);
        $('#checkConfigEditar').prop("checked", false);
        $('#checkControlUsuEditar').prop("checked", false);
      }
     });
    
    $("#checkAllEliminar").change(function(){

      if($('#checkAllEliminar').is(':checked') == true){
        $('#checkInicioEliminar').prop("checked", true);
        $('#checkComprasEliminar').prop("checked", true);
        $('#checkProductosEliminar').prop("checked", true);
        $('#checkCategoriasEliminar').prop("checked", true);
        $('#checkFacturacionEliminar').prop("checked", true);
        $('#checkClientesEliminar').prop("checked", true);
        $('#checkProveedoresEliminar').prop("checked", true);
        $('#checkReportesEliminar').prop("checked", true);
        $('#checkConfigEliminar').prop("checked", true);
        $('#checkControlUsuEliminar').prop("checked", true);
        
      }else if($('#checkAllEliminar').is(':checked') == false){
        $('#checkInicioEliminar').prop("checked", false);
        $('#checkComprasEliminar').prop("checked", false);
        $('#checkProductosEliminar').prop("checked", false);
        $('#checkCategoriasEliminar').prop("checked", false);
        $('#checkFacturacionEliminar').prop("checked", false);
        $('#checkClientesEliminar').prop("checked", false);
        $('#checkProveedoresEliminar').prop("checked", false);
        $('#checkReportesEliminar').prop("checked", false);
        $('#checkConfigEliminar').prop("checked", false);
        $('#checkControlUsuEliminar').prop("checked", false);
      }


    });
  </script>
  
  <script type="text/javascript">
  $(document).ready(function (){
      load(1);
  });
  function load(page,itemsbypage){    
    var query = $('#query').val(); 
    var itemsbypage = $('#showElementsby option:selected').val();
    $.ajax({
      data: {"pagina":page,"artporpagina":itemsbypage,"query":query},
      type: 'POST',      
      url: '/SmartShop/Usuarios/MostrarItems_GUSUARIO_AJAX',          
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

    $('#formAddUserGroup').submit(function(ev){
    ev.preventDefault();
    var formData = new FormData(document.getElementById('formAddUserGroup'));
    $.ajax({    
      data: formData,      
      type: 'POST',      
      url: '/SmartShop/usuarios/add_GUsuariosAJAX',
      contentType: false,
      processData: false,
            
      beforeSend: function(){
        $("#loaderForm_add").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();       
        load(); 
        $('#AJAX_Response').html(datos);  
        document.getElementById('form_AddCliente').reset();
        
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });  
  });

        $('#formEditUserGroup').submit(function(ev){
    ev.preventDefault();
    var formData = new FormData(document.getElementById('formEditUserGroup'));
    $.ajax({    
      data: formData,      
      type: 'POST',      
      url: '/SmartShop/usuarios/edit_GUsuariosAJAX',
      contentType: false,
      processData: false,
            
      beforeSend: function(){
        $("#ModalBody_Edit").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();       
        load(); 
        $('#AJAX_Response_Edit').html(datos);          
        
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });  
  });

      function edit_GUsuario(id){
    $.ajax({
      data: {"id":id},
      type: 'POST',
      url: '/SmartShop/Usuarios/getFORM_EDIT_GUsuario',       
      beforeSend: function(){
        //Abrimos el modal y Mostramos el loader
        $("#loaderForm_Edit").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();
        //Mostramos los datos
        $('#loaderForm_Edit').html(datos);        
        $('#AJAX_Response_Edit').html('');      
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
  }

    function modaldrop_GUsuario(id){   
  //Modal    
    $("#loaderForm_Delete").html('<p class="text-center"> ¿Estás seguro de eliminar este registro? <br></p><p class="help-block">(*) Todos los usuarios que tengan este grupo de usuario tambien se eliminaran.<br>(*) Esta acción es irreversible <br> </p>');
    $('#Btn_DropGUsuario').show();
    $('#Btn_DropGUsuario').attr('onclick', 'dropGUsuario('+id+')');
  }

  function dropGUsuario(id){
    $.ajax({
      data: {"id":id},
      type: 'POST',
      url: '/SmartShop/usuarios/dropGUsuariobyIDAJAX',
      beforeSend: function(){
        //Mostramos el loader en el modal
        $("#loaderForm_Delete").html('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        //Mostramos los datos en el Modal
        $("#loaderForm_Delete").html(datos);
        $('#Btn_DropGUsuario').hide();
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
    $('#Contactos').removeClass('active');
    $('#Reportes').removeClass('active');
    $('#Configuracion').removeClass('active');
    $('#Accesos').addClass('active');
  });
  </script>
<?php require_once("Assets/footer.php") ?>