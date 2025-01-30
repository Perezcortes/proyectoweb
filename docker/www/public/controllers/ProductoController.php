<?php
require_once '../models/add_product.php';

$product = new Product();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'];
    $productQuantity = $_POST['productQuantity'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productCategory = $_POST['productCategory'];

    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['productImage']['tmp_name'];
        $fileName = $_FILES['productImage']['name'];
        $fileSize = $_FILES['productImage']['size'];
        $fileType = $_FILES['productImage']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'webp');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = '../img/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $productImage = 'img/' . $newFileName;

                $result = $product->addProduct($productName, $productQuantity, $productDescription, $productPrice, $productImage, $productCategory);

                if ($result === 'success') {
                    echo json_encode(['result' => 'success']);
                } else {
                    echo json_encode(['result' => 'error']);
                }
            } else {
                echo json_encode(['result' => 'error']);
            }
        } else {
            echo json_encode(['result' => 'invalid_file']);
        }
    } else {
        echo json_encode(['result' => 'no_file']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $products = $product->readProducts();
    echo json_encode($products);
} else {
    echo json_encode(['result' => 'invalid_request']);
}
?>
