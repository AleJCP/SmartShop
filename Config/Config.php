<?php //Archivo de configuración, se deinen constantes, y configuraciones generales

	define('__ROOT', dirname(dirname(__FILE__)));
	//Zona Horaria Caracas
	date_default_timezone_set('America/Caracas');
	setlocale(LC_ALL, "es_ES","Spanish_Spain","Spanish");
	//Url de la app
	const BASE_URL = "http://localhost/SmartShop/";
	const ASSETS = "/SmartShop/Assets/";
	//Directorio de las LIBS
	const LIBS = __ROOT."/Libraries/";

	//Directorio de Vistas
	const VIEWS = __ROOT."/Views/";

	//Directorio de UPLOADS
	const UPLOADS = "/SmartShop/Assets/uploads/";

	//CONS de Base de datos
	const HOST = "localhost";
	const DBNAME = "sshop";
	const DBUSER = "root";
	const DBPASSWORD = "";

 ?>