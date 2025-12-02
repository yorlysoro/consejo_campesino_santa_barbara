<?php
require_once __DIR__ . '/../includes/init.php';

$auth = new Auth();

if (!$auth->isLoggedIn()) {
    header('Location: ' . APP_URL . '/public/login.php');
    exit;
}

$pageTitle = 'Dashboard';
require_once __DIR__ . '/../views/templates/header.php';
?>

<div class="dashboard">
    <h2>Bienvenido, <?= htmlspecialchars($auth->getCurrentUser()['nombre']) ?></h2>
    <p>Has iniciado sesión exitosamente.</p>
    
    <?php if ($auth->hasPermission('usuarios.ver')): ?>
        <div class="alert alert-success">
            <strong>Nota:</strong> Tienes permisos de administrador. Puedes gestionar usuarios.
        </div>
    <?php endif; ?>
</div>

<?php
require_once __DIR__ . '/../views/templates/footer.php';