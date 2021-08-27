<?php require_once("Assets/header.php") ?>
<!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-edit"></i> Editar Producto
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="/SmartShop/Productos"><i class="fa fa-dashboard"></i> Productos</a></li>
        <li class="active">Editar Producto</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">       
    <?php if(!$data['Producto']): ?>                 
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                No existe ningún producto con ese ID. Vuelve a Intentarlo.
              </div>
    <?php endif; ?>     
     <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary"> 
          <div class="box-header with-border">
            <h3 class="box-title">Imagen del Producto</h3>
          </div>          
          <div class="box-body">
            <img id="imgThumb" class="img-fluid center-block" style="max-width: 200px; height: 200px" src="<?php echo UPLOADS.$data['Producto']['imagen'] ?>" alt="">                      
          </div>
        </div>
         <div id="loaderForm" class="box box-widget">           
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Detalles del Producto</a></li>              
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                  
             <form id="form_EditProduct" action="" class="form-horizontal" enctype="multipart/form-data" charset="utf-8"><!--FORM--> 

                <div class="box-body">                  
                  <div class="form-group">

                   <label for="CodigoInput" class="col-sm-2 control-label">Codigo*</label>
                    <div class="col-sm-4">
                      <input name="id" type="hidden" value="<?php echo $data['Producto']['id'] ?>">
                      <input value="<?php echo $data['Producto']['codigo'] ?>" name="codigo" type="text" class="form-control" id="CodigoInput" placeholder="Codigo" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                    </div>

                    <label for="NombreInput" class="col-sm-2 control-label">Nombre*</label>
                    <div class="col-sm-4">
                     <input value="<?php echo $data['Producto']['nombre'] ?>" name="nombre" type="text" class="form-control" id="NombreInput" placeholder="Nombre" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                    </div>

                </div>
                <div class="form-group">

                  <label for="DescInput" class="col-sm-2 control-label">Descripción</label>
                  <div class="col-sm-10">
                     <textarea name="descripcion" id="DescInput" style="max-width: 100%; min-width: 100%; min-height: 100px ;max-height: 200px;" class="form-control" rows="3" placeholder="Descripción" ><?php echo $data['Producto']['descripcion'] ?></textarea>
                  </div>

                </div>
                <div class="form-group">

                   <label for="CategoriaInput" class="col-sm-2 control-label">Categoría*</label>
                   <div class="col-sm-4">
                      <select name="categoria" id="CategoriaInput" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                       <option value="">Seleccione..</option>                       
                       <?php foreach ($data['categorias'] as $categoria): ?>                        
                        <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['nombre'].' - IVA %'.$categoria['iva'] ?></option>    
                       <?php endforeach ?>
                                            

                     </select>
                     <?php foreach ($data['categorias'] as $categoria): ?>                        
                       <input type="hidden" id="<?php echo $categoria['id'].'Categoria' ?>" value="<?php echo $categoria['iva'] ?>">   
                       <?php endforeach ?> 
                  </div>

                    <label for="PresentacionInput" class="col-sm-2 control-label">Presentación</label>
                    <div class="col-sm-4">
                     <input value="<?php echo $data['Producto']['presentacion'] ?>" name="presentacion" type="text" class="form-control" id="PresentacionInput" placeholder="Unidad/Combo...">
                    </div>

                </div>
                <div class="form-group">

                   <label for="CostoInput" class="col-sm-2 control-label">Costo*</label>
                   <div class="col-sm-4">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                       <input value="<?php echo $data['Producto']['costo'] ?>" name="costo" id="CostoInput" type="text" class="form-control" onkeyup="calcularUtilidad();" pattern="[0-9]+|([0-9]+[.][0-9]+)" required oninvalid="setCustomValidity('Completa este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">                
                    </div>
                  </div>


                  <label for="UtilidadInput" class="col-sm-2 control-label">Utilidad*</label>
                    <div class="col-sm-4">
                      <div class="input-group">
                        <span class="input-group-addon">%</span>
                        <input value="<?php echo $data['Producto']['utilidad'] ?>" name="utilidad" id="UtilidadInput" type="text" class="form-control" onkeyup="calcularUtilidad();" pattern="[0-9]+|([0-9]+[.][0-9]+)" required oninvalid="setCustomValidity('Completa este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">                
                      </div>
                    </div>                    
                </div>
                <div class="form-group">
                   <label for="PrecioInput" class="col-sm-2 control-label">Precio Venta (Bruto)*</label>
                   <div class="col-sm-4">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                       <input value="<?php echo $data['Producto']['precio_bruto']; ?>" name="precio_bruto_venta" id="PrecioBrutoInput" type="text" class="form-control"  pattern="[$][0-9]+|([$][0-9]+[.][0-9]+)" required oninvalid="setCustomValidity('Completa este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">                
                    </div>
                  </div>

                  <label for="PrecioInput" class="col-sm-2 control-label">Precio Venta (+ IVA)*</label>
                   <div class="col-sm-4">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                       <input value="<?php echo $data['Producto']['precio_venta']; ?>" name="precio_venta" id="PrecioInput" type="text" class="form-control"  pattern="[$][0-9]+|([$][0-9]+[.][0-9]+)" required oninvalid="setCustomValidity('Completa este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">                
                    </div>
                  </div> 

                <!--   <label for="CodigoInput" class="col-sm-2 control-label">Estado</label>
                   <div class="col-sm-4">
                      <select class="form-control">
                       <option>Activo</option>
                       <option>Desactivado</option>                 
                     </select>
                  </div> -->

                </div>
                <div class="form-group"> 

                  <label for="PrecioInput" class="col-sm-2 control-label">Precio de Venta</label>
                   <div class="col-sm-4">
                    <div class="input-group">
                       <span class="input-group-addon">BsS</span>
                       <input id="PrecioInputBsS" type="text" class="form-control">                
                    </div>
                  </div>

                  <label for="EstadoInput" class="col-sm-2 control-label">Estado*</label>
                   <div class="col-sm-4">
                      <select name="estado" id="EstadoInput" class="form-control">
                       <option value="1">Activo</option>
                       <option value="0">Desactivado</option>                 
                     </select>
                  </div>   

                </div> 
                <div class="form-group"> 
                

                  <label for="" class="col-sm-2 control-label">Stock Inicial*</label>
                   <div class="col-sm-4">
                      <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-cube"></i></span>
                       <input value="<?php echo $data['Producto']['stock']; ?>" name="stock" id="StockInput" type="text" class="form-control" pattern="[0-9]+" required oninvalid="setCustomValidity('Completa este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">
                     </div>
                  </div>

                  <label for="MiniaturaInput" class="col-sm-2 control-label">Imagen</label>
                   <div class="col-sm-4">
                      <input name="image" id="imageInput" accept="image/*" type="file" class="form-control" >
                  </div>

                </div>               
              </div>
              <!-- /.box-body -->
              <p class="help-block">Los campos (*) son obligatorios</p>        

                    
                <div id="showInfo" class="">
                   
                </div>

              <div class="box-footer">      
              <?php if($data['Producto']): ?>              
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Guardar Cambios</button>
              <?php endif; ?>
              </div>
              <!-- /.box-footer -->


            </form>


              </div>
              <!-- /.tab-pane -->             
            </div>
            <!-- /.tab-content -->
          </div>

       </div>
       </div>
       </div>
          
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
  //JS
  $(document).ready(function(){
    //Categoria    
    $('#CategoriaInput').val('<?php echo $data['Producto']['id_fk_categoria'] ?>');
    //Estado
    $('#EstadoInput').val('<?php echo $data['Producto']['estado'] ?>');
    //Calculamos la Utilidad
    calcularUtilidad();
  });
  
  //Eventos para formatear los input
  //Imagen
  $('#imageInput').on('change',function(){    
    if($('#imageInput').val()){
      const url = URL.createObjectURL(this.files[0]);
console.log(url);
      $('#imgThumb').attr('src', url);
    }
  });
  //Referencias al DOM
   $(document).ready(function(){
      $(":input").inputmask();
   });
  //AJAX
  $('#form_EditProduct').submit(function(ev){

    ev.preventDefault();
    var formData = new FormData(document.getElementById('form_EditProduct'));

    $.ajax({    
      data: formData,      
      type: 'POST',      
      url: '/SmartShop/Productos/editarProductosAJAX',
      contentType: false,
      processData: false,
            
      beforeSend: function(){
        $("#loaderForm").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();        
        $('#showInfo').html(datos);  
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });  
  });
  

  //Funcion para Calcular la Utilidad, con Respecto al Costo y el Precio de Venta en BsS    
    function calcularUtilidad(){      

      var costoInput = document.getElementById('CostoInput');         
      var id_Cat = $('#CategoriaInput option:selected').val();
      var IVA = $('#'+id_Cat+'Categoria').val();      
      var utilidadInput = document.getElementById('UtilidadInput');      
      var precioVentaD_BrutoInput = document.getElementById('PrecioBrutoInput');
      var precioVentaDInput = document.getElementById('PrecioInput');
      var precioVentaBsSInput = document.getElementById('PrecioInputBsS');
      var focusedElement = document.activeElement;        

      if(!(costoInput.value) && focusedElement.id != 'CostoInput') {
        costoInput.value = 0;                        
      }
      if(!(utilidadInput.value) && focusedElement.id != 'UtilidadInput'){
        utilidadInput.value = 0;
      }                     
            
    //Algoritmo
        
      utilidad = utilidadInput.value / 100;        
      IVA = IVA / 100;
      if(!IVA){
        IVA = 0;
      }
      precioVenta = (parseFloat(costoInput.value,10) * utilidad) +  parseFloat(costoInput.value,10);
      precioVentaD = precioVenta + (parseFloat(precioVenta,10) * IVA);       

//Mostrar en Pantalla
      precioVentaD_BrutoInput.value = new Intl.NumberFormat('en-EN', {style: 'currency', currency: 'USD'}).format(precioVenta);
      precioVentaDInput.value = new Intl.NumberFormat('en-EN', {style: 'currency', currency: 'USD'}).format(precioVentaD);
      var precioDolar = parseInt(<?php echo $_SESSION['precio_dolar'] ?>);
      precioVentaBsS = precioVentaD * precioDolar;  
      precioVentaBsSInput.value = new Intl.NumberFormat('de-DE', {style: 'currency', currency: 'BsS'}).format(precioVentaBsS); 

      //Mostrar valores de Precio de Venta en BsS y  Dolaresen en el HTML. 

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