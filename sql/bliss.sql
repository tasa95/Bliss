SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `bliss` DEFAULT CHARACTER SET utf8 ;
USE `bliss` ;

-- -----------------------------------------------------
-- Table `bliss`.`etats`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bliss`.`etats` (
  `id_etat` INT(11) NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `alias` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_etat`))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bliss`.`incidents`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bliss`.`incidents` (
  `id_incident` INT(11) NOT NULL AUTO_INCREMENT,
  `id_etat` INT(11) NULL DEFAULT NULL,
  `id_machine` INT(11) NULL DEFAULT NULL,
  `date_ouverture` INT(11) NULL DEFAULT NULL,
  `date_cloture` INT(11) NULL DEFAULT NULL,
  `valeur` FLOAT NULL DEFAULT NULL,
  PRIMARY KEY (`id_incident`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bliss`.`machines`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bliss`.`machines` (
  `id_machine` INT(11) NOT NULL AUTO_INCREMENT,
  `ip_machine` VARCHAR(45) NULL DEFAULT NULL,
  `nom_machine` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_machine`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bliss`.`machinesalle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bliss`.`machinesalle` (
  `id_machineSalle` INT(11) NOT NULL AUTO_INCREMENT,
  `id_machine` INT(11) NULL DEFAULT NULL,
  `id_salle` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_machineSalle`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bliss`.`salles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bliss`.`salles` (
  `id_salle` INT(11) NOT NULL AUTO_INCREMENT,
  `nom_salle` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_salle`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `bliss`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bliss`.`users` (
  `id_user` INT(11) NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL DEFAULT NULL,
  `prenom` VARCHAR(45) NULL DEFAULT NULL,
  `login` VARCHAR(45) NULL DEFAULT NULL,
  `password` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
