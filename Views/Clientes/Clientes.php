<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-edit"></i> Administrar Clientes      
      </h1>
      <ol class="breadcrumb">
        <li><a href="/SmartShop/Clientes"><i class="fa fa-dashboard"></i> Clientes</a></li>
        <li class="active">Ver Clientes</li>
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
                    
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-addCliente"><i class="fa fa-plus"></i> Nuevo Cliente</button>     
                    
                  </div>
                                
                  <div class="col-md-4 col-xs-12">
                     <select id="showElementsby" type="form-control" class="btn btn-default" >
                      <option value="5">Mostrar 5</option>
                      <option value="10">Mostrar 10</option>
                      <option value="50">Mostrar 50</option>
                      <option value="100">Mostrar 100</option>
                      <option value="<?php echo $data['totalClientes']; ?>">Todos</option>
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


      <div class="modal fade" id="modal-addCliente" style="display: none;">
          <form id="form_AddCliente" class="form-horizontal" action="" role="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-briefcase"></i> Añadir Cliente</h4>
              </div>
          <?php if($_SESSION['user_group']['permisos']['agregar']['clientes'] == 'true'): ?>
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
                    <input placeholder="Sin datos" name="nombre_empresa" type="text"  class="form-control" 
                    onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">CI/RIF</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" id="InputRif" name="rif" type="text" pattern="[V|J|P|E][-][0-9]{8,9}" class="form-control" required oninvalid="setCustomValidity('Rellena este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}"><!--                                       pattern="[V|J|P|E][-][0-9]{5,9}" -->
                  </div>
                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Sitio WEB</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="sitio_web" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                
                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Nombres</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="nombre" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Apellidos</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="apellido" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                   
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Teléfono</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" id="InputTelefono" name="telefono" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">                  
                  </div>
                </div>

                  <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Email</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="email" type="email"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                
                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Local Nro</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="local_nro" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Calle</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="calle" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Sector/Urb</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="sector" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Ciudad</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="ciudad" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Estado</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="estado" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Cod - Postal</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="cod_postal" type="text" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">País</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="pais" type="text" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
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
                <?php if($_SESSION['user_group']['permisos']['agregar']['clientes'] == 'true'): ?>
                <button type="submit" class="btn btn-primary"><i class="fa fa-user"></i> Añadir Cliente</button>
              <?php endif; ?>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
          </form> 
      </div>

      <div class="modal fade" id="modal-editCliente" style="display: none;">
          <form id="form_editCliente" class="form-horizontal" action="" role="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-briefcase"></i> Editar Cliente</h4>
              </div>
              <div id="loaderForm_Edit" class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-user"></i> Editar Cliente</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
          </form> 
      </div>

      <div class="modal fade" id="modal-dropCliente" style="display: none;">          
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-close"></i> Eliminar Cliente</h4>
              </div>
              <div id="loaderForm_Delete" class="modal-body">                
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button id="Btn_DropClient" type="submit" class="btn btn-danger"><i class="fa fa-close"></i> Eliminar Cliente</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->          
      </div>

      <div class="modal fade modal-primary bd-example-modal-lg" id="modal-deudasCliente" style="display: none;">          
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-briefcase"></i> Deudas del Cliente</h4>
              </div>
              <div id="modal-body_deudasCliente" class="modal-body">                                                

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button id="" type="submit" class="btn btn-default"><i class="fa fa-print"></i> Imprimir Reporte Completo</button>
                <button id="" onclick="$('#modal-deudasCliente').modal('hide')" data-toggle="modal" data-target="#modal-procesarVenta" type="button" class="btn btn-success"><i class="fa fa-dollar"></i> Pagar deudas</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->          
      </div>

      <div class="modal fade modal-primary bd-example-modal-lg" id="modal-procesarVenta" style="display: none;">
          <div class="modal-dialog modal-lg">            
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-briefcase"></i> Procesar Deudas - Pagos</h4>
              </div>              
               <input type="hidden" id="counter" value="0" autocomplete="off">
                <div id="modal-body" class="modal-body">                                      
                
                <div id="Pago" class="row">
                <div class="form-group col-sm-4">
                   <label for="Metodo_Pago">Metodo de pago</label>                   
                   <select class="form-control Metodo_Pago" name="Metodo_Pago0" id="Metodo_Pago0">
                    <option value="">Seleccione</option>                    
                    <option value="Efectivo_BsS">Efectivo - Bolivares Soberanos</option>
                    <option value="Efectivo_D">Efectivo - Dolares</option>
                    <option value="Punto venta_BsS">Punto de Venta - Bolivares Soberanos</option>
                    <option value="Punto venta_D">Punto de Venta - Dolares</option>
                    <option value="Pago movil">Pago Movil</option>
                    <option value="Transferencia">Transferencia</option>                    
                  </select>
                </div> 
                <div class="form-group col-sm-3">
                  <label for="Monto_Pagar">Monto a Cancelar</label>
                  <input type="text" name="Monto_Pagar0" class="form-control Monto_Pagar" id="Monto_Pagar0" autocomplete="off">
                </div> 

                  <div class="form-group col-sm-3">                  
                   <label for="Referencia">Nro Referencia</label>
                   <input type="text" class="form-control Nro_Referencia" name="Nro_Referencia0" id="Nro_Referencia0" autocomplete="off">
                  </div>
                   <div class="form-group col-sm-2">                                                    
                    <label id="Label_BtnAñadir_Pago" for="">Añadir Pago</label>
                  <a id="BtnAñadir_Pago" onclick="añadir_Pago();" class="btn btn-default btn-flat center-block">+</a>                  
                  </div>
                </div>                                                             
              </div>
              <div class="row">
                <div class="form-group col-sm-12">
                  <h3 class="col-sm-6">Total a Pagar:</h3>
                  <h3 class="col-sm-6">$ <span id="LabelMonto_Pagar"></span> / BsS <span id="LabelMonto_PagarBsS"></span></h3>
                </div>                
                <div class="form-group col-sm-12">
                  <h3 class="col-sm-6">Por Pagar:</h3>
                  <h3 class="col-sm-6">$ <span id="LabelPor_Pagar"></span> / BsS <span id="LabelPor_PagarBsS"></span></h3>
                </div>                
                <div class="form-group col-sm-12">
                  <h3 class="col-sm-6">Cambio:</h3>
                  <h3 class="col-sm-6">$  <span id="Cambio">00.00</span> / BsS <span id="CambioBsS">00.00</span></h3>
                </div>
                </div>                 
                <input type="hidden" id="HiddenTotal" value=0>
                <input type="hidden" id="HiddenTotalBsS" value=0>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                  <button type="submit" onclick="abonarDeuda();" class="btn btn-success"><i class="fa fa-dollar"></i> Abonar Deuda</button>
               </div>              
            </div>
            <!-- /.modal-content -->            
          </div>
          <!-- /.modal-dialog -->          
      </div>

      <div class="modal fade" id="modal-abonosRespuesta" style="display: none;">        
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">AVISO</h4>
              </div>
              <div class="modal-body">             
              <div id="Resultados_Abonos" class="box box-default">
               
                <!-- <div class="overlay">
                 <i class="fa fa-refresh fa-spin"></i>
                </div> -->
              </div>
              </div>                                                              
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->          
      </div>
<script>  
    $(document).ready(function (){
    //Paginación
      load(1);
    //InputMask's
      $("#InputRif").inputmask({mask: "A-99999999[9]", greedy: false});      
      $("#InputTelefono").inputmask({mask: "(999)-9999999"});            
  });    
  //Escuchar Select ## Paginación
  $('#showElementsby').change(function(){       
    var ibypage = $('#showElementsby option:selected').val();
    load(1);
  });
//Funcion paginación
  function load(page,itemsbypage){    
    var query = $('#query').val(); 
    var itemsbypage = $('#showElementsby option:selected').val();
    $.ajax({
      data: {"pagina":page,"artporpagina":itemsbypage,"query":query},
      type: 'POST',      
      url: '/SmartShop/Clientes/MostrarItemsAJAX',          
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

  $('#form_AddCliente').submit(function(ev){
    ev.preventDefault();
    var formData = new FormData(document.getElementById('form_AddCliente'));
    $.ajax({    
      data: formData,      
      type: 'POST',      
      url: '/SmartShop/clientes/addClientesAJAX',
      contentType: false,
      processData: false,
            
      beforeSend: function(){
        $("#loaderForm_1").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();       
        load(); 
        $('#loaderForm_1').append(datos);  
        document.getElementById('form_AddCliente').reset();
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });  
  });

 $('#form_editCliente').submit(function(ev){
    ev.preventDefault();    
    var formData = new FormData(document.getElementById('form_editCliente'));
    $.ajax({    
      data: formData,      
      type: 'POST',      
      url: '/SmartShop/clientes/editClientesAJAX',
      contentType: false,
      processData: false,            
      beforeSend: function(){
        $("#loaderForm_Edit").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();       
        load(); 
        $('#loaderForm_Edit').append(datos);  
        // document.getElementById('form_editCliente').reset();
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
  });

  function editCliente(id){
    $.ajax({
      data: {"id":id},
      type: 'POST',
      url: '/SmartShop/clientes/getDATAClientebyIDAJAX',       
      beforeSend: function(){
        //Abrimos el modal y Mostramos el loader
        $("#loaderForm_Edit").append('<div id="loader1" class="overlay center-block"><i class="fa fa-refresh fa-spin"></i></div>');
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

  function modal_dropCliente(id){   
  //Modal    
    $("#loaderForm_Delete").html('<p class="text-center"> ¿Estás seguro de eliminar este registro? <br></p><p class="help-block">(*) Todos los datos relacionados a este registro se eliminaran, compras, ventas.<br>(*) Esta acción es irreversible <br> </p>');
    $('#Btn_DropClient').show();
    $('#Btn_DropClient').attr('onclick', 'dropCliente('+id+')');
  }

  function dropCliente(id){    
    $.ajax({
      data: {"id":id},
      type: 'POST',
      url: '/SmartShop/clientes/dropClientebyIDAJAX',
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

  function deudaCliente(id){    
    $.ajax({
      data: {"id":id},
      type: 'POST',
      url: '/SmartShop/clientes/deudasClientebyIDAJAX',
      beforeSend: function(){
        //Mostramos el loader en el modal
        $("#modal-body_deudasCliente").html('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        //Mostramos los datos en el Modal
        $("#loader1").remove();
        $("#modal-body_deudasCliente").html(datos);
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus); 
      }
    });
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){
    actualizar_Total();  
  });
     function actualizar_Total(){
    //Funcion utilizada para actualizar los codigos, de los inputs actualizados.
    //Codigo para formatear el input a moneda, con comas y decimales
    $('.Monto_Pagar').on('keyup',function(){
      this.value = (!(this.value.includes('.')) ? Intl.NumberFormat('en-EN').format(this.value.replace(/,/g,'')) : this.value);      
   });

    //Codigo para solo permitir numeros en el Input y permitir solo un '.'
   $('.Monto_Pagar').on('keydown',function(ev){
    
    var nroCaracter = ev.keyCode;
    var caracter = String.fromCharCode(ev.keyCode);                

    if((this.value.includes('.')) && (nroCaracter == '190' || nroCaracter == '188')){
      ev.preventDefault();
    }

    if ((caracter >= 0 && caracter <= 9) || nroCaracter == '8' || nroCaracter == '190' || nroCaracter == '188'){
      //Do nothing
    }else{
      ev.preventDefault();
    }
      
   });

   //Codigo para calcular el total de la compra, cambio, sumando todos los inputs creados    
   $('.Monto_Pagar').on('keyup',function(){
        var monto_total = 0;        
        //Funcion para recuperar el valor de cada campo generado y sumarlo          
       $('.Monto_Pagar').each(function(){        
        //Cuadrar para que de el total, y comprobar si son bolivares o dolares lo que se utiliza
        var i = $(this).attr('id').substring(11,12);
                      
          //Codigo para el comportamiento de cada input de acuerdo si es en dolares o en bolivares               
      
        if($('#Metodo_Pago'+i).val() == 'Efectivo_BsS' || $('#Metodo_Pago'+i).val() == 'Punto venta_BsS' || $('#Metodo_Pago'+i).val() == 'Pago movil' || $('#Metodo_Pago'+i).val() == 'Transferencia'){
          monto_total += parseFloat($(this).val().replace(/,/g,'') / <?php echo $_SESSION['precio_dolar'] ?>);
        }else{          
          monto_total += parseFloat($(this).val().replace(/,/g,''));
        }
        
        });                           
        if((parseFloat($('#HiddenTotal').val()) - monto_total) < 0){
         $('#LabelPor_Pagar').html('00.00');
         $('#LabelPor_PagarBsS').html('00.00');
          $('#Cambio').html((parseFloat(($('#HiddenTotal').val()) - monto_total)*-1).toLocaleString('en-EN'));
       }else{        
           $('#LabelPor_Pagar').html((parseFloat($('#HiddenTotal').val()) - monto_total).toLocaleString('en-EN'));      

           $('#LabelPor_PagarBsS').html((parseFloat($('#HiddenTotalBsS').val()) - parseFloat(monto_total *  <?php echo $_SESSION['precio_dolar'] ?>)).toLocaleString('en-EN'));
         $('#Cambio').html('00.00');
        }  
    });

     $('.Metodo_Pago').on('change',function(){
        var monto_total = 0;        
        //Funcion para recuperar el valor de cada campo generado y sumarlo          
        $('.Monto_Pagar').each(function(){        
        //Cuadrar para que de el total, y comprobar si son bolivares o dolares lo que se utiliza
        var i = $(this).attr('id').substring(11,12);
                      
          //Codigo para el comportamiento de cada input de acuerdo si es en dolares o en bolivares               
      
        if($('#Metodo_Pago'+i).val() == 'Efectivo_BsS' || $('#Metodo_Pago'+i).val() == 'Punto venta_BsS' || $('#Metodo_Pago'+i).val() == 'Pago movil' || $('#Metodo_Pago'+i).val() == 'Transferencia'){
          monto_total += parseFloat($(this).val().replace(/,/g,'') / <?php echo $_SESSION['precio_dolar'] ?>);
        }else{          
          monto_total += parseFloat($(this).val().replace(/,/g,''));
        }
        
        });                           
        if((parseFloat($('#HiddenTotal').val()) - monto_total) < 0){
          $('#LabelPor_Pagar').html('00.00');
          $('#LabelPor_PagarBsS').html('00.00');
          $('#Cambio').html((parseFloat(($('#HiddenTotal').val()) - monto_total)*-1).toLocaleString('en-EN'));
        }else{        
          $('#LabelPor_Pagar').html((parseFloat($('#HiddenTotal').val()) - monto_total).toLocaleString('en-EN'));      

         $('#LabelPor_PagarBsS').html((parseFloat($('#HiddenTotalBsS').val()) - parseFloat(monto_total *  <?php echo $_SESSION['precio_dolar'] ?>)).toLocaleString('en-EN'));
         $('#Cambio').html('00.00');
        }  
    });  
};

//Usar ciclo for con el contador para crear las funciones de JS para escuchar cada uno de los inpit, :B
    function añadir_Pago(){ 
      var contador = $('#counter').val();
      contador = parseInt($('#counter').val())+1;
      var pago = $('#Pago').clone();
      pago.attr("id",'Pago'+contador);
      //ID
      pago.children(".form-group").children('#Metodo_Pago0').attr('id','Metodo_Pago'+contador).attr('name','Metodo_Pago'+contador);    
      pago.children(".form-group").children('#Monto_Pagar0').attr('id','Monto_Pagar'+contador).attr('name','Monto_Pagar'+contador);    
      pago.children(".form-group").children('#Nro_Referencia0').attr('id','Nro_Referencia'+contador).attr('name','Nro_Referencia'+contador);          
      //Detectamos si es el primer label para crear el boton
      if(contador=='1'){
        console        
        pago.children(".form-group").children('#BtnAñadir_Pago').attr('class','btn btn-danger btn-flat center-block');  
        pago.children(".form-group").children('#BtnAñadir_Pago').html('-');  
        pago.children(".form-group").children('#BtnAñadir_Pago').attr('onclick','eliminar_Pago()');
        pago.children(".form-group").children('#BtnAñadir_Pago').attr('id','BtnRemovePago');
        pago.children(".form-group").children('#Label_BtnAñadir_Pago').html('Eliminar Pago');
      }else{
        pago.children(".form-group").children('#BtnAñadir_Pago').remove();
        pago.children(".form-group").children('#Label_BtnAñadir_Pago').remove();
      }
      
      
      $('#modal-body').append(pago);      
      $('#counter').val(contador);  

      actualizar_Total();      
      // console.log($('#Pago > .form-group > #Monto_Pagar'));
      // console.log($('#Pago > .form-group > #Nro_Referencia'));
      //act_f();
   }

     function eliminar_Pago(){       
      var contador = $('#counter').val();
      var row = $('#modal-body').children('#Pago'+contador).remove();      
      $('#modal-body').remove(row);
      contador = parseInt(contador)-1;  
      $('#counter').val(contador);      
      actualizar_Total();     
   }
</script>
<script>
  //Abonar Deuda
  function abonarDeuda(){                    
      //Metodos de Pago con each
      var ClienteID = $('#ClienteID').val();
        var metodo_Pago = [0];
        var monto_Pagar = [0];
        var nro_Referencia = [0];    
      $('.Metodo_Pago').each(function(){
          metodo_Pago[$(this).attr('id').substring(11,12)] = $(this).val();          
      });

      $('.Monto_Pagar').each(function(){
          monto_Pagar[$(this).attr('id').substring(11,12)] = $(this).val();                
      });

      $('.Nro_Referencia').each(function(){
          nro_Referencia[$(this).attr('id').substring(14,15)] = $(this).val();        
      });

      //Enviamos los datos mediante ajax
      $.ajax({      
      data: {"ClienteID":ClienteID,"Metodo_Pago":metodo_Pago,"Monto_Pagar":monto_Pagar,"Nro_Referencia":nro_Referencia},
      type: 'POST',            
      url: '/SmartShop/Clientes/NuevoAbono_AJAX',               
      beforeSend: function(){
        $("#Resultados_Abonos").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();  
        $('#modal-abonosRespuesta').modal('show');
        $("#Resultados_Abonos").html(datos);
        //Llamammos la funcion de recargar la Venta
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
    $('#Productos').removeClass('active');
    $('#Contactos').addClass('active');
    $('#Reportes').removeClass('active');
    $('#Configuracion').removeClass('active');
    $('#Accesos').removeClass('active');
  });
</script>
<?php require_once("Assets/footer.php") ?>