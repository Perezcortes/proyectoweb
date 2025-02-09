<?php
require '../models/add_user.php';

class UserController {
    public function handleRequest() {
        ob_start(); // Inicia la captura de salida
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->addUser();
        } elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->getUsers();
        }
        ob_end_flush(); // Envía la salida capturada
    }

    private function addUser() {
        $username = trim(htmlspecialchars($_POST['username']));
        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $password = trim($_POST['password']);
        $pin = trim($_POST['pin']);
        $role = trim(htmlspecialchars($_POST['role']));

        try {
            $user = new User();
            $result = $user->addUser($username, $email, $password, $pin, $role);
            $this->sendJsonResponse(['result' => $result]);
        } catch (Exception $e) {
            $this->sendJsonResponse(['result' => 'error']);
            error_log('Error en el servidor: ' . $e->getMessage());
        }
    }

    private function getUsers() {
        try {
            $user = new User();
            $usuarios = $user->readUsuarios();

            error_log("Usuarios recuperados: " . print_r($usuarios, true)); // Depuración

            $this->sendJsonResponse($usuarios);
        } catch (Exception $e) {
            $this->sendJsonResponse([]);
            error_log('Error en el servidor: ' . $e->getMessage());
        }
    }

    private function sendJsonResponse($data) {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }
}

$controller = new UserController();
$controller->handleRequest();
?>