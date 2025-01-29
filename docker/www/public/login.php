<?php
include_once 'controllers/AuthController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Getting and sanitizing inputs
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    error_log("Email recibido: $email"); // Depuración
    error_log("Password recibido: $password"); // Depuración

    if ($email && $password) {
        $auth = new AuthController();
        try {
            $success = $auth->login($email, $password);
            if ($success) {
                if (strpos($email, '@dejaVu.com') !== false) {
                    echo 'admin_login'; // Cualquier email con @dejaVu.com es admin, pero existe una segunda autenticacion con pin de seguridad
                } else {
                    echo 'user_login'; // Indicador para redirección normal con correos diferentes
                }
            } else {
                echo 'Error al iniciar sesión.';
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo 'Error al intentar iniciar sesión. Por favor, inténtelo de nuevo más tarde.';
        }
    } else {
        echo 'Por favor, complete todos los campos.';
    }
}
?>