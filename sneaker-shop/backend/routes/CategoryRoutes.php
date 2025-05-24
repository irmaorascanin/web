<?php

use Middleware\AuthMiddleware;
use Middleware\RoleMiddleware;

Flight::route('GET /categories', function() {
    Flight::json(Flight::categoryService()->getAllCategories());
});

Flight::route('GET /categories/@id', function($id) {
    Flight::json(Flight::categoryService()->getCategoryById($id));
});

Flight::route('POST /categories', [AuthMiddleware::class, 'check'], [RoleMiddleware::class, 'requireAdmin'], function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::categoryService()->createCategory($data));
});

Flight::route('PUT /categories/@id', [AuthMiddleware::class, 'check'], [RoleMiddleware::class, 'requireAdmin'], function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::categoryService()->updateCategory($id, $data));
});

Flight::route('DELETE /categories/@id', [AuthMiddleware::class, 'check'], [RoleMiddleware::class, 'requireAdmin'], function($id) {
    Flight::json(Flight::categoryService()->deleteCategory($id));
});
