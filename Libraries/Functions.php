<?php 
//FUNCIONES VARIAS V1.0 by ALEJCP



function issetSet($data){
	if (isset($data)) {
		return $data;
	}else{
		return false;
	}
}

function limpiarCorreo($correo) {
	if($correo){
	$correo = filter_var($correo , FILTER_SANITIZE_EMAIL);
	$correo = strtolower($correo);	
	$datos = trim($correo);
	$datos = stripcslashes($correo);

	}else{
	$correo = '';
	}
	
	return $correo;
	
}

function limpiarDatos($datos){
	if($datos){
	$datos = trim($datos);
	$datos = stripcslashes($datos);
	// $datos = filter_var($datos, FILTER_SANITIZE_STRING);
	$datos = htmlspecialchars($datos);
	}

	return $datos;
}
 ?>