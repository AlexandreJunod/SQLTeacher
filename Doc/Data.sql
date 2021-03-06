INSERT INTO `SQLTeacher`.`classes` (`name`) VALUES ('SI-C1a');
INSERT INTO `SQLTeacher`.`classes` (`name`) VALUES ('SI-C1b');

INSERT INTO `SQLTeacher`.`roles` (`name`) VALUES ('Elève');
INSERT INTO `SQLTeacher`.`roles` (`name`) VALUES ('Enseignant');


INSERT INTO `SQLTeacher`.`people`(`firstName`, `lastName`, `email`, `acronym`, `classe_id`, `role_id`) VALUES ('Xavier', 'CARREL', 'Xavier.CARREL@cpnv.ch', 'XCL', '1', '2');
INSERT INTO `SQLTeacher`.`people`(`firstName`, `lastName`, `email`, `acronym`, `classe_id`, `role_id`) VALUES ('Marwan', 'ALHELO', 'Marwan.ALHELO@cpnv.ch', 'MAO', '1', '1');
INSERT INTO `SQLTeacher`.`people`(`firstName`, `lastName`, `email`, `acronym`, `classe_id`, `role_id`) VALUES ('Ian', 'BOEHLER', 'Ian.BOEHLER@cpnv.ch', 'IBR', '1', '1');
INSERT INTO `SQLTeacher`.`people`(`firstName`, `lastName`, `email`, `acronym`, `classe_id`, `role_id`) VALUES ('Simon', 'CUANY', 'Simon.CUANY@cpnv.ch', 'SCY', '1', '1');
INSERT INTO `SQLTeacher`.`people`(`firstName`, `lastName`, `email`, `acronym`, `classe_id`, `role_id`) VALUES ('Mounir-Yann', 'FIAUX', 'Mounir-Yann.FIAUX@cpnv.ch', 'MFX', '1', '1');
INSERT INTO `SQLTeacher`.`people`(`firstName`, `lastName`, `email`, `acronym`, `classe_id`, `role_id`) VALUES ('Gatien', 'JAYME', 'Gatien.JAYME@cpnv.ch', 'GJE', '1', '1');
INSERT INTO `SQLTeacher`.`people`(`firstName`, `lastName`, `email`, `acronym`, `classe_id`, `role_id`) VALUES ('Fabien', 'MASSON', 'Fabien.MASSON@cpnv.ch', 'FMN', '1', '1');
INSERT INTO `SQLTeacher`.`people`(`firstName`, `lastName`, `email`, `acronym`, `classe_id`, `role_id`) VALUES ('Pedro', 'PINTO', 'Pedro.PINTO@cpnv.ch', 'PPO', '1', '1');
INSERT INTO `SQLTeacher`.`people`(`firstName`, `lastName`, `email`, `acronym`, `classe_id`, `role_id`) VALUES ('David', 'ROULET', 'David.ROULET@cpnv.ch', 'DRL', '1', '1');
INSERT INTO `SQLTeacher`.`people`(`firstName`, `lastName`, `email`, `acronym`, `classe_id`, `role_id`) VALUES ('Miguel', 'SOARES', 'Miguel.SOARES@cpnv.ch', 'MSS', '1', '1');
INSERT INTO `SQLTeacher`.`people`(`firstName`, `lastName`, `email`, `acronym`, `classe_id`, `role_id`) VALUES ('Johnny', 'VAVA-JARAMILLO', 'Johnny.VACA-JARAMILLO@cpnv.ch', 'JVO', '1', '1');

INSERT INTO `SQLTeacher`.`exercises` (`db_script`, `title`) VALUES ("CREATE TABLE tutorials_tbl(id INT NOT NULL AUTO_INCREMENT,title VARCHAR(100) NOT NULL,author VARCHAR(40) NOT NULL,PRIMARY KEY ( id ));
INSERT INTO `sqlteacher`.`tutorials_tbl` (`title`, `author`) VALUES('Examen', 'Enseignant');
INSERT INTO `sqlteacher`.`tutorials_tbl` (`title`, `author`) VALUES('Test', 'Elève');", 'Table test');

INSERT INTO `SQLTeacher`.`participants` (`classe_id`, `exercise_id`) VALUES ('1', '1');

INSERT INTO `SQLTeacher`.`queries` (`statement`, `formulation`, `order`, `exercise_id`) VALUES ('SELECT * FROM tutorials_tbl', 'Select all the tables', '1', '1');
INSERT INTO `SQLTeacher`.`queries` (`statement`, `formulation`, `order`, `exercise_id`) VALUES ('SELECT id FROM tutorials_tbl', 'Select the tutorial id', '2', '1');
INSERT INTO `SQLTeacher`.`queries` (`statement`, `formulation`, `order`, `exercise_id`) VALUES ('SELECT title FROM tutorials_tbl', 'Select the tutorial title', '3', '1');
INSERT INTO `SQLTeacher`.`queries` (`statement`, `formulation`, `order`, `exercise_id`) VALUES ('SELECT author FROM tutorials_tbl', 'Select the tutorial author', '4', '1');

INSERT INTO `SQLTeacher`.`scores` (`attempts`, `success`, `people_id`, `querie_id`) VALUES ('13', '1', '1', '1');
INSERT INTO `SQLTeacher`.`scores` (`attempts`, `success`, `people_id`, `querie_id`) VALUES ('4', '1', '1', '2');
INSERT INTO `SQLTeacher`.`scores` (`attempts`, `success`, `people_id`, `querie_id`) VALUES ('27', '0', '1', '3');
INSERT INTO `SQLTeacher`.`scores` (`attempts`, `success`, `people_id`, `querie_id`) VALUES ('1', '1', '2', '1');
INSERT INTO `SQLTeacher`.`scores` (`attempts`, `success`, `people_id`, `querie_id`) VALUES ('2', '0', '3', '1');
INSERT INTO `SQLTeacher`.`scores` (`attempts`, `success`, `people_id`, `querie_id`) VALUES ('3', '1', '2', '2');
INSERT INTO `SQLTeacher`.`scores` (`attempts`, `success`, `people_id`, `querie_id`) VALUES ('2', '1', '2', '3');
INSERT INTO `SQLTeacher`.`scores` (`attempts`, `success`, `people_id`, `querie_id`) VALUES ('3', '1', '4', '1');
INSERT INTO `SQLTeacher`.`scores` (`attempts`, `success`, `people_id`, `querie_id`) VALUES ('5', '0', '4', '2');