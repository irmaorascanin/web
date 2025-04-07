<?php
require_once __DIR__ . '/../db.php';

class ProductDAO {
    private $conn;

    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    public function getAllProducts() {
        $stmt = $this->conn->query("SELECT * FROM products");
        return $stmt->fetchAll();
    }

    public function getProductById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createProduct($name, $description, $price, $image, $category_id) {
        $stmt = $this->conn->prepare("INSERT INTO products (name, description, price, image, category_id) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $description, $price, $image, $category_id]);
    }

    public function updateProduct($id, $name, $description, $price, $image, $category_id) {
        $stmt = $this->conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, image = ?, category_id = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $price, $image, $category_id, $id]);
    }

    public function deleteProduct($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
