<?php
class User {
    private $conn;
    private $table_name = "usuarios"; // debe coincidir con tu tabla en la base de datos.

    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function emailExists($email) {
        try {
            $query = "SELECT id FROM " . $this->table_name . " WHERE correo = ? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $email);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // En producción, registra este error en lugar de mostrarlo.
            error_log("Error en emailExists: " . $e->getMessage());
            return false;
        }
    }

    public function save($username, $email, $password) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (`nombre`, `correo`, `password`) 
                      VALUES (:username, :email, :password)";
            $stmt = $this->conn->prepare($query);

            // Limpiar datos
            $this->username = htmlspecialchars(strip_tags($username));
            $this->email = htmlspecialchars(strip_tags($email));
            $this->password = password_hash($password, PASSWORD_BCRYPT);

            // Bind de parámetros
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);

            return $stmt->execute();
        } catch (PDOException $e) {
            // En producción, registra este error en lugar de mostrarlo.
            error_log("Error en save: " . $e->getMessage());
            return false;
        }
    }

    public function login() {
        try {
            $query = "SELECT id, nombre AS username, password
            FROM " . $this->table_name . " 
            WHERE correo = :email LIMIT 0,1";
            $stmt = $this->conn->prepare($query);

            $this->email = htmlspecialchars(strip_tags($this->email));
            $stmt->bindParam(":email", $this->email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($this->password, $row['password'])) {
                    $this->id = $row['id'];
                    $this->username = $row['username'];
                    return true;
                }
            }
            return false;
        } catch (PDOException $e) {
            // En producción, registra este error en lugar de mostrarlo.
            error_log("Error en login: " . $e->getMessage());
            return false;
        }
    }
}