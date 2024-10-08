-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 05-08-2022 a las 22:41:19
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
-- Estructura de tabla para la tabla `cancelaciones`
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

--
-- Volcado de datos para la tabla `reservaciones`
--

INSERT INTO `pospuestas` (`cod_reserva`, `fecha`, `dia`, `llegada`, `salida`, `cliente`, `habitacion`,`huespedes`, `tarifa`, `anticipo`, `via`, `sextras`, `noches`, `cextras`,`comentarios`,`total`) VALUES
(1, '2018-10-13', 'SÁBADO', '15:00:00', '2013-10-19', 'ALAN MARCIAL', 'Cuna de Moisés', '2 Adultos', '630.50', '1261', 'AIRBNB', 'NINGUNO', 2, '-400','Ninguno','1661');


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `reservaciones`
--
ALTER TABLE `pospuestas`
  ADD PRIMARY KEY (`cod_reserva`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reservaciones`
--
ALTER TABLE `pospuestas`
  MODIFY `cod_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;