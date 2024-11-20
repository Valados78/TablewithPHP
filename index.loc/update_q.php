<?php
require_once 'db.php';
require_once 'CProducts.php';

$cProducts = new CProducts($dbConnection);

if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $cProducts->updateProductQuantity($_POST['product_id'], $_POST['quantity']);
}
?>
