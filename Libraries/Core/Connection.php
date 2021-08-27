<?php 
class Connection
{
	public $err;
	public $con;
	public $last_ID;
//Metodo de conexion.
	public function __construct(){
		try {

	$this->con = new PDO('mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8', DBUSER, DBPASSWORD);

	$this->con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//PDO::ERRMODE_SILENT y PDO::ERRMODE_WARNING.
	$this->con ->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	
	}catch(PDOException $e){
	$this->con = false;
	$this->err = $e;
	}
	}
//Transacciones.
public function startTransaction(){
	$this->con->beginTransaction();
}

public function insertTransaction($sql,$params){
	$sentencia = $this->con->prepare($sql);
	$sentencia->execute($params);
	$this->last_ID = $this->con->lastInsertId();
}

public function submitTransaction(){
	try {
		$this->con->commit();
	} catch (PDOException $e) {
		$this->con->rollBack();
		return $e;
	}
	return true;
}

}?>