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
     `IMAGE`  VARCHAR(10)     NOT NULL , 
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