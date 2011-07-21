SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `wubbles` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `wubbles` ;

-- -----------------------------------------------------
-- Table `wubbles`.`accounts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wubbles`.`accounts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(100) NULL ,
  `date_created` INT NULL ,
  `username` VARCHAR(45) NULL ,
  `password` VARCHAR(100) NULL ,
  `activated` INT NULL ,
  `role` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wubbles`.`memories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wubbles`.`memories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `date_created` INT NULL ,
  `date_edited` INT NULL ,
  `owner_id` INT NULL ,
  `subject` VARCHAR(100) NULL ,
  `details` LONGTEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wubbles`.`shared_memory`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wubbles`.`shared_memory` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `wubble_id` INT NULL ,
  `date_created` INT NULL ,
  `account_id` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
