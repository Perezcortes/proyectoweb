<?php
session_start();
include_once 'controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    $auth = new AuthController();
    try {
        if ($auth->register($username, $email, $password)) {
            header("Location: login.html");
            exit();
        } else {
            echo "Error al registrar.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}