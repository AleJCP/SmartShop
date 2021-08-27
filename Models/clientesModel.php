<?php 
//Archivo de la logica, conexion a bd y demás
class clientesModel extends Connection
{
	
	public function __construct()
	{
		parent::__construct();
	}

	
//Funciones de logica y demas
	public function getAllClientes(){
	if(!$this->con){

	}else{		
		$query = $this->con->prepare('SELECT * FROM clientes');		
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}else{
			return false;
	}
 }
	}

	public function getDataofClientebyID($id){
		if(!$this->con){

		}else{					
			$query = $this->con->prepare('SELECT * FROM clientes WHERE id = :id');
			$query->bindParam(':id', $id);
			$query->execute();
			$data = $query->fetch(PDO::FETCH_ASSOC);
			if($data){
				return $data;
			}else{
				return false;			
			}
		}
	}


	//CRUD

public function addCliente($data){
	if(!$this->con){
		return false;
	}else{								
			$query = $this->con->prepare('INSERT INTO `clientes`(`nombre_empresa`, `rif`, `sitio_web`, `nombre`, `apellido`, `telefono`, `email`, `local_nro`, `calle`, `sector`, `ciudad`, `estado`, `cod_postal`, `pais`, `f_registro`) VALUES (:nombre_empresa, :rif, :sitio_web, :nombre, :apellido, :telefono, :email, :local_nro, :calle, :sector, :ciudad, :estado, :cod_postal,:pais,:f_registro)');
			$query->bindParam(':nombre_empresa', $data['nombre_empresa']);		
			$query->bindParam(':rif', $data['rif']);		
			$query->bindParam(':sitio_web', $data['sitio_web']);	
			$query->bindParam(':nombre', $data['nombre']);	
			$query->bindParam(':apellido', $data['apellido']);	
			$query->bindParam(':telefono', $data['telefono']);				
			$query->bindParam(':email', $data['email']);			
			$query->bindParam(':local_nro', $data['local_nro']);	
			$query->bindParam(':calle', $data['calle']);							
			$query->bindParam(':sector', $data['sector']);				
			$query->bindParam(':ciudad', $data['ciudad']);				
			$query->bindParam(':estado', $data['estado']);				
			$query->bindParam(':cod_postal', $data['cod_postal']);							
			$query->bindParam(':pais', $data['pais']);	
			$query->bindParam(':f_registro', $data['f_registro']);	

			try {
				$results = $query->execute();	
			} catch (PDOException $e) {
				$error = $e->getCode();
			}
			
			
			if(isset($results)){			
				return true;
			}elseif(isset($error)){
				return $error;
			}			
 	}

 }

 public function updateClientebyID($data){
	if(!$this->con){
		return false;
	}else{								
			$query = $this->con->prepare('UPDATE `clientes` SET `nombre_empresa`=:nombre_empresa, `rif`=:rif, `sitio_web` = :sitio_web, `nombre` = :nombre, `apellido`=:apellido,`telefono`= :telefono, `email`=:email,`local_nro`=:local_nro,`calle`=:calle,`sector`=:sector, `ciudad`=:ciudad,`estado`=:estado, `cod_postal`=:cod_postal,`pais`=:pais WHERE id=:id');
			$query->bindParam(':id', $data['id']);
			$query->bindParam(':nombre_empresa', $data['nombre_empresa']);		
			$query->bindParam(':rif', $data['rif']);		
			$query->bindParam(':sitio_web', $data['sitio_web']);	
			$query->bindParam(':nombre', $data['nombre']);	
			$query->bindParam(':apellido', $data['apellido']);	
			$query->bindParam(':telefono', $data['telefono']);				
			$query->bindParam(':email', $data['email']);			
			$query->bindParam(':local_nro', $data['local_nro']);	
			$query->bindParam(':calle', $data['calle']);							
			$query->bindParam(':sector', $data['sector']);				
			$query->bindParam(':ciudad', $data['ciudad']);				
			$query->bindParam(':estado', $data['estado']);				
			$query->bindParam(':cod_postal', $data['cod_postal']);							
			$query->bindParam(':pais', $data['pais']);				
			try {
				$results = $query->execute();				
			} catch (PDOException $e) {
				$error = $e->getCode();
			}
			
			
			if(isset($results) && $results == true){			
				return true;
			}elseif(isset($error)){
				return $error;
			}			
 	}

 }

public function dropClientebyID($id){
	if(!$this->con){
		return false;
	}else{								
			$query = $this->con->prepare('DELETE FROM `clientes` WHERE id=:id');
			$query->bindParam(':id', $id);			
			try {
				$results = $query->execute();	
			} catch (PDOException $e) {
				$error = $e->getCode();
			}						
			
			if(isset($results)){	
				return true;
			}elseif(isset($error)){
				return $error;
			}			
 	}

 }
//Paginación AJAX
 public function getAllClientesforPagination($inicio,$artporpagina,$q){
	if(!$this->con){
		return false;
	}else{		
		$q = isset($q) ? '%' . $q . '%' : '';
		$query = $this->con->prepare('SELECT * FROM clientes WHERE nombre LIKE :query1 OR rif LIKE :query2 LIMIT :inicio,:final');
		$query->bindParam(':inicio', $inicio);
		$query->bindParam(':final', $artporpagina);
		$query->bindParam(':query1',$q);				
		$query->bindParam(':query2',$q);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);	

		//Deudas
		$query = $this->con->prepare('SELECT clientes.id, SUM(ventas.total-ventas.total_monto_abonado) AS deuda FROM ventas INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id WHERE ventas.estado = "Por Pagar" GROUP BY clientes.id');							
		$query->execute();
		$results2 = $query->fetchAll(PDO::FETCH_ASSOC);		

		//Adjuntamos la Deuda
		if(isset($results) && isset($results2)){
			foreach ($results as $key => $Cliente) {
				foreach ($results2 as $key2 => $Deuda) {
					if(($Cliente['id'] == $Deuda['id'])){
						$results[$key]['deuda'] = $Deuda['deuda'];
					}
				}
			}
		}

		if ($results) {			
			return $results;
		}	

 }

 }

  public function getDeudaCadaUsuario(){
	if(!$this->con){
		return false;
	}else{		
		
		$query = $this->con->prepare('');		
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}

 }

 }


  public function getTotalClientes($params=''){
	if(!$this->con){
		return false;
	}else{		
		if($params != ''){
			$params = isset($params) ? $params . '%' : '';
			$query = $this->con->prepare('SELECT * FROM clientes WHERE nombre LIKE :query1 OR rif LIKE :query2');
			$query->bindParam(':query1',$params);				
			$query->bindParam(':query2',$params);		
			$query->execute();
		}else{
			$query = $this->con->prepare('SELECT * FROM clientes');				
			$query->execute();	
		}

		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {						
			return (count($results));
		}

 }

 }

 	public function abonarDeuda($data){
		if(!$this->con){	//Si no hay conexion retornamos false
			return false;
		}else{					
			$this->startTransaction();			
		
			$query = $this->con->prepare('SELECT ventas.*, usuarios.usuario FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id WHERE ventas.estado = "Por Pagar" AND ventas.id_fk_cliente = :id ORDER BY ventas.id');
			$query->bindParam(':id', $data['clienteID']);
			$query->execute();
			$ventasPorPagar = $query->fetchAll(PDO::FETCH_ASSOC);
			if (!$ventasPorPagar) {			
				return false;
			}else{			

				foreach ($ventasPorPagar as $key => $value) {										
					
					foreach ($data['metodo_pago'] as $key2 => $value2) {
					//Transformamos los bs a Dolares como referecia para calculos unicamente
						$Monto_aPagarDolares = ($data['metodo_pago'][$key2] == 'Efectivo_BsS' || $data['metodo_pago'][$key2] == 'Punto venta_BsS' || $data['metodo_pago'][$key2] == 'Pago movil' || $data['metodo_pago'][$key2] == 'Transferencia') ? (double) ($data['monto_pagar'][$key2] / $_SESSION['precio_dolar']) : (double) $data['monto_pagar'][$key2];	
						//Si el monto a pagar es mayor que lo abonado por el metodo de pago, insertamos el abono y actualizamos lo total abonado, se elimina el metodo de pago del array, y se pasa al siguiente metodo de pago
							$MontoTotalPorPagar = $ventasPorPagar[$key]['total'] - $ventasPorPagar[$key]['total_monto_abonado'];	

						if($MontoTotalPorPagar > $Monto_aPagarDolares){							
							//Tabla abonos
							$this->insertTransaction("INSERT INTO `abonos` (`id_fk_venta`, `id_fk_cliente`, `fecha`, `hora`, `metodo_pago`, `monto_pagar`, `nro_referencia`) VALUES (:id_fk_venta,:id_fk_cliente,:fecha,:hora,:metodo_pago,:monto_pagar,:nro_referencia)",array(
								":id_fk_venta" => $ventasPorPagar[$key]['id'],
								":id_fk_cliente" => $data['clienteID'],
								":fecha" => $data['fecha'],
								":hora" => $data['hora'],
								":metodo_pago" => $data['metodo_pago'][$key2],
								":monto_pagar" => $data['monto_pagar'][$key2],
								":nro_referencia" => $data['nro_referencia'][$key2]					
							));

							//tabla ventas							
							$ventasPorPagar[$key]['total_monto_abonado'] = $ventasPorPagar[$key]['total_monto_abonado'] + $Monto_aPagarDolares;	

							$this->insertTransaction("UPDATE `ventas` SET `total_monto_abonado`=:total_monto_abonado WHERE id = :id",array(	
							":id" => $ventasPorPagar[$key]['id'],							
							":total_monto_abonado" => $ventasPorPagar[$key]['total_monto_abonado']
						));

							unset($data['metodo_pago'][$key2]);							
							unset($data['monto_pagar'][$key2]);
							continue;
						}elseif($MontoTotalPorPagar == $Monto_aPagarDolares){							
							//Si el monto a pagar es igual que lo abonado por el metodo de pago, insertamos el abono, actualizamos el estado a pagado, eliminamos el metodo de pago, y se pasa al siguiente metodo de pago y a la suiguiente venta.	
							$this->insertTransaction("INSERT INTO `abonos` (`id_fk_venta`, `id_fk_cliente`, `fecha`, `hora`, `metodo_pago`, `monto_pagar`, `nro_referencia`) VALUES (:id_fk_venta,:id_fk_cliente,:fecha,:hora,:metodo_pago,:monto_pagar,:nro_referencia)",array(
								":id_fk_venta" => $ventasPorPagar[$key]['id'],
								":id_fk_cliente" => $data['clienteID'],
								":fecha" => $data['fecha'],
								":hora" => $data['hora'],
								":metodo_pago" => $data['metodo_pago'][$key2],
								":monto_pagar" => $data['monto_pagar'][$key2],
								":nro_referencia" => $data['nro_referencia'][$key2]				
							));

							$ventasPorPagar[$key]['total_monto_abonado'] = $ventasPorPagar[$key]['total'];
							$ventasPorPagar[$key]['estado'] = 'Pagado';						
							//Tabla Ventas
							$this->insertTransaction("UPDATE `ventas` SET `estado`=:estado,`total_monto_abonado`=:total_monto_abonado WHERE id = :id",array(	
							":id" => $ventasPorPagar[$key]['id'],
							":estado" => $ventasPorPagar[$key]['estado'],
							":total_monto_abonado" => $ventasPorPagar[$key]['total_monto_abonado']
						));
							//Se elimina el pago porque ya fue añadido
							unset($data['metodo_pago'][$key2]);
							unset($data['monto_pagar'][$key2]);
							break;
						}elseif($MontoTotalPorPagar < $Monto_aPagarDolares){
							
							//Si el monto a pagar es menor que lo abonado por el metodo de pago, insertamos el abono con el monto del total, actualizamos el estado a pagado, restamos lo abonado para utilizarlo en la siguiente iteracion, y  se pasa la suiguiente venta.
							//Guardamos el monto que falta por pagar en dolares y enbolivares, segun el caso, para poder restarlo con el monto a abonar									
							$MontoTotalPorPagar = ($data['metodo_pago'][$key2] == 'Efectivo_BsS' || $data['metodo_pago'][$key2] == 'Punto venta_BsS' || $data['metodo_pago'][$key2] == 'Pago movil' || $data['metodo_pago'][$key2] == 'Transferencia') ? (double) ($MontoTotalPorPagar * $_SESSION['precio_dolar']) : (double) ($MontoTotalPorPagar);

							//Guardamos el total de la venta en dolares y en bolivares.
							$TotalVenta = ($data['metodo_pago'][$key2] == 'Efectivo_BsS' || $data['metodo_pago'][$key2] == 'Punto venta_BsS' || $data['metodo_pago'][$key2] == 'Pago movil' || $data['metodo_pago'][$key2] == 'Transferencia') ? (double) ($ventasPorPagar[$key]['total'] * $_SESSION['precio_dolar']) : (double) ($ventasPorPagar[$key]['total']);

							$this->insertTransaction("INSERT INTO `abonos` (`id_fk_venta`, `id_fk_cliente`, `fecha`, `hora`, `metodo_pago`, `monto_pagar`, `nro_referencia`) VALUES (:id_fk_venta,:id_fk_cliente,:fecha,:hora,:metodo_pago,:monto_pagar,:nro_referencia)",array(
								":id_fk_venta" => $ventasPorPagar[$key]['id'],
								":id_fk_cliente" => $data['clienteID'],
								":fecha" => $data['fecha'],
								":hora" => $data['hora'],
								":metodo_pago" => $data['metodo_pago'][$key2],
								":monto_pagar" => $MontoTotalPorPagar,
								":nro_referencia" => $data['nro_referencia'][$key2]					
							));
							$ventasPorPagar[$key]['total_monto_abonado'] = $ventasPorPagar[$key]['total'];
							$ventasPorPagar[$key]['estado'] = 'Pagado';

							$data['monto_pagar'][$key2] =  (double) ($data['monto_pagar'][$key2] - $MontoTotalPorPagar);									
							//Tabla Ventas							
							$this->insertTransaction("UPDATE `ventas` SET `estado`=:estado,`total_monto_abonado`=:total_monto_abonado WHERE id = :id",array(	
							":id" => $ventasPorPagar[$key]['id'],
							":estado" => $ventasPorPagar[$key]['estado'],
							":total_monto_abonado" => $ventasPorPagar[$key]['total_monto_abonado']
						));
						if( (double) $data['monto_pagar'][$key2] <= 0.00){
							unset($data['metodo_pago'][$key2]);
							unset($data['monto_pagar'][$key2]);
						}
							
							break;

						}
					}
				}

				

			$result = $this->submitTransaction();
			return $result;
			// if($result === true){												
			// 	return true;
			// }else{
			// 	return false;
			// }
			

			}		
 		}
	}

}?>