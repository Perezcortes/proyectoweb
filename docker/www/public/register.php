<?php
include_once 'controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    $auth = new AuthController();
    try {
        $success = $auth->register($username, $email, $password);
        // Enviar un mensaje simple en texto plano
        echo $success ? 'Registro exitoso.' : 'Error al registrar datos.';
    } catch (Exception $e) {
        // Enviar un mensaje de error simple
        echo '' . $e->getMessage();
    }
}