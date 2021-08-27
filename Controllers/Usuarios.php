<?php 
//Controlador de USUARIOS
class usuarios extends Controllers {

	public function __construct(){
		
		parent::__construct();
	}


	public function usuarios(){
		
	}

	public function getUsuariosAJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{			
			//logic			
			$data = $this->model->getAllUsuarios();								
			?>
				<option value="0">Todos los usuarios</option> 
			<?php foreach ($data as $usuario): ?>
				<option value="<?php echo $usuario['id'] ?>"><?php echo $usuario['usuario'] ?></option>
			<?php endforeach ?>
				
			<?php die();
		}
			
	}

public function login(){
		if(isset($_SESSION['id'])){
			header('Location: /SmartShop/');
			die();
		}else{
		// Lógica login
			//VARIABLES
			$errores = "";
			$validaciones = "";

//			Sera verdadrero al mandar el formulario
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			//TRATAMIENTO DE LAS VARIABLES
			$usuario = strtoupper(limpiarDatos($_POST['usuario']));
			$password = limpiarDatos($_POST['password']);							

			//Comprobacion
			if(empty($usuario) || empty($password)){
				$errores .= '<li>No dejes campos vacíos</li>';
			}else{

			//CONSULTA
			$result = $this->model->tryLogin($usuario,$password);
			if ($result) {
				header('Location: /SmartShop/');								

				die();
			}else{
				$errores .= '<li>Usuario o Contraseña incorrectos</li>';
			}							

			}

		}
		
		$data['errores'] = $errores ? $errores : null;
		$data['validaciones'] = $validaciones ? $validaciones : null;

		$this->views->getView($this,"login",$data);
		}

	}

public function logout(){

		$_SESSION['id'] = "";
		setcookie("PHPSESSID", "", time()-100);
		$_SESSION = array();
		session_destroy();
		header("Location: /SmartShop/Usuarios/Login");		
		die();
}

public function AdministrarUsuarios(){

		$data['totalUsuarios'] = $this->model->getTotalUsuarios();
		$this->views->getView($this,"administrarusuarios",$data);
}

	public function getGrupoUsuariosAJAX(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{			
			//logic			
			$data = $this->model->getAll_G_Usuarios();			
			?>
				<option value="">Seleccione..</option> 
			<?php foreach ($data as $GruposUsuarios): ?>
				<option value="<?php echo $GruposUsuarios['id'] ?>"><?php echo $GruposUsuarios['nombre']?></option>
			<?php endforeach ?>
				
			<?php die();
		}
			
	}

public function GruposUsuarios(){	
	$data['total_GUsuarios'] = $this->model->getTotal_GUsuarios();
	$this->views->getView($this,"GruposUsuarios",$data);		
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
	
	$data = $this->model->getAllUsuariosforPagination($inicio,$artporpagina,$query);	
	$totalItemsBDD = $this->model->getTotalUsuarios($query);
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
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Email</th>
                  <th>Grupo</th>                  
                  <th>Estado</th> 
                  <th>Acciones</th> 
                </tr>
    
    <?php foreach ($data as $usuario): ?>                  	                            
                <tr>                  
                  <td><?php echo $usuario['id'] ?></td>                                          
                  <td><?php echo $usuario['usuario'] ?></td>
                  <td><?php echo $usuario['nombre'] ?></td>
                  <td><?php echo $usuario['apellido'] ?></td>
                  <td><?php echo $usuario['email'] ?></td>
                  <td><?php echo $usuario['grupousuario'] ?></td>
                  <?php if ($usuario['estado']): ?>
                  	<td><small class="label bg-green">Activo</small></td>
                  	<?php else: ?>
                  	<td><small class="label bg-yellow">Suspendido</small></td>
                  <?php endif ?>                  
                  <td>
                 <?php if($_SESSION['user_group']['permisos']['editar']['control_usuarios'] == 'true'): ?>
                     <button type="button" data-toggle="modal" data-target="#modal-editUsuario" class="btn btn-primary btn-flat" onclick="editUsuario(<?php echo $usuario['id'] ?>);"><i class="fa fa-edit"></i></button>
                 <?php endif; ?>
                 <?php if($_SESSION['user_group']['permisos']['eliminar']['control_usuarios'] == 'true'): ?>
                     <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-dropUsuario" onclick="modal_dropUsuario(<?php echo $usuario['id'] ?>)"><i class="fa fa-close"></i></button>
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

public function MostrarItems_GUSUARIO_AJAX() { 				
	if(!$_POST){
		return '';
	}	
//Logica de TABLA Y PAGINACION DE DATOS MEDIANTE AJAX
	$paginaActual = isset($_POST['pagina']) ? limpiarDatos($_POST['pagina']) : 1;
	$artporpagina = isset($_POST['artporpagina']) ? limpiarDatos($_POST['artporpagina']) : 5;
	$query = isset($_POST['query']) ? limpiarDatos($_POST['query']) : '';
	$inicio = ($paginaActual > 1) ? ($paginaActual * $artporpagina - $artporpagina) : 0;
	
	$data = $this->model->getAll_GUsuariosforPagination($inicio,$artporpagina,$query);	
	$totalItemsBDD = $this->model->getTotal_GUsuarios($query);
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
                  <th>Nombre</th>
                  <th>Acciones</th> 
                </tr>
    
    <?php foreach ($data as $G_usuario): ?>                  	                            
                <tr>                  
                  <td><?php echo $G_usuario['id'] ?></td>                                                            
                  <td><?php echo $G_usuario['nombre'] ?></td>
                                               
                  <td>
                  	<?php if($_SESSION['user_group']['permisos']['editar']['control_usuarios'] == 'true'): ?>
                     <button type="button" data-toggle="modal" data-target="#modal-editGUsuario" class="btn btn-primary btn-flat" onclick="edit_GUsuario(<?php echo $G_usuario['id'] ?>);"><i class="fa fa-edit"></i></button>
                 <?php endif; ?>
                    <?php if($_SESSION['user_group']['permisos']['eliminar']['control_usuarios'] == 'true'): ?>
                     <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modaldrop_GUsuario" onclick="modaldrop_GUsuario(<?php echo $G_usuario['id'] ?>)"><i class="fa fa-close"></i></button>
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


public function add_GUsuariosAJAX(){
	if(!$_POST){
		return '';		
	}		
	
	//Limpiarmos los datos que vienen del post
	$data['nombre'] = (isset($_POST['nombre_gu'])) ? $_POST['nombre_gu'] : '';				
	
		//VISUALIZAR
			$data['permisos']['visualizar']['inicio'] = (isset($_POST['checkInicioVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['compras'] = (isset($_POST['checkComprasVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['productos'] = (isset($_POST['checkProductosVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['categorias'] = (isset($_POST['checkCategoriasVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['facturacion'] = (isset($_POST['checkFacturacionVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['clientes'] = (isset($_POST['checkClientesVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['proveedores'] = (isset($_POST['checkProveedoresVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['reportes'] = (isset($_POST['checkReportesVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['configuracion'] = (isset($_POST['checkConfigVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['control_usuarios'] = (isset($_POST['checkControlUsuVisualizar'])) ? 'true' : 'false';

		//AGREGAR
			$data['permisos']['agregar']['inicio'] = (isset($_POST['checkInicioAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['compras'] = (isset($_POST['checkComprasAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['productos'] = (isset($_POST['checkProductosAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['categorias'] = (isset($_POST['checkCategoriasAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['facturacion'] = (isset($_POST['checkFacturacionAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['clientes'] = (isset($_POST['checkClientesAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['proveedores'] = (isset($_POST['checkProveedoresAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['reportes'] = (isset($_POST['checkReportesAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['configuracion'] = (isset($_POST['checkConfigAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['control_usuarios'] = (isset($_POST['checkControlUsuAgregar'])) ? 'true' : 'false';

		//EDITAR
			$data['permisos']['editar']['inicio'] = (isset($_POST['checkInicioEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['compras'] = (isset($_POST['checkComprasEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['productos'] = (isset($_POST['checkProductosEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['categorias'] = (isset($_POST['checkCategoriasEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['facturacion'] = (isset($_POST['checkFacturacionEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['clientes'] = (isset($_POST['checkClientesEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['proveedores'] = (isset($_POST['checkProveedoresEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['reportes'] = (isset($_POST['checkReportesEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['configuracion'] = (isset($_POST['checkConfigEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['control_usuarios'] = (isset($_POST['checkControlUsuEditar'])) ? 'true' : 'false';
		
		//ELIMINAR
			$data['permisos']['eliminar']['inicio'] = (isset($_POST['checkInicioEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['compras'] = (isset($_POST['checkComprasEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['productos'] = (isset($_POST['checkProductosEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['categorias'] = (isset($_POST['checkCategoriasEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['facturacion'] = (isset($_POST['checkFacturacionEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['clientes'] = (isset($_POST['checkClientesEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['proveedores'] = (isset($_POST['checkProveedoresEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['reportes'] = (isset($_POST['checkReportesEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['configuracion'] = (isset($_POST['checkConfigEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['control_usuarios'] = (isset($_POST['checkControlUsuEliminar'])) ? 'true' : 'false';
	
	//Envio de datos al Modelo			
	if($data['nombre'] == ''){
			$answer = false;
		}else{
			$answer = $this->model->add_GUsuario($data);	
		}
	
	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                Grupo de Usuario Añadido Correctamente.
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

public function addUsuariosAJAX(){
	if(!$_POST){
		return '';		
	}		
	
	//Limpiarmos los datos que vienen del post
	$data['nombre'] = isset($_POST['nombre']) ? strtoupper(limpiarDatos($_POST['nombre'])) : '';	
	$data['apellido'] = isset($_POST['apellido']) ? strtoupper(limpiarDatos($_POST['apellido'])) : '';
	$data['email'] = isset($_POST['email']) ? strtoupper(limpiarDatos($_POST['email'])) : '';	
	$data['cedula'] = isset($_POST['cedula']) ? strtoupper(limpiarDatos($_POST['cedula'])) : '';	
	$data['telefono'] = isset($_POST['telefono']) ? strtoupper(limpiarDatos($_POST['telefono'])) : '';	
	$data['estado'] = isset($_POST['estado']) ? strtoupper(limpiarDatos($_POST['estado'])) : 0;
	$data['gusuario'] = isset($_POST['gusuario']) ? strtoupper(limpiarDatos($_POST['gusuario'])) : 0;
	$data['usuario'] = isset($_POST['usuario']) ? strtoupper(limpiarDatos($_POST['usuario'])) : 0;
	$data['password'] = isset($_POST['contraseña']) ? limpiarDatos($_POST['contraseña']) : 0;	
	$data['password2'] = isset($_POST['contraseña2']) ? limpiarDatos($_POST['contraseña2']) : 0;
	
	//Envio de datos al Modelo
	if($data['password'] == $data['password2']){
		$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
		$answer = $this->model->addUsuario($data);
	}
	else{
		$answer = '2020'; //Codigo de contraseña incorrecta
	}
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
                Ya ese Codigo o Usuario existe en la base de datos. Cambialo. Vuelvelo a Intentar.
              </div>
		 <?php

			break;

		case '2020'://error Clave de campo CODIGO Repetida

			?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                La Contraseña no coincide. Vuelvelo a Intentar.
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

public function getFORM_EDIT_GUsuario(){
	if(!$_POST){
		return '';		
	}

	//Logic
	$id = isset($_POST['id']) ? limpiarDatos($_POST['id']) : '';	
	$data = $this->model->getPermisionsByID($id);
		
	if($data){

		?>
		<div class="form-group">
                 <label class="col-sm-2 control-label" for="">Nombre</label>
                  <div class="col-sm-10">
                    <input value="<?php echo $data['nombre'] ?>" id="nombre_gu" type="text" name="nombre_gu" class="form-control" placeholder="Ingresa el Nombre" maxlength="20" required>
                  </div>  
                </div>

                <div class="table-responsive no-padding">
                <table class="table table-hover table-striped">
                  <tbody>
                  <tr>
                    <th>
                      Modulo
                    </th>
                    <th>
                      <div class="form-check form-check-inline">
                      	<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                        <input id="checkAllVisualizar2" name="checkAllVisualizar" class="form-check-input" type="checkbox"> 
                        <label for="checkAllVisualizar2" class="form-check-label">Visualizar</label>
                      </div>
                    </th>
                    <th>
                      <div class="form-check form-check-inline">
                        <input id="checkAllAgregar2" name="checkAllAgregar" class="form-check-input" type="checkbox"> 
                        <label for="checkAllAgregar2" class="form-check-label">Agregar</label>
                      </div>
                    </th>
                    <th>
                      <div class="form-check form-check-inline">
                        <input id="checkAllEditar2" name="checkAllEditar" class="form-check-input" type="checkbox">
                        <label for="checkAllEditar2" class="form-check-label">Editar</label>
                      </div>
                    </th>
                    <th>
                      <div class="form-check form-check-inline">
                        <input id="checkAllEliminar2" name="checkAllEliminar" class="form-check-input" type="checkbox"> 
                        <label for="checkAllEliminar2" class="form-check-label">Eliminar</label>
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <td>
                      Inicio
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>

                        	<?php if ($data['permisos']['visualizar']['inicio'] == "true"): ?>
                        		<input id="checkInicioVisualizar2" name="checkInicioVisualizar" type="checkbox" checked>	
                        		<?php else: ?>	
                        		<input id="checkInicioVisualizar2" name="checkInicioVisualizar" type="checkbox">	
                        	<?php endif ?>
                          Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['agregar']['inicio'] == "true"): ?>
                        		<input id="checkInicioAgregar2" name="checkInicioAgregar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkInicioAgregar2" name="checkInicioAgregar" type="checkbox"> 
                        	<?php endif ?>
                          Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['editar']['inicio'] == "true"): ?>
                        		<input id="checkInicioEditar2" name="checkInicioEditar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkInicioEditar2" name="checkInicioEditar" type="checkbox"> 
                        	<?php endif ?>
                          Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['eliminar']['inicio'] == "true"): ?>
                        		<input id="checkInicioEliminar2" name="checkInicioEliminar" type="checkbox"checked> 	
                        		<?php else: ?>	
                        		<input id="checkInicioEliminar2" name="checkInicioEliminar" type="checkbox"> 
                        	<?php endif ?>
                          Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Compras
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        <?php if ($data['permisos']['visualizar']['compras'] == "true"): ?>
                        		<input id="checkComprasVisualizar2" name="checkComprasVisualizar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkComprasVisualizar2" name="checkComprasVisualizar" type="checkbox"> 
                        	<?php endif ?>
                        Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['agregar']['compras'] == "true"): ?>
                        		<input id="checkComprasAgregar2" name="checkComprasAgregar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkComprasAgregar2" name="checkComprasAgregar" type="checkbox">
                        	<?php endif ?>
                          Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['editar']['compras'] == "true"): ?>
                        		<input id="checkComprasEditar2" name="checkComprasEditar" type="checkbox"  checked> 	
                        		<?php else: ?>	
                        		<input id="checkComprasEditar2" name="checkComprasEditar" type="checkbox"> 
                        	<?php endif ?>
                          Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                           <?php if ($data['permisos']['eliminar']['compras'] == "true"): ?>
                        		<input id="checkComprasEliminar2" name="checkComprasEliminar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkComprasEliminar2" name="checkComprasEliminar" type="checkbox"> 
                        	<?php endif ?>
                          Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      Productos
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <?php if ($data['permisos']['visualizar']['productos'] == "true"): ?>
                        		<input id="checkProductosVisualizar2" name="checkProductosVisualizar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkProductosVisualizar2" name="checkProductosVisualizar" type="checkbox">
                        	<?php endif ?>
                           Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['agregar']['productos'] == "true"): ?>
                        		<input id="checkProductosAgregar2" name="checkProductosAgregar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkProductosAgregar2" name="checkProductosAgregar" type="checkbox">
                        	<?php endif ?>
                          Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['editar']['productos'] == "true"): ?>
                        		<input id="checkProductosEditar2" name="checkProductosEditar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkProductosEditar2" name="checkProductosEditar" type="checkbox"> 
                        	<?php endif ?>
                          Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['eliminar']['productos'] == "true"): ?>
                        		<input id="checkProductosEliminar2" name="checkProductosEliminar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkProductosEliminar2" name="checkProductosEliminar" type="checkbox">
                        	<?php endif ?>
                           Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Categorías
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                           <?php if ($data['permisos']['visualizar']['categorias'] == "true"): ?>
                        		<input id="checkCategoriasVisualizar2" name="checkCategoriasVisualizar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkCategoriasVisualizar2" name="checkCategoriasVisualizar" type="checkbox">
                        	<?php endif ?>
                           Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['agregar']['categorias'] == "true"): ?>
                        		<input id="checkCategoriasAgregar2" name="checkCategoriasAgregar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkCategoriasAgregar2" name="checkCategoriasAgregar" type="checkbox">
                        	<?php endif ?>
                          Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['editar']['categorias'] == "true"): ?>
                        		<input id="checkCategoriasEditar2" name="checkCategoriasEditar" type="checkbox"  checked> 	
                        		<?php else: ?>	
                        		<input id="checkCategoriasEditar2" name="checkCategoriasEditar" type="checkbox"> 
                        	<?php endif ?>
                          Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['eliminar']['categorias'] == "true"): ?>
                        		<input id="checkCategoriasEliminar2" name="checkCategoriasEliminar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkCategoriasEliminar2" name="checkCategoriasEliminar" type="checkbox">
                        	<?php endif ?>
                           Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Facturación
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['visualizar']['facturacion'] == "true"): ?>
                        		<input id="checkFacturacionVisualizar2" name="checkFacturacionVisualizar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkFacturacionVisualizar2" name="checkFacturacionVisualizar" type="checkbox">
                        	<?php endif ?>
                           Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['agregar']['facturacion'] == "true"): ?>
                        		<input id="checkFacturacionAgregar2" name="checkFacturacionAgregar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkFacturacionAgregar2" name="checkFacturacionAgregar" type="checkbox">
                        	<?php endif ?>
                           Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['editar']['facturacion'] == "true"): ?>
                        		<input id="checkFacturacionEditar2" name="checkFacturacionEditar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkFacturacionEditar2" name="checkFacturacionEditar" type="checkbox">
                        	<?php endif ?>
                           Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['eliminar']['facturacion'] == "true"): ?>
                        		<input id="checkFacturacionEliminar2" name="checkFacturacionEliminar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkFacturacionEliminar2" name="checkFacturacionEliminar" type="checkbox">
                        	<?php endif ?>
                           Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Clientes
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                          <?php if ($data['permisos']['visualizar']['clientes'] == "true"): ?>
                        		<input id="checkClientesVisualizar2" name="checkClientesVisualizar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkClientesVisualizar2" name="checkClientesVisualizar" type="checkbox">
                        	<?php endif ?>
                           Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['agregar']['clientes'] == "true"): ?>
                        		<input id="checkClientesAgregar2" name="checkClientesAgregar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkClientesAgregar2" name="checkClientesAgregar" type="checkbox"> 
                        	<?php endif ?>
                          Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['editar']['clientes'] == "true"): ?>
                        		<input id="checkClientesEditar2" name="checkClientesEditar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkClientesEditar2" name="checkClientesEditar" type="checkbox"> 
                        	<?php endif ?>
                          Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['eliminar']['clientes'] == "true"): ?>
                        		<input id="checkClientesEliminar2" name="checkClientesEliminar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkClientesEliminar2" name="checkClientesEliminar" type="checkbox"> 
                        	<?php endif ?>
                          Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      Proveedores
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['visualizar']['proveedores'] == "true"): ?>
                        		<input id="checkProveedoresVisualizar2" name="checkProveedoresVisualizar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkProveedoresVisualizar2" name="checkProveedoresVisualizar" type="checkbox">
                        	<?php endif ?>
                           Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['agregar']['proveedores'] == "true"): ?>
                        		<input id="checkProveedoresAgregar2" name="checkProveedoresAgregar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkProveedoresAgregar2" name="checkProveedoresAgregar" type="checkbox">
                        	<?php endif ?>
                           Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['editar']['proveedores'] == "true"): ?>
                        		<input id="checkProveedoresEditar2" name="checkProveedoresEditar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkProveedoresEditar2" name="checkProveedoresEditar" type="checkbox">
                        	<?php endif ?>
                           Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['eliminar']['proveedores'] == "true"): ?>
                        		<input id="checkProveedoresEliminar2" name="checkProveedoresEliminar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkProveedoresEliminar2" name="checkProveedoresEliminar" type="checkbox">
                        	<?php endif ?>
                           Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      Reportes
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['visualizar']['reportes'] == "true"): ?>
                        		<input id="checkReportesVisualizar2" name="checkReportesVisualizar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkReportesVisualizar2" name="checkReportesVisualizar" type="checkbox">
                        	<?php endif ?>
                           Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['agregar']['reportes'] == "true"): ?>
                        		<input id="checkReportesAgregar2" name="checkReportesAgregar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkReportesAgregar2" name="checkReportesAgregar" type="checkbox"> 
                        	<?php endif ?>
                          Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['editar']['reportes'] == "true"): ?>
                        		<input id="checkReportesEditar2" name="checkReportesEditar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkReportesEditar2" name="checkReportesEditar" type="checkbox"> 
                        	<?php endif ?>
                          Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['eliminar']['reportes'] == "true"): ?>
                        		<input id="checkReportesEliminar2" name="checkReportesEliminar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkReportesEliminar2" name="checkReportesEliminar" type="checkbox"> 
                        	<?php endif ?>
                          Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Configuración
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['visualizar']['configuracion'] == "true"): ?>
                        		<input id="checkConfigVisualizar2" name="checkConfigVisualizar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkConfigVisualizar2" name="checkConfigVisualizar" type="checkbox"> 
                        	<?php endif ?>
                          Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['agregar']['configuracion'] == "true"): ?>
                        		<input id="checkConfigAgregar2" name="checkConfigAgregar" type="checkbox"  checked> 	
                        		<?php else: ?>	
                        		<input id="checkConfigAgregar2" name="checkConfigAgregar" type="checkbox"> 
                        	<?php endif ?>
                          Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['editar']['configuracion'] == "true"): ?>
                        		<input id="checkConfigEditar2" name="checkConfigEditar" type="checkbox"checked> 	
                        		<?php else: ?>	
                        		<input id="checkConfigEditar2" name="checkConfigEditar" type="checkbox">
                        	<?php endif ?>
                           Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['eliminar']['configuracion'] == "true"): ?>
                        		<input id="checkConfigEliminar2" name="checkConfigEliminar" type="checkbox"checked> 	
                        		<?php else: ?>	
                        		<input id="checkConfigEliminar2" name="checkConfigEliminar" type="checkbox"> 
                        	<?php endif ?>
                          Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Control de Usuarios
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['agregar']['control_usuarios'] == "true"): ?>
                        		<input id="checkControlUsuVisualizar2" name="checkControlUsuVisualizar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkControlUsuVisualizar2" name="checkControlUsuVisualizar" type="checkbox">
                        	<?php endif ?>
                           Visualizar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['agregar']['control_usuarios'] == "true"): ?>
                        		<input id="checkControlUsuAgregar2" name="checkControlUsuAgregar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkControlUsuAgregar2" name="checkControlUsuAgregar" type="checkbox">
                        	<?php endif ?>                        	
                           Agregar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['editar']['control_usuarios'] == "true"): ?>
                        		<input id="checkControlUsuEditar2" name="checkControlUsuEditar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkControlUsuEditar2" name="checkControlUsuEditar" type="checkbox"> 
                        	<?php endif ?>
                          Editar
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="checkbox">
                        <label>
                        	<?php if ($data['permisos']['eliminar']['control_usuarios'] == "true"): ?>
                        		<input id="checkControlUsuEliminar2" name="checkControlUsuEliminar" type="checkbox" checked> 	
                        		<?php else: ?>	
                        		<input id="checkControlUsuEliminar2" name="checkControlUsuEliminar" type="checkbox">
                        	<?php endif ?>
                           Eliminar
                        </label>
                      </div>
                    </td>
                  </tr>
                  </tbody>
                </table>
                </div>
                <script type="text/javascript">
    
    $("#checkAllVisualizar2").change(function(){

      if($('#checkAllVisualizar2').is(':checked') == true){
        $('#checkInicioVisualizar2').prop("checked", true);
        $('#checkComprasVisualizar2').prop("checked", true);
        $('#checkProductosVisualizar2').prop("checked", true);
        $('#checkCategoriasVisualizar2').prop("checked", true);
        $('#checkFacturacionVisualizar2').prop("checked", true);
        $('#checkClientesVisualizar2').prop("checked", true);
        $('#checkProveedoresVisualizar2').prop("checked", true);
        $('#checkReportesVisualizar2').prop("checked", true);
        $('#checkConfigVisualizar2').prop("checked", true);
        $('#checkControlUsuVisualizar2').prop("checked", true);
        
      }else if($('#checkAllVisualizar2').is(':checked') == false){
        $('#checkInicioVisualizar2').prop("checked", false);
        $('#checkComprasVisualizar2').prop("checked", false);
        $('#checkProductosVisualizar2').prop("checked", false);
        $('#checkCategoriasVisualizar2').prop("checked", false);
        $('#checkFacturacionVisualizar2').prop("checked", false);
        $('#checkClientesVisualizar2').prop("checked", false);
        $('#checkProveedoresVisualizar2').prop("checked", false);
        $('#checkReportesVisualizar2').prop("checked", false);
        $('#checkConfigVisualizar2').prop("checked", false);
        $('#checkControlUsuVisualizar2').prop("checked", false);
      }
    });

      $("#checkAllAgregar2").change(function(){

      if($('#checkAllAgregar2').is(':checked') == true){
        $('#checkInicioAgregar2').prop("checked", true);
        $('#checkComprasAgregar2').prop("checked", true);
        $('#checkProductosAgregar2').prop("checked", true);
        $('#checkCategoriasAgregar2').prop("checked", true);
        $('#checkFacturacionAgregar2').prop("checked", true);
        $('#checkClientesAgregar2').prop("checked", true);
        $('#checkProveedoresAgregar2').prop("checked", true);
        $('#checkReportesAgregar2').prop("checked", true);
        $('#checkConfigAgregar2').prop("checked", true);
        $('#checkControlUsuAgregar2').prop("checked", true);
        
      }else if($('#checkAllAgregar2').is(':checked') == false){
        $('#checkInicioAgregar2').prop("checked", false);
        $('#checkComprasAgregar2').prop("checked", false);
        $('#checkProductosAgregar2').prop("checked", false);
        $('#checkCategoriasAgregar2').prop("checked", false);
        $('#checkFacturacionAgregar2').prop("checked", false);
        $('#checkClientesAgregar2').prop("checked", false);
        $('#checkProveedoresAgregar2').prop("checked", false);
        $('#checkReportesAgregar2').prop("checked", false);
        $('#checkConfigAgregar2').prop("checked", false);
        $('#checkControlUsuAgregar2').prop("checked", false);
      }
    });

      $("#checkAllEditar2").change(function(){

      if($('#checkAllEditar2').is(':checked') == true){
        $('#checkInicioEditar2').prop("checked", true);
        $('#checkComprasEditar2').prop("checked", true);
        $('#checkProductosEditar2').prop("checked", true);
        $('#checkCategoriasEditar2').prop("checked", true);
        $('#checkFacturacionEditar2').prop("checked", true);
        $('#checkClientesEditar2').prop("checked", true);
        $('#checkProveedoresEditar2').prop("checked", true);
        $('#checkReportesEditar2').prop("checked", true);
        $('#checkConfigEditar2').prop("checked", true);
        $('#checkControlUsuEditar2').prop("checked", true);
        
      }else if($('#checkAllEditar2').is(':checked') == false){
        $('#checkInicioEditar2').prop("checked", false);
        $('#checkComprasEditar2').prop("checked", false);
        $('#checkProductosEditar2').prop("checked", false);
        $('#checkCategoriasEditar2').prop("checked", false);
        $('#checkFacturacionEditar2').prop("checked", false);
        $('#checkClientesEditar2').prop("checked", false);
        $('#checkProveedoresEditar2').prop("checked", false);
        $('#checkReportesEditar2').prop("checked", false);
        $('#checkConfigEditar2').prop("checked", false);
        $('#checkControlUsuEditar2').prop("checked", false);
      }
     });
    
    $("#checkAllEliminar2").change(function(){

      if($('#checkAllEliminar2').is(':checked') == true){
        $('#checkInicioEliminar2').prop("checked", true);
        $('#checkComprasEliminar2').prop("checked", true);
        $('#checkProductosEliminar2').prop("checked", true);
        $('#checkCategoriasEliminar2').prop("checked", true);
        $('#checkFacturacionEliminar2').prop("checked", true);
        $('#checkClientesEliminar2').prop("checked", true);
        $('#checkProveedoresEliminar2').prop("checked", true);
        $('#checkReportesEliminar2').prop("checked", true);
        $('#checkConfigEliminar2').prop("checked", true);
        $('#checkControlUsuEliminar2').prop("checked", true);
        
      }else if($('#checkAllEliminar2').is(':checked') == false){
        $('#checkInicioEliminar2').prop("checked", false);
        $('#checkComprasEliminar2').prop("checked", false);
        $('#checkProductosEliminar2').prop("checked", false);
        $('#checkCategoriasEliminar2').prop("checked", false);
        $('#checkFacturacionEliminar2').prop("checked", false);
        $('#checkClientesEliminar2').prop("checked", false);
        $('#checkProveedoresEliminar2').prop("checked", false);
        $('#checkReportesEliminar2').prop("checked", false);
        $('#checkConfigEliminar2').prop("checked", false);
        $('#checkControlUsuEliminar2').prop("checked", false);
      }


    });
  </script>
		<?php

	}
}


public function getFORM_EDIT(){
	if(!$_POST){
		return '';		
	}

	//Logic
	$id = isset($_POST['id']) ? limpiarDatos($_POST['id']) : '';
	$data = $this->model->getUserByID($id);
	//Niveles de Usuario para el Select
	$data['g_usuarios'] = $this->model->getAll_G_Usuarios();

	if($data){

		?>
		<div id="tabs" class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_B_1" data-toggle="tab" aria-expanded="true">Datos Personales</a></li>
              <li class=""><a href="#tab_B_2" data-toggle="tab" aria-expanded="false">Datos de Usuario</a></li>
            </ul>            
            <div  class="tab-content">            
              <div class="tab-pane active" id="tab_B_1">
                
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Nombre</label>
                  <div class="col-sm-10">
                  	<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    <input value="<?php echo $data['nombre'] ?>" name="nombre" type="text"  class="form-control" placeholder="Ingresa el Nombre"  required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>  
                </div>
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Apellido</label>
                  <div class="col-sm-10">
                    <input value="<?php echo $data['apellido'] ?>" name="apellido" type="text"  class="form-control" placeholder="Ingresa el Apellido" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>  
                </div>
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Email</label>
                  <div class="col-sm-10">
                    <input value="<?php echo $data['email'] ?>" name="email" type="email"  class="form-control" placeholder="Ingresa el Email"  onkeyup="this.value = this.value.toUpperCase();">
                  </div>  
                </div>
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">CI</label>
                  <div class="col-sm-10">
                    <input value="<?php echo $data['cedula'] ?>" name="cedula" type="text" id="InputRif-e" class="form-control" pattern="[V|J|P|E][-][0-9]{8,9}" placeholder="Ingresa la Cédula" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                  </div>  
                </div>
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Teléfono</label>
                  <div class="col-sm-10">
                    <input value="<?php echo $data['telefono'] ?>" name="telefono" type="text" id="InputTelefono-e" class="form-control" placeholder="Ingresa el Teléfono" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                  </div>  
                </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_B_2">
                                
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Usuario</label>
                  <div class="col-sm-10">
                    <input value="<?php echo $data['usuario'] ?>" name="usuario" type="text"  class="form-control" placeholder="Ingresa el Usuario" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}" onkeyup="this.value = this.value.toUpperCase();">                  
                  </div>  
                </div>                
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Contraseña</label>
                  <div class="col-sm-10">
                    <input name="contraseña" type="password"  class="form-control" placeholder="">                  
                  </div>  

                </div>
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Repite Contraseña</label>
                  <div class="col-sm-10">
                    <input name="contraseña2" type="password"  class="form-control" placeholder="">  
                    <p class="help-block">(*) Si no la quieres cambiar dejala en blanco</p>                
                  </div>  
                </div>
                
                <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Estado</label>
                  <div class="col-sm-10">
                    <select name="estado" id="EstadoInput" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">
                      <option value="1">Activo</option>
                      <option value="0">Suspendido</option>                                            
                    </select>               
                  </div>  
                </div>
                 <div class="form-group">
                 <label class="col-sm-2 control-label" for="">Grupo Usuario</label>
                  <div class="col-sm-10">
                    <select name="gusuario" id="GUsuarioInput" class="form-control" required oninvalid="setCustomValidity('Rellena este campo');" onchange="try{setCustomValidity('')}catch(e){}">

                    	<?php foreach ($data['g_usuarios'] as $G_usuario): ?>
                    		<option value="<?php echo $G_usuario['id'] ?>"><?php echo $G_usuario['nombre'] ?></option>

                    	<?php endforeach ?>
                                           
                    </select>               
                  </div>  
                </div>

              </div>                        
              <!-- /.tab-pane -->
            </div>            
            <!-- /.tab-content -->
          </div>
          	<script>
          		$(document).ready(function (){
          			$('#EstadoInput').val('<?php echo $data['estado'] ?>');    					
    				$('#GUsuarioInput').val('<?php echo $data['id_fk_grupousuario'] ?>');

    				$("#InputRif-e").inputmask({mask: "A-99999999[9]", greedy: false});      
      				$("#InputTelefono-e").inputmask({mask: "(999)-9999999"});
          		});
          	</script>
		<?php

	}
}

public function editUsuariosAJAX(){
	if(!$_POST){
		return '';		
	}		
	
	//Limpiarmos los datos que vienen del post
	$data['id'] = isset($_POST['id']) ? strtoupper(limpiarDatos($_POST['id'])) : '';	
	$data['nombre'] = isset($_POST['nombre']) ? strtoupper(limpiarDatos($_POST['nombre'])) : '';	
	$data['apellido'] = isset($_POST['apellido']) ? strtoupper(limpiarDatos($_POST['apellido'])) : '';
	$data['email'] = isset($_POST['email']) ? strtoupper(limpiarDatos($_POST['email'])) : '';	
	$data['cedula'] = isset($_POST['cedula']) ? strtoupper(limpiarDatos($_POST['cedula'])) : '';	
	$data['telefono'] = isset($_POST['telefono']) ? strtoupper(limpiarDatos($_POST['telefono'])) : '';	
	$data['estado'] = isset($_POST['estado']) ? strtoupper(limpiarDatos($_POST['estado'])) : 0;
	$data['gusuario'] = isset($_POST['gusuario']) ? strtoupper(limpiarDatos($_POST['gusuario'])) : 0;
	$data['usuario'] = isset($_POST['usuario']) ? strtoupper(limpiarDatos($_POST['usuario'])) : 0;
	$data['password'] = isset($_POST['contraseña']) ? limpiarDatos($_POST['contraseña']) : 0;	
	$data['password2'] = isset($_POST['contraseña2']) ? limpiarDatos($_POST['contraseña2']) : 0;
	
	//Envio de datos al Modelo

	if($data['password'] == $data['password2']){
		$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
		$answer = $this->model->editUsuario($data);
	}
	else{
		$answer = '2020'; //Codigo de contraseña incorrecta
	}
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
                Ya ese Codigo o Usuario existe en la base de datos. Cambialo. Vuelvelo a Intentar.
              </div>
		 <?php

			break;

		case '2020'://error Clave de campo CODIGO Repetida

			?>
			<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                La Contraseña no coincide. Vuelvelo a Intentar.
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

public function edit_GUsuariosAJAX(){
	if(!$_POST){
		return '';		
	}		
	
	//Limpiarmos los datos que vienen del post
	$data['id'] = (isset($_POST['id'])) ? $_POST['id'] : '';				
	$data['nombre'] = (isset($_POST['nombre_gu'])) ? $_POST['nombre_gu'] : '';				
	
		//VISUALIZAR
			$data['permisos']['visualizar']['inicio'] = (isset($_POST['checkInicioVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['compras'] = (isset($_POST['checkComprasVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['productos'] = (isset($_POST['checkProductosVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['categorias'] = (isset($_POST['checkCategoriasVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['facturacion'] = (isset($_POST['checkFacturacionVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['clientes'] = (isset($_POST['checkClientesVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['proveedores'] = (isset($_POST['checkProveedoresVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['reportes'] = (isset($_POST['checkReportesVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['configuracion'] = (isset($_POST['checkConfigVisualizar'])) ? 'true' : 'false';
			$data['permisos']['visualizar']['control_usuarios'] = (isset($_POST['checkControlUsuVisualizar'])) ? 'true' : 'false';

		//AGREGAR
			$data['permisos']['agregar']['inicio'] = (isset($_POST['checkInicioAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['compras'] = (isset($_POST['checkComprasAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['productos'] = (isset($_POST['checkProductosAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['categorias'] = (isset($_POST['checkCategoriasAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['facturacion'] = (isset($_POST['checkFacturacionAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['clientes'] = (isset($_POST['checkClientesAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['proveedores'] = (isset($_POST['checkProveedoresAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['reportes'] = (isset($_POST['checkReportesAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['configuracion'] = (isset($_POST['checkConfigAgregar'])) ? 'true' : 'false';
			$data['permisos']['agregar']['control_usuarios'] = (isset($_POST['checkControlUsuAgregar'])) ? 'true' : 'false';

		//EDITAR
			$data['permisos']['editar']['inicio'] = (isset($_POST['checkInicioEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['compras'] = (isset($_POST['checkComprasEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['productos'] = (isset($_POST['checkProductosEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['categorias'] = (isset($_POST['checkCategoriasEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['facturacion'] = (isset($_POST['checkFacturacionEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['clientes'] = (isset($_POST['checkClientesEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['proveedores'] = (isset($_POST['checkProveedoresEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['reportes'] = (isset($_POST['checkReportesEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['configuracion'] = (isset($_POST['checkConfigEditar'])) ? 'true' : 'false';
			$data['permisos']['editar']['control_usuarios'] = (isset($_POST['checkControlUsuEditar'])) ? 'true' : 'false';
		
		//ELIMINAR
			$data['permisos']['eliminar']['inicio'] = (isset($_POST['checkInicioEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['compras'] = (isset($_POST['checkComprasEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['productos'] = (isset($_POST['checkProductosEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['categorias'] = (isset($_POST['checkCategoriasEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['facturacion'] = (isset($_POST['checkFacturacionEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['clientes'] = (isset($_POST['checkClientesEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['proveedores'] = (isset($_POST['checkProveedoresEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['reportes'] = (isset($_POST['checkReportesEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['configuracion'] = (isset($_POST['checkConfigEliminar'])) ? 'true' : 'false';
			$data['permisos']['eliminar']['control_usuarios'] = (isset($_POST['checkControlUsuEliminar'])) ? 'true' : 'false';
	
	//Envio de datos al Modelo			
	if($data['nombre'] == ''){
			$answer = false;
		}else{
			$answer = $this->model->edit_GUsuario($data);	
		}
	
	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                Grupo de Usuario Editado Correctamente.
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

public function dropUsuariobyIDAJAX(){
	if(!$_POST){
		return '';		
	}		
	//Data del Proveedor
	$id = isset($_POST['id']) ? strtoupper(limpiarDatos($_POST['id'])) : '';                   
	//Envio de datos al Modelo
	$answer = $this->model->dropUsuariobyID($id);	

	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                Usuario Eliminado Correctamente.
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

public function dropGUsuariobyIDAJAX(){
	if(!$_POST){
		return '';		
	}		
	//Data del Proveedor
	$id = isset($_POST['id']) ? strtoupper(limpiarDatos($_POST['id'])) : '';                   
	//Envio de datos al Modelo
	$answer = $this->model->dropGUsuariobyID($id);	

	switch ($answer) {
		case 1:
			
		?>
			<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> ¡Transacción Exitosa!</h4>
                Grupo de Usuario Eliminado Correctamente.
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

}?>
