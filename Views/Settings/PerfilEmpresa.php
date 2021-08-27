<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-briefcase"></i> Perfil de la Empresa

    </h1>
    <ol class="breadcrumb">
      <li><a href="/SmartShop/Ventas"><i class="fa fa-dashboard"></i> Configuración</a></li>
      <li class="active">Perfil de la Empresa</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        --------------------------> 
        <div class="row">
        <div class="col-md-4">
        <div class="box box-primary">  
          <div class="box-body">

            <img id="image_empresa" src="<?php echo UPLOADS . $data['logo'] ?>"style="max-width: 200px;" class="img-thumbnail center-block" alt="<?php echo $data['logo'] ?>">
            <div class="text-center"><h2 id="NombreEmpresa"></h2></div>            
            <div class="text-center"><p class="help-block" id="RifEmpresa"></p></div>

          </div>  
        </div>
        </div>      

        <div class="col-md-8">
        <div id="box" class="box box-primary"> 
          <div class="box-header with-border">
            <h3 class="box-title">Perfil de la Empresa</h3>
          </div> 
          <form id="form_EditInfo" action="" class="form-horizontal">
            <div  class="box-body">
              <div id="AJAX_Respuesta">
                
              </div>
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Datos de la Empresa</a></li>              
                  <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Dirección de la Empresa</a></li>
                </ul>            
                <div  class="tab-content">            
                  <div class="tab-pane active" id="tab_1">

                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="InputNombre_Empresa">Nombre de la Empresa</label>
                      <div class="col-sm-10">
                        <input value="<?php echo $data['nombre_empresa'] ?>" name="nombre" type="text" class="form-control" id="InputNombre_Empresa" placeholder="SmartShop" required oninvalid="setCustomValidity('Rellena este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="InputRif">RIF</label>
                      <div class="col-sm-10">
                        <input value="<?php echo $data['rif'] ?>" name="rif" type="text" class="form-control" id="InputRif"  pattern="[V|J|P|E][-][0-9]{8,9}" class="form-control" required oninvalid="setCustomValidity('Rellena este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="InputCorreoElectronico">Correo Electrónico</label>
                      <div class="col-sm-10">
                        <input value="<?php echo $data['email'] ?>" name="correo" type="text" class="form-control" id="InputCorreoElectronico" placeholder="example@example.com" required oninvalid="setCustomValidity('Rellena este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">
                    </div>
                  </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="InputTelefono">Teléfono</label>
                      <div class="col-sm-10">
                        <input value="<?php echo $data['telefono'] ?>" name="telefono" type="text" class="form-control" id="InputTelefono" placeholder="(414)-9999999" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="InputLogo">Logo</label>
                      <div class="col-sm-10">
                        <input name="image" type="file" class="form-control" id="InputLogo">
                      </div>
                    </div>

                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">

                     <div class="form-group">
                      <label class="col-sm-2 control-label" for="InputCalle">Calle</label>
                      <div class="col-sm-10">
                        <input value="<?php echo $data['calle'] ?>" name="calle" type="text" class="form-control" id="InputCalle" placeholder="Calle" required oninvalid="setCustomValidity('Rellena este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="InputCiudad">Ciudad</label>
                      <div class="col-sm-10">
                        <input value="<?php echo $data['ciudad'] ?>" name="ciudad" type="text" class="form-control" id="InputCiudad" placeholder="Ciudad" required oninvalid="setCustomValidity('Rellena este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="InputEstado">Estado</label>
                      <div class="col-sm-10">
                        <input value="<?php echo $data['estado'] ?>" name="estado" type="text" class="form-control" id="InputEstado" placeholder="Estado" required oninvalid="setCustomValidity('Rellena este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="InputCod_postal">Codigo Postal</label>
                      <div class="col-sm-10">
                        <input value="<?php echo $data['cod_postal'] ?>" name="cod_postal" type="text" class="form-control" id="InputCod_postal" placeholder="Codigo Postal" required oninvalid="setCustomValidity('Rellena este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="InputPais">País</label>
                      <div class="col-sm-10">
                        <input value ="<?php echo $data['pais'] ?>" name="pais" type="text" class="form-control" id="InputPais" placeholder="País" required oninvalid="setCustomValidity('Rellena este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">
                      </div>
                    </div>
                        
                  </div>                          
                  <!-- /.tab-pane -->
                </div>            
                <!-- /.tab-content -->
              </div>                    
            </div>                    
        <div class="box-footer">
          <button class="btn btn-primary pull-right"><i class="fa fa-briefcase"></i> Guardar cambios</button>
        </div>
        </form> 
      </div>
      </div>
      </div> 


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $('#InputLogo').on('change',function(){
    if($('#InputLogo').val()){
      const url = URL.createObjectURL(this.files[0]);
console.log(url);
      $('#image_empresa').attr('src', url);
    }
  });
    $(document).ready(function(){
      //Detectamos el valor de los input del nombre de la empresa y rif para pintarlos debajo de la imagen
      $('#NombreEmpresa').html($('#InputNombre_Empresa').val());
      $('#RifEmpresa').html($('#InputRif').val());
      //InputMask
      $("#InputRif").inputmask({mask: "A-99999999[9]", greedy: false});      
      $("#InputTelefono").inputmask({mask: "(999)-9999999"});      
    });
//Funciones para pintar en la vista previa
  $('#InputNombre_Empresa').on('keyup',function(){
    var ne = $('#InputNombre_Empresa').val();    
    $('#NombreEmpresa').html(ne)
  });
  $('#InputRif').on('keyup',function(){
    var ri = $('#InputRif').val();    
    $('#RifEmpresa').html(ri)
  });

//Funcion AJAX para mandar el formulario
  $('#form_EditInfo').submit(function(ev){
    ev.preventDefault();
    var formData = new FormData(document.getElementById('form_EditInfo'));
    $.ajax({    
      data: formData,      
      type: 'POST',      
      url: '/SmartShop/settings/editPerfilEmpresaAJAX',
      contentType: false,
      processData: false,
            
      beforeSend: function(){
        $("#box").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        //Removemos el Load
        $("#loader1").remove();                     
        $('#AJAX_Respuesta').html(datos); 
        console.log(datos);
      },
      error: function(xhr, textStatus, error){
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
    $('#Configuracion').addClass('active');
    $('#Accesos').removeClass('active');
  });
  </script>
  <?php require_once("Assets/footer.php") ?>