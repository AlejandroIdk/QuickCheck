-- -----------------------------------------------------
-- INSERT INTO`.`roles`
-- -----------------------------------------------------

INSERT INTO `roles` (`rol_code`, `rol_nombre`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'PROFESOR'),
(3, 'APRENDIZ');

-- -----------------------------------------------------
-- INSERT INTO`.`usuario`
-- -----------------------------------------------------
INSERT INTO `usuario` (`usuario_identificacion`, `usuario_nombre`, `usuario_apellido`, `usuario_email`, `usuario_clave`, `rol_code`) VALUES
(79850926, 'JAVIER', 'GIL SIERRA', 'javiergilsierra.cert@gmail.com', '$2y$10$qG.43Whax/TzY1ov7Yk7cena/GLk5NalBAyRetcMfhAxWwO9CZIOm', 3),
(546346657, 'Alejandro', 'Ortiz', 'elvatoldk0072@gmail.com', '$2y$10$MNLNg057.0smDbOGHwlj5OionLutY.eFbJdqcbf/Q7TfPCN9G3kSO', 1),
(1000615706, 'SERGIO ESTIVEN', 'MILA BUITRAGO', 'sergiomila2001@gmail.com', '$2y$10$s69.zx56OUNjTGa8Pqje8.jhga1XNK5yjtHtC3EffsgaeQyK1.ZPq', 3),
(1001111711, 'BRITT NICOLAS', 'GIL RODRIGUEZ', 'brittnicolasgilrodriguez@gmail.com', '$2y$10$JL8DlovXMoy.HiqNG6d6ze3MXGeU4WWVGKIJsN70d4q7eiIfHKXOC', 3),
(1002455277, 'BRAYAN ARLEY', 'ARAQUE MORA', 'baraquemora@gmail.com', '$2y$10$rKJFXhwPSleltT6hYyx4a.U4l7ZVyGEuaEOUu6B83NdnePkK/Y7Yu', 3),
(1007157772, 'ANDRES FELIPE', 'REYES PAREJA', 'reyespareja0@gmail.com', '$2y$10$MJMBQdlrOPokELQ3al0ed.EkK.evFBlBWqBU9Fqsh/0XoVEcmr7Fq', 3),
(1012342385, 'HECTOR SANTIAGO', 'ORTIZ MANRIQUE', 'santymanrrique54321@gmail.com', '$2y$10$QIAJKjPzC2E.k5wWd1xpMuYtmGyqjPA5cmn9gJ5.newF.qhGXb77q', 3),
(1014224283, 'DAVID CAMILO', 'ORTIZ RINCON', 'david91ortiz14@gmail.com', '$2y$10$eaItbzIOa4RS1h4SslPnx.EAaQ31YFeHElECaXddhVnotkRq1.TpK', 3),
(1014249513, 'MIGUEL ANDRES', 'PARRA SALGUERO', 'miguel.comercial08@gmail.com', '$2y$10$jWsLDRPpgCgmxO96vcKPqO6GiLHVcATMg4Iu9ZUOpiFcwCXB2Y1SO', 3),
(1015483021, 'JUAN SEBASTIAN', 'CASTRO MARTINEZ', 'sebascheshire@gmail.com', '$2y$10$9gssKtxMYOmh9ylsgUEUFO56jRNURq8APo.6jQMKezvv9y6vaCv76', 3),
(1019148936, 'JUAN FELIPE', 'ANGARITA RODRIGUEZ', 'felipeangarita280@gmail.com', '$2y$10$1fzXot9Vhq1tXAcpGnQHseXkW1.THH3M..aHcq8wEJEkOxBINQjbq', 3),
(1023364912, 'JUAN CAMILO', 'PARDO RODRIGUEZ', 'juancamilopardo27@gmail.com', '$2y$10$ERP7dbQDGIOFV3HPnMUhvOP1xg1lzRxr.FOXdgfDivjw4BRm43qYy', 3),
(1025142230, 'JOSEPH NICOLAS', 'VARON VARGAS', 'josephvaron45@gmail.com', '$2y$10$gJ4VD75GrFgFjxUYYs3ks.r3seWkBmV00PmxnfinGKSVFXbxJECvW', 3),
(1031649012, 'JHON SEBASTIAN', 'ALVAREZ MEDINA', 'jhoncito0307@gmail.com', '$2y$10$E8Pw6u9RquUtUfE8NNOTperlNWCpFEuPi54CuwUeWXXdkxISwVLUa', 3),
(1065871763, 'JOSTIN MACK BRAYAN', 'TAFUR RINCON', 'jostintafur552@gmail.com', '$2y$10$vkEyZ94pyml9xOQrR9trVO50C5RVQNlSfmIY6ehRKgfIe00cGCZSm', 3),
(1192793869, 'LUIS MIGUEL', 'LOPEZ GARCIA', 'anluismiguel2001@gmail.com', '$2y$10$ywlhAGmncWOVGCteyWsdmeqyDAp8uuSlDH.XMZ1tiohnlMsiazhFK', 3);

-- -----------------------------------------------------
-- INSERT INTO`.`clases`
-- -----------------------------------------------------

INSERT INTO `clases` (`clase_id`, `clase_nombre`, `clase_ubicacion`) VALUES
(1, 'PROGRAMACION DE SOFTWARE', 'A-201'),
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
(1, 1, 79850926, 'EPbRHEI5P1'),
(2, 1, 546346657, '3bTD4bUZ5Y'),
(3, 1, 1000615706, 'Ney6MUGxRq'),
(4, 1, 1001111711, '5SivbKBkpG'),
(5, 1, 1002455277, '9XKtcLPFOk'),
(6, 1, 1007157772, '8jlQrOYh4S'),
(7, 1, 1012342385, 'v5388EEqkJ'),
(8, 1, 1014224283, 'MTlr4X6PKv'),
(9, 1, 1014249513, 'MpcfUPT0ds'),
(10, 1, 1015483021, 'ES61ct6IAE'),
(11, 1, 1019148936, 'cgEPsV3rvB'),
(12, 1, 1023364912, 'we3eKShKhF'),
(13, 1, 1025142230, 'tL4bY79MXg'),
(14, 1, 1031649012, 'rcnc1BwRzP'),
(15, 1, 1065871763, 'pOtDAGlsP3'),
(16, 1, 1192793869, 'G93kLGFyQq');

