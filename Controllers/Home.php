<?php 
//Vistas de la clase HOME
class Home extends Controllers {

	public function __construct(){
		
		parent::__construct();
	}


	public function home(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			//Ventas
			$data['ventas'] =	$this->model->getTotalVentas_Card();
			$data['inventario'] =	$this->model->getTotalInventario_Card();
			$data['compras'] =	$this->model->getTotalCompras_Card();								
			$data['clientes'] =	$this->model->getTotalClientes_Card();						
			$MetricsSell = $this->model->getMetrics_Ventas();
			$MetricsPurchases = $this->model->getMetrics_Compras();
			$data['graphics'] =  array_merge($MetricsSell,$MetricsPurchases);									
	
			$this->views->getView($this,"home",$data);
		}
	}
//UltVentas
public function MostrarUltVentasAJAX() { 				
	if(!$_POST){
		return '';
	}	
		//Logica de TABLA Y PAGINACION DE DATOS MEDIANTE AJAX
	$paginaActual = isset($_POST['pagina']) ? limpiarDatos($_POST['pagina']) : 1;
	$artporpagina = isset($_POST['artporpagina']) ? limpiarDatos($_POST['artporpagina']) : 5;
	$query = isset($_POST['query']) ? limpiarDatos($_POST['query']) : '';
	$inicio = ($paginaActual > 1) ? ($paginaActual * $artporpagina - $artporpagina) : 0;
	
	$data = $this->model->getAllVentasforPagination($inicio,$artporpagina,$query);		
	$totalItemsBDD = $this->model->getTotalVentas($query);	
	$totalItemsQuery = isset($data) ? count($data) : '';
	//Paginacion				
		
	$backpagina = $paginaActual - 1;
	$nextpagina = $paginaActual + 1;
	if($data){	
		
		$totalPaginas = ceil($totalItemsBDD / $artporpagina);
		// if($query != ''){
		// 	$totalPaginas = ceil($totalItemsQuery / $artporpagina);
		// }else{
			
		// }	


?>
		<div class="box-body">
			<div class="table-responsive">
              <table class="table table-hover table-responsive text-center">
                
                <tbody>                
                <tr>
                  <th>ID</th>
                  <th>Cliente</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Usuario</th>
                  <th>SubTotal</th>                  
                  <th>TOTAL</th>                                                        
                </tr>
    
    <?php foreach ($data as $venta): ?>                  	                            
                <tr>
                  <td><?php echo $venta['id'] ?></td>
                  <td><?php echo $venta['nombre'] . ' ' .$venta['apellido']?></td>
                  <td><?php echo $venta['fecha']; ?></td>
                  <td><?php echo $venta['hora']; ?></td>
                  <td><?php echo $venta['usuario'] ?></td>                                  
                  <td>$ <?php echo number_format($venta['subtotal'],2,'.',',') ?></td>                  
                  <td>$ <?php echo number_format($venta['total'],2,'.',',') ?></td>                  
                </tr>
	<?php endforeach; ?>  
                </tbody>

              </table>
              </div>


            <div class="box-footer clearfix">
                <!-- DATA FROM AJAX -->
                <?php if ($artporpagina > $totalItemsBDD): ?>
					<div class="info">Mostrando Registros del <?php echo $inicio+1; ?> al <?php echo $totalItemsBDD ?> de <?php echo $totalItemsBDD ?> Totales</div>
				<?php elseif ($artporpagina > $totalItemsQuery): ?>
					<div class="info">Mostrando Registros del <?php echo $inicio+1; ?> al <?php echo $totalItemsBDD ?> de <?php echo $totalItemsBDD ?> Totales</div>
				
					<?php else: ?>
					<div class="info">Mostrando Registros del <?php echo $inicio+1 ?> al <?php echo $inicio+$artporpagina ?> de <?php echo $totalItemsBDD ?> Totales</div>	
				<?php endif ?>
				
              <ul class="pagination pagination-md no-margin pull-right">        
              	<?php if ($paginaActual == 1): ?>
              		<li id="backPagination" class="disabled"><a href="javascript::void(0)" onclick="">«</a></li>	
              		<?php else: ?>
              		<li id="backPagination"><a href="javascript::void(0)" onclick="load(<?php echo $backpagina . ',' . $artporpagina; ?>)">«</a></li>	
              	<?php endif ?>
                

                <?php for ($i=1; $i <= $totalPaginas; $i++): ?>                
                     <?php if ($paginaActual == $i): ?>
                  		<li id="pagination<?php echo $i; ?>" class="active"><a href="javascript::void(0)" 
                  	onclick="load(<?php echo $i . ',' . $artporpagina; ?>)"><?php echo $i; ?></a></li>   	
                  	<?php else: ?>
                  		<li id="pagination<?php echo $i; ?>" class=""><a href="javascript::void(0)" 
                  	onclick="load(<?php echo $i . ',' . $artporpagina; ?>)"><?php echo $i; ?></a></li>		
                     <?php endif ?>                                   
                <?php endfor; ?>

                <?php if ($paginaActual == $totalPaginas): ?>
              		<li id="nextPagination" class="disabled"><a href="javascript::void(0)" onclick="">»</a></li>
              </ul> 
              		<?php else: ?>
              		<li id="nextPagination"><a href="javascript::void(0)" onclick="load(<?php echo $nextpagina . ',' . $artporpagina; ?>)">»</a></li>	
              	<?php endif ?>    
            </div>
            </div>
            <!-- /.box-body -->
            
          
<?php } elseif($query != ''){
	?>
<div class="box-body table-responsive">
<div class="callout callout-info">
                <h4>¡No hay resultados!</h4>

                <p>Vuelvelo a Intentar más tarde</p>
              </div>
</div>
	 <?php 
}else{
		?>
<div class="box-body table-responsive">
<div class="callout callout-info">
                <h4>¡No hay registros!</h4>

                <p>No hay datos para mostrar.</p>
              </div>
</div>


	 <?php 
}

}






 }?>