<?php

Flight::route('GET /users', function() {
    Flight::json(Flight::userService()->getAllUsers());
});

Flight::route('GET /users/@id', function($id) {
    Flight::json(Flight::userService()->getUserById($id));
});

Flight::route('POST /users', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->createUser($data));
});

Flight::route('PUT /users/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->updateUser($id, $data));
});

Flight::route('DELETE /users/@id', function($id) {
    Flight::json(Flight::userService()->deleteUser($id));
});
