-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2024 a las 20:16:37
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajach`
--

CREATE TABLE `cajach` (
  `cod_dia` int(11) NOT NULL,
  `montoi` varchar(11) NOT NULL,
  `fecha` date NOT NULL,
  `totale` varchar(11) NOT NULL,
  `totals` varchar(11) NOT NULL,
  `gtotal` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cajach`
--

INSERT INTO `cajach` (`cod_dia`, `montoi`, `fecha`, `totale`, `totals`, `gtotal`) VALUES
(1, '1050', '2024-01-11', '1952', '100', '1852');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajaop`
--

CREATE TABLE `cajaop` (
  `cod_operacion` int(11) NOT NULL,
  `tipodeoperacion` varchar(150) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `tipocomprobante` varchar(150) NOT NULL,
  `importeentrada` varchar(30) NOT NULL,
  `importesalida` varchar(30) NOT NULL,
  `fecha_hora_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cajaop`
--

INSERT INTO `cajaop` (`cod_operacion`, `tipodeoperacion`, `descripcion`, `tipocomprobante`, `importeentrada`, `importesalida`, `fecha_hora_registro`) VALUES
(2, 'Salida', 'Devolución depósito de seguridad habitación Jazmín', 'Voucher', '', '100', '2024-01-11 20:37:45'),
(8, 'Entrada', 'Check In habitación Estándar', 'Ticket', '976', '', '2024-01-25 23:25:13'),
(9, 'Entrada', 'Check In habitación Estándar', 'Ticket', '976', '', '2024-01-26 17:36:34'),
(13, 'Entrada', 'Consumos y Servicios Especiales habitacion Cuna de moisés', 'Ticket', '3275', '', '2024-02-14 19:33:13'),
(14, 'Entrada', 'Check In habitación Estándar', 'Ticket', '876', '', '2024-02-14 19:38:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancelaciones`
--

CREATE TABLE `cancelaciones` (
  `cod_reserva` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `dia` varchar(11) NOT NULL,
  `llegada` time NOT NULL,
  `salida` date NOT NULL,
  `cliente` varchar(30) NOT NULL,
  `habitacion` varchar(30) NOT NULL,
  `huespedes` varchar(30) NOT NULL,
  `tarifa` int(10) NOT NULL,
  `anticipo` int(10) NOT NULL,
  `via` varchar(30) NOT NULL,
  `sextras` varchar(30) NOT NULL,
  `noches` int(2) NOT NULL,
  `cextras` varchar(10) NOT NULL,
  `comentarios` varchar(100) NOT NULL,
  `total` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cancelaciones`
--

INSERT INTO `cancelaciones` (`cod_reserva`, `fecha`, `dia`, `llegada`, `salida`, `cliente`, `habitacion`, `huespedes`, `tarifa`, `anticipo`, `via`, `sextras`, `noches`, `cextras`, `comentarios`, `total`) VALUES
(1, '2023-07-03', 'Lunes', '15:00:00', '2023-07-04', 'RAMUEL RERNANDEZ', 'Superior', '1 Adulto', 1070, 70, 'Directa', '', 0, '', 'nINGUNO', 70),
(2, '2023-07-18', 'Martes', '15:00:00', '2023-07-19', 'ALAN MARCIAL', 'Cuna de moisés', '1', 1012, 100, 'OTA', '', 1, '', 'nINGUNO', -912),
(3, '2023-07-27', 'Jueves', '15:00:00', '2023-07-28', 'ALAN MARCIAL', 'Bugambilia', '1', 1070, 170, '', '0', 1, '0', 'xdxdxd', -900),
(4, '2023-10-27', 'Viernes', '15:00:00', '2023-10-29', 'FLOR BRUNO REYNOSO', 'Margarita', '1 Adulto', 1500, 0, 'Directa', '1650', 0, '', 'nINGUNO', 0),
(5, '2023-10-28', 'Sábado', '15:00:00', '2023-10-29', 'ROSANNA LOPEZ OCAMPO', 'Superior', '1 Adulto', 1401, 401, 'OTA', '', 0, '', 'nINGUNO', 401),
(6, '2023-10-28', 'Sábado', '15:00:00', '2023-10-30', 'SIERRA BRASHEAR', 'Superior', '1 Adulto', 1434, 67, 'Directa', '', 0, '', 'nINGUNO', 67),
(7, '2023-08-24', 'Jueves', '15:00:00', '2023-08-26', 'ALAN MARCIAL', 'Lily', '1', 976, 0, 'Directa', '', 2, '', 'nINGUNO', -1952),
(8, '2023-08-24', 'Jueves', '15:00:00', '2023-08-26', 'ALAN MARCIAL', 'Lily', '1', 976, 0, 'Directa', '', 2, '', 'nINGUNO', -1952),
(9, '2023-08-24', 'Jueves', '15:00:00', '2023-08-25', 'ALAN MARCIAL', 'Cuna de moisés', '2', 976, 0, 'Directa', '0', 1, '0', 'nINGUNO', -976),
(10, '2023-08-24', 'Jueves', '15:00:00', '2023-08-25', 'ALAN MARCIAL', 'Margarita', '1', 1403, 0, 'Directa', '', 1, '', 'ninguno', -1403),
(11, '2023-08-31', 'Jueves', '15:00:00', '2023-09-01', 'RAMUEL RERNANDEZ', 'Cuna de moisés', '1', 976, 100, 'Directa', '500', 1, '0', 'NINGUNO', -876),
(12, '2023-09-05', 'Martes', '15:00:00', '2023-09-06', 'RAMUEL RERNANDEZ', 'Cuna de moisés', '1', 976, 100, 'Directa', '150', 1, '150', 'NINGUNO', -1026),
(13, '2023-09-06', 'Miércoles', '15:00:00', '2023-09-10', 'RAMUEL RERNANDEZ', 'Estándar', '1 Adulto', 976, 176, 'Directa', '', 4, '', 'xdxdxd', -3728),
(14, '2023-09-06', 'Miércoles', '15:00:00', '2023-09-08', 'RAMUEL RERNANDEZ', 'Estándar', '1 Adulto', 976, 100, 'Directa', '', 2, '10', 'Alergica al mango', -1862),
(15, '2023-09-07', 'Jueves', '15:00:00', '2023-09-10', 'RAMUEL RERNANDEZ', 'Estándar', '1 Adulto', 976, 0, 'Directa', '', 2, '', 'nINGUNO', -1952),
(16, '2023-09-06', 'Miércoles', '15:00:00', '2023-09-08', 'RAMUEL RERNANDEZ', 'Estándar', '1 Adulto', 976, 100, 'Directa', '', 2, '100', 'ninguno', -1952),
(17, '2023-09-07', 'Jueves', '15:00:00', '2023-09-10', 'RAMUEL RERNANDEZ', 'Estándar', '1 Adulto', 976, 101, 'Directa', '', 3, '', 'ninguno', -2827),
(18, '2023-09-07', 'Jueves', '15:00:00', '2023-09-09', 'RAMUEL RERNANDEZ', 'Estándar', '1 Adulto', 976, 100, 'Directa', '', 2, '', 'ninguno', -1852),
(19, '2023-09-07', 'Jueves', '15:00:00', '2023-09-09', 'RAMUEL RERNANDEZ', 'Estándar', '1 Adulto', 976, 0, 'Directa', '', 2, '', 'ninguno', -1952),
(20, '2023-09-07', 'Jueves', '15:00:00', '2023-09-10', 'RAMUEL RERNANDEZ', 'Estándar', '1 Adulto', 976, 52, 'Directa', '', 3, '', 'ninguno', -2876),
(21, '2023-09-09', 'Sábado', '15:00:00', '2023-09-10', 'RAMUEL RERNANDEZ', 'Cuna de moisés', '1 Adulto', 976, 0, 'Directa', '0', 1, '0', 'Alergica al mango', -976),
(22, '2023-09-09', 'Sábado', '15:00:00', '2023-09-10', 'ALAN MARCIAL', 'Tulipan', '1', 1095, 0, 'Directa', '0', 1, '0', 'ninguno', -1095),
(23, '2023-09-09', 'Sábado', '15:00:00', '2023-09-10', 'RAMUEL RERNANDEZ', 'Cuna de moisés', '1', 976, 0, 'Directa', '', 1, '', 'No utilizar flores en la decoración de la habitación', -976),
(24, '2023-09-09', 'Sábado', '15:00:00', '2023-09-10', 'RAMUEL RERNANDEZ', 'Dalia', '1 Adulto', 976, 0, 'Directa', '0', 1, '0', 'NINGUNO', -976),
(25, '2023-09-10', 'Domingo', '15:00:00', '2023-09-11', 'ALAN MARCIAL', 'Cuna de moisés', '1', 976, 0, 'Directa', '0', 1, '0', 'NINGUNO', -976),
(26, '2023-09-12', 'Martes', '15:00:00', '2023-09-13', 'SHAURY SANTIAGO', 'Cuna de moisés', '1', 1071, 0, 'Directa', '', 1, '', 'xd', -1071),
(27, '2023-09-13', 'Miércoles', '15:00:00', '2023-09-14', 'ALAN MARCIAL', 'Dalia', '1', 976, 0, 'Directa', '0', 1, '0', 'xdxd', -976),
(28, '2023-09-23', 'Sábado', '15:00:00', '2023-09-24', 'RAMUEL RERNANDEZ', 'Dalia', '1', 976, 0, 'Directa', '0', 1, '0', 'xdxd', -976),
(29, '2023-09-21', 'Jueves', '15:00:00', '2023-09-22', 'ALAN MARCIAL MARÍN', 'Bugambilia', '1', 1095, 0, 'Directa', '0', 1, '0', 'ninguno', -1095),
(30, '2023-09-21', 'Jueves', '15:00:00', '2023-09-22', 'ALAN MARCIAL MARÍN', 'Cuna de moisés', '1', 976, 0, 'Directa', '0', 1, '0', 'ninguno', -976),
(31, '2023-09-22', 'Viernes', '15:00:00', '2023-09-23', 'ALAN MARCIAL MARÍN', 'Dalia', '1', 976, 0, 'Directa', '0', 1, '0', 'ninguno', -976),
(32, '2023-09-22', 'Viernes', '15:00:00', '2023-09-23', 'RAMUEL RERNANDEZ', 'Dalia', '1', 976, 0, 'Directa', '0', 1, '0', 'ninguno', -976),
(33, '2023-09-22', 'Viernes', '15:00:00', '2023-09-23', 'ALAN MARCIAL MARÍN', 'Cuna de moisés', '1', 976, 0, 'Directa', '0', 1, '0', 'ninguno', -976),
(34, '2023-09-22', 'Viernes', '15:00:00', '2023-09-23', 'ALAN MARCIAL MARÍN', 'Dalia', '1', 976, 0, 'Directa', '0', 1, '0', 'ninguno', -976),
(35, '2023-09-22', 'Viernes', '15:00:00', '2023-09-23', 'ALAN MARCIAL MARÍN', 'Cuna de moisés', '1', 976, 0, 'Directa', '0', 1, '0', 'ninguno', -976),
(36, '2023-09-24', 'Domingo', '15:00:00', '2023-09-27', 'ALAN MARCIAL MARÍN', 'Estándar', '1', 976, 0, 'Directa', '', 3, '', 'xd', -2928),
(37, '2023-09-01', 'Viernes', '15:00:00', '2023-09-05', 'RAMUEL RERNANDEZ', 'Estándar', '1', 1071, 0, 'Directa', '', 4, '', 'ninguno', -4284),
(38, '2023-09-29', 'Viernes', '15:00:00', '2023-10-04', 'ALAN MARCIAL MARÍN', 'Bugambilia', '1 Adulto', 1202, 0, 'Directa', '0', 5, '0', 'xdxd', -6010),
(39, '2023-09-28', 'Jueves', '15:00:00', '2023-10-01', 'RAMUEL RERNANDEZ', 'Cuna de moisés', '1', 1071, 0, 'Directa', '0', 3, '0', 'xd', -3213),
(40, '2023-09-28', 'Jueves', '15:00:00', '2023-10-03', 'RAMUEL RERNANDEZ', 'Dalia', '1', 1071, 0, 'Directa', '0', 5, '0', 'ninguno', -5355),
(41, '2023-09-24', 'Domingo', '15:00:00', '2023-09-27', 'ALAN MARCIAL MARÍN', 'Margarita', '1', 1403, 0, 'Directa', '0', 3, '0', 'ninguno', -4209),
(42, '2023-09-24', 'Domingo', '15:00:00', '2023-09-27', 'RAMUEL RERNANDEZ', 'Lily', '1', 1244, 0, 'Directa', '0', 3, '0', 'NINGUNO', -3732),
(43, '2023-09-17', 'Domingo', '15:00:00', '2023-09-20', 'YAMILETH PEÑA', 'Girasol', '1', 1244, 0, 'Directa', '0', 3, '0', 'ninguno', -3732),
(44, '2023-09-12', 'Martes', '15:00:00', '2023-09-15', 'VALERIA HERNÁNDEZ', 'Jazmín', '2', 1095, 0, 'Directa', '0', 3, '0', 'ninguno', -3285),
(45, '2023-09-27', 'Miércoles', '15:00:00', '2023-10-02', 'ALAN MARCIAL MARÍN', 'Estándar', '1', 976, 0, 'Directa', '', 5, '', 'No utilizar flores en la decoración de la habitación', -4880),
(46, '2023-09-27', 'Miércoles', '15:00:00', '2023-10-02', 'RAMUEL RERNANDEZ', 'Margarita', '1', 1403, 0, 'Directa', '0', 5, '0', 'ALERGICA A LOS FRUTOS SECOS', -7015),
(47, '2023-10-23', 'Lunes', '15:00:00', '2023-10-24', 'shauro marcial', 'Cuna de moisés', '1 Adulto', 976, 0, 'Directa', '0', 1, '1617', 'xdxdxd', -2593),
(48, '2023-10-26', 'Jueves', '15:00:00', '2023-10-27', 'MARIAN LUIS SILVA', 'Bugambilia', '1', 1202, 0, 'Directa', '0', 1, '0', 'xdxdxd', -1202),
(49, '2023-10-27', 'Viernes', '15:00:00', '2023-10-28', 'ALAN MARCIAL MARÍN', 'Girasol', '1', 1361, 0, 'Directa', '0', 1, '424', 'ALERGICA A LOS FRUTOS SECOS', -1785),
(50, '2023-11-07', 'Martes', '15:00:00', '2023-11-08', 'MARIAN LUIS SILVA', 'Lily', '1', 1380, 0, 'DVillaIluminada', '0', 1, '0', 'Ninguno', -1380),
(51, '2023-11-03', 'Viernes', '15:00:00', '2023-11-04', 'ALAN MARCIAL MARÍN', 'Cuna de moisés', '1', 1071, 0, 'Directa', '0', 1, '0', 'nINGUNO', -1071),
(52, '2023-11-07', 'Martes', '15:00:00', '2023-11-08', 'LAURA CHIN DZUL', 'Bugambilia', '2', 1095, 0, 'Directa', '0', 1, '0', 'nINGUNO', -1095),
(53, '2023-11-15', 'Miércoles', '15:00:00', '2023-11-16', 'SAMUEL HERNANDEZ', 'Superior', '1', 1215, 0, 'DVillaIluminada', '', 1, '', 'Alergica al mango', -1215),
(54, '2023-11-15', 'Miércoles', '15:00:00', '2023-11-16', 'SAMUEL HERNANDEZ', 'Cuna de moisés', '1', 1083, 0, 'DVillaIluminada', '0', 1, '0', 'xd', -1083),
(55, '2023-11-20', 'Lunes', '15:00:00', '2023-11-21', 'SAMUEL HERNANDEZ', 'Cuna de moisés', '2', 1210, 0, 'DVillaIluminada', '0', 1, '125', 'xd', -1335),
(56, '2023-11-21', 'Martes', '15:00:00', '2023-11-22', 'SHAURY SANTIAGO AGUILAR', 'Dalia', '1', 976, 0, 'Directa', '0', 1, '0', 'xd', -976),
(57, '2024-01-18', 'Jueves', '15:00:00', '2024-01-19', 'DAYANNA GÓMEZ', 'Dalia', '1 Adulto', 976, 0, 'Directa', '2800', 1, '125', 'Alergica al mango', -1101),
(58, '2024-01-18', 'Jueves', '15:00:00', '2024-01-19', 'RAMUEL RERNANDEZ', 'Superior', '1', 1095, 500, 'Directa', '', 1, '', 'nINGUNO', -595);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_frecuentes`
--

CREATE TABLE `clientes_frecuentes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `fecha_nac` date NOT NULL,
  `sexo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `rfc` varchar(255) NOT NULL,
  `procedencia` varchar(255) NOT NULL,
  `nivel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes_frecuentes`
--

INSERT INTO `clientes_frecuentes` (`id`, `nombre`, `apellidos`, `fecha_nac`, `sexo`, `email`, `telefono`, `rfc`, `procedencia`, `nivel`) VALUES
(2, 'Alan ', 'Marcial', '1999-05-16', 'Masculino', 'alan.marcial@alumno.buap.mx', '971564987', 'MAMA9905161R4', 'OAXACA', ''),
(3, 'Shaury', 'Aguilar', '1999-07-02', 'Femenino', 'shaury.santiago@gmail.com', '9711117360', 'SAAS9907021R6', 'PUEBLA', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `cod_reserva` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `salida` date NOT NULL,
  `cliente` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `habitacion` varchar(50) NOT NULL,
  `huespedes` varchar(30) NOT NULL,
  `edades` varchar(100) NOT NULL,
  `tarifa` int(10) NOT NULL,
  `sextras` varchar(30) NOT NULL,
  `noches` int(2) NOT NULL,
  `total` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`cod_reserva`, `fecha`, `salida`, `cliente`, `email`, `telefono`, `habitacion`, `huespedes`, `edades`, `tarifa`, `sextras`, `noches`, `total`) VALUES
(1, '2023-07-18', '2023-07-20', 'SAMUEL HERNANDEZ', 'na', '9711117350', 'Estándar', '2', '2 Adultos (18 años +)', 951, '', 2, 1902),
(2, '2023-07-18', '2023-07-20', 'ALAN MARCIAL', 'alan.marcial@alumno.buap.mx', '9711117350', 'Deluxe_con_vista_a_los_volcanes', '2', '2 Adultos (18 años +)', 1379, '', 2, 2758),
(3, '2024-01-25', '2024-01-26', 'SHAURY SANTIAGO AGUILAR', 'jamitmarcial@gmail.com', '0000000000', 'Superior', '2', '2 Adultos (18 años +)', 1095, '', 1, 1095);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `crm`
--

CREATE TABLE `crm` (
  `cod_reserva` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `salida` date NOT NULL,
  `cliente` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `habitacion` varchar(50) NOT NULL,
  `huespedes` varchar(30) NOT NULL,
  `edades` varchar(100) NOT NULL,
  `tarifa` int(10) NOT NULL,
  `sextras` varchar(30) NOT NULL,
  `noches` int(2) NOT NULL,
  `total` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `crm`
--

INSERT INTO `crm` (`cod_reserva`, `fecha`, `salida`, `cliente`, `email`, `telefono`, `habitacion`, `huespedes`, `edades`, `tarifa`, `sextras`, `noches`, `total`) VALUES
(1, '2023-07-18', '2023-07-20', 'SAMUEL HERNANDEZ', 'na', '9711117350', 'Estándar', '2', '2 Adultos (18 años +)', 951, '', 2, 1902),
(2, '2023-07-18', '2023-07-20', 'ALAN MARCIAL', 'alan.marcial@alumno.buap.mx', '9711117350', 'Deluxe_con_vista_a_los_volcanes', '2', '2 Adultos (18 años +)', 1379, '', 2, 2758),
(3, '2024-01-25', '2024-01-26', 'SHAURY SANTIAGO AGUILAR', 'jamitmarcial@gmail.com', '0000000000', 'Superior', '2', '2 Adultos (18 años +)', 1095, '', 1, 1095);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrec`
--

CREATE TABLE `entrec` (
  `cod_pen` int(11) NOT NULL,
  `pendiente1` varchar(200) NOT NULL,
  `pendiente2` varchar(200) NOT NULL,
  `pendiente3` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entrec`
--

INSERT INTO `entrec` (`cod_pen`, `pendiente1`, `pendiente2`, `pendiente3`) VALUES
(1, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventoscalendar`
--

CREATE TABLE `eventoscalendar` (
  `id` int(11) NOT NULL,
  `evento` varchar(250) DEFAULT NULL,
  `color_evento` varchar(20) DEFAULT NULL,
  `fecha_inicio` varchar(20) DEFAULT NULL,
  `fecha_fin` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eventoscalendar`
--

INSERT INTO `eventoscalendar` (`id`, `evento`, `color_evento`, `fecha_inicio`, `fecha_fin`) VALUES
(335, 'Cuna de moisés', '#ed1330', '2024-01-25', '2024-01-26'),
(336, 'Dalia', '#ed1330', '2024-01-25', '2024-01-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `cod_factura` int(11) NOT NULL,
  `salida` date NOT NULL,
  `cliente` varchar(30) NOT NULL,
  `rfc` varchar(30) NOT NULL,
  `lugar` varchar(30) NOT NULL,
  `descrip` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `pago` varchar(100) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`cod_factura`, `salida`, `cliente`, `rfc`, `lugar`, `descrip`, `email`, `telefono`, `pago`, `total`) VALUES
(2, '2022-12-03', 'Textiles SA', 'YISIYW64851', 'Atlixco, Puebla', 'Hospedaje y Alimentos', 'na', 'na', 'Efectivo', 0),
(3, '2022-12-04', 'Textiles SA', 'TEXT6846834', 'Atlixco, Puebla', 'Hospedaje y Alimentos', 'na', 'na', 'TDC', 0),
(4, '2022-12-04', 'Textiles SA', 'TEXT6846834', 'Atlixco, Puebla', 'Hospedaje y Alimentos', 'na', 'na', 'TDC', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `finalizadas`
--

CREATE TABLE `finalizadas` (
  `cod_reserva` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `dia` varchar(11) NOT NULL,
  `llegada` time NOT NULL,
  `salida` date NOT NULL,
  `cliente` varchar(30) NOT NULL,
  `habitacion` varchar(30) NOT NULL,
  `huespedes` varchar(30) NOT NULL,
  `tarifa` float NOT NULL,
  `anticipo` int(10) NOT NULL,
  `via` varchar(30) NOT NULL,
  `sextras` varchar(30) NOT NULL,
  `noches` int(2) NOT NULL,
  `cextras` varchar(10) NOT NULL,
  `comentarios` varchar(100) NOT NULL,
  `total` float NOT NULL,
  `garantia` varchar(30) NOT NULL,
  `pago` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `finalizadas`
--

INSERT INTO `finalizadas` (`cod_reserva`, `fecha`, `dia`, `llegada`, `salida`, `cliente`, `habitacion`, `huespedes`, `tarifa`, `anticipo`, `via`, `sextras`, `noches`, `cextras`, `comentarios`, `total`, `garantia`, `pago`) VALUES
(1, '2023-11-17', 'Viernes', '15:00:00', '2023-11-19', 'GABRIELA VILLALBA', 'Lily', '2', 1427.11, 0, 'OTA', '0', 2, '0', 'ninguno', -2854.22, 'ID ($400.00 DEVUELTO)', ''),
(2, '2023-11-17', 'Viernes', '15:00:00', '2023-11-19', 'GABRIELA VILLALBA', 'Lily', '2', 1427.11, 0, 'OTA', '0', 2, '0', 'ninguno', -2854.22, 'ID ($400.00 DEVUELTO)', ''),
(3, '2023-10-28', 'Sábado', '15:00:00', '2023-10-29', 'ROSANNA LOPEZ OCAMPO', 'Cuna de moisés', '2', 1244.75, 0, 'OTA', '0', 1, '0', 'No a dado anticipo', -1244.75, 'ID ($400.00 DEVUELTO)', ''),
(4, '2023-10-28', 'Sábado', '15:00:00', '2023-10-29', 'ROSANNA LOPEZ OCAMPO', 'Cuna de moisés', '2', 1244.75, 0, 'OTA', '0', 1, '0', 'No a dado anticipo', -1244.75, 'ID ($400.00 DEVUELTO)', ''),
(5, '2023-10-28', 'Sábado', '15:00:00', '2023-10-29', 'ROSANNA LOPEZ OCAMPO', 'Cuna de moisés', '2', 1244.75, 0, 'OTA', '0', 1, '0', 'No a dado anticipo', -1244.75, 'ID ($400.00 DEVUELTO)', ''),
(6, '2023-10-13', 'Viernes', '15:00:00', '2023-10-15', 'ALEJANDRO JIMENO', 'Margarita', '2', 1522, 1306, 'Directa', '0', 2, '0', 'Dio anticipo por deposito/ DESCUENTO OTORGADO 6%', -1738, 'ID (DEVUELTO)', ''),
(7, '2023-08-24', 'Jueves', '15:00:00', '2023-08-25', 'ALAN MARCIAL', 'Bugambilia', '1', 1095, 0, 'Directa', '0', 1, '0', 'nINGUNO', -1095, 'D.S. $400 (DEVUELTO)', ''),
(8, '2023-08-24', 'Jueves', '15:00:00', '2023-08-25', 'ALAN MARCIAL', 'Lily', '1', 1244, 0, 'Directa', '0', 1, '0', 'nINGUNO', -1244, 'ID (DEVUELTO)', ''),
(9, '2023-09-09', 'Sábado', '15:00:00', '2023-09-10', 'RAMUEL RERNANDEZ', 'Cuna de moisés', '1', 976, 0, 'Directa', '0', 1, '0', 'ninguno', -976, 'D.S. $400 (DEVUELTO)', ''),
(10, '2023-09-09', 'Sábado', '15:00:00', '2023-09-10', 'YAMILETH PEÑA', 'Cuna de moisés', '1', 1071, 0, 'Directa', '0', 1, '0', 'ninguno', -1071, 'D.S. $400 (DEVUELTO)', ''),
(11, '2023-09-09', 'Sábado', '15:00:00', '2023-09-10', 'RAMUEL RERNANDEZ', 'Cuna de moisés', '1', 976, 0, 'Directa', '0', 1, '0', 'ninguno', -976, 'ID (DEVUELTO)', ''),
(12, '2023-09-10', 'Domingo', '15:00:00', '2023-09-11', 'ALAN MARCIAL', 'Dalia', '1', 1071, 0, 'Directa', '0', 1, '0', 'ninguno', -1071, 'D.S. $400 (DEVUELTO)', ''),
(13, '2023-09-09', 'Sábado', '15:00:00', '2023-09-10', 'MARIAN LUIS SILVA', 'Dalia', '1', 976, 0, 'Directa', '0', 1, '0', 'ninguno', -976, 'ID (DEVUELTO)', ''),
(14, '2023-09-09', 'Sábado', '15:00:00', '2023-09-10', 'RAMUEL RERNANDEZ', 'Cuna de moisés', '1', 976, 0, 'Directa', '0', 1, '0', 'ninguno', -976, 'D.S. $400 (DEVUELTO)', ''),
(15, '2023-09-11', 'Lunes', '15:00:00', '2023-09-12', 'ALAN MARCIAL', 'Cuna de moisés', '1', 976, 0, 'Directa', '0', 1, '0', 'ninguno', -976, 'D.S. $400 (DEVUELTO)', ''),
(18, '2023-09-11', 'Lunes', '15:00:00', '2023-09-12', 'ALAN MARCIAL', 'Cuna de moisés', '1', 976, 0, 'Directa', '0', 1, '0', 'NINGUNO', -976, 'D.S. $400 (DEVUELTO)', ''),
(19, '2023-10-20', 'Viernes', '15:00:00', '2023-10-21', 'ALAN MARCIAL MARÍN', 'Girasol', '1', 1361, 0, 'Directa', '0', 1, '0', 'ninguno', -1361, 'ID (DEVUELTO)', ''),
(20, '2023-10-19', 'Jueves', '15:00:00', '2023-10-20', 'ALAN MARCIAL MARÍN', 'Cuna de moisés', '1', 976, 0, 'Directa', '0', 1, '0', 'ninguno', -976, 'ID (DEVUELTO)', ''),
(21, '2023-10-20', 'Viernes', '15:00:00', '2023-10-21', 'DANIELA SARABIA RODARTE', 'Dalia', '1', 1071, 0, 'Directa', '0', 1, '0', 'ninguno', -1071, 'ID (DEVUELTO)', ''),
(22, '2023-10-19', 'Jueves', '15:00:00', '2023-10-20', 'SHAURY SANTIAGO AGUILAR', 'Bugambilia', '1', 1095, 0, 'Directa', '0', 1, '0', 'ninguno', -1095, 'ID (DEVUELTO)', ''),
(23, '2023-10-19', 'Jueves', '15:00:00', '2023-10-20', 'LAURA CHIN DZUL', 'Lily', '1', 1244, 0, 'Directa', '0', 1, '0', 'ninguno', -1244, 'ID (DEVUELTO)', ''),
(24, '2023-10-19', 'Jueves', '15:00:00', '2023-10-20', 'MARIAN LUIS SILVA', 'Margarita', '1', 1403, 0, 'Directa', '0', 1, '0', 'ninguno', -1403, 'ID (DEVUELTO)', ''),
(25, '2023-11-07', 'Martes', '15:00:00', '2023-11-08', 'SHAURY SANTIAGO AGUILAR', 'Dalia', '1', 1083.14, 0, 'DVillaIluminada', '0', 1, '0', 'Ninguno', -1083.14, 'ID (DEVUELTO)', ''),
(26, '2023-12-13', 'Miércoles', '15:00:00', '2023-12-15', 'DANIELA SARABIA RODARTE', 'Dalia', '1', 1213.11, 0, 'BookingVillaIluminada', '0', 2, '0', 'ninguno', -2426.22, 'ID (DEVUELTO)', ''),
(27, '2024-01-25', 'Jueves', '15:00:00', '2024-01-26', 'MARIAN LUIS SILVA', 'Dalia', '1', 976, 0, 'Directa', '0', 1, '0', 'nINGUNO', -976, 'ID (DEVUELTO)', ''),
(28, '2024-02-01', 'Jueves', '15:00:00', '2024-02-02', 'MARIAN LUIS SILVA', 'Dalia', '1', 976, 0, 'Directa', '0', 1, '0', 'Ninguno', -976, 'ID (DEVUELTO)', ''),
(29, '2024-02-14', 'Miércoles', '15:00:00', '2024-02-15', 'LAURA CHIN DZUL', 'Cuna de moisés', '1', 976, 100, 'Directa', '0', 1, '0', 'NINGUNO', -876, 'ID (DEVUELTO)', 'Efectivo'),
(30, '2024-02-14', 'Miércoles', '15:00:00', '2024-02-16', 'MARIAN LUIS SILVA', 'Jazmín', '1 Adulto', 1095, 100, 'Directa', '0', 2, '0', 'nINGUNO', -2090, 'ID (DEVUELTO)', 'TDC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `cod_incidencia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `habitacion` varchar(30) NOT NULL,
  `area` varchar(30) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `costo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`cod_incidencia`, `fecha`, `habitacion`, `area`, `descripcion`, `costo`) VALUES
(1, '2023-09-12', 'Cuna de moisés', 'Blancos', 'Almohadas manchadas', 150),
(2, '2023-09-11', 'Dalia', 'Amenidades', 'Mesa de noche rayada', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `habitacion_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` enum('disponible','ocupada','mantenimiento') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`habitacion_id`, `nombre`, `tipo`, `descripcion`, `estado`) VALUES
(1, 'Cuna de moisés', 'Estándar', 'Habitación estándar con cama matrimonial', 'disponible'),
(2, 'Dalia', 'Estándar', 'Habitación estándar con cama matrimonial', 'disponible'),
(3, 'Bugambilia', 'Superior', 'Habitación superior con cama queen size', 'disponible'),
(4, 'Tulipan', 'Superior', 'Habitación superior con cama queen size', 'disponible'),
(5, 'Jazmín', 'Superior', 'Habitación superior con cama queen size', 'disponible'),
(6, 'Violeta', 'Superior', 'Habitación superior con cama queen size', 'disponible'),
(7, 'Lily', 'Superior_Deluxe', 'Habitación superior deluxe con cama king size', 'disponible'),
(8, 'Girasol', 'Superior_Deluxe', 'Habitación superior deluxe con cama king size', 'disponible'),
(9, 'Margarita', 'Deluxe_con_vista_a_los_volcanes', 'Habitación Deluxe con vista a los volcanes con cama king size', 'disponible'),
(10, 'Nochebuena', 'Deluxe_con_vista_a_los_volcanes', 'Habitación Deluxe con vista a los volcanes con cama king size', 'disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidencias`
--

CREATE TABLE `incidencias` (
  `cod_incidencia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `habitacion` varchar(30) NOT NULL,
  `area` varchar(30) NOT NULL,
  `descripcion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pospuestas`
--

CREATE TABLE `pospuestas` (
  `cod_reserva` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `dia` varchar(11) NOT NULL,
  `llegada` time NOT NULL,
  `salida` date NOT NULL,
  `cliente` varchar(30) NOT NULL,
  `habitacion` varchar(30) NOT NULL,
  `huespedes` varchar(30) NOT NULL,
  `tarifa` int(10) NOT NULL,
  `anticipo` int(10) NOT NULL,
  `via` varchar(30) NOT NULL,
  `sextras` varchar(30) NOT NULL,
  `noches` int(2) NOT NULL,
  `cextras` varchar(10) NOT NULL,
  `comentarios` varchar(100) NOT NULL,
  `total` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones`
--

CREATE TABLE `reservaciones` (
  `cod_reserva` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `dia` varchar(11) NOT NULL,
  `llegada` time NOT NULL,
  `salida` date NOT NULL,
  `cliente` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `habitacion` varchar(50) DEFAULT NULL,
  `huespedes` varchar(30) NOT NULL,
  `edades` varchar(100) NOT NULL,
  `tarifa` varchar(100) NOT NULL,
  `anticipo` int(10) NOT NULL,
  `via` varchar(30) NOT NULL,
  `sextras` varchar(255) DEFAULT NULL,
  `noches` int(2) NOT NULL,
  `cextras` varchar(10) NOT NULL,
  `textras` varchar(10) NOT NULL,
  `garantia` varchar(30) DEFAULT NULL,
  `comentarios` text DEFAULT NULL,
  `pago` varchar(100) NOT NULL,
  `total` float NOT NULL,
  `status` varchar(30) NOT NULL,
  `gtotal` varchar(30) DEFAULT NULL,
  `desc_servicios` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'RecepcionCFv', '$2y$10$UmQTnLd00kf1/KO8QlipTul9GCAzhqKXllE/tNTl8SzrwMde2I70S', '2023-11-21 16:40:06'),
(2, 'RecepcionCFm', '$2y$10$muDv0DLbIcNrwWzpTSZe4uNEB7xSqdvs8FeJyuiXnyS82NwIbUje.', '2023-11-21 16:40:26'),
(3, 'RecepcionCFn', '$2y$10$EZAXA/pf/cWw5RFuH.4mlugtc.jacV1DQC7cIQwhBKOXLFUwQYlVK', '2023-11-21 16:40:45'),
(4, 'CFJO', '$2y$10$Wbgrlg49lNpsJwYM7iUBl.TFQa9hmrJQBrapb9KTCXNJynZntOXJ6', '2023-11-21 16:41:07'),
(5, 'Administrador', '$2y$10$BlakheuWJiGD1pyEGMydn.JsOSe55AYMBiUXqXQmfnlJ2jiPxWf4e', '2023-11-21 16:41:30'),
(6, 'RecepcionCubreTurno', '$2y$10$hu7OLbQo3eKYO19j9DR39eehMsand7sEA3o0scXE4ZP7DgkkQ9Fyi', '2023-11-21 16:41:57'),
(7, 'AnfitrionApoyo', '$2y$10$6ojmKwEPEtmmZEEvHQmRMewMigEWA4MdTgaZrESQt9/RlV.EiBPDq', '2023-11-21 16:42:20'),
(8, 'Cocina1', '$2y$10$LEEoZJODvKGvf63qY4hvoecMDxl5csWHbTwgx9ZLOwZhchzah4/NS', '2024-01-17 11:19:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventadirecta`
--

CREATE TABLE `ventadirecta` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cantidad` varchar(255) NOT NULL,
  `preciou` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventadirecta`
--

INSERT INTO `ventadirecta` (`id`, `nombre`, `cantidad`, `preciou`) VALUES
(52, 'plato frutas niño', '1', '45'),
(53, 'plato frutas niño', '1', '45'),
(54, 'pan integral salado', '1', '15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cajach`
--
ALTER TABLE `cajach`
  ADD PRIMARY KEY (`cod_dia`);

--
-- Indices de la tabla `cajaop`
--
ALTER TABLE `cajaop`
  ADD PRIMARY KEY (`cod_operacion`);

--
-- Indices de la tabla `cancelaciones`
--
ALTER TABLE `cancelaciones`
  ADD PRIMARY KEY (`cod_reserva`);

--
-- Indices de la tabla `clientes_frecuentes`
--
ALTER TABLE `clientes_frecuentes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`cod_reserva`);

--
-- Indices de la tabla `crm`
--
ALTER TABLE `crm`
  ADD PRIMARY KEY (`cod_reserva`);

--
-- Indices de la tabla `entrec`
--
ALTER TABLE `entrec`
  ADD PRIMARY KEY (`cod_pen`);

--
-- Indices de la tabla `eventoscalendar`
--
ALTER TABLE `eventoscalendar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `finalizadas`
--
ALTER TABLE `finalizadas`
  ADD PRIMARY KEY (`cod_reserva`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`cod_incidencia`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`habitacion_id`);

--
-- Indices de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  ADD PRIMARY KEY (`cod_incidencia`);

--
-- Indices de la tabla `pospuestas`
--
ALTER TABLE `pospuestas`
  ADD PRIMARY KEY (`cod_reserva`);

--
-- Indices de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD PRIMARY KEY (`cod_reserva`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `ventadirecta`
--
ALTER TABLE `ventadirecta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cajach`
--
ALTER TABLE `cajach`
  MODIFY `cod_dia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cajaop`
--
ALTER TABLE `cajaop`
  MODIFY `cod_operacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cancelaciones`
--
ALTER TABLE `cancelaciones`
  MODIFY `cod_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `clientes_frecuentes`
--
ALTER TABLE `clientes_frecuentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `cod_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `crm`
--
ALTER TABLE `crm`
  MODIFY `cod_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `entrec`
--
ALTER TABLE `entrec`
  MODIFY `cod_pen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `eventoscalendar`
--
ALTER TABLE `eventoscalendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT de la tabla `finalizadas`
--
ALTER TABLE `finalizadas`
  MODIFY `cod_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `cod_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `habitacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `incidencias`
--
ALTER TABLE `incidencias`
  MODIFY `cod_incidencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pospuestas`
--
ALTER TABLE `pospuestas`
  MODIFY `cod_reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  MODIFY `cod_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ventadirecta`
--
ALTER TABLE `ventadirecta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
