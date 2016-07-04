-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2016 a las 00:51:16
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
  `id_funnel` int(11) NOT NULL,
  `actividad` varchar(2000) DEFAULT '[]',
  `seguimiento` varchar(5000) NOT NULL DEFAULT '[]',
  `seguimiento_cancelado` varchar(5000) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `actividades`
--

TRUNCATE TABLE `actividades`;
--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `id_proyecto`, `id_funnel`, `actividad`, `seguimiento`, `seguimiento_cancelado`) VALUES
(26, 28, 0, '[{"fecha":"20106-01-05","act":"Se autoriza la vacante vía web."},{"fecha":"2016-02-01","act":"Se tiene búsqueda, sin embargo no hemos tenido respuesta porque nuestro contacto está de incapacidad."},{"fecha":"2016-02-15","act":"Se envía correo con dudas de la posición."},{"fecha":"2016-03-11","act":"Gabriela (contacto), nos regresa la llamada, responde dudas y se acordó que el día de hoy se le hará llegar la información de 5 candidatos."}]', '[{"fecha":"2016-03-14","act":"Confirmar el envío y recepción de los 5 candidatos presentados al cliente: Mauricio Calles Viñas, Carlos Mondragón, Rosa Amezola, Guillermo Luna, Arturo Suárez y Edgar Mancera."}]', '[]'),
(27, 29, 0, '[{"fecha":"2016-01-04","act":"Nos autoriza el cliente el inicio de la posición."},{"fecha":"2016-03-11","act":"Vacante detenida porque Elias Serur nos comenta que primero necesita capacitar a su gerente de tiendas para posterior ingresar esta posición"}]', '[{"fecha":"2016-03-14","act":"Preguntar al cliente el status de la posición."}]', '[]'),
(28, 30, 0, '[{"fecha":"2016-03-01","act":"Se integra a trabajar un candidato proporcionado por el cliente."}]', '[{"fecha":"2016-03-17","act":"Seguimiento al mapeo de candidatos."},{"fecha":"2016-03-24","act":"Seguimiento a la entrevista de candidatos."},{"fecha":"2016-03-31","act":"Presentación al cliente de mapeo de candidatos"}]', '[]'),
(32, 34, 0, '[{"fecha":"2016-02-28","act":"Se presentan 3 candidatos finalistas a entrevistar por el cliente."},{"fecha":"2016-02-17","act":"Se planeaba contratar a 2 candidatos, sin embargo uno declina al proceso."},{"fecha":"2016-02-26","act":"Se le hace propuesta económica por parte del cliente a candidato finalista: Norberto Murillo"},{"fecha":"2016-03-14","act":"Ingresa Norberto Murillo a la empresa"}]', '[{"fecha":"2016-04-28","act":"Primer seguimiento a garantía"},{"fecha":"2016-06-07","act":"Segundo seguimiento a garantía"},{"fecha":"2016-06-12","act":"Ultimo seguimiento a garantía"}]', '[]'),
(33, 35, 0, '[{"fecha":"2016-02-24","act":"Presentación de 3 candidatos al cliente."},{"fecha":"2016-03-10","act":"Cliente se decide por candidata finalista, cambia la posición a Gerente (originalmente era planeador financiero). Presentan carta oferta a Ana Paula Sahagún"},{"fecha":"2016-03-14","act":"Cliente cuenta con expediente completo de Ana Paula (referencias y psicometría)"}]', '[{"fecha":"2016-05-12","act":"Primer seguimiento a garantía"},{"fecha":"2016-06-21","act":"Segundo seguimiento a garantía"},{"fecha":"2016-06-26","act":"Último seguimiento a garantía"},{"fecha":"2016-04-28","act":"Ana Paula Sahagún se integra a la empresa."},{"fecha":"2016-04-28","act":"Facturación del 70% por contratación"}]', '[]'),
(34, 36, 0, '[]', '[]', '[]'),
(35, 37, 0, '[]', '[]', '[]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `datos_cliente` varchar(5000) NOT NULL DEFAULT '[]',
  `datos_contacto` varchar(5000) NOT NULL DEFAULT '[]',
  `facturacion` varchar(5000) DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `clientes`
--

TRUNCATE TABLE `clientes`;
--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `datos_cliente`, `datos_contacto`, `facturacion`) VALUES
(19, '{"publico":"Nature Sweet","observaciongenerales":"","web":"","industria":"1","riesgo":"1","fecha":"2016-03-11"}', '[{"idcontacto":"1","nombre":"","area":"","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"rs","rfc":"rfc","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"1"},{"idfac":"1","rs":"rs2","rfc":"rfc2","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(20, '{"publico":"Ferretería Serur","observaciongenerales":"","web":"","industria":"7","riesgo":"1","fecha":"2016-03-11"}', '[{"idcontacto":"1","nombre":"","area":"","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(21, '{"publico":"Mouser Electronics","observaciongenerales":"","web":"","industria":"10","riesgo":"1","fecha":"2016-01-14"}', '[{"idcontacto":"1","nombre":"","area":"","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(22, '{"publico":"Tequilera","observaciongenerales":"","web":"","industria":"7","riesgo":"1","fecha":"2016-03-14"}', '[{"idcontacto":"1","nombre":"","area":"","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(23, '{"publico":"pruebas","observaciongenerales":"","web":"","industria":"1","riesgo":"1","fecha":""}', '[]', '[{"idfac":"0","rs":"rs1","rfc":"rfc1","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"},{"idfac":"1","rs":"rs2","rfc":"rfc2","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(24, '{"publico":"cliente de pruebas","observaciongenerales":"","web":"","industria":"3","riesgo":"1","fecha":""}', '[{"idcontacto":"5","nombre":"persona 1","area":"area 1","cumpleaños":"2016-01-01","observaciones":"obs 1","medioDeContacto":[{"tipoContacto":"1","valorContacto":"111111111"},{"tipoContacto":"2","valorContacto":"22222222"},{"tipoContacto":"3","valorContacto":"333333"},{"tipoContacto":"4","valorContacto":"4444444"}]},{"idcontacto":"6","nombre":"persona 2","area":"area 2","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":"123456789"}]}]', '[{"idfac":"0","rs":"cliente pruebas","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"1"}]');

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

--
-- Truncar tablas antes de insertar `estatus`
--

TRUNCATE TABLE `estatus`;
--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id`, `clave`, `descripcion`) VALUES
(1, '1', '{"id":"1","nombre":"1- BÚSQUEDA DE CANDIDATOS","avance":"12.5%"}'),
(2, '2', '{"id":"2","nombre":"2- ENTREVISTA INTERNA","avance":"25%"}'),
(3, '3', '{"id":"3","nombre":"3- INFORMACIÓN CON CLIENTE","avance":"37.5%"}'),
(4, '4', '{"id":"4","nombre":"4- ENTREVISTAS CON CLIENTE","avance":"50%"}'),
(5, '5', '{"id":"5","nombre":"5- SELECCIÓN POR CLIENTE","avance":"62.5%"}'),
(6, '6', '{"id":"6","nombre":"6- NEGOCIACIÓN DE CONTRATACIÓN","avance":"75%"}'),
(7, '7', '{"id":"7","nombre":"7- EN PROCESO DE INGRESO","avance":"87.5%"}'),
(8, '8', '{"id":"8","nombre":"8- CERRADO/EN GARANTÍA","avance":"98%"}'),
(9, '9', '{"id":"9","nombre":"9- CERRADO","avance":"100%"}'),
(10, '10', '{"id":"10","nombre":"10- DETENIDO","avance":"0%"}'),
(11, '11', '{"id":"11","nombre":"11- CANCELADO","avance":"0%"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus_funnel`
--

DROP TABLE IF EXISTS `estatus_funnel`;
CREATE TABLE `estatus_funnel` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `estatus_funnel`
--

TRUNCATE TABLE `estatus_funnel`;
--
-- Volcado de datos para la tabla `estatus_funnel`
--

INSERT INTO `estatus_funnel` (`id`, `descripcion`) VALUES
(1, '{"clave":"1","nombre":"1- POR CONTACTAR","avance":"0%"}'),
(2, '{"clave":"2","nombre":"2- SEGUIMIENTO INICIAL","avance":"0%"}'),
(3, '{"clave":"3","nombre":"3- EN PROSPECTACIÓN","avance":"0%"}'),
(4, '{"clave":"4","nombre":"4- EN COTIZACIÓN","avance":"0%"}'),
(5, '{"clave":"5","nombre":"5- EN NEGOCIACIÓN","avance":"0%"}'),
(6, '{"clave":"6","nombre":"6- EN PROCESO DE CIERRE","avance":"0%"}'),
(7, '{"clave":"7","nombre":"7- VENDIDO","avance":"0%"}'),
(8, '{"clave":"8","nombre":"8- CANCELADO","avance":"0%"}'),
(9, '{"clave":"9","nombre":"9- DETENIDO","avance":"0%"}'),
(10, '{"clave":"10","nombre":"10- SE RECOMENDÓ A SERVIPRES","avance":"0%"}'),
(11, '{"clave":"11","nombre":"11- CERRADO","avance":"0%"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funnel`
--

DROP TABLE IF EXISTS `funnel`;
CREATE TABLE `funnel` (
  `id` int(10) UNSIGNED NOT NULL,
  `proyecto` varchar(500) NOT NULL,
  `estatus` varchar(255) NOT NULL,
  `facturacion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `funnel`
--

TRUNCATE TABLE `funnel`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kam`
--

DROP TABLE IF EXISTS `kam`;
CREATE TABLE `kam` (
  `id` int(11) NOT NULL,
  `datos` varchar(20000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `kam`
--

TRUNCATE TABLE `kam`;
--
-- Volcado de datos para la tabla `kam`
--

INSERT INTO `kam` (`id`, `datos`) VALUES
(1, '{"idColaborador":"1","codigo":"1","nombrec":"Zulma","nombrel":"Zulma Toscano","apoyo":"1","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"1"}}'),
(2, '{"idColaborador":"2","codigo":"2","nombrec":"Edgar","nombrel":"Edgar López","apoyo":"1","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"1"}}'),
(3, '{"idColaborador":"3","codigo":"3","nombrec":"Delia","nombrel":"Delia Monteon Hurtado","apoyo":"1","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"1"}}'),
(4, '{"idColaborador":"4","codigo":"4","nombrec":"Vero","nombrel":"Verónica Escoto Sánchez","apoyo":"1","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"1"}}'),
(5, '{"idColaborador":"5","codigo":"5","nombrec":"Diego","nombrel":"Diego Sicilia","apoyo":"1","activo":"1","puesto":{"consultor":"0","reclutador":"1","apoyo":"1"}}'),
(6, '{"idColaborador":"6","codigo":"6","nombrec":"Migue","nombrel":"Miguel Comparan Meza","apoyo":"1","activo":"1","puesto":{"consultor":"1","reclutador":"1","apoyo":"1"}}'),
(7, '{"idColaborador":"7","codigo":"7","nombrec":"Kaz","nombrel":"Kazandra Gómez Madera","apoyo":"0","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"0"}}'),
(8, '{"idColaborador":"8","codigo":"8","nombrec":"Eugenio","nombrel":"Eugenio Aimar","apoyo":"0","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"0"}}'),
(9, '{"idColaborador":"9","codigo":"1","nombrec":"Benjamin","nombrel":"Benjamin Díaz Morones","apoyo":"0","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"0"}}'),
(10, '{"idColaborador":"0","codigo":"","nombrec":"Janette","nombrel":"Janette Hernández","apoyo":"1","activo":"1","puesto":{"consultor":"0","reclutador":"1","apoyo":"1"}}'),
(11, '{"idColaborador":"0","nombrec":"Monica","nombrel":"Monica Diaz","apoyo":"1","activo":"1","puesto":{"consultor":"1","reclutador":"1","apoyo":"1"}}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

DROP TABLE IF EXISTS `proyecto`;
CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `cliente` varchar(50) NOT NULL DEFAULT '[]',
  `id_proyecto_hermano` int(11) NOT NULL,
  `datos_proyecto` varchar(5000) NOT NULL DEFAULT '[]',
  `facturacion` varchar(5000) NOT NULL DEFAULT '[]',
  `contrato` varchar(5000) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncar tablas antes de insertar `proyecto`
--

TRUNCATE TABLE `proyecto`;
--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `cliente`, `id_proyecto_hermano`, `datos_proyecto`, `facturacion`, `contrato`) VALUES
(28, '{"cliente":"19","razonS":"0","contacto":"0"}', 0, '{"wbs":"","empint":"AIMS","kam":"4","reclutador":"-1","kam2":null,"apoyo":"-1","prioridad":"2","fIniY":"2016","fIniM":"01","fIniD":"05","fCIdealY":"2016","fCIdealM":"04","fCIdealD":"05","fCRealY":null,"fCRealM":null,"fCRealD":null,"estatus":"3","posicion":"Lider Sispa","disciplina":"11","cta":"1","nivel":"4","salario":"30,000","aguinaldo":"","vacaciones":"","primavacacional":"","bono":"","fondo":null,"bales":null,"sgmm":null,"segvida":null,"otraprestacion":""}', '{"valorproyecto":"30,000.00","totalfacturado":"0.00","porcfacturado":"0.00%","xfacturar":"30,000.00","lista":{"facno1":"","monto1":"","fenvio1":"","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"fGarantiaY":null,"fGarantiaM":null,"fGarantiaD":null,"convenio":"si","garantia":"60","hdnhonorarios":"","honorarios":"unMesNominal","acuerdofacturacion":"otro"}'),
(29, '{"cliente":"20","razonS":"","contacto":"-1"}', 0, '{"wbs":"","empint":"contrata","kam":"4","reclutador":"-1","kam2":null,"apoyo":"-1","prioridad":"1","fIniY":"2016","fIniM":"01","fIniD":"04","fCIdealY":"2016","fCIdealM":"04","fCIdealD":"14","fCRealY":"2016","fCRealM":"03","fCRealD":"14","posicion":"Gerente de Tiendas","disciplina":"-1","cta":"1","nivel":"6","salario":"8,000","estatus":"10"}', '{"valorproyecto":"8,000.00","totalfacturado":"0.00","porcfacturado":"0.00%","xfacturar":"8,000.00","lista":{"facno1":"","monto1":"","fenvio1":"","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"fGarantiaY":"2016","fGarantiaM":"5","fGarantiaD":"12","convenio":"si","garantia":"60","hdnhonorarios":"","honorarios":"unMesNominal","acuerdofacturacion":"opc3_7"}'),
(30, '{"cliente":"21","razonS":""}', 0, '{"wbs":"","empint":"contrata","kam":"4","prioridad":"1","fIniY":"2016","fIniM":"01","fIniD":"14","fCIdealY":"2016","fCIdealM":"03","fCIdealD":"01","fCRealY":null,"fCRealM":null,"fCRealD":null,"posicion":"Customer Service Representative","disciplina":"9","cta":"1","nivel":"6","salario":"10,000 + bono 3,200","estatus":"1"}', '{"valorproyecto":"16,764","totalfacturado":"0","porcfacturado":"0","xfacturar":"16,764","lista":{"facno1":"","monto1":"","fenvio1":"","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"convenio":"si","garantia":"90","hdnhonorarios":"","honorarios":"10","acuerdofacturacion":"opc3_7","fGarantiaY":null,"fGarantiaM":null,"fGarantiaD":null,"garantiaMedioTiempo":"on","garantia5Dias":"on"}'),
(34, '{"cliente":"22","razonS":"","contacto":"-1"}', 0, '{"wbs":"2016-01K","empint":null,"kam":"7","reclutador":"-1","kam2":null,"apoyo":"-1","prioridad":"1","fIniY":"2016","fIniM":"02","fIniD":"02","fCIdealY":"2016","fCIdealM":"04","fCIdealD":"02","fCRealY":"2016","fCRealM":"03","fCRealD":"14","posicion":"Jefe de Mantenimiento y Planeación","disciplina":"7","cta":"1","nivel":"4","salario":"28,000 + 2,000 tras periodo de prueba","estatus":"8"}', '{"valorproyecto":"36,857.00","totalfacturado":"11,057.76","porcfacturado":"30.00%","xfacturar":"25,799.24","lista":{"facno1":"531","monto1":"11,057.76","fenvio1":"2016-03-04","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"fGarantiaY":"2016","fGarantiaM":"6","fGarantiaD":"11","convenio":"si","garantia":"90","hdnhonorarios":"","honorarios":"10","acuerdofacturacion":"opc3_7"}'),
(35, '{"cliente":"22","razonS":"0"}', 0, '{"wbs":"2016-02K","empint":"dma","kam":"7","prioridad":"1","fIniY":"2016","fIniM":"02","fIniD":"02","fCIdealY":"2016","fCIdealM":"03","fCIdealD":"28","fCRealY":null,"fCRealM":null,"fCRealD":null,"posicion":"Gerente de Finanzas","disciplina":"3","cta":"1","nivel":"3","salario":"43,000","estatus":"1"}', '{"valorproyecto":"56000","totalfacturado":"0","porcfacturado":"0 %","xfacturar":"56000","lista":{"facno1":"","monto1":"","fenvio1":"","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"convenio":"si","garantia":"90","hdnhonorarios":"","honorarios":"10","acuerdofacturacion":"opc3_7","fGarantiaY":null,"fGarantiaM":null,"fGarantiaD":null,"garantiaMedioTiempo":"on","garantia5Dias":"on"}'),
(36, '{"cliente":"19","razonS":"-1"}', 0, '{"wbs":"2016-36BE","empint":"SICSA","kam":"9","reclutador":"-1","kam2":"-1","apoyo":"-1","prioridad":"1","fIniY":"2016","fIniM":"04","fIniD":"12","fCIdealY":"2018","fCIdealM":"01","fCIdealD":"01","fCRealY":null,"fCRealM":null,"fCRealD":null,"estatus":"1","posicion":"pruebas","disciplina":"2","cta":"1","nivel":"1","salario":"10,000.00","aguinaldo":"1","vacaciones":"1","primavacacional":"1","bono":"1","fondo":"no","bales":"no","sgmm":"no","segvida":"no","otraprestacion":""}', '{"valorproyecto":"13,033.67","totalfacturado":"0.00","porcfacturado":"0.00%","xfacturar":"13,033.67","lista":{"facno1":"","monto1":"","fenvio1":"","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"fGarantiaY":null,"fGarantiaM":null,"fGarantiaD":null,"convenio":"no","garantia":"60","hdnhonorarios":"","honorarios":"unMesNominal","acuerdofacturacion":"opc3_7"}'),
(37, '{"cliente":"23","razonS":"0","contacto":"1"}', 0, '{"empint":"AIMS","wbs":"2016-37ED","kam":"2","reclutador":"-1","kam2":"-1","apoyo":"-1","prioridad":"1","fIniY":"2016","fIniM":"04","fIniD":"13","fCIdealY":"2018","fCIdealM":"01","fCIdealD":"01","posicion":"pruebas 2","disciplina":"1","cta":"2","nivel":"1","estatus":"1","salario":"10,000.00","aguinaldo":"1","vacaciones":"1","primavacacional":"1","bono":"1","fondo":"no","bales":"no","sgmm":"no","segvida":"no","otraprestacion":""}', '{"valorproyecto":"13,033.67","totalfacturado":"0","porcfacturado":"0","xfacturar":"13,033.67","facno1":"","monto1":"","fenvio1":"","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}', '{"convenio":"no","garantia":"60","honorarios":"unMesNominal","acuerdofacturacion":"opc3_7","fGarantiaY":"0000","fGarantiaM":"00","fGarantiaD":"00","garantiaMedioTiempo":"0","garantia5Dias":"0"}');

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
-- Indices de la tabla `estatus_funnel`
--
ALTER TABLE `estatus_funnel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `funnel`
--
ALTER TABLE `funnel`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `estatus_funnel`
--
ALTER TABLE `estatus_funnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `funnel`
--
ALTER TABLE `funnel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `kam`
--
ALTER TABLE `kam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
