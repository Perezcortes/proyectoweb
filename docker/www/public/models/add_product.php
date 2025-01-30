<?php
require_once '../config/database.php';

class Product {
    private $conn;
    private $table_products = "productos";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addProduct($productName, $productQuantity, $productDescription, $productPrice, $productImage) {
        try {
            $query = "INSERT INTO " . $this->table_products . " (nombre, cantidad, descripcion, precio, imagen) VALUES (:nombre, :cantidad, :descripcion, :precio, :imagen)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':nombre', $productName);
            $stmt->bindParam(':cantidad', $productQuantity);
            $stmt->bindParam(':descripcion', $productDescription);
            $stmt->bindParam(':precio', $productPrice);
            $stmt->bindParam(':imagen', $productImage);

            if ($stmt->execute()) {
                return 'success';
            } else {
                return 'error';
            }
        } catch (PDOException $e) {
            error_log("Error al agregar producto: " . $e->getMessage());
            return 'error';
        }
    }

    public function readProducts() {
        $query = "SELECT * FROM " . $this->table_products;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
}
?>