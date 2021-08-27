<?php 
//Archivo de la logica, conexion a bd y demás
class productosModel extends Connection
{
	
	public function __construct()
	{
		parent::__construct();
	}

	
//Funciones de logica y demas

	public function getProductbyID($id){
	if(!$this->con){
		return false;
	}else{				
		$query = $this->con->prepare('SELECT * FROM productos WHERE id = :id');
		$query->bindParam(':id', $id);		
		$query->execute();
		$results = $query->fetch(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}

 }

 }


 	public function getCategoriabyID($id){
	if(!$this->con){
		return false;
	}else{				
		$query = $this->con->prepare('SELECT * FROM categorias WHERE id = :id');
		$query->bindParam(':id', $id);		
		$query->execute();
		$results = $query->fetch(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}

 }

 }


public function getAllProductsforPagination($inicio,$artporpagina,$q){
	if(!$this->con){
		return false;
	}else{		
		$q = isset($q) ? $q . '%' : '';
		$query = $this->con->prepare('SELECT productos.id,  productos.codigo,  productos.nombre,  productos.descripcion,  categorias.nombre as categoria, categorias.iva as iva, productos.presentacion, productos.costo, productos.utilidad, productos.precio_venta, productos.estado, productos.imagen, productos.stock FROM `productos` INNER JOIN categorias ON productos.id_fk_categoria = categorias.id WHERE productos.nombre LIKE :query1 OR productos.codigo LIKE :query2 LIMIT :inicio,:final');
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


 	public function getAllPFP_onlyAct($inicio,$artporpagina,$q){
	if(!$this->con){
		return false;
	}else{		
		$q = isset($q) ? $q . '%' : '';
		$estado = 1;
		$query = $this->con->prepare('SELECT productos.id,  productos.codigo,  productos.nombre,  productos.descripcion,  categorias.nombre as categoria, categorias.iva as iva, productos.presentacion, productos.costo, productos.utilidad, productos.precio_bruto, productos.precio_venta, productos.estado, productos.imagen, productos.stock FROM `productos` INNER JOIN categorias ON productos.id_fk_categoria = categorias.id WHERE productos.estado = :estado && (productos.nombre LIKE :query1 || productos.codigo LIKE :query2) LIMIT :inicio,:final');
		$query->bindParam(':inicio', $inicio);
		$query->bindParam(':final', $artporpagina);
		$query->bindParam(':query1',$q);				
		$query->bindParam(':query2',$q);
		$query->bindParam(':estado', $estado);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}

 }

 }
//Activated
 public function getAllCategorias(){
	if(!$this->con){
		return false;
	}else{		
		$q = isset($q) ? $q . '%' : '';
		$query = $this->con->prepare('SELECT * FROM categorias WHERE estado = 1');		
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}

 }

 }

 public function getAllCategorias_All(){
	if(!$this->con){
		return false;
	}else{		
		$q = isset($q) ? $q . '%' : '';
		$query = $this->con->prepare('SELECT * FROM categorias');		
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}

 }

 }

  public function getAllCategoriasFP($inicio,$artporpagina,$q){
if(!$this->con){
		return false;
	}else{		
		$q = isset($q) ? $q . '%' : '';		
		$query = $this->con->prepare('SELECT * FROM categorias WHERE nombre LIKE :query1 LIMIT :inicio,:final');
		$query->bindParam(':inicio', $inicio);
		$query->bindParam(':final', $artporpagina);
		$query->bindParam(':query1',$q);						
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {			
			return $results;
	}

 }

 }


  public function getTotalCategorias($params=''){
	if(!$this->con){
		return false;
	}else{		
		if($params != ''){
			$params = isset($params) ? $params . '%' : '';
			$query = $this->con->prepare('SELECT * FROM categorias WHERE nombre LIKE :query1');
			$query->bindParam(':query1',$params);							
			$query->execute();
		}else{
			$query = $this->con->prepare('SELECT * FROM categorias');				
			$query->execute();	
		}

		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {						
			return (count($results));
		}

 }

 }

 
 public function getTotalProducts($params=''){
	if(!$this->con){
		return false;
	}else{		
		if($params != ''){
			$params = isset($params) ? $params . '%' : '';
			$query = $this->con->prepare('SELECT * FROM productos WHERE nombre LIKE :query1 OR codigo LIKE :query2');
			$query->bindParam(':query1',$params);				
			$query->bindParam(':query2',$params);		
			$query->execute();
		}else{
			$query = $this->con->prepare('SELECT * FROM productos');				
			$query->execute();	
		}

		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {						
			return (count($results));
		}

 }

 }

 public function getTotalActiveProducts($params=''){
	if(!$this->con){
		return false;
	}else{		
//Estado buscado en  la base de datos
		$estado = 1;
		if($params != ''){
			$params = isset($params) ? $params . '%' : '';			
			$query = $this->con->prepare('SELECT productos.id,  productos.codigo,  productos.nombre,  productos.descripcion,  categorias.nombre as categoria, categorias.iva as iva, productos.presentacion, productos.costo, productos.utilidad,productos.precio_bruto, productos.precio_venta, productos.estado, productos.imagen, productos.stock FROM `productos` INNER JOIN categorias ON productos.id_fk_categoria = categorias.id WHERE productos.estado = :estado && (productos.nombre LIKE :query1 || productos.codigo LIKE :query2)');
			$query->bindParam(':query1',$params);				
			$query->bindParam(':query2',$params);		
			$query->bindParam(':estado',$estado);
			$query->execute();
		}else{
			$query = $this->con->prepare('SELECT productos.id,  productos.codigo,  productos.nombre,  productos.descripcion,  categorias.nombre as categoria, categorias.iva as iva, productos.presentacion, productos.costo, productos.utilidad, productos.precio_bruto,productos.precio_venta, productos.estado, productos.imagen, productos.stock FROM `productos` INNER JOIN categorias ON productos.id_fk_categoria = categorias.id WHERE productos.estado = :estado');		
			$query->bindParam(':estado',$estado);		
			$query->execute();	
		}

		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		if ($results) {						
			return (count($results));
		}

 }

 }

public function addProduct($data){
	if(!$this->con){
		return false;
	}else{				
		
		if(move_uploaded_file($_FILES['image']['tmp_name'], __ROOT.'/Assets/uploads/'.$data['upload_file']['nombre']) || $data['upload_file']['nombre'] == 'default.jpg') {
		
			$query = $this->con->prepare('INSERT INTO `productos`(`codigo`, `nombre`, `descripcion`, `id_fk_categoria`, `presentacion`, `costo`, `utilidad`, `precio_bruto`, `precio_venta`, `estado`, `imagen`, `stock`) VALUES (:codigo, :nombre, :descripcion, :id_fk_categoria, :presentacion, :costo, :utilidad, :precio_bruto, :precio_venta, :estado, :imagen, :stock)');
			$query->bindParam(':codigo', $data['codigo']);		
			$query->bindParam(':nombre', $data['nombre']);		
			$query->bindParam(':descripcion', $data['descripcion']);	
			$query->bindParam(':id_fk_categoria', $data['categoria']);	
			$query->bindParam(':presentacion', $data['presentacion']);	
			$query->bindParam(':costo', $data['costo']);				
			$query->bindParam(':utilidad', $data['utilidad']);			
			$query->bindParam(':precio_bruto', $data['precio_bruto']);
			$query->bindParam(':precio_venta', $data['precio_venta']);	
			$query->bindParam(':estado', $data['estado']);				
			$query->bindParam(':imagen', $data['upload_file']['nombre']);
			$query->bindParam(':stock', $data['stock']);				
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

 }

 public function editProduct($data){
	if(!$this->con){
		return false;
	}else{				
		
		if(move_uploaded_file($_FILES['image']['tmp_name'], __ROOT.'/Assets/uploads/'.$data['upload_file']['nombre']) || $data['upload_file']['nombre'] == 'default.jpg') {
		
		if($data['upload_file']['nombre'] != 'default.jpg'){

			$query = $this->con->prepare('UPDATE `productos` SET `codigo`=:codigo,`nombre`=:nombre,`descripcion`=:descripcion,`id_fk_categoria`=:id_fk_categoria,`presentacion`=:presentacion,`costo`=:costo,`utilidad`=:utilidad,`precio_bruto`=:precio_bruto,`precio_venta`=:precio_venta,`estado`=:estado,`imagen`=:imagen,`stock`=:stock WHERE `id`=:id');
			$query->bindParam(':id', $data['id']);
			$query->bindParam(':codigo', $data['codigo']);		
			$query->bindParam(':nombre', $data['nombre']);		
			$query->bindParam(':descripcion', $data['descripcion']);	
			$query->bindParam(':id_fk_categoria', $data['categoria']);	
			$query->bindParam(':presentacion', $data['presentacion']);	
			$query->bindParam(':costo', $data['costo']);				
			$query->bindParam(':utilidad', $data['utilidad']);
			$query->bindParam(':precio_bruto', $data['precio_bruto']);			
			$query->bindParam(':precio_venta', $data['precio_venta']);	
			$query->bindParam(':estado', $data['estado']);				
			$query->bindParam(':imagen',  $data['upload_file']['nombre']);
			$query->bindParam(':stock', $data['stock']);				
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
			}else{

				$query = $this->con->prepare('UPDATE `productos` SET `codigo`=:codigo,`nombre`=:nombre,`descripcion`=:descripcion,`id_fk_categoria`=:id_fk_categoria,`presentacion`=:presentacion,`costo`=:costo,`utilidad`=:utilidad,`precio_bruto`=:precio_bruto,`precio_venta`=:precio_venta,`estado`=:estado,`stock`=:stock WHERE `id`=:id');
			$query->bindParam(':id', $data['id']);
			$query->bindParam(':codigo', $data['codigo']);		
			$query->bindParam(':nombre', $data['nombre']);		
			$query->bindParam(':descripcion', $data['descripcion']);	
			$query->bindParam(':id_fk_categoria', $data['categoria']);	
			$query->bindParam(':presentacion', $data['presentacion']);	
			$query->bindParam(':costo', $data['costo']);				
			$query->bindParam(':utilidad', $data['utilidad']);	
			$query->bindParam(':precio_bruto', $data['precio_bruto']);			
			$query->bindParam(':precio_venta', $data['precio_venta']);	
			$query->bindParam(':estado', $data['estado']);							
			$query->bindParam(':stock', $data['stock']);				
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
 }

 }

 public function deleteProduct($id){
	if(!$this->con){
		return false;
	}else{				
		$query = $this->con->prepare('DELETE FROM `productos` WHERE id=:id');
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

 public function addCategoria($data){
	if(!$this->con){
		return false;
	}else{				
			$query = $this->con->prepare('INSERT INTO `categorias`(`nombre`,`iva`, `estado`) 
				VALUES (:nombre,:iva,:estado)');
			$query->bindParam(':nombre', $data['nombre']);		
			$query->bindParam(':estado', $data['estado']);						
			$query->bindParam(':iva', $data['iva']);	
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

  public function editCategoria($data){
	if(!$this->con){
		return false;
	}else{				
			$query = $this->con->prepare('UPDATE `categorias` SET `nombre`=:nombre,`iva`=:iva,  `estado`=:estado WHERE id = :id');
			$query->bindParam(':id', $data['id']);
			$query->bindParam(':nombre', $data['nombre']);		
			$query->bindParam(':iva', $data['iva']);		
			$query->bindParam(':estado', $data['estado']);						
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

    public function deleteCategoria($id){
	if(!$this->con){
		return false;
	}else{				
		$query = $this->con->prepare('DELETE FROM `categorias` WHERE id=:id');
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




public function MostrarVariable($var,$type){
	if($type == 'vardump'){
		var_dump($var);
	}elseif($type == 'echo'){
		echo $var;
	}
}

//Funciones COMPRA-PRODUCTOS
//Funciones de Compras-Productos

	public function addProduct_CompraTMP($id,$cantidad){
		//Traemos los datos del producto		
		$data = $this->getProductbyID($id);				
		//En caso de no encontrar nada retornamos false
		if(!$data){
			return false;
		}	
		$CompraTmp = array();
		//Si ya esta el cookie traemos el array del json
		if(!empty($_SESSION['CompraTmp'])){			
			$CompraTmp = $_SESSION['CompraTmp'];
		}
		//Buscamos antes el producto en la COOKIE en caso de encontrarse solo le añadimos la cantidad y actualizamos el precio, si no lo añadimos desde 0
		$inArray = false;
		
		foreach ($CompraTmp as $key => $Producto) {														
				if ($Producto['id'] == (int) $id) {
					$inArray = true;							
					break;
				}		
			}

		if ($inArray){
		
			$CompraTmp[$key]['Cantidad'] += $cantidad;
			$CompraTmp[$key]['Precio_IND'] = (double) $data['costo'];
			//Precio_TOTAL-------
			$Precio_Total = (double) ($CompraTmp[$key]['Cantidad'] * $data['costo']);
			$CompraTmp[$key]['Precio_TOTAL'] = $Precio_Total;	

			$_SESSION['CompraTmp'] = $CompraTmp;									
			$this->ActualizarTotal_Compra();
			return true;
		}else{

		//Si no 
		//Agregamos la compra a la cookie
		$UltP = count($CompraTmp);
		$CompraTmp[$UltP]['id'] = $data['id'];
		$CompraTmp[$UltP]['Codigo'] = $data['codigo'];
		$CompraTmp[$UltP]['Nombre'] = $data['nombre'];
		$CompraTmp[$UltP]['Cantidad'] = $cantidad;
		$CompraTmp[$UltP]['Precio_IND'] = (double) $data['costo'];
			//Precio_TOTAL-------
			$Precio_Total = (double) ($cantidad * $data['costo']);
		$CompraTmp[$UltP]['Precio_TOTAL'] = $Precio_Total;

		//Seteamos la Variable		
		$_SESSION['CompraTmp'] = $CompraTmp;		
		$this->ActualizarTotal_Compra();
		return true;	
		}		
	}

	public function deleteProduct_CompraTMP($id){
			//Recorremos el Array de Sesion mediante un ciclo for para conseguir el producto
		//Luego lo Borramos
			$CompraTmp = $_SESSION['CompraTmp'];						
			foreach ($CompraTmp as $key => $Producto) {														
				if ($Producto['id'] == (int) $id) {
					unset($CompraTmp[$key]);									
					break;
				}		
			}			
			$_SESSION['CompraTmp'] = $CompraTmp;

			$this->ActualizarTotal_Compra();
			return true;


	}


//Funciones Varias
	public function ActualizarTotal_Compra(){
		//Seteamos el array total

		$Total['subtotal'] = (double) 0.00;		
		$Total['total'] = (double) 0.00;
		$Total['total_bss'] = (double) 0.00;

		//Calculamos el sub total a partir de el array de la Cookie
		$CompraTmp = array(); 				
		$CompraTmp = $_SESSION['CompraTmp'];
		if ($CompraTmp) {
			foreach ($CompraTmp as $key => $Producto) {														
			$Total['subtotal'] = (double) $Total['subtotal'] + $CompraTmp[$key]['Precio_TOTAL'];
			}		
							
			$Total['total'] = (double) $Total['subtotal'];		
			//Calculamos el precio en BSs
			
			$Total['total_bss'] = (double) $_SESSION['precio_dolar'] * $Total['total'];				
			
			//Formateamos a dos decimales
			$Total['subtotal'] = number_format($Total['subtotal'],2,'.',',');			
			$Total['total'] = number_format($Total['total'],2,'.',',');
			$Total['total_bss'] = number_format($Total['total_bss'],2,'.',',');			
		}else{
			$Total = array();
		}	
		//Guardamos en la SESION
		$_SESSION['Total_CompraTmp'] = $Total;
	}
//Funciones VENTA-PRODUCTOS

	public function addProduct_VentaTMP($id,$cantidad){
		//Traemos los datos del producto		
		$data['producto'] = $this->getProductbyID($id);				
		$data['categoria'] = $this->getCategoriabyID($data['producto']['id_fk_categoria']);							
		if(!$data){
			return false;
		}

		//Venta
		$VentaTmp = array();

		//Si ya esta el cookie traemos el array del json
		if(!empty($_SESSION['VentaTmp'])){			
			$VentaTmp = $_SESSION['VentaTmp'];
		}
		//Buscamos antes el producto en caso de encontrarse solo le añadimos la cantidad y actualizamos el precio
		$inArray = false;
		
		foreach ($VentaTmp as $key => $Producto) {														
				if ($Producto['id'] == (int) $id) {
					$inArray = true;							
					break;
				}		
			}

		if ($inArray){
		
			$VentaTmp[$key]['Cantidad'] += $cantidad;
			$VentaTmp[$key]['Precio_IND'] = (double) $data['producto']['precio_bruto'];
			//Precio_TOTAL-------
			$Precio_Total = (double) ($VentaTmp[$key]['Cantidad'] * $data['producto']['precio_bruto']);
			$VentaTmp[$key]['Precio_TOTAL'] = $Precio_Total;	

			$_SESSION['VentaTmp'] = $VentaTmp;									
			$this->ActualizarTotal_Venta();
			return true;
		}else{

		//Si no 
		//Agregamos la Venta a la cookie
		$UltP = count($VentaTmp);
		$VentaTmp[$UltP]['id'] = $data['producto']['id'];
		$VentaTmp[$UltP]['Codigo'] = $data['producto']['codigo'];
		$VentaTmp[$UltP]['Nombre'] = $data['producto']['nombre'];
		$VentaTmp[$UltP]['Cantidad'] = $cantidad;
		$VentaTmp[$UltP]['Iva'] = $data['categoria']['iva'];
		$VentaTmp[$UltP]['Precio_IND'] = (double) $data['producto']['precio_bruto'];
			//Precio_TOTAL-------
			$Precio_Total = (double) ($cantidad * $data['producto']['precio_bruto']);
		$VentaTmp[$UltP]['Precio_TOTAL'] = $Precio_Total;

		//Seteamos la Variable		
		$_SESSION['VentaTmp'] = $VentaTmp;		
		$this->ActualizarTotal_Venta();
		return true;	
		}		
	}

	public function deleteProduct_VentaTMP($id){
			//Recorremos el Array de Sesion mediante un ciclo for para conseguir el producto
		//Luego lo Borramos
			$VentaTmp = $_SESSION['VentaTmp'];						
			foreach ($VentaTmp as $key => $Producto) {														
				if ($Producto['id'] == (int) $id) {
					unset($VentaTmp[$key]);									
					break;
				}		
			}			
			$_SESSION['VentaTmp'] = $VentaTmp;
			//Eliminamos el total en caso de estar vacio el Array			
			$this->ActualizarTotal_Venta();
			return true;


	}


//Funciones Varias
	public function ActualizarTotal_Venta(){
		//Seteamos el array total

		$Total['subtotal'] = (double) 0.00;		
		$Total['total'] = (double) 0.00;
		$Total['total_bss'] = (double) 0.00;

		//Calculamos el sub total a partir de el array de la Cookie
		$VentaTmp = array(); 				
		$VentaTmp = $_SESSION['VentaTmp'];

		if (!empty($_SESSION['VentaTmp'])) {
			//Operacion de SubTotal
			foreach ($VentaTmp as $key => $Producto) {														
			$Total['subtotal'] = (double) $Total['subtotal'] + $VentaTmp[$key]['Precio_TOTAL'];
			}		
			//Operacion de IVA 
			foreach ($VentaTmp as $key => $Producto) {
				$Total['iva'][$VentaTmp[$key]['Iva']] += $VentaTmp[$key]['Precio_TOTAL'];
			}			

			foreach ($Total['iva'] as $key => $IVA) {
				$Total['totales_iva'][$key] = ($key / 100) * $IVA;
				$Total['totales_iva'][$key] = number_format($Total['totales_iva'][$key],2,'.',',');
				$Total['total'] += $Total['totales_iva'][$key];
			}

						
			//Calculamos el precio en BSs
			$Total['total'] += $Total['subtotal'];
			$Total['total_bss'] = (double) $_SESSION['precio_dolar'] * $Total['total'];						
			//Formateamos a dos decimales
			//Formateamos a dos decimales sin la coma del mil
			$Total['subtotal'] = number_format($Total['subtotal'],2,'.','');						
			$Total['total'] = number_format($Total['total'],2,'.','');
			$Total['total_bss'] = number_format($Total['total_bss'],2,'.','');			
		}else{
			$Total = array();
		}	
		//Guardamos en la SESION
		$_SESSION['Total_VentaTmp'] = $Total;
	}
}?>

