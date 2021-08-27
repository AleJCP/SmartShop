<?php 
//Archivo de la logica, conexion a bd y demás
class settingsModel extends Connection
{
	
	public function __construct()
	{
		parent::__construct();
	}

	
//Funciones de logica y demas

	function getAllInfoEmpresa(){
		if(!$this->con){
			return false;	
		}else{
			$query = $this->con->prepare('SELECT * FROM empresa');		
			$query->execute();
			$results = $query->fetch(PDO::FETCH_ASSOC);
			if ($results) {			
				return $results;
			}else{
				return false;
			}
		}
	}


	function editPerfilEmpresa($data){
		if(!$this->con){
			return false;	
		}else{

			if(move_uploaded_file($_FILES['image']['tmp_name'], __ROOT.'/Assets/uploads/'.$data['upload_file']['nombre']) || $data['upload_file']['nombre'] == 'SSlogo.png') {
			
				$query = $this->con->prepare('UPDATE `empresa` SET nombre_empresa=:nombre, rif=:rif,telefono=:telefono,email=:email,logo=:logo,calle=:calle,ciudad=:ciudad,estado=:estado,pais=:pais,cod_postal=:cod WHERE id=1');

				$query->bindParam(':nombre', $data['nombre']);		
				$query->bindParam(':rif', $data['rif']);		
				$query->bindParam(':telefono', $data['telefono']);	
				$query->bindParam(':email', $data['correo']);	
				$query->bindParam(':logo', $data['upload_file']['nombre']);	
				$query->bindParam(':calle', $data['calle']);				
				$query->bindParam(':ciudad', $data['ciudad']);			
				$query->bindParam(':estado', $data['estado']);	
				$query->bindParam(':pais', $data['pais']);				
				$query->bindParam(':cod', $data['cod_postal']);			
				try {
					$results = $query->execute();	
				} catch (PDOException $e) {
					$error = $e->getCode();
				}
				if ($results) {			
					return $results;
				}else{
					return false;
				}
			}		
		}
	}






}?>