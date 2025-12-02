<?php
class Role {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT id, nombre, descripcion FROM roles");
        return $stmt->fetchAll();
    }

    public function getPermissions($rolId) {
        $stmt = $this->db->prepare("
            SELECT p.nombre 
            FROM permisos p
            JOIN rol_permisos rp ON p.id = rp.permiso_id
            WHERE rp.rol_id = ?
        ");
        $stmt->execute([$rolId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // TODO: Agregar métodos para gestionar roles y permisos dinámicamente
}