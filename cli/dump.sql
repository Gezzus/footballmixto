CREATE DATABASE futbolmixto;

use futbolmixto;

SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE gender (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    defaultColor VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

CREATE TABLE genderByGameType (
    genderId INT NOT NULL,
    gameTypeId INT NOT NULL,
    amount INT NOT NULL,
    UNIQUE KEY (genderId, gameTypeId),
    FOREIGN KEY (genderId) REFERENCES gender(id),
    FOREIGN KEY (gameTypeId) REFERENCES gameType(id)
);

CREATE TABLE game (
    id INT NOT NULL AUTO_INCREMENT,
    `date` DATETIME NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (`date`)
);

CREATE TABLE gameType (
    id INT NOT NULL AUTO_INCREMENT,
    type VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (type)
);

CREATE TABLE player (
    id INT NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    nickName VARCHAR(255) DEFAULT NULL,
    levelId INT DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (nickName),
    FOREIGN KEY (levelId) REFERENCES playerLevel(id)
);

CREATE TABLE playerLevel (
    id INT NOT NULL AUTO_INCREMENT,
    level VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (level)
);

CREATE TABLE role (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

CREATE TABLE skill (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT,
    userName VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    roleId INT NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (userName),
    FOREIGN KEY (roleId) REFERENCES role(id)
);

SET FOREIGN_KEY_CHECKS=1;
