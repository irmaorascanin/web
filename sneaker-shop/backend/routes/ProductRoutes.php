<?php

require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../middleware/RoleMiddleware.php';

// SVI korisnici mogu gledati proizvode
Flight::route('GET /products', function() {
    Flight::json(Flight::productService()->getAllProducts());
});

Flight::route('GET /products/@id', function($id) {
    Flight::json(Flight::productService()->getProductById($id));
});

// SAMO ADMINI mogu dodavati proizvode
Flight::route('POST /products', function() {
    AuthMiddleware::check(); // mora biti prijavljen
    RoleMiddleware::requireAdmin(); // mora biti admin

    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->createProduct($data));
});

// SAMO ADMINI mogu ažurirati proizvode
Flight::route('PUT /products/@id', function($id) {
    AuthMiddleware::check();
    RoleMiddleware::requireAdmin();

    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->updateProduct($id, $data));
});

// SAMO ADMINI mogu brisati proizvode
Flight::route('DELETE /products/@id', function($id) {
    AuthMiddleware::check();
    RoleMiddleware::requireAdmin();

    Flight::json(Flight::productService()->deleteProduct($id));
});
