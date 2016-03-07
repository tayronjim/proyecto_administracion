-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-03-2016 a las 19:58:04
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

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `actividad` varchar(2000) DEFAULT '[]',
  `seguimiento` varchar(5000) NOT NULL DEFAULT '[]',
  `seguimiento_cancelado` varchar(5000) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `id_proyecto`, `actividad`, `seguimiento`, `seguimiento_cancelado`) VALUES
(15, 18, '[]', '[{"fecha":"2016-01-26","act":"seguimiento de actividad"}]', '[]'),
(16, 19, '[{"fecha":"2015-12-09","act":"sdfdsf"},{"fecha":"2015-12-09","act":"sdfdsf"},{"fecha":"2015-12-09","act":"sdfdsf"},{"fecha":"2015-12-09","act":"sdfdsf"},{"fecha":"2015-12-09","act":"sdfdsf"},{"fecha":"2016-01-29","act":"123"},{"fecha":"2016-01-21","act":"12334565678768 completado"},{"fecha":"2016-01-05","act":"fsdfsa\\nsdfdsa\\nsdfdsaf"}]', '[{"fecha":"2016-01-21","act":"sdfs234dhg56 htr h6h 6h5 6hhth"},{"fecha":"2016-01-26","act":"djflk dsflkjdslkfjdslkf jdlkf jñlkdsajflk432jr 94jr iewajr0843 jrpoiewjr 0932j fpoiewajf eajf"},{"fecha":"2016-01-29","act":"23lj4lj3hr ewñlr añjf ñdskfjdsfñ djf dsañkjf ñk3jr´pafñadjfjñfj\\ndsa\\n fsd\\nf\\ndsf\\ndsf"}]', '[]'),
(17, 19, '[{"fecha":"2015-12-09","act":"sdfdsf"},{"fecha":"2015-12-09","act":"sdfdsf"},{"fecha":"2015-12-09","act":"sdfdsf"},{"fecha":"2015-12-09","act":"sdfdsf"},{"fecha":"2015-12-09","act":"sdfdsf"},{"fecha":"2016-01-29","act":"123"},{"fecha":"2016-01-21","act":"12334565678768 completado"},{"fecha":"2016-01-05","act":"fsdfsa\\nsdfdsa\\nsdfdsaf"}]', '[{"fecha":"2016-01-21","act":"sdfs234dhg56 htr h6h 6h5 6hhth"},{"fecha":"2016-01-26","act":"djflk dsflkjdslkfjdslkf jdlkf jñlkdsajflk432jr 94jr iewajr0843 jrpoiewjr 0932j fpoiewajf eajf"},{"fecha":"2016-01-29","act":"23lj4lj3hr ewñlr añjf ñdskfjdsfñ djf dsañkjf ñk3jr´pafñadjfjñfj\\ndsa\\n fsd\\nf\\ndsf\\ndsf"}]', '[]'),
(18, 20, '[]', '[]', '[]'),
(19, 21, '[]', '[]', '[]'),
(20, 22, '[]', '[]', '[]'),
(21, 23, '[]', '[]', '[]'),
(22, 24, '[]', '[]', '[]'),
(23, 25, '[]', '[]', '[]'),
(24, 26, '[]', '[]', '[]'),
(25, 27, '[]', '[]', '[]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `datos_cliente` varchar(5000) NOT NULL DEFAULT '[]',
  `datos_contacto` varchar(5000) NOT NULL DEFAULT '[]',
  `facturacion` varchar(5000) DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `datos_cliente`, `datos_contacto`, `facturacion`) VALUES
(8, '{"codigo":"ANTEUS","publico":"ANTEUS","industria":"3","fecha":""}', '[{"idcontacto":"undefined","nombre":"nombre 1","area":"area 1","telefono":"tel 1","observaciones":"obs 1"}]', '[{"idfac":"0","rs":"ANTEUS CONSTRUCTORA S.A de C.V.","rfc":"ACO123456QWE","calle":"calle","ext":"1","nint":"2","cp":"12345","ciudad":"ciudad","estado":"estado","telefono":"tel","email":"mail","primario":"1"}]'),
(9, '[{"codigo":"codigo 1 ","publico":"nombre comer 1","inudustria":"industria 1","fecha":"2015-12-23"}]', '[{"idfac":"1","nombre":"","area":"","telefono":"","observaciones":""}]', '[{"idfac":"0","rs":"rs 1","rfc":"rfc 1","primario":"1"}]'),
(10, '[{"codigo":"codigo 1 ","publico":"nombre comer 1","inudustria":"industria 1","fecha":"2015-12-23"}]', '[]', '[{"idfac":"0","rs":"rs 1","rfc":"rfc 1","primario":"1"}]'),
(11, '{"codigo":"codigo 1 ","publico":"nombre comer 1","inudustria":"industria 1","fecha":"2015-12-23"}', '[{"idcontacto":"2","nombre":"qwe","area":"asd","telefono":"zxc","observaciones":"tyu"},{"idcontacto":"2","nombre":"ghj","area":"bnm","telefono":"rty","observaciones":"345"}]', '[{"idfac":"0","rs":"qwe","rfc":"qwe","primario":"1"},{"idfac":"1","rs":"asd","rfc":"asd","primario":"0"}]'),
(12, '{"codigo":"qwe","publico":"asd","industria":"zxc","fecha":"2015-12-03"}', '[]', '[]'),
(13, '{"codigo":"qwe","publico":"asd","industria":"zxc","fecha":"2015-12-03"}', '[{"idcontacto":"0","nombre":"cont1","area":"area1","telefono":"tel1","observaciones":"obs2"},{"idcontacto":"1","nombre":"cont2","area":"area2","telefono":"tel2","observaciones":"obs2"}]', '[{"idfac":"1","rs":"rs 1","rfc":"rfc 1","primario":"1"},{"idfac":"2","rs":"rs 2","rfc":"rfc2","primario":"0"}]'),
(14, '{"codigo":"qwe","publico":"asd","industria":null,"fecha":"2015-12-03"}', '[]', '[{"idfac":"1","rs":"rs 1","rfc":"rfc 1","calle":"1","ext":"undefined","nint":"undefined","cp":"4","ciudad":"5","estado":"6","telefono":"7","email":"8","primario":"1"},{"idfac":"2","rs":"rs 2","rfc":"rfc2","calle":"1","ext":"undefined","nint":"undefined","cp":"4","ciudad":"5","estado":"6","telefono":"7","email":"8","primario":"0"}]'),
(15, '{"codigo":"qwe","publico":"asd","industria":null,"fecha":"2015-12-03"}', '[]', '[{"idfac":"1","rs":"rs 1","rfc":"rfc 1","calle":"1","ext":"undefined","nint":"undefined","cp":"4","ciudad":"5","estado":"6","telefono":"7","email":"8","primario":"1"},{"idfac":"2","rs":"rs 2","rfc":"rfc2","calle":"undefined","ext":"undefined","nint":"undefined","cp":"undefined","ciudad":"undefined","estado":"undefined","telefono":"undefined","email":"undefined","primario":"0"}]'),
(16, '{"codigo":"qwe","publico":"asd","industria":"5","fecha":"2015-12-03"}', '[{"idcontacto":"0","nombre":"nomb 1","area":"area 1","telefono":"tel 1","observaciones":"obs1"},{"idcontacto":"1","nombre":"2","area":"2","telefono":"2","observaciones":"2"}]', '[{"idfac":"1","rs":"rs 1","rfc":"rfc 1","calle":"1","ext":"2","nint":"3","cp":"4","ciudad":"5","estado":"6","telefono":"7","email":"8","primario":"1"},{"idfac":"2","rs":"rs 2","rfc":"rfc2","calle":"q","ext":"w","nint":"e","cp":"r","ciudad":"t","estado":"y","telefono":"u","email":"i","primario":"0"}]'),
(17, '{"codigo":"cli 17","publico":"cliente 17","industria":"6","fecha":"2016-01-12"}', '[]', '[{"idfac":"0","rs":"rs ","rfc":"rfc 1","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(18, '{"codigo":"cli1","publico":"patito","industria":"1","fecha":"2015-12-31"}', '[]', '[{"idfac":"0","rs":"rs de patito","rfc":"rsp123456asd","calle":"su calle","ext":"","nint":"","cp":"12345","ciudad":"ciudad","estado":"estado","telefono":"1234567890","email":"cosas@mas.com","primario":"1"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `id` int(11) NOT NULL,
  `clave` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id`, `clave`, `descripcion`) VALUES
(1, '1', '{"id":"1","nombre":"1- BÚSQUEDA DE CANDIDATOS","avance":"0%"}'),
(2, '2', '{"id":"2","nombre":"2- ENTREVISTA INTERNA","avance":"0%"}'),
(3, '3', '{"id":"3","nombre":"3- INFORMACIÓN CON CLIENTE","avance":"0%"}'),
(4, '4', '{"id":"4","nombre":"4- ENTREVISTAS CON CLIENTE","avance":"0%"}'),
(5, '5', '{"id":"5","nombre":"5- SELECCIÓN POR CLIENTE","avance":"0%"}'),
(6, '6', '{"id":"6","nombre":"6- NEGOCIACIÓN DE CONTRATACIÓN","avance":"0%"}'),
(7, '7', '{"id":"7","nombre":"7- EN PROCESO DE INGRESO","avance":"0%"}'),
(8, '8', '{"id":"8","nombre":"8- CERRADO/EN GARANTÍA","avance":"0%"}'),
(9, '9', '{"id":"9","nombre":"9- CERRADO","avance":"0%"}'),
(10, '10', '{"id":"10","nombre":"10- DETENIDO","avance":"0%"}'),
(11, '11', '{"id":"11","nombre":"11- CANCELADO","avance":"0%"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kam`
--

CREATE TABLE `kam` (
  `id` int(11) NOT NULL,
  `datos` varchar(20000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `kam`
--

INSERT INTO `kam` (`id`, `datos`) VALUES
(1, '{"idColaborador":"1","codigo":"qw1","nombrec":"qwe1","nombrel":"qwe1","puesto":"asd","activo":"1"}'),
(2, '{"idColaborador":"2","codigo":"sdf 2","nombrec":"sdf 2","nombrel":"sdf 2","puesto":"","activo":"0"}'),
(3, '{"idColaborador":"0","codigo":"","nombrec":"","nombrel":"","puesto":""}'),
(4, '{"idColaborador":"4","codigo":"1","nombrec":"1","nombrel":"1","puesto":"1"}'),
(5, '{"idColaborador":"0","codigo":"77","nombrec":"Cod 77","nombrel":"Ejecutor Codigo 77","puesto":"Killer"}'),
(6, '{"idColaborador":"0","codigo":"88","nombrec":"Cod 88","nombrel":"Ejecutor Codigo 88","puesto":"Killer"}'),
(7, '{"idColaborador":"0","codigo":"","nombrec":"","nombrel":"","puesto":""}'),
(8, '{"idColaborador":"0","codigo":"","nombrec":"","nombrel":"","puesto":""}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `cliente` varchar(50) NOT NULL DEFAULT '[]',
  `id_proyecto_hermano` int(11) NOT NULL,
  `datos_proyecto` varchar(5000) NOT NULL DEFAULT '[]',
  `facturacion` varchar(5000) NOT NULL DEFAULT '[]',
  `contrato` varchar(5000) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `cliente`, `id_proyecto_hermano`, `datos_proyecto`, `facturacion`, `contrato`) VALUES
(18, '{"cliente":"13","razonS":"1"}', 0, '{"wbs":"","empint":"dma","kam":"","prioridad":"3","fIniY":"2015","fIniM":"12","fIniD":"28","fCIdealY":"2016","fCIdealM":"03","fCIdealD":"01","fCRealY":null,"fCRealM":null,"fCRealD":null,"posicion":"123","disciplina":"2","cta":"","nivel":null,"salario":"123","estatus":"1"}', '{"valorproyecto":"12345","totalfacturado":"6000","porcfacturado":"48.60267314702308 %","xfacturar":"6345","lista":{"facno1":"","monto1":"1000","fenvio1":"2016-03-02","fpago1":"2016-03-03","facno2":"","monto2":"5000","fenvio2":"2016-03-04","fpago2":"2016-03-07","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"convenio":"no","garantia":null,"hdnhonorarios":"","honorarios":"1200","acuerdofacturacion":"20% 20% 60%","fGarantiaY":null,"fGarantiaM":null,"fGarantiaD":null}'),
(19, '{"cliente":"13","razonS":"2"}', 0, '{"wbs":"ryu","empint":null,"kam":"sdf","prioridad":"3","fIniY":"2015","fIniM":"12","fIniD":"28","fCIdealY":"2017","fCIdealM":"02","fCIdealD":"01","fCRealY":null,"fCRealM":null,"fCRealD":null,"posicion":"rtyu","disciplina":null,"cta":"rtyu","nivel":null,"salario":"40000","estatus":"2"}', '{"valorproyecto":"40000","totalfacturado":"0","porcfacturado":"0 %","xfacturar":"40000","lista":{"facno1":"","monto1":"","fenvio1":"","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"convenio":"si","garantia":"60","hdnhonorarios":"","honorarios":"unMesNominal","acuerdofacturacion":"opc3_7","fGarantiaY":null,"fGarantiaM":null,"fGarantiaD":null}'),
(20, '{"cliente":"15","razonS":"1"}', 0, '{"wbs":"hkh","empint":"dma","kam":"kjh","prioridad":"2","fIniY":"2016","fIniM":"02","fIniD":"24","fCIdealY":"2018","fCIdealM":"01","fCIdealD":"01","fCRealY":null,"fCRealM":null,"fCRealD":null,"posicion":"","disciplina":"3","cta":"","nivel":null,"salario":"12345","estatus":"1"}', '{"valorproyecto":"12345","totalfacturado":"6000","porcfacturado":"48.60267314702308 %","xfacturar":"6345","lista":{"facno1":"","monto1":"3000","fenvio1":"2016-02-03","fpago1":"2016-02-04","facno2":"","monto2":"3000","fenvio2":"2016-02-17","fpago2":"2016-02-18","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"convenio":"si","garantia":null,"hdnhonorarios":"","honorarios":"","acuerdofacturacion":"","fGarantiaY":null,"fGarantiaM":null,"fGarantiaD":null}'),
(21, '{"cliente":"18","razonS":"0"}', 0, '{"wbs":"sdf","empint":null,"kam":"kjhkjh","prioridad":"2","fIniY":"2016","fIniM":"02","fIniD":"24","fCIdealY":"2016","fCIdealM":"03","fCIdealD":"01","fCRealY":"2016","fCRealM":"01","fCRealD":"15","posicion":"","disciplina":"-1","cta":"","nivel":null,"salario":"12345","estatus":"8"}', '{"valorproyecto":"12345","totalfacturado":"0","porcfacturado":"0 %","xfacturar":"12345","lista":{"facno1":"","monto1":"","fenvio1":"","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"convenio":null,"garantia":"60","hdnhonorarios":"","honorarios":"","acuerdofacturacion":"","fGarantiaY":"2016","fGarantiaM":"3","fGarantiaD":"14"}'),
(22, '{"cliente":"13","razonS":"1"}', 0, '{"wbs":"qw","empint":null,"kam":"q","prioridad":"3","fIniY":"2016","fIniM":"02","fIniD":"24","fCIdealY":"2016","fCIdealM":"02","fCIdealD":"28","fCRealY":"2016","fCRealM":"01","fCRealD":"04","posicion":"","disciplina":"-1","cta":"","nivel":null,"salario":"1234","estatus":"8"}', '{"valorproyecto":"12345","totalfacturado":"0","porcfacturado":"0 %","xfacturar":"12345","lista":{"facno1":"","monto1":"","fenvio1":"","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"convenio":null,"garantia":"60","hdnhonorarios":"unMesNominal","honorarios":"unMesNominal","acuerdofacturacion":"opc3_7","fGarantiaY":"2016","fGarantiaM":"3","fGarantiaD":"3"}'),
(24, '{"cliente":"14","razonS":"1"}', 0, '{"wbs":"","empint":"","kam":"","prioridad":"1","fIniY":"2016","fIniM":"02","fIniD":"24","fCIdealY":"2018","fCIdealM":"01","fCIdealD":"01","posicion":"","disciplina":"-1","cta":"","nivel":null,"salario":"123","estatus":"1"}', '{"valorproyecto":"123","totalfacturado":"","porcfacturado":"","xfacturar":"","lista":{"facno1":"","monto1":"","fenvio1":"","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"convenio":"","garantia":"","honorarios":"","acuerdofacturacion":"","fGarantiaY":null,"fGarantiaM":null,"fGarantiaD":null}'),
(25, '{"cliente":"8","razonS":"0"}', 0, '{"wbs":"2015-04","empint":null,"kam":"EDGAR","prioridad":"1","fIniY":"2016","fIniM":"02","fIniD":"24","fCIdealY":"2018","fCIdealM":"01","fCIdealD":"01","fCRealY":"2016","fCRealM":"03","fCRealD":"03","posicion":"GERENTE ADMINISTRATIVO.","disciplina":"2","cta":"3","nivel":null,"salario":"20456","estatus":"8"}', '{"valorproyecto":"20000","totalfacturado":"0","porcfacturado":"0 %","xfacturar":"20000","lista":{"facno1":"","monto1":"","fenvio1":"","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"convenio":null,"garantia":"90","hdnhonorarios":"","honorarios":"123","acuerdofacturacion":"","fGarantiaY":"2016","fGarantiaM":"5","fGarantiaD":"31"}'),
(26, '{"cliente":"8","razonS":"0"}', 0, '{"wbs":"123","empint":"contrata","kam":"1","prioridad":"1","fIniY":"2016","fIniM":"03","fIniD":"07","fCIdealY":"2018","fCIdealM":"01","fCIdealD":"01","posicion":"qwe","disciplina":"1","cta":"3","nivel":"1","salario":"123123","estatus":"1"}', '{"valorproyecto":"123123","totalfacturado":"0","porcfacturado":"0","xfacturar":"123123"}', '{"convenio":"si","garantia":"60","honorarios":"","acuerdofacturacion":"","fGarantiaY":"0000","fGarantiaM":"00","fGarantiaD":"00"}'),
(27, '{"cliente":"8","razonS":"0"}', 0, '{"wbs":"123","empint":"contrata","kam":"1","prioridad":"2","fIniY":"2016","fIniM":"03","fIniD":"07","fCIdealY":"2018","fCIdealM":"01","fCIdealD":"01","posicion":"qwe","disciplina":"1","cta":"3","nivel":"1","salario":"12323","estatus":"1"}', '{"valorproyecto":"12323","totalfacturado":"0","porcfacturado":"0","xfacturar":"12323"}', '{"convenio":"si","garantia":"60","honorarios":"unMesNominal","acuerdofacturacion":"opc3_7","fGarantiaY":"0000","fGarantiaM":"00","fGarantiaD":"00"}');

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
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `kam`
--
ALTER TABLE `kam`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `kam`
--
ALTER TABLE `kam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
