-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-06-2024 a las 23:51:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pdo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `asistencia_id` int(11) NOT NULL,
  `usuario_identificacion` int(11) NOT NULL,
  `userclass_id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `clase_id` int(11) NOT NULL,
  `clase_nombre` varchar(100) NOT NULL,
  `clase_ubicacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`clase_id`, `clase_nombre`, `clase_ubicacion`) VALUES
(1, 'SISTEMAS', 'A-201'),
(2, 'INGLES', 'B-101'),
(3, 'LOGISTICA', 'C-202'),
(4, 'SEGURIDAD Y SALUD', 'A-204'),
(5, 'ENFERMERIA', 'B-303'),
(6, 'CALCULO I', 'A-202'),
(7, 'CALCULO II', 'A-503'),
(8, 'ECONOMIA', 'A-303'),
(9, 'CONTABILIDAD', 'A-101'),
(10, 'GRASTRONOMIA', 'C-202'),
(11, 'CINE Y CAMARA', 'A-202'),
(12, 'BELLEZA', 'C-104'),
(13, 'DEPORTE', 'C-301'),
(14, 'SOLUCIONES INTEGRALES', 'D-102'),
(15, 'BARBERIA', 'C-203'),
(16, 'VETERINARIA', 'C-304');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_code` int(11) NOT NULL,
  `rol_nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_code`, `rol_nombre`) VALUES
(1, 'administrador'),
(2, 'Profesor'),
(3, 'Estudiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_identificacion` int(11) NOT NULL,
  `usuario_nombre` varchar(100) NOT NULL,
  `usuario_email` varchar(100) NOT NULL,
  `usuario_clave` varchar(200) NOT NULL,
  `rol_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_identificacion`, `usuario_nombre`, `usuario_email`, `usuario_clave`, `rol_code`) VALUES
(14564356, 'Administrador', 'Principal@gmail.com', '$2y$10$jMaEKZ/GVxyzDmYD/hOYfu7AxyOP0kg0zcPn66BP7dB2OWMXgNuUa', 1),
(123464575, 'Tatiana', 'Tatiana@gmail.com', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 2),
(235346568, 'Sofia', 'sofia@gmail.com', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 2),
(264366798, 'Steven', 'steven@gmail.com', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 2),
(328743223, 'Alejandro', 'alejandro@gmail.com', '$2y$10$vXnmDev6djHCIvHqAoVSzOALOoAS4Qq1b7E44eHXFZKriiTjnBDYe', 2),
(345654765, 'Marcos', 'marcos@gmail.com', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 2),
(457688799, 'Nicolas', 'nicolas@gmail.com', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 2),
(546346657, 'Jefferson', 'a@gmail.com', '$2y$10$/lskLbGuf.hDbnqn1IxhKuTJg51EQJIDjsgFOaEsRmW/4uzxQ/9li', 2),
(567568895, 'David', 'david@gmail.com', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 2),
(654632465, 'Jose', 'jose@gmail.com', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 2),
(657345686, 'Lucho', 'lucho@gmail.com', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 2),
(768345645, 'Johan', 'johan@gmail.com', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 2),
(796765334, 'Dayanna', 'dayanna@gmail.com', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 2),
(879435645, 'Ivan', 'ivan@gmail.com', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 2),
(954744523, 'Katerin', 'katerin@gmail.com', '$2y$10$D2SCJxYKTOFGpu6tFJ/lRuaRdbvsTMyuZuGbOW.0.7QGzY1qEXwbO', 2),
(980866575, 'Franck', 'Franck@gmail.com', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 2),
(987345743, 'Marcos', 'marcos@gmail.com', '$2y$10$EPY9LSLOFLDDBriuJICmFOqmZdnDXxLJG8YFbog5LcExp77DBQvgC', 2),
(2147483647, 'Elias', 'elias@gmail.com', '$2y$10$Cj2Xti4kGh3vUoyvLhpkL.e/miDmelMgmevfIRmDUjXP9HQNWzPju', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_clase`
--

CREATE TABLE `usuario_clase` (
  `userclass_id` int(11) NOT NULL,
  `clase_id` int(11) NOT NULL,
  `usuario_identificacion` int(11) NOT NULL,
  `generated_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_clase`
--

INSERT INTO `usuario_clase` (`userclass_id`, `clase_id`, `usuario_identificacion`, `generated_code`) VALUES
(8, 3, 2147483647, ''),
(9, 3, 235346568, ''),
(10, 2, 264366798, 'JoF2nkcV4r'),
(11, 14, 567568895, 'GkLezuIGOv');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`asistencia_id`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`clase_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_code`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_identificacion`),
  ADD KEY `rol_code` (`rol_code`);

--
-- Indices de la tabla `usuario_clase`
--
ALTER TABLE `usuario_clase`
  ADD PRIMARY KEY (`userclass_id`),
  ADD KEY `categoria_id` (`clase_id`),
  ADD KEY `usuario_identificacion` (`usuario_identificacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `asistencia_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `clase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuario_clase`
--
ALTER TABLE `usuario_clase`
  MODIFY `userclass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`asistencia_id`) REFERENCES `usuario_clase` (`usuario_identificacion`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_code`) REFERENCES `roles` (`rol_code`);

--
-- Filtros para la tabla `usuario_clase`
--
ALTER TABLE `usuario_clase`
  ADD CONSTRAINT `usuario_clase_ibfk_1` FOREIGN KEY (`clase_id`) REFERENCES `clases` (`clase_id`),
  ADD CONSTRAINT `usuario_clase_ibfk_2` FOREIGN KEY (`usuario_identificacion`) REFERENCES `usuario` (`usuario_identificacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
