<?php
//Archivo que trae la clase del controlador y de la vista
//Manejo de sesiones
session_start();
//LLamamos el archivo de configuracion
require_once("Config/Config.php");
//Archivo Maestro de funciones
require_once(LIBS."functions.php");



	//Capturamos la Url mediante GET, en el modelo MVC, se trabaja con la URL para:
//Llamar al controlador en la primera parte del url
//En la segunda, llamammos al metodo, y la tercera son los parametros
	$url = isset($_GET['url']) ? $_GET['url'] : 'home';	
	//La url la convertimos en un array, para separar, el controlador, el metodo y los parametros

	$arrUrl = explode("/", $url);
	$controller = $arrUrl[0];
	$method = isset($arrUrl[1]) && !empty($arrUrl[1]) && $arrUrl[1] != "" ? $arrUrl[1] : $arrUrl[0];		
	$params = "";

	//Verificamos su vienen parametros, en ese caso, los guardamos en la variable, params, con un for, separando los metodos por comas.	
	if(isset($arrUrl[2]) && !empty($arrUrl[2])){

		for ($i=2; $i < count($arrUrl) ; $i++) { 
			$params .= $arrUrl[$i] . ",";
		}
	}
//Eliminamos las comas extras en el final.
	$params = trim($params,",");
//Limpieza de Variables
	$controller = limpiardatos($controller);
	$method = limpiardatos($method);
	$params = limpiardatos($params);

//Cargamos la clase
require_once(LIBS."Core/autoload.php");
//Cargamos el metodo y los parametros
require_once(LIBS."Core/load.php");
?>