<?php

// =====================
// BASE DE DATOS
// =====================
define('DB_HOST', 'localhost');
define('DB_NAME', 'futbol_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// =====================
// BASE URL (ÚNICA DEFINICIÓN)
// =====================
define('BASE_URL',
    'http://' . $_SERVER['SERVER_NAME'] . ':' .
    $_SERVER['SERVER_PORT'] .
    dirname($_SERVER['PHP_SELF']) . '/'
);