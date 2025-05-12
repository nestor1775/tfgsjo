<?php
require_once __DIR__ . '/../config/database.php';


class project {
    private $db;

    public function __construct() {
        global $conexion; 
        $this->db = $conexion;
    }

    // Buscar usuario por nombre de usuario
    public function findByprojectname($projectname) {
        $stmt = $this->db->prepare("SELECT * FROM proyectos WHERE nombre = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM Proyectos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    

    public function newProject($nombre,$id_admin) {
        // Generar enlace único (puede ser UUID o una cadena aleatoria)
        $token = bin2hex(random_bytes(16)); // genera 32 caracteres hexadecimales
        $link_parte = "http://localhost:5000/views/parte.php?token=" . $token;

        $stmt = $this->db->prepare("INSERT INTO Proyectos (nombre, link_parte,id_administrador) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nombre, $link_parte,$id_admin); // "s" para string
    
        if ($stmt->execute()) {
            echo "ok";
        } else {
            echo "Error al crear el proyecto: " . $stmt->error;
        }
    
        $stmt->close();
    }

    public function newProjectngrok($nombre, $id_admin) {
        // Generar enlace único (puede ser UUID o una cadena aleatoria)
        $token = bin2hex(random_bytes(16)); // genera 32 caracteres hexadecimales
    
        // Usar la URL pública de Ngrok en lugar de localhost
        $ngrok_url = "  https://81e1-92-187-188-14.ngrok-free.app"; // Cambia esto con la URL que te da Ngrok
    
        // Crear el enlace completo con el token
        $link_parte = $ngrok_url . "/views/parte.php?token=" . $token;
    
        // Insertar el proyecto con el enlace generado
        $stmt = $this->db->prepare("INSERT INTO Proyectos (nombre, link_parte, id_administrador) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nombre, $link_parte, $id_admin); // "s" para string
    
        if ($stmt->execute()) {
            echo "Proyecto creado con éxito";
        } else {
            echo "Error al crear el proyecto: " . $stmt->error;
        }
    
        $stmt->close();
    }
    

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM Proyectos");
        $stmt->execute();
        $result = $stmt->get_result();
    
        $proyectos = [];
        while ($row = $result->fetch_assoc()) {
            $proyectos[] = $row;
        }
    
        return $proyectos;
    }

    public function getActive() {
        $stmt = $this->db->prepare("SELECT * FROM Proyectos WHERE is_activo = True");
        $stmt->execute();
        $result = $stmt->get_result();
    
        $proyectos = [];
        while ($row = $result->fetch_assoc()) {
            $proyectos[] = $row;
        }
    
        return $proyectos;
    }

    public function getNotActive() {
        $stmt = $this->db->prepare("SELECT * FROM Proyectos WHERE is_activo = False");
        $stmt->execute();
        $result = $stmt->get_result();
    
        $proyectos = [];
        while ($row = $result->fetch_assoc()) {
            $proyectos[] = $row;
        }
    
        return $proyectos;
    }

    public function offProject($id_proyecto) {
        $stmt = $this->db->prepare("UPDATE Proyectos SET is_activo = False WHERE id = ?");
        $stmt->bind_param("i", $id_proyecto);
        $stmt->execute();
        $stmt->close();
    }

    public function onProject($id_proyecto) {
        $stmt = $this->db->prepare("UPDATE Proyectos SET is_activo = True WHERE id = ?");
        $stmt->bind_param("i", $id_proyecto);
        $stmt->execute();
        $stmt->close();
    }
    
}


