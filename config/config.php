<?php
// Configuración general del sistema
define('APP_NAME', 'Consejo Campesino Santa Bárbara');
define('APP_URL', 'http://localhost/consejo-campesino');
define('TIMEZONE', 'America/El_Salvador');
define('PASSWORD_MIN_LENGTH', 8);
define('SESSION_NAME', 'consejo_session');

// Roles predefinidos (IDs fijos para referencia segura)
define('ROLE_ADMIN', 1);
define('ROLE_USUARIO', 2);

// TODO: Futuras mejoras
// - Agregar configuración de email para recuperación de contraseña
// - Configurar sistema de logs
// - Agregar variables de entorno