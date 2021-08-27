<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-dollar"></i> Nueva Venta
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="/SmartShop/Ventas"><i class="fa fa-dashboard"></i> Ventas</a></li>
        <li class="active">Nueva Venta</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      
      <div class="row">
        <div class="col-sm-4">

          <div class="box box-primary">
            <form role="form" action="" id="formProcessVenta">
             <div class="box-header with-border">

              <h3 class="box-title">Detalles de la venta</h3>              
             </div>
             <!-- /.box-header -->
             <!-- form start -->
            
              <div class="box-body">                
                <div class="form-group col-6">
                  <label for="datepicker">Fecha</label>                  
                  <div class="input-group date">
                    <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                    </div>
                    <input autocomplete="off" name="Fecha" id="Fecha" type="text" class="form-control pull-right" value="<?php $DateTime = getdate();
                    echo $DateTime['mday'] . '/' . $DateTime['mon'] . '/' . $DateTime['year']?>" data-inputmask="'alias': 'dd/mm/yyyy'" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                  </div>
                </div>

                <div class="form-group col-6">
                  <label>Razón Social</label>
                  <div class="input-group">
                    <select name="ClienteID" id="ClientesInput" class="form-control select2 select2-hidden-accessible" style="width: 100%;"   data-select2-id="9" tabindex="-1" aria-hidden="true" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                      
                    </select>
                  <div class="input-group-btn">
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-addCliente">
                        <i class="fa fa-plus"></i> Nuevo
                      </button>                      
                  </div>     
                </div>
               </div>                                       
              <div class="form-group col-md-12">
                  <label for="">Agregar Productos</label>
                  <button type="button" class="form-control btn btn-default" onclick="load(1)" data-toggle="modal" data-target="#modal-searchProductos"><i class="fa fa-search"></i> Buscar Productos</button>
              </div>
              <div class="form-group col-md-12">                  
                  <button type="submit" class="form-control btn btn-success pull-right"><i class="fa fa-dollar "></i> Procesar Venta</button>    
              </div>
              
            </form>              
              <!-- /.box-body -->            
                  <!-- <form role="form" >                    
                      <div class="col-xs-6"> 
                        <div class="form-group">                          
                          <label for="nroCompraInput">Cantidad</label>
                          <input type="text" class="form-control" id="nroCompraInput">
                        </div>                                                 
                      </div>

                      <div class="col-xs-6">                        
                        <div class="form-group">                          
                          <label for="nroCompraInput">Codigo de Barras</label>
                          <input type="text" class="form-control" id="nroCompraInput">
                        </div>                                                                 
                      </div>                   
                      <div class="form-group pull-right">
                        <button type="submit" class="btn btn-info "><i class="fa fa-barcode"></i> Añadir Producto</button>
                      </div>                                                                                
                    </form> -->
                
                                         
          </div>

        </div>
      </div>

                <div class="col-sm-8">
                     <div id="loaderBox_Productos" class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="center box-title">Productos</h3>                      
                    </div>                    
                    
                                     
                    <div id="Resultados_Productos"> 

                    </div>                                          
                              <!-- Loader -->

              </div>
                </div>
            </div>    
      


<div class="modal fade modal-primary bd-example-modal-lg" id="modal-procesarVenta" style="display: none;">
          <div class="modal-dialog modal-lg">            
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-briefcase"></i> Procesar Venta - Pagos</h4>
              </div>
              <form role="form" id="formVenta" action="/SmartShop/Ventas/NuevaVenta_AJAX" method="POST">
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
                  <button type="submit" class="btn btn-success"><i class="fa fa-dollar"></i> Completar Venta</button>
               </div>
              </form> 
            </div>
            <!-- /.modal-content -->            
          </div>
          <!-- /.modal-dialog -->          
      </div>
      
      <div class="modal fade" id="modal-addCliente" style="display: none;">
          <form id="form_AddCliente" class="form-horizontal" action="" role="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-briefcase"></i> Añadir Cliente</h4>
              </div>
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
                    onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">                  
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">CI/RIF</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" id="InputRif" name="rif" type="text" pattern="[V|J|P|E][-][0-9]{8,9}" class="form-control" required oninvalid="setCustomValidity('Rellena este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}" autocomplete="off"><!--                                       pattern="[V|J|P|E][-][0-9]{5,9}" -->
                  </div>
                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Sitio WEB</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="sitio_web" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">                  
                  </div>

                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                
                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Nombres</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="nombre" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Apellidos</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="apellido" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">                   
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Teléfono</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" id="InputTelefono" name="telefono" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" autocomplete="off">                  
                  </div>
                </div>

                  <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Email</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="email" type="email"  class="form-control" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">                  
                  </div>

                </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                
                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Local Nro</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="local_nro" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">                  
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Calle</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="calle" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Sector/Urb</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="sector" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Ciudad</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="ciudad" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Estado</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="estado" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Cod - Postal</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="cod_postal" type="text" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">País</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin datos" name="pais" type="text" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off">                  
                  </div>

                </div>

              </div>
              <!-- /.tab-pane -->
            </div>            
            <!-- /.tab-content -->
          </div>                    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-user"></i> Añadir Cliente</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
          </form> 
      </div>

       <div class="modal fade bd-example-modal-lg" id="modal-searchProductos" style="display: none;">
        <form class="form" action="" role="form">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-search"></i> Buscar Productos</h4>
              </div>
              <div class="modal-body">
              <div class="row">
                <div class="form-group col-xs-12">
                  <label  class="control-label" for="">Ingresa el Nombre o el Codigo</label>
                  <input id="query" type="text" class="form-control" autocomplete="off">                  
                </div>
              </div>
              <div id="box-loader" class="box box-default">
               
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
          </form> 
      </div>

        <div class="modal fade" id="modal-confirm_fiarVenta" style="display: none;">
        
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">AVISO</h4>
              </div>
              <div class="modal-body">             
                <h4 class="text-center">El Cliente no ha pagado el monto total<br>
                El monto no abonado se sumará a la deuda del cliente <br></h4>
                <h3 class="text-center">¿Desea continuar?</h3>
              </div>                                                              
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" onclick="guardarVenta();" class="btn btn-success"><i class="fa fa-dollar"></i> Completar Venta</button>
              </div>
          </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->          
      </div>

        <div class="modal fade" id="modal-Ventarespuesta" style="display: none;">        
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">AVISO</h4>
              </div>
              <div class="modal-body">             
              <div id="Resultados_Venta" class="box box-default">
               
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


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
  $(function () {    
    $('.select2').select2();    
    $('#datepicker').datepicker({
      autoclose: true
    });
    //Cargamos el Select con los clientes    
    loadClientes();
  });
  
    //InputMask's
   $(document).ready(function(){
      $("#InputRif").inputmask({mask: "A-99999999[9]", greedy: false});      
      $("#InputTelefono").inputmask({mask: "(999)-9999999"});

   });

  //Funcion para traer productos AJAX a seleccionar
    function load(page,itemsbypage){    
    var query = $('#query').val();     
    $.ajax({
      data: {"pagina":page,"artporpagina":itemsbypage,"query":query},
      type: 'POST',      
      url: '/SmartShop/Productos/MostrarItemstoVentaAJAX',            
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
  };

  //Evento KeyUp de Query
   //Evento de busqueda de productos
  $('#query').keyup(function(){
    load(1);
    });

   function loadClientes(){
      $.ajax({      
      type: 'POST',      
      url: '/SmartShop/clientes/getClientesAJAX',            
      beforeSend: function(){        
      },
      success: function(datos){                
        $('#ClientesInput').html(datos);  
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
    };
</script>
<script type="text/javascript">
   //Funciones ventas-productos
   $(document).ready(function(){
      cargarVenta_TMP();
      updateVenta_TMP();
      //Detectamos el cambio del monto              
   });    

   function cargarVenta_TMP(){
       $.ajax({                  
      url: '/SmartShop/Productos/showAllProduct_VentaTMPAJAX',            
      beforeSend: function(){
        $("#loaderBox_Productos").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();        
        $('#Resultados_Productos').html(datos);          
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
   }

    function updateVenta_TMP(){
      var iva = $('#Iva_Select').val();
     $.ajax({      
      data: {"iva":iva},
      type: 'POST',            
      url: '/SmartShop/Productos/updateProduct_VentaTMPAJAX',            
      beforeSend: function(){
        $("#loaderBox_Productos").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();                
        
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
   }

    function addProduct(id){
      //Variables           
      var cantidad = $('#cantidad_'+id).val();
      var iva = $('#Iva_Select').val();
      $.ajax({      
      data: {"cantidad":cantidad,"id":id,"iva":iva},
      type: 'POST',            
      url: '/SmartShop/Productos/addProduct_VentaTMPAJAX',            
      beforeSend: function(){
        $("#loaderBox_Productos").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();                
        cargarVenta_TMP(); 
        // $('#Resultados_Productos').html(datos);   
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
   }  

   function deleteProduct(id){
      var iva = $('#Iva_Select').val();
     $.ajax({      
      data: {"id":id,"iva":iva},
      type: 'POST',            
      url: '/SmartShop/Productos/deleteProduct_VentaTMPAJAX',            
      beforeSend: function(){
        $("#loaderBox_Productos").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();        
        cargarVenta_TMP();
        
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
   }

   $('#formProcessVenta').submit(function(ev){
    ev.preventDefault();
    $('#modal-procesarVenta').modal('show');
});
      
   //Finalizar Venta
   $('#formVenta').submit(function(ev){ 
      ev.preventDefault();        
      if(parseFloat($('#LabelPor_Pagar').html()) != 0.00){
        //Ejecutamos modal preguntando
        $('#modal-confirm_fiarVenta').modal('show');  
      }else{
        guardarVenta();
      }

   });

   function guardarVenta(){    
      //Fecha
      var Fecha = $('#Fecha').val();
      //Cliente
      var ClienteID = $('#ClientesInput').val();          
      //Metodos de Pago con each
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
      data: {"Fecha":Fecha,"ClienteID":ClienteID,"Metodo_Pago":metodo_Pago,"Monto_Pagar":monto_Pagar,"Nro_Referencia":nro_Referencia},
      type: 'POST',            
      url: '/SmartShop/Ventas/NuevaVenta_AJAX',               
      beforeSend: function(){
        $("#loaderBox_Ventas").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();  

        $('#modal-Ventarespuesta').modal('show');
        $("#Resultados_Venta").html(datos);
        //Llamammos la funcion de recargar la Venta
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
   }

      //Añadir clientes
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
        loadClientes(); 
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
</script>
<script type="text/javascript">
  //Funciones para los metodos de pago
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