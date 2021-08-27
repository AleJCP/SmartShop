<?php 
//Vistas de la clase VENTAS
class ventas extends Controllers {

	public function __construct(){
		
		parent::__construct();
	}


	public function ventas(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmarShop/Usuarios/login');
		}else{
			header('Location: /SmartShop/Ventas/AdministrarVentas');
			exit();			
		}
	}


public function AdministrarVentas(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			if($_SESSION['user_group']['permisos']['visualizar']['facturacion'] == 'true'){

				//Logica HERE	


				//Traer Compras desde la Base de Datos
				$data['totalVentas'] = $this->model->getTotalVentas();				
				$this->views->getView($this,"AdministrarVentas", $data);
				exit();
			}else{
				header('Location: /SmartShop/Errors/PermisosInsuficientes');
				exit();
			}
			
		}	

	}

public function NuevaVenta(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmarShop/Usuarios/login');
		}else{
			if($_SESSION['user_group']['permisos']['agregar']['facturacion'] == 'true'){
				$this->views->getView($this,"NuevaVenta");			
				exit();
			}else{
				header('Location: /SmartShop/Errors/PermisosInsuficientes');
				exit();
			}
		}

	}

	public function Reportes(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmarShop/Usuarios/login');
		}else{
			if($_SESSION['user_group']['permisos']['visualizar']['reportes'] == 'true'){
				$data['totalVentas'] = $this->model->getTotalVentas();
				$this->views->getView($this,"Reportes_Ventas",$data);			
				exit();			
			}else{
				header('Location: /SmartShop/Errors/PermisosInsuficientes');
				exit();
			}
		}
	}

//Funciones AJAX
		public function NuevaVenta_AJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			//Validaciones			
			//DATOS PRINCIPALES
			
			$VentaTmp = isset($_SESSION['VentaTmp']) ? $_SESSION['VentaTmp'] : false;			
			$Total_VentaTmp = isset($_SESSION['Total_VentaTmp']) ? $_SESSION['Total_VentaTmp'] : false;
			$data['fecha'] = isset($_POST['Fecha']) ? limpiarDatos($_POST['Fecha']) : false;
			if($data['fecha']){
					$f = explode('/', $data['fecha']);
					$data['fecha'] = $f[2] . '-' . $f[1] . '-' . $f[0];
				}
			$data['hora'] = date('G:i:s') ? date('G:i:s') : false;
			$data['clienteID'] = isset($_POST['ClienteID']) ? limpiarDatos($_POST['ClienteID']) : false;
			

			//DATOS DINAMICOS
			$data['total_monto_abonado'] = 0;
			foreach ($_POST['Metodo_Pago'] as $key => $mp) {
				//Comprobamos que el campo del monto no este en blanco, en ese caso, no lo pasamos al array
				if($_POST['Monto_Pagar'][$key] <= 0){
						continue;
					}else{
				$data['metodo_pago'][$key] = isset($mp) ? limpiarDatos($mp) : 0;
				}	
			}

			foreach ($_POST['Monto_Pagar'] as $key => $MP) {
				//Comprobamos que el campo del monto no este en blanco, en ese caso, no lo pasamos al array
				if($_POST['Monto_Pagar'][$key] <= 0){
						continue;
					}else{
				$data['monto_pagar'][$key] = isset($MP) ? limpiarDatos(str_replace(',','',$MP)) : 0;
				}				
			}		
			foreach ($_POST['Nro_Referencia'] as $key => $NR) {
				//Comprobamos que el campo del monto no este en blanco, en ese caso, no lo pasamos al array
				if($_POST['Monto_Pagar'][$key] <= 0){
						continue;
					}else{
				$data['nro_referencia'][$key] = isset($NR) ? limpiarDatos($NR) : 0;
				}	
			}		
						
			//Calculamos el TOTAL a PAGAR por el cliente en Dolares
			$data['total_monto_abonado'] = 0.00;
			if(isset($data['monto_pagar'])){
				foreach ($data['monto_pagar'] as $key => $MP) {				 
					if($data['metodo_pago'][$key] == 'Efectivo_BsS' || $data['metodo_pago'][$key] == 'Punto venta_BsS' || $data['metodo_pago'][$key] == 'Pago movil' || $data['metodo_pago'][$key] == 'Transferencia'){
						$monto_bss = str_replace(',', '', $data['monto_pagar'][$key]);		
						$data['total_monto_abonado'] += (double) $monto_bss / $_SESSION['precio_dolar'];
					}else{
						$data['total_monto_abonado'] += (double) str_replace(',', '',$data['monto_pagar'][$key]);	
					}						
				}
			}										
			if(!(empty($VentaTmp) || empty($Total_VentaTmp) || empty($data['fecha']) || empty($data['hora']) || empty($data['clienteID']))){
				//Luego de validar calculamos los campos de cambio y estado
				
				$data['cambio'] = (($data['total_monto_abonado'] - $Total_VentaTmp['total']) < 0) ? 0 : $data['total_monto_abonado'] - $Total_VentaTmp['total'];				
				$data['estado'] = ($data['total_monto_abonado'] >= $Total_VentaTmp['total']) ? 'Pagado' : 'Por Pagar';	
				//Y Comprobamos si el estadado es pagado, no debe haber ningun campo vacio en metodos de pago				
				if($data['total_monto_abonado'] > 0.01){
					foreach ($data['metodo_pago'] as $key => $value) {
							if($data['metodo_pago'][$key] != '' && $data['monto_pagar'][$key] != 0){
								continue;								
							}else{
								?>
									<div class="alert alert-danger alert-dismissible">
                						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                						<h4><i class="icon fa fa-ban"></i> ¡Error!</h4>
                						No has ingresado el metodo de pago para el monto introducido.
              						</div>
								<?php 
								die();
							}
					}					
				}
											
				$answer = $this->model->addVenta($data,$VentaTmp,$Total_VentaTmp);
				switch ($answer) {
					case 1:
							?>
							<div class="alert alert-success alert-dismissible">
                				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                				<h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                				Venta Añadida Correctamente.
            				</div>
            				<script type="text/javascript">
            					//Reiniciamos el DOM al cerrar el modal
            					$(document).blur();  
            					$(document).on('keydown',function(ev){
            						ev.preventDefault();
            						window.location.reload();
            					});          					
            					$(document).on('click',function(ev){
            						ev.preventDefault();
            						window.location.reload();
            					});
            				</script>
		 					<?php
						break;			
											
					default:
							?>
							<div class="alert alert-danger alert-dismissible">
                				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                				<h4><i class="icon fa fa-ban"></i> Error!</h4>
                				Ha ocurrido un error. Vuelvelo a Intentar.
              				</div>
		 					<?php
						break;
				}			
			}else{
				?>
				<div class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	<h4><i class="icon fa fa-ban"></i> Error!</h4>
                	Rellena los campos requeridos. Vuelvelo a Intentar.
              	</div>
		 		<?php
			}
		}		
	}

	public function MostrarItemsAJAX() { 				
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
                  <th>Acciones</th>
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
                  <td>

                  	<a href="/SmartShop/Reportes/Venta/<?php echo $venta['id'] ?>" target="_blank" class="btn btn-default btn-flat"><i class="fa fa-print"></i></a>
                  <?php if($_SESSION['user_group']['permisos']['editar']['facturacion'] == 'true'): ?>
                  	 <button class="btn btn-primary btn-flat"><i class="fa fa-edit"></i></button>
                  <?php endif; ?>
                  <?php if($_SESSION['user_group']['permisos']['eliminar']['facturacion'] == 'true'): ?>
                  	<button class="btn btn-danger btn-flat"><i class="fa fa-close"></i></button>
                  <?php endif; ?>
                  </td>
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



	public function MostrarItemsAJAX_Reportes($id_="",$desde_="",$hasta_="") { 				
	if(!$_POST){
		return '';
	}	
	$id_usuario = isset($_POST['id_usu']) ? limpiarDatos($_POST['id_usu']) : $id_;
	$desde = isset($_POST['fecha1']) ? limpiarDatos($_POST['fecha1']) : $desde_;
	$hasta = isset($_POST['fecha2']) ? limpiarDatos($_POST['fecha2']) : $hasta_;	
		//Logica de TABLA Y PAGINACION DE DATOS MEDIANTE AJAX		
	$totalVentas = 0;		
	$data = $this->model->getAllVentasforReports($desde,$hasta,$id_usuario);			
	if($data){							
?>
		<div class="box-body">
			<div class="table-responsive">
              <table class="table table-hover table-responsive text-center">
                
                <tbody>                
                <tr>
                  <th>ID</th>
                  <th>Cliente</th>
                  <th>Fecha</th>
                  <th>Usuario</th>
                  <th>SubTotal</th>                  
                  <th>TOTAL</th>                                      
                  
                </tr>
    
    <?php foreach ($data as $venta): ?>                  	                            
                <tr>
                  <td><?php echo $venta['id'] ?></td>
                  <td><?php echo $venta['nombre'] . ' ' .$venta['apellido']?></td>
                  <td><?php echo $venta['fecha']; ?></td>
                  <td><?php echo $venta['usuario'] ?></td>                                  
                  <td>$<?php echo $venta['subtotal'] ?></td>                  
                  <td>$<?php echo $venta['total'] ?></td>                  
                </tr>
                <?php $totalVentas += $venta['total'];?>
	<?php endforeach; ?> 
				<tr>
                  <td colspan="4"></td>
                  <td style="font-family: 'Arial Black';">TOTAL</td>
                  <td style="font-family: 'Arial Black';">$ <?php echo $totalVentas; ?></td>
                </tr>
                </tbody>

              </table>
              </div>
            </div>
            <!-- /.box-body -->
<script type="text/javascript">
	$('#Btn-Print').removeAttr('disabled');
</script>            
          
<?php } else{
	?>
<div class="box-body table-responsive">
<div class="callout callout-info">
                <h4>¡No hay resultados!</h4>

                <p>Comprueba que tienes ventas realizadas y prueba a utilizar los filtros para encontrar Ventas</p>
              </div>
</div>
<script type="text/javascript">
	$('#Btn-Print').attr('disabled','disabled');
</script>
	 <?php 
}

}

}?>