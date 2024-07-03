-- MySQL Script generado por MySQL Workbench
-- Wed Jul  3 07:31:55 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET NAMES utf8 ;
SET FOREIGN_KEY_CHECKS = 0;
SET UNIQUE_CHECKS = 0;
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';

-- -----------------------------------------------------
-- Schema quickcheck
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `quickcheck` DEFAULT CHARACTER SET utf8 ;
USE `quickcheck` ;

-- -----------------------------------------------------
-- Table `quickcheck`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Roles` (
  `rol_code` INT NOT NULL AUTO_INCREMENT,
  `rol_name` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`rol_code`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `quickcheck`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_identificacion` INT NOT NULL,
  `usuario_nombre` VARCHAR(100) NOT NULL,
  `usuario_apellido` VARCHAR(100) NOT NULL,
  `usuario_email` VARCHAR(100) NOT NULL,
  `usuario_clave` VARCHAR(100) NOT NULL,
  `rol_code` INT NOT NULL,
  `usuario_state` TINYINT(4) NOT NULL,
  PRIMARY KEY (`usuario_identificacion`),
  INDEX `fk_usuario_Roles_idx` (`rol_code` ASC),
  CONSTRAINT `fk_usuario_Roles`
    FOREIGN KEY (`rol_code`)
    REFERENCES `Roles` (`rol_code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `quickcheck`.`asistencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `asistencia` (
  `asistencia_id` INT NOT NULL AUTO_INCREMENT,
  `usuario_identificacion` INT NOT NULL,
  `clase_id` INT NOT NULL,
  `fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`asistencia_id`),
  CONSTRAINT `fk_asistencia_usuario_clase`
    FOREIGN KEY (`usuario_identificacion`)
    REFERENCES `usuario_clase` (`usuario_identificacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `quickcheck`.`clases`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `clases` (
  `clase_id` INT NOT NULL AUTO_INCREMENT,
  `clase_nombre` VARCHAR(100) NOT NULL,
  `clase_ubicacion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`clase_id`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `quickcheck`.`usuario_clase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario_clase` (
  `userclass_id` INT NOT NULL AUTO_INCREMENT,
  `clase_id` INT NOT NULL,
  `usuario_identificacion` INT NOT NULL,
  `generated_code` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`userclass_id`),
  INDEX `fk_usuario_clase_usuario1_idx` (`usuario_identificacion` ASC),
  INDEX `fk_usuario_clase_clases1_idx` (`clase_id` ASC),
  CONSTRAINT `fk_usuario_clase_usuario1`
    FOREIGN KEY (`usuario_identificacion`)
    REFERENCES `usuario` (`usuario_identificacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_clase_clases1`
    FOREIGN KEY (`clase_id`)
    REFERENCES `clases` (`clase_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `quickcheck`.`recordatorio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `recordatorio` (
  `recordatorio_id` INT NOT NULL AUTO_INCREMENT,
  `recordatorio_texto` TEXT NOT NULL,
  `recordatorio_fecha` DATETIME NOT NULL,
  `usuario_identificacion` INT NOT NULL,
  PRIMARY KEY (`recordatorio_id`),
  INDEX `fk_recordatorio_usuario_clase1_idx` (`usuario_identificacion` ASC),
  CONSTRAINT `fk_recordatorio_usuario_clase1`
    FOREIGN KEY (`usuario_identificacion`)
    REFERENCES `usuario_clase` (`usuario_identificacion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;

SET FOREIGN_KEY_CHECKS = 1;
SET UNIQUE_CHECKS = 1;
