SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-----------------------------------------------------
-- Création de la base de données
CREATE DATABASE IF NOT EXISTS vinyle_catalogue;
USE vinyle_catalogue;

-----------------------------------------------------
-- Table `artist`
CREATE TABLE IF NOT EXISTS `artist` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL COMMENT 'Nom de l\'artiste',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-----------------------------------------------------
-- Table `album`
CREATE TABLE IF NOT EXISTS `album` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(100) NOT NULL COMMENT 'Titre de l\'album',
  `release_date` DATE NOT NULL COMMENT 'Date de sortie',
  `cover` VARCHAR(255) NULL COMMENT 'URL de la pochette',
  `price` DECIMAL(10, 2) NOT NULL COMMENT 'Prix du vinyle',
  `artist_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-----------------------------------------------------
-- Table `category`
CREATE TABLE IF NOT EXISTS `category` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL COMMENT 'Nom de la catégorie',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-----------------------------------------------------
-- Table `album_category`
CREATE TABLE IF NOT EXISTS `album_category` (
  `album_id` INT UNSIGNED NOT NULL,
  `category_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`album_id`, `category_id`),
  FOREIGN KEY (`album_id`) REFERENCES `album` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;


-----------------------------------------------------
-- Insertion des données

START TRANSACTION;

-- Artistes
INSERT INTO `artist` (`id`, `name`) VALUES
(1, 'Drake'),
(2, 'Rick Ross'),
(3, 'Burna Boy');

-- Albums
INSERT INTO `album` (`id`, `title`, `release_date`, `cover`, `price`, `artist_id`) VALUES
(1, 'Certified Lover Boy', '2021-09-03', '/assets/image/albums/certified_lover_boy.jpg', 25.99, 1),
(2, 'Her Loss', '2022-11-04', '/assets/image/albums/her_loss.jpg', 27.99, 1),
(3, 'Port of Miami 2', '2019-08-09', '/assets/image/albums/port_of_miami_2.jpeg', 23.50, 2),
(4, 'Rather You Than Me', '2017-03-17', '/assets/image/albums/rather_you_than_me.png', 21.50, 2),
(5, 'African Giant', '2019-07-26', '/assets/image/albums/african_giant.png', 22.99, 3),
(6, 'Love, Damini', '2022-07-08', '/assets/image/albums/love_damini.jpeg', 24.99, 3);

-- Catégories
INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Rap'),
(2, 'Afrobeats'),
(3, 'Hip-Hop');

-- Association album-catégorie
INSERT INTO `album_category` (`album_id`, `category_id`) VALUES
(1, 3),
(2, 3),
(3, 1),
(4, 1),
(5, 2),
(6, 2);

COMMIT;

-- Réinitialisation des options
SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

SELECT * FROM users;

-- Résultats de la requête
1	kwam	k@gmail.COM	$2y$10$p13myfcOl02m8qVKMJqc8uiVLIDtJKtkh3.JxOsC6wx2CicQncAF2
3	kwam	kokoto@gmail.com	$2y$10$9oW7W9fVPsxLgFj4n59Xp.nRIgRtv3qx4oomBwjfG8dLTBiRJaL4W