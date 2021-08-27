<?php 
class Views{

	function getView($controller, $view,$data=[]){

	// //Control de las SESIONES
	// 	if($view != "login" && (!isset($_SESSION['id']))){
	// 		header('Location: /SmartShop/Usuarios/login');			
	// 		die();
	// 	}elseif($view == "login" && isset($_SESSION['id'])){
	// 		header('Location: /SmartShop/');
	// 		die();		
	// 	}

		$controller = get_class($controller);
		if ($controller == "Home") {
			$view = VIEWS.$controller.".php";
		}else{
		$view = VIEWS.$controller."/".$view.".php";

		}		

		require_once($view);



	}

}




 ?>