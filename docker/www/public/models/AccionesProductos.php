<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../config/database.php';

class Product
{
    private $conn;
    private $table_name = "productos";

    public $id_producto;
    public $nombre;
    public $cantidad;
    public $descripcion;
    public $precio;
    public $imagen;
    public $categoria;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtener productos por categoría
    public function getProductsByCategory($category)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE categoria = :category";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener productos con campos específicos
    public function getProductsFields()
    {
        $query = "SELECT nombre, cantidad, precio, categoria FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener productos por categoría (nombre, cantidad, precio)
    public function getProductsByCategoryFolder($category)
    {
        $query = "SELECT nombre, cantidad, precio FROM " . $this->table_name . " WHERE categoria = :category";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar productos
    public function searchProducts($searchTerm)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE nombre LIKE :search OR descripcion LIKE :search";
        $stmt = $this->conn->prepare($query);
        $search = "%$searchTerm%";
        $stmt->bindParam(':search', $search);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Eliminar producto
    public function deleteProduct($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_producto = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Producto eliminado correctamente'];
        } else {
            return ['success' => false, 'message' => 'Error al eliminar el producto'];
        }
    }

    // Obtener un producto por ID
    public function getProductById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_producto = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product ? $product : null;
    }

    // Actualizar un producto
    public function updateProduct($id, $nombre, $cantidad, $descripcion, $precio, $categoria)
    {
        $query = "UPDATE " . $this->table_name . " SET 
                nombre = :nombre,
                cantidad = :cantidad,
                descripcion = :descripcion,
                precio = :precio,
                categoria = :categoria
              WHERE id_producto = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':categoria', $categoria);

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Producto actualizado correctamente'];
        } else {
            return ['success' => false, 'message' => 'Error al actualizar el producto'];
        }
    }
}
