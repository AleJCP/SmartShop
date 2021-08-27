<?php 
//Archivo de la logica, conexion a bd y demás
class comprasModel extends Connection
{
	
	public function __construct()
	{
		parent::__construct();
	}

	
//Funciones de logica y demas


	public function addCompra($proveedorID,$fecha,$hora,$CompraTmp,$Total_CompraTmp,$TasaDolar){
		if(!$this->con){	//Si no hay conexion retornamos false
			return false;
		}else{		
			//Transacciones, preparamos la sentencia de la compra, luego preparamos las sentencias para cada producto dentro de la tabla productos-compras, luego mandamos la transaccion y recibimos la rspuesta del servidor, en caso de error, echamos para atras la transaccion.			
			$this->startTransaction();
//Insertamos la compra			
			$this->insertTransaction("INSERT INTO `compras`(`id_fk_usuario`, `id_fk_proveedor`, `fecha`,`hora`, `subtotal`, `total`,`total_bss`) VALUES (:id_usuario,:id_proveedor,:fecha,:hora,:subtotal,:total,:total_bss)",array(
					":id_usuario" => $_SESSION['id'],
					":id_proveedor" => $proveedorID,
					":fecha" => $fecha,
					":hora" => $hora,							
					":subtotal" => $Total_CompraTmp['subtotal'],
					":total" => $Total_CompraTmp['total'],
					":total_bss" => number_format((double) $Total_CompraTmp['total'] * $TasaDolar,2,'.',',')			
			));
			//Regojemos el ID del pedido			
			$ID_Compra = $this->last_ID;

			foreach ($CompraTmp as $Producto) {
				$this->insertTransaction("INSERT INTO `compras_productos`(`id_fk_compra`, `id_fk_producto`, `cantidad`, `precio_unidad`, `precio_total`) VALUES (:id_fk_compra,:id_fk_producto,:cantidad,:precio_unidad,:precio_total)",array(
					":id_fk_compra" => $ID_Compra,
					":id_fk_producto" => $Producto['id'],
					":cantidad" => $Producto['Cantidad'] ,
					":precio_unidad" => $Producto['Precio_IND'] ,
					":precio_total" => $Producto['Precio_TOTAL']											
			));
			}
			$result = $this->submitTransaction();
			if($result === true){				
				//En caso de ser verdadero reseteamos las variables Temporales de la compra
				$_SESSION['CompraTmp'] = array();
				$_SESSION['Total_CompraTmp'] = array();
				return true;
			}else{
				return false;
			}
			//Uso de transacciones para agregar los productos a la tabla compra-productos, añadir los productos al inventario, y añadir el registro de la compra en la Base de datos.			
 		}
	}

	public function updateComprabyID($id,$parametros){		
	}
	

	public function dropComprabyID($id){

	}

	// public function getAllDataComprabyID($id){	
	// 	if(!$this->con){
	// 	return false;
	// 	}else{		
	// 		$q = isset($q) ? $q . '%' : '';
	// 		$query = $this->con->prepare('SELECT compras.id, usuarios.usuario, proveedores.nombre_empresa, compras.fecha, compras.subtotal, compras.total FROM `compras` INNER JOIN usuarios ON compras.id_fk_usuario = usuarios.id INNER JOIN proveedores ON compras.id_fk_proveedor=proveedores.id WHERE compras.id LIKE :query1 OR proveedores.nombre_empresa LIKE :query2 LIMIT :inicio,:final');			
	// 		$query->execute();
	// 		$results = $query->fetchAll(PDO::FETCH_ASSOC);
	// 		if ($results) 
	// 		{			
	// 			return $results;
	// 		}
 // 		}	
	// }

	public function getAllComprasforReports($desde,$hasta,$id_usu){
		if(!$this->con){
			return false;
		}else{		
			if($id_usu){
				$query = $this->con->prepare('SELECT compras.id, usuarios.usuario, proveedores.nombre_empresa, compras.fecha, compras.subtotal, compras.total FROM `compras` INNER JOIN usuarios ON compras.id_fk_usuario = usuarios.id INNER JOIN proveedores ON compras.id_fk_proveedor=proveedores.id WHERE compras.id_fk_usuario = :id_usu AND compras.fecha BETWEEN :desde AND :hasta ORDER BY fecha');
				$query->bindParam(':desde', $desde);
				$query->bindParam(':hasta', $hasta);
				$query->bindParam(':id_usu',$id_usu);								
				$query->execute();
				$results = $query->fetchAll(PDO::FETCH_ASSOC);
				if ($results) {			
					return $results;
				}
			}else{
				$query = $this->con->prepare('SELECT compras.id, usuarios.usuario, proveedores.nombre_empresa, compras.fecha, compras.subtotal, compras.total FROM `compras` INNER JOIN usuarios ON compras.id_fk_usuario = usuarios.id INNER JOIN proveedores ON compras.id_fk_proveedor=proveedores.id WHERE compras.fecha BETWEEN :desde AND :hasta ORDER BY fecha');
				$query->bindParam(':desde', $desde);
				$query->bindParam(':hasta', $hasta);
				$query->execute();
				$results = $query->fetchAll(PDO::FETCH_ASSOC);
				if ($results) {			
					return $results;
				}
			}

 		}

	}	

public function getAllComprasforPagination($inicio,$artporpagina,$q){
	if(!$this->con){
		return false;
	}else{		
		$q = isset($q) ? $q . '%' : '';
		$query = $this->con->prepare('SELECT compras.id, usuarios.usuario, proveedores.nombre_empresa, compras.fecha, compras.subtotal, compras.total FROM `compras` INNER JOIN usuarios ON compras.id_fk_usuario = usuarios.id INNER JOIN proveedores ON compras.id_fk_proveedor=proveedores.id WHERE compras.id LIKE :query1 OR proveedores.nombre_empresa LIKE :query2 ORDER BY fecha LIMIT :inicio,:final');
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

 public function getTotalCompras($params=''){
	if(!$this->con){
		return false;
	}else{		
		if($params != ''){
			$params = isset($params) ? $params . '%' : '';
			$query = $this->con->prepare('SELECT compras.id, usuarios.usuario, proveedores.nombre_empresa, compras.fecha, compras.subtotal, compras.total FROM `compras` INNER JOIN usuarios ON compras.id_fk_usuario = usuarios.id INNER JOIN proveedores ON compras.id_fk_proveedor=proveedores.id WHERE compras.id LIKE :query1 OR proveedores.nombre_empresa LIKE :query2 ORDER BY fecha');
			$query->bindParam(':query1',$params);				
			$query->bindParam(':query2',$params);		
			$query->execute();
		}else{
			$query = $this->con->prepare('SELECT compras.id, usuarios.usuario, proveedores.nombre_empresa, compras.fecha, compras.subtotal, compras.total FROM `compras` INNER JOIN usuarios ON compras.id_fk_usuario = usuarios.id INNER JOIN proveedores ON compras.id_fk_proveedor=proveedores.id ORDER BY fecha');				
			$query->execute();	
		}

		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {						
			return (count($results));
		}

 }

 }






}?>
