DROP DATABASE futbolmixto;
CREATE DATABASE futbolmixto;

use futbolmixto;

SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE game (
    id INT NOT NULL AUTO_INCREMENT,
    `date` DATETIME NOT NULL,
    status INT NOT NULL,
    typeId INT NOT NULL,
    doodleurl VARCHAR(255) NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (`date`)
);

CREATE TABLE gameType (
    id INT NOT NULL AUTO_INCREMENT,
    type VARCHAR(191) NOT NULL,
    teamsAmount INT NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (type)
);

CREATE TABLE gender (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(191) NOT NULL,
    defaultColor VARCHAR(191) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

CREATE TABLE genderByGameType (
    gameTypeId INT NOT NULL,
    genderId INT NOT NULL,
    amount INT NOT NULL,
    UNIQUE KEY (gameTypeId, genderId),
    FOREIGN KEY (gameTypeId) REFERENCES gameType(id),
    FOREIGN KEY (genderId) REFERENCES gender(id)
);

CREATE TABLE player (
    id INT NOT NULL AUTO_INCREMENT,
    nickName VARCHAR(191) DEFAULT NULL,
    genderId INT DEFAULT NULL,
    levelId INT DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (genderId) REFERENCES gender(id),
    FOREIGN KEY (levelId) REFERENCES playerLevel(id)
);

CREATE TABLE playerLevel (
    id INT NOT NULL AUTO_INCREMENT,
    level VARCHAR(191) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (level)
);

CREATE TABLE role (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(191) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

CREATE TABLE skill (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(191) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

CREATE TABLE team (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(191) NOT NULL,
    defaultColor VARCHAR(191) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (name)
);

CREATE TABLE pickPlayer (
    gameId INT NOT NULL,
    playerId INT NOT NULL,
    teamId INT NULL,
    timeStamp DATETIME NOT NULL,
    UNIQUE KEY (gameId, playerId),
    FOREIGN KEY (gameId) REFERENCES game(id),
    FOREIGN KEY (playerId) REFERENCES player(id),
    FOREIGN KEY (teamId) REFERENCES team(id)
);

CREATE TABLE user (
    id INT NOT NULL AUTO_INCREMENT,
    userName VARCHAR(191) NOT NULL,
    password VARCHAR(191) NOT NULL,
    roleId INT NOT NULL,
    playerId INT NOT NULL,
    lastLogin DATE NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (userName),
    FOREIGN KEY (roleId) REFERENCES role(id),
    FOREIGN KEY (playerId) REFERENCES player(id)
);

SET FOREIGN_KEY_CHECKS=1;
