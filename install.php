<?php
/**
 * Script de instalación inicial
 * EJECUTAR UNA SOLA VEZ
 */

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php';

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET,
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear base de datos
    $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    $pdo->exec("USE " . DB_NAME);

    // Tabla roles
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS roles (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(50) NOT NULL UNIQUE,
            descripcion TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Tabla permisos
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS permisos (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(100) NOT NULL UNIQUE,
            descripcion TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Tabla rol_permisos
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS rol_permisos (
            rol_id INT,
            permiso_id INT,
            PRIMARY KEY (rol_id, permiso_id),
            FOREIGN KEY (rol_id) REFERENCES roles(id) ON DELETE CASCADE,
            FOREIGN KEY (permiso_id) REFERENCES permisos(id) ON DELETE CASCADE
        )
    ");

    // Tabla usuarios
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INT PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            rol_id INT DEFAULT 2,
            activo TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (rol_id) REFERENCES roles(id)
        )
    ");

    // Insertar roles base
    $pdo->exec("INSERT IGNORE INTO roles (id, nombre, descripcion) VALUES 
        (1, 'Administrador', 'Acceso total al sistema'),
        (2, 'Usuario', 'Acceso básico al sistema')
    ");

    // Insertar permisos base
    $pdo->exec("INSERT IGNORE INTO permisos (nombre, descripcion) VALUES 
        ('dashboard.ver', 'Ver dashboard'),
        ('usuarios.crear', 'Crear usuarios'),
        ('usuarios.editar', 'Editar usuarios'),
        ('usuarios.eliminar', 'Eliminar usuarios'),
        ('usuarios.ver', 'Ver lista de usuarios')
    ");

    // Asignar todos los permisos al admin
    $pdo->exec("INSERT IGNORE INTO rol_permisos (rol_id, permiso_id) 
        SELECT 1, id FROM permisos
    ");

    // Asignar permiso básico al usuario normal
    $pdo->exec("INSERT IGNORE INTO rol_permisos (rol_id, permiso_id) VALUES 
        (2, 1)
    ");

    // Crear usuario admin (contraseña: Admin123!)
    $adminPassword = password_hash('Admin123#', PASSWORD_DEFAULT);
    $pdo->exec("
        INSERT IGNORE INTO usuarios (nombre, email, password, rol_id) VALUES 
        ('Administrador del Sistema', 'admin@consejo.com', '$adminPassword', 1)
    ");

    echo "<h1>✅ Instalación completada exitosamente</h1>";
    echo "<p>Usuario admin: <strong>admin@consejo.com</strong></p>";
    echo "<p>Contraseña: <strong>Admin123#</strong></p>";
    echo "<p><strong>IMPORTANTE:</strong> Elimina el archivo install.php</p>";
    echo "<p><a href='public/login.php'>Ir al login</a></p>";

} catch (PDOException $e) {
    die("Error en instalación: " . $e->getMessage());
}