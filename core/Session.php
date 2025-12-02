<?php
class Session {
    
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            ini_set('session.name', SESSION_NAME);
            ini_set('session.cookie_httponly', 1);
            ini_set('session.use_only_cookies', 1);
            ini_set('session.cookie_secure', 0); // Cambiar a 1 en producción con HTTPS
            session_start();
        }
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public static function remove($key) {
        unset($_SESSION[$key]);
    }

    public static function destroy() {
        session_destroy();
    }

    public static function has($key) {
        return isset($_SESSION[$key]);
    }

    // TODO: Implementar regeneración de ID de sesión
}