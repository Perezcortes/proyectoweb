<?php
$baseDir = dirname(__DIR__) . '/';
include_once $baseDir . 'config/database.php';
include_once $baseDir . 'models/user.php';

class AuthController
{
    private $db;
    private $user;

    public function __construct()
    {
        // Conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        if ($this->db === null) {
            die("Error al conectar a la base de datos.");
        }
        $this->user = new User($this->db);
    }

    public function register($username, $email, $password)
    {
        // Validar campos obligatorios
        if (empty($username) || empty($email) || empty($password)) {
            throw new Exception("Todos los campos son obligatorios");
        }

        // Validar formato de correo electrónico
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El correo electrónico no es válido");
        }

        // Verificar si el correo ya existe
        if ($this->user->emailExists($email)) {
            throw new Exception("Este correo ya está registrado");
        }

        // Guardar usuario en la base de datos
        return $this->user->save($username, $email, $password);
    }
    public function login($email, $password)
    {
        $this->user->email = $email;
        $this->user->password = $password;
        return $this->user->login();
    }
}