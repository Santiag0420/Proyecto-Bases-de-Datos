-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2023 a las 05:56:33
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
  `seguro` varchar(125) DEFAULT NULL,
  `code` varchar(10) NOT NULL,
  `verified` int(1) NOT NULL,
  `apellido` varchar(125) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`username`, `email`, `contraseña`, `telefono`, `cedula`, `ocupacion`, `rol`, `seguro`, `code`, `verified`, `apellido`) VALUES
('asd123sd', 'seradi3077@in2reach.com', 'asd', 'asd', 'asd', 'asd', 'Predeterminado', 'SUS', '06pWIXzfew', 0, NULL),
('yeduu', 'santiagoballa2003@gmail.com', '555555', '8845874', 'pouyhghj', 'poijnj', 'Predeterminado', 'Sismeven', 'ImMBJZKAni', 0, 'ouifduh');

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
