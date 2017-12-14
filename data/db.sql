SET foreign_key_checks = 0;

DROP TABLE IF EXISTS restUser;
CREATE TABLE restUser (
  id BIGINT(20) NOT NULL AUTO_INCREMENT,
  apiKey VARCHAR(255) NOT NULL,
  secretKey VARCHAR(255) NOT NULL,
  name VARCHAR(255),
  description TEXT,
  creationDate DATETIME NOT NULL,
  modificationDate DATETIME,
  active TINYINT DEFAULT 0,
  PRIMARY KEY (id))
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_bin;

DROP TABLE IF EXISTS user;
CREATE TABLE user(
  id BIGINT(20) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  lastName VARCHAR(255) NOT NULL,
  userType TINYINT NOT NULL DEFAULT 1,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  state TINYINT NOT NULL DEFAULT 1,
  creationDate DATETIME NOT NULL,
  modificationDate DATETIME,
  PRIMARY KEY  (id))
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_bin;

DROP TABLE IF EXISTS school;
CREATE TABLE school(
  id BIGINT(20) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL,
  cif VARCHAR(255) NOT NULL,
  web VARCHAR(255),
  state TINYINT NOT NULL DEFAULT 1,
  registrationDate DATETIME NOT NULL,
  PRIMARY KEY (id))
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_bin;

DROP TABLE IF EXISTS student;
CREATE TABLE student(
  id BIGINT(20) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  firstName VARCHAR(255) NOT NULL,
  secondName VARCHAR(255) NOT NULL,
  birthDate DATETIME NOT NULL,
  address VARCHAR(255) NOT NULL,
  allergies VARCHAR(255),
  specialFood VARCHAR(255),
  medication1 VARCHAR(255),
  medication2 VARCHAR(255),
  medication3 VARCHAR(255),
  medication4 VARCHAR(255),
  comments VARCHAR(255),
  state TINYINT NOT NULL DEFAULT 1,
  registrationDate DATETIME NOT NULL,
  PRIMARY KEY (id))
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_bin;

DROP TABLE IF EXISTS userStudentSchool;
CREATE TABLE userStudentSchool(
  idUser BIGINT(20) NOT NULL,
  idStudent BIGINT(20) NOT NULL,
  idSchool BIGINT(20) NOT NULL,
  state TINYINT NOT NULL DEFAULT 1,
  registrationDate DATETIME NOT NULL)
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_bin;

DROP TABLE IF EXISTS report;
CREATE TABLE report(
  id BIGINT(20) NOT NULL AUTO_INCREMENT,
  idUser BIGINT(20) NOT NULL,
  idStudent BIGINT(20) NOT NULL,
  parentId BIGINT(20),
  comments1 VARCHAR(255),
  comments2 VARCHAR(255),
  breakfast VARCHAR(255),
  lunch VARCHAR(255),
  afternoonMeal VARCHAR(255),
  bottle1 VARCHAR(255),
  bottle2 VARCHAR(255),
  bottle3 VARCHAR(255),
  bottle4 VARCHAR(255),
  mood TINYINT,
  napMorning VARCHAR(255),
  napAfternoon VARCHAR(255),
  depositionsMorning VARCHAR(255),
  depositionsAfternoon VARCHAR(255),
  depositionsComments VARCHAR(255),
  activityMusic VARCHAR(255),
  activityEnglish VARCHAR(255),
  activitySheets VARCHAR(255),
  activityWorkshop VARCHAR(255),
  activitySwimming VARCHAR(255),
  activityGames1 VARCHAR(255),
  activityGames2 VARCHAR(255),
  activityPsychomotor VARCHAR(255),
  activityMassage VARCHAR(255),
  activityLibrary VARCHAR(255),
  activityTreasureBucket VARCHAR(255),
  hasBibs TINYINT,
  hasDiapers TINYINT,
  hasTowels TINYINT,
  needsBibs TINYINT,
  needsDiapers TINYINT,
  needTowels TINYINT,
  medication1 VARCHAR(255),
  medicationDose1  VARCHAR(255),
  medicationFrecuency1 VARCHAR(255),
  medicationDuration1 VARCHAR(255),
  medication2 VARCHAR(255),
  medicationDose2  VARCHAR(255),
  medicationFrecuency2 VARCHAR(255),
  medicationDuration2 VARCHAR(255),
  medication3 VARCHAR(255),
  medicationDose3  VARCHAR(255),
  medicationFrecuency3 VARCHAR(255),
  MedicationDuration3 VARCHAR(255),
  state TINYINT NOT NULL DEFAULT 1,
  registrationDate DATETIME NOT NULL,
  PRIMARY KEY (id))
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_bin;

INSERT INTO user VALUES (1, 'xx', 'xx', 1,'xxxxe@gmail.com','pass01', 1, '2012-07-02', NULL);
INSERT INTO user VALUES (2, 'xx', 'xx', 1,'jxxxx@gmail.com','pass01', 1, '2012-07-02', NULL);
INSERT INTO user VALUES (3, 'xx', 'xx', 1,'xxxx@gmail.com','pass01', 1, '2012-07-02', NULL);
INSERT INTO user VALUES (4, 'xx', 'xx', 1,'xxxxx@gmail.com','pass01', 1, '2012-07-02', NULL);
INSERT INTO user VALUES (5, 'xx', 'xx', 1,'xxxxx@gmail.com','pass01', 1, '2012-07-02', NULL);



INSERT INTO school VALUES (1,'EscuelaEjemplo1','Direccion1','A58818501','www.pequeñilandia.com', 1,'2012-07-02');
INSERT INTO student VALUES (1,'AlumnoEjemplo1','Apellido1', 'Apellido2', '2011-07-02', 'C/ Del Concejal Francisco José Jimenez Martín, 12 2ºC', 'Paracetamol', 'Alimentación sin gluten', 'Apiretal', 'Junifén', 'Dalsy', NULL, 'Apiretal dosis:8h', 1,'2012-07-03');
INSERT INTO userStudentSchool VALUES (2,1,1,1,'2012-07-03');
INSERT INTO report VALUES (1, 1, 1, NULL, 'Sin Observaciones1', 'Sin Observaciones2', 'desayuno', 'comida', 'merienda', 'biberon1', 'biberon2', 'biberon4', NULL, 1, 'sin complicación, 2 horitas de buen sueño', 'ha roncado un poquito, ¿tendrá vegetaciones?', 'La caca de la mañana estaba un poquito blanda', 'La caca de la tarde ha sido normal', 'Sin observaciones', 'Le encanta el sonido de los platillos', 'Ya sabe decir hello', 'Ha cumplimentado una ficha él solito', 'La plastilina le encanta, tiene dotes artísticas.', 'Esta hecho todo un pez, no se ha quejado de nada', 'Le encantan los juegos de relacionarse con otros niños', NULL, 'En la clase de psicomotricidad, ha aprendido a hacer su primero voltereta', 'Le he dado un masaje en las piernas, parecía que estaba cansado después de la clase de gimnasia.', 'Hoy a leido un libro de animalitos', NULL, 1, 1, 0, 0, 0, 1, 'EL apiretal se lo ha tomado sin quejarse', '1 cucharadita', 'cada 8 horas', 'Durante 3 días', 'El Junifén se lo ha tomado sin quejarse', '1 cucharadita', 'cada 8 horas', 'Durante 3 días', 'EL Dalsy lo ha vomitado', '1 cucharadita', 'cada 8 horas', 'Durante 3 días', 1, '2012-07-04' );


INSERT INTO restUser VALUES (1, 'prueba1', 'secretKey', 'root','root user', '2012-07-02', '2012-07-02', 1);
