<?php 
//Archivo de la logica, conexion a bd y demás
class proveedoresModel extends Connection
{
	
	public function __construct()
	{
		parent::__construct();
	}

	
//Funciones de logica y demas
	public function getAllProveedores(){
	if(!$this->con){

	}else{		
		$query = $this->con->prepare('SELECT * FROM proveedores');		
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}else{
			return false;
	}
 }
	}


	public function getDataofProveedorbyID($id){
		if(!$this->con){

		}else{								
			$query = $this->con->prepare('SELECT * FROM proveedores WHERE id = :id');
			$query->bindParam(':id', $id);
			$query->execute();
			$data = $query->fetch(PDO::FETCH_ASSOC);			
			if($data){
				return $data;
			}else{
				return false;			
			}
		}
	}


public function addProveedor($data){
	if(!$this->con){
		return false;
	}else{								
			$query = $this->con->prepare('INSERT INTO `proveedores`(`nombre_empresa`, `rif`, `sitio_web`, `nombre`, `apellido`, `telefono`, `email`, `local_nro`, `calle`, `sector`, `ciudad`, `estado`, `cod_postal`, `pais`, `f_registro`) VALUES (:nombre_empresa, :rif, :sitio_web, :nombre, :apellido, :telefono, :email, :local_nro, :calle, :sector, :ciudad, :estado, :cod_postal, :pais, :f_registro)');
			$query->bindParam(':nombre_empresa', $data['nombre_empresa']);		
			$query->bindParam(':rif', $data['rif']);		
			$query->bindParam(':sitio_web', $data['sitio_web']);	
			$query->bindParam(':nombre', $data['nombre']);	
			$query->bindParam(':apellido', $data['apellido']);	
			$query->bindParam(':telefono', $data['telefono']);				
			$query->bindParam(':email', $data['email']);			
			$query->bindParam(':local_nro', $data['local_nro']);	
			$query->bindParam(':calle', $data['calle']);							
			$query->bindParam(':sector', $data['sector']);				
			$query->bindParam(':ciudad', $data['ciudad']);				
			$query->bindParam(':estado', $data['estado']);				
			$query->bindParam(':cod_postal', $data['cod_postal']);							
			$query->bindParam(':pais', $data['pais']);
			$query->bindParam(':f_registro', $data['f_registro']);
			try {
				$results = $query->execute();	
			} catch (PDOException $e) {
				$error = $e->getCode();
			}
			
			
			if(isset($results)){			
				return true;
			}elseif(isset($error)){
				return $error;
			}			
 	}

 }

public function updateProveedorbyID($data){
	if(!$this->con){
		return false;
	}else{								
			$query = $this->con->prepare('UPDATE `proveedores` SET `nombre_empresa`=:nombre_empresa, `rif`=:rif, `sitio_web` = :sitio_web, `nombre` = :nombre, `apellido`=:apellido,`telefono`= :telefono, `email`=:email,`local_nro`=:local_nro,`calle`=:calle,`sector`=:sector, `ciudad`=:ciudad,`estado`=:estado, `cod_postal`=:cod_postal,`pais`=:pais WHERE id=:id');
			$query->bindParam(':id', $data['id']);
			$query->bindParam(':nombre_empresa', $data['nombre_empresa']);		
			$query->bindParam(':rif', $data['rif']);		
			$query->bindParam(':sitio_web', $data['sitio_web']);	
			$query->bindParam(':nombre', $data['nombre']);	
			$query->bindParam(':apellido', $data['apellido']);	
			$query->bindParam(':telefono', $data['telefono']);				
			$query->bindParam(':email', $data['email']);			
			$query->bindParam(':local_nro', $data['local_nro']);	
			$query->bindParam(':calle', $data['calle']);							
			$query->bindParam(':sector', $data['sector']);				
			$query->bindParam(':ciudad', $data['ciudad']);				
			$query->bindParam(':estado', $data['estado']);				
			$query->bindParam(':cod_postal', $data['cod_postal']);							
			$query->bindParam(':pais', $data['pais']);				
			try {
				$results = $query->execute();				
			} catch (PDOException $e) {
				$error = $e->getCode();
			}
			
			
			if(isset($results) && $results == true){			
				return true;
			}elseif(isset($error)){
				return $error;
			}			
 	}

 }

public function dropProveedorbyID($id){
	if(!$this->con){
		return false;
	}else{								
			$query = $this->con->prepare('DELETE FROM `proveedores` WHERE id=:id');
			$query->bindParam(':id', $id);			
			try {
				$results = $query->execute();	
			} catch (PDOException $e) {
				$error = $e->getCode();
			}						
			
			if(isset($results)){	
				return true;
			}elseif(isset($error)){
				return $error;
			}			
 	}

 }


 public function getAllProveedoresforPagination($inicio,$artporpagina,$q){
	if(!$this->con){
		return false;
	}else{		
		$q = isset($q) ? $q . '%' : '';
		$query = $this->con->prepare('SELECT * FROM proveedores WHERE nombre LIKE :query1 OR rif LIKE :query2 LIMIT :inicio,:final');
		$query->bindParam(':inicio', $inicio);
		$query->bindParam(':final', $artporpagina);
		$query->bindParam(':query1',$q);				
		$query->bindParam(':query2',$q);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}

 }

 }

  public function getTotalProveedores($params=''){
	if(!$this->con){
		return false;
	}else{		
		if($params != ''){
			$params = isset($params) ? $params . '%' : '';
			$query = $this->con->prepare('SELECT * FROM proveedores WHERE nombre LIKE :query1 OR rif LIKE :query2');
			$query->bindParam(':query1',$params);				
			$query->bindParam(':query2',$params);		
			$query->execute();
		}else{
			$query = $this->con->prepare('SELECT * FROM proveedores');				
			$query->execute();	
		}

		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {						
			return (count($results));
		}

 }

 }


}?>