-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-07-2016 a las 17:31:10
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
-- Estructura de tabla para la tabla `estatus_funnel`
--

CREATE TABLE `estatus_funnel` (
  `id` int(11) NOT NULL,
  `clave` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estatus_funnel`
--

UPDATE `estatus_funnel` SET `id` = 1,`clave` = 1,`descripcion` = '{"clave":"1","nombre":"1- POR CONTACTAR","avance":"0%"}' WHERE `estatus_funnel`.`id` = 1;
UPDATE `estatus_funnel` SET `id` = 2,`clave` = 2,`descripcion` = '{"clave":"2","nombre":"2- SEGUIMIENTO INICIAL","avance":"0%"}' WHERE `estatus_funnel`.`id` = 2;
UPDATE `estatus_funnel` SET `id` = 3,`clave` = 3,`descripcion` = '{"clave":"3","nombre":"3- EN PROSPECTACIÓN","avance":"0%"}' WHERE `estatus_funnel`.`id` = 3;
UPDATE `estatus_funnel` SET `id` = 4,`clave` = 4,`descripcion` = '{"clave":"4","nombre":"4- EN COTIZACIÓN","avance":"0%"}' WHERE `estatus_funnel`.`id` = 4;
UPDATE `estatus_funnel` SET `id` = 5,`clave` = 5,`descripcion` = '{"clave":"5","nombre":"5- EN NEGOCIACIÓN","avance":"0%"}' WHERE `estatus_funnel`.`id` = 5;
UPDATE `estatus_funnel` SET `id` = 6,`clave` = 6,`descripcion` = '{"clave":"6","nombre":"6- EN PROCESO DE CIERRE","avance":"0%"}' WHERE `estatus_funnel`.`id` = 6;
UPDATE `estatus_funnel` SET `id` = 7,`clave` = 7,`descripcion` = '{"clave":"7","nombre":"7- VENDIDO","avance":"0%"}' WHERE `estatus_funnel`.`id` = 7;
UPDATE `estatus_funnel` SET `id` = 8,`clave` = 8,`descripcion` = '{"clave":"8","nombre":"8- CANCELADO","avance":"0%"}' WHERE `estatus_funnel`.`id` = 8;
UPDATE `estatus_funnel` SET `id` = 9,`clave` = 9,`descripcion` = '{"clave":"9","nombre":"9- DETENIDO","avance":"0%"}' WHERE `estatus_funnel`.`id` = 9;
UPDATE `estatus_funnel` SET `id` = 10,`clave` = 10,`descripcion` = '{"clave":"10","nombre":"10- SE RECOMENDÓ A SERVIPRES","avance":"0%"}' WHERE `estatus_funnel`.`id` = 10;
UPDATE `estatus_funnel` SET `id` = 11,`clave` = 11,`descripcion` = '{"clave":"11","nombre":"11- CERRADO","avance":"0%"}' WHERE `estatus_funnel`.`id` = 11;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estatus_funnel`
--
ALTER TABLE `estatus_funnel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estatus_funnel`
--
ALTER TABLE `estatus_funnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
