<?php
require_once 'TatuadorModel.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $searchTerm = htmlspecialchars(strip_tags($_GET['search']));
    $model = new TatuadorModel();

    $tatuadores = $model->searchTatuadores($searchTerm);

    header('Content-Type: application/json');
    echo json_encode($tatuadores);
}
?>