<?php

class RequestValidationMiddleware {
    public static function validate($requiredFields) {
        $data = Flight::request()->data->getData();
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                Flight::halt(400, json_encode(["error" => "$field is required"]));
            }
        }
    }
} 