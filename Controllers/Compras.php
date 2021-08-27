<?php 
//Vistas de la clase COMPRAS
class Compras extends Controllers {

	public function __construct(){
		
		parent::__construct();
	}

//Metodo principal
	public function compras(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			if($_SESSION['user_group']['permisos']['visualizar']['compras'] == 'true'){
				header('Location: /SmartShop/Compras/AdministrarCompras');
				exit();
			}else{
				header('Location: /SmartShop/Errors/PermisosInsuficientes');
				exit();
			}
		}				
	}

//VISTAS
public function AdministrarCompras(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			if($_SESSION['user_group']['permisos']['visualizar']['compras'] == 'true'){

				//Logica HERE	


				//Traer Compras desde la Base de Datos
				$data['totalCompras'] = $this->model->getTotalCompras();
				$this->views->getView($this,"AdministrarCompras", $data);
				exit();
			}else{
				header('Location: /SmartShop/Errors/PermisosInsuficientes');
				exit();
			}
			
		}		

	}

	public function NuevaCompra(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			if($_SESSION['user_group']['permisos']['agregar']['compras'] == 'true'){

				//Logica HERE										

				$this->views->getView($this,"NuevaCompra");
				exit();
			}else{
				header('Location: /SmartShop/Errors/PermisosInsuficientes');
				exit();
			}
			
		}
		

	}

	public function EditarCompra($id){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			if($_SESSION['user_group']['permisos']['editar']['compras'] == 'true'){

				//Logica HERE
				$data = $this->model->getComprabyID();
				$this->views->getView($this,"EditarCompra",$data);
				exit();
			}else{
				header('Location: /SmartShop/Errors/PermisosInsuficientes');
				exit();
			}
			
		}
		
	}

	public function Reportes(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			if($_SESSION['user_group']['permisos']['visualizar']['reportes'] == 'true'){
									
				$this->views->getView($this,"Reportes_Compras");
				exit();
			}else{
				header('Location: /SmartShop/Errors/PermisosInsuficientes');
				exit();
			}
			
		}	
	}
//Funciones AJAX
		public function NuevaCompra_AJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			//Validaciones
			$CompraTmp = isset($_SESSION['CompraTmp']) ? $_SESSION['CompraTmp'] : false;			
			$Total_CompraTmp = isset($_SESSION['Total_CompraTmp']) ? $_SESSION['Total_CompraTmp'] : false;
			$fecha = isset($_POST['fecha']) ? limpiarDatos($_POST['fecha']) : false;
			$hora = date('G:i:s') ? date('G:i:s') : false;
				//Formateamos la fecha 			
				if($fecha){
					$f = explode('/', $fecha);
					$fecha = $f[2] . '-' . $f[1] . '-' . $f[0];
				}
			$proveedorID = isset($_POST['proveedorID']) ? limpiarDatos($_POST['proveedorID']) : false;
			$TasaDolar = isset($_SESSION['precio_dolar']) ? $_SESSION['precio_dolar'] : 0;
			

			if(!(empty($fecha) || empty($proveedorID) || empty($CompraTmp) || empty($hora) || empty($Total_CompraTmp))){
				//Luego de validar añadimos la compra			
				$answer = $this->model->addCompra($proveedorID,$fecha,$hora,$CompraTmp,$Total_CompraTmp,$TasaDolar);
				switch ($answer) {
					case 1:
							?>
							<div class="alert alert-success alert-dismissible">
                				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                				<h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                				Compra Añadida Correctamente.
            				</div>
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
	
	$data = $this->model->getAllComprasforPagination($inicio,$artporpagina,$query);	
	$totalItemsBDD = $this->model->getTotalCompras($query);	
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
                  <th>Proveedor</th>
                  <th>Fecha</th>
                  <th>Usuario</th>
                  <th>SubTotal</th>                  
                  <th>TOTAL</th>                                       
                  <th>Acciones</th>
                </tr>
    
    <?php foreach ($data as $compra): ?>                  	                            
                <tr>
                  <td><?php echo $compra['id'] ?></td>
                  <td><?php echo $compra['nombre_empresa'] ?></td>
                  <td><?php echo $compra['fecha']; ?></td>
                  <td><?php echo $compra['usuario'] ?></td>                                  
                  <td>$<?php echo $compra['subtotal'] ?></td>                  
                  <td>$<?php echo $compra['total'] ?></td>                  
                  <td>
                  	<a href="/SmartShop/Reportes/Compra/<?php echo $compra['id'] ?>" target="_blank" class="btn btn-default btn-flat"><i class="fa fa-print"></i></a>
                  <?php if($_SESSION['user_group']['permisos']['editar']['compras'] == 'true'): ?>
                  	 <button class="btn btn-primary btn-flat"><i class="fa fa-edit"></i></button>
                  <?php endif; ?>
                  <?php if($_SESSION['user_group']['permisos']['eliminar']['compras'] == 'true'): ?>
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

                <p>Prueba hacer otra búsqueda.</p>
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

	public function MostrarItemsAJAX_Reportes() { 				
	if(!$_POST){
		return '';
	}	
//Logica de TABLA Y PAGINACION DE DATOS MEDIANTE AJAX
	$id_usuario = isset($_POST['id_usu']) ? limpiarDatos($_POST['id_usu']) : 0;
	$desde = isset($_POST['fecha1']) ? limpiarDatos($_POST['fecha1']) : 0;
	$hasta = isset($_POST['fecha2']) ? limpiarDatos($_POST['fecha2']) : 0;	
	$totalCompras = 0;	
	$data = $this->model->getAllComprasforReports($desde,$hasta,$id_usuario);		
	if($data){		
?>

	
		<div class="box-body">
			<div class="table-responsive">
              <table class="table table-hover table-responsive text-center">
                
                <tbody>                
                <tr>
                  <th>ID</th>
                  <th>Proveedor</th>
                  <th>Fecha</th>
                  <th>Usuario</th>
                  <th>SubTotal</th>                  
                  <th>TOTAL</th>                                                         
                </tr>
    
    <?php foreach ($data as $compra): ?>                  	                            
                <tr>
                  <td><?php echo $compra['id'] ?></td>
                  <td><?php echo $compra['nombre_empresa'] ?></td>
                  <td><?php echo $compra['fecha']; ?></td>
                  <td><?php echo $compra['usuario'] ?></td>                                  
                  <td>$<?php echo $compra['subtotal'] ?></td>                  
                  <td>$<?php echo $compra['total'] ?></td>                                  
                </tr>
                <?php $totalCompras = $totalCompras + $compra['total']; ?>
	<?php endforeach; ?>
				<tr>
                  <td colspan="4"></td>
                  <td style="font-family: 'Arial Black';">TOTAL</td>
                  <td style="font-family: 'Arial Black';">$ <?php echo $totalCompras; ?></td>
                </tr>  
                </tbody>
              </table>
              </div>         
            </div>
            <!-- /.box-body -->            
<script type="text/javascript">
	$('#Btn-Print').removeAttr('disabled');
</script>                 
<?php }else{

	?>
<div class="box-body table-responsive">
<div class="callout callout-info">
                <h4>¡No hay registros!</h4>

                <p>Comprueba que tienes compras realizadas y prueba a utilizar los filtros para encontrar compras</p>
              </div>
</div>
<script type="text/javascript">
	$('#Btn-Print').attr('disabled','disabled');
</script>
	 <?php 

}
}

}?>