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

ALTER TABLE `clientes_frecuentes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `clientes_frecuentes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;