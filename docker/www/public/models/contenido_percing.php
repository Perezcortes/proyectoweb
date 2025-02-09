<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';  // Asegura la ruta correcta

// Crear instancia de Database y obtener conexión
$database = new Database();
$conn = $database->getConnection();

if (!$conn) {
    echo json_encode(["error" => "Error de conexión a la base de datos"]);
    exit;
}

// Obtener parámetro de búsqueda (si existe)
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

// Construir consulta SQL con búsqueda opcional
$sql = "SELECT nombre, imagen, descripcion, joyeria, cicatrizacion, dolor FROM percing";
$params = [];

if (!empty($searchTerm)) {
    $sql .= " WHERE nombre LIKE :search";
    $params[':search'] = "%$searchTerm%";
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verificar si hay datos y enviar respuesta
echo empty($result) 
    ? json_encode(["message" => "No se encontraron resultados"]) 
    : json_encode($result, JSON_UNESCAPED_UNICODE);
?>