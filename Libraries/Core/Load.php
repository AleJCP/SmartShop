<?php  //Load
//Carga de controlador, preguntamos si existe, en ese caso lo requerimos.	
	$controllerFile = "Controllers/" .$controller.".php";
	if (file_exists($controllerFile)) {
		
		require_once($controllerFile);
		//Instanciamos el objeto, preguntamos si existe el metodo, si existe, lo ejecutamos con los parametros
		$controller = new $controller();
		if (method_exists($controller, $method)) {
			$controller->$method($params);
		}	else{
			header("Location: /SmartShop/Errors/NotFound");
			// echo "No existe el metodo <br>";
		}
	}else {
		header("Location: /SmartShop/Errors/NotFound");
		// echo "No existe el controlador <br>";
	}


?>