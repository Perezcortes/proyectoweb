<?php
session_start();
include_once 'controllers/AuthController.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lógica del inicio de sesión
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    $auth = new AuthController();
    try {
        if ($auth->login($email, $password)) {
            $_SESSION['user'] = $email;
            header("Location: index.php");
            exit();
        } else {
            echo "Error al iniciar sesión.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}