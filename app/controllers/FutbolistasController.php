<?php

class FutbolistasController {

    private $model;

    public function __construct() {
        require_once __DIR__ . '/../models/FutbolistasModel.php';
        $this->model = new FutbolistasModel();
    }

    // LISTADO
    public function showAll() {
        $futbolistas = $this->model->getAllWithClub();
        require __DIR__ . '/../views/futbolistas.phtml';
    }

    // DETALLE
    public function show($id) {
        $f = $this->model->getById($id);
        require __DIR__ . '/../views/futbolista_detalle.phtml';
    }

    // FORM ALTA
    public function addForm() {
        $this->checkAdmin();
        $clubes = $this->model->getClubes();
        require __DIR__ . '/../views/futbolista_form.phtml';
    }

    // INSERT
    public function add() {
        $this->checkAdmin();

        $nombre = trim($_POST['nombre'] ?? '');
        $posicion = trim($_POST['posicion'] ?? '');
        $id_club = (int)($_POST['id_club'] ?? 0);

        if ($nombre === '' || $posicion === '' || $id_club <= 0) {
            exit("Datos inválidos");
        }

        $this->model->insert($nombre, $posicion, $id_club);

        header('Location: ' . BASE_URL . 'futbolistas');
        var_dump($_POST);
        exit();
    }

    // FORM EDIT
    public function editForm($id) {
        $this->checkAdmin();

        $futbolista = $this->model->getById($id);
        $clubes = $this->model->getClubes();

        require __DIR__ . '/../views/futbolista_form.phtml';
    }

    // UPDATE
    public function update($id) {
        $this->checkAdmin();

        $nombre = trim($_POST['nombre'] ?? '');
        $posicion = trim($_POST['posicion'] ?? '');
        $id_club = (int)($_POST['id_club'] ?? 0);

        if ($nombre === '' || $posicion === '' || $id_club <= 0) {
            exit("Datos inválidos");
        }

        $this->model->update($id, $nombre, $posicion, $id_club);

        header('Location: ' . BASE_URL . 'futbolistas');
        exit();
    }

    // DELETE
    public function delete($id) {
        $this->checkAdmin();

        $this->model->delete($id);

        header('Location: ' . BASE_URL . 'futbolistas');
        exit();
    }

    // SEGURIDAD
    private function checkAdmin() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['ROLE']) || $_SESSION['ROLE'] !== 'admin') {
            exit("Acceso denegado");
        }
    }
}