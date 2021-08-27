<?php 
//Vistas de la clase VENTAS
class Settings extends Controllers {

	public function __construct(){
		
		parent::__construct();
	}


	public function Settings(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmarShop/Usuarios/login');
		}else{
			$this->views->getView($this,"Settings");
		}

	}

	public function PerfilEmpresa(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmarShop/Usuarios/login');
		}else{
			$data = $this->model->getAllInfoEmpresa();
			$this->views->getView($this,"PerfilEmpresa",$data);
		}
		

	}

	public function AjustesGenerales(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmarShop/Usuarios/login');
		}else{
			$this->views->getView($this,"AjustesGenerales");			
		}

	}

	public function editPerfilEmpresaAJAX(){
		if(!$_POST){
			return '';
		}else{
			$data['nombre']	= isset($_POST['nombre']) ? limpiarDatos($_POST['nombre']) : '';
			$data['rif']	= isset($_POST['rif']) ? limpiarDatos($_POST['rif']) : '';
			$data['correo']	= isset($_POST['correo']) ? limpiarDatos($_POST['correo']) : '';
			$data['telefono']	= isset($_POST['telefono']) ? limpiarDatos($_POST['telefono']) : '';
			$data['calle']	= isset($_POST['calle']) ? limpiarDatos($_POST['calle']) : '';
			$data['ciudad']	= isset($_POST['ciudad']) ? limpiarDatos($_POST['ciudad']) : '';
			$data['estado']	= isset($_POST['estado']) ? limpiarDatos($_POST['estado']) : '';
			$data['pais']	= isset($_POST['pais']) ? limpiarDatos($_POST['pais']) : '';
			$data['cod_postal']	= isset($_POST['cod_postal']) ? limpiarDatos($_POST['cod_postal']) : '';			

		//Comprobamos que el Archivo enviado se llame distinto a la imagen por defecto
			if($_FILES['image']['name'] == 'SSlogo.png'){
				?>
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-ban"></i> Error!</h4>
					Cambia el nombre a la imagen. Vuelve a Intentarlo.
				</div>
				<?php die();
			}
		//Seteamos las variables del las variables temporales con la condicion de colocarla default si no existe
			$data['upload_file']['nombre'] = (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') ? $_FILES['image']['name'] : 'SSlogo.png';
			$data['upload_file']['tipo'] = (isset($_FILES['image']['type']) && $_FILES['image']['type'] != '') ? $_FILES['image']['type'] : 'image/jpg';
			$data['upload_file']['tamaño'] = $_FILES['image']['size'];						
		//Validacion de la imagen
			if(!($_FILES['image']['error'] === UPLOAD_ERR_OK || $data['upload_file']['nombre'] == 'SSlogo.png')){
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
			$answer = $this->model->editPerfilEmpresa($data);

			switch ($answer) {
				case 1:

				?>
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-check"></i> ¡Transacción Exitosa!</h4>
					Ajustes Cambiados Correctamente.
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
}



}?>