<?php
class AuthController {
    private $auth;
    private $userModel;
    
    public function __construct() {
        $this->auth = new Auth();
        $this->userModel = new User();
    }

    public function handleLogin($data) {
        if (!isset($data['email']) || !isset($data['password'])) {
            return ['success' => false, 'message' => 'Datos incompletos'];
        }

        $email = Security::sanitizeInput($data['email']);
        $password = $data['password']; // No sanitizar password para no alterarla

        if ($this->auth->login($email, $password)) {
            return ['success' => true, 'redirect' => 'public/index.php'];
        }

        return ['success' => false, 'message' => 'Credenciales inválidas'];
    }

    public function handleRegister($data) {
        if (!isset($data['nombre']) || !isset($data['email']) || !isset($data['password'])) {
            return ['success' => false, 'message' => 'Datos incompletos'];
        }

        $nombre = Security::sanitizeInput($data['nombre']);
        $email = Security::sanitizeInput($data['email']);
        $password = $data['password'];

        // Validaciones básicas
        if (strlen($password) < PASSWORD_MIN_LENGTH) {
            return ['success' => false, 'message' => "La contraseña debe tener al menos " . PASSWORD_MIN_LENGTH . " caracteres"];
        }

        if ($this->userModel->exists($email)) {
            return ['success' => false, 'message' => 'El email ya está registrado'];
        }

        if ($this->userModel->create($nombre, $email, $password)) {
            return ['success' => true, 'message' => 'Usuario registrado exitosamente'];
        }

        return ['success' => false, 'message' => 'Error al registrar usuario'];
    }

    public function handlePasswordRecovery($data) {
        // TODO: Implementar recuperación real con token por email
        // Por ahora solo simulamos
        return [
            'success' => true, 
            'message' => 'Si el email existe, recibirá instrucciones (simulado)'
        ];
    }
}