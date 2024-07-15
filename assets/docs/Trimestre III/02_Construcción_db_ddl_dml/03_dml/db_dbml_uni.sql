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
INSERT INTO `usuario` (`usuario_identificacion`, `usuario_nombre`, `usuario_apellido`, `usuario_email`, `usuario_clave`, `rol_code`) VALUES
(234231412, 'Luis', 'Lopez', 'Luis@gmail.com', '$2y$10$.EzQxqIgHbJbPIDGAt9oferePsNfJL29vvU8nq8W0UBme5Ju8gNPi', 3),
(345456576, 'Falcao', 'Junior', 'Falcao@gmail.com', '$2y$10$lKeQi7T3AB11j6CcD7VaQ.hFqqr4HeivtrwRNoD2V0v/.a9ppfM7O', 3),
(347686773, 'Johan', 'Naranjo', 'Johan@gmail.com', '$2y$10$IR/FKrEBYQwEnRR4QZ3md.c5UO73tEKtXJoLLR4wxgbgoMiV8kBFu', 3),
(453745673, 'Diego', 'Mesa', 'Diego@gmail.com', '$2y$10$nxxysB7.FxPhYYGufnowpe/JIAaLHYNfjd84uggMSHwRuZcpcokj2', 3),
(456785967, 'Elias', 'Ramirez', 'Elias@gmail.com', '$2y$10$Rb0r/.awlKsrVBJqL/6RTe6UNfa5E6JQWfchPfUFVv76.s8UQVflK', 3),
(457638925, 'James', 'Rodriguez', 'James@gmail.com', '$2y$10$J6tuwboYmdm8h5112QdcfONexB4gaMU6ZZugK3S2YcB4nguoxLnJq', 2),
(546346657, 'Alejandro', 'Ortiz', 'a@gmail.com', '$2y$10$zQqBUFisfgYV91mXMwa0UeT5aawNBAGZIwHuIZkRXhkBB/oLbfJlO', 1),
(568769678, 'Hector', 'Ortiz', 'Hector@gmail.com', '$2y$10$jR8l7U5bACGP4xo.z2Hb8eob/KIeWap3D3HPSoCBb0wqUW.4lrIZu', 3);

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