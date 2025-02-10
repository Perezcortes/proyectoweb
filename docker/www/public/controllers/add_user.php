<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../models/add_user.php';

class UserController
{
    public function handleRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'POST':
                $this->addUser();
                break;
            case 'GET':
                if (isset($_GET['id'])) {
                    $this->getUserById();
                } else if (isset($_GET['roles']) && $_GET['roles'] == '1') {
                    $this->getRoles();
                } else {
                    $this->getUsers();
                }
                break;
            case 'PUT':
                $this->updateUser();
                break;
            case 'DELETE':
                $this->deleteUser();
                break;
            default:
                $this->sendJsonResponse(['result' => 'method_not_allowed']);
                break;
        }
    }

    private function addUser()
    {
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

    private function getUsers()
    {
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

    private function getRoles()
    {
        try {
            $user = new User();
            $roles = $user->getRoles();
            $this->sendJsonResponse($roles);
        } catch (Exception $e) {
            $this->sendJsonResponse([]);
            error_log('Error en el servidor: ' . $e->getMessage());
        }
    }


    private function getUserById()
    {
        $id_usuario = $_GET['id'] ?? null;

        if (!$id_usuario) {
            $this->sendJsonResponse(['result' => 'missing_id']);
            return;
        }

        try {
            $user = new User();
            $usuario = $user->getUserById($id_usuario);
            $this->sendJsonResponse($usuario);
        } catch (Exception $e) {
            error_log('Error al obtener usuario: ' . $e->getMessage());
            $this->sendJsonResponse(['result' => 'error']);
        }
    }

    private function updateUser()
    {
        // Obtener datos JSON del cuerpo de la solicitud
        $inputJSON = file_get_contents("php://input");
        $put_vars = json_decode($inputJSON, true);

        $id_usuario = trim($put_vars['id_usuario'] ?? '');
        $username = trim(htmlspecialchars($put_vars['username'] ?? ''));
        $email = trim(filter_var($put_vars['email'] ?? '', FILTER_SANITIZE_EMAIL));
        $password = trim($put_vars['password'] ?? '');
        $pin = trim($put_vars['pin'] ?? '');
        $role = trim(htmlspecialchars($put_vars['role'] ?? ''));

        if (!$id_usuario || !$username || !$email || !$role) {
            $this->sendJsonResponse(['result' => 'missing_fields']);
            return;
        }

        try {
            $user = new User();
            $result = $user->updateUser($id_usuario, $username, $email, $password, $pin, $role);
            $this->sendJsonResponse(['result' => $result]);
        } catch (Exception $e) {
            error_log('Error al actualizar usuario: ' . $e->getMessage());
            $this->sendJsonResponse(['result' => 'error']);
        }
    }

    private function deleteUser()
    {
        parse_str(file_get_contents("php://input"), $delete_vars);
        $id_usuario = trim($delete_vars['id'] ?? '');

        if (!$id_usuario) {
            $this->sendJsonResponse(['result' => 'missing_id']);
            return;
        }

        try {
            $user = new User();
            $result = $user->deleteUser($id_usuario);

            if ($result === 'success') {
                $this->sendJsonResponse(['result' => 'success']);
            } else {
                $this->sendJsonResponse(['result' => 'error', 'message' => 'Error en el servidor']);
            }
        } catch (Exception $e) {
            error_log('Error al eliminar: ' . $e->getMessage());
            $this->sendJsonResponse(['result' => 'error', 'message' => $e->getMessage()]);
        }
    }

    private function sendJsonResponse($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }
}

$controller = new UserController();
$controller->handleRequest();
