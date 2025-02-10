<?php
require_once '../models/modeloTatuador.php';

$model = new TatuadorModel();

// Obtener el parámetro de búsqueda
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : "";

// Buscar tatuadores en la base de datos
if (!empty($searchTerm)) {
    $tatuadores = $model->searchTatuadores($searchTerm);
} else {
    $tatuadores = $model->getAllTatuadores();
}

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($tatuadores);
?>
