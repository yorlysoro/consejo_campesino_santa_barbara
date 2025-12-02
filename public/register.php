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
    $result = $controller->handleRegister($_POST);
    
    $message = [
        'type' => $result['success'] ? 'success' : 'danger',
        'text' => $result['message']
    ];
    
    if ($result['success']) {
        // Opcional: Auto-login después del registro
        // $auth->login($_POST['email'], $_POST['password']);
        // header('Location: index.php');
        // exit;
    }
}

$pageTitle = 'Registrarse';
require_once __DIR__ . '/../views/templates/header.php';
?>

<div class="form-container">
    <h2>Registrarse</h2>
    
    <?php if ($message): ?>
        <div class="alert alert-<?= $message['type'] ?>">
            <?= htmlspecialchars($message['text']) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="nombre">Nombre Completo</label>
            <input type="text" id="nombre" name="nombre" required 
                   value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required 
                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required 
                   minlength="<?= PASSWORD_MIN_LENGTH ?>">
            <small>Mínimo <?= PASSWORD_MIN_LENGTH ?> caracteres</small>
        </div>
        
        <button type="submit" class="btn btn-primary">Registrarse</button>
        <p style="margin-top: 1rem;">
            <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
        </p>
    </form>
</div>

<?php
require_once __DIR__ . '/../views/templates/footer.php';