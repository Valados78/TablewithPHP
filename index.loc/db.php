<?php
$host = "localhost";
$username = "VladZ";
$password = "123";
$database = "products";

$dbConnection = new mysqli($host, $username, $password, $database);
if ($dbConnection->connect_error) {
    die("Ошибка соединения: " . $dbConnection->connect_error);
}
?>
