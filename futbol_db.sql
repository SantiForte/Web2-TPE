CREATE DATABASE futbol_db;
USE futbol_db;

CREATE TABLE club (
    id_club INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    pais VARCHAR(50),
    ciudad VARCHAR(50),
    fecha_fundacion DATE
);

CREATE TABLE futbolista (
    id_jugador INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    fecha_nacimiento DATE,
    nacionalidad VARCHAR(50),
    posicion VARCHAR(50)
    id_club INT,
    FOREIGN KEY (id_club) REFERENCES club(id_club)
);
