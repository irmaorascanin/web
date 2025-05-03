<?php

Flight::route('GET /orders', function() {
    Flight::json(Flight::orderService()->getAllOrders());
});

Flight::route('GET /orders/@id', function($id) {
    Flight::json(Flight::orderService()->getOrderById($id));
});

Flight::route('POST /orders', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->createOrder($data));
});

Flight::route('PUT /orders/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::orderService()->updateOrder($id, $data));
});

Flight::route('DELETE /orders/@id', function($id) {
    Flight::json(Flight::orderService()->deleteOrder($id));
});
