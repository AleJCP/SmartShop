<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Reporte de Inventario  
    </h1>
    <ol class="breadcrumb">
      <li><a href="/SmartShop/Productos/Reportes"><i class="fa fa-dashboard"></i> Reporte de Inventario</a></li>
      <!-- <li class="active">Sub lvl</li> -->
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">    

    <div class="row">
      <div class="col-xs-12">
        <form target="_blank" action="/SmartShop/Reportes/Inventario" method="POST">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Opciones - Filtros</h3>
          </div>      
          <!-- form start -->
          
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Intervalo de Existencias</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <select name="existencia-range" id="existencia-range" class="form-control">
                    <option value="1-Inf">Más de 1 Existencias</option>
                    <option value="0-10">Entre 0 y 10 Existencias</option>
                    <option value="11-50">Entre 11 y 50 Existencias</option>
                    <option value="51-200">Entre 51 y 200 Existencias</option>
                    <option value="201-Inf">Más de 200 Existencias</option>
                </select>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Categoría</label>
                <select name="ID_Cat" id="ID_Cat" class="form-control select2 select2-hidden-accessible" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                  <option value="0">Todas las Categorías</option>
                  <?php foreach ($data['categorias'] as $Cat): ?>
                    <option value="<?php echo $Cat['id']; ?>"><?php echo $Cat['nombre']; ?></option>
                  <?php endforeach ?>
                </select>
              </div>                                              
            </div>
            <!-- /.box-body -->

            <div class="box-footer">              
              <button id="Btn-Print" type="submit" class="btn btn-default pull-right"><i class="fa fa-print"></i> Imprimir Reporte</button>
            </div>                    
        </div>    
         </form>           
      </div>
    </div>  

    <div class="row">
      <div class="col-xs-12">
        <div id="box-loader" class="box">
          <div class="box-header">
            <h3 class="box-title">Listado de Productos</h3>                                       
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
      //Cargamos el select, todos los usuarios, para el filtro
      $('.select2').select2();        
      load();

  });
  //Funciones AJAX

      //Escuchamos el cambio de los select
     $('#existencia-range').change(function(){           
      load();
      });

     $('#ID_Cat').change(function(){           
      load();
      });

    function load(){          
    var id_categoria = $('#ID_Cat option:selected').val();
    var rango_stock = $('#existencia-range').val().split('-');    
    
    $.ajax({
      data: {"id_cat":id_categoria,"rango1":rango_stock[0],"rango2":rango_stock[1]},
      type: 'POST',      
      url: '/SmartShop/productos/MostrarItemsAJAX_Reportes',
      
      
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