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
  `firstname` VARCHAR(100) NULL ,
  `lastname` VARCHAR(45) NULL ,
  `owner_id` INT NULL ,
  `date_edited` INT NULL ,
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
  `permission` VARCHAR(45) NULL ,
  `start_date` INT NULL DEFAULT 0 ,
  `end_date` INT NULL DEFAULT 0 ,
  `importance` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wubbles`.`shared_memory`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wubbles`.`shared_memory` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `memory_id` INT NULL ,
  `date_created` INT NULL ,
  `account_id` INT NULL ,
  `permission` VARCHAR(45) NULL ,
  `date_edited` INT NULL ,
  `owner_id` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wubbles`.`friends`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wubbles`.`friends` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `sender_id` INT NULL ,
  `reciever_id` INT NULL ,
  `date_sent` INT NULL ,
  `status` VARCHAR(45) NULL ,
  `date_edited` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wubbles`.`pictures`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wubbles`.`pictures` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `date_created` INT NULL ,
  `date_edited` INT NULL ,
  `owner_id` INT NULL ,
  `title` VARCHAR(45) NULL ,
  `caption` MEDIUMTEXT NULL ,
  `path` VARCHAR(100) NULL ,
  `memory_id` INT NULL ,
  `primary` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wubbles`.`comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wubbles`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `class` VARCHAR(100) NULL ,
  `reference_id` VARCHAR(100) NULL ,
  `comment` LONGTEXT NULL ,
  `owner_id` INT NULL ,
  `date_created` INT NULL ,
  `date_edited` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `wubbles`.`notifications`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `wubbles`.`notifications` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `reference_class` VARCHAR(100) NULL ,
  `reference_id` INT NULL ,
  `to_id` INT NULL ,
  `date_created` INT NULL ,
  `read` INT(1) NULL DEFAULT 0 ,
  `save_type` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
