-- -----------------------------------------------------
-- INSERT INTO`.`roles`
-- -----------------------------------------------------

INSERT INTO `roles` (`rol_code`, `rol_nombre`) VALUES
(1, 'Administrador'),
(2, 'Profesor'),
(3, 'Estudiante');

-- -----------------------------------------------------
-- INSERT INTO`.`usuario`
-- -----------------------------------------------------
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

-- -----------------------------------------------------
-- INSERT INTO`.`clases`
-- -----------------------------------------------------

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