<?php
/**
 * Helper para generar rutas absolutas correctas
 * @param string $path Ruta relativa desde la carpeta public
 * @return string URL completa
 */
function asset($path) {
    return APP_URL . '/public/' . ltrim($path, '/');
}

/**
 * Redirigir a una ruta
 * @param string $path Ruta relativa
 */
function redirect($path) {
    header('Location: ' . APP_URL . '/public/' . ltrim($path, '/'));
    exit;
}