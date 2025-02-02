<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../config/database.php';

class Product {
    private $conn;
    private $table_name = "productos";

    public $id_producto;
    public $nombre;
    public $cantidad;
    public $descripcion;
    public $precio;
    public $imagen;
    public $categoria;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getProductsByCategory($category) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE categoria = :category";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchProducts($searchTerm) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE nombre LIKE :search OR descripcion LIKE :search";
        $stmt = $this->conn->prepare($query);
        $search = "%$searchTerm%";
        $stmt->bindParam(':search', $search);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
       
}
?>
