<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/app/controllers/FutbolistasController.php';
require_once __DIR__ . '/app/controllers/AuthController.php';

$action = $_GET['action'] ?? 'login';
$params = explode('/', $action);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

switch ($params[0]) {

    case 'login':
        $controller = new AuthController();
        $controller->showLogin();
        break;

    case 'verify':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'logout':
        session_destroy();
        header('Location: ' . BASE_URL . 'login');
        exit();
        break;

    case 'futbolistas':

        if (!isset($_SESSION['USER'])) {
            header('Location: ' . BASE_URL . 'login');
            exit();
        }

        $controller = new FutbolistasController();
        $isAdmin = isset($_SESSION['ROLE']) && $_SESSION['ROLE'] === 'admin';

        if (empty($params[1])) {
            $controller->showAll();
            break;
        }

        if (is_numeric($params[1])) {
            $controller->show($params[1]);
            break;
        }

        if ($params[1] === 'add') {
            if (!$isAdmin) exit("Acceso denegado");

            $_SERVER['REQUEST_METHOD'] === 'POST'
                ? $controller->add()
                : $controller->addForm();

            break;
        }

        if ($params[1] === 'edit') {
            if (!$isAdmin) exit("Acceso denegado");

            $_SERVER['REQUEST_METHOD'] === 'POST'
                ? $controller->update($params[2])
                : $controller->editForm($params[2]);

            break;
        }

        if ($params[1] === 'delete') {
            if (!$isAdmin) exit("Acceso denegado");

            $controller->delete($params[2]);
            break;
        }

        break;

    default:
        echo "404 - Página no encontrada";
        break;
}
