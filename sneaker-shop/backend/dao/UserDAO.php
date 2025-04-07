<?php
require_once __DIR__ . '/../db.php';

class UserDAO {
    private $conn;

    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    public function getAllUsers() {
        $stmt = $this->conn->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createUser($name, $email, $password, $address, $phone) {
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, address, phone) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $password, $address, $phone]);
    }

    public function updateUser($id, $name, $email, $address, $phone) {
        $stmt = $this->conn->prepare("UPDATE users SET name = ?, email = ?, address = ?, phone = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $address, $phone, $id]);
    }

    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
