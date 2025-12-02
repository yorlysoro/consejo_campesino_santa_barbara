<?php
class UserController {
    private $auth;
    private $userModel;
    
    public function __construct() {
        $this->auth = new Auth();
        $this->userModel = new User();
    }

    public function createUser($data) {
        // Solo admin puede crear usuarios
        if (!$this->auth->hasPermission('usuarios.crear')) {
            return ['success' => false, 'message' => 'No tiene permisos'];
        }

        $controller = new AuthController();
        return $controller->handleRegister($data);
    }

    // TODO: Agregar métodos para editar, eliminar y listar usuarios
}