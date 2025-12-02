<?php
class Auth {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT id, nombre, email, password, rol_id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && Security::verifyPassword($password, $user['password'])) {
            Session::set('user_id', $user['id']);
            Session::set('user_nombre', $user['nombre']);
            Session::set('user_email', $user['email']);
            Session::set('user_rol', $user['rol_id']);
            return true;
        }
        return false;
    }

    public function logout() {
        Session::destroy();
    }

    public function isLoggedIn() {
        return Session::has('user_id');
    }

    public function getCurrentUser() {
        if (!$this->isLoggedIn()) return null;
        
        return [
            'id' => Session::get('user_id'),
            'nombre' => Session::get('user_nombre'),
            'email' => Session::get('user_email'),
            'rol_id' => Session::get('user_rol')
        ];
    }

    public function hasPermission($permission) {
        $user = $this->getCurrentUser();
        if (!$user) return false;

        // Admin tiene todos los permisos
        if ($user['rol_id'] == ROLE_ADMIN) return true;

        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM rol_permisos rp
            JOIN permisos p ON rp.permiso_id = p.id
            WHERE rp.rol_id = ? AND p.nombre = ?
        ");
        $stmt->execute([$user['rol_id'], $permission]);
        $result = $stmt->fetch();
        
        return $result['count'] > 0;
    }

    // TODO: Implementar "remember me" functionality
    // TODO: Agregar auditoría de logins
}