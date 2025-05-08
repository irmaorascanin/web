<?php

class ProductService {
    private $dao;

    public function __construct($dao) {
        $this->dao = $dao;
    }

    public function getAllProducts() {
        return $this->dao->getAll();
    }

    public function getProductById($id) {
        return $this->dao->getById($id);
    }

    public function createProduct($data) {
        if (empty($data['name']) || empty($data['price']) || empty($data['category_id'])) {
            throw new Exception("Naziv, cijena i ID kategorije su obavezni.");
        }

        if (!is_numeric($data['price']) || $data['price'] <= 0) {
            throw new Exception("Cijena mora biti pozitivan broj.");
        }

        if (empty($data['image_url'])) {
            $data['image_url'] = "default.png"; // Default image if not provided
        }

        return $this->dao->create($data);
    }

    public function updateProduct($id, $data) {
        if (isset($data['price']) && (!is_numeric($data['price']) || $data['price'] <= 0)) {
            throw new Exception("Cijena mora biti pozitivan broj.");
        }

        return $this->dao->update($id, $data);
    }

    public function deleteProduct($id) {
        return $this->dao->delete($id);
    }
}
