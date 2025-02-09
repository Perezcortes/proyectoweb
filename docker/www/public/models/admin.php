<?php
require_once '../config/database.php';

class Admin
{
    private $conn;
    private $table_name = "roles";

    public $id_rol;
    public $nombre;
    public $pin;
    public $rol;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function authenticate($nombre, $pin)
    {
        error_log("Datos recibidos - Nombre: $nombre, PIN: $pin"); // Depuración

        $query = "SELECT id_rol, nombre, rol, pin FROM " . $this->table_name . " WHERE nombre = :nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            error_log("Datos obtenidos de la base de datos: " . print_r($row, true)); // Depuración

            if (password_verify($pin, $row['pin'])) {
                $this->id_rol = $row['id_rol'];
                $this->nombre = $row['nombre'];
                $this->rol = $row['rol'];
                return true;
            } else {
                error_log("PIN incorrecto: PIN recibido = $pin, PIN en BD = " . $row['pin']); // Depuración
            }
        } else {
            error_log("No se encontró ningún usuario con el nombre: $nombre"); // Depuración
        }

        return false;
    }
}
