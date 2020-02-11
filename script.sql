CREATE DATABASE IF NOT EXISTS TRABAJO;
--Creamos la base de datos y las dos tablas Disk y Users
CREATE TABLE `trabajo`.`disk` (
     `ID`     INT             NOT NULL AUTO_INCREMENT ,
     `NAME`   VARCHAR(30)     NOT NULL ,
     `GENRE`  VARCHAR(30)     NOT NULL ,
     `AUTHOR` VARCHAR(30)     NOT NULL ,
     `SONGS`  VARCHAR(100)    NOT NULL ,
     `PRIZE`  FLOAT           NOT NULL ,
     `STOCK`  INT             NOT NULL , 
     `IMAGE`  VARCHAR(21)     NOT NULL , 
          PRIMARY KEY (`ID`)) ENGINE = InnoDB;
CREATE TABLE `trabajo`.`users` (
     `DNI`      VARCHAR(9)      NOT NULL , 
     `NAME`     VARCHAR(30)     NOT NULL , 
     `SURNAME`  VARCHAR(50)     NOT NULL , 
     `USERNAME` VARCHAR(30)     NOT NULL , 
     `EMAIL`    VARCHAR(50)     NOT NULL , 
     `PASSWORD` VARCHAR(40)     NOT NULL , 
        PRIMARY KEY (`DNI`)) ENGINE = InnoDB;
--Error en la tabla disk->Disks*
RENAME TABLE `trabajo`.`disk` TO `trabajo`.`disks`;

INSERT INTO `users` (`DNI`, `NAME`, `SURNAME`, `USERNAME`, `EMAIL`, `PASSWORD`) VALUES ('30696569X', 'Fernando', 'Mateos Gomez', 'Moffinguer', 'fermago11@gmail.com', 'admin1234');
INSERT INTO `users` (`DNI`, `NAME`, `SURNAME`, `USERNAME`, `EMAIL`, `PASSWORD`) VALUES
('07807198D', 'Fernando', 'Mateos', 'Fermago11', 'fer@gmail.com', 'pikachufriki14'),
('30696569X', 'Fernando', 'Mateos Gomez', 'Moffinguer', 'fermago11@gmail.com', 'admin1234'),
('53374687J', 'ADADSSA', 'ADASDAAS', 'potito', 'nuria@gmail.com', 'asadadadsa'),
('77826124N', 'Cunt', 'SexyPistolero', 'ChingaTumadre', 'fer@gmail.com', 'lolete');

INSERT INTO `disks` (`ID`, `NAME`, `GENRE`, `AUTHOR`, `SONGS`, `PRIZE`, `STOCK`, `IMAGE`) VALUES
(1, 'INCENSE AND IRON', 'POWER METAL', 'POWERWOLF', 'NO SE QUE PONER', 2000, 5, '../CSS/IMG/err.jpg'),
(2, 'YO', 'MIJO', 'NANAI', 'UWU', 49, 50, '../CSS/IMG/purple.jpg'),
(3, 'Sum41', 'HELL', 'WOLOLO', 'UWU OWO EWE', 30.69, 12, '../CSS/IMG/blue.jpg'),
(4, 'DISCOSTOPEGUAPOS', 'GENEROGENERICO', 'WOLOLO', 'UWU OWO EWE', 30.69, 12, '../CSS/IMG/blue.jpg'),
(5, 'PRUEBA1', 'FOLK', 'NO SE QUE METER', 'LOREM IPSUM A MOGOLLóN', 40.69, 134, '../CSS/IMG/blue.jpg');