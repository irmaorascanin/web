<?php

use Middleware\AuthMiddleware;
use Middleware\RoleMiddleware;

Flight::route('GET /orders', [AuthMiddleware::class, 'check'], function() {
    Flight::json(Flight::orderService()->getAllOrders());
});

Flight::route('GET /orders/@id', [AuthMiddleware::class, 'check'], function($id) {
    Flight::json(Flight::orderService()->getOrderById($id));
});

Flight::route('POST /orders', [AuthMiddleware::class, 'check'], function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->createOrder($data));
});

Flight::route('PUT /orders/@id', [AuthMiddleware::class, 'check'], function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->updateOrder($id, $data));
});

Flight::route('DELETE /orders/@id', [AuthMiddleware::class, 'check'], [RoleMiddleware::class, 'requireAdmin'], function($id) {
    Flight::json(Flight::orderService()->deleteOrder($id));
});
