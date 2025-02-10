<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../config/database.php';

class User
{
    private $conn;
    private $table_roles = "roles";
    private $table_users = "usuarios";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addUser($username, $email, $password, $pin, $role)
    {
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

    public function getUserById($id_usuario)
    {
        $query = "SELECT u.id_usuario, u.nombre, u.correo, u.id_rol, 
                         COALESCE(r.rol, 'user') AS rol
                  FROM " . $this->table_users . " u
                  LEFT JOIN " . $this->table_roles . " r
                  ON u.id_rol = r.id_rol
                  WHERE u.id_usuario = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRoles() {
        $query = "SELECT nombre, rol FROM " . $this->table_roles;
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function readUsuarios()
    {
        $query = "SELECT u.id_usuario, u.nombre, u.correo, u.fecha_creacion, 
                         COALESCE(r.rol, 'user') AS rol
                  FROM " . $this->table_users . " u
                  LEFT JOIN " . $this->table_roles . " r
                  ON u.id_rol = r.id_rol";

        error_log("Consulta SQL: " . $query); // Depuración

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        error_log("Resultado de la consulta: " . print_r($usuarios, true)); // Depuración

        return $usuarios;
    }

    public function updateUser($id_usuario, $username, $email, $password, $pin, $role) {
        try {
            // Iniciar una transacción
            $this->conn->beginTransaction();
            
            // Actualizar nombre, correo e id_rol
            $query = "UPDATE " . $this->table_users . " 
                      SET nombre = :nombre, correo = :correo, id_rol = :id_rol 
                      WHERE id_usuario = :id_usuario";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre', $username);
            $stmt->bindParam(':correo', $email);
            $stmt->bindParam(':id_rol', $role, PDO::PARAM_INT);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
    
            // Actualizar contraseña si se proporciona
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $query = "UPDATE " . $this->table_users . " 
                          SET password = :password 
                          WHERE id_usuario = :id_usuario";
                
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
            }
    
            // Actualizar pin si se proporciona
            if (!empty($pin)) {
                $hashed_pin = password_hash($pin, PASSWORD_BCRYPT);
                $query = "UPDATE " . $this->table_users . " 
                          SET pin = :pin 
                          WHERE id_usuario = :id_usuario";
                
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':pin', $hashed_pin);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();
            }
    
            // Confirmar la transacción
            $this->conn->commit();
            return 'success';
        } catch (PDOException $e) {
            // Revertir la transacción en caso de error
            $this->conn->rollBack();
            error_log("Error al actualizar usuario: " . $e->getMessage());
            return 'error';
        }
    }
    

    public function deleteUser($id_usuario) {
        try {
            $this->conn->beginTransaction();
    
            // Paso 1: Obtener el id_rol ANTES de eliminar
            $query = "SELECT id_rol FROM usuarios WHERE id_usuario = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
            $id_rol = $stmt->fetchColumn();
    
            // Paso 2: Eliminar al usuario (esto activará ON DELETE CASCADE si hay dependencias)
            $query = "DELETE FROM usuarios WHERE id_usuario = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
    
            // Paso 3: Eliminar el rol MANUALMENTE si no hay usuarios
            if ($id_rol !== false && $id_rol !== null) {
                $query = "DELETE FROM roles WHERE id_rol = :id_rol";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
                $stmt->execute();
            }
    
            $this->conn->commit();
            return 'success';
    
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error en deleteUser: " . $e->getMessage());
            return 'error';
        }
    }

    public function isUniqueEmail($email)
    {
        $query = "SELECT id_usuario FROM " . $this->table_users . " WHERE correo = :correo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':correo', $email);
        $stmt->execute();
        return $stmt->rowCount() === 0;
    }

    public function isUniqueUsername($username)
    {
        $query = "SELECT id_usuario FROM " . $this->table_users . " WHERE nombre = :nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $username);
        $stmt->execute();
        return $stmt->rowCount() === 0;
    }
}
