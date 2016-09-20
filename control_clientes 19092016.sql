-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2016 a las 20:40:11
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
  `id_proyecto` int(11) NOT NULL DEFAULT '0',
  `id_funnel` int(11) NOT NULL DEFAULT '0',
  `actividad` varchar(2000) DEFAULT '[]',
  `seguimiento` varchar(5000) NOT NULL DEFAULT '[]',
  `seguimiento_cancelado` varchar(5000) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `id_proyecto`, `id_funnel`, `actividad`, `seguimiento`, `seguimiento_cancelado`) VALUES
(34, 45, 0, '[]', '[]', '[]'),
(35, 45, 0, '[]', '[]', '[]'),
(36, 0, 1, '[{"fecha":"2016-07-04","act":"algo"},{"fecha":"2016-07-04","act":"si terminado"}]', '[]', '[]'),
(37, 0, 2, '[{"fecha":"2016-07-07","act":"Seguimiento a la Firma del Convenio"},{"fecha":"","act":""}]', '[{"fecha":"2016-07-07","act":"Seguimiento a la Firma del Convenio"},{"fecha":"","act":""}]', '[]'),
(38, 44, 3, '[{"fecha":"2016-07-11","act":"Se le mando el conveio"},{"fecha":"2016-07-13","act":"Se le escribio al cliente para ver si tenia alguna duda y no contesto"}]', '[{"fecha":"2016-07-15","act":"Se le da seguimiento por correo"}]', '[]'),
(39, 0, 4, '[]', '[]', '[]'),
(40, 0, 5, '[]', '[{"fecha":"2016-07-15","act":"Delia informa que ya esta trabajando en el proceso pero no se ha firmado el convenio"},{"fecha":"2016-07-18","act":"Se el va a marcar al cliente para recordarle la forma del convenio"}]', '[]'),
(41, 38, 6, '[{"fecha":"2016-06-08","act":"Se le mando correo "}]', '[{"fecha":"2016-07-13","act":"Se le marco para darle seguimiento pero el cliente no había leído elconvenio"},{"fecha":"2016-07-15","act":"Se le va a marcar al cliente para ver si tiene alguna duda sobre el convenio"}]', '[]'),
(42, 0, 7, '[]', '[{"fecha":"2016-07-18","act":"Se le mando correo al cliente para ver si se tenían dudas sobre el convenio "}]', '[]'),
(43, 0, 8, '[]', '[]', '[]'),
(44, 0, 9, '[{"fecha":"2016-07-28","act":"Se van a comunicar "}]', '[{"fecha":"2016-08-16","act":"El contacto no ha contestado"}]', '[]'),
(45, 42, 10, '[{"fecha":"2016-07-18","act":"Se trato de localizar al cliente por medio telefónico y no se encontró "},{"fecha":"2016-07-19","act":"El cliente mandó un correo con sus dudas del convenio "}]', '[{"fecha":"2016-07-28","act":"Se actualizo el convenio y se manda hoy"}]', '[]'),
(46, 0, 11, '[{"fecha":"2016-07-15","act":"El cliente respondió el correo del Convenio"},{"fecha":"2016-07-19","act":"Se le manda correo para darle seguimiento a la firma del convenio pero ya se esta trabajando en las vacantes"}]', '[]', '[]'),
(47, 43, 12, '[]', '[]', '[]'),
(48, 0, 13, '[{"fecha":"2016-07-18","act":"Se le marcó y no se pudo localizar al contacto"},{"fecha":"2016-07-19","act":"Se le marca al cliente y se compromete de mandar el convenio firmado, ya se esta trabajando en la vacante"}]', '[]', '[]'),
(49, 0, 14, '[{"fecha":"2016-08-03","act":"Se le marco al cliente, dijo que iba a revisarlo y se comunicaba "}]', '[{"fecha":"2016-08-15","act":"Ellos cubrieron la vacante"}]', '[]'),
(50, 0, 15, '[]', '[]', '[]'),
(51, 0, 16, '[]', '[]', '[]'),
(52, 0, 17, '[]', '[]', '[]'),
(53, 0, 18, '[]', '[]', '[]'),
(54, 0, 19, '[{"fecha":"2016-08-16","act":"Se le mando correo al cliente para saber si se tenian dudas y contesto que se estaba definiendo la posición "}]', '[]', '[]'),
(55, 0, 20, '[]', '[]', '[]'),
(56, 0, 21, '[]', '[]', '[]'),
(57, 0, 22, '[]', '[]', '[]'),
(58, 0, 23, '[]', '[]', '[]'),
(59, 0, 24, '[]', '[]', '[]'),
(60, 0, 25, '[]', '[]', '[]'),
(61, 0, 26, '[]', '[]', '[]'),
(62, 0, 27, '[]', '[]', '[]'),
(63, 0, 28, '[]', '[]', '[]'),
(64, 0, 29, '[]', '[]', '[]'),
(65, 0, 30, '[]', '[]', '[]'),
(66, 0, 31, '[]', '[]', '[]'),
(67, 0, 32, '[]', '[]', '[]'),
(68, 0, 33, '[]', '[]', '[]'),
(69, 0, 34, '[]', '[]', '[]'),
(70, 0, 35, '[]', '[]', '[]'),
(71, 0, 36, '[]', '[]', '[]'),
(72, 0, 37, '[]', '[]', '[]'),
(73, 0, 38, '[]', '[]', '[]'),
(74, 0, 39, '[]', '[]', '[]');

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
(19, '{"publico":"Nature Sweet","observaciongenerales":"","web":"","industria":"1","riesgo":"1","fecha":"2016-03-11"}', '[{"idcontacto":"1","nombre":"","area":"","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"rs","rfc":"rfc","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"1"},{"idfac":"1","rs":"rs2","rfc":"rfc2","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(20, '{"publico":"Ferretería Serur","observaciongenerales":"","web":"","industria":"7","riesgo":"1","fecha":"2016-03-11"}', '[{"idcontacto":"1","nombre":"","area":"","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(21, '{"publico":"Mouser Electronics","observaciongenerales":"","web":"","industria":"10","riesgo":"1","fecha":"2016-01-14"}', '[{"idcontacto":"1","nombre":"","area":"","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(22, '{"publico":"Tequilera","observaciongenerales":"","web":"","industria":"7","riesgo":"1","fecha":"2016-03-14"}', '[{"idcontacto":"1","nombre":"","area":"","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(23, '{"publico":"pruebas","observaciongenerales":"","web":"","industria":"1","riesgo":"1","fecha":""}', '[]', '[{"idfac":"0","rs":"rs1","rfc":"rfc1","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"},{"idfac":"1","rs":"rs2","rfc":"rfc2","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(24, '{"publico":"cliente de pruebas","observaciongenerales":"","web":"","industria":"3","riesgo":"1","fecha":""}', '[{"idcontacto":"5","nombre":"persona 1","area":"area 1","cumpleaños":"2016-01-01","observaciones":"obs 1","medioDeContacto":[{"tipoContacto":"1","valorContacto":"111111111"},{"tipoContacto":"2","valorContacto":"22222222"},{"tipoContacto":"3","valorContacto":"333333"},{"tipoContacto":"4","valorContacto":"4444444"}]},{"idcontacto":"6","nombre":"persona 2","area":"area 2","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":"123456789"}]}]', '[{"idfac":"0","rs":"cliente pruebas","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"1"}]'),
(25, '{"publico":"Kemin","observaciongenerales":"","web":"","industria":"10","riesgo":"1","fecha":"2016-06-30"}', '[{"idcontacto":"0","nombre":"Jerry May","area":"Sr. Vice President /Human Resources","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"KEMIN, S DE R.L. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(26, '{"publico":"Sello Rojo","observaciongenerales":"","web":"www.sellorojo.com.mx","industria":"10","riesgo":"1","fecha":"2016-06-24"}', '[{"idcontacto":"0","nombre":"Jorge Sáenz R.","area":"Director de Recursos Humanos","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"Lechera Guadalajara S.a De C.v ","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(27, '{"publico":"Main Casa","observaciongenerales":"","web":"","industria":"7","riesgo":"1","fecha":"2016-06-28"}', '[{"idcontacto":"0","nombre":"Jorge Cabrera Herrera","area":"Director General ","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"MAQUINARIA INDUSTRIAL CABRERA, S.A DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(28, '{"publico":"Kemin ","observaciongenerales":"","web":"","industria":"1","riesgo":"1","fecha":"2016-05-18"}', '[{"idcontacto":"0","nombre":"Jesús Gómez Orozco","area":"Accounting Manager","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]},{"idcontacto":"1","nombre":"Jerry May","area":"Vice President, Human Resources","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"KEMIN, S DE R.L. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(29, '{"publico":"Huntsman","observaciongenerales":"","web":"","industria":"7","riesgo":"1","fecha":"2016-06-24"}', '[{"idcontacto":"0","nombre":"Ruddy Estuardo Paz","area":"Recursos Humanos TE Americas","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"HUNTSMAN TEXTILE EFFECTS, LTDA","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(30, '{"publico":"Azyco","observaciongenerales":"","web":"http://www.azyco.com.mx/index.php","industria":"-1","riesgo":"1","fecha":"2016-07-06"}', '[]', '[{"idfac":"0","rs":"AZULEJOS Y COMPLEMENTOS, S.A. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(31, '{"publico":"Ready Mix","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-07-06"}', '[{"idcontacto":"0","nombre":"Jorge Reyes","area":"Director","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"CONCRETOS READY MIX, SA DE CV","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(32, '{"publico":"Alltech","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-07-05"}', '[{"idcontacto":"0","nombre":"Marisol Aladro","area":"Office Manager","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"ALLTECH DE MÉXICO S.A. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(33, '{"publico":"Grupo Recal","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-07-13"}', '[{"idcontacto":"1","nombre":"Miguel Gomez Fregoso","area":"Director de Recursos Humanos","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(34, '{"publico":"Enature","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-07-14"}', '[{"idcontacto":"0","nombre":"Rafael Serrano","area":"Director General","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"VASERCO, S. DE R.L. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(35, '{"publico":"Vitatellus","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-07-14"}', '[{"idcontacto":"0","nombre":"Francisco Ortiz Esquivel ","area":"Director General","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"VITATELLUS S.A. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(36, '{"publico":"DanPal- TI","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-07-12"}', '[{"idcontacto":"0","nombre":"Francisco Aguirre D.","area":"Gerente de Ventas Region Bajio","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"DANPAL - TI S.A. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(37, '{"publico":"Constructora Los Patos","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-07-26"}', '[{"idcontacto":"0","nombre":"Joao Márquez ","area":"","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"CONSTRUCTORA INMOBILIARIA LOS PATOS S.A. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(38, '{"publico":"NKP MExico","observaciongenerales":"","web":"","industria":"7","riesgo":"1","fecha":"2016-08-15"}', '[{"idcontacto":"0","nombre":"Lic. Julio Acero","area":"Gerente de Recursos Humanos","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"NKP MEXICO S.A DE C.V","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(39, '{"publico":"Vivri","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":""}', '[{"idcontacto":"0","nombre":"Lic. Erik Ocampo","area":"Gerente de Recursos Humanos","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"Vivri","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(40, '{"publico":"Wet Line","observaciongenerales":"","web":"","industria":"7","riesgo":"1","fecha":""}', '[{"idcontacto":"0","nombre":"Lic. Gabriel Bustamante Ascencio","area":"Director Genral","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"INDUSTRIAS WET LINE S.A DE C.V","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(41, '{"publico":"Equipromex","observaciongenerales":"","web":"","industria":"7","riesgo":"1","fecha":"2016-08-08"}', '[{"idcontacto":"0","nombre":"Lic. Barbara Gama","area":"Recursos Humanos","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"EQUIPOS DE PROCESO MEXICANOS, S.A. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(42, '{"publico":"VolksWagen QRO","observaciongenerales":"","web":"","industria":"2","riesgo":"1","fecha":"2016-08-03"}', '[{"idcontacto":"0","nombre":"Lic. Socorro Soltero","area":"Gerente de Recursos Humanos","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"Grupo Leal","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(43, '{"publico":"EMME","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-07-12"}', '[{"idcontacto":"0","nombre":"Lic. Alfonso Cendejas Velázquez","area":"Director General","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"EMERGENCIA MÉDICA PROFESIONAL S.C.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(44, '{"publico":"Enature","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-07-28"}', '[{"idcontacto":"0","nombre":"Sr. Rafael Serrano","area":"Director General","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"VASERCO, S. DE R.L. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(45, '{"publico":"Sanchez y Martin","observaciongenerales":"","web":"","industria":"6","riesgo":"1","fecha":"2016-08-22"}', '[{"idcontacto":"0","nombre":"Guillermo Cantú","area":"Director de Recursos Humanos","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"SÁNCHEZ Y MARTÍN, S.A. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(46, '{"publico":"Vamsa Las Fuentes","observaciongenerales":"","web":"","industria":"2","riesgo":"1","fecha":"2016-08-18"}', '[{"idcontacto":"0","nombre":"","area":"","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[]'),
(47, '{"publico":"CRABTREE","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-08-19"}', '[{"idcontacto":"0","nombre":"Gerardo Ruiz Velasco","area":"","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[]'),
(48, '{"publico":"Concavus","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-08-31"}', '[{"idcontacto":"0","nombre":"Maria Eugenia Cruz ","area":"Recursos Humanos","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(49, '{"publico":"IFS","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":""}', '[{"idcontacto":"0","nombre":"Amy Schweng","area":"Chief Financial Officer","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[]'),
(50, '{"publico":"Tequila Clase Azul","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-08-31"}', '[{"idcontacto":"0","nombre":"Iván Salas","area":"Coordinador de Desarrollo Humano","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(51, '{"publico":"Oracle","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-08-30"}', '[{"idcontacto":"0","nombre":"Valeria Delgado","area":"Recruiting Vicepresident for Latin America","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(52, '{"publico":"Astra Zeneca","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-08-30"}', '[{"idcontacto":"0","nombre":"Asbeli Pestana HR Business Partner","area":"HR Business Partner","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[]'),
(53, '{"publico":"Distribuidora Dolgo","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-08-31"}', '[{"idcontacto":"0","nombre":"Ricardo Diaz TurnBull","area":"","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"Distribuidora Dolgo S.A de C.V","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(54, '{"publico":"Lear","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-07-25"}', '[{"idcontacto":"0","nombre":"Katie Hamm ","area":"Leadership Development Specialist","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(55, '{"publico":"Gowan Mexicana","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-08-29"}', '[{"idcontacto":"0","nombre":"Lic. Lourdes González","area":"Directora de Recursos Humanos","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(56, '{"publico":"Betterware","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-08-25"}', '[{"idcontacto":"0","nombre":"Karina Reyes","area":"Coordinadora de Ventas","cumpleaños":"","observaciones":"","medioDeContacto":[{"tipoContacto":"1","valorContacto":""}]}]', '[{"idfac":"0","rs":"BETTERWARE DE MÉXICO, S.A. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(57, '{"publico":"Más por evento","observaciongenerales":"","web":"","industria":"10","riesgo":"1","fecha":"2016-09-12"}', '[]', '[{"idfac":"0","rs":"MAS POR EVENTO DE MÉXICO S. DE R.L. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(58, '{"publico":"ECI","observaciongenerales":"","web":"","industria":"4","riesgo":"1","fecha":"2016-09-12"}', '[]', '[{"idfac":"0","rs":"ESCUELA CULINARIA INTERNACIONAL S.C.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(59, '{"publico":"Planasa","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-09-09"}', '[]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(60, '{"publico":"PSAP","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-09-12"}', '[]', '[{"idfac":"0","rs":"PSAP Palets Empaques y Embalajes","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(61, '{"publico":"Planamerica","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-09-12"}', '[]', '[{"idfac":"0","rs":"","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]'),
(62, '{"publico":"Compaqi","observaciongenerales":"","web":"","industria":"-1","riesgo":"1","fecha":"2016-09-12"}', '[]', '[{"idfac":"0","rs":"COMPUTACIÓN EN ACCIÓN, S.A. DE C.V.","rfc":"","calle":"","ext":"","nint":"","cp":"","ciudad":"","estado":"","telefono":"","email":"","primario":"0"}]');

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

CREATE TABLE `estatus_funnel` (
  `id` int(11) NOT NULL,
  `clave` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estatus_funnel`
--

INSERT INTO `estatus_funnel` (`id`, `clave`, `descripcion`) VALUES
(1, 1, '{"clave":"1","nombre":"1- POR CONTACTAR","avance":"0%"}'),
(2, 2, '{"clave":"2","nombre":"2- SEGUIMIENTO INICIAL","avance":"0%"}'),
(3, 3, '{"clave":"3","nombre":"3- EN PROSPECTACIÓN","avance":"0%"}'),
(4, 4, '{"clave":"4","nombre":"4- EN COTIZACIÓN","avance":"0%"}'),
(5, 5, '{"clave":"5","nombre":"5- EN NEGOCIACIÓN","avance":"0%"}'),
(6, 6, '{"clave":"6","nombre":"6- EN FIRMA DE CONVENIO","avance":"0%"}'),
(7, 7, '{"clave":"7","nombre":"7- VENDIDO / CERRADO","avance":"0%"}'),
(8, 8, '{"clave":"8","nombre":"8- DETENIDO","avance":"0%"}'),
(9, 9, '{"clave":"9","nombre":"9- CANCELADO","avance":"0%"}'),
(10, 10, '{"clave":"10","nombre":"10- SE RECOMENDÓ A SERVIPRES","avance":"0%"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funnel`
--

CREATE TABLE `funnel` (
  `id` int(10) UNSIGNED NOT NULL,
  `datos_proyecto` varchar(255) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `contrato` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `funnel`
--

INSERT INTO `funnel` (`id`, `datos_proyecto`, `cliente`, `contrato`) VALUES
(1, '{"empresa":"DMA","kam":"2","kam2":"9","proyectoRequerido":"1","proyectoReq":"cosas","fechainicio":"2016-07-04","estatus":"1"}', '{"cliente":"24","razonS":"0"}', '{"valorProyecto":"50,000.00","convenio":"no","honorarios":"10","txthonorarios":"","obsContrato":"","acuerdo":"fac303040","txtacuerdo":"","garantia":"dias60","exclusividad":"permanente"}'),
(2, '{"empint":"DMA","kam":"9","kam2":"3","proyectoRequerido":"2","proyectoReq":"Convenio Abierto","fechainicio":"2016-06-30","estatus":"7"}', '{"cliente":"25","razonS":"0","contacto":""}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(3, '{"empint":"DMA","kam":"9","kam2":"3","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-07-08","estatus":"7"}', '{"cliente":"27","razonS":"0","contacto":""}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(4, '{"empint":"DMA","kam":"9","kam2":"3","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-06-30","estatus":"7"}', '{"cliente":"25","razonS":"0","contacto":""}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(5, '{"empint":"DMA","kam":"9","kam2":"3","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-06-24","estatus":"1"}', '{"cliente":"29","razonS":"0","contacto":""}', '{"valorProyecto":"NaN","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(6, '{"empint":"DMA","kam":"9","kam2":"3","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-07-06","estatus":"7"}', '{"cliente":"30","razonS":"0","contacto":""}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(7, '{"empint":"DMA","kam":"9","kam2":"7","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-07-11","estatus":"2"}', '{"cliente":"31","razonS":"0","contacto":""}', '{"valorProyecto":"NaN","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(8, '{"empint":"DMA","kam":"9","kam2":"7","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-07-06","estatus":"7"}', '{"cliente":"32","razonS":"0","contacto":""}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(9, '{"empint":"DMA","kam":"9","kam2":"7","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-07-13","estatus":"8"}', '{"cliente":"33","razonS":"0","contacto":""}', '{"valorProyecto":"NaN","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(10, '{"empint":"DMA","kam":"9","kam2":"7","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-07-14","estatus":"7"}', '{"cliente":"34","razonS":"0","contacto":""}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(11, '{"empint":"DMA","kam":"1","kam2":"9","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-07-14","estatus":"1"}', '{"cliente":"35","razonS":"0","contacto":""}', '{"valorProyecto":"NaN","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(12, '{"empint":"DMA","kam":"9","kam2":"5","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-07-12","estatus":"1"}', '{"cliente":"36","razonS":"0","contacto":""}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(13, '{"empint":"DMA","kam":"-1","kam2":"-1","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-07-15","estatus":"6"}', '{"cliente":"26","razonS":"0","contacto":""}', '{"valorProyecto":"NaN","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(14, '{"empint":"DMA","kam":"12","kam2":"4","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-07-26","estatus":"9"}', '{"cliente":"37","razonS":"0","contacto":""}', '{"valorProyecto":"NaN","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(15, '{"empint":"DMA","kam":"9","kam2":"1","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-08-15","estatus":"3"}', '{"cliente":"38","razonS":"0","contacto":"-1"}', '{"valorProyecto":"NaN","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(16, '{"empint":"DMA","kam":"12","kam2":"6","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-07-12","estatus":"7"}', '{"cliente":"43","razonS":"0","contacto":"-1"}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(17, '{"empint":"DMA","kam":"9","kam2":"7","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-08-04","estatus":"9"}', '{"cliente":"39","razonS":"0","contacto":"-1"}', '{"valorProyecto":"NaN","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(18, '{"empint":"DMA","kam":"9","kam2":"1","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-08-09","estatus":"1"}', '{"cliente":"40","razonS":"0","contacto":"-1"}', '{"valorProyecto":"NaN","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(19, '{"empint":"DMA","kam":"9","kam2":"4","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-08-08","estatus":"1"}', '{"cliente":"41","razonS":"0","contacto":"-1"}', '{"valorProyecto":"NaN","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(20, '{"empint":"DMA","kam":"9","kam2":"7","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-08-03","estatus":"7"}', '{"cliente":"42","razonS":"0","contacto":"-1"}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(21, '{"empint":"DMA","kam":"9","kam2":"7","proyectoRequerido":"4","proyectoReq":"","fechainicio":"2016-07-28","estatus":"7"}', '{"cliente":"34","razonS":"0","contacto":"-1"}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(22, '{"empint":"DMA","kam":"9","kam2":"3","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-08-23","estatus":"1"}', '{"cliente":"45","razonS":"0","contacto":"-1"}', '{"valorProyecto":"NaN","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(23, '{"empint":"DMA","kam":"9","kam2":"1","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-08-19","estatus":"1"}', '{"cliente":"46","razonS":"-1","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(24, '{"empint":"DMA","kam":"9","kam2":"0","proyectoRequerido":"3","proyectoReq":"","fechainicio":"2016-08-19","estatus":"1"}', '{"cliente":"47","razonS":"-1","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(25, '{"empint":"DMA","kam":"9","kam2":"0","proyectoRequerido":"4","proyectoReq":"","fechainicio":"2016-08-31","estatus":"1"}', '{"cliente":"48","razonS":"0","contacto":"-1"}', '{"valorProyecto":"NaN","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(26, '{"empint":"DMA","kam":"-1","kam2":"-1","proyectoRequerido":"4","proyectoReq":"","fechainicio":"2016-07-22","estatus":"7"}', '{"cliente":"-1","razonS":"-1","contacto":"-1"}', '{"valorProyecto":"","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(27, '{"empint":"DMA","kam":"12","kam2":"7","proyectoRequerido":"1","proyectoReq":"","fechainicio":"2016-08-31","estatus":"2"}', '{"cliente":"49","razonS":"-1","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(28, '{"empint":"DMA","kam":"0","kam2":"-1","proyectoRequerido":"4","proyectoReq":"","fechainicio":"2016-08-31","estatus":"2"}', '{"cliente":"50","razonS":"0","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(29, '{"empint":"DMA","kam":"12","kam2":"7","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-08-30","estatus":"1"}', '{"cliente":"51","razonS":"0","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(30, '{"empint":"DMA","kam":"-1","kam2":"-1","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-08-30","estatus":"1"}', '{"cliente":"52","razonS":"-1","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(31, '{"empint":"DMA","kam":"9","kam2":"12","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-08-31","estatus":"1"}', '{"cliente":"53","razonS":"0","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(32, '{"empint":"AIMS","kam":"-1","kam2":"-1","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-08-28","estatus":"2"}', '{"cliente":"55","razonS":"0","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(33, '{"empint":"DMA","kam":"-1","kam2":"-1","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-08-25","estatus":"1"}', '{"cliente":"56","razonS":"0","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(34, '{"empint":"DMA","kam":"-1","kam2":"-1","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-09-12","estatus":"1"}', '{"cliente":"57","razonS":"0","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(35, '{"empint":"DMA","kam":"-1","kam2":"-1","proyectoRequerido":"2","proyectoReq":"","fechainicio":"2016-09-12","estatus":"1"}', '{"cliente":"58","razonS":"0","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(36, '{"empint":"DMA","kam":"-1","kam2":"-1","proyectoRequerido":"4","proyectoReq":"","fechainicio":"2016-09-09","estatus":"1"}', '{"cliente":"59","razonS":"0","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(37, '{"empint":"DMA","kam":"-1","kam2":"-1","proyectoRequerido":"4","proyectoReq":"","fechainicio":"2016-09-02","estatus":"1"}', '{"cliente":"60","razonS":"0","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(38, '{"empint":"DMA","kam":"-1","kam2":"-1","proyectoRequerido":"4","proyectoReq":"","fechainicio":"2016-09-09","estatus":"1"}', '{"cliente":"61","razonS":"0","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(39, '{"empint":"DMA","kam":"-1","kam2":"-1","proyectoRequerido":"4","proyectoReq":"","fechainicio":"2016-09-12","estatus":"1"}', '{"cliente":"62","razonS":"0","contacto":"-1"}', '{"valorProyecto":"","convenio":"no","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}');

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
(1, '{"idColaborador":"1","codigo":"1","nombrec":"Zulma","nombrel":"Zulma Toscano","apoyo":"1","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"1"}}'),
(2, '{"idColaborador":"2","codigo":"2","nombrec":"Edgar","nombrel":"Edgar López","apoyo":"1","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"1"}}'),
(3, '{"idColaborador":"3","codigo":"3","nombrec":"Delia","nombrel":"Delia Monteon Hurtado","apoyo":"1","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"1"}}'),
(4, '{"idColaborador":"4","codigo":"4","nombrec":"Vero","nombrel":"Verónica Escoto Sánchez","apoyo":"1","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"1"}}'),
(5, '{"idColaborador":"5","nombrec":"Diego","nombrel":"Diego Sicilia","apoyo":"1","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"1"}}'),
(6, '{"idColaborador":"6","codigo":"6","nombrec":"Migue","nombrel":"Miguel Comparan Meza","apoyo":"1","activo":"1","puesto":{"consultor":"1","reclutador":"1","apoyo":"1"}}'),
(7, '{"idColaborador":"7","codigo":"7","nombrec":"Kaz","nombrel":"Kazandra Gómez Madera","apoyo":"0","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"0"}}'),
(8, '{"idColaborador":"8","codigo":"8","nombrec":"Eugenio","nombrel":"Eugenio Aimar","apoyo":"0","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"0"}}'),
(9, '{"idColaborador":"9","codigo":"1","nombrec":"Benjamin","nombrel":"Benjamin Díaz Morones","apoyo":"0","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"0"}}'),
(10, '{"idColaborador":"0","codigo":"","nombrec":"Janette","nombrel":"Janette Hernández","apoyo":"1","activo":"1","puesto":{"consultor":"0","reclutador":"1","apoyo":"1"}}'),
(11, '{"idColaborador":"0","nombrec":"Monica","nombrel":"Monica Diaz","apoyo":"1","activo":"1","puesto":{"consultor":"1","reclutador":"1","apoyo":"1"}}'),
(12, '{"idColaborador":"12","nombrec":"Ceci","nombrel":"Cecilia Diaz","apoyo":"0","activo":"1","puesto":{"consultor":"1","reclutador":"0","apoyo":"0"}}');

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
(36, '{"cliente":"19","razonS":"-1"}', 0, '{"wbs":"2016-36BE","empint":"SICSA","kam":"9","reclutador":"-1","kam2":"-1","apoyo":"-1","prioridad":"1","fIniY":"2016","fIniM":"04","fIniD":"12","fCIdealY":"2018","fCIdealM":"01","fCIdealD":"01","fCRealY":null,"fCRealM":null,"fCRealD":null,"estatus":"1","posicion":"pruebas","disciplina":"2","cta":"1","nivel":"1","salario":"10,000.00","aguinaldo":"1","vacaciones":"1","primavacacional":"1","bono":"1","fondo":"no","bales":"no","sgmm":"no","segvida":"no","otraprestacion":""}', '{"valorproyecto":"13,033.67","totalfacturado":"0.00","porcfacturado":"0.00%","xfacturar":"13,033.67","lista":{"facno1":"","monto1":"","fenvio1":"","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}}', '{"fGarantiaY":null,"fGarantiaM":null,"fGarantiaD":null,"convenio":"no","garantia":"60","hdnhonorarios":"","honorarios":"unMesNominal","acuerdofacturacion":"opc3_7"}'),
(37, '{"cliente":"23","razonS":"0","contacto":"1"}', 0, '{"empint":"AIMS","wbs":"2016-37ED","kam":"2","reclutador":"-1","kam2":"-1","apoyo":"-1","prioridad":"1","fIniY":"2016","fIniM":"04","fIniD":"13","fCIdealY":"2018","fCIdealM":"01","fCIdealD":"01","posicion":"pruebas 2","disciplina":"1","cta":"2","nivel":"1","estatus":"1","salario":"10,000.00","aguinaldo":"1","vacaciones":"1","primavacacional":"1","bono":"1","fondo":"no","bales":"no","sgmm":"no","segvida":"no","otraprestacion":""}', '{"valorproyecto":"13,033.67","totalfacturado":"0","porcfacturado":"0","xfacturar":"13,033.67","facno1":"","monto1":"","fenvio1":"","fpago1":"","facno2":"","monto2":"","fenvio2":"","fpago2":"","facno3":"","monto3":"","fenvio3":"","fpago3":""}', '{"convenio":"no","garantia":"60","honorarios":"unMesNominal","acuerdofacturacion":"opc3_7","fGarantiaY":"0000","fGarantiaM":"00","fGarantiaD":"00","garantiaMedioTiempo":"0","garantia5Dias":"0"}'),
(38, '{"cliente":"30","razonS":"0","contacto":""}', 0, '{"empint":null,"kam":"3","kam2":"-1","proyectoRequerido":"1","proyectoReq":"","fechainicio":"2016-07-06","estatus":"1","wbs":"2016-38-3","reclutador":"-1","apoyo":"-1","prioridad":"1","fIniY":2016,"fIniM":"08","fIniD":"08","posicion":"","disciplina":"-1","cta":"1","nivel":"1","salario":"0"}', '{"valorproyecto":"NaN","totalfacturado":"0.00","porcfacturado":"0.00%","xfacturar":"NaN","lista":{"facno1":"","monto1":"0","fenvio1":"","fpago1":"","facno2":"","monto2":"0","fenvio2":"","fpago2":"","facno3":"","monto3":"0","fenvio3":"","fpago3":""}}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(39, '{"cliente":"43","razonS":"0","contacto":"-1"}', 0, '{"empint":"DMA","kam":"3","kam2":"-1","proyectoRequerido":"1","proyectoReq":"","fechainicio":"2016-07-12","estatus":"1","wbs":"2016-39-3","reclutador":"-1","apoyo":"-1","prioridad":"1","fIniY":2016,"fIniM":"08","fIniD":16,"posicion":"","disciplina":"-1","cta":"1","nivel":"1","salario":"0"}', '{"valorproyecto":"","totalfacturado":"0.00","porcfacturado":"0.00%","xfacturar":"","lista":{"facno1":"","monto1":"0","fenvio1":"","fpago1":"","facno2":"","monto2":"0","fenvio2":"","fpago2":"","facno3":"","monto3":"0","fenvio3":"","fpago3":""}}', '{"valorProyecto":"","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(40, '{"cliente":"42","razonS":"0","contacto":"-1"}', 0, '{"empint":"DMA","kam":"3","kam2":"-1","proyectoRequerido":"1","proyectoReq":"","fechainicio":"2016-08-03","estatus":"1","wbs":"2016-40-3","reclutador":"-1","apoyo":"-1","prioridad":"1","fIniY":2016,"fIniM":"08","fIniD":16,"posicion":"","disciplina":"-1","cta":"1","nivel":"1","salario":"0"}', '{"valorproyecto":"NaN","totalfacturado":"0.00","porcfacturado":"0.00%","xfacturar":"NaN","lista":{"facno1":"","monto1":"0","fenvio1":"","fpago1":"","facno2":"","monto2":"0","fenvio2":"","fpago2":"","facno3":"","monto3":"0","fenvio3":"","fpago3":""}}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(41, '{"cliente":"34","razonS":"0","contacto":"-1"}', 0, '{"empint":"DMA","kam":"3","kam2":"-1","proyectoRequerido":"1","proyectoReq":"","fechainicio":"2016-07-28","estatus":"1","wbs":"2016-41-3","reclutador":"-1","apoyo":"-1","prioridad":"1","fIniY":2016,"fIniM":"08","fIniD":16,"posicion":"","disciplina":"-1","cta":"1","nivel":"1","salario":"0"}', '{"valorproyecto":"NaN","totalfacturado":"0.00","porcfacturado":"0.00%","xfacturar":"NaN","lista":{"facno1":"","monto1":"0","fenvio1":"","fpago1":"","facno2":"","monto2":"0","fenvio2":"","fpago2":"","facno3":"","monto3":"0","fenvio3":"","fpago3":""}}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(42, '{"cliente":"34","razonS":"0","contacto":""}', 0, '{"empint":null,"kam":"3","kam2":"-1","proyectoRequerido":"1","proyectoReq":"","fechainicio":"2016-07-14","estatus":"1","wbs":"2016-42-3","reclutador":"-1","apoyo":"-1","prioridad":"1","fIniY":2016,"fIniM":"08","fIniD":16,"posicion":"","disciplina":"-1","cta":"1","nivel":"1","salario":"0"}', '{"valorproyecto":"NaN","totalfacturado":"0.00","porcfacturado":"0.00%","xfacturar":"NaN","lista":{"facno1":"","monto1":"0","fenvio1":"","fpago1":"","facno2":"","monto2":"0","fenvio2":"","fpago2":"","facno3":"","monto3":"0","fenvio3":"","fpago3":""}}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(43, '{"cliente":"36","razonS":"0","contacto":""}', 0, '{"empint":null,"kam":"3","kam2":"-1","proyectoRequerido":"1","proyectoReq":"","fechainicio":"2016-07-12","estatus":"1","wbs":"2016-43-3","reclutador":"-1","apoyo":"-1","prioridad":"1","fIniY":2016,"fIniM":"08","fIniD":16,"posicion":"","disciplina":"-1","cta":"1","nivel":"1","salario":"0"}', '{"valorproyecto":"NaN","totalfacturado":"0.00","porcfacturado":"0.00%","xfacturar":"NaN","lista":{"facno1":"","monto1":"0","fenvio1":"","fpago1":"","facno2":"","monto2":"0","fenvio2":"","fpago2":"","facno3":"","monto3":"0","fenvio3":"","fpago3":""}}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(44, '{"cliente":"27","razonS":"0","contacto":""}', 0, '{"empint":null,"kam":"3","kam2":"-1","proyectoRequerido":"1","proyectoReq":"","fechainicio":"2016-07-08","estatus":"1","wbs":"2016-44-3","reclutador":"-1","apoyo":"-1","prioridad":"1","fIniY":2016,"fIniM":"08","fIniD":16,"posicion":"","disciplina":"-1","cta":"1","nivel":"1","salario":"0"}', '{"valorproyecto":"NaN","totalfacturado":"0.00","porcfacturado":"0.00%","xfacturar":"NaN","lista":{"facno1":"","monto1":"0","fenvio1":"","fpago1":"","facno2":"","monto2":"0","fenvio2":"","fpago2":"","facno3":"","monto3":"0","fenvio3":"","fpago3":""}}', '{"valorProyecto":"NaN","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}'),
(45, '{"cliente":"-1","razonS":"-1","contacto":"-1"}', 0, '{"empint":"DMA","kam":"0","kam2":"-1","proyectoRequerido":"4","proyectoReq":"","fechainicio":"2016-07-22","estatus":"1","wbs":"2016-45-0","reclutador":"-1","apoyo":"-1","prioridad":"1","fIniY":2016,"fIniM":"09","fIniD":"02","proyRequerido":"4","posicion":"","disciplina":"-1","cta":"1","nivel":"1","salario":"0"}', '{"valorproyecto":"","totalfacturado":"0.00","porcfacturado":"0.00%","xfacturar":"","lista":{"facno1":"","monto1":"0","fenvio1":"","fpago1":"","facno2":"","monto2":"0","fenvio2":"","fpago2":"","facno3":"","monto3":"0","fenvio3":"","fpago3":""}}', '{"valorProyecto":"","convenio":"si","honorarios":"unMesNominal","txthonorarios":"","obscontrato":"","acuerdo":"fac100","txtacuerdo":"","garantia":"dias30","exclusividad":"permanente"}');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `estatus_funnel`
--
ALTER TABLE `estatus_funnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `funnel`
--
ALTER TABLE `funnel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `kam`
--
ALTER TABLE `kam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
