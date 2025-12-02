<?php
class Security {
    
    public static function sanitizeInput($data) {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    public static function generateToken() {
        return bin2hex(random_bytes(32));
    }

    public static function verifyCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    // TODO: Implementar rate limiting para prevención de fuerza bruta
    // TODO: Agregar validación de contraseña segura
}