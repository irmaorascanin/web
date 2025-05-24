<?php

class RoleMiddleware {
    public static function requireAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(["error" => "Forbidden - Admins only"]);
            exit();
        }
    }
}
