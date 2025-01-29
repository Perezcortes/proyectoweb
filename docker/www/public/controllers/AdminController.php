<?php
require '../models/admin.php';

// Comprueba si el método de la solicitud es POST por medio de fetch API
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $pin = trim($_POST['pin']);

    // Instancia de la clase Admin
    $admin = new Admin();

    // Verifica las credenciales del administrador
    if ($admin->authenticate($nombre, $pin)) {
        // Devuelve la respuesta según el rol
        if ($admin->rol === 'administrador') {
            echo 'admin_login';
        } else {
            echo 'user_login';
        }
    } else {
        echo 'Nombre o PIN incorrecto.';
    }
}
?>