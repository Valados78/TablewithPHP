<?php
class CProducts {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function getProducts($limit) {
        $stmt = $this->db->prepare("SELECT * FROM Products WHERE IS_HIDDEN = 0 ORDER BY DATE_CREATE DESC LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function hideProduct($productId) {
        $stmt = $this->db->prepare("UPDATE Products SET IS_HIDDEN = 1 WHERE PRODUCT_ID = ?");
        $stmt->bind_param("i", $productId);
        return $stmt->execute();
    }

    public function updateProductQuantity($productId, $newQuantity) {
        $stmt = $this->db->prepare("UPDATE Products SET PRODUCT_QUANTITY = ? WHERE PRODUCT_ID = ?");
        $stmt->bind_param("ii", $newQuantity, $productId);
        return $stmt->execute();
    }
}
?>

