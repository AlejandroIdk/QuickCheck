-- -----------------------------------------------------
-- INSERT INTO`.`roles`
-- -----------------------------------------------------

INSERT INTO `roles` (`rol_code`, `rol_nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'PROFESOR'),
(3, 'ESTUDIANTE');

-- -----------------------------------------------------
-- INSERT INTO`.`usuario`
-- -----------------------------------------------------
INSERT INTO `usuario` (`usuario_identificacion`, `usuario_nombre`, `usuario_apellido`, `usuario_email`, `usuario_clave`, `rol_code`) VALUES
(345456576, 'FALCAO', 'JUNIOR', 'Falcao@gmail.com', '$2y$10$lYN8ViaBq3BO7ZoedNpFpO7YHYJI3/yOA7EiN1AkQ2.zRlZ8lM2Ya', 3),
(347686773, 'JOHAN', 'NARANJO', 'Johan@gmail.com', '$2y$10$NkS3bbGpLlFLEp/J.mUzPet5qlv9n/EIfltaJc88rOikHVkQDx2A6', 3),
(453745673, 'DIEGO', 'MESA', 'Diego@gmail.com', '$2y$10$p6gzMlqW9McibvbVcK.Cf.mfAVoDzkgU2ak0ga3esfw3TaQloCl8S', 3),
(456785967, 'ELIAS', 'RAMIREZ', 'Elias@gmail.com', '$2y$10$gaFae1ULVWV8gM6F8waoBeUojXePZmhgIHaBdbANnMztSjMbOqF3O', 3),
(546346657, 'ALEJANDRO', 'ORTIZ', 'a@gmail.com', '$2y$10$1U/6eUy63jvIeQ2yNu8XjuOVAhqMzBTQ0bSzQpYPBV6ARjcYfjqi2', 1),
(568769678, 'HECTOR', 'ORTIZ', 'Hector@gmail.com', '$2y$10$GmJDZ67q9KrLYderzYq7t.yRhkJ9o8Lsqj7GBVIwo.TQVZmh3rfWW', 3);

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

-- -----------------------------------------------------
-- INSERT INTO`.`usuario_clase`
-- -----------------------------------------------------

INSERT INTO `usuario_clase` (`userclass_id`, `clase_id`, `usuario_identificacion`, `generated_code`) VALUES
(1, 1, 345456576, '2bk47RhOrS'),
(2, 2, 347686773, 'M48xOnU2fx'),
(3, 14, 345456576, 'jxpbfaCa03'),
(4, 4, 347686773, 'IlZY8TzmAm');

-- -----------------------------------------------------
-- INSERT INTO`.`asistencia`
-- -----------------------------------------------------

INSERT INTO `asistencia` (`asistencia_id`, `usuario_identificacion`, `clase_id`, `fecha`) VALUES
(1, 345456576, 3, '2024-07-19 19:08:06'),
(2, 347686773, 2, '2024-07-19 19:08:11'),
(3, 345456576, 14, '2024-07-19 19:08:13');