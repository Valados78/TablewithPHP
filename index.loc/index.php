<?php
require_once 'db.php';
require_once 'CProducts.php';

$cProducts = new CProducts($dbConnection);
$products = $cProducts->getProducts(10);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Товары</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Артикул</th>
                <th>Количество</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr id="product-<?php echo $product['PRODUCT_ID']; ?>">
                    <td><?php echo $product['ID']; ?></td>
                    <td><?php echo $product['PRODUCT_NAME']; ?></td>
                    <td><?php echo $product['PRODUCT_PRICE']; ?></td>
                    <td><?php echo $product['PRODUCT_ARTICLE']; ?></td>
                    <td>
                        <button class="decrease" data-id="<?php echo $product['PRODUCT_ID']; ?>">-</button>
                        <span id="quantity-<?php echo $product['PRODUCT_ID']; ?>"><?php echo $product['PRODUCT_QUANTITY']; ?></span>
                        <button class="increase" data-id="<?php echo $product['PRODUCT_ID']; ?>">+</button>
                    </td>
                    <td>
                        <button class="hide" data-id="<?php echo $product['PRODUCT_ID']; ?>">Скрыть</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        $(document).on('click', '.hide', function() {
            var productId = $(this).data('id');
            $.ajax({
                url: 'hide_product.php',
                method: 'POST',
                data: { product_id: productId },
                success: function() {
                    $('#product-' + productId).hide();
                }
            });
        });

        $(document).on('click', '.increase', function() {
            var productId = $(this).data('id');
            var quantityElement = $('#quantity-' + productId);
            var newQuantity = parseInt(quantityElement.text()) + 1;
            quantityElement.text(newQuantity);
            updateQuantity(productId, newQuantity);
        });

        $(document).on('click', '.decrease', function() {
            var productId = $(this).data('id');
            var quantityElement = $('#quantity-' + productId);
            var newQuantity = parseInt(quantityElement.text()) - 1;
            if (newQuantity >= 0) {
                quantityElement.text(newQuantity);
                updateQuantity(productId, newQuantity);
            }
        });

        function updateQuantity(productId, newQuantity) {
            $.ajax({
                url: 'update_q.php',
                method: 'POST',
                data: { product_id: productId, quantity: newQuantity },
                success: function(response) {
                    console.log(response);
                }
            });
        }
    </script>
</body>
</html>

