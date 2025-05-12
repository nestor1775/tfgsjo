<?php
require_once __DIR__ . '/../config/database.php';

class Parte {
    private $db;

    public function __construct() {
        global $conexion; 
        $this->db = $conexion;
    }

    // Buscar parteporid
    public function findByid($id) {
        $stmt = $this->db->prepare("SELECT * FROM Partes WHERE id = ?");
        $stmt->bind_param("i", $id); // 's' es para string
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Devuelve un array asociativo o false
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM partes");
        $stmt->execute();
        $result = $stmt->get_result();
    
        $partes = [];
        while ($row = $result->fetch_assoc()) {
            $partes[] = $row;
        }
    
        return $partes;
    }



    public function getbyTokenNGROK($token) {
        $link = '  https://81e1-92-187-188-14.ngrok-free.app/views/parte.php?token=' . $token;

        $stmt = $this->db->prepare("SELECT * FROM Proyectos WHERE link_parte = ?");
        $stmt->bind_param("s", $link);
        $stmt->execute();
        $proyecto = $stmt->get_result()->fetch_assoc();

        return $proyecto;
    }

    public function getbyToken($token) {
        $link = 'http://localhost:5000/views/parte.php?token=' . $token;

        $stmt = $this->db->prepare("SELECT * FROM Proyectos WHERE link_parte = ?");
        $stmt->bind_param("s", $link);
        $stmt->execute();
        $proyecto = $stmt->get_result()->fetch_assoc();

        return $proyecto;
    }

    public function getPartesByProjectIdOLD($id_proyecto) {
        $stmt = $this->db->prepare("SELECT * FROM Partes WHERE id_proyecto = ?");
        $stmt->bind_param("i", $id_proyecto);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getPartesByProjectId($id_proyecto) {
        // Primero obtenemos los partes del proyecto
        $stmt = $this->db->prepare("SELECT * FROM Partes WHERE id_proyecto = ?");
        $stmt->bind_param("i", $id_proyecto);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $partes = [];
    
        while ($parte = $result->fetch_assoc()) {
            // Agregar trabajadores relacionados a cada parte
            $parte['trabajadores'] = $this->getTrabajadoresPorParte($parte['id']);
            $partes[] = $parte;
        }
    
        return $partes;
    }
    

    public function getTrabajadoresPorParte($id_parte) {
        $stmt = $this->db->prepare("SELECT t.nombre, t.apellido
                                    FROM parte_trabajador pt
                                    JOIN Trabajadores t ON pt.id_trabajador = t.id
                                    WHERE pt.id_parte = ?");
        $stmt->bind_param("i", $id_parte);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $trabajadores = [];
        while ($row = $result->fetch_assoc()) {
            $trabajadores[] = $row;
        }
    
        return $trabajadores;
    }
    

    public function newParteOLD($id_proyecto,$id_trabajador,$fecha,$horas_trabajadas,$horas_extra,$dia_festivo,$observaciones,$firma_responsable_empresaorigen,$firma_responsable_airtek) {
        
        $stmt = $this->db->prepare("INSERT INTO Partes (id_proyecto, id_trabajador, fecha, horas_trabajadas, horas_extra, dia_festivo, observaciones, firma_responsable_empresaorigen, firma_responsable_airtek) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Enlazar los parámetros con el tipo de datos correspondiente:
        // 'i' para enteros, 's' para cadenas, 'd' para fechas, 'b' para binarios
        $stmt->bind_param(
            "iisisssss", // Definir el tipo de los parámetros: entero (i), cadena (s), entero (i), cadena (s), etc.
            $id_proyecto,
            $id_trabajador,
            $fecha,
            $horas_trabajadas,
            $horas_extra,
            $dia_festivo,
            $observaciones,
            $firma_responsable_empresaorigen,
            $firma_responsable_airtek
        );

        // Ejecutar la consulta SQL
        $stmt->execute();

        // Comprobar si la inserción fue exitosa
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false; // Hubo un problema con la inserción
        }

    }

    public function newParte($id_proyecto, $trabajadores, $fecha, $horas_trabajadas, $horas_extra, $dia_festivo, $observaciones, $firma_responsable_empresaorigen, $firma_responsable_airtek) {
    
        // Inserción del parte en la tabla 'Partes'
        $stmt = $this->db->prepare("INSERT INTO Partes (id_proyecto, fecha, horas_trabajadas, horas_extra, dia_festivo, observaciones, firma_responsable_empresaorigen, firma_responsable_airtek) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Enlazar los parámetros para la inserción del parte
        $stmt->bind_param("isisssss", 
            $id_proyecto,
            $fecha,
            $horas_trabajadas,
            $horas_extra,
            $dia_festivo,
            $observaciones,
            $firma_responsable_empresaorigen,
            $firma_responsable_airtek
        );
    
        // Ejecutar la consulta para insertar el parte
        $stmt->execute();
    
        // Verificar si la inserción fue exitosa
        if ($stmt->affected_rows > 0) {
            // Obtener el ID del nuevo parte insertado
            $id_parte = $this->db->insert_id;
    
            // Ahora insertamos los trabajadores asociados al nuevo parte
            if (!empty($trabajadores)) {
                foreach ($trabajadores as $id_trabajador) {
                    // Insertar relación entre parte y trabajador
                    $stmt_trabajador = $this->db->prepare("INSERT INTO parte_trabajador (id_parte, id_trabajador) VALUES (?, ?)");
                    $stmt_trabajador->bind_param("ii", $id_parte, $id_trabajador);
                    $stmt_trabajador->execute();
                }
            }
    
            return true; // Todo fue exitoso
        } else {
            return false; // Hubo un problema al insertar el parte
        }
    }
    

    public function getCountByMonth() {
        // Obtener solo los últimos 3 meses (mes actual y dos anteriores)
        $sql = "SELECT DATE_FORMAT(fecha, '%Y-%m') AS mes, COUNT(*) AS cantidad
                FROM Partes
                WHERE fecha >= DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 2 MONTH), '%Y-%m-01')
                GROUP BY mes
                ORDER BY mes ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

}
