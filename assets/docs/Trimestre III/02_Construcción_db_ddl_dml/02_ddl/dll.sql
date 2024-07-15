-- -----------------------------------------------------
-- Schema pdo
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS `pdo` DEFAULT CHARACTER SET utf8 ;
USE `pdo` ;

-- -----------------------------------------------------
-- Table `pdo`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Roles` (
  `rol_code` INT NOT NULL AUTO_INCREMENT,
  `rol_name` VARCHAR(10) NOT NULL
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `pdo`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_identificacion` INT NOT NULL,
  `usuario_nombre` VARCHAR(100) NOT NULL,
  `usuario_apellido` VARCHAR(100) NOT NULL,
  `usuario_email` VARCHAR(100) NOT NULL,
  `usuario_clave` VARCHAR(100) NOT NULL,
  `rol_code` INT NOT NULL,
  `usuario_state` TINYINT(4) NOT NULL
) ENGINE = InnoDB;



-- -----------------------------------------------------
-- PRIMARY KEY`.`roles`
-- -----------------------------------------------------
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`rol_code`);

-- -----------------------------------------------------
-- AUTO_INCREMENT`.`roles`
-- -----------------------------------------------------
ALTER TABLE `Roles`
  MODIFY `rol_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

-- -----------------------------------------------------
-- PRIMARY KEY`.`usuario`
-- -----------------------------------------------------
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_identificacion`),
  ADD KEY `fk_usuario_Roles_idx` (`rol_code`);

-- -----------------------------------------------------
-- AUTO_INCREMENT`.`usuario`
-- -----------------------------------------------------
ALTER TABLE `usuario`
  MODIFY `usuario_identificacion` int(11) NOT NULL AUTO_INCREMENT;



-- -----------------------------------------------------
-- FOREIGN KEY`.`usuario`.`roles`
-- -----------------------------------------------------
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_Roles` FOREIGN KEY (`rol_code`) REFERENCES `Roles` (`rol_code`) ON DELETE NO ACTION ON UPDATE NO ACTION;
