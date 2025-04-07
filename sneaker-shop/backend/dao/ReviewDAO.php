<?php
require_once __DIR__ . '/../db.php';

class ReviewDAO {
    private $conn;

    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    public function getAllReviews() {
        $stmt = $this->conn->query("SELECT * FROM reviews");
        return $stmt->fetchAll();
    }

    public function getReviewById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createReview($user_id, $product_id, $rating, $comment) {
        $stmt = $this->conn->prepare("INSERT INTO reviews (user_id, product_id, rating, comment) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$user_id, $product_id, $rating, $comment]);
    }

    public function updateReview($id, $user_id, $product_id, $rating, $comment) {
        $stmt = $this->conn->prepare("UPDATE reviews SET user_id = ?, product_id = ?, rating = ?, comment = ? WHERE id = ?");
        return $stmt->execute([$user_id, $product_id, $rating, $comment, $id]);
    }

    public function deleteReview($id) {
        $stmt = $this->conn->prepare("DELETE FROM reviews WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
