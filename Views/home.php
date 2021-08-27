<?php require_once("Assets/header.php") ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inicio - Bienvenid@ <?php echo $_SESSION['nombre'] .' - '. $_SESSION['user_group']['nombre']; ?>
        <small>Sistema de Control de Inventario, Control de Compras, Ventas y Facturación V 1.1</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/SmartShop/Home"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <!-- <li class="active">Here</li> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
<?php if($_SESSION['user_group']['permisos']['visualizar']['inicio'] == 'true'): ?>
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
			<!-- Tarjetas Interactivas -->      

        <div class="row">
        <div class="col-lg-3 col-xs-12">
        
         <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-cubes"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Inventario</span>
              <span class="info-box-number"><?php echo number_format($data['inventario']['totalProductos'],0,',','.') ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    En STOCK : <?php echo number_format($data['inventario']['totalStock'],0,',','.') ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div> 

        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-12">
        
         <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-dollar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Ventas Totales</span>
              <span class="info-box-number"><?php echo number_format($data['ventas']['totalVentas'],0,',','.') ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    Ventas del mes: <?php echo number_format($data['ventas']['totalVentas_mes'],0,',','.') ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>

        </div>

        <div class="col-lg-3 col-xs-12">
        
         <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-truck"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Compras Totales</span>
              <span class="info-box-number"><?php echo number_format($data['compras']['totalCompras'],0,',','.') ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    Compras del mes: <?php echo number_format($data['compras']['totalCompras_mes'],0,',','.') ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>

        </div>

        <div class="col-lg-3 col-xs-12">
        
         <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Clientes</span>
              <span class="info-box-number"><?php echo number_format($data['clientes']['totalClientes'],0,',','.') ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    Nuevos del día: <?php echo number_format($data['clientes']['totalClientes_dia'],0,',','.') ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>

        </div>


      </div>
      <!-- .Tarjetas Interactivas --> 

     

<!-- Grafico -->
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ventas del Mes de <?php echo strftime('%B');?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height: 234px; width: 512px;" height="234" width="512"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>          
<!-- .Grafico -->            

<div class="row">                      
      <div class="col-xs-12">         
        <div id="box-loader1" class="box">
          <div class="box-header">
              <h3 class="box-title">Ventas del dia Hoy <?php echo utf8_encode(strftime('%A, %d de %B'));?></h3>                                       
               <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>             
          </div>
          <!-- /.box-header -->

        </div>
      </div> 
    </div>
<?php else: ?>
  <img src="<?php echo UPLOADS.'SSlogo.png' ?>" class="center-block thumbnail" style="max-width: 100%;"alt="">
<?php endif; ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
  $(document).ready(function(){
    load_ultVentas(1);
    });
    
    function load_ultVentas(page,itemsbypage){    
    var query = $('#query').val(); 
    var itemsbypage = $('#showElementsby option:selected').val();
    $.ajax({
      data: {"pagina":page,"artporpagina":itemsbypage,"query":query},
      type: 'POST',      
      url: '/SmartShop/Home/MostrarUltVentasAJAX',          
      beforeSend: function(){
        $("#box-loader1").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      },
      success: function(datos){        
        $("#loader1").remove();
        $('#box-loader1 > .box-body').remove(); 
        $('#box-loader1').append(datos);  
        // $('#Paginacion').html(datos['pagination']);  
      },
      error: function(xhr, textStatus, error){
        $("#loader1").remove();
        alert('Ha fallado la consulta ' + textStatus);
      }
    });
  }
</script>
<script>

  $(function () {
    /* ChartJS     
    */        
    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart  = new Chart(areaChartCanvas)

    var areaChartData = {
      labels  : [

        <?php 
        $DateTime = getdate();        
        if($DateTime['mon'] == 4 || $DateTime['mon'] == 6 || $DateTime['mon'] == 9 || $DateTime['mon'] == 11){
          $MonthCounter = 30;
        }elseif($DateTime['mon'] == 2 && $DateTime['year'] % 4 == 0){
          $MonthCounter = 29;
        }elseif($DateTime['mon'] == 2 && $DateTime['year'] % 4 != 0){
          $MonthCounter = 28;
        }else{
          $MonthCounter = 31;
        }

        for ($i=1; $i <= $MonthCounter; $i++) {           
          if($i==31){
            echo $i;
          }else{
            echo $i.',';
          }


      } ?>
      ],
      datasets: [        
        {
          label               : 'Ventas',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
            <?php 
              foreach ($data['graphics']['venta'] as $key => $TotalVenta) {                
                if($key == count($data['graphics']['venta'])){
                  echo $TotalVenta;
                }else{
                  echo $TotalVenta.',';
                }
              }
             ?>
          ]
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,      
      //Boolean - Whether to fill the dataset with a color      
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

});    
  //Menu Context
  $(document).ready(function(){
    $('#Inicio').addClass('active');
    $('#Compras').removeClass('active');
    $('#Ventas').removeClass('active');
    $('#Productos').removeClass('active');
    $('#Contactos').removeClass('active');
    $('#Reportes').removeClass('active');
    $('#Configuracion').removeClass('active');
    $('#Accesos').removeClass('active');
  });
</script>
<?php require_once("Assets/footer.php") ?>