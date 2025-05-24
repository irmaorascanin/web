<?php

use Middleware\AuthMiddleware;
use Middleware\RoleMiddleware;

Flight::route('GET /reviews', function() {
    Flight::json(Flight::reviewService()->getAllReviews());
});

Flight::route('GET /reviews/@id', function($id) {
    Flight::json(Flight::reviewService()->getReviewById($id));
});

Flight::route('POST /reviews', [AuthMiddleware::class, 'check'], function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reviewService()->createReview($data));
});

Flight::route('PUT /reviews/@id', [AuthMiddleware::class, 'check'], [RoleMiddleware::class, 'requireAdmin'], function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reviewService()->updateReview($id, $data));
});

Flight::route('DELETE /reviews/@id', [AuthMiddleware::class, 'check'], [RoleMiddleware::class, 'requireAdmin'], function($id) {
    Flight::json(Flight::reviewService()->deleteReview($id));
});
