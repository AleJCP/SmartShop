-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-08-2021 a las 21:29:26
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sshop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos`
--

DROP TABLE IF EXISTS `abonos`;
CREATE TABLE IF NOT EXISTS `abonos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_fk_venta` bigint(20) NOT NULL,
  `id_fk_cliente` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `metodo_pago` varchar(255) NOT NULL,
  `monto_pagar` decimal(64,2) NOT NULL,
  `nro_referencia` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `abonos`
--

INSERT INTO `abonos` (`id`, `id_fk_venta`, `id_fk_cliente`, `fecha`, `hora`, `metodo_pago`, `monto_pagar`, `nro_referencia`) VALUES
(1, 5, 18, '2021-06-06', '13:21:16', 'Efectivo_BsS', '1000000.00', ''),
(2, 5, 18, '2021-06-06', '13:21:50', 'Efectivo_D', '4.00', ''),
(3, 5, 18, '2021-06-06', '13:23:04', 'Efectivo_D', '0.46', ''),
(4, 6, 21, '2021-06-10', '23:07:36', 'Efectivo_D', '1.00', ''),
(5, 6, 21, '2021-06-10', '23:07:36', 'Efectivo_BsS', '5987000.00', ''),
(6, 1, 18, '2021-06-14', '11:54:10', 'Efectivo_D', '20.00', ''),
(7, 2, 18, '2021-06-15', '16:23:12', 'Efectivo_D', '5.00', ''),
(8, 1, 21, '2021-06-15', '16:27:17', 'Efectivo_D', '4.00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `iva` varchar(255) NOT NULL DEFAULT '0',
  `estado` tinyint(1) NOT NULL,
  `nro_articulos` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `iva`, `estado`, `nro_articulos`) VALUES
(1, 'Alimentos', '0', 1, '7'),
(6, 'Limpieza', '10', 1, '1'),
(7, 'Electrodomésticos', '16', 1, '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(255) DEFAULT NULL,
  `rif` varchar(255) NOT NULL,
  `sitio_web` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `local_nro` varchar(255) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `sector` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cod_postal` varchar(255) DEFAULT NULL,
  `pais` varchar(255) NOT NULL,
  `f_registro` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rif` (`rif`),
  KEY `rif_cedula` (`rif`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre_empresa`, `rif`, `sitio_web`, `nombre`, `apellido`, `telefono`, `email`, `local_nro`, `calle`, `sector`, `ciudad`, `estado`, `cod_postal`, `pais`, `f_registro`) VALUES
(18, '', 'V-14646109', '', 'ARTURO JOSE', 'CHIQUITO PETIT', '(414)-6892634', '', '', '', '', 'PUNTO FIJO', 'FALCON', '4102', 'VENEZUELA', '2021-04-22'),
(21, '', 'V-28651798', '', 'ALEJANDRO JOSE', 'CHIQUITO PETIT', '(414)-6892634', '', '', '', '', 'PUNTO FIJO', 'FALCON', '4102', 'VENEZUELA', '2021-05-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE IF NOT EXISTS `compras` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `id_fk_usuario` bigint(255) NOT NULL,
  `id_fk_proveedor` bigint(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `subtotal` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `total_bss` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_fk_usuario` (`id_fk_usuario`),
  KEY `id_fk_proveedor` (`id_fk_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `id_fk_usuario`, `id_fk_proveedor`, `fecha`, `hora`, `subtotal`, `total`, `total_bss`) VALUES
(1, 1, 2, '2021-06-10', '22:16:00', '2.57', '2.57', '8,097,049.25'),
(2, 1, 2, '2021-06-10', '22:34:57', '1.00', '1.00', '3,150,602.82'),
(3, 1, 15, '2021-06-14', '10:31:07', '1.00', '1.00', '3,151,829.94');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_productos`
--

DROP TABLE IF EXISTS `compras_productos`;
CREATE TABLE IF NOT EXISTS `compras_productos` (
  `id_fk_compra` bigint(255) NOT NULL,
  `id_fk_producto` bigint(255) NOT NULL,
  `cantidad` bigint(255) NOT NULL,
  `precio_unidad` decimal(64,2) NOT NULL,
  `precio_total` decimal(64,2) NOT NULL,
  KEY `id_fk_compra` (`id_fk_compra`),
  KEY `id_fk_producto` (`id_fk_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras_productos`
--

INSERT INTO `compras_productos` (`id_fk_compra`, `id_fk_producto`, `cantidad`, `precio_unidad`, `precio_total`) VALUES
(1, 1, 1, '1.00', '1.00'),
(1, 15, 1, '1.57', '1.57'),
(2, 1, 1, '1.00', '1.00'),
(3, 1, 1, '1.00', '1.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dolar`
--

DROP TABLE IF EXISTS `dolar`;
CREATE TABLE IF NOT EXISTS `dolar` (
  `id` int(11) NOT NULL,
  `marcaje` varchar(255) DEFAULT NULL,
  `precio_dolar` varchar(255) NOT NULL,
  `seleccion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dolar`
--

INSERT INTO `dolar` (`id`, `marcaje`, `precio_dolar`, `seleccion`) VALUES
(1, 'Agosto 24, 2021 07:42 PM', '4150378.78', 'paralelo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(100) NOT NULL,
  `rif` varchar(100) DEFAULT NULL,
  `telefono` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `zona_horaria` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `cod_postal` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre_empresa`, `rif`, `telefono`, `email`, `zona_horaria`, `logo`, `calle`, `ciudad`, `estado`, `pais`, `cod_postal`) VALUES
(1, 'SmartShop', 'J-00000000', '(412)-7508660', 'alejandrojcptlfn@gmail.com', '', 'SSlogo.png', 'CENTRAL', 'PUNTO FIJO', 'FALCON', 'VENEZUELA', '4102');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposusuarios`
--

DROP TABLE IF EXISTS `gruposusuarios`;
CREATE TABLE IF NOT EXISTS `gruposusuarios` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `permisos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`permisos`)),
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gruposusuarios`
--

INSERT INTO `gruposusuarios` (`id`, `nombre`, `permisos`) VALUES
(1, 'Administrador', '{\"visualizar\":{\"inicio\":\"true\",\"compras\":\"true\",\"productos\":\"true\",\"categorias\":\"true\",\"facturacion\":\"true\",\"clientes\":\"true\",\"proveedores\":\"true\",\"reportes\":\"true\",\"configuracion\":\"true\",\"control_usuarios\":\"true\"},\"agregar\":{\"inicio\":\"true\",\"compras\":\"true\",\"productos\":\"true\",\"categorias\":\"true\",\"facturacion\":\"true\",\"clientes\":\"true\",\"proveedores\":\"true\",\"reportes\":\"true\",\"configuracion\":\"true\",\"control_usuarios\":\"true\"},\"editar\":{\"inicio\":\"true\",\"compras\":\"true\",\"productos\":\"true\",\"categorias\":\"true\",\"facturacion\":\"true\",\"clientes\":\"true\",\"proveedores\":\"true\",\"reportes\":\"true\",\"configuracion\":\"true\",\"control_usuarios\":\"true\"},\"eliminar\":{\"inicio\":\"true\",\"compras\":\"true\",\"productos\":\"true\",\"categorias\":\"true\",\"facturacion\":\"true\",\"clientes\":\"true\",\"proveedores\":\"true\",\"reportes\":\"true\",\"configuracion\":\"true\",\"control_usuarios\":\"true\"}}'),
(2, 'Almacenador', '{\"visualizar\":{\"inicio\":\"false\",\"compras\":\"false\",\"productos\":\"false\",\"categorias\":\"false\",\"facturacion\":\"false\",\"clientes\":\"false\",\"proveedores\":\"true\",\"reportes\":\"false\",\"configuracion\":\"false\",\"control_usuarios\":\"false\"},\"agregar\":{\"inicio\":\"false\",\"compras\":\"true\",\"productos\":\"true\",\"categorias\":\"true\",\"facturacion\":\"false\",\"clientes\":\"false\",\"proveedores\":\"true\",\"reportes\":\"false\",\"configuracion\":\"false\",\"control_usuarios\":\"false\"},\"editar\":{\"inicio\":\"false\",\"compras\":\"true\",\"productos\":\"true\",\"categorias\":\"true\",\"facturacion\":\"false\",\"clientes\":\"false\",\"proveedores\":\"true\",\"reportes\":\"false\",\"configuracion\":\"false\",\"control_usuarios\":\"false\"},\"eliminar\":{\"inicio\":\"false\",\"compras\":\"true\",\"productos\":\"true\",\"categorias\":\"true\",\"facturacion\":\"false\",\"clientes\":\"false\",\"proveedores\":\"true\",\"reportes\":\"false\",\"configuracion\":\"false\",\"control_usuarios\":\"false\"}}'),
(6, 'Cajero', '{\"visualizar\":{\"inicio\":\"true\",\"compras\":\"true\",\"productos\":\"true\",\"categorias\":\"true\",\"facturacion\":\"true\",\"clientes\":\"true\",\"proveedores\":\"true\",\"reportes\":\"true\",\"configuracion\":\"true\",\"control_usuarios\":\"true\"},\"agregar\":{\"inicio\":\"false\",\"compras\":\"false\",\"productos\":\"false\",\"categorias\":\"false\",\"facturacion\":\"false\",\"clientes\":\"false\",\"proveedores\":\"false\",\"reportes\":\"false\",\"configuracion\":\"false\",\"control_usuarios\":\"false\"},\"editar\":{\"inicio\":\"false\",\"compras\":\"false\",\"productos\":\"false\",\"categorias\":\"false\",\"facturacion\":\"false\",\"clientes\":\"false\",\"proveedores\":\"false\",\"reportes\":\"false\",\"configuracion\":\"false\",\"control_usuarios\":\"false\"},\"eliminar\":{\"inicio\":\"false\",\"compras\":\"false\",\"productos\":\"false\",\"categorias\":\"false\",\"facturacion\":\"false\",\"clientes\":\"false\",\"proveedores\":\"false\",\"reportes\":\"false\",\"configuracion\":\"false\",\"control_usuarios\":\"false\"}}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `id_fk_categoria` bigint(255) NOT NULL,
  `presentacion` varchar(255) NOT NULL,
  `costo` decimal(64,2) NOT NULL,
  `utilidad` decimal(64,2) NOT NULL,
  `precio_bruto` decimal(64,2) NOT NULL,
  `precio_venta` decimal(64,2) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `stock` bigint(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  KEY `id_fk_categoria` (`id_fk_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `id_fk_categoria`, `presentacion`, `costo`, `utilidad`, `precio_bruto`, `precio_venta`, `estado`, `imagen`, `stock`) VALUES
(1, '1591002000011', 'Harina PAN', 'Harina de Maíz Precocida', 1, 'Unidad', '1.00', '10.00', '1.10', '1.10', 1, 'pan_precoockedwhitecornmeal_1kg.jpg', 60),
(14, '12345', 'Golden UVA 1.5LT', 'Refresco con Gas Sabor a Uva', 1, 'Unidad', '1.57', '20.00', '1.80', '1.80', 0, '1-20.jpg', 10),
(15, '13678', 'CocaCola 1.5LT', 'Refresco con Gas Sabor a Cola', 1, 'Unidad', '1.57', '20.00', '1.88', '1.88', 1, 'Coca-Cola-litro-descartable.jpg', 300),
(17, '19048372', 'Pepsi 2LT', 'Refresco con Gas Sabor a Cola', 1, 'Unidad', '1.50', '20.00', '1.80', '1.80', 1, 'Refresco-Pepsi-2L.jpg', 100),
(19, '18463738', 'Golden Manzana 2LT', 'Refresco con Gas Sabor a Manzana', 1, 'Unidad', '1.50', '20.00', '1.80', '1.80', 1, 'imagen_pequena149.png', 10),
(77, '27345535632334', 'Oreo Americana', 'Galletas de Chocolate', 1, '16 Unidades', '10.00', '10.00', '11.00', '11.00', 1, 'default.jpg', 10),
(83, '12345678909', 'Trululu', 'Dulce', 1, 'Unidad', '0.50', '20.00', '0.60', '0.60', 1, 'default.jpg', 1000),
(84, '2345678965', 'AJAX Limpiador 500ml', '', 6, 'Unidad', '1.00', '100.00', '2.00', '2.20', 1, 'download.jpg', 50),
(85, '234567876543', 'Pesa electrónica', 'Capacidad 10000g', 7, 'Unidad', '3.60', '20.00', '4.32', '5.01', 1, 'Kitchen-Digital-Weight-Scale-10-KG-1.jpg', 50),
(86, '213113', 'Computadora', '', 7, 'Unidad', '1.00', '10.00', '1.10', '1.28', 1, 'default.jpg', 20);

--
-- Disparadores `productos`
--
DROP TRIGGER IF EXISTS `contador_productos_delete`;
DELIMITER $$
CREATE TRIGGER `contador_productos_delete` AFTER DELETE ON `productos` FOR EACH ROW BEGIN

UPDATE categorias SET `nro_articulos` = (SELECT COUNT(*) FROM productos WHERE id_fk_categoria = old.id_fk_categoria) WHERE categorias.id = old.id_fk_categoria;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `contador_productos_insert`;
DELIMITER $$
CREATE TRIGGER `contador_productos_insert` AFTER INSERT ON `productos` FOR EACH ROW BEGIN

UPDATE categorias SET `nro_articulos` = (SELECT COUNT(*) FROM productos WHERE id_fk_categoria = new.id_fk_categoria) WHERE categorias.id = new.id_fk_categoria;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `contador_productos_update`;
DELIMITER $$
CREATE TRIGGER `contador_productos_update` AFTER UPDATE ON `productos` FOR EACH ROW BEGIN

UPDATE categorias SET `nro_articulos` = (SELECT COUNT(*) FROM productos WHERE id_fk_categoria = old.id_fk_categoria) WHERE categorias.id = old.id_fk_categoria;

UPDATE categorias SET `nro_articulos` = (SELECT COUNT(*) FROM productos WHERE id_fk_categoria = new.id_fk_categoria) WHERE categorias.id = new.id_fk_categoria;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(255) NOT NULL,
  `rif` varchar(255) NOT NULL,
  `sitio_web` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `local_nro` varchar(255) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `sector` varchar(255) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `cod_postal` varchar(255) DEFAULT NULL,
  `pais` varchar(255) NOT NULL,
  `f_registro` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rif` (`rif`),
  KEY `rif_cedula` (`rif`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre_empresa`, `rif`, `sitio_web`, `nombre`, `apellido`, `telefono`, `email`, `local_nro`, `calle`, `sector`, `ciudad`, `estado`, `cod_postal`, `pais`, `f_registro`) VALUES
(15, 'BONDEGON VESSADA', 'J-066001323', '', 'OMAR', 'LEAL', '(412)-7508660', '', '', '', '', 'PUNTO FIJO', 'FALCON', '4102', 'VENEZUELA', '2021-06-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `id_fk_grupousuario` bigint(255) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `cedula` varchar(255) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  UNIQUE KEY `cedula` (`cedula`),
  KEY `id_fk_grupousuario` (`id_fk_grupousuario`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_fk_grupousuario`, `usuario`, `password`, `nombre`, `apellido`, `email`, `telefono`, `cedula`, `estado`) VALUES
(1, 1, 'ADMIN', '$2y$10$iTddR3qawXk663To.HnSeO5ozCJ3a3jUi0HP2Nv4I98hCeUJvO5Fu', 'ALEJANDRO', 'CHIQUITO', 'ALEJANDROJCPTLFN@GMAIL.COM', '(041)-2750866', 'V-28039063', 1),
(17, 2, 'ALMACENADOR1', '$2y$10$Mjer.eaB17Lzk1sglqau2uXCgr07mIrWVB95Ewf6EukC7KNdKm/Am', 'ARTURO JOSE', 'CHIQUITO PETIT', '', '(414)-6892634', 'V-28651798', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `id_fk_usuario` bigint(255) NOT NULL,
  `id_fk_cliente` bigint(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `total_monto_abonado` decimal(64,2) NOT NULL,
  `cambio` decimal(64,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(64,2) NOT NULL,
  `total` decimal(64,2) NOT NULL,
  `tasa_dolar` decimal(64,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_fk_usuario` (`id_fk_usuario`),
  KEY `id_fk_cliente` (`id_fk_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `id_fk_usuario`, `id_fk_cliente`, `estado`, `fecha`, `hora`, `total_monto_abonado`, `cambio`, `subtotal`, `total`, `tasa_dolar`) VALUES
(1, 1, 21, 'Pagado', '2021-06-15', '16:27:17', '4.00', '0.70', '3.10', '3.30', '3151829.94');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_productos`
--

DROP TABLE IF EXISTS `ventas_productos`;
CREATE TABLE IF NOT EXISTS `ventas_productos` (
  `id_fk_venta` bigint(255) NOT NULL,
  `id_fk_producto` bigint(255) NOT NULL,
  `cantidad` bigint(255) NOT NULL,
  `precio_unidad` decimal(64,2) NOT NULL,
  `precio_total` decimal(64,2) NOT NULL,
  KEY `id_fk_compra` (`id_fk_venta`),
  KEY `id_fk_producto` (`id_fk_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas_productos`
--

INSERT INTO `ventas_productos` (`id_fk_venta`, `id_fk_producto`, `cantidad`, `precio_unidad`, `precio_total`) VALUES
(1, 1, 1, '1.10', '1.10'),
(1, 84, 1, '2.00', '2.00');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_fk_categoria`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_fk_grupousuario`) REFERENCES `gruposusuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
