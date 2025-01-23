<?php
include_once 'controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Getting and sanitizing inputs
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($email && $password) {
        $auth = new AuthController();
        try {
            $success = $auth->login($email, $password);
            // Attempt login
            echo $success ? 'Login exitoso.' : 'Error al iniciar sesión.';
            // If credentials are correct, return "success"
        } catch (Exception $e) {
            // Give a simple error message
            error_log($e->getMessage());  // Log the error for debugging purposes
            echo 'Error al intentar iniciar sesión. Por favor, inténtelo de nuevo más tarde.';
        }
    } else {
        echo 'Por favor, complete todos los campos.';
    }
}
?>