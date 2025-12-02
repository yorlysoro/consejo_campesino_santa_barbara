<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($nombre, $email, $password, $rolId = ROLE_USUARIO) {
        $hashedPassword = Security::hashPassword($password);
        
        $stmt = $this->db->prepare("
            INSERT INTO usuarios (nombre, email, password, rol_id) 
            VALUES (?, ?, ?, ?)
        ");
        
        return $stmt->execute([$nombre, $email, $hashedPassword, $rolId]);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT id, nombre, email, rol_id, creado_en FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getByEmail($email) {
        $stmt = $this->db->prepare("SELECT id, nombre, email, rol_id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function updatePassword($id, $newPassword) {
        $hashedPassword = Security::hashPassword($newPassword);
        $stmt = $this->db->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
        return $stmt->execute([$hashedPassword, $id]);
    }

    public function exists($email) {
        return $this->getByEmail($email) !== false;
    }

    // TODO: Agregar métodos para actualizar perfil, desactivar usuario, etc.
}