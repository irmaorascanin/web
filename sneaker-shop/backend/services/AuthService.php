<?php

require_once __DIR__ . '/../dao/UserDAO.php';

class AuthService {
    public static function register($data) {
        $userDAO = new UserDAO();
        $existingUser = $userDAO->getByUsername($data['username']);
        if ($existingUser) {
            return ["error" => "User already exists"];
        }
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['role'] = 'user';
        return $userDAO->insert($data);
    }

    public static function login($username, $password) {
        $userDAO = new UserDAO();
        $user = $userDAO->getByUsername($username);
        if (!$user || !password_verify($password, $user['password'])) {
            return ["error" => "Invalid credentials"];
        }
        session_start();
        $_SESSION['user'] = $user;
        return ["message" => "Login successful", "user" => $user];
    }

    public static function logout() {
        session_start();
        session_destroy();
        return ["message" => "Logged out"];
    }

    public static function me() {
        session_start();
        return $_SESSION['user'] ?? null;
    }
}
