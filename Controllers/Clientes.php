<?php 
//Vistas de la clase CLIENTES
class Clientes extends Controllers {

	public function __construct(){
		
		parent::__construct();
	}

//Metodo principal
	public function clientes(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{

			$data['totalClientes'] = $this->model->getTotalClientes();
			$this->views->getView($this,"clientes",$data);
		}

		
	}
//Demas vistas

		public function getClientesAJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{			
			//logic			
			$data = $this->model->getAllClientes();			
			?>
				<option value="">Seleccione..</option> 
			<?php foreach ($data as $cliente): ?>
				<option value="<?php echo $cliente['id'] ?>"><?php echo $cliente['rif'] .' '. $cliente['nombre']?></option>
			<?php endforeach ?>
				
			<?php die();
		}
			
	}

public function getDATAClientebyIDAJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{			
			//logic								
			$id = isset($_POST['id']) ? limpiarDatos($_POST['id']) : '';
 			$data = $this->model->getDataofClientebyID($id); 			
				//Mostramos los inputs con los Datos
				?>

                <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1-e" data-toggle="tab" aria-expanded="true">Empresa</a></li>
              <li class=""><a href="#tab_2-e" data-toggle="tab" aria-expanded="false">Contacto</a></li>
              <li class=""><a href="#tab_3-e" data-toggle="tab" aria-expanded="false">Dirección</a></li>
            </ul>            
            <div  class="tab-content">            
              <div class="tab-pane active" id="tab_1-e">
                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Nombre de la empresa</label>
                  <div class="col-sm-10">
                  	<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    <input placeholder="Sin Datos" value="<?php echo $data['nombre_empresa'] ?>" id="InputNombreEmpresa-e" name="nombre_empresa" type="text"  class="form-control" 
                    onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">CI/RIF</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" value="<?php echo $data['rif'] ?>" id="InputRif-e" name="rif" type="text" pattern="[V|J|P|E][-][0-9]{8,9}" class="form-control" required oninvalid="setCustomValidity('Rellena este campo con el formato requerido');" onchange="try{setCustomValidity('')}catch(e){}"><!--                                       pattern="[V|J|P|E][-][0-9]{5,9}" -->
                  </div>
                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Sitio WEB</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" value="<?php echo $data['sitio_web'] ?>" id="InputSitioWeb-e" name="sitio_web" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-e">
                
                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Nombres</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" value="<?php echo $data['nombre'] ?>" id="InputNombre-e" name="nombre" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Apellidos</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" value="<?php echo $data['apellido'] ?>" id="InputApellido-e" name="apellido" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                   
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Teléfono</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" value="<?php echo $data['telefono'] ?>" id="InputTelefono-e" name="telefono" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">                  
                  </div>
                </div>

                  <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Email</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" value="<?php echo $data['email'] ?>" id="InputEmail-e" name="email" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-e">
                
                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Local Nro</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" value="<?php echo $data['local_nro'] ?>" id="InputLocalNro-e" name="local_nro" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                 <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Calle</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" value="<?php echo $data['calle'] ?>" id="InputCalle-e" name="calle" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Sector/Urb</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" value="<?php echo $data['sector'] ?>" id="InputSector-e" name="sector" type="text"  class="form-control" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Ciudad</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" value="<?php echo $data['ciudad'] ?>" id="InputCiudad-e" name="ciudad" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Estado</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" value="<?php echo $data['estado'] ?>" id="InputEstado-e" name="estado" type="text"  class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">Cod - Postal</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" value="<?php echo $data['cod_postal'] ?>" id="InputCodPostal-e" name="cod_postal" type="text" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

                <div class="form-group">

                  <label class="col-sm-2 control-label" for="">País</label>
                  <div class="col-sm-10">
                    <input placeholder="Sin Datos" value="<?php echo $data['pais'] ?>" id="InputPais-e" name="pais" type="text" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>

                </div>

              </div>
              <!-- /.tab-pane -->
            </div>            
            <!-- /.tab-content -->
          </div>    
          <script type="text/javascript">
          	$("#InputRif-e").inputmask({mask: "A-99999999[9]", greedy: false});      
      		$("#InputTelefono-e").inputmask({mask: "(999)-9999999"});
          </script>

				<?php
					
				
		}
			
	}

public function addClientesAJAX(){
	if(!$_POST){
		return '';		
	}		
	//Data del Proveedor
	$data['nombre_empresa'] = isset($_POST['nombre_empresa']) ? strtoupper(limpiarDatos($_POST['nombre_empresa'])) : '';
	$data['rif'] = isset($_POST['rif']) ? limpiarDatos($_POST['rif']) : '';
	$data['sitio_web'] = isset($_POST['sitio_web']) ? strtoupper(limpiarDatos($_POST['sitio_web'])) : '';
	$data['nombre'] = isset($_POST['nombre']) ? strtoupper(limpiarDatos($_POST['nombre'])) : '';
	$data['apellido'] = isset($_POST['apellido']) ? strtoupper(limpiarDatos($_POST['apellido'])) : '';
	$data['telefono'] = isset($_POST['telefono']) ? limpiarDatos($_POST['telefono']) : '';		
	$data['email'] = isset($_POST['email']) ? strtoupper(limpiarDatos($_POST['email'])) : '';	
	$data['local_nro'] = isset($_POST['local_nro']) ? limpiarDatos($_POST['local_nro']) : '';	
	$data['calle'] = isset($_POST['local_nro']) ? strtoupper(limpiarDatos($_POST['calle'])) : '';	
	$data['sector'] = isset($_POST['local_nro']) ? strtoupper(limpiarDatos($_POST['sector'])) : '';
	$data['ciudad'] = isset($_POST['ciudad']) ? strtoupper(limpiarDatos($_POST['ciudad'])) : '';
	$data['estado'] = isset($_POST['estado']) ? strtoupper(limpiarDatos($_POST['estado'])) : '';
	$data['cod_postal'] = isset($_POST['cod_postal']) ? limpiarDatos($_POST['cod_postal']) : '';	
	$data['pais'] = isset($_POST['pais']) ? strtoupper(limpiarDatos($_POST['pais'])) : '';
	 $DateTime = getdate();
	$data['f_registro'] = $DateTime['year'] . '-' . $DateTime['mon'] . '-' . $DateTime['mday'];                    
	//Envio de datos al Modelo
	$answer = $this->model->addCliente($data);
	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                Cliente Añadido Correctamente.
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

public function editClientesAJAX(){
	if(!$_POST){
		return '';		
	}		
	//Data del Proveedor
	$data['id'] = isset($_POST['id']) ? strtoupper(limpiarDatos($_POST['id'])) : '';
	$data['nombre_empresa'] = isset($_POST['nombre_empresa']) ? strtoupper(limpiarDatos($_POST['nombre_empresa'])) : '';
	$data['rif'] = isset($_POST['rif']) ? limpiarDatos($_POST['rif']) : '';
	$data['sitio_web'] = isset($_POST['sitio_web']) ? strtoupper(limpiarDatos($_POST['sitio_web'])) : '';
	$data['nombre'] = isset($_POST['nombre']) ? strtoupper(limpiarDatos($_POST['nombre'])) : '';
	$data['apellido'] = isset($_POST['apellido']) ? strtoupper(limpiarDatos($_POST['apellido'])) : '';
	$data['telefono'] = isset($_POST['telefono']) ? limpiarDatos($_POST['telefono']) : '';		
	$data['email'] = isset($_POST['email']) ? strtoupper(limpiarDatos($_POST['email'])) : '';	
	$data['local_nro'] = isset($_POST['local_nro']) ? limpiarDatos($_POST['local_nro']) : '';	
	$data['calle'] = isset($_POST['local_nro']) ? strtoupper(limpiarDatos($_POST['calle'])) : '';	
	$data['sector'] = isset($_POST['local_nro']) ? strtoupper(limpiarDatos($_POST['sector'])) : '';
	$data['ciudad'] = isset($_POST['ciudad']) ? strtoupper(limpiarDatos($_POST['ciudad'])) : '';
	$data['estado'] = isset($_POST['estado']) ? strtoupper(limpiarDatos($_POST['estado'])) : '';
	$data['cod_postal'] = isset($_POST['cod_postal']) ? limpiarDatos($_POST['cod_postal']) : '';	
	$data['pais'] = isset($_POST['pais']) ? strtoupper(limpiarDatos($_POST['pais'])) : '';	 	                   	
	//Envio de datos al Modelo
	$answer = $this->model->updateClientebyID($data);	
	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                Proveedor Añadido Correctamente.
            </div>
		 <?php

			break;

		case '23000'://error Clave de campo CODIGO Repetida

			?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Ya esa identificación (RIF/Cedula) existe en la base de datos. Cambialo. Vuelvelo a Intentar.
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

public function dropClientebyIDAJAX(){
	if(!$_POST){
		return '';		
	}		
	//Data del Proveedor
	$id = isset($_POST['id']) ? strtoupper(limpiarDatos($_POST['id'])) : '';                   
	//Envio de datos al Modelo
	$answer = $this->model->dropClientebyID($id);	

	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                Cliente Eliminado Correctamente.
            </div>
		 <?php

			break;

		case '23000'://error Clave de campo CODIGO Repetida

			?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Ya esa identificación (RIF/Cedula) existe en la base de datos. Cambialo. Vuelvelo a Intentar.
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
	
	$data = $this->model->getAllClientesforPagination($inicio,$artporpagina,$query);	
	$totalItemsBDD = $this->model->getTotalClientes($query);
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
              <table class="table table-hover table-responsive">
                
                <tbody>                
                <tr>
                  <th>ID</th>                  
                  <th>Cliente</th>
                  <th>Dirección</th>
                  <th>Contacto</th>
                  <th>Agregado</th>
                  <th>Deuda</th>
                  <th>Acciones</th>                  
                </tr>
    
    <?php foreach ($data as $cliente): ?>                  	                            
                <tr>
                  
                  <td><?php echo $cliente['id'] ?></td>
                  <td>

                  	<?php if ($cliente['nombre_empresa']): ?>
                  	<i class="fa fa-suitcase"></i> <?php echo $cliente['nombre_empresa'] ?></br>	
                  	<?php else: ?>	
                  	<i class="fa fa-user"></i> <?php echo $cliente['nombre'].' '.$cliente['apellido'] ?> </br>
                  	<?php endif ?>                    
                    <i class="fa fa-id-card"></i> <?php echo $cliente['rif'] ?></br>
                    <?php if ($cliente['sitio_web']): ?>
                    <i class="fa fa-globe"></i> <?php echo $cliente['sitio_web']?></br>
                    <?php endif ?>                                        

                  </td>
                  <td>
                  <?php if ($cliente['local_nro'] || $cliente['calle'] || $cliente['sector']): ?>
                     <?php echo $cliente['local_nro'] .' '. $cliente['calle'] .' '.$cliente['sector'] ?></br>
                 <?php endif ?>                  	
                     
                     <?php 	echo $cliente['ciudad'] ?></br>
                     <?php echo $cliente['estado'] ?></br>
                     <?php 	echo $cliente['cod_postal'] ?></br>
                     <?php 	echo $cliente['pais'] ?> </br>

                  </td>
                  <td>
                    <i class="fa fa-user"></i> <?php echo $cliente['nombre'].' '.$cliente['apellido'] ?> </br>
                    <i class="fa fa-phone"></i> <?php echo $cliente['telefono'] ?> </br>
                    <?php if ($cliente['email']): ?>
                    <i class="fa fa-envelope"></i> <?php echo $cliente['email']?></br>
                    <?php endif ?>   
                  </td>                  
                  <td><?php echo $cliente['f_registro'] ?></td>
                  <td>$ <?php echo isset($cliente['deuda']) ? number_format($cliente['deuda'],2,'.',',') : '0.00' ?></td>
                  <td>
                  	<button type="button" data-toggle="modal" data-target="#modal-deudasCliente" class="btn btn-default btn-flat" onclick="deudaCliente(<?php echo $cliente['id'] ?>);"><i class="fa fa-dollar"></i></button>
                  <?php if($_SESSION['user_group']['permisos']['editar']['clientes'] == 'true'): ?>
                     <button type="button" data-toggle="modal" data-target="#modal-editCliente" class="btn btn-primary btn-flat" onclick="editCliente(<?php echo $cliente['id'] ?>);"><i class="fa fa-edit"></i></button>
                 <?php endif; ?>
                 <?php if($_SESSION['user_group']['permisos']['eliminar']['clientes'] == 'true'): ?>
                     <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-dropCliente" onclick="modal_dropCliente(<?php echo $cliente['id'] ?>)"><i class="fa fa-close"></i></button>
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
                <p>No hay datos que mostrar.</p>
              </div>
			</div>
	 <?php 
}

}

public function deudasClientebyIDAJAX(){
	if(!$_POST){
		return '';		
	}		
	$ID = isset($_POST['id']) ? limpiarDatos($_POST['id']) : false;
	//Envio de datos al Modelo	
	$Ventas = new ventasModel();	
	//Ventas por pagar, por el id del usuario
	$data['ventasPorPagar'] = $Ventas->getVentasPorPagarBYClienteID($ID);
	$data['cliente'] = $this->model->getDataofClientebyID($ID);
	//Deuda Total
	$DeudaTotal = 0.00;
	if(isset($data['ventasPorPagar']) && $data['ventasPorPagar']){
		foreach ($data['ventasPorPagar'] as $key => $Venta) {
			$DeudaTotal += (float) $Venta['total'] - $Venta['total_monto_abonado'];
	 	}		
	} 
	// var_dump($data);
	// die();


	if($data['ventasPorPagar'] && $data['cliente']) {
		//Mostramos el HTML
		?>	

		<div class="row">
			<input type="hidden" id="ClienteID" value="<?php echo $data['cliente']['id'] ?>">
			<div class="col-sm-12">
				<div class="col-sm-6">					
					<h4>Nombres y Apellidos:</h4>
					<h3><?php echo $data['cliente']['nombre'] . ' ' . $data['cliente']['apellido'] ?></h3>
				</div>
				<div class="col-sm-6">
					<h4>Cedula/RIF:</h4>
					<h3><?php echo $data['cliente']['rif'] ?></h3>
				</div>
			</div>
		</div>
		
		

		<div id="historiaVentas_SP">                  
			<div class="box-body">
				<div style="background: white; color: black;" class="table-responsive">
					<h4 class="title text-center">Historia de Ventas sin Pagar</h4>
					<table class="table table-hover table-responsive text-center">

						<tbody>                

							<tr>
								<th>ID</th>                  
								<th>Fecha</th>
								<th>Hora</th>
								<th>Usuario</th>
								<th>Total abonado</th>
								<th>SubTotal</th>                  
								<th>TOTAL</th>                                      
								<th>Acciones</th>
							</tr>         
							<?php foreach ($data['ventasPorPagar'] as $key => $Venta): ?>								
								<tr>
									<td><?php echo $Venta['id'] ?></td>								
									<td><?php echo $Venta['fecha'] ?></td>
									<td><?php echo $Venta['hora'] ?></td>
									<td><?php echo $Venta['usuario'] ?></td>
									<td>$ <?php echo $Venta['total_monto_abonado'] ?></td>
									<td>$ <?php echo $Venta['subtotal'] ?></td>
									<td>$ <?php echo $Venta['total'] ?></td>
									<td>
										<button class="btn btn-default btn-flat">Ver Factura</button>
									</td>
								</tr>  
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>                  
			</div>               
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h3 class="col-sm-6">Deuda Total:</h3>
				<h3 class="col-sm-6">$ <span><?php echo number_format((float)$DeudaTotal,2,'.',',') ?></span> / BsS <span><?php echo number_format((float)$DeudaTotal * $_SESSION['precio_dolar'],2,'.',',') ?></span></h3>
			</div>
		</div>

			<script type="text/javascript">				
						//Fijamos el total a cada label necesario para el modal de procesar la compra
					$('#HiddenTotal').val('<?php echo $DeudaTotal; ?>');
					$('#HiddenTotalBsS').val('<?php echo $DeudaTotal * $_SESSION['precio_dolar'] ?>');
					$('#LabelMonto_Pagar').html('<?php echo number_format((float)$DeudaTotal,2,'.',',') ?>');
					$('#LabelMonto_PagarBsS').html('<?php echo number_format((float)$DeudaTotal * $_SESSION['precio_dolar'],2,'.',',') ?>');
					$('#LabelPor_Pagar').html('<?php echo number_format((float)$DeudaTotal,2,'.',',') ?>');
					$('#LabelPor_PagarBsS').html('<?php echo number_format((float)$DeudaTotal * $_SESSION['precio_dolar'],2,'.',',') ?>');
					$('.Monto_Pagar').val('0');		    		
			</script>

		<?php 

	}elseif(empty($data['VentasPorPagar'])){
		?>
		<h2 class="text-center">Este cliente no tiene deudas</h2>
		<?php 
	}
}

	public function NuevoAbono_AJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{

			$data['fecha'] = date('Y-m-d') ? date('Y-m-d') : false;											
			$data['hora'] = date('G:i:s') ? date('G:i:s') : false;
			$data['clienteID'] = isset($_POST['ClienteID']) ? limpiarDatos($_POST['ClienteID']) : false;			
			//DATOS DINAMICOS
			$data['total_monto_abonar'] = 0;
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
			$data['total_monto_abonar'] = 0.00;
			if(isset($data['monto_pagar'])){
				foreach ($data['monto_pagar'] as $key => $MP) {				 
					if($data['metodo_pago'][$key] == 'Efectivo_BsS' || $data['metodo_pago'][$key] == 'Punto venta_BsS' || $data['metodo_pago'][$key] == 'Pago movil' || $data['metodo_pago'][$key] == 'Transferencia'){
						$monto_bss = str_replace(',', '', $data['monto_pagar'][$key]);		
						$data['total_monto_abonar'] += (double) $monto_bss / $_SESSION['precio_dolar'];
					}else{
						$data['total_monto_abonar'] += (double) str_replace(',', '',$data['monto_pagar'][$key]);	
					}						
				}
			}else{
				?>
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> ¡Error!</h4>
						No has fijado ningún monto.
					</div>
					<?php 
					die();			
			}					
			//Verificamos que el monto de cada metodo de pago
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

			//Comprobamos que todos los datos existen y los mandamos al modelo
			if(true){
								
				$answer = $this->model->abonarDeuda($data);
				var_dump($answer);
				die();
				switch ($answer) {
					case 1:
							?>
							<div class="alert alert-success alert-dismissible">
                				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                				<h4><i class="icon fa fa-check"></i> ¡Transacción Exitosa!</h4>
                				Deuda actualizada correctamente.                				
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
				//Rellena todos los campos necesarios
			}

		}
	}

}?>