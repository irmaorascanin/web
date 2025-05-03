<?php

class UserService {
    private $dao;

    public function __construct($dao) {
        $this->dao = $dao;
    }

    public function getAllUsers() {
        return $this->dao->getAll();
    }

    public function getUserById($id) {
        return $this->dao->getById($id);
    }

    public function createUser($data) {
        if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
            throw new Exception("Sva polja su obavezna.");
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Neispravan format email adrese.");
        }

        return $this->dao->create($data);
    }

    public function updateUser($id, $data) {
        if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Neispravan format email adrese.");
        }

        return $this->dao->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->dao->delete($id);
    }
}

class CategoryService {
    private $dao;

    public function __construct($dao) {
        $this->dao = $dao;
    }

    public function getAllCategories() {
        return $this->dao->getAll();
    }

    public function getCategoryById($id) {
        return $this->dao->getById($id);
    }

    public function createCategory($data) {
        if (empty($data['name'])) {
            throw new Exception("Naziv kategorije je obavezan.");
        }

        return $this->dao->create($data);
    }

    public function updateCategory($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function deleteCategory($id) {
        return $this->dao->delete($id);
    }
}

class OrderService {
    private $dao;

    public function __construct($dao) {
        $this->dao = $dao;
    }

    public function getAllOrders() {
        return $this->dao->getAll();
    }

    public function getOrderById($id) {
        return $this->dao->getById($id);
    }

    public function createOrder($data) {
        if (empty($data['user_id']) || empty($data['order_date']) || empty($data['total_price'])) {
            throw new Exception("Sva polja su obavezna.");
        }

        if (!is_numeric($data['total_price']) || $data['total_price'] <= 0) {
            throw new Exception("Ukupna cijena mora biti pozitivan broj.");
        }

        return $this->dao->create($data);
    }

    public function updateOrder($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function deleteOrder($id) {
        return $this->dao->delete($id);
    }
}

class ReviewService {
    private $dao;

    public function __construct($dao) {
        $this->dao = $dao;
    }

    public function getAllReviews() {
        return $this->dao->getAll();
    }

    public function getReviewById($id) {
        return $this->dao->getById($id);
    }

    public function createReview($data) {
        if (empty($data['product_id']) || empty($data['user_id']) || !isset($data['rating'])) {
            throw new Exception("Polja product_id, user_id i rating su obavezna.");
        }

        if (!is_numeric($data['rating']) || $data['rating'] < 1 || $data['rating'] > 5) {
            throw new Exception("Ocjena mora biti broj izmedju 1 i 5.");
        }

        return $this->dao->create($data);
    }

    public function updateReview($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function deleteReview($id) {
        return $this->dao->delete($id);
    }
}
