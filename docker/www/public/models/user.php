<?php
class User {
    private $conn;
    private $table_name = "usuarios";  // Asegúrate de que el nombre de la tabla sea "usuarios"

    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function emailExists($email) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE correo = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function save($username, $email, $password) {
        try {
            $query = "INSERT INTO " . $this->table_name . " (`nombre`, `correo`, `password`) VALUES (:username, :email, :password)";
            $stmt = $this->conn->prepare($query);

            // Limpiar datos
            $this->username = htmlspecialchars(strip_tags($username));
            $this->email = htmlspecialchars(strip_tags($email));
            $this->password = password_hash($password, PASSWORD_BCRYPT);

            // Bind de parámetros
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function login() {
        $query = "SELECT id, nombre AS username, password FROM " . $this->table_name . " WHERE correo = :email LIMIT 0,1";
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
    }
}