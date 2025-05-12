<?php
require_once __DIR__ . '/../models/project.php';

if (!class_exists('ProjectController')) {
    class ProjectController {

        public function newProjectForm() {
            include __DIR__ . '/../views/createProject.php';  
        }

        public function create() {
            if (isset($_POST['nombre']) && isset($_POST['id_administrador'])) {
                $nombre = $_POST['nombre'];
                $id_administrador = $_POST['id_administrador'];

                if (!empty($nombre) && !empty($id_administrador)) {

                    $projectModel = new Project();
                    $projectModel->newProject($nombre, $id_administrador);
                    header("Location: index.php?action=dashboard"); 
                    
            } else {
                    echo "Por favor, completa todos los campos del formulario.";
                }
            } else {
                echo "algo paso";
            }
        }

        public function getAll() {
            $projectModel = new Project();
            return $projectModel->getAll();
        }

        public function getById($id) {
            $projectModel = new Project();
            return $projectModel->getById($id);
        }

        public function getActive() {
            $projectModel = new Project();
            return $projectModel->getActive();
        }

        public function getNotActive() {
            $projectModel = new Project();
            return $projectModel->getNotActive();
        }

        public function offProject($id_proyecto) {
            $projectModel = new project();
            $projectModel->offProject($id_proyecto);
        }

        public function onProject($id_proyecto) {
            $projectModel = new project();
            $projectModel->onProject($id_proyecto);
        }
    }
}
