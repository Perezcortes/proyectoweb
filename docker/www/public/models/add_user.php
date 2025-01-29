<?php
require_once '../config/database.php';

class User {
    private $conn;
    private $table_roles = "roles";
    private $table_users = "usuarios";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addUser($username, $email, $password, $pin, $role) {
        if (!$this->isUniqueEmail($email)) {
            return 'duplicate_email';
        }

        if (!$this->isUniqueUsername($username)) {
            return 'duplicate_username';
        }

        if (strlen($password) < 8) {
            return 'short_password';
        }

        if (strlen($pin) < 4 || strlen($pin) > 8) {
            return 'invalid_pin';
        }

        try {
            $this->conn->beginTransaction();

            // Hashear PIN
            $hashed_pin = password_hash($pin, PASSWORD_BCRYPT);

            // Insertar en la tabla roles
            $query_roles = "INSERT INTO " . $this->table_roles . " (nombre, pin, rol, fecha_creacion) VALUES (:nombre, :pin, :rol, NOW())";
            $stmt_roles = $this->conn->prepare($query_roles);
            $stmt_roles->bindParam(':nombre', $username);
            $stmt_roles->bindParam(':pin', $hashed_pin);
            $stmt_roles->bindParam(':rol', $role);
            $stmt_roles->execute();
            $id_rol = $this->conn->lastInsertId();

            // Hashear contraseña
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Insertar en la tabla usuarios
            $query_users = "INSERT INTO " . $this->table_users . " (nombre, correo, password, fecha_creacion, id_rol) VALUES (:nombre, :correo, :password, NOW(), :id_rol)";
            $stmt_users = $this->conn->prepare($query_users);
            $stmt_users->bindParam(':nombre', $username);
            $stmt_users->bindParam(':correo', $email);
            $stmt_users->bindParam(':password', $hashed_password);
            $stmt_users->bindParam(':id_rol', $id_rol);
            $stmt_users->execute();

            $this->conn->commit();
            return 'success';
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error al agregar usuario: " . $e->getMessage());
            return 'error';
        }
    }

    private function isUniqueEmail($email) {
        $query = "SELECT COUNT(*) FROM " . $this->table_users . " WHERE correo = :correo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':correo', $email);
        $stmt->execute();
        return $stmt->fetchColumn() == 0;
    }

    private function isUniqueUsername($username) {
        $query = "SELECT COUNT(*) FROM " . $this->table_users . " WHERE nombre = :nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $username);
        $stmt->execute();
        return $stmt->fetchColumn() == 0;
    }
}
?>
