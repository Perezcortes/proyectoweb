<?php
include_once './controllers/AuthController.php';

if ($_POST) {
    $auth = new AuthController();
    if ($auth->login($_POST['email'], $_POST['password'])) {
        echo "¡Login exitoso!";
    } else {
        echo "Correo electrónico o contraseña incorrectos.";
    }
}
?>