<?php 
//Vistas de la clase VENTAS
class Errors extends Controllers {

	public function __construct(){
		
		parent::__construct();
	}


	public function errors(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			header('Location: /SmartShop/');
			exit();
		}
		
	}

public function NotFound(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			$this->views->getView($this,"NotFound");
		}
		

	}

public function ErrorConexion(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			$this->views->getView($this,"ErrorConexion");
		}
		

	}

public function PermisosInsuficientes(){
		if(!isset($_SESSION['id'])){
			header('Location: /SmartShop/Usuarios/Login');			
		}else{
			$this->views->getView($this,"PermisosInsuficientes");
		}
		

	}

}


 ?>