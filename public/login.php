<?php
require_once __DIR__ . '/../includes/init.php';

$auth = new Auth();
if ($auth->isLoggedIn()) {
    header('Location: index.php');
    exit;
}

$message = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AuthController();
    $result = $controller->handleLogin($_POST);
    
    if ($result['success']) {
        header('Location: ' . $result['redirect']);
        exit;
    } else {
        $message = ['type' => 'danger', 'text' => $result['message']];
    }
}

$pageTitle = 'Iniciar Sesión';
require_once __DIR__ . '/../views/templates/header.php';
?>

<div class="form-container">
    <h2>Iniciar Sesión</h2>
    
    <?php if ($message): ?>
        <div class="alert alert-<?= $message['type'] ?>">
            <?= htmlspecialchars($message['text']) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required value="<?= $_POST['email'] ?? '' ?>">
        </div>
        
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        <p style="margin-top: 1rem;">
            <a href="register.php">¿No tienes cuenta? Regístrate</a> | 
            <a href="recover.php">¿Olvidaste tu contraseña?</a>
        </p>
    </form>
</div>

<?php
require_once __DIR__ . '/../views/templates/footer.php';