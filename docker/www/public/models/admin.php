<?php
require_once '../config/database.php';

class Admin {
    private $conn;
    private $table_name = "roles";

    public $id_rol;
    public $nombre;
    public $pin;
    public $rol;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function authenticate($nombre, $pin) {
        $query = "SELECT id_rol, nombre, rol FROM " . $this->table_name . " WHERE nombre = :nombre AND pin = :pin";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':pin', $pin);

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id_rol = $row['id_rol'];
            $this->nombre = $row['nombre'];
            $this->rol = $row['rol'];
            
            return true;
        }

        return false;
    }
}
?>
