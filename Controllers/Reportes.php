<?php 
//Vistas de la clase HOME
class Reportes extends Controllers {



	public function __construct(){
		
		parent::__construct();
	}

	public function Ventas(){	
	//Datos enviados desde POST, Informacion sobre el reporte a generar
	$dataArr = isset($_POST['data-range']) ? explode(' - ',limpiarDatos($_POST['data-range'])) : 0;
	$id_usuario = isset($_POST['ID_Usu']) ? limpiarDatos($_POST['ID_Usu']) : 0;
	$desde = isset($dataArr[0]) ? limpiarDatos($dataArr[0]) : 0;
	$hasta = isset($dataArr[1]) ? limpiarDatos($dataArr[1]) : 0;
	$totalVentas = 0;	
	$data = $this->model->getAllVentasforReports($desde,$hasta,$id_usuario);			

	//
	$empresa = $this->model->getAllInfo_Empresa();

	if(!($desde || $hasta)){
		echo 'Error Generando el Reporte PDF';
		die();
	}				
	if($data){							
 ?>			
 <head>
	<title>Reporte de Ventas - <?php echo $desde.' - '.$hasta; ?> </title>
 </head>
		  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/bower_components/bootstrap/dist/css/bootstrap.min.css" ?>">
		  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/dist/css/AdminLTE.min.css" ?>">
		   <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/dist/css/skins/skin-green.min.css" ?>">
		   		   				   
		
			<div class="container">
			<div class="row"  style="margin-top: 20px">
				<div class="col-xs-4">
					<img src="<?php echo UPLOADS . $empresa['logo'] ?>" class="thumb" style="width: 200px; max-height: 200px" alt="User Image">
				</div>
				<div class="col-xs-8 text-right" >
					<span><?php echo $empresa['calle']?></span><br>
					<span><?php echo $empresa['ciudad'].', '. $empresa['estado'] ?></span><br>
					<span><?php echo $empresa['pais'].', '.$empresa['cod_postal'] ?></span><br>
					<span><?php echo $empresa['rif'].', '.$empresa['telefono']?></span><br>
					<span><?php echo $empresa['nombre_empresa']?></span><br>
				</div>
			</div>
		</div>

		<div class="container">
			<div style="width: 100%; height: 10px; background: gray;"></div>
			<div class="row">
				<div class="col-xs-12">
					Reporte: Ventas<br>
					Desde: <?php echo $desde; ?><br>
					Hasta: <?php echo $hasta ?><br>
					Usuario: 
					<?php if($id_usuario==0): ?> 
					Todos los usuarios 
					<?php else: ?> 
					 <?php echo $data[0]['usuario']; ?>
					<?php endif; ?>


				</div>
			</div>
			<div style="width: 100%; height: 10px; background: gray;"></div>
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
                  <td>$ <?php echo $venta['subtotal'] ?></td>                  
                  <td>$ <?php echo $venta['total'] ?></td>                  
                </tr>                
                <?php $totalVentas = $totalVentas + $venta['total']; ?>
	<?php endforeach; ?>  	
				<tr>

                  <td colspan="4"></td>
                  <td style="font-family: 'Arial Black';">TOTAL</td>
                  <td style="font-family: 'Arial Black';">$ <?php echo $totalVentas; ?></td>
                </tr>
                </tbody>
              </table>
              <div style="width: 100%; height: 10px; background: gray;"></div>
              <p style="text-align:center;">Reporte de Ventas - <?php echo $empresa['nombre_empresa']?> - RIF: <?php echo $empresa['rif']?> - <?php echo $empresa['email'] ?> - <?php echo $empresa['telefono'] ?> - <?php echo $empresa['estado'].', '. $empresa['pais'] ?></p>
              </div>
            </div>         
</div>
<script type="text/javascript">
	window.onload = function(){
		this.print();

		}	
</script>
<?php
die();	
	
}
}

		public function Venta($id){
	//Factura de compra por id

	//Datos enviados desde GET, Informacion sobre el reporte a generar			
	$data = $this->model->getVentaByID($id);	
	$empresa = $this->model->getAllInfo_Empresa();		
	
	if(!isset($id) || empty($id) || $data == false){
		echo 'Error Generando el Reporte PDF';
		die();
	}				
	if($data){							
 ?>			
 <head>
	<title>Factura Venta Nro <?php echo $data['venta']['id']; ?> </title>
 </head>
		  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/bower_components/bootstrap/dist/css/bootstrap.min.css" ?>">
		  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/dist/css/AdminLTE.min.css" ?>">
		   <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/dist/css/skins/skin-green.min.css" ?>">
		   		   				   
		
			<div class="container">
			<div class="row"  style="margin-top: 20px">
				<div class="col-xs-4">
					<img src="<?php echo UPLOADS . $empresa['logo'] ?>" class="thumb" style="width: 200px; max-height: 200px" alt="User Image">
				</div>
				<div class="col-xs-8 text-right" >
					<span><?php echo $empresa['calle']?></span><br>
					<span><?php echo $empresa['ciudad'].', '. $empresa['estado'] ?></span><br>
					<span><?php echo $empresa['pais'].', '.$empresa['cod_postal'] ?></span><br>
					<span><?php echo $empresa['rif'].', '.$empresa['telefono']?></span><br>
					<span><?php echo $empresa['nombre_empresa']?></span><br>
				</div>
			</div>
		</div>

		<div class="container">
			<div style="width: 100%; height: 10px; background: gray;"></div>
			<div class="row">
				<div class="col-xs-12">
					Factura nro: <?php echo $data['venta']['id']; ?><br>					
					Cliente: <?php echo $data['venta']['rif_cliente'] . ' ' . $data['venta']['cliente_nombre'] . ' ' . $data['venta']['cliente_apellido'] ; ?><br>
					Fecha: <?php echo $data['venta']['fecha']; ?><br>
					Usuario: <?php echo $data['venta']['usuario']; ?><br>									
				</div>
			</div>
			<div style="width: 100%; height: 10px; background: gray;"></div>
		<div class="box-body">
			<div class="table-responsive">
              <table class="table table-hover table-responsive text-center">
                
                <tbody>                
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Categoría</th> 
                  <th>Cantidad</th>                  
                  <th>IVA</th> 
                  <th>Precio UNIDAD</th>
                  <th>Precio TOTAL</th>                                                                   
                  
                </tr>
    
    <?php foreach ($data['producto_V'] as $producto): ?>                  	                            
                <tr>
                  <td><?php echo $producto['codigo'] ?></td>
                  <td><?php echo $producto['producto']?></td>   
                  <td><?php echo $producto['categoria'] ?></td>                                
                  <td><?php echo $producto['cantidad'] ?></td>                  
                  <td><?php echo ($producto['iva'] == 0) ? '(E)' : '%' .$producto['iva']; ?></td>
                  <td>$ <?php echo $producto['precio_unidad'] ?></td>
                  <td>$ <?php echo $producto['precio_total'] ?></td>                  
                </tr>                                
	<?php endforeach; ?>  	
				<tr>
                  <td colspan="5"></td>
                  <td style="font-size:12px;font-family: 'Arial Black';">SUBTOTAL</td>
                  <td style=" font-size:12px; font-family: 'Arial Black';">$ <?php echo $data['venta']['subtotal']; ?></td>
                </tr>
                <?php foreach ($data['totales_iva'] as $key => $value): ?>
                	<tr>
                  		<td colspan="5"></td>
                  		<td style="font-size:12px; font-family: 'Arial Black';"><?php echo ($key == 0) ? 'EXENTO' : '% ' . $key ?></td>
                  		<td style="font-size:12px; font-family: 'Arial Black';">$ <?php echo $value; ?></td>
                	</tr>	
                <?php endforeach; ?>
                
                <tr>
                  <td colspan="5"></td>
                  <td style="font-family: 'Arial Black';">TOTAL</td>
                  <td style="font-family: 'Arial Black';">$ <?php echo $data['venta']['total']; ?></td>
                </tr>
                <tr>
                  <td colspan="5"></td>
                  <td style="font-family: 'Arial Black';">TOTAL BsS</td>
                  <td style="font-family: 'Arial Black';"><?php echo number_format($data['venta']['total'] * $data['venta']['tasa_dolar'],2,'.',',') ; ?> BsS</td>
                </tr>
                </tbody>
              </table>
              <div class="center-block" style="width: 100%; height: 10px; background: gray;"></div>
              <p style="text-align: center;">Factura Venta Nro <?php echo $data['venta']['id']; ?> - <?php echo $empresa['nombre_empresa']?> - RIF: <?php echo $empresa['rif']?> - <?php echo $empresa['email'] ?> - <?php echo $empresa['telefono'] ?> - <?php echo $empresa['estado'].', '. $empresa['pais'] ?></p>
              </div>
            </div>         
</div>
<script type="text/javascript">
	window.onload = function(){
		this.print();

		}	
</script>
<?php
die();	
	
}
}



	public function Compras(){	
	//Datos enviados desde POST, Informacion sobre el reporte a generar
	$dataArr = isset($_POST['data-range']) ? explode(' - ',limpiarDatos($_POST['data-range'])) : 0;
	$id_usuario = isset($_POST['ID_Usu']) ? limpiarDatos($_POST['ID_Usu']) : 0;
	$desde = isset($dataArr[0]) ? limpiarDatos($dataArr[0]) : 0;
	$hasta = isset($dataArr[1]) ? limpiarDatos($dataArr[1]) : 0;
	$totalCompras = 0;	
	$data = $this->model->getAllComprasforReports($desde,$hasta,$id_usuario);			

	//
	$empresa = $this->model->getAllInfo_Empresa();	
	if(!($desde || $hasta)){
		echo 'Error Generando el Reporte PDF';
		die();
	}				
	if($data){							
 ?>			
 <head>
	<title>Reporte de Compras - <?php echo $desde.' - '.$hasta; ?> </title>
 </head>
		  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/bower_components/bootstrap/dist/css/bootstrap.min.css" ?>">
		  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/dist/css/AdminLTE.min.css" ?>">
		   <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/dist/css/skins/skin-green.min.css" ?>">
		   		   				   
		
			<div class="container">
			<div class="row"  style="margin-top: 20px">
				<div class="col-xs-4">
					<img src="<?php echo UPLOADS . $empresa['logo'] ?>" class="thumb" style="width: 200px; max-height: 200px" alt="User Image">
				</div>
				<div class="col-xs-8 text-right" >
					<span><?php echo $empresa['calle']?></span><br>
					<span><?php echo $empresa['ciudad'].', '. $empresa['estado'] ?></span><br>
					<span><?php echo $empresa['pais'].', '.$empresa['cod_postal'] ?></span><br>
					<span><?php echo $empresa['rif'].', '.$empresa['telefono']?></span><br>
					<span><?php echo $empresa['nombre_empresa']?></span><br>
				</div>
			</div>
		</div>

		<div class="container">
			<div style="width: 100%; height: 10px; background: gray;"></div>
			<div class="row">
				<div class="col-xs-12">
					Reporte: Compras<br>
					Desde: <?php echo $desde; ?><br>
					Hasta: <?php echo $hasta ?><br>
					Usuario: 
					<?php if($id_usuario==0): ?> 
					Todos los usuarios 
					<?php else: ?> 
					    <?php echo $data[0]['usuario']; ?>
					<?php endif; ?>


				</div>
			</div>
			<div style="width: 100%; height: 10px; background: gray;"></div>
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
                  <th>IVA</th>
                  <th>TOTAL</th>                                     
                  
                </tr>
    
    <?php foreach ($data as $compra): ?>                  	                            
                <tr>
                  <td><?php echo $compra['id'] ?></td>
                  <td><?php echo $compra['nombre_empresa']?></td>
                  <td><?php echo $compra['fecha']; ?></td>
                  <td><?php echo $compra['usuario'] ?></td>                                  
                  <td>$ <?php echo $compra['subtotal'] ?></td>
                  <td><?php echo $compra['iva'] ?>%</td>
                  <td>$ <?php echo $compra['total'] ?></td>                  
                </tr>                
                <?php $totalCompras = $totalCompras + $compra['total']; ?>
	<?php endforeach; ?>  	
				<tr>
                  <td colspan="5"></td>
                  <td style="font-family: 'Arial Black';">TOTAL</td>
                  <td style="font-family: 'Arial Black';">$ <?php echo $totalCompras; ?></td>
                </tr>
                </tbody>
              </table>
              <div style="width: 100%; height: 10px; background: gray;"></div>
              <p style="text-align:center;">Reporte de Compras - <?php echo $empresa['nombre_empresa']?> - RIF: <?php echo $empresa['rif']?> - <?php echo $empresa['email'] ?> - <?php echo $empresa['telefono'] ?> - <?php echo $empresa['estado'].', '. $empresa['pais'] ?></p>
              </div>
            </div>         
</div>
<script type="text/javascript">
	window.onload = function(){
		this.print();

		}	
</script>
<?php
die();	
	
}
}

		public function Compra($id){
	//Factura de compra por id

	//Datos enviados desde GET, Informacion sobre el reporte a generar			
	$data = $this->model->getCompraByID($id);	
	$empresa = $this->model->getAllInfo_Empresa();		
	

	if(!isset($id) || empty($id) || $data == false){
		echo 'Error Generando el Reporte PDF';
		die();
	}				
	if($data){							
 ?>			
 <head>
	<title>Factura Compra Nro <?php echo $data['compra']['id']; ?> </title>
 </head>
		  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/bower_components/bootstrap/dist/css/bootstrap.min.css" ?>">
		  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/dist/css/AdminLTE.min.css" ?>">
		   <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/dist/css/skins/skin-green.min.css" ?>">
		   		   				   
		
			<div class="container">
			<div class="row"  style="margin-top: 20px">
				<div class="col-xs-4">
					<img src="<?php echo UPLOADS . $empresa['logo'] ?>" class="thumb" style="width: 200px; max-height: 200px" alt="User Image">
				</div>
				<div class="col-xs-8 text-right" >
					<span><?php echo $empresa['calle']?></span><br>
					<span><?php echo $empresa['ciudad'].', '. $empresa['estado'] ?></span><br>
					<span><?php echo $empresa['pais'].', '.$empresa['cod_postal'] ?></span><br>
					<span><?php echo $empresa['rif'].', '.$empresa['telefono']?></span><br>
					<span><?php echo $empresa['nombre_empresa']?></span><br>
				</div>
			</div>
		</div>

		<div class="container">
			<div style="width: 100%; height: 10px; background: gray;"></div>
			<div class="row">
				<div class="col-xs-12">
					ID: <?php echo $data['compra']['id']; ?><br>					
					Proveedor: <?php echo $data['compra']['rif'] . ' ' . $data['compra']['proveedor']; ?><br>
					Fecha: <?php echo $data['compra']['fecha']; ?><br>
					Usuario: <?php echo $data['compra']['usuario']; ?><br>									
				</div>
			</div>
			<div style="width: 100%; height: 10px; background: gray;"></div>
		<div class="box-body">
			<div class="table-responsive">
              <table class="table table-hover table-responsive text-center">
                
                <tbody>                
                <tr>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Cantidad</th>                  
                  <th>Costo UNIDAD</th>
                  <th>Costo TOTAL</th>                                                                   
                  
                </tr>
    
    <?php foreach ($data['producto_C'] as $producto): ?>                  	                            
                <tr>
                  <td><?php echo $producto['codigo'] ?></td>
                  <td><?php echo $producto['nombre']?></td>                  
                  <td><?php echo $producto['cantidad'] ?></td>                                  
                  <td>$ <?php echo $producto['precio_unidad'] ?></td>
                  <td>$ <?php echo $producto['precio_total'] ?></td>                  
                </tr>                                
	<?php endforeach; ?>  	
				<tr>
                  <td colspan="3"></td>
                  <td style="font-family: 'Arial Black';">SUBTOTAL</td>
                  <td style="font-family: 'Arial Black';">$ <?php echo $data['compra']['subtotal']; ?></td>
                </tr>
                <tr>
                  <td colspan="3"></td>
                  <td style="font-family: 'Arial Black';">TOTAL</td>
                  <td style="font-family: 'Arial Black';">$ <?php echo $data['compra']['total']; ?></td>
                </tr>
                <tr>
                  <td colspan="3"></td>
                  <td style="font-family: 'Arial Black';">TOTAL BsS</td>
                  <td style="font-family: 'Arial Black';"><?php echo $data['compra']['total_bss']; ?> BsS</td>
                </tr>
                </tbody>
              </table>
              <div class="center-block" style="width: 100%; height: 10px; background: gray;"></div>
              <p style="text-align: center;">Factura Compra Nro <?php echo $data['compra']['id']; ?> - <?php echo $empresa['nombre_empresa']?> - RIF: <?php echo $empresa['rif']?> - <?php echo $empresa['email'] ?> - <?php echo $empresa['telefono'] ?> - <?php echo $empresa['estado'].', '. $empresa['pais'] ?></p>
              </div>
            </div>         
</div>
<script type="text/javascript">
	window.onload = function(){
		this.print();

		}	
</script>
<?php
die();	
	
}
}

	public function Inventario(){	
	//Datos enviados desde POST, Informacion sobre el reporte a generar	
	$exisArr = isset($_POST['existencia-range']) ? explode('-',limpiarDatos($_POST['existencia-range'])) : 0;
	$categoria = isset($_POST['ID_Cat']) ? limpiarDatos($_POST['ID_Cat']) : 0;
	$desde = isset($exisArr[0]) ? limpiarDatos($exisArr[0]) : 0;
	$hasta = isset($exisArr[1]) ? limpiarDatos($exisArr[1]) : 0;
	$totalCompras = 0;	
	$inversionTotal = 0.0;
	$ganancia_eTotal = 0.0;
	$data = $this->model->getAllProductsforReports($desde,$hasta,$categoria);			
	//
	$empresa = $this->model->getAllInfo_Empresa();	
	if(!($desde || $hasta)){
		echo 'Error Generando el Reporte PDF';
		die();
	}				
	if($data){							
 ?>			
 <head>
	<title>Reporte de Inventario - <?php echo $desde.' - '.$hasta; ?> </title>
 </head>
		  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/bower_components/bootstrap/dist/css/bootstrap.min.css" ?>">
		  <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/dist/css/AdminLTE.min.css" ?>">
		   <link rel="stylesheet" type="text/css" href="<?php echo ASSETS."Dependencias/dist/css/skins/skin-green.min.css" ?>">
		   		   				   
		
			<div class="container">
			<div class="row"  style="margin-top: 20px">
				<div class="col-xs-4">
					<img src="<?php echo UPLOADS . $empresa['logo'] ?>" class="thumb" style="width: 200px; max-height: 200px" alt="User Image">
				</div>
				<div class="col-xs-8 text-right" >
					<span><?php echo $empresa['calle']?></span><br>
					<span><?php echo $empresa['ciudad'].', '. $empresa['estado'] ?></span><br>
					<span><?php echo $empresa['pais'].', '.$empresa['cod_postal'] ?></span><br>
					<span><?php echo $empresa['rif'].', '.$empresa['telefono']?></span><br>
					<span><?php echo $empresa['nombre_empresa']?></span><br>
				</div>
			</div>
		</div>

		<div class="container">
			<div style="width: 100%; height: 10px; background: gray;"></div>
			<div class="row">
				<div class="col-xs-12">
					Reporte: Inventario<br>
					<?php if($hasta=='Inf' && $desde=='1'): ?>
					Más de 1 Existencia<br>
					<?php elseif($hasta=='Inf' && $desde=='201'): ?>
					Más de 200 Existencias<br>
					<?php else: ?>
					Entre <?php echo $desde ?> y <?php echo $hasta ?> Existencias<br>			
					<?php endif; ?>
					Categoría: 
					<?php if($categoria==0): ?> 
					Todos las Categorias 
					<?php else: ?> 
						<?php echo $data[0]['categoria'] ?>
					<?php endif; ?>


				</div>
			</div>
			<div style="width: 100%; height: 10px; background: gray;"></div>
		<div class="box-body" style="padding: 0;" >
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
                <tr style="font-size: 12px;">
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
			<td style=" font-size: 14px; font-family: 'Arial Black';">Inversión TOTAL</td>
			<td style="font-size: 14px; font-family: 'Arial Black';">$ <?php echo $inversionTotal; ?></td>
		</tr>
		<tr>
			<td colspan="6"></td>
			<td style="font-size: 14px; font-family: 'Arial Black';">Ganancia TOTAL</td>
			<td style="font-size: 14px; font-family: 'Arial Black';">$ <?php echo $ganancia_eTotal; ?></td>
		</tr>
		<tr>
			<td colspan="6"></td>
			<td style="font-size: 14px; font-family: 'Arial Black';">Utilidad NETA</td>
			<?php $utilidad_neta = ($ganancia_eTotal - $inversionTotal); ?>
			<td style="font-size: 14px; font-family: 'Arial Black';">$ <?php echo $utilidad_neta; ?></td>
		</tr>
		
                </tbody>

              </table>
              <div style="width: 100%; height: 10px; background: gray;"></div>
              <p style="text-align:center;">Reporte de Inventario - <?php echo $empresa['nombre_empresa']?> - RIF: <?php echo $empresa['rif']?> - <?php echo $empresa['email'] ?> - <?php echo $empresa['telefono'] ?> - <?php echo $empresa['estado'].', '. $empresa['pais'] ?></p>
              </div>
            </div>         
</div>
<script type="text/javascript">
	window.onload = function(){
		this.print();

		}	
</script>
<?php
die();	
	
}
}

}?>