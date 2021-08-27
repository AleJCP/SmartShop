<?php 
//Archivo de la logica, conexion a bd y demás
class reportesModel extends Connection
{
	
	public function __construct()
	{
		parent::__construct();
	}

	
//Funciones de logica y demas	
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

public function getVentaByID($id){
		if(!$this->con){
			return false;
		}else{		
				$query = $this->con->prepare('SELECT ventas.id, usuarios.usuario, clientes.rif as rif_cliente, clientes.nombre as cliente_nombre, clientes.apellido as cliente_apellido,ventas.fecha, ventas.subtotal, ventas.total, ventas.tasa_dolar FROM `ventas` INNER JOIN usuarios ON ventas.id_fk_usuario = usuarios.id INNER JOIN clientes ON ventas.id_fk_cliente=clientes.id WHERE ventas.id = :id_venta');	
				$query->bindParam(':id_venta',$id);								
				$query->execute();
				$results = $query->fetch(PDO::FETCH_ASSOC);
				if ($results) {			
					$data['venta'] = $results;
				}
				
				$query = $this->con->prepare('SELECT productos.codigo, productos.nombre as producto, categorias.nombre as categoria,ventas_productos.cantidad,categorias.iva, ventas_productos.precio_unidad, ventas_productos.precio_total  FROM `ventas_productos` INNER JOIN productos ON ventas_productos.id_fk_producto = productos.id INNER JOIN categorias ON productos.id_fk_categoria = categorias.id WHERE ventas_productos.id_fk_venta = :id_venta');
				$query->bindParam(':id_venta',$id);								
				$query->execute();
				$results2 = $query->fetchAll(PDO::FETCH_ASSOC);
				if ($results2) {			
					$data['producto_V'] = $results2;
					//Array IVA - Array con los valores totales del iva para calcularlo en el siguiente foreach
					
					foreach ($data['producto_V'] as $key => $value) {
						if(isset($Total['iva'][$value['iva']])){
							$Total['iva'][$value['iva']] += $value['precio_total'];	
						}else{
							$Total['iva'][$value['iva']] = $value['precio_total'];	
						}
						
					}

					foreach ($Total['iva'] as $porcentaje => $total) {
						$data['totales_iva'][$porcentaje] = ($porcentaje / 100) * $total;
						$data['totales_iva'][$porcentaje] = number_format($data['totales_iva'][$porcentaje],2,'.',',');						
					}

				}			

				if(isset($data)){
					return $data;
				}else{
					return false;
				}
 		}
	}

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

//Información compra 
	 	public function getCompraByID($id){
		if(!$this->con){
			return false;
		}else{		
				$query = $this->con->prepare('SELECT compras.id, usuarios.usuario,compras.id_fk_proveedor as P_ID, proveedores.rif, proveedores.nombre_empresa as proveedor, compras.fecha, compras.subtotal, compras.total, compras.total_bss FROM `compras` INNER JOIN usuarios ON compras.id_fk_usuario = usuarios.id INNER JOIN proveedores ON compras.id_fk_proveedor=proveedores.id WHERE compras.id = :id_compra');	
				$query->bindParam(':id_compra',$id);								
				$query->execute();
				$results = $query->fetch(PDO::FETCH_ASSOC);
				if ($results) {			
					$data['compra'] = $results;
				}
				
				$query = $this->con->prepare('SELECT productos.codigo, productos.nombre, compras_productos.cantidad, compras_productos.precio_unidad, compras_productos.precio_total  FROM `compras_productos` INNER JOIN productos ON compras_productos.id_fk_producto = productos.id WHERE id_fk_compra = :id_compra');
				$query->bindParam(':id_compra',$id);								
				$query->execute();
				$results2 = $query->fetchAll(PDO::FETCH_ASSOC);
				if ($results2) {			
					$data['producto_C'] = $results2;
				}			

				if(isset($data)){
					return $data;
				}else{
					return false;
				}
 		}
	}


 public function getAllInfo_Empresa(){
 	if(!$this->con){
		return false;
	}else{				
			$query = $this->con->prepare('SELECT * FROM empresa');											
			$query->execute();
			$results = $query->fetch(PDO::FETCH_ASSOC);
			if ($results) {			
				return $results;
			}
 	}
 }

 public function getAllProductsforReports($desde,$hasta,$id_categoria){
	if(!$this->con){
		return false;
	}else{		
		if($hasta != 'Inf'){
			if($id_categoria){
				$query = $this->con->prepare('SELECT productos.id,  productos.codigo,  productos.nombre,  productos.descripcion,  categorias.nombre as categoria, productos.presentacion, productos.costo, productos.utilidad, productos.precio_venta, productos.estado, productos.imagen, productos.stock FROM `productos` INNER JOIN categorias ON productos.id_fk_categoria = categorias.id WHERE id_fk_categoria = :id_cat AND productos.stock BETWEEN :desde AND :hasta');
				$query->bindParam(':desde', $desde);
				$query->bindParam(':hasta', $hasta);
				$query->bindParam(':id_cat',$id_categoria);							
				$query->execute();
				$results = $query->fetchAll(PDO::FETCH_ASSOC);
				if ($results) {			
					return $results;
				}
			}else{
				$query = $this->con->prepare('SELECT productos.id,  productos.codigo,  productos.nombre,  productos.descripcion,  categorias.nombre as categoria, productos.presentacion, productos.costo, productos.utilidad, productos.precio_venta, productos.estado, productos.imagen, productos.stock FROM `productos` INNER JOIN categorias ON productos.id_fk_categoria = categorias.id WHERE productos.stock BETWEEN :desde AND :hasta');
				$query->bindParam(':desde', $desde);
				$query->bindParam(':hasta', $hasta);
				$query->execute();
				$results = $query->fetchAll(PDO::FETCH_ASSOC);
				if ($results) {			
					return $results;
				}
			}
		}elseif($hasta == 'Inf'){
			if($id_categoria){
				$query = $this->con->prepare('SELECT productos.id,  productos.codigo,  productos.nombre,  productos.descripcion,  categorias.nombre as categoria, productos.presentacion, productos.costo, productos.utilidad, productos.precio_venta, productos.estado, productos.imagen, productos.stock FROM `productos` INNER JOIN categorias ON productos.id_fk_categoria = categorias.id WHERE id_fk_categoria = :id_cat AND productos.stock > :desde');
				$query->bindParam(':desde', $desde);				
				$query->bindParam(':id_cat',$id_categoria);							
				$query->execute();
				$results = $query->fetchAll(PDO::FETCH_ASSOC);
				if ($results) {			
					return $results;
				}
			}else{
				$query = $this->con->prepare('SELECT productos.id,  productos.codigo,  productos.nombre,  productos.descripcion,  categorias.nombre as categoria, productos.presentacion, productos.costo, productos.utilidad, productos.precio_venta, productos.estado, productos.imagen, productos.stock FROM `productos` INNER JOIN categorias ON productos.id_fk_categoria = categorias.id WHERE productos.stock > :desde');
				$query->bindParam(':desde', $desde);				
				$query->execute();
				$results = $query->fetchAll(PDO::FETCH_ASSOC);
				if ($results) {			
					return $results;
				}
			}
		}
 }

 }
}?>