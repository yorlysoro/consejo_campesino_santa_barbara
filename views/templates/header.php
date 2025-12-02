<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - <?= $pageTitle ?? 'Sistema' ?></title>
    <link rel="stylesheet" href="<?= APP_URL ?>/public/css/style.css">
</head>
<body>
    <div class="container">
        <header class="main-header">
            <h1><?= APP_NAME ?></h1>
            <?php if ((new Auth())->isLoggedIn()): ?>
                <nav class="main-nav">
                    <a href="<?= APP_URL ?>/public/index.php">Inicio</a>
                    <a href="<?= APP_URL ?>/public/logout.php">Cerrar Sesión</a>
                </nav>
            <?php endif; ?>
        </header>
        <main>