<?php
require_once __DIR__ . '/../db.php';

class OrderDAO {
    private $conn;

    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    public function getAllOrders() {
        $stmt = $this->conn->query("SELECT * FROM orders");
        return $stmt->fetchAll();
    }

    public function getOrderById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createOrder($user_id, $total_amount, $status) {
        $stmt = $this->conn->prepare("INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $total_amount, $status]);
    }

    public function updateOrder($id, $user_id, $total_amount, $status) {
        $stmt = $this->conn->prepare("UPDATE orders SET user_id = ?, total_amount = ?, status = ? WHERE id = ?");
        return $stmt->execute([$user_id, $total_amount, $status, $id]);
    }

    public function deleteOrder($id) {
        $stmt = $this->conn->prepare("DELETE FROM orders WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
