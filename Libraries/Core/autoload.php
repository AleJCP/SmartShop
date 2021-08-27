<?php  //AutoLoad de las clases de las librerias
	spl_autoload_register(function($class){
		//Autoload para Clases del Modelo
		$modelFile = "Models/" .$class.".php";
		if (file_exists($modelFile)) {		
			require_once($modelFile);		
		}
		//Para Librerias
		if (file_exists(LIBS.'Core/' .$class.'.php')) {
			require_once(LIBS.'Core/' .$class.'.php');			
		}});	
	
?>		