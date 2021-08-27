<?php 
//Archivo de la logica, conexion a bd y demás
class ventasModel extends Connection
{
	
	public function __construct()
	{
		parent::__construct();
	}

	
//Funciones de logica y demas


	public function addVenta($data,$VentaTmp,$Total_VentaTmp){
		if(!$this->con){	//Si no hay conexion retornamos false
			return false;
		}else{		
			//Transacciones, preparamos la sentencia de la venta, luego preparamos las sentencias para cada producto dentro de la tabla productos-ventas, luego mandamos la transaccion y recibimos la rspuesta del servidor, en caso de error, echamos para atras la transaccion.			
			$this->startTransaction();			
//Insertamos la venta			
			$this->insertTransaction("INSERT INTO `ventas`(`id_fk_usuario`, `id_fk_cliente`, `estado`,`fecha`, `hora`,`total_monto_abonado`, `cambio`,  `subtotal`, `total`,`tasa_dolar`) VALUES (:id_usuario,:id_cliente,:estado,:fecha,:hora,:total_monto_abonado,:cambio,:subtotal,:total,:tasa_dolar)",array(
					":id_usuario" => $_SESSION['id'],
					":id_cliente" => $data['clienteID'],
					":estado" => $data['estado'],
					":fecha" => $data['fecha'],														
					":hora" => $data['hora'],
					":total_monto_abonado" => $data['total_monto_abonado'],
					":cambio" => $data['cambio'],						
					":subtotal" => $Total_VentaTmp['subtotal'],
					":total" => $Total_VentaTmp['total'],				
					":tasa_dolar" => $_SESSION['precio_dolar']
			));
			//Regojemos el ID del pedido			
			$ID_Venta = $this->last_ID;
			//Tabla abonos			
			if(isset($data['metodo_pago'])){
				foreach ($data['metodo_pago'] as $key => $value) {		
					$this->insertTransaction("INSERT INTO `abonos`(`id_fk_venta`, `id_fk_cliente`, `fecha`, `hora`, `metodo_pago`, `monto_pagar`, `nro_referencia`) VALUES (:id_fk_venta,:id_fk_cliente,:fecha,:hora,:metodo_pago,:monto_pagar,:nro_referencia)",array(
							":id_fk_venta" => $ID_Venta,
							":id_fk_cliente" => $data['clienteID'],
							":fecha" => $data['fecha'],
							":hora" => $data['hora'],
							":metodo_pago" => $data['metodo_pago'][$key],
							":monto_pagar" => $data['monto_pagar'][$key],
							":nro_referencia" => $data['nro_referencia'][$key]						
						));
				}
			}
			//Tabla productos
			foreach ($VentaTmp as $Producto) {
				$this->insertTransaction("INSERT INTO `ventas_productos`(`id_fk_venta`, `id_fk_producto`, `cantidad`, `precio_unidad`, `precio_total`) VALUES (:id_fk_venta,:id_fk_producto,:cantidad,:precio_unidad,:precio_total)",array(
					":id_fk_venta" => $ID_Venta,
					":id_fk_producto" => $Producto['id'],
					":cantidad" => $Producto['Cantidad'] ,
					":precio_unidad" => $Producto['Precio_IND'] ,
					":precio_total" => $Producto['Precio_TOTAL']											
			));
			}
			$result = $this->submitTransaction();
			if($result === true){				
				//En caso de ser verdadero reseteamos las variables Temporales de la Venta
				$_SESSION['VentaTmp'] = array();
				$_SESSION['Total_VentaTmp'] = array();
				return true;
			}else{
				return false;
			}
			//Uso de transacciones para agregar los productos a la tabla Venta-productos, añadir los productos al inventario, y añadir el registro de la venta en la Base de datos.			
 		}
	}

	public function updateVentabyID($id){		
	}

	public function editVentabyID($id){

	}

	public function deleteVentabyID($id){

	}

	public function getVentasPorPagarByClienteID($ID){
		if(!$this->con){
			return false;
		}else{				
			$query = $this->con->prepare('SELECT ventas.*, usuarios.usuario FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id WHERE ventas.estado = "Por Pagar" AND ventas.id_fk_cliente = :id ORDER BY ventas.id');
			$query->bindParam(':id', $ID);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			if ($results) {			
				return $results;
			}else{
				return false;
			}

 		}			
	}

public function getAllVentasforPagination($inicio,$artporpagina,$q){
	if(!$this->con){
		return false;
	}else{		
		$q = isset($q) ? $q . '%' : '';
		$query = $this->con->prepare('SELECT ventas.id, usuarios.usuario, clientes.nombre, clientes.apellido ,ventas.estado,ventas.fecha,ventas.hora, ventas.subtotal, ventas.total FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id WHERE ventas.id LIKE :query1 OR clientes.nombre LIKE :query2 OR ventas.fecha = :query3 ORDER BY fecha DESC, hora DESC LIMIT :inicio,:final');
		$query->bindParam(':inicio', $inicio);
		$query->bindParam(':final', $artporpagina);
		$query->bindParam(':query1',$q);				
		$query->bindParam(':query2',$q);
		$query->bindParam(':query3',$q);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}

 }

 }

public function getAllVentasforReports($desde,$hasta,$id_usu){
	if(!$this->con){
		return false;
	}else{		
		if($id_usu){
			$query = $this->con->prepare('SELECT ventas.id, usuarios.usuario, clientes.nombre, clientes.apellido ,ventas.fecha, ventas.subtotal, ventas.total FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id WHERE ventas.id_fk_usuario = :id_usu AND ventas.fecha BETWEEN :desde AND :hasta ORDER BY fecha');
			$query->bindParam(':desde', $desde);
			$query->bindParam(':hasta', $hasta);
			$query->bindParam(':id_usu',$id_usu);					
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			if ($results) {			
				return $results;
			}
		}else{
			$query = $this->con->prepare('SELECT ventas.id, usuarios.usuario, clientes.nombre, clientes.apellido ,ventas.fecha, ventas.subtotal, ventas.total FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id WHERE ventas.fecha BETWEEN :desde AND :hasta ORDER BY fecha');
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

 public function getTotalVentas($params=''){
	if(!$this->con){
		return false;
	}else{		
		if($params != ''){
			$params = isset($params) ? $params . '%' : '';
			$query = $this->con->prepare('SELECT ventas.id, usuarios.usuario, clientes.nombre, clientes.apellido ,ventas.fecha, ventas.subtotal, ventas.total FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id WHERE ventas.id LIKE :query1 OR clientes.nombre LIKE :query2 ORDER BY fecha');
			$query->bindParam(':query1',$params);				
			$query->bindParam(':query2',$params);		
			$query->execute();
		}else{
			$query = $this->con->prepare('SELECT ventas.id, usuarios.usuario, clientes.nombre, clientes.apellido ,ventas.fecha, ventas.subtotal, ventas.total FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id ORDER BY fecha');				
			$query->execute();	
		}

		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {						
			return (count($results));
		}

 }

 }






}?>
