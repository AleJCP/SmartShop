<?php 
//Archivo de la logica, conexion a bd y demás
class usuariosModel extends Connection
{
	
	public function __construct()
	{
		parent::__construct();
	}

	
//Funciones de logica y demas

//LOGIN
public function tryLogin($usuario,$password){
	if(!$this->con){

	}else{
		$query = $this->con->prepare('SELECT * FROM usuarios WHERE usuario = :usuario');
		$query->bindParam(':usuario', $usuario);
		$query->execute();
		$results = $query->fetch();

		if ($results) {
			//We bring data from the database
			$id = $results['id'];
			$passHash = $results['password'];
			$g_usuario = $results['id_fk_grupousuario'];


			if(password_verify($password, $passHash)) {
				//IF this is true, we proceed to start the users session with the ID
				//Remember that we have to bring the users permisions from the JSON object of the database
				$_SESSION['id'] = $id;
				$_SESSION['nombre'] = $usuario;				
				$_SESSION['user_group'] = $this->getPermisionsByID($g_usuario);			


				return true;
			}
		}else{

			return false;
		}		
	}

 }

 //USER
 public function getUserByID($id){

 	if(!$this->con){

	}else{		
		$query = $this->con->prepare('SELECT * FROM usuarios WHERE id = :id');
		$query->bindParam(':id', $id);
		$query->execute();
		$results = $query->fetch(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}

 }

}

public function getAll_G_Usuarios(){
	if(!$this->con){

	}else{		
		$query = $this->con->prepare('SELECT * FROM gruposusuarios');		
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
		}else{
			return false;
		}
	}
}

 public function getAllUsuarios(){
	if(!$this->con){
		return false;
	}else{		
		$q = isset($q) ? $q . '%' : '';
		$query = $this->con->prepare('SELECT * FROM usuarios');					
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}

 }

 }


//USERS GROUP
 public function getPermisionsByID($id){

 	if(!$this->con){

	}else{		
		$query = $this->con->prepare('SELECT * FROM gruposusuarios WHERE id = :id');
		$query->bindParam(':id', $id);
		$query->execute();
		$results = $query->fetch(PDO::FETCH_ASSOC);
		if ($results) {			
			$data['id'] = $results['id'];
			$data['nombre'] = $results['nombre'];
			$data['permisos'] = json_decode($results['permisos'], true);	
			return $data;		
	}else{
		return false;
	}
 }

}

 public function getPermissionsOfUsersByUSERID($id){

 	if(!$this->con){

	}else{		
		$query = $this->con->prepare('SELECT * FROM usuarios WHERE id = :id');
		$query->bindParam(':usuario', $id);
		$query->execute();
		$results = $query->fetch(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results['id_fk_grupousuario'];

	}

 }

}

public function MostrarVariable($var,$type){
	if($type == 'vardump'){
		var_dump($var);
	}elseif($type == 'echo'){
		echo $var;
	}
}

//Paginación AJAX
 public function getAllUsuariosforPagination($inicio,$artporpagina,$q){
	if(!$this->con){
		return false;
	}else{		
		$q = isset($q) ? $q . '%' : '';
		$query = $this->con->prepare('SELECT usuarios.id, gruposusuarios.nombre as grupousuario, usuarios.usuario, usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.telefono, usuarios.estado FROM usuarios INNER JOIN gruposusuarios ON usuarios.id_fk_grupousuario = gruposusuarios.id WHERE usuarios.nombre LIKE :query1 OR usuario LIKE :query2 LIMIT :inicio,:final');
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

  public function getTotalUsuarios($params=''){
	if(!$this->con){
		return false;
	}else{		
		if($params != ''){
			$params = isset($params) ? $params . '%' : '';
			$query = $this->con->prepare('SELECT usuarios.id, gruposusuarios.nombre as grupousuario, usuarios.usuario, usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.telefono, usuarios.estado FROM usuarios INNER JOIN gruposusuarios ON usuarios.id_fk_grupousuario = gruposusuarios.id WHERE usuarios.nombre LIKE :query1 OR usuario LIKE :query2');
			$query->bindParam(':query1',$params);				
			$query->bindParam(':query2',$params);		
			$query->execute();
		}else{
			$query = $this->con->prepare('SELECT usuarios.id, gruposusuarios.nombre as grupousuario, usuarios.usuario, usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.telefono, usuarios.estado FROM usuarios INNER JOIN gruposusuarios ON usuarios.id_fk_grupousuario = gruposusuarios.id');				
			$query->execute();	
		}

		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {						
			return (count($results));
		}

 }

 }

 //Paginación AJAX
 public function getAll_GUsuariosforPagination($inicio,$artporpagina,$q){
	if(!$this->con){
		return false;
	}else{		
		$q = isset($q) ? $q . '%' : '';
		$query = $this->con->prepare('SELECT * FROM gruposusuarios WHERE nombre LIKE :query1 LIMIT :inicio,:final');
		$query->bindParam(':inicio', $inicio);
		$query->bindParam(':final', $artporpagina);
		$query->bindParam(':query1',$q);						
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}

 }

 }

  public function getTotal_GUsuarios($params=''){
	if(!$this->con){
		return false;
	}else{		
		if($params != ''){
			$params = isset($params) ? $params . '%' : '';
			$query = $this->con->prepare('SELECT * FROM gruposusuarios WHERE nombre LIKE :query1 LIMIT :inicio,:final');
			$query->bindParam(':query1',$params);							
			$query->execute();
		}else{
			$query = $this->con->prepare('SELECT * FROM gruposusuarios');				
			$query->execute();	
		}

		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {						
			return (count($results));
		}

 }

 }

public function addUsuario($data){
	if(!$this->con){
		return false;
	}else{								
			$query = $this->con->prepare('INSERT INTO `usuarios` (`nombre`, `apellido`, `email`, `cedula`, `telefono`, `estado`, `id_fk_grupousuario`, `usuario`, `password`) VALUES (:nombre, :apellido, :email, :cedula ,:telefono, :estado, :id_fk_grupousuario, :usuario, :password)');
			$query->bindParam(':nombre', $data['nombre']);		
			$query->bindParam(':apellido', $data['apellido']);		
			$query->bindParam(':email', $data['email']);	
			$query->bindParam(':cedula', $data['cedula']);
			$query->bindParam(':telefono', $data['telefono']);			
			$query->bindParam(':estado', $data['estado']);	
			$query->bindParam(':id_fk_grupousuario', $data['gusuario']);	
			$query->bindParam(':usuario', $data['usuario']);	
			$query->bindParam(':password', $data['password']);

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

public function editUsuario($data){
	if(!$this->con){
		return false;
	}else{								
		if($data['password2'] != ''){			
			$query = $this->con->prepare('UPDATE  `usuarios` SET `nombre`=:nombre, `apellido`=:apellido, `email`=:email, `cedula`=:cedula , `telefono`=:telefono, `estado`=:estado, `id_fk_grupousuario`=:id_fk_grupousuario, `usuario`=:usuario, `password`=:password WHERE id=:id');
			$query->bindParam(':id', $data['id']);		
			$query->bindParam(':nombre', $data['nombre']);		
			$query->bindParam(':apellido', $data['apellido']);		
			$query->bindParam(':email', $data['email']);	
			$query->bindParam(':cedula', $data['cedula']);
			$query->bindParam(':telefono', $data['telefono']);			
			$query->bindParam(':estado', $data['estado']);	
			$query->bindParam(':id_fk_grupousuario', $data['gusuario']);	
			$query->bindParam(':usuario', $data['usuario']);	
			$query->bindParam(':password', $data['password']);
						

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
		}else{
			
			$query = $this->con->prepare('UPDATE  `usuarios` SET `nombre`=:nombre, `apellido`=:apellido, `email`=:email, `cedula`=:cedula , `telefono`=:telefono, `estado`=:estado, `id_fk_grupousuario`=:id_fk_grupousuario, `usuario`=:usuario WHERE id=:id');
			$query->bindParam(':id', $data['id']);		
			$query->bindParam(':nombre', $data['nombre']);		
			$query->bindParam(':apellido', $data['apellido']);		
			$query->bindParam(':email', $data['email']);	
			$query->bindParam(':cedula', $data['cedula']);
			$query->bindParam(':telefono', $data['telefono']);			
			$query->bindParam(':estado', $data['estado']);	
			$query->bindParam(':id_fk_grupousuario', $data['gusuario']);	
			$query->bindParam(':usuario', $data['usuario']);				
						
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
}

public function dropUsuariobyID($id){
	if(!$this->con){
		return false;
	}else{								
			$query = $this->con->prepare('DELETE FROM `usuarios` WHERE id=:id');
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
 public function dropGUsuariobyID($id){
	if(!$this->con){
		return false;
	}else{			

			$this->startTransaction();
//Borramos todos los usuarios del grupo de usuario 
			$this->insertTransaction("DELETE FROM `usuarios` WHERE id_fk_grupousuario=:id",array(
					":id" => $id				
			));

			$this->insertTransaction("DELETE FROM `gruposusuarios` WHERE id=:id",array(
					":id" => $id					
			));

			
			try {
				$result = $this->submitTransaction();	
			} catch (PDOException $e) {
				$error = $e->getCode();
			}						
			
			if(isset($result)){	
				return true;
			}elseif(isset($error)){
				return $error;
			}			
 	}

 }

public function add_GUsuario($data){
	if(!$this->con){
		return false;
	}else{								
			$data['permisos'] = json_encode($data['permisos']);
			$query = $this->con->prepare('INSERT INTO `gruposusuarios` (`nombre`, `permisos`) VALUES (:nombre, :permisos)');
			$query->bindParam(':nombre', $data['nombre']);		
			$query->bindParam(':permisos',$data['permisos']);		
			

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


public function edit_GUsuario($data){
	if(!$this->con){
		return false;
	}else{				
			

			$data['permisos'] = json_encode($data['permisos']);
			$query = $this->con->prepare('UPDATE `gruposusuarios` SET `nombre`=:nombre, `permisos`=:permisos WHERE `id`=:id');
			$query->bindParam(':id',$data['id']);		
			$query->bindParam(':nombre', $data['nombre']);		
			$query->bindParam(':permisos',$data['permisos']);			
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

}?>
