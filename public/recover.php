<?php
require_once __DIR__ . '/../includes/init.php';

$message = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AuthController();
    $result = $controller->handlePasswordRecovery($_POST);
    
    $message = [
        'type' => $result['success'] ? 'success' : 'danger',
        'text' => $result['message']
    ];
}

$pageTitle = 'Recuperar Contraseña';
require_once __DIR__ . '/../views/templates/header.php';
?>

<div class="form-container">
    <h2>Recuperar Contraseña</h2>
    
    <?php if ($message): ?>
        <div class="alert alert-<?= $message['type'] ?>">
            <?= htmlspecialchars($message['text']) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Enviar Instrucciones</button>
        <p style="margin-top: 1rem;">
            <a href="login.php">Volver al login</a>
        </p>
    </form>
</div>

<?php
require_once __DIR__ . '/../views/templates/footer.php';