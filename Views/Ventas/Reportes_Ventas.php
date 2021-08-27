<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Reporte de Ventas        
    </h1>
    <ol class="breadcrumb">
      <li><a href="/SmartShop/Reportes_Ventas"><i class="fa fa-dashboard"></i> Reporte de Ventas</a></li>
      <!-- <li class="active">Sub lvl</li> -->
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">    

    <div class="row">    
      <div class="col-xs-12">
        <form target="_blank" action="/SmartShop/Reportes/Ventas" method="POST">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Opciones - Filtros</h3>
          </div>      
          <!-- form start -->
          
            <div class="box-body">              
              <div class="form-group">
                <label for="exampleInputEmail1">Intervalo de Fechas</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input name="data-range" type="text" class="form-control pull-right" id="data-range">
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Usuario</label>
                <select name="ID_Usu" id="UsuariosInput" class="form-control select2 select2-hidden-accessible" style="width: 100%;"   data-select2-id="9" tabindex="-1" aria-hidden="true">
                </select>
              </div>                                              
            </div>
            <!-- /.box-body -->

            <div class="box-footer">              
              <button id="Btn-Print" type="submit" class="btn btn-default pull-right" target="_blank"><i class="fa fa-print"></i> Imprimir Reporte</button>
            </div>                    
        </div>
        </form>            
      </div>
    </div>  

    <div class="row">
      <div class="col-xs-12">
        <div id="box-loader" class="box">
          <div class="box-header">
            <h3 class="box-title">Listado de Ventas</h3>                                       
        </div> 
        <!-- /.box-header -->
      </div>
    </div>
  </div>



</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
  $(function (){
    //Rango de Fecha del Filtro
      $('#data-range').daterangepicker({
        "locale": {
          "format": "YYYY/MM/DD",
          "applyLabel": "Guardar",
          "cancelLabel": "Cancelar",
          "fromLabel": "Desde",
          "toLabel": "Hasta",
          "daysOfWeek":[
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa",
          ],
          "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
          ]
        }
      });

      //Cargamos el select, todos los usuarios, para el filtro
      $('.select2').select2();  
      loadUsuarios();

      load(1);

  });

  //Funciones
  //Funciones AJAX
    function loadUsuarios(){
      $.ajax({      
      type: 'POST',      
      url: '/SmartShop/usuarios/getUsuariosAJAX',            
      beforeSend: function(){        
      },
      success: function(datos){                
        $('#UsuariosInput').html(datos);          
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
    }

      //Escuchamos el cambio de los select
     $('#UsuariosInput').change(function(){           
      load(1);
      });

     $('#data-range').change(function(){           
      load(1);
      });

    function load(page,itemsbypage){    
    var query = ''; 
    var itemsbypage = <?php echo $data['totalVentas']; ?>;
    var id_usuario = $('#UsuariosInput option:selected').val();
    var fecha = $('#data-range').val().split('-');    
    
    $.ajax({

      data: {"pagina":page,"artporpagina":itemsbypage,"query":query,"id_usu":id_usuario,"fecha1":fecha[0],"fecha2":fecha[1]},
      type: 'POST',      
      url: '/SmartShop/ventas/MostrarItemsAJAX_Reportes',
      
      
      beforeSend: function(){
        $("#box-loader").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();
        $('#box-loader > .box-body').remove(); 
        $('#box-loader').append(datos);  
        
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
    $('#Contactos').removeClass('active');
    $('#Reportes').addClass('active');
    $('#Configuracion').removeClass('active');
    $('#Accesos').removeClass('active');
  });
</script>
<?php require_once("Assets/footer.php") ?>