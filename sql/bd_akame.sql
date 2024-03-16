-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema bd_akame
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bd_akame
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bd_akame` DEFAULT CHARACTER SET utf32 ;
USE `bd_akame` ;

-- -----------------------------------------------------
-- Table `bd_akame`.`tb_carrinho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_akame`.`tb_carrinho` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_user` INT(11) NULL DEFAULT NULL,
  `id_produto` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf32;


-- -----------------------------------------------------
-- Table `bd_akame`.`tb_categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_akame`.`tb_categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nm_categoria` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf32;


-- -----------------------------------------------------
-- Table `bd_akame`.`tb_products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_akame`.`tb_products` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nm_produto` VARCHAR(45) NULL DEFAULT NULL,
  `id_categoria` INT(11) NULL DEFAULT NULL,
  `vl_produto` VARCHAR(45) NULL DEFAULT NULL,
  `ds_produto` VARCHAR(45) NULL DEFAULT NULL,
  `img_1` VARCHAR(100) NULL DEFAULT NULL,
  `img_2` VARCHAR(100) NULL DEFAULT NULL,
  `nr_estoque` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bd_akame`.`tb_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_akame`.`tb_users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nm_user` VARCHAR(45) NULL DEFAULT NULL,
  `ds_login` VARCHAR(45) NULL DEFAULT NULL,
  `ds_tel` INT(11) NULL DEFAULT NULL,
  `ds_senha` VARCHAR(45) NULL DEFAULT NULL,
  `ds_adress` VARCHAR(200) NULL DEFAULT NULL,
  `nivel` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf32;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
