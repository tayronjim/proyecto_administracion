-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2015 a las 19:50:58
-- Versión del servidor: 10.1.8-MariaDB
-- Versión de PHP: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `control_clientes`
--
CREATE DATABASE IF NOT EXISTS `control_clientes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `control_clientes`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `fecha` text,
  `actividad` varchar(2000) DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `id_proyecto`, `fecha`, `actividad`) VALUES
(1, 12, NULL, NULL),
(2, 13, NULL, '[{"fecha":"2015-12-14","act":"890"},{"fecha":"2015-12-14","act":"123"},{"fecha":"2015-12-21","act":"iop"}]'),
(3, 14, NULL, '[]'),
(4, 15, NULL, '[{"fecha":"2015-12-17","act":"sdf"},{"fecha":"2015-12-17","act":"123 123"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `clave` text,
  `nombre_comercial` text,
  `fecha_alta` text NOT NULL,
  `facturacion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `clave`, `nombre_comercial`, `fecha_alta`, `facturacion`) VALUES
(1, 'cli1', 'cli1', '30112015', '[{"idfac":"0","rs":"sdf","rfc":"sdf","primario":"1"}]'),
(2, '02', 'cli2', '20151210', NULL),
(5, 'cli5', 'cli5', '10122015', NULL),
(6, 'cli6', 'cli6', '', NULL),
(7, 'ncli', 'nuevo cliente', '17122015', '[{"idfac":"1","rs":"123","rfc":"123","primario":"0"},{"idfac":"2","rs":"asd","rfc":"asd","primario":"0"},{"idfac":"3","rs":"zxc","rfc":"zxc","primario":"1"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_contacto`
--

CREATE TABLE `datos_contacto` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `telefono` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `id` int(11) NOT NULL,
  `clave` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_rs` int(11) NOT NULL,
  `id_proyecto_hermano` int(11) NOT NULL,
  `titulo` text,
  `fecha_alta` text NOT NULL,
  `fecha_cierre_ideal` text NOT NULL,
  `fecha_cierre_real` text NOT NULL,
  `estatus` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `id_cliente`, `id_rs`, `id_proyecto_hermano`, `titulo`, `fecha_alta`, `fecha_cierre_ideal`, `fecha_cierre_real`, `estatus`) VALUES
(12, 1, 1, 0, 'segundo proyecto', '11122015', '05022016', '00000000', 1),
(13, 2, 2, 0, 'proyecto clienbte 2', '11122015', '01012017', '00000000', 1),
(14, 7, 1, 0, 'proyecto nuevo 17122015', '18122015', '01012017', '00000000', 1),
(15, 7, 2, 0, 'nuevo proyecto version 2 17122015', '18122015', '01012017', '00000000', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_facturacion`
--

CREATE TABLE `registro_facturacion` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `rfc` text NOT NULL,
  `razon_social` text NOT NULL,
  `reg_primario` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `registro_facturacion`
--

INSERT INTO `registro_facturacion` (`id`, `id_cliente`, `rfc`, `razon_social`, `reg_primario`) VALUES
(1, 1, 'cli18091985ryu', 'cli1 sa de cv', 0),
(2, 2, 'cli118181985yui', 'cli sc', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `fecha` text,
  `actividad` varchar(2000) DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seguimiento`
--

INSERT INTO `seguimiento` (`id`, `id_proyecto`, `fecha`, `actividad`) VALUES
(1, 12, '', ''),
(2, 13, NULL, '[{"fecha":"2015-12-22","act":"sdf"},{"fecha":"2015-12-31","act":"ghj"}]'),
(3, 14, NULL, '[]'),
(4, 15, NULL, '[{"fecha":"2015-12-24","act":"xcvxcv"},{"fecha":"2015-12-27","act":"123 qwe asd z  xc"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_cancelado`
--

CREATE TABLE `seguimiento_cancelado` (
  `id` int(11) NOT NULL,
  `seguimiento_id` int(11) DEFAULT NULL,
  `fecha` text,
  `actividad` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `datos_contacto`
--
ALTER TABLE `datos_contacto`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `registro_facturacion`
--
ALTER TABLE `registro_facturacion`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `seguimiento_cancelado`
--
ALTER TABLE `seguimiento_cancelado`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `datos_contacto`
--
ALTER TABLE `datos_contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `registro_facturacion`
--
ALTER TABLE `registro_facturacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `seguimiento_cancelado`
--
ALTER TABLE `seguimiento_cancelado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
