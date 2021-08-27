<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-gear"></i> Ajustes Generales
        <small>Optional description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/SmartShop/Ventas"><i class="fa fa-dashboard"></i> Configuración</a></li>
        <!-- <li class="active">sublvl</li> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
			<div class="row">
        <div class="col-xs-12">          
       
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Base de Datos</h3>
            </div>
            <div class="box-body">
              <div class="container">
                <h5>Opciones de Respaldo</h5>
                <div class="row">
                  <a class="btn btn-default" target="_blank" href="http://localhost/phpmyadmin/db_export.php?db=sshop">Backup/Respaldar Base de Datos...</a>
                </div>
              </div>                              
              <div class="container">
                <h5>Opciones de Recuperación</h5>
                <div class="row">
                  <a class="btn btn-default" target="_blank" href="http://localhost/phpmyadmin/db_import.php?db=sshop">Restore/Restaurar Base de Datos...</a>
                </div>
              </div>  
            </div>
          </div>

          <div id="loader_box" class="box box-primary">                                          
            <div class="box-header with-border"><h3 class="box-title">Tasa del Dolar - BsS</h3></div>
            <div class="box-body">                      
                <div class="form-group">
                  <i class="fa fa-calendar text-aqua"></i>Marcaje: 
                  <div class="dolar_API" id="marcaje_API">Abril 26, 2021 10:42 AM</div>           
                </div>
                <div class="form-group">
                  <i class="fa fa-dollar text-aqua"></i>Tasa Seleccionada: 
                  <div class="dolar_API" id="TasaEstablecida_BD"></div>           
                </div>                                                                       
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">                            
                      <input id="check_oficial" type="radio" name="seleccion_dolar" value="oficial">
                      <i class="fa fa-dollar text-aqua"></i>BCV - Oficial:
                    </span>            
                    <input id="oficial_API" disabled="" type="text" class="form-control dolar_API">
                  </div>
                </div>           
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">                          
                      <input id="check_paralelo" type="radio" name="seleccion_dolar" value="paralelo">
                      <i class="fa fa-dollar text-aqua"></i>DolarToday: 
                    </span>            
                    <input id="paralelo_API" disabled="" type="text" class="form-control dolar_API">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <input id="check_otra" type="radio" name="seleccion_dolar" value="otra">
                      <i class="fa fa-dollar text-aqua"></i>Otra Tasa: 
                    </span> 
                    <input id="otra_API" type="text" class="form-control"  placeholder="Coloca aqui tu Tasa personalizada..."> 
                  </div>
                </div> 
                <p class="text-light-blue">(*) Solo los ADMINISTRADORES pueden cambiar el precio del dolar</p>
                <div id="R_AJAX"></div>                             
            </div>          
            <div class="box-footer">
              <div class="row">
                <div class="col-xs-6">
                <button class="btn btn-default center-block" type="button" onclick="get_DolarfromAPI()"><i class="fa fa-refresh"></i> Actualizar</button>
                </div>
                <div class="col-xs-6">
                <button id="EstablecerTasa_Btn" class="btn btn-success center-block" type="button" onclick="set_DolarToDB()" disabled><i class="fa fa-save"></i> Establecer Tasa</button>
                </div>
               </div>
            </div>            
          </div>                
        </div>
      </div>                                                        

  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    $(document).ready(function(){
      get_DolarfromAPI();
    });

    //This useful to config admin.
function get_DolarfromAPI(){
$.ajax({      
      dataType: "json",              
      url: 'https://s3.amazonaws.com/dolartoday/data.json',            
      beforeSend: function(){
        $("#oficial_API").val('Cargando...');
        $("#paralelo_API").val('Cargando...');
        $("#marcaje_API").html('Cargando...');
      },
      success: function(datos){                       
        //Activamos el Boton
        $("#EstablecerTasa_Btn").removeAttr("disabled");
        var marcaje = datos._timestamp.fecha;
        var oficial = datos.USD.sicad2;
        var paralelo = datos.USD.transferencia;
        $('#marcaje_API').html(marcaje);
        $('#oficial_API').val(oficial);
        $('#paralelo_API').val(paralelo);  


        // console.log('Success');
        // console.log(seleccion+','+dolar);
        // update_Dolar(seleccion,dolar);
        // console.log(seleccion+' '+dolar);
        // console.log('Tasa del dolar Enviada');
       },
      error: function(xhr, textStatus, error){        
        $("#marcaje_API").html('Vuelvelo a Intentar...');
        $("#oficial_API").val('Vuelvelo a Intentar...');
        $("#paralelo_API").val('Vuelvelo a Intentar...');

        //Desactivamos el boton de establecer tasa
        $("#EstablecerTasa_Btn").attr("disabled", "disabled");
        // var seleccion = $('input:radio[name=seleccion_dolar]:checked').val();        
        // if(seleccion == 'otra'){         
        //  dolar = $('#'+seleccion).val();
        //  update_Dolar(seleccion,dolar);
        // }        
        // console.log('ERROR');
        // console.log(seleccion+','+dolar);
      }
    });
}
function set_DolarToDB(){
        //Agarramos la opcion seleccionada
        var marcaje = $('#marcaje_API').html();
        var seleccion = $('input:radio[name=seleccion_dolar]:checked').val();
        var dolar = $('#'+seleccion+'_API').val();
        
        if(dolar == ''){
          seleccion = 'oficial';
          dolar = $('#'+seleccion+'_API').val();
        }
$.ajax({      
      data: {"seleccion":seleccion,"dolar":dolar,"marcaje":marcaje},
      type: 'POST',            
      url: '/SmartShop/Dolar/setDolarTo_DB',                                   
      beforeSend: function(){
        console.log('Actualizando Tasa del Dolar en la Base de Datos.....');
        $("#loader_box").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){ 

        $("#loader1").remove();
        console.log('Tasa del dolar establecida en la Base de Datos');
        $("#R_AJAX").html(datos);
        get_DolarfromDB();  

      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        
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
    $('#Configuracion').addClass('active');
    $('#Accesos').removeClass('active');
  });
  </script>
<?php require_once("Assets/footer.php") ?>