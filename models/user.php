<?php
require_once __DIR__ . '/../config/database.php';


class User {
    private $db;

    public function __construct() {
        global $conexion; 
        $this->db = $conexion;
    }

    // Buscar usuario por nombre de usuario
    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM Administradores WHERE nombre_usuario = ?");
        $stmt->bind_param("s", $username); // 's' es para string
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Devuelve un array asociativo o false
    }

    // Validar usuario y contraseña
    public function validate($username, $password) {
        $user = $this->findByUsername($username);
        

        if ($user && password_verify($password, $user['clave'])) {
            return $user;
        }
        return false; 
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM Administradores");
        $stmt->execute();
        $result = $stmt->get_result();
    
        $administradores = [];
        while ($row = $result->fetch_assoc()) {
            $administradores[] = $row;
        }
    
        return $administradores;
    }
    
}
