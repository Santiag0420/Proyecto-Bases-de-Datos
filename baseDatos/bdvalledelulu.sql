-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2023 a las 19:23:56
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdvalledelulu`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `username` varchar(125) NOT NULL,
  `email` varchar(125) DEFAULT NULL,
  `contraseña` varchar(125) DEFAULT NULL,
  `telefono` varchar(125) DEFAULT NULL,
  `cedula` varchar(125) DEFAULT NULL,
  `ocupacion` varchar(125) DEFAULT NULL,
  `rol` varchar(125) DEFAULT NULL,
  `seguro` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`username`, `email`, `contraseña`, `telefono`, `cedula`, `ocupacion`, `rol`, `seguro`) VALUES
('', 'santiago@asdas.com', '2', NULL, NULL, NULL, NULL, NULL),
('asd123sd', 'santiago@asda', 'asdas', 'bnm', 'mnmnb', 'bnm', 'Predeterminado', 'Sismeven'),
('asd21', 'santiago@adas.com', '123', 'asd', 'asd', 'asd', 'Predeterminado', 'No aplica'),
('asdasd12', 'santiago@adas.comasdas', 'as', 'asdasd', 'asdas', 'asdasd', 'Predeterminado', 'Sismeven'),
('jukiytjhuthjyngh', 'santgo@asdas.co', '123asd', 'asdas', 'asdas', 'asd', 'Predeterminado', 'Sanitos'),
('[value-1]', '[value-2]', '1', '[value-4]', '[value-5]', '[value-6]', '[value-7]', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
