<?php
require_once '../config/database.php';

class TatuadorModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function searchTatuadores($searchTerm) {
        $stmt = $this->conn->prepare("SELECT * FROM tatuadores WHERE nombre LIKE :searchTerm");
        $searchTerm = "%" . $searchTerm . "%";
        $stmt->bindParam(":searchTerm", $searchTerm);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mueve esta función dentro de la clase
    public function getAllTatuadores() {
        $stmt = $this->conn->prepare("SELECT * FROM tatuadores");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} // Aquí cierra correctamente la clase

?>
