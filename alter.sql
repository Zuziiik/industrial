SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `industrial` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `industrial` ;

-- -----------------------------------------------------
-- Table `industrial`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `industrial`.`user` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `salt` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` TINYINT(1) NOT NULL DEFAULT 0,
  `confirmed` TINYINT(1) NOT NULL DEFAULT 0,
  `icon` BLOB NULL,
  `last_login` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `about` TEXT NULL,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  PRIMARY KEY (`id_user`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `id_user_UNIQUE` (`id_user` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `industrial`.`category` (
  `category_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE INDEX `category_id_UNIQUE` (`category_id` ASC))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `industrial`.`item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `industrial`.`item` (
  `id_item` INT NOT NULL AUTO_INCREMENT,
  `category_id` INT NOT NULL,
  `name` VARCHAR(16) NOT NULL,
  `icon` BLOB NULL,
  `details` TEXT NULL,
  PRIMARY KEY (`id_item`),
  INDEX `fk_item_category_idx` (`category_id` ASC),
  UNIQUE INDEX `item_id_UNIQUE` (`id_item` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`editable_area_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `industrial`.`editable_area_type` (
  `id_editable_area_type` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_editable_area_type`),
  UNIQUE INDEX `id_type_UNIQUE` (`id_editable_area_type` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`editable_area`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `industrial`.`editable_area` (
  `id_editable_area` INT NOT NULL AUTO_INCREMENT,
  `date` TIMESTAMP NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `locked` TINYINT(1) NOT NULL DEFAULT 1,
  `text` TEXT NULL,
  `item_id` INT NULL,
  `archived_item_id1` INT NULL,
  `editable_area_type_id_editable_area_type` INT NOT NULL,
  PRIMARY KEY (`id_editable_area`),
  INDEX `fk_editable_area_item1_idx` (`item_id` ASC),
  INDEX `fk_editable_area_item2_idx` (`archived_item_id1` ASC),
  INDEX `fk_editable_area_editable_area_type1_idx` (`editable_area_type_id_editable_area_type` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`edited`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `industrial`.`edited` (
  `allowed` TINYINT(1) NOT NULL DEFAULT 0,
  `editing` TINYINT(1) NOT NULL,
  `time_of_start` TIMESTAMP NULL,
  `id_editable_area` INT NOT NULL,
  `user_id_user` INT NOT NULL,
  INDEX `fk_edited_editable_area1_idx` (`id_editable_area` ASC),
  INDEX `fk_edited_user1_idx` (`user_id_user` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `industrial`.`comment` (
  `text` TEXT NOT NULL,
  `id_comment` INT NOT NULL AUTO_INCREMENT,
  `id_editable_area` INT NOT NULL,
  `user_id_user` INT NOT NULL,
  PRIMARY KEY (`id_comment`),
  INDEX `fk_comment_editable_area1_idx` (`id_editable_area` ASC),
  INDEX `fk_comment_user1_idx` (`user_id_user` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`recipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `industrial`.`recipe` (
  `id_recipe` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(45) NOT NULL,
  `output` VARCHAR(45) NOT NULL,
  `item_id` INT NULL,
  `archived_item_id` INT NULL,
  PRIMARY KEY (`id_recipe`),
  INDEX `fk_recipe_item_id` (`item_id` ASC),
  UNIQUE INDEX `id_recipe_UNIQUE` (`id_recipe` ASC),
  INDEX `fk_archived_item_id` (`archived_item_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`timestamps`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `industrial`.`timestamps` (
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` TIMESTAMP NULL);


-- -----------------------------------------------------
-- Table `industrial`.`recipe_item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `industrial`.`recipe_item` (
  `table_pos` INT NULL,
  `item_item_id` INT NOT NULL,
  `recipe_id_recipe` INT NOT NULL,
  INDEX `fk_recipe_item_item1_idx` (`item_item_id` ASC),
  INDEX `fk_recipe_item_recipe1_idx` (`recipe_id_recipe` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`ban`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `industrial`.`ban` (
  `id_ban` INT NOT NULL AUTO_INCREMENT,
  `from` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `to` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id_user` INT NOT NULL,
  PRIMARY KEY (`id_ban`),
  UNIQUE INDEX `id_ban_UNIQUE` (`id_ban` ASC),
  INDEX `fk_ban_user1_idx` (`user_id_user` ASC))
ENGINE = MyISAM;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
