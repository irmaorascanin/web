<?php

Flight::route('GET /products', function() {
    Flight::json(Flight::productService()->getAllProducts());
});

Flight::route('GET /products/@id', function($id) {
    Flight::json(Flight::productService()->getProductById($id));
});

Flight::route('POST /products', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->createProduct($data));
});

Flight::route('PUT /products/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->updateProduct($id, $data));
});

Flight::route('DELETE /products/@id', function($id) {
    Flight::json(Flight::productService()->deleteProduct($id));
});
