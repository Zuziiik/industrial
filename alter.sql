SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `industrial` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `industrial` ;

-- -----------------------------------------------------
-- Table `industrial`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `industrial`.`user` ;

CREATE TABLE IF NOT EXISTS `industrial`.`user` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(64) NOT NULL,
  `salt` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `create_time` DATETIME NOT NULL,
  `admin` TINYINT(1) NOT NULL DEFAULT 0,
  `confirmed` TINYINT(1) NOT NULL DEFAULT 0,
  `icon` BLOB NULL,
  `last_login` DATETIME NOT NULL,
  `about` TEXT NULL,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  PRIMARY KEY (`id_user`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `id_user_UNIQUE` (`id_user` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `industrial`.`category` ;

CREATE TABLE IF NOT EXISTS `industrial`.`category` (
  `category_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE INDEX `category_id_UNIQUE` (`category_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `industrial`.`item` ;

CREATE TABLE IF NOT EXISTS `industrial`.`item` (
  `id_item` INT NOT NULL AUTO_INCREMENT,
  `category_id` INT NOT NULL,
  `name` VARCHAR(16) NOT NULL,
  `details` TEXT NULL,
  `icon` BLOB NULL,
  PRIMARY KEY (`id_item`),
  INDEX `fk_item_category_idx` (`category_id` ASC),
  UNIQUE INDEX `item_id_UNIQUE` (`id_item` ASC),
  CONSTRAINT `fk_item_category`
    FOREIGN KEY (`category_id`)
    REFERENCES `industrial`.`category` (`category_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`editable_area`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `industrial`.`editable_area` ;

CREATE TABLE IF NOT EXISTS `industrial`.`editable_area` (
  `id_editable_area` INT NOT NULL AUTO_INCREMENT,
  `target_id` INT NULL,
  `editable_area_type` INT NOT NULL,
  `date_of_edit` DATETIME NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `message` TEXT NULL,
  `weight` INT NOT NULL,
  PRIMARY KEY (`id_editable_area`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`edited`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `industrial`.`edited` ;

CREATE TABLE IF NOT EXISTS `industrial`.`edited` (
  `id_edited` INT NOT NULL AUTO_INCREMENT,
  `id_editable_area` INT NOT NULL,
  `user_id_user` INT NOT NULL,
  `editing` TINYINT(1) NOT NULL,
  `time_of_start` DATETIME NOT NULL,
  INDEX `fk_edited_editable_area1_idx` (`id_editable_area` ASC),
  INDEX `fk_edited_user1_idx` (`user_id_user` ASC),
  PRIMARY KEY (`id_edited`),
  UNIQUE INDEX `id_edited_UNIQUE` (`id_edited` ASC),
  CONSTRAINT `fk_edited_editable_area1`
    FOREIGN KEY (`id_editable_area`)
    REFERENCES `industrial`.`editable_area` (`id_editable_area`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_edited_user1`
    FOREIGN KEY (`user_id_user`)
    REFERENCES `industrial`.`user` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`comment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `industrial`.`comment` ;

CREATE TABLE IF NOT EXISTS `industrial`.`comment` (
  `id_comment` INT NOT NULL AUTO_INCREMENT,
  `user_id_user` INT NOT NULL,
  `target_id` INT NOT NULL,
  `comment_type` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `message` TEXT NOT NULL,
  PRIMARY KEY (`id_comment`),
  INDEX `fk_comment_user1_idx` (`user_id_user` ASC),
  CONSTRAINT `fk_comment_user1`
    FOREIGN KEY (`user_id_user`)
    REFERENCES `industrial`.`user` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`recipe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `industrial`.`recipe` ;

CREATE TABLE IF NOT EXISTS `industrial`.`recipe` (
  `id_recipe` INT NOT NULL AUTO_INCREMENT,
  `item_id` INT NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `output` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_recipe`),
  INDEX `fk_recipe_item_id` (`item_id` ASC),
  UNIQUE INDEX `id_recipe_UNIQUE` (`id_recipe` ASC),
  CONSTRAINT `fk_recipe_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `industrial`.`item` (`id_item`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`timestamps`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `industrial`.`timestamps` ;

CREATE TABLE IF NOT EXISTS `industrial`.`timestamps` (
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` TIMESTAMP NULL);


-- -----------------------------------------------------
-- Table `industrial`.`recipe_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `industrial`.`recipe_item` ;

CREATE TABLE IF NOT EXISTS `industrial`.`recipe_item` (
  `item_item_id` INT NOT NULL,
  `recipe_id_recipe` INT NOT NULL,
  `table_pos` INT NULL,
  INDEX `fk_recipe_item_item1_idx` (`item_item_id` ASC),
  INDEX `fk_recipe_item_recipe1_idx` (`recipe_id_recipe` ASC),
  CONSTRAINT `fk_recipe_item_item`
    FOREIGN KEY (`item_item_id`)
    REFERENCES `industrial`.`item` (`id_item`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recipe_item_recipe`
    FOREIGN KEY (`recipe_id_recipe`)
    REFERENCES `industrial`.`recipe` (`id_recipe`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `industrial`.`ban`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `industrial`.`ban` ;

CREATE TABLE IF NOT EXISTS `industrial`.`ban` (
  `id_ban` INT NOT NULL AUTO_INCREMENT,
  `user_id_user` INT NOT NULL,
  `ban_start` DATETIME NOT NULL,
  `ban_end` DATETIME NOT NULL,
  PRIMARY KEY (`id_ban`),
  UNIQUE INDEX `id_ban_UNIQUE` (`id_ban` ASC),
  INDEX `fk_ban_user1_idx` (`user_id_user` ASC),
  CONSTRAINT `fk_ban_user1`
    FOREIGN KEY (`user_id_user`)
    REFERENCES `industrial`.`user` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
