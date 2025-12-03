<?php
// Cargar configuración
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
// Helpers
require_once __DIR__ . '/functions.php';
// Inicialización del sistema

// Configuración de reporte de errores
error_reporting(E_ALL);
ini_set('display_errors', 1); // Cambiar a 0 en producción

// Zona horaria
date_default_timezone_set(TIMEZONE);



// Autoloader de clases
spl_autoload_register(function ($className) {
    $directories = ['core', 'models', 'controllers'];
    
    foreach ($directories as $dir) {
        $file = __DIR__ . '/../' . $dir . '/' . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Iniciar sesión
Session::start();

// Token CSRF (generar si no existe)
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = Security::generateToken();
}

// TODO: Agregar middleware de seguridad global
// TODO: Implementar sistema de logging