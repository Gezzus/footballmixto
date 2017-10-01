INSERT INTO gameType (type) VALUES ('5 vs 5 (1 field)');
INSERT INTO gameType (type) VALUES ('5 vs 5 (2 fields)');
INSERT INTO gameType (type) VALUES ('8 vs 8');
INSERT INTO gameType (type) VALUES ('9 vs 9');

INSERT INTO gender (name, defaultColor) VALUES ('female', '#FFC0CB');
INSERT INTO gender (name, defaultColor) VALUES ('male', '#ADD8E6');

INSERT INTO genderByGameType VALUES (1, 1, 6);
INSERT INTO genderByGameType VALUES (1, 2, 4);
INSERT INTO genderByGameType VALUES (2, 1, 12);
INSERT INTO genderByGameType VALUES (2, 2, 8);
INSERT INTO genderByGameType VALUES (3, 1, 10);
INSERT INTO genderByGameType VALUES (3, 2, 6);
INSERT INTO genderByGameType VALUES (4, 1, 10);
INSERT INTO genderByGameType VALUES (4, 2, 8);

INSERT INTO playerLevel (level) VALUES ('I know how to play');
INSERT INTO playerLevel (level) VALUES ('I\'m ok');
INSERT INTO playerLevel (level) VALUES ('I know what a ball is');
INSERT INTO playerLevel (level) VALUES ('I suck');

INSERT INTO role (name) VALUES ('player');
INSERT INTO role (name) VALUES ('admin');

INSERT INTO team (name, defaultColor) VALUES ('Team 1', '#E1CC4F');
INSERT INTO team (name, defaultColor) VALUES ('Team 2', '#BDECB6');
INSERT INTO team (name, defaultColor) VALUES ('Team 3', '#78858B');
INSERT INTO team (name, defaultColor) VALUES ('Team 4', '#B44C43');
