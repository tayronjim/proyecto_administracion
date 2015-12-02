-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2015 a las 01:09:11
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

DROP TABLE IF EXISTS `actividades`;
CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `fecha` text NOT NULL,
  `actividad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `clave` text,
  `nombre_comercial` text,
  `fecha_alta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `clave`, `nombre_comercial`, `fecha_alta`) VALUES
(1, 'cli1', 'el cli1', '30112015');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_contacto`
--

DROP TABLE IF EXISTS `datos_contacto`;
CREATE TABLE `datos_contacto` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `telefono` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

DROP TABLE IF EXISTS `estatus`;
CREATE TABLE `estatus` (
  `id` int(11) NOT NULL,
  `clave` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

DROP TABLE IF EXISTS `proyecto`;
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
(1, 1, 2, 0, 'qwe', '02122015', '01012015', '00000000', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_facturacion`
--

DROP TABLE IF EXISTS `registro_facturacion`;
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
(2, 1, 'cli118181985yui', 'cli sc', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

DROP TABLE IF EXISTS `seguimiento`;
CREATE TABLE `seguimiento` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `fecha` text NOT NULL,
  `actividad` text NOT NULL
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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `registro_facturacion`
--
ALTER TABLE `registro_facturacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
