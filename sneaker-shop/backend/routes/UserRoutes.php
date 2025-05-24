<?php

require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../middleware/RoleMiddleware.php';
require_once __DIR__ . '/../dao/UserDAO.php';

use Middleware\AuthMiddleware;
use Middleware\RoleMiddleware;

Flight::route('GET /users', function () {
    AuthMiddleware::check();
    RoleMiddleware::requireAdmin();

    Flight::json(Flight::userService()->getAllUsers());
});

Flight::route('GET /users/@id', function ($id) {
    AuthMiddleware::check();

    Flight::json(Flight::userService()->getUserById($id));
});

Flight::route('POST /users', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->createUser($data));
});

Flight::route('PUT /users/@id', function ($id) {
    AuthMiddleware::check();

    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->updateUser($id, $data));
});

Flight::route('DELETE /users/@id', function ($id) {
    AuthMiddleware::check();
    RoleMiddleware::requireAdmin();

    Flight::json(Flight::userService()->deleteUser($id));
});

Flight::route('GET /admin/users', function () {
    RoleMiddleware::requireAdmin();

    $userDAO = new UserDAO();
    $users = $userDAO->getAll();

    Flight::json($users);
});
