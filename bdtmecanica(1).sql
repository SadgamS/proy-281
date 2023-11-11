-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2019 a las 23:42:38
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdtmecanica`
--

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `servicios_mas_solicitados` (`xidservicio` INT) RETURNS INT(11) begin
declare
    cant int;
    select count(*) into cant
    from servicios_orden_trabajo
    where id_servicio = xidservicio
    group by  id_servicio;
return cant;

end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `suma_trabajos_realizados` (`xidmecanico` INT) RETURNS INT(11) begin
declare
    suma int;
    select sum(neto) into suma
    from orden_trabajo
    where id_mecanico = xidmecanico
    group by  id_mecanico;
return suma;

end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `trabajos_realizados` (`xidmecanico` INT) RETURNS INT(11) begin
declare
    cantidad int;
    select count(*) into cantidad
    from orden_trabajo
    where id_mecanico = xidmecanico
    group by  id_mecanico;
return cantidad;

end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`, `fecha`) VALUES
(1, 'motor', '2019-10-08 01:29:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `ci` int(11) NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish2_ci NOT NULL,
  `email` text COLLATE utf8_spanish2_ci NOT NULL,
  `ultimo_arreglo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `ci`, `direccion`, `telefono`, `email`, `ultimo_arreglo`) VALUES
(1, 'Juan Vallejos', 8721123, 'calle Pedro #12', '777-31212', 'juan@gmail.com', '2019-11-04 00:00:00'),
(2, 'Ramon Ramiro', 4212312, 'Z. Villa Dolores C. 23', '765-12311', 'rramon@gmail.com', '2019-11-07 23:55:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mecanico`
--

CREATE TABLE `mecanico` (
  `id_mecanico` int(11) NOT NULL,
  `ci` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish2_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `mecanico`
--

INSERT INTO `mecanico` (`id_mecanico`, `ci`, `nombre`, `apellido`, `telefono`, `direccion`, `estado`, `fecha_ingreso`) VALUES
(1, 5432121, 'Victor', 'Apaza', '754-91231', 'Z. Villa Adela', 0, '2019-10-25'),
(2, 6351224, 'Pedro', 'Mamani', '743-13051', 'Av. Juan Pablo II #32', 1, '2019-10-26'),
(3, 6321241, 'Mario', 'Mamani', '671-23121', 'Villa Fatima #123', 0, '2019-11-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_trabajo`
--

CREATE TABLE `orden_trabajo` (
  `id_orden` int(11) NOT NULL,
  `nro_orden` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `impuesto` int(11) NOT NULL,
  `neto` int(11) NOT NULL,
  `id_mecanico` int(11) NOT NULL,
  `id_vehiculo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `orden_trabajo`
--

INSERT INTO `orden_trabajo` (`id_orden`, `nro_orden`, `fecha`, `total`, `impuesto`, `neto`, `id_mecanico`, `id_vehiculo`, `id_cliente`) VALUES
(1, 10001, '2019-11-04 22:11:33', 187, 17, 170, 1, 1, 1),
(2, 10002, '2019-11-04 22:11:33', 264, 24, 240, 1, 1, 1),
(3, 10003, '2019-11-04 00:00:00', 154, 14, 140, 1, 1, 1),
(4, 10004, '2019-11-04 00:00:00', 187, 17, 170, 3, 1, 1),
(5, 10005, '2019-11-07 23:55:19', 167, 27, 140, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuesto`
--

CREATE TABLE `repuesto` (
  `id_repuesto` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `tipo_repuesto` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `marca` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `imagen` text COLLATE utf8_spanish2_ci NOT NULL,
  `observacion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `ventas` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `repuesto`
--

INSERT INTO `repuesto` (`id_repuesto`, `codigo`, `tipo_repuesto`, `marca`, `stock`, `precio_compra`, `precio_venta`, `imagen`, `observacion`, `ventas`, `id_categoria`) VALUES
(2, 101, 'aceite de motor', 'castrol', 8, 60, 70, 'vistas/img/repuestos/101/361.jpg', 'ninguno', 11, 1),
(3, 102, 'aceite de motor 20w 50', 'Quaker State', 20, 100, 200, 'vistas/img/repuestos/102/499.jpg', 'galon', 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repuestos_orden_trabajo`
--

CREATE TABLE `repuestos_orden_trabajo` (
  `id_orden` int(11) NOT NULL,
  `id_repuesto` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `repuestos_orden_trabajo`
--

INSERT INTO `repuestos_orden_trabajo` (`id_orden`, `id_repuesto`, `precio`, `cantidad`, `total`) VALUES
(1, 2, 70, 1, 70),
(2, 2, 70, 1, 70),
(3, 2, 70, 1, 70),
(4, 2, 70, 1, 70),
(5, 2, 70, 1, 70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `nombre_servicio` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `costo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `nombre_servicio`, `costo`) VALUES
(1, 'Cambio de aceite', 70),
(2, 'Reparacion de frenos', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_orden_trabajo`
--

CREATE TABLE `servicios_orden_trabajo` (
  `id_orden` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `servicios_orden_trabajo`
--

INSERT INTO `servicios_orden_trabajo` (`id_orden`, `id_servicio`) VALUES
(2, 1),
(2, 2),
(3, 1),
(4, 2),
(1, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'Administrador', 'admin', '$2a$07$asxx54ahjppf45sd87a5aunxs9bkpyGmGE/.vekdjFg83yRec789S', 'Administrador', '', 1, '2019-11-08 16:45:58', '2019-11-08 20:45:58'),
(3, 'Juan Perez', 'juan', '$2a$07$asxx54ahjppf45sd87a5au.U/M0caGNRi1j0bgxZqVwBDctNLt11O', 'Mecanico', 'vistas/img/usuarios/juan/437.png', 1, '2019-11-08 16:46:29', '2019-11-08 20:46:29'),
(4, 'Ana Gonzales', 'ana', '$2a$07$asxx54ahjppf45sd87a5auzGfz9GaOjSPJ5jEDpHii9vSQEEqY1Zm', 'Administrador', 'vistas/img/usuarios/ana/165.png', 0, '0000-00-00 00:00:00', '2019-10-26 23:13:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id_vehiculo` int(11) NOT NULL,
  `placa` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `modelo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `anho` int(11) NOT NULL,
  `color` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `kilometraje` int(11) NOT NULL,
  `nro_arreglos` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id_vehiculo`, `placa`, `marca`, `modelo`, `anho`, `color`, `kilometraje`, `nro_arreglos`, `id_cliente`) VALUES
(1, '4123 ZXA', 'Nissan', 'Caravan', 1900, 'Blanco', 130000, 29, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `mecanico`
--
ALTER TABLE `mecanico`
  ADD PRIMARY KEY (`id_mecanico`);

--
-- Indices de la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `id_mecanico` (`id_mecanico`),
  ADD KEY `id_vehiculo` (`id_vehiculo`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `repuesto`
--
ALTER TABLE `repuesto`
  ADD PRIMARY KEY (`id_repuesto`),
  ADD KEY `FK_id_categoria` (`id_categoria`) USING BTREE;

--
-- Indices de la tabla `repuestos_orden_trabajo`
--
ALTER TABLE `repuestos_orden_trabajo`
  ADD KEY `id_orden` (`id_orden`),
  ADD KEY `id_repuesto` (`id_repuesto`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `servicios_orden_trabajo`
--
ALTER TABLE `servicios_orden_trabajo`
  ADD KEY `id_servicio` (`id_servicio`),
  ADD KEY `id_orden` (`id_orden`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mecanico`
--
ALTER TABLE `mecanico`
  MODIFY `id_mecanico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `repuesto`
--
ALTER TABLE `repuesto`
  MODIFY `id_repuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orden_trabajo`
--
ALTER TABLE `orden_trabajo`
  ADD CONSTRAINT `orden_trabajo_ibfk_1` FOREIGN KEY (`id_mecanico`) REFERENCES `mecanico` (`id_mecanico`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_trabajo_ibfk_2` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculo` (`id_vehiculo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_trabajo_ibfk_3` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `repuesto`
--
ALTER TABLE `repuesto`
  ADD CONSTRAINT `repuesto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `repuestos_orden_trabajo`
--
ALTER TABLE `repuestos_orden_trabajo`
  ADD CONSTRAINT `repuestos_orden_trabajo_ibfk_1` FOREIGN KEY (`id_orden`) REFERENCES `orden_trabajo` (`id_orden`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repuestos_orden_trabajo_ibfk_2` FOREIGN KEY (`id_repuesto`) REFERENCES `repuesto` (`id_repuesto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicios_orden_trabajo`
--
ALTER TABLE `servicios_orden_trabajo`
  ADD CONSTRAINT `servicios_orden_trabajo_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicios_orden_trabajo_ibfk_3` FOREIGN KEY (`id_orden`) REFERENCES `orden_trabajo` (`id_orden`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `vehiculo_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
