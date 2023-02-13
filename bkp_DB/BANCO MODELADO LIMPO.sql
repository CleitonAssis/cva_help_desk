-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema cva_help_desk
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cva_help_desk
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cva_help_desk` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ;
USE `cva_help_desk` ;

-- -----------------------------------------------------
-- Table `cva_help_desk`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cva_help_desk`.`categorias` (
  `categoria_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_categoria` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`categoria_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cva_help_desk`.`perfis`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cva_help_desk`.`perfis` (
  `perfil_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_perfil` VARCHAR(250) NOT NULL,
  `perfil_ativo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  `data_cad_perfil` DATETIME NOT NULL,
  `data_mod_perfil` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`perfil_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cva_help_desk`.`setores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cva_help_desk`.`setores` (
  `setor_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_setor` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`setor_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cva_help_desk`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cva_help_desk`.`usuarios` (
  `usuario_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `perfis_perfil_id` INT(10) UNSIGNED NOT NULL,
  `setores_setor_id` INT(10) UNSIGNED NOT NULL,
  `nome_usuario` VARCHAR(250) NOT NULL,
  `email_usuario` VARCHAR(250) NOT NULL,
  `senha_usuario` VARCHAR(250) NOT NULL,
  `telefone_usuario` VARCHAR(15) NULL DEFAULT NULL,
  `data_cad_usuario` DATETIME NOT NULL,
  `data_mod_usuario` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  -- INDEX `fk_usuarios_setores` (`setores_setor_id` ASC) VISIBLE,
  -- INDEX `fk_usuarios_perfis` (`perfis_perfil_id` ASC) VISIBLE,
  CONSTRAINT `fk_usuarios_perfis`
    FOREIGN KEY (`perfis_perfil_id`)
    REFERENCES `cva_help_desk`.`perfis` (`perfil_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_setores`
    FOREIGN KEY (`setores_setor_id`)
    REFERENCES `cva_help_desk`.`setores` (`setor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


-- -----------------------------------------------------
-- Table `cva_help_desk`.`chamados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cva_help_desk`.`chamados` (
  `chamado_id` INT(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `usuarios_usuario_id` INT(10) UNSIGNED NOT NULL,
  `perfis_perfil_id` INT(10) UNSIGNED NOT NULL,
  `setores_setor_id` INT(10) UNSIGNED NOT NULL,
  `categorias_categoria_id` INT(10) UNSIGNED NOT NULL,
  `endereco_chamado` VARCHAR(250) NOT NULL,
  `telefone_chamado` VARCHAR(15) NULL DEFAULT NULL,
  `descricao_chamado` TEXT NOT NULL,
  `chamado_ativo` ENUM('S', 'N') NOT NULL DEFAULT 'S',
  `status_chamado` TEXT NULL DEFAULT NULL,
  `cod_img_chamado` VARCHAR(250) NULL DEFAULT NULL,
  `data_cad_chamado` DATETIME NOT NULL,
  `data_mod_chamado` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`chamado_id`),
  -- INDEX `fk_chamados_categorias` (`categorias_categoria_id` ASC) VISIBLE,
  -- INDEX `fk_chamados_usuarios` (`usuarios_usuario_id` ASC) VISIBLE,
  -- INDEX `fk_chamados_perfis` (`perfis_perfil_id` ASC) VISIBLE,
  -- INDEX `fk_chamados_setores` (`setores_setor_id` ASC) VISIBLE,
  CONSTRAINT `fk_chamados_categorias`
    FOREIGN KEY (`categorias_categoria_id`)
    REFERENCES `cva_help_desk`.`categorias` (`categoria_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamados_usuarios`
    FOREIGN KEY (`usuarios_usuario_id`)
    REFERENCES `cva_help_desk`.`usuarios` (`usuario_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamados_perfis`
    FOREIGN KEY (`perfis_perfil_id`)
    REFERENCES `cva_help_desk`.`perfis` (`perfil_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_chamados_setores`
    FOREIGN KEY (`setores_setor_id`)
    REFERENCES `cva_help_desk`.`setores` (`setor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
