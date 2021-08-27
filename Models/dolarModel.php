<?php 
//Archivo de la logica, conexion a bd y demás
class dolarModel extends Connection
{
	
	public function __construct()
	{
		parent::__construct();
	}

	
//Funciones de logica y demas
	public function getDolar(){
		if(!$this->con){
			return false;
		}else{
			$query = $this->con->prepare('SELECT * FROM dolar WHERE id=1');		
			$query->execute();
			$results = $query->fetch(PDO::FETCH_ASSOC);
			if ($results) {			
				return $results;
			}else{
				return false;
			}
		}
	}

	public function setDolar($marcaje,$dolar,$seleccion){
		if(!$this->con){
			return false;
		}else{
			$query = $this->con->prepare('UPDATE dolar SET marcaje=:marcaje, precio_dolar=:pd, seleccion=:seleccion WHERE id=1');		
			$query->bindParam(":marcaje", $marcaje);
			$query->bindParam(":pd", $dolar);
			$query->bindParam(":seleccion", $seleccion);
			$results = $query->execute();
			
			if ($results) {			
				return true;
			}else{
				return false;
			}
		}
	}

}?>