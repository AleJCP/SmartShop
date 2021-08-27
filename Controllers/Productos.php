<?php 
//Vistas de la clase Productos
class Productos extends Controllers {

	public function __construct(){
		
		parent::__construct();
	}

//Metodo principal
	public function productos(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			header('Location: /SmartShop/Productos/AdministrarProductos');
			exit();
		}
		
		
	}


//Demas vistas

public function AdministrarProductos(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{					
			

			//Productos totales
			$data['totalProductos'] = $this->model->getTotalProducts();
			$this->views->getView($this,"AdministrarProductos",$data);			
		}
		
	}

public function categorias(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{			

			$data['totalCategorias'] = $this->model->getTotalCategorias();
			$this->views->getView($this,"categorias",$data);
		}
		

	}

public function NuevoProducto(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{	
			if($_SESSION['user_group']['permisos']['agregar']['productos'] == 'true'){
			//Categorias desde la BBDD
			$data['categorias'] = $this->model->getAllCategorias();			
			$this->views->getView($this,"NuevoProducto",$data);
			}else{
				header('Location: /SmartShop/Errors/PermisosInsuficientes');
				exit();
			}
		}
		

	}

public function EditarProducto($id){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{	
			
			//Categorias desde la BBDD															
			$data['categorias'] = $this->model->getAllCategorias();
			$data['Producto'] = $this->model->getProductbyID($id);		

			$this->views->getView($this,"EditarProducto",$data);
		}
		

	}

	public function Reportes(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			if($_SESSION['user_group']['permisos']['visualizar']['reportes'] == 'true'){
				
				$data['categorias'] = $this->model->getAllCategorias_All();				
				$this->views->getView($this,"Reportes_Inventario",$data);
				exit();
			}else{
				header('Location: /SmartShop/Errors/PermisosInsuficientes');
				exit();
			}
			
		}	
	}

//FUNCIONES AJAX
	//PRODUCTOS
public function addProductosAJAX(){
	if(!$_POST){
		return '';		
	}		


	//Data del Producto
	$data['codigo'] = isset($_POST['codigo']) ? limpiarDatos($_POST['codigo']) : '';
	$data['nombre'] = isset($_POST['nombre']) ? limpiarDatos($_POST['nombre']) : '';
	$data['descripcion'] = isset($_POST['descripcion']) ? limpiarDatos($_POST['descripcion']) : '';
	$data['categoria'] = isset($_POST['categoria']) ? limpiarDatos($_POST['categoria']) : '';
	$data['presentacion'] = isset($_POST['presentacion']) ? limpiarDatos($_POST['presentacion']) : '';
	$data['costo'] = isset($_POST['costo']) ? limpiarDatos($_POST['costo']) : (int)0;	
	$data['utilidad'] = (isset($_POST['utilidad']) && $_POST['utilidad'] != '0') ? limpiarDatos($_POST['utilidad']) : '0';
	$data['precio_bruto'] = isset($_POST['precio_bruto_venta']) ? $_POST['precio_bruto_venta'] : (int)0;
	$data['precio_bruto'] = isset($data['precio_bruto']) ? str_replace('$','',$data['precio_bruto']) : '';
	$data['precio_bruto'] = isset($data['precio_bruto']) ? limpiarDatos($data['precio_bruto']) : '';

	$data['precio_venta'] = isset($_POST['precio_venta']) ? $_POST['precio_venta'] : (int)0;
	$data['precio_venta'] = isset($data['precio_venta']) ? str_replace('$','',$data['precio_venta']) : '';
	$data['precio_venta'] = isset($data['precio_venta']) ? limpiarDatos($data['precio_venta']) : '';
	$data['estado'] = (isset($_POST['utilidad']) && $_POST['utilidad'] != '0') ? limpiarDatos($_POST['estado']) : '0';
	
	$data['stock'] = isset($_POST['stock']) ? limpiarDatos($_POST['stock']) : '0';	
	$data['upload_file']['tmp_name'] = $_FILES['image']['tmp_name'];

		//Comprobamos que el Archivo enviado se llame distinto a la imagen por defecto
		if($_FILES['image']['name'] == 'default.jpg'){
							?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Cambia el nombre a la imagen. Vuelve a Intentarlo.
              </div>
		 <?php die();
		}
		//Seteamos las variables del las variables temporales con la condicion de colocarla default si no existe
		$data['upload_file']['nombre'] = (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') ? $_FILES['image']['name'] : 'default.jpg';
		$data['upload_file']['tipo'] = (isset($_FILES['image']['type']) && $_FILES['image']['type'] != '') ? $_FILES['image']['type'] : 'image/jpg';
		$data['upload_file']['tamaño'] = $_FILES['image']['size'];								
	//Validacion de la imagen
	if(!($_FILES['image']['error'] === UPLOAD_ERR_OK || $data['upload_file']['nombre'] == 'default.jpg')){
	?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Ha ocurrido un error subiendo la imagen. Vuelve a Intentarlo.
              </div>
		 <?php die();
	}else{				
							
		//Comprobaciones del Archivo
		$ext_permitidas = array(
			"image/jpg",
			"image/jpeg",
			"image/png"								
		);
														
		if(($data['upload_file']['tamaño'] > 3000000) || (!in_array($data['upload_file']['tipo'], $ext_permitidas))){
								?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                La imagen no cumple con el formato requerido.
              </div>

		 <?php die();
		 
		}
	}
	//Fin de validaciones
	//Envio de datos al Modelo
	$answer = $this->model->addProduct($data);

	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                Producto Añadido Correctamente.
            </div>
		 <?php

			break;

		case '23000'://error Clave de campo CODIGO Repetida

			?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Ya ese Codigo existe en la base de datos. Cambialo. Vuelvelo a Intentar.
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
	
}


public function editarProductosAJAX(){
	if(!$_POST){
		return '';		
	}		
	//Data del Producto
	$data['id'] = isset($_POST['id']) ? limpiarDatos($_POST['id']) : '';
	$data['codigo'] = isset($_POST['codigo']) ? limpiarDatos($_POST['codigo']) : '';
	$data['nombre'] = isset($_POST['nombre']) ? limpiarDatos($_POST['nombre']) : '';
	$data['descripcion'] = isset($_POST['descripcion']) ? limpiarDatos($_POST['descripcion']) : '';
	$data['categoria'] = isset($_POST['categoria']) ? limpiarDatos($_POST['categoria']) : '';
	$data['presentacion'] = isset($_POST['presentacion']) ? limpiarDatos($_POST['presentacion']) : '';
	$data['costo'] = isset($_POST['costo']) ? limpiarDatos($_POST['costo']) : (int)0;	
	$data['utilidad'] = (isset($_POST['utilidad']) && $_POST['utilidad'] != '0') ? limpiarDatos($_POST['utilidad']) : '0';

	$data['precio_bruto'] = isset($_POST['precio_bruto_venta']) ? $_POST['precio_bruto_venta'] : (int)0;
	$data['precio_bruto'] = isset($data['precio_bruto']) ? str_replace('$','',$data['precio_bruto']) : '';
	$data['precio_bruto'] = isset($data['precio_bruto']) ? limpiarDatos($data['precio_bruto']) : '';

	$data['precio_venta'] = isset($_POST['precio_venta']) ? $_POST['precio_venta'] : (int)0;
	$data['precio_venta'] = isset($data['precio_venta']) ? str_replace('$','',$data['precio_venta']) : '';
	$data['precio_venta'] = isset($data['precio_venta']) ? limpiarDatos($data['precio_venta']) : '';
	$data['estado'] = (isset($_POST['utilidad']) && $_POST['utilidad'] != '0') ? limpiarDatos($_POST['estado']) : '0';	
						$data['upload_file']['tmp_name'] = $_FILES['image']['tmp_name'];
		//Comprobamos que el Archivo enviado se llame distinto a la imagen por defecto
						if($_FILES['image']['name'] == 'default.jpg'){
							?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Cambia el nombre a la imagen. Vuelve a Intentarlo.
              </div>
		 <?php die();
						}
						$data['upload_file']['nombre'] = (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') ? $_FILES['image']['name'] : 'default.jpg';
						$data['upload_file']['tipo'] = (isset($_FILES['image']['type']) && $_FILES['image']['type'] != '') ? $_FILES['image']['type'] : 'image/jpg';
						$data['upload_file']['tamaño'] = $_FILES['image']['size'];						
	$data['stock'] = isset($_POST['stock']) ? limpiarDatos($_POST['stock']) : '0';


	//Validacion de la imagen
	if(!($_FILES['image']['error'] === UPLOAD_ERR_OK || $data['upload_file']['nombre'] == 'default.jpg')){
	?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Ha ocurrido un error subiendo la imagen. Vuelve a Intentarlo.
              </div>
		 <?php die();
						}else{				
							
							//Comprobaciones del Archivo
							$ext_permitidas = array(
								"image/jpg",
								"image/jpeg",
								"image/png"								
							);
														
							if(($data['upload_file']['tamaño'] > 3000000) || (!in_array($data['upload_file']['tipo'], $ext_permitidas))){
								?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                La imagen no cumple con el formato requerido.
              </div>

		 <?php die();
		 
							}
						}
	//Fin de validaciones
	//Envio de datos al Modelo	
	$answer = $this->model->editProduct($data);

	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                Producto Añadido Correctamente.
            </div>
		 <?php

			break;

		case '23000'://error Clave de campo CODIGO Repetida

			?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Ya ese Codigo existe en la base de datos. Cambialo. Vuelvelo a Intentar.
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
	
}

public function dropProductobyIDAJAX(){
	if(!$_POST){
		return '';		
	}		
	//Data del Producto
	$id = isset($_POST['id']) ? limpiarDatos($_POST['id']) : false;	
	//Envio de datos al Modelo		
	$answer = ($id) ? $this->model->deleteProduct($id) : false;

	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                Registro eliminado Correctamente.
            </div>
		 <?php

			break;

		case '23000'://error Clave de campo CODIGO Repetida

			?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Ya ese Codigo existe en la base de datos. Cambialo. Vuelvelo a Intentar.
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
	
	$data = $this->model->getAllProductsforPagination($inicio,$artporpagina,$query);	
	$totalItemsBDD = $this->model->getTotalProducts($query);	
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
                  <th>Codigo</th>
                  <th>Imagen</th>
                  <th>Producto</th>
                  <th>Estado</th>
                  <th>Categoria</th>
                  <th>IVA %</th>
                  <th>Existencias</th>
                  <th>Precio $</th>
                  <th>Precio BsS</th>
                  <th>Acciones</th>
                </tr>
    
    <?php foreach ($data as $product): ?>                  	                            
                <tr>
                  <td><?php echo $product['codigo']; ?></td>
                  <td class=""><img style="max-width: 120px;height: 120px;" src="<?php echo UPLOADS . $product['imagen']; ?>" alt="<?php $product['imagen']; ?>" class="img-thumbnail center-block"></td>
                  <td><?php echo $product['nombre']; ?></td>
                  <?php if($product['estado']): ?>
                  <td><span class="label label-success">Activo</span></td>
                <?php else: ?>
                  <td><span class="label bg-red">Desactivado</span></td>
              	<?php endif; ?>
                  <td><?php echo $product['categoria']; ?></td>                  
                  <td><?php echo ($product['iva']==0) ? '(E)' : '% '.$product['iva']; ?></td>                  
                  <td><?php echo $product['stock']; ?></td>
                  <td>$<?php echo $product['precio_venta']; ?></td>
                  <?php if (isset($_SESSION['precio_dolar'])): ?>
                  	<td><?php echo number_format((double) $product['precio_venta'] * $_SESSION['precio_dolar'],2,'.',','); ?> BsS</td>
                  <?php else: ?>
                  <td>No hay Datos</td>
                  <?php endif ?>
                  <td>
                  	<?php if($_SESSION['user_group']['permisos']['editar']['productos'] == 'true'): ?>
                    <a class="btn btn-flat btn-primary" href="/SmartShop/Productos/EditarProducto/<?php echo $product['id'] ?>"><i class="fa fa-edit"></i></a>
                <?php endif; ?>
                <?php if($_SESSION['user_group']['permisos']['eliminar']['productos'] == 'true'): ?>
                    <Button data-toggle="modal" data-target="#modal_dropProducto" class="btn btn-flat btn-danger"  onclick="modal_dropProducto(<?php echo $product['id'] ?>)"><i class="fa fa-close"></i></Button>
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
	$id_cat = isset($_POST['id_cat']) ? limpiarDatos($_POST['id_cat']) : 0;
	$desde = isset($_POST['rango1']) ? limpiarDatos($_POST['rango1']) : 0;
	$hasta = isset($_POST['rango2']) ? limpiarDatos($_POST['rango2']) : 0;
	$inversionTotal = 0.0;
	$ganancia_eTotal = 0.0;
	$data = $this->model->getAllProductsforReports($desde,$hasta,$id_cat);				
	if($data){	
?>

	
		<div class="box-body">
			<div class="table-responsive">
              <table class="table table-hover table-responsive text-center">
                
                <tbody>                
                <tr>
                  <th>Codigo</th>                  
                  <th>Producto</th>
                  <th>Categoria</th>                  
                  <th>Existencias</th>
                  <th>Costo $</th>
                  <th>Utilidad %</th>
                  <th>Precio $</th>
                  <th>Precio BsS</th>                  
                </tr>
    
    <?php foreach ($data as $product): ?>                  	                            
                <tr>
                  <td><?php echo $product['codigo']; ?></td>                  
                  <td><?php echo $product['nombre']; ?></td>
                  <td><?php echo $product['categoria']; ?></td>                                 
                  <td><?php echo $product['stock']; ?></td>
                  <td>$<?php echo $product['costo']; ?></td>
                  <td>%<?php echo $product['utilidad']; ?></td>
                  <td>$<?php echo $product['precio_venta']; ?></td>
                  <?php if (isset($_SESSION['precio_dolar'])): ?>
                  	<td><?php echo number_format((double) $product['precio_venta'] * $_SESSION['precio_dolar'],2,'.',','); ?> BsS</td>
                  <?php else: ?>
                  <td>No hay Datos</td>
                  <?php endif ?>                  
                </tr>
                <?php $inversionTotal += ($product['costo'] * $product['stock']); ?>
                <?php $ganancia_eTotal += ($product['precio_venta'] * $product['stock']); ?>                
	<?php endforeach; ?>  
		<tr>
			<td colspan="6"></td>
			<td style="font-family: 'Arial Black';">Inversión TOTAL</td>
			<td style="font-family: 'Arial Black';">$ <?php echo $inversionTotal; ?></td>
		</tr>
		<tr>
			<td colspan="6"></td>
			<td style="font-family: 'Arial Black';">Ganancia TOTAL</td>
			<td style="font-family: 'Arial Black';">$ <?php echo $ganancia_eTotal; ?></td>
		</tr>
		<tr>
			<td colspan="6"></td>
			<td style="font-family: 'Arial Black';">Utilidad NETA</td>
			<?php $utilidad_neta = ($ganancia_eTotal - $inversionTotal); ?>
			<td style="font-family: 'Arial Black';">$ <?php echo $utilidad_neta; ?></td>
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

                <p>Comprueba que tienes productos en la Base de Datos, Prueba a utilizar los filtros para encontrar resultados.</p>
              </div>
</div>
<script type="text/javascript">
	$('#Btn-Print').attr('disabled','disabled');
</script>

	 <?php 
}
}

public function addCategoriasAJAX(){
	if(!$_POST){
		return '';		
	}		
	//Data del Proveedor
	$data['nombre'] = isset($_POST['nombre']) ? limpiarDatos($_POST['nombre']) : '';
	$data['estado'] = isset($_POST['estado']) ? limpiarDatos($_POST['estado']) : '';			
	$data['iva'] = isset($_POST['iva']) ? limpiarDatos($_POST['iva']) : '';								
	if(empty($data['nombre'])){
		$answer = false;
	}else{
		$answer = $this->model->addCategoria($data);		
	}		
	//Envio de datos al Modelo		
	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                Categoría Añadida Correctamente.
            </div>
		 <?php

			break;

		case '23000'://error Clave de campo CODIGO Repetida

			?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Ya ese Codigo existe en la base de datos. Cambialo. Vuelvelo a Intentar.
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
	
}

public function editCategoriasAJAX(){
	if(!$_POST){
		return '';		
	}		
	//Data del Proveedor
	$data['id'] = isset($_POST['id']) ? limpiarDatos($_POST['id']) : '';
	$data['nombre'] = isset($_POST['nombre']) ? limpiarDatos($_POST['nombre']) : '';
	$data['iva'] = (isset($_POST['iva'])) ? limpiarDatos($_POST['iva']) : 0;
	$data['estado'] = (isset($_POST['estado'])) ? limpiarDatos($_POST['estado']) : (string) '0';			
	if(empty($data['nombre'])){
		$answer = false;
	}else{
		$answer = $this->model->editCategoria($data);		
	}		
	//Envio de datos al Modelo	
	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                Categoría Editada Correctamente.
            </div>
		 <?php

			break;

		case '23000'://error Clave de campo CODIGO Repetida

			?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Ya ese Codigo existe en la base de datos. Cambialo. Vuelvelo a Intentar.
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
	
}

public function dropCategoriabyIDAJAX(){
	if(!$_POST){
		return '';		
	}		
	//Data del Producto
	$id = isset($_POST['id']) ? limpiarDatos($_POST['id']) : false;	
	//Envio de datos al Modelo		
	$answer = ($id) ? $this->model->deleteCategoria($id) : false;

	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                Registro eliminado Correctamente.
            </div>
		 <?php

			break;

		case '23000'://error Clave de campo CODIGO Repetida

			?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Ya ese Codigo existe en la base de datos. Cambialo. Vuelvelo a Intentar.
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
	
}

public function getFormEdit_CategoriabyID(){
	if(!$_POST){
		return '';
	}

		$id = isset($_POST['id']) ? limpiarDatos($_POST['id']) : '';
		$data = $this->model->getCategoriabyID($id);
		
		if($data){
		?>
			<!-- HTML -->
				<div class="form-group">
                  <label>Nombre</label>
                  <input name="id" type="hidden" value="<?php echo $data['id'] ?>">
                  <input type="text" value="<?php echo $data['nombre'] ?>" name="nombre" class="form-control"required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">                  
                </div>

               <div class="form-group">
                  <div class="row">
                <div class="col-xs-6">                
                  <label>IVA</label>
                  <div class="input-group">
                       <span class="input-group-addon">%</span>
                      <input type="text" value="<?php echo $data['iva'] ?>" name="iva" id="iva" class="form-control" pattern="[0-9]+|([0-9]+[.][0-9]+)" required oninvalid="setCustomValidity('Rellena este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}">                                
                    </div>
                  
                </div>                                
                <div class="col-xs-6">                
                  <label>Estado</label>
                  <select name="estado" class="form-control">
                  <option value="1">Activo</option>                    
                  <option value="0">Desactivado</option>
                  </select>
                </div>  
                </div>
                </div>

                <script type="text/javascript">
                	$('#EstadoInput').val(<?php echo $data['estado'] ?>)
                </script>              
		<?php }else{
			?>
				<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
               Ha ocurrido un error. Vuelvelo a Intentar.
              </div>
			<?php		

	}
}

public function MostrarItemsCategoriaAJAX() { 				
	if(!$_POST){
		return '';
	}	
//Logica de TABLA Y PAGINACION DE DATOS MEDIANTE AJAX
	$paginaActual = isset($_POST['pagina']) ? limpiarDatos($_POST['pagina']) : 1;
	$artporpagina = isset($_POST['artporpagina']) ? limpiarDatos($_POST['artporpagina']) : 5;
	$query = isset($_POST['query']) ? limpiarDatos($_POST['query']) : '';
	$inicio = ($paginaActual > 1) ? ($paginaActual * $artporpagina - $artporpagina) : 0;

	$data = $this->model->getAllCategoriasFP($inicio,$artporpagina,$query);	
	$totalItemsBDD = $this->model->getTotalCategorias($query);	
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
                  <th>Nombre</th>
                  <th>IVA</th>                                 
                  <th>Nro Articulos</th>
                  <th>Estado</th> 
                  <th>Acciones</th>
                </tr>
    
    <?php foreach ($data as $categoria): ?>                  	                            
                <tr>
                  <td><?php echo $categoria['id']; ?></td>                  
                  <td><?php echo $categoria['nombre']; ?></td>                                  
                  <td>% <?php echo $categoria['iva']; ?></td>                
                  <td><?php echo $categoria['nro_articulos']; ?></td>                 
                  <?php if($categoria['estado']): ?>
                  <td><span class="label label-success">Activo</span></td>
                <?php else: ?>
                  <td><span class="label bg-red">Desactivado</span></td>
              	<?php endif; ?>
                  <td>
                  	<?php if($_SESSION['user_group']['permisos']['editar']['categorias'] == 'true'): ?>
                     <Button data-toggle="modal" data-target="#modal-editCategoria" class="btn btn-flat btn-primary" onclick="editCategoria(<?php echo $categoria['id']; ?>)"><i class="fa fa-edit"></i></Button>
                 <?php endif; ?>
                 <?php if($_SESSION['user_group']['permisos']['eliminar']['categorias'] == 'true'): ?>
                    <Button data-toggle="modal" data-target="#modal-dropCategoria" class="btn btn-flat btn-danger" onclick="modal_DropCategoria(<?php echo $categoria['id']; ?>)"><i class="fa fa-close"></i></Button>
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
            
          
<?php } elseif($query){
	?>
<div class="box-body table-responsive">
<div class="callout callout-info">
                <h4>¡No hay resultados!</h4>

                <p>Prueba hacer otra búsqueda.</p>
              </div>
</div>


	 <?php 
}

}



public function MostrarItemstoCompraAJAX() { 				
	if(!$_POST){
		return '';
	}	
//Logica de TABLA Y PAGINACION DE DATOS MEDIANTE AJAX
	$paginaActual = isset($_POST['pagina']) ? limpiarDatos($_POST['pagina']) : 1;
	$artporpagina = isset($_POST['artporpagina']) ? limpiarDatos($_POST['artporpagina']) : 5;
	$query = isset($_POST['query']) ? limpiarDatos($_POST['query']) : '';
	$inicio = ($paginaActual > 1) ? ($paginaActual * $artporpagina - $artporpagina) : 0;
	
	$data = $this->model->getAllPFP_onlyAct($inicio,$artporpagina,$query);	
	$totalItemsBDD = $this->model->getTotalActiveProducts($query);	
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
                  <th>Codigo</th>                  
                  <th>Producto</th>                 
                  <th>Estado</th>
                  <th>Existencias</th>
                  <th>Costo $</th>
                  <th>Cantidad</th>
                  <th>Acciones</th>
                </tr>
    
    <?php foreach ($data as $product): ?>                  	                            
                <tr>
                  <td><?php echo $product['codigo']; ?></td>                  
                  <td><?php echo $product['nombre']; ?></td>                   
                <?php if($product['estado']): ?>
                  <td><span class="label label-success">Activo</span></td>
                <?php else: ?>
                  <td><span class="label bg-red">Desactivado</span></td>
              	<?php endif; ?>
                  <td><?php echo $product['stock']; ?></td>
                  <td>$<?php echo $product['costo']; ?></td>
                  <td><input value="1" class="form-control" id="cantidad_<?php echo $product['id'] ?>" type="number"></td>
                  <td>
                     <button type="button" onclick="<?php echo 'addProduct('.$product['id'].');' ?>" class="btn btn-flat btn-success"><i class="fa fa-shopping-cart"></i> Añadir</button>
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
            
          
<?php } elseif($query){
	?>
<div class="box-body table-responsive">
<div class="callout callout-info">
                <h4>¡No hay resultados!</h4>

                <p>Prueba hacer otra búsqueda.</p>
              </div>
</div>


	 <?php 
}

}

public function MostrarItemstoVentaAJAX() { 				
	if(!$_POST){
		return '';
	}	
//Logica de TABLA Y PAGINACION DE DATOS MEDIANTE AJAX
	$paginaActual = isset($_POST['pagina']) ? limpiarDatos($_POST['pagina']) : 1;
	$artporpagina = isset($_POST['artporpagina']) ? limpiarDatos($_POST['artporpagina']) : 5;
	$query = isset($_POST['query']) ? limpiarDatos($_POST['query']) : '';
	$inicio = ($paginaActual > 1) ? ($paginaActual * $artporpagina - $artporpagina) : 0;
	
	$data = $this->model->getAllPFP_onlyAct($inicio,$artporpagina,$query);	
	$totalItemsBDD = $this->model->getTotalActiveProducts($query);	
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
                  <th>Codigo</th>                  
                  <th>Producto</th>                                   
                  <th>Existencias</th>
                  <th>Categoría</th>
                  <th>IVA</th>
                  <th>Precio Bruto $</th>
                  <th>Precio Venta (+IVA) $</th>
                  <th>Cantidad</th>
                  <th>Acciones</th>
                </tr>
    
    <?php foreach ($data as $product): ?>                  	                            
                <tr>
                  <td><?php echo $product['codigo']; ?></td>                  
                  <td><?php echo $product['nombre']; ?></td>                                   
                  <td><?php echo $product['stock']; ?></td>
                  <td><?php echo $product['categoria']; ?></td>
                  <td><?php echo ($product['iva'] == 0) ? '(E)' : '%'.$product['iva']; ?></td>
                  <td>$<?php echo $product['precio_bruto']; ?></td>
                  <td>$<?php echo $product['precio_venta']; ?></td>
                  <td><input value="1" class="form-control" id="cantidad_<?php echo $product['id'] ?>" type="number"></td>
                  <td>
                     <button type="button" onclick="<?php echo 'addProduct('.$product['id'].');' ?>" class="btn btn-flat btn-success"><i class="fa fa-shopping-cart"></i> Añadir</button>
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
            
          
<?php } elseif($query){
	?>
<div class="box-body table-responsive">
<div class="callout callout-info">
                <h4>¡No hay resultados!</h4>

                <p>Prueba hacer otra búsqueda.</p>
              </div>
</div>


	 <?php 
}

}

//FUNCIONES AJAX	
//COMPRAS - PRODUCTOS
	public function addProduct_CompraTMPAJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			$id = isset($_POST['id']) ? limpiarDatos($_POST['id']) : '';	
			$cantidad = isset($_POST['cantidad']) ? limpiarDatos($_POST['cantidad']) : 1;
			$iva = isset($_POST['iva']) ? limpiarDatos($_POST['iva']) : 0.00;
			$data = isset($id) ? $this->model->addProduct_CompraTMP($id,$cantidad,$iva) : 0;
			if($data){
				//Mostrar Tabla
				
			}

		}		
	}

	public function deleteProduct_CompraTMPAJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			$id = isset($_POST['id']) ? limpiarDatos($_POST['id']) : '';	
			$iva = isset($_POST['iva']) ? limpiarDatos($_POST['iva']) : 0.00;
			$data = isset($id) ? $this->model->deleteProduct_CompraTMP($id,$iva) : 0;
			if($data){
				//Mostrar Tabla
				
			}

		}		
	}

	public function updateProduct_CompraTMPAJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{			
			$iva = isset($_POST['iva']) ? limpiarDatos($_POST['iva']) : 0.00;
			$data = isset($iva) ? $this->model->ActualizarTotal_Compra($iva) : false;
			var_dump($data);
			if($data){
				//Mostrar Tabla
				
			}

		}		
	}

	public function showAllProduct_CompraTMPAJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
						
			if(!empty($_SESSION['CompraTmp'])){
				//Actualizamos el total				
				//Si hay productos los mostramos					
					$CompraTmp = $_SESSION['CompraTmp'];
					$Total = $_SESSION['Total_CompraTmp'];

					?>
						
				<div class="box-body table-responsive no-padding">
                  <table class="table table-hover text-center">
                  <tbody>
                    <!-- TablaHeader -->
                    <tr>
                      <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Cantidad</th>
                      <th>Costo UNIDAD</th>
                      <th>Costo TOTAL</th>                  
                      <th></th>  
                    </tr>
                     <!-- TablaBody -->
                     <!-- Hre is goint to paint the products -->
                     <?php foreach ($CompraTmp as $Producto): ?>                        
                     <tr>
                      <td><?php echo $Producto['Codigo'] ?></td>
                      <td><?php echo $Producto['Nombre'] ?></td>
                      <td><?php echo $Producto['Cantidad'] ?></td>
                      <td><?php echo $Producto['Precio_IND'] ?> $</td>
                      <td><?php echo $Producto['Precio_TOTAL'] ?> $</td>
                      <td><button type="button" class="btn btn-danger" onclick="<?php echo 'deleteProduct('.$Producto['id'].')'; ?>">x</button></td>
                     </tr>                     
                     <?php endforeach ?>
                    <!-- TablaFooter -->
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong>SUBTOTAL $</strong></td>
                      <td><?php echo $Total['subtotal'] ?> $</td>
                    </tr>                    
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong>TOTAL $</strong></td>
                      <td><strong><?php echo $Total['total'] ?> $</strong></td>
                    </tr>

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong>TOTAL BsS</strong></td>
                      <td><strong><?php echo $Total['total_bss'] ?> BsS</strong></td>
                    </tr>
                  </tbody>
                  </table>             
                </div> 				      	         
					<?php

			}else{
					//Si no mostramos la tabla vacia					
					?>
						
				<div class="box-body table-responsive no-padding">
                  <table class="table table-hover text-center">
                  <tbody>
                    <!-- TablaHeader -->
                    <tr>
                      <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Cantidad</th>
                      <th>Costo UNIDAD</th>
                      <th>Costo TOTAL</th>                  
                      <th></th>  
                    </tr>
                     <!-- TablaBody -->                                    
                    <!-- TablaFooter -->
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong>SUBTOTAL $</strong></td>
                      <td>0.00 $</td>
                    </tr>                   
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong>TOTAL $</strong></td>
                      <td><strong>0.00 $</strong></td>
                    </tr>

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong>TOTAL BsS</strong></td>
                      <td><strong>0,00 BsS</strong></td>
                    </tr>
                  </tbody>
                  </table>             
                </div> 					

					<?php

			}

		}		
	}

//FUNCIONES AJAX	
//VENTAS - PRODUCTOS
	public function addProduct_VentaTMPAJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			$id = isset($_POST['id']) ? limpiarDatos($_POST['id']) : '';	
			$cantidad = isset($_POST['cantidad']) ? limpiarDatos($_POST['cantidad']) : 1;
			$iva = isset($_POST['iva']) ? limpiarDatos($_POST['iva']) : 0.00;
			$data = isset($id) ? $this->model->addProduct_VentaTMP($id,$cantidad,$iva) : 0;
			if($data){
				//Mostrar Tabla
				
			}

		}		
	}

	public function deleteProduct_VentaTMPAJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			$id = isset($_POST['id']) ? limpiarDatos($_POST['id']) : '';	
			$iva = isset($_POST['iva']) ? limpiarDatos($_POST['iva']) : 0.00;
			$data = isset($id) ? $this->model->deleteProduct_VentaTMP($id,$iva) : 0;
			if($data){
				//Mostrar Tabla
				
			}

		}		
	}

	public function updateProduct_VentaTMPAJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{			
			$iva = isset($_POST['iva']) ? limpiarDatos($_POST['iva']) : 0.00;
			$data = isset($iva) ? $this->model->ActualizarTotal_Venta($iva) : false;
			var_dump($data);
			if($data){
				//Mostrar Tabla
				
			}

		}		
	}

	public function showAllProduct_VentaTMPAJAX(){									
		if(!isset($_SESSION['id'])){			
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
						
			if(!empty($_SESSION['VentaTmp'])){
				//Actualizamos el total				
				//Si hay productos los mostramos					
					$VentaTmp = $_SESSION['VentaTmp'];				
					$Total = $_SESSION['Total_VentaTmp'];


					
					
					

					?>
						
				<div class="box-body table-responsive no-padding">
                  <table class="table table-hover text-center">
                  <tbody>
                    <!-- TablaHeader -->
                    <tr>
                      <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Cantidad</th>
                      <th>IVA</th>
                      <th>Precio UNIDAD</th>
                      <th>Precio TOTAL (Bruto)</th>                  
                      <th></th>  
                    </tr>
                     <!-- TablaBody -->
                     <!-- Hre is goint to paint the products -->
                     <?php foreach ($VentaTmp as $Producto): ?>                        
                     <tr>
                      <td><?php echo $Producto['Codigo'] ?></td>
                      <td><?php echo $Producto['Nombre'] ?></td>
                      <td><?php echo $Producto['Cantidad'] ?></td>
                      <td><?php echo ($Producto['Iva']==0) ? '(E)' : '% '.$Producto['Iva']; ?></td>
                      <td><?php echo $Producto['Precio_IND'] ?> $</td>
                      <td><?php echo $Producto['Precio_TOTAL'] ?> $</td>
                      <td><button type="button" class="btn btn-danger" onclick="<?php echo 'deleteProduct('.$Producto['id'].')'; ?>">x</button></td>
                     </tr>                     
                     <?php endforeach ?>
                    <!-- TablaFooter -->                                        
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong>SUBTOTAL $</strong></td>
                      <td><?php echo number_format($Total['subtotal'],2,'.',','); ?> $</td>
                    </tr>                                      
                    <?php foreach ($Total['iva'] as $key => $IVA): ?>                  	
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong><?php echo $key==0 ? '(EXENTO)' : 'IVA '.$key.' %' ?></strong></td>
                      <td><strong><?php echo number_format($IVA,2,'.',',') ?> $</strong></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php foreach ($Total['totales_iva'] as $key => $IVA): ?>    
                    	<?php if($key==0): ?>              	
                    		<?php continue; ?>
                    	<?php endif; ?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong><?php echo number_format($IVA,2,'.',',') ?> $</strong></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong>TOTAL $</strong></td>
                      <td><strong><?php echo number_format($Total['total'],2,'.',',') ?> $</strong></td>
                    </tr>

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong>TOTAL BsS</strong></td>
                      <td><strong><?php echo number_format($Total['total_bss'],2,'.',',') ?> BsS</strong></td>
                    </tr>
                  </tbody>
                  </table>             
                </div> 				

                <script>                	    			
						//Fijamos el total a cada label necesario para el modal de procesar la compra						
					$('#HiddenTotal').val('<?php echo $Total['total'] ?>');
					$('#HiddenTotalBsS').val('<?php echo $Total['total_bss'] ?>');
					$('#LabelMonto_Pagar').html('<?php echo number_format($Total['total'],2,'.',',') ?>');
					$('#LabelMonto_PagarBsS').html('<?php echo number_format($Total['total_bss'],2,'.',',') ?>');
					$('#LabelPor_Pagar').html('<?php echo number_format($Total['total'],2,'.',',') ?>');
					$('#LabelPor_PagarBsS').html('<?php echo number_format($Total['total_bss'],2,'.',',') ?>');
					$('.Monto_Pagar').val('0');
		    		
                </script>	

					<?php

			}else{
					//Si no mostramos la tabla vacia					
					?>
						
				<div class="box-body table-responsive no-padding">
                  <table class="table table-hover text-center">
                  <tbody>
                    <!-- TablaHeader -->
                    <tr>
                      <th>Codigo</th>
                      <th>Nombre</th>
                      <th>Cantidad</th>
                      <th>IVA</th>
                      <th>Precio UNIDAD</th>
                      <th>Precio TOTAL</th>                  
                      <th></th>  
                    </tr>
                     <!-- TablaBody -->                                    
                    <!-- TablaFooter -->
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong>SUBTOTAL $</strong></td>
                      <td>0.00 $</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong>TOTAL $</strong></td>
                      <td><strong>0.00 $</strong></td>
                    </tr>

                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td><strong>TOTAL BsS</strong></td>
                      <td><strong>0,00 BsS</strong></td>
                    </tr>
                  </tbody>
                  </table>             
                </div> 					
                <script>
                	//Detectamos el cambio del IVA
      	//          $('#Iva_Select').on('change', function(){
      	// 			var iva = $('#Iva_Select').val();
      	// 			console.log(iva);
      	// 			$.ajax({      
      	// 				data: {"iva":iva},
      	// 				type: 'POST',            
      	// 				url: '/SmartShop/Productos/updateProduct_VentaTMPAJAX',            
      	// 				beforeSend: function(){
       //  					$("#loaderBox_Productos").append('<div id="loader1" class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      	// 				},
				   //  	success: function(datos){        
       //  					$("#loader1").remove();        
       //  					cargarVenta_TMP();
       //  						// $('#Resultados_Productos').html(datos);          
      	// 				},
      	// 				error: function(xhr, textStatus, error){
       //  					$("#loader1").remove();
       //  					alert('Ha fallado la consulta ' + textStatus);
      	// 				}
    			// 	});
    			// });
    			$(document).ready(function (){      				
					$('#HiddenTotal').val('0');
					$('#HiddenTotalBsS').val('0');
					$('#LabelMonto_Pagar').html('0');
					$('#LabelMonto_PagarBsS').html('0');
					$('#LabelPor_Pagar').html('0');
					$('#LabelPor_PagarBsS').html('0');
					$('.Monto_Pagar').val('0');     		    
    			});  				        					   					        			
                </script>	
					<?php

			}

		}		
	}






} ?>	         