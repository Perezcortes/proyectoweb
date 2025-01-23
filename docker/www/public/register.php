<?php
include_once 'controllers/AuthController.php';

// No es necesario establecer el encabezado 'Content-Type: application/json' si no vas a usar JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    $auth = new AuthController();
    try {
        $success = $auth->register($username, $email, $password);
        // Enviar un mensaje simple en texto plano
        echo $success ? 'Registro exitoso.' : 'Error al registrar en la base de datos.';
    } catch (Exception $e) {
        // Enviar un mensaje de error simple
        echo 'Error: ' . $e->getMessage();
    }
}