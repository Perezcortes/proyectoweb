<?php require '../models/add_user.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim(htmlspecialchars($_POST['username']));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = trim($_POST['password']);
    $pin = trim($_POST['pin']);
    $role = trim(htmlspecialchars($_POST['role']));
    try {
        $user = new User();
        $result = $user->addUser($username, $email, $password, $pin, $role);
        echo $result;
    } catch (Exception $e) {
        echo 'error';
        error_log('Error en el servidor: ' . $e->getMessage());
    }
}
