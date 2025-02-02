<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../models/AccionesProductos.php';

header('Content-Type: application/json');

try {
    $product = new Product();

    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        $products = $product->getProductsByCategory($category);
        echo json_encode($products);
    } elseif (isset($_GET['search'])) {
        $search = $_GET['search'];
        $products = $product->searchProducts($search);
        echo json_encode([
            'products' => $products,
            'clearSearch' => true // Indica al frontend que debe limpiar el campo de búsqueda
        ]);
    } else {
        throw new Exception("Parámetro no especificado");
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
