<?php
require_once 'db.php';
require_once 'CProducts.php';

$cProducts = new CProducts($dbConnection);

if (isset($_POST['product_id'])) {
    $cProducts->hideProduct($_POST['product_id']);
}
?>
