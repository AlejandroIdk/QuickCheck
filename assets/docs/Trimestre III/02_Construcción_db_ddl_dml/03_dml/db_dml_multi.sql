-- -----------------------------------------------------
-- CONSULTA`.`usuario`.`usuario_clase`
-- -----------------------------------------------------
SELECT 
usuario.usuario_identificacion, 
usuario.usuario_nombre, 
clases.clase_nombre
FROM usuario
INNER JOIN usuario_clase 
ON usuario.usuario_identificacion = usuario_clase.usuario_identificacion
INNER JOIN clases ON usuario_clase.clase_id = clases.clase_id
WHERE clases.clase_nombre = 'PROGRAMACION DE SOFTWARE';