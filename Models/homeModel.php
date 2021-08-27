<?php 
//Archivo de la logica, conexion a bd y demás
class homeModel extends Connection
{
	
	public function __construct()
	{
		parent::__construct();
	}

	
//Funciones de logica y demas
//Ultimas ventas
	public function getAllVentasforPagination($inicio,$artporpagina,$q){
	if(!$this->con){
		return false;
	}else{		
		$q = isset($q) ? $q . '%' : '';
		$DateTime = getdate();
		$fechaAct = $DateTime['year'] . '-' . $DateTime['mon'] . '-' . $DateTime['mday'];
		$query = $this->con->prepare('SELECT ventas.id, usuarios.usuario, clientes.nombre, clientes.apellido ,ventas.estado,ventas.fecha,ventas.hora, ventas.subtotal, ventas.total FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id WHERE ventas.fecha = :query3 AND (ventas.id LIKE :query1 OR clientes.nombre LIKE :query2) ORDER BY fecha DESC, hora DESC LIMIT :inicio,:final');
		$query->bindParam(':inicio', $inicio);
		$query->bindParam(':final', $artporpagina);
		$query->bindParam(':query1', $q);						
		$query->bindParam(':query2', $q);						
		$query->bindParam(':query3', $fechaAct);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}

 }

 }


 public function getTotalVentas($params=''){
	if(!$this->con){
		return false;
	}else{		
		$DateTime = getdate();
		$fechaAct = $DateTime['year'] . '-' . $DateTime['mon'] . '-' . $DateTime['mday'];
		if($params != ''){
			$params = isset($params) ? $params . '%' : '';
			$query = $this->con->prepare('SELECT ventas.id, usuarios.usuario, clientes.nombre, clientes.apellido ,ventas.fecha, ventas.subtotal, ventas.total FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id WHERE ventas.id LIKE :query1 OR clientes.nombre LIKE :query2 AND ventas.fecha = :query3 ORDER BY fecha');
			$query->bindParam(':query1',$params);				
			$query->bindParam(':query2',$params);
			$query->bindParam(':query3',$fechaAct);		
			$query->execute();
		}else{
			$query = $this->con->prepare('SELECT ventas.id, usuarios.usuario, clientes.nombre, clientes.apellido ,ventas.fecha, ventas.subtotal, ventas.total FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id WHERE ventas.fecha = :query3 ORDER BY fecha');				
			$query->bindParam(':query3',$fechaAct);
			$query->execute();			
		}

		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {						
			return (count($results));
		}

 }

 }

 public function getTotalInventario_Card($params=''){
	if(!$this->con){
		return false;
	}else{					
		//Productos totales	
		$query = $this->con->prepare('SELECT productos.id,  productos.codigo,  productos.nombre,  productos.descripcion,  categorias.nombre as categoria, categorias.iva as iva, productos.presentacion, productos.costo, productos.utilidad, productos.precio_venta, productos.estado, productos.imagen, productos.stock FROM `productos` INNER JOIN categorias ON productos.id_fk_categoria = categorias.id');					
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);		
		if($results){	
			$data['totalProductos'] = count($results);
		}else{
			$data['totalProductos'] = 0;
		}

		//Ventas totales-.
		$query = $this->con->prepare('SELECT SUM(productos.stock) as TotalStock FROM `productos` INNER JOIN categorias ON productos.id_fk_categoria = categorias.id');					
		$query->execute();			
		$results2 = $query->fetch(PDO::FETCH_ASSOC);
		if($results2){	
			$data['totalStock'] = $results2['TotalStock'];
		}else{
			$data['totalStock'] = 0;
		}


		if(isset($data)){
			return $data;
		}else{
			return false;
		}
 }
}

public function getTotalVentas_Card($params=''){
	if(!$this->con){
		return false;
	}else{		
		$DateTime = getdate();
		$mesAct = ($DateTime['mon']<10) ? $DateTime['year'] . '-' .'0'.$DateTime['mon'] . '%' : $DateTime['year'] . '-' . $DateTime['mon'] . '%';
			
		//Ventas totatales del mes			
		$query = $this->con->prepare('SELECT ventas.id, usuarios.usuario, clientes.nombre, clientes.apellido ,ventas.fecha, ventas.subtotal, ventas.total FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id WHERE ventas.fecha LIKE :query');			
		$query->bindParam(':query', $mesAct);		
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);		
		if($results){	
			$data['totalVentas_mes'] = count($results);
		}else{
			$data['totalVentas_mes'] = 0;
		}

		//Ventas totales-.
		$query = $this->con->prepare('SELECT ventas.id, usuarios.usuario, clientes.nombre, clientes.apellido ,ventas.fecha, ventas.subtotal, ventas.total FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id');						
		$query->execute();			
		$results2 = $query->fetchAll(PDO::FETCH_ASSOC);
		if($results2){	
			$data['totalVentas'] = count($results2);
		}else{
			$data['totalVentas'] = 0;
		}


		if(isset($data)){
			return $data;
		}else{
			return false;
		}

	}
}

public function getTotalCompras_Card($params=''){
	if(!$this->con){
		return false;
	}else{		
		$DateTime = getdate();
		$mesAct = ($DateTime['mon']<10) ? $DateTime['year'] . '-' .'0'.$DateTime['mon'] . '%' : $DateTime['year'] . '-' . $DateTime['mon'] . '%';
			
		//Compras totatales del mes			
		$query = $this->con->prepare('SELECT compras.id, usuarios.usuario, proveedores.nombre_empresa, compras.fecha, compras.subtotal, compras.total FROM `compras` INNER JOIN usuarios ON compras.id_fk_usuario = usuarios.id INNER JOIN proveedores ON compras.id_fk_proveedor=proveedores.id WHERE compras.fecha LIKE :query');			
		$query->bindParam(':query', $mesAct);		
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);		
		if($results){	
			$data['totalCompras_mes'] = count($results);
		}else{
			$data['totalCompras_mes'] = 0;
		}

		//Compras totales-.
		$query = $this->con->prepare('SELECT compras.id, usuarios.usuario, proveedores.nombre_empresa, compras.fecha, compras.subtotal, compras.total FROM `compras` INNER JOIN usuarios ON compras.id_fk_usuario = usuarios.id INNER JOIN proveedores ON compras.id_fk_proveedor=proveedores.id');						
		$query->execute();			
		$results2 = $query->fetchAll(PDO::FETCH_ASSOC);
		if($results2){	
			$data['totalCompras'] = count($results2);
		}else{
			$data['totalCompras'] = 0;
		}


		if(isset($data)){
			return $data;
		}else{
			return false;
		}

 }
}

public function getTotalClientes_Card($params=''){
	if(!$this->con){
		return false;
	}else{		
		$DateTime = getdate();
		$fechaAct = $DateTime['year'] . '-' . $DateTime['mon'] . '-' . $DateTime['mday'];
		
		//Clientes Nuevos del Dia
		$DateTime = getdate();
		$fechaAct = $DateTime['year'] . '-' . $DateTime['mon'] . '-' . $DateTime['mday'];
		$query = $this->con->prepare('SELECT * FROM clientes WHERE f_registro = :query');			
		$query->bindParam(':query',$fechaAct);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);	
		if ($results) {						
			$data['totalClientes_dia'] = (count($results));
		}else{
			$data['totalClientes_dia'] = 0;
		}

		//Clientes totales
		$query = $this->con->prepare('SELECT * FROM clientes');					
		$query->execute();					
		$results2 = $query->fetchAll(PDO::FETCH_ASSOC);			
		if ($results2) {						
			$data['totalClientes']  = (count($results2));
		}else{
			$data['totalClientes'] = 0;
		}

		if(isset($data)){
			return $data;
		}else{
			return false;
		}

 }
}

public function getMetrics_Ventas(){
if(!$this->con){
	return false;
}else{
		$DateTime = getdate();		
		//Ciclo para traeer desde la BBDD las ventas totales desde el primer dia del mes, hasta el dia actual del sistema.
		for ($i=01; $i <= $DateTime['mday']; $i++) { 
			//Fecha dinamica para el for
			$f_ciclo = $DateTime['year'] . '-' . $DateTime['mon'] . '-' . $i;
			$query = $this->con->prepare('SELECT ventas.id, usuarios.usuario, clientes.nombre, clientes.apellido ,ventas.fecha, ventas.subtotal, ventas.total FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id WHERE ventas.fecha = :query');			
			$query->bindParam(':query', $f_ciclo);		
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);			
			if($results){	
				$data['venta'][$i] = count($results);
			}else{
				$data['venta'][$i] = 0;
			}
			

		}
			
		if(isset($data)){
			return $data;
		}else{
			return false;
		}


}


}

public function getMetrics_Compras(){
if(!$this->con){
	return false;
}else{
		$DateTime = getdate();		
		//Ciclo para traeer desde la BBDD las ventas totales desde el primer dia del mes, hasta el dia actual del sistema.
		for ($i=01; $i <= $DateTime['mday']; $i++) { 
			//Fecha dinamica para el for
			$f_ciclo = $DateTime['year'] . '-' . $DateTime['mon'] . '-' . $i;
			$query = $this->con->prepare('SELECT compras.id, usuarios.usuario, proveedores.nombre_empresa, compras.fecha, compras.subtotal, compras.total FROM `compras` INNER JOIN usuarios ON compras.id_fk_usuario = usuarios.id INNER JOIN proveedores ON compras.id_fk_proveedor=proveedores.id WHERE compras.fecha = :query');			
			$query->bindParam(':query', $f_ciclo);		
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);			
			if($results){	
				$data['compra'][$i] = count($results);
			}else{
				$data['compra'][$i] = 0;
			}
			

		}
			
		if(isset($data)){
			return $data;
		}else{
			return false;
		}


}


}


}?>