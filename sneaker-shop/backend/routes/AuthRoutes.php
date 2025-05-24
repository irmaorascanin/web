<?php

require_once __DIR__ . '/../services/AuthService.php';

Flight::route('POST /auth/register', function () {
    $data = Flight::request()->data->getData();
    Flight::json(AuthService::register($data));
});

Flight::route('POST /auth/login', function () {
    $data = Flight::request()->data->getData();
    Flight::json(AuthService::login($data['username'], $data['password']));
});

Flight::route('GET /auth/logout', function () {
    Flight::json(AuthService::logout());
});

Flight::route('GET /auth/me', function () {
    Flight::json(AuthService::me());
});
