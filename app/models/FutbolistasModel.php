<?php

class FutbolistasModel {

    private $db;

    public function __construct() {

        $this->db = new PDO(
            'mysql:host=localhost;dbname=futbol_db;charset=utf8',
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    // LISTADO
    public function getAllWithClub() {

        $query = $this->db->prepare("
            SELECT futbolista.*, club.nombre AS club
            FROM futbolista
            JOIN club ON futbolista.id_club = club.id_club
        ");

        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // DETALLE
    public function getById($id) {

        $query = $this->db->prepare("
            SELECT futbolista.*, club.nombre AS club
            FROM futbolista
            JOIN club ON futbolista.id_club = club.id_club
            WHERE futbolista.id_jugador = ?
        ");

        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    // CLUBES
    public function getClubes() {

        $query = $this->db->prepare("SELECT * FROM club");
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // INSERT
    public function insert($nombre, $posicion, $id_club) {

        $query = $this->db->prepare("
            INSERT INTO futbolista (nombre, posicion, id_club)
            VALUES (?, ?, ?)
        ");

        $query->execute([$nombre, $posicion, $id_club]);
    }

    // DELETE
    public function delete($id) {

        $query = $this->db->prepare("
            DELETE FROM futbolista WHERE id_jugador = ?
        ");

        $query->execute([$id]);
    }

    // UPDATE
    public function update($id, $nombre, $posicion, $id_club) {

        $query = $this->db->prepare("
            UPDATE futbolista
            SET nombre = ?, posicion = ?, id_club = ?
            WHERE id_jugador = ?
        ");

        $query->execute([$nombre, $posicion, $id_club, $id]);
    }
}