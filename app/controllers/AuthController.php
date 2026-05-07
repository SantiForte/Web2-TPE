<?php

class AuthController {

    public function showLogin() {
        require __DIR__ . '/../views/templates/login.phtml';
    }

    public function login() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $user = trim($_POST['usuario'] ?? '');
        $pass = trim($_POST['password'] ?? '');

        if ($user === 'webadmin' && $pass === 'admin') {

            $_SESSION['USER'] = $user;
            $_SESSION['ROLE'] = 'admin';

            header('Location: ' . BASE_URL . 'futbolistas');
            exit();
        }

        if ($user !== '' && $pass !== '') {

            $_SESSION['USER'] = $user;
            $_SESSION['ROLE'] = 'user';

            header('Location: ' . BASE_URL . 'futbolistas');
            exit();
        }

        $_SESSION['error_login'] = "Usuario o contraseña incorrectos";
        header('Location: ' . BASE_URL . 'login');
        exit();
    }
}