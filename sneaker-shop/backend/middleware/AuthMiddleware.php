<?php

class AuthMiddleware {
    public static function check() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(["error" => "Unauthorized"]);
            exit();
        }
    }

    // Optional role-based authorization
    public static function checkRole($role) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== $role) {
            http_response_code(403);
            echo json_encode(["error" => "Forbidden"]);
            exit();
        }
    }
}
