<?php
require_once __DIR__ . '/../models/parte.php';
require_once __DIR__ . '/../services/MailService.php';
require_once __DIR__ . '/../services/PdfService.php';

if (!class_exists('ParteController')) {
    class ParteController {
        public function mostrarPartePorToken() {

            if (!isset($_GET['token'])) {
                die("Token no proporcionado.");
            }

            $token = $_GET['token'];
            $parteModel = new Parte();
            $proyecto = $parteModel->getByToken($token);

            if (!$proyecto) {
                die("Proyecto no encontrado.");
            }

            return $proyecto;
        }

        public function findById($id) {
            $parteModel = new Parte();
            return $parteModel->findByid($id);
        }

        public function sendPdf($id_parte) {
            $id = $id_parte;
            $parte = ParteController::findByid($id); // Tu modelo debe tener este método

            $pdfService = new PdfService();
            $correoService = new correoService();

            $pdfPath = $pdfService->generar($parte);
            $correoService->enviar('nestorgomez123450@gmail.com', $pdfPath);

            header("Location: index.php?action=viewProject&id=" . $parte['id_proyecto']);
        }


        public function getPartesByProjectId($id_proyecto) {
            $parteModel = new Parte();
            return $parteModel->getPartesByProjectId($id_proyecto);
        }

        public function createNewParte($id_proyecto,$trabajadores,$fecha,$horas_trabajadas,$horas_extra,$dia_festivo,$observaciones,$firma_responsable_empresaorigen,$firma_responsable_airtek) {

            $parteModel = new Parte();
            $newparte= $parteModel->newParte($id_proyecto,$trabajadores,$fecha,$horas_trabajadas,$horas_extra,$dia_festivo,$observaciones,$firma_responsable_empresaorigen,$firma_responsable_airtek);

            return $newparte;
        }

        public function getAllPartes() {
            $parteModel = new Parte();
            $partes = $parteModel->getAll();

            echo json_encode($partes);
        }

        public function getCountByMonth() {
            $parteModel = new Parte();
            $data = $parteModel->getCountByMonth();
            // Limitar solo a los últimos 3 meses
            $data = array_slice($data, -3);
            echo json_encode($data);
        }

        
    }

    
}
?>
