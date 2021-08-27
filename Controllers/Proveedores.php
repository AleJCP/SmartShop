<?php 
//Vistas de la clase VENTAS
class Proveedores extends Controllers {

	public function __construct(){
		
		parent::__construct();
	}

	public function Proveedores(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			$data['totalProveedores'] = $this->model->getTotalProveedores();
			$this->views->getView($this,"Proveedores",$data);	
		}
			
	}

	public function getProveedoresAJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{			
			//logic			
			$data = $this->model->getAllProveedores();			
			?>
				<option value="">Seleccione..</option> 
			<?php foreach ($data as $proveedor): ?>
				<option value="<?php echo $proveedor['id'] ?>"><?php echo $proveedor['nombre_empresa'] ?></option>
			<?php endforeach ?>
				
			<?php die();
		}
			
	}

	public function getDATAProveedorbyIDAJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{			
			//logic								
			$id = isset($_POST['id']) ? limpiarDatos($_POST['id']) : '';
 			$data = $this->model->getDataofProveedorbyID($id); 			 			
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

public function addProveedoresAJAX(){
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
	$answer = $this->model->addProveedor($data);
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

public function editProveedoresAJAX(){
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
	$answer = $this->model->updateProveedorbyID($data);	
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

public function dropProveedorbyIDAJAX(){
	if(!$_POST){
		return '';		
	}		
	//Data del Proveedor
	$id = isset($_POST['id']) ? strtoupper(limpiarDatos($_POST['id'])) : '';                   
	//Envio de datos al Modelo
	$answer = $this->model->dropProveedorbyID($id);	

	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                Proveedor Eliminado Correctamente.
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
	
	$data = $this->model->getAllProveedoresforPagination($inicio,$artporpagina,$query);	
	$totalItemsBDD = $this->model->getTotalProveedores($query);
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
                  <th>Proveedor</th>
                  <th>Dirección</th>
                  <th>Contacto</th>
                  <th>Agregado</th>
                  <th>Acciones</th>                  
                </tr>
    
    <?php foreach ($data as $proveedor): ?>                  	                            
                <tr>
                  
                  <td><?php echo $proveedor['id'] ?></td>
                  <td>

                  	<?php if ($proveedor['nombre_empresa']): ?>
                  	<i class="fa fa-suitcase"></i> <?php echo $proveedor['nombre_empresa'] ?></br>	
                  	<?php else: ?>	
                  	<i class="fa fa-user"></i> <?php echo $proveedor['nombre'].' '.$proveedor['apellido'] ?> </br>
                  	<?php endif ?>                    
                    <i class="fa fa-id-card"></i> <?php echo $proveedor['rif'] ?></br>                    
                    <?php if ($proveedor['sitio_web']): ?>
                    <i class="fa fa-globe"></i> <?php echo $proveedor['sitio_web']?></br>
                    <?php endif ?>

                  </td>
                  <td>
                  <?php if ($proveedor['local_nro'] || $proveedor['calle'] || $proveedor['sector']): ?>
                     <?php echo $proveedor['local_nro'] .' '. $proveedor['calle'] .' '.$proveedor['sector'] ?></br>
                 <?php endif ?>                  	
                     
                     <?php 	echo $proveedor['ciudad'] ?></br>
                     <?php echo $proveedor['estado'] ?></br>
                     <?php 	echo $proveedor['cod_postal'] ?></br>
                     <?php 	echo $proveedor['pais'] ?> </br>

                  </td>
                  <td>
                    <i class="fa fa-user"></i> <?php echo $proveedor['nombre'].' '.$proveedor['apellido'] ?> </br>
                    <i class="fa fa-phone"></i> <?php echo $proveedor['telefono'] ?> </br>
                    <?php if ($proveedor['email']): ?>
                    <i class="fa fa-envelope"></i> <?php echo $proveedor['email']?></br>
                    <?php endif ?>   
                  </td>                  
                  <td><?php echo $proveedor['f_registro'] ?></td>
                  <td>
                  	<?php if($_SESSION['user_group']['permisos']['editar']['proveedores'] == 'true'): ?>

                     <button data-toggle="modal" data-target="#modal-editProveedor" onclick="editarProveedor(<?php echo $proveedor['id']; ?>);" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></button>
                 <?php endif; ?>
                     <?php if($_SESSION['user_group']['permisos']['eliminar']['proveedores'] == 'true'): ?>
                     <button data-toggle="modal" data-target="#modal-dropProveedor"  onclick="modal_dropProveedor(<?php echo $proveedor['id']; ?>);" class="btn btn-flat btn-danger"><i class="fa fa-close"></i></button>
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