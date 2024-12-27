CREATE DATABASE worldy;

USE worldy;

CREATE TABLE `continents` (
    `id_Continent` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `nom` enum(
        'Asie',
        'Afrique',
        'Amérique',
        'Antarctique',
        'Europe',
        'Australie'
    ),
    `c_description` text DEFAULT NULL,
    `img_continent` varchar(225) NOT NULL
);

CREATE TABLE `pays` (
    `id_pays` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `nom` varchar(255) NOT NULL,
    `population` int NOT NULL,
    `langues_officielles` text DEFAULT NULL,
    `p_description` text DEFAULT NULL,
    `continent` enum(
        'Asie',
        'Afrique',
        'Amérique',
        'Antarctique',
        'Europe',
        'Australie'
    ),
    `img_pays` varchar(225) NOT NULL,
    `id_continent_fk` int(11),
    FOREIGN KEY (`id_continent_fk`) REFERENCES `continents`(`id_continent`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `villes` (
    `id_ville` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `nom` varchar(255) NOT NULL,
    `v_description` text DEFAULT NULL,
    `type` enum('capitale', 'autre'),
    `img_ville` varchar(225) NOT NULL,
    `id_pays_fk` int(11),
    FOREIGN KEY (`id_pays_fk`) REFERENCES `pays`(`id_pays`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `user` (
    `id_user` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `type` ENUM('admin', 'user') NOT NULL DEFAULT 'user'
);
