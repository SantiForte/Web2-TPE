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
);

CREATE TABLE contrato (
    id_contrato INT AUTO_INCREMENT PRIMARY KEY,
    id_jugador INT NOT NULL,
    id_club INT NOT NULL,
    fecha_inicio DATE,
    fecha_fin DATE,
    numero_camiseta INT,
    FOREIGN KEY (id_jugador) REFERENCES futbolista(id_jugador),
    FOREIGN KEY (id_club) REFERENCES club(id_club)
);

CREATE TABLE transferencia (
    id_transferencia INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE,
    monto DECIMAL(15,2),
    tipo VARCHAR(50),
    id_jugador INT NOT NULL,
    id_club_origen INT,
    id_club_destino INT,
    FOREIGN KEY (id_jugador) REFERENCES futbolista(id_jugador),
    FOREIGN KEY (id_club_origen) REFERENCES club(id_club),
    FOREIGN KEY (id_club_destino) REFERENCES club(id_club)
);