-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema slavedb_teste
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema slavedb_teste
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `slavedb_teste` DEFAULT CHARACTER SET latin1 ;
USE `slavedb_teste` ;

-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock_product_groups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock_product_groups` (
  `id_group` INT(11) NOT NULL AUTO_INCREMENT,
  `name_group` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id_group`))
ENGINE = InnoDB
AUTO_INCREMENT = 74
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock_products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock_products` (
  `id_product` INT(11) NOT NULL AUTO_INCREMENT,
  `name_product` VARCHAR(250) NOT NULL,
  `id_group` INT(11) NOT NULL,
  PRIMARY KEY (`id_product`),
  INDEX `fk_stock_products_stock_product_groups_idx` (`id_group` ASC),
  CONSTRAINT `fk_stock_products_stock_product_groups`
    FOREIGN KEY (`id_group`)
    REFERENCES `slavedb_teste`.`stock_product_groups` (`id_group`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 103
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock` (
  `id_stock` INT(11) NOT NULL AUTO_INCREMENT,
  `id_stock_product` INT(11) NOT NULL,
  `unit_price` DECIMAL(18,2) NOT NULL,
  `amount` DECIMAL(10,0) NOT NULL,
  PRIMARY KEY (`id_stock`),
  INDEX `id_stock_product_idx` (`id_stock_product` ASC),
  CONSTRAINT `id_stock_product`
    FOREIGN KEY (`id_stock_product`)
    REFERENCES `slavedb_teste`.`stock_products` (`id_product`)
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 47
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock_input`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock_input` (
  `id_stock` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `id_stock_product` BIGINT(20) NOT NULL,
  `input_amount` INT(11) NOT NULL,
  `input_date` DATE NOT NULL,
  `unit_price` DECIMAL(18,2) NOT NULL,
  `input_type` INT(11) NOT NULL,
  PRIMARY KEY (`id_stock`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock_output`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock_output` (
  `id_stock` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `id_stock_product` BIGINT(20) NOT NULL,
  `output_date` DATE NOT NULL,
  `output_amount` INT(11) NOT NULL,
  `unit_price` DECIMAL(18,2) NOT NULL,
  PRIMARY KEY (`id_stock`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock_input_products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock_input_products` (
  `id_stock` BIGINT(20) NOT NULL,
  `id_product` INT(11) NOT NULL,
  PRIMARY KEY (`id_stock`, `id_product`),
  INDEX `fk_stock_input_has_stock_products_stock_products1_idx` (`id_product` ASC),
  INDEX `fk_stock_input_has_stock_products_stock_input1_idx` (`id_stock` ASC),
  CONSTRAINT `fk_stock_input_has_stock_products_stock_input1`
    FOREIGN KEY (`id_stock`)
    REFERENCES `slavedb_teste`.`stock_input` (`id_stock`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_input_has_stock_products_stock_products1`
    FOREIGN KEY (`id_product`)
    REFERENCES `slavedb_teste`.`stock_products` (`id_product`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock_output_input`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock_output_input` (
  `id_product` INT(11) NOT NULL,
  `id_stock` BIGINT(20) NOT NULL,
  PRIMARY KEY (`id_product`, `id_stock`),
  INDEX `fk_stock_products_has_stock_output_stock_output1_idx` (`id_stock` ASC),
  INDEX `fk_stock_products_has_stock_output_stock_products1_idx` (`id_product` ASC),
  CONSTRAINT `fk_stock_products_has_stock_output_stock_products1`
    FOREIGN KEY (`id_product`)
    REFERENCES `slavedb_teste`.`stock_products` (`id_product`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_products_has_stock_output_stock_output1`
    FOREIGN KEY (`id_stock`)
    REFERENCES `slavedb_teste`.`stock_output` (`id_stock`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema slavedb_teste
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema slavedb_teste
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `slavedb_teste` DEFAULT CHARACTER SET latin1 ;
USE `slavedb_teste` ;

-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock_product_groups`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock_product_groups` (
  `id_group` INT(11) NOT NULL AUTO_INCREMENT,
  `name_group` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id_group`))
ENGINE = InnoDB
AUTO_INCREMENT = 74
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock_products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock_products` (
  `id_product` INT(11) NOT NULL AUTO_INCREMENT,
  `name_product` VARCHAR(250) NOT NULL,
  `id_group` INT(11) NOT NULL,
  PRIMARY KEY (`id_product`),
  INDEX `fk_stock_products_stock_product_groups_idx` (`id_group` ASC),
  CONSTRAINT `fk_stock_products_stock_product_groups`
    FOREIGN KEY (`id_group`)
    REFERENCES `slavedb_teste`.`stock_product_groups` (`id_group`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 103
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock` (
  `id_stock` INT(11) NOT NULL AUTO_INCREMENT,
  `id_stock_product` INT(11) NOT NULL,
  `unit_price` DECIMAL(18,2) NOT NULL,
  `amount` DECIMAL(10,0) NOT NULL,
  PRIMARY KEY (`id_stock`),
  INDEX `id_stock_product_idx` (`id_stock_product` ASC),
  CONSTRAINT `id_stock_product`
    FOREIGN KEY (`id_stock_product`)
    REFERENCES `slavedb_teste`.`stock_products` (`id_product`)
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 47
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock_input`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock_input` (
  `id_stock` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `id_stock_product` BIGINT(20) NOT NULL,
  `input_amount` INT(11) NOT NULL,
  `input_date` DATE NOT NULL,
  `unit_price` DECIMAL(18,2) NOT NULL,
  `input_type` INT(11) NOT NULL,
  PRIMARY KEY (`id_stock`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock_output`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock_output` (
  `id_stock` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `id_stock_product` BIGINT(20) NOT NULL,
  `output_date` DATE NOT NULL,
  `output_amount` INT(11) NOT NULL,
  `unit_price` DECIMAL(18,2) NOT NULL,
  PRIMARY KEY (`id_stock`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock_input_products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock_input_products` (
  `id_stock` BIGINT(20) NOT NULL,
  `id_product` INT(11) NOT NULL,
  PRIMARY KEY (`id_stock`, `id_product`),
  INDEX `fk_stock_input_has_stock_products_stock_products1_idx` (`id_product` ASC),
  INDEX `fk_stock_input_has_stock_products_stock_input1_idx` (`id_stock` ASC),
  CONSTRAINT `fk_stock_input_has_stock_products_stock_input1`
    FOREIGN KEY (`id_stock`)
    REFERENCES `slavedb_teste`.`stock_input` (`id_stock`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_input_has_stock_products_stock_products1`
    FOREIGN KEY (`id_product`)
    REFERENCES `slavedb_teste`.`stock_products` (`id_product`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `slavedb_teste`.`stock_output_input`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `slavedb_teste`.`stock_output_input` (
  `id_product` INT(11) NOT NULL,
  `id_stock` BIGINT(20) NOT NULL,
  PRIMARY KEY (`id_product`, `id_stock`),
  INDEX `fk_stock_products_has_stock_output_stock_output1_idx` (`id_stock` ASC),
  INDEX `fk_stock_products_has_stock_output_stock_products1_idx` (`id_product` ASC),
  CONSTRAINT `fk_stock_products_has_stock_output_stock_products1`
    FOREIGN KEY (`id_product`)
    REFERENCES `slavedb_teste`.`stock_products` (`id_product`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_products_has_stock_output_stock_output1`
    FOREIGN KEY (`id_stock`)
    REFERENCES `slavedb_teste`.`stock_output` (`id_stock`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
