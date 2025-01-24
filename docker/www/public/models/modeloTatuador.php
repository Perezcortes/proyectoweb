<?php
require_once 'Database.php';

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
        
        $tatuadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tatuadores;
    }
}
?>