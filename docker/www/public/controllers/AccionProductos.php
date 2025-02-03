<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../models/AccionesProductos.php';

header('Content-Type: application/json');

try {
    $product = new Product();

    // Eliminar producto
    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        $response = $product->deleteProduct($id);
        echo json_encode($response);

        // Obtener productos por categoría todos los campos
    } elseif (isset($_GET['category'])) {
        $category = $_GET['category'];
        $products = $product->getProductsByCategory($category);
        echo json_encode($products);

        // Obtener productos por categoría (nombre, cantidad, precio)
    } elseif (isset($_GET['category'])) {
        $category = $_GET['category'];
        $products = $product->getProductsByCategoryFolder($category); // Usar el método getProductsByCategoryFolder
        echo json_encode($products);

        // Buscar productos
    } elseif (isset($_GET['search'])) {
        $search = $_GET['search'];
        $products = $product->searchProducts($search);
        echo json_encode([
            'products' => $products,
            'clearSearch' => true // Indica al frontend que debe limpiar el campo de búsqueda
        ]);

        // Obtener un producto por ID para editar
    } elseif (isset($_GET['id_producto'])) {
        $id_producto = $_GET['id_producto'];

        // Llamar al método que obtiene un producto por ID
        $productDetails = $product->getProductById($id_producto);

        if ($productDetails) {
            // Si el producto es encontrado, devolver los detalles
            echo json_encode($productDetails);
        }

        // Actualizar producto
    } elseif (isset($_POST['id_producto'])) {
        $id = $_POST['id_producto'];
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categoria'];
        // Llamar al método que actualiza el producto
        $response = $product->updateProduct($id, $nombre, $cantidad, $descripcion, $precio, $categoria);
        echo json_encode($response);
    } else {
        throw new Exception("Parámetro no especificado");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
