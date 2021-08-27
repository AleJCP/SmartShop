<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-truck"></i> Nueva Compra        
      </h1>
      <ol class="breadcrumb">
        <li><a href="/SmartShop/Compras"><i class="fa fa-dashboard"></i> Compras</a></li>
        <li class="active">Nueva Compra</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">    
			<div class="row">
        <div class="col-xs-12">

          <div id="loaderBox_Compras" class="box box-primary">
            <form role="form" id="formCompra">
            <div class="box-header with-border">
              <h3 class="box-title">Detalles de la compra</h3>
              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-truck "></i> Añadir Compra</button>

            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            
              <div class="box-body">
                <div id="Resultados_Compra">
              
                </div>                

                <div class="form-group col-md-4">
                  <label for="datepicker">Fecha</label>
                  
                  <div class="input-group date">
                    <div class="input-group-addon">
                     <i class="fa fa-calendar"></i>
                    </div>
                    <input id="Fecha" value="<?php $DateTime = getDate(); $fecha = $DateTime['mday'].'/'.$DateTime['mon'].'/'.$DateTime['year']; echo $fecha; ?>" type="text" class="form-control pull-right" data-inputmask="'alias': 'dd/mm/yyyy'" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                  </div>

                </div>


                <div class="form-group col-md-4">
                  <label>Proveedor</label>
                  <div class="input-group">
                    <select id="ProveedorInput" class="form-control select2 select2-hidden-accessible" style="width: 100%;"   data-select2-id="9" tabindex="-1" aria-hidden="true" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                      
                    </select>
                  <div class="input-group-btn">
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-addProveedor">
                        <i class="fa fa-plus"></i> Nuevo
                      </button>                      
                  </div>     
                </div>
              </div>
                
               <!--  <div class="form-group col-md-4">
                  <label for="ProveedorInput">Proveedor</label>
                  <div class="input-group">
                    <select id="ProveedorInput" class="form-control" required="" oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                                             
                    </select>                                    
                     <div class="input-group-btn">
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-addProveedor">
                        <i class="fa fa-plus"></i> Nuevo
                      </button>                      
                     </div>                
                   </div>                  
                </div>  -->            

                <div class="form-group col-md-4">
                  <label for="">Agregar Productos</label>
                  <button type="button" style="width: 100%;" onclick="load(1)" class="btn btn-default" data-toggle="modal" data-target="#modal-searchProductos"><i class="fa fa-search"></i> Buscar Productos</button>

                  <!-- <p class="help-block">Example block-level help text here.</p> -->
                </div>
              </form>
                <div class="form-group">
                  
              </div>
              <!-- /.box-body -->
            <div class="row">
              <div class="col-xs-12">
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
          </div>

        </div>
      </div>

      <div class="modal fade" id="modal-addProveedor" style="display: none;">
          <form id="form_AddProveedores" class="form-horizontal" action="" role="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><i class="fa fa-briefcase"></i> Añadir Proveedor</h4>
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
                    <input name="nombre_empresa" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">CI/RIF</label>
                  <div class="col-sm-10">
                    <input id="InputRif" name="rif" type="text" pattern="[V|J|P|E][-][0-9]{8,9}" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Sitio WEB</label>
                  <div class="col-sm-10">
                    <input name="sitio_web" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                
                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Nombres</label>
                  <div class="col-sm-10">
                    <input name="nombre" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Apellidos</label>
                  <div class="col-sm-10">
                    <input name="apellido" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                   
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Teléfono</label>
                  <div class="col-sm-10">
                    <input id="InputTelefono" name="telefono" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">                  
                  </div>
                </div>

                  <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Email</label>
                  <div class="col-sm-10">
                    <input name="email" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                
                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Local Nro</label>
                  <div class="col-sm-10">
                    <input name="local_nro" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Calle</label>
                  <div class="col-sm-10">
                    <input name="calle" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Sector/Urb</label>
                  <div class="col-sm-10">
                    <input name="sector" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Ciudad</label>
                  <div class="col-sm-10">
                    <input name="ciudad" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Estado</label>
                  <div class="col-sm-10">
                    <input name="estado" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Cod - Postal</label>
                  <div class="col-sm-10">
                    <input name="cod_postal" type="text" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">País</label>
                  <div class="col-sm-10">
                    <input name="pais" type="text" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
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
                <button type="submit" class="btn btn-primary"><i class="fa fa-user"></i> Añadir Proveedor</button>
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
                  <input id="query" type="text" class="form-control">                  
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

    </section>
</div>
<script>   

$(document).ready(function(){
//SELECT
    $('.select2').select2();  
  //CARGAMOS LOS PROVEEDORES
      loadProveedores();
   });
 
     //InputMask's
   $(document).ready(function(){
      $("#InputRif").inputmask({mask: "A-99999999[9]", greedy: false});      
      $("#InputTelefono").inputmask({mask: "(999)-9999999"});

   });

    //Evento de busqueda de productos
  $('#query').keyup(function(){
    load(1);
    });

//Funciones AJAX
    function loadProveedores(){
      $.ajax({      
      type: 'POST',      
      url: '/SmartShop/proveedores/getProveedoresAJAX',            
      beforeSend: function(){        
      },
      success: function(datos){                
        $('#ProveedorInput').html(datos);          
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
    }

  function load(page,itemsbypage){    
    var query = $('#query').val();     
    $.ajax({
      data: {"pagina":page,"artporpagina":itemsbypage,"query":query},
      type: 'POST',      
      url: '/SmartShop/Productos/MostrarItemstoCompraAJAX',            
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
</script>
<script type="text/javascript">
  //Funciones compras-productos
  $(document).ready(function(){
      cargarCompra_TMP();
      updateCompra_TMP();
      //Detectamos el cambio del select del iva

  });

  function cargarCompra_TMP(){
       $.ajax({                  
      url: '/SmartShop/Productos/showAllProduct_CompraTMPAJAX',            
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

    function updateCompra_TMP(){
      var iva = $('#Iva_Select').val();
     $.ajax({      
      data: {"iva":iva},
      type: 'POST',            
      url: '/SmartShop/Productos/updateProduct_CompraTMPAJAX',            
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
      url: '/SmartShop/Productos/addProduct_CompraTMPAJAX',            
      beforeSend: function(){
        $("#loaderBox_Productos").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();                
        cargarCompra_TMP(); 
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
      url: '/SmartShop/Productos/deleteProduct_CompraTMPAJAX',            
      beforeSend: function(){
        $("#loaderBox_Productos").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();        
        cargarCompra_TMP();
        
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
  }

  // 

  //Finalizar Compra
  $('#formCompra').submit(function(ev){
      ev.preventDefault();
      var proveedorID = $('#ProveedorInput').val();
      var fecha = $('#Fecha').val();

      //Enviamos los datos mediante ajax
      $.ajax({      
      data: {"proveedorID":proveedorID,"fecha":fecha},
      type: 'POST',            
      url: '/SmartShop/Compras/NuevaCompra_AJAX',            
      beforeSend: function(){
        $("#loaderBox_Compras").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();        
        $("#Resultados_Compra").html(datos);
        //Llamammos la funcion de recargar la compra
        cargarCompra_TMP();
        
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });

  });

    //Añadir Proveedores
  $('#form_AddProveedor').submit(function(ev){

    ev.preventDefault();
    var formData = new FormData(document.getElementById('form_AddProveedor'));

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
        loadProveedores(); 
        $('#loaderForm_1').append(datos);  
        document.getElementById('form_AddProveedor').reset();
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });  
  });


//Menu Context
   $(document).ready(function(){
    $('#Inicio').removeClass('active');
    $('#Compras').addClass('active');
    $('#Ventas').removeClass('active');
    $('#Productos').removeClass('active');
    $('#Contactos').removeClass('active');
    $('#Reportes').removeClass('active');
    $('#Configuracion').removeClass('active');
    $('#Accesos').removeClass('active');
  });
</script>
<?php require_once("Assets/footer.php") ?>
