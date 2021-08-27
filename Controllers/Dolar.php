<?php 
//Vistas de la clase HOME
class Dolar extends Controllers {



	public function __construct(){
		
		parent::__construct();
	}

	public function setDolarTo_DB(){
		if(!$_POST){
			return '';			
		}else{
			$dolar = $_POST['dolar'] ? limpiarDatos($_POST['dolar']) : '';
			$seleccion = $_POST['seleccion'] ? limpiarDatos($_POST['seleccion']) : '';
			$marcaje = $_POST['marcaje'] ? limpiarDatos($_POST['marcaje']) : '';							
			if($this->model->setDolar($marcaje, $dolar,$seleccion)){
				?>
				<div class="alert alert-success alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	<h4><i class="icon fa fa-check"></i> Transacción Exitosa!</h4>
                	Tasa del Dolar cambiada correctamente.
            	</div>
            	<?php
            	die();
			}else{
				?>
				<div class="alert alert-danger alert-dismissible">
                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                	<h4><i class="icon fa fa-ban"></i> ¡Error!</h4>
                	Vuelvelo a Intentar.
              	</div>
            	<?php
            	die();
			}
		}
	}

		public function getDolarfrom_DB(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{			
				$data = $this->model->getDolar();				
			if($data){				
				if($data['precio_dolar']){					
					$data['respuesta'] = 1;
					$_SESSION['precio_dolar'] = $data['precio_dolar'];
					header('Content-Type: application/json');					
					echo json_encode($data);
				}else{
				$data['respuesta'] = 0;				
				header('Content-Type: application/json');					
				echo json_encode($data);
			}	
			}else{
				$data['respuesta'] = 0;
				header('Content-Type: application/json');					
				echo json_encode($data);
			}			
		}		
	}

	public function update_Dolar($dolar,$seleccion){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{							
			if(!(empty($seleccion) || empty($dolar))){
				$_SESSION['dolar']['seleccion_dolar'] = $seleccion;
				$_SESSION['dolar']['dolar'] = $dolar;
				return true;								
			}
		}		
	}



}?>