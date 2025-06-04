<?php
require_once __DIR__ . '/../config/database.php';


class Worker {
    private $db;

    public function __construct() {
        global $conexion; 
        $this->db = $conexion;
    }

    // Buscar usuario por nombre de usuario
    public function findByname($username) {
        $stmt = $this->db->prepare("SELECT * FROM Administradores WHERE nombre_usuario = ?");
        $stmt->bind_param("s", $username); // 's' es para string
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Devuelve un array asociativo o false
    }

    public function insertTrabajador($nombre, $apellido) {
        $stmt = $this->db->prepare("INSERT INTO Trabajadores (nombre, apellido) VALUES (?, ?)");
        $stmt->bind_param("ss", $nombre, $apellido); // 'ss' indica que son dos strings
        return $stmt->execute(); // Devuelve true si se insertó correctamente, false si hubo error
    }

    public function deleteTrabajador($id) {

        //realmente solo los inactivo porque si tienen partes asociados no los puedo borrar.
        $stmt = $this->db->prepare("UPDATE Trabajadores SET is_active = 0 WHERE id = ?");
        $stmt->bind_param("i", $id); // 'i' indica que es un entero
        return $stmt->execute(); // Devuelve true si se actualizó correctamente
        
    }
    
    

    // Validar usuario y contraseña
    

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM Trabajadores");
        $stmt->execute();
        $result = $stmt->get_result();
    
        $trabajadores = [];
        while ($row = $result->fetch_assoc()) {
            $trabajadores[] = $row;
        }
    
        return $trabajadores;
    }
    
}
