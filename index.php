<?php
session_start();

// controladores
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/ProjectController.php';
require_once __DIR__ . '/controllers/ParteController.php';
require_once __DIR__ . '/controllers/WorkerController.php';
$authController = new AuthController();
$projectController = new ProjectController();
$parteController = new ParteController();
$workerController = new WorkerController();


$action = $_GET['action'] ?? null;
if ($action === null) {
    if (isset($_SESSION['usuario'])) {
        header('Location: index.php?action=dashboard');
        exit;
    } else {
        $action = 'loginForm';
    }
}

// Verificar la acción y procesarla
switch ($action) {
    case 'loginForm':
        // Mostrar formulario de login
        $authController->loginForm();
        break;
        
    case 'login':
        // Procesar el login
        $authController->login();
        break;
        
    case 'logout':
        // Procesar el logout
        $authController->logout();
        break;
        
    case 'dashboard':
        // Verificar si el usuario está logueado antes de permitir el acceso al dashboard
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?action=loginForm");
            exit();    // Detener la ejecución del script
        }
        // Obtener los proyectos usando el controlador
        $proyectos = $projectController->getAll();
        $proyectosActivos = $projectController->getActive();
        $proyectosInactivos = $projectController->getNotActive();
        // Si está logueado, mostrar el dashboard

        if ($_SESSION['usuario']['rol']==0){
            include __DIR__ . '/views/dashboard.php';
            break;
        }elseif ($_SESSION['usuario']['rol']==1){
            include __DIR__ . '/views/dashboardV2.php';
            break;
        }
        

    case 'createProject':
        $projectController->create(); // Mostrar formulario
        break;

    case 'newProject':
        $projectController->newProjectForm();        // Proesar datos del formulario
        break;

    case 'viewActiveProjects':
        // Obtener los proyectos activos
        $proyectosActivos = $projectController->getActive();
        // Incluir la vista de proyectos activos
        include __DIR__ . '/views/activeProjects.php';
        break;

    case 'viewFinishedProjects':
        // Obtener los proyectos activos
        $proyectosInactivos = $projectController->getNotActive();
        // Incluir la vista de proyectos activos
        include __DIR__ . '/views/finishedProjects.php';
        break;

    case 'insertWorker':
        // Obtener los proyectos activos
        $insertWorker = $workerController->insertTrabajador($_POST[$name],$_POST[$apellido]);
        // Incluir la vista de proyectos activos
        header("Location: index.php?action=dashboard"); 
        break;

    case 'viewProject':
        // Obtener el proyecto activo
        $proyecto = $projectController->getById($_GET['id']);
        $partes = $parteController->getPartesByProjectId($_GET['id']);
        // Incluir la vista de proyecto activo
        include __DIR__ . '/views/viewProject.php';
        break;

    case 'getAllPartes':
        // Devolver todas las partes en JSON para las gráficas
        header('Content-Type: application/json');
        $parteController->getAllPartes();
        break;

    case 'getCountByMonth':
        // Devolver conteo de partes por mes en JSON para las gráficas
        header('Content-Type: application/json');
        $parteController->getCountByMonth();
        break;

    case 'offProject':
        $projectController->offProject($_POST['id_proyecto']);
        header('Location: index.php?action=viewActiveProjects');
        break;

    case 'onProject':
        $projectController->onProject($_POST['id_proyecto']);
        header('Location: index.php?action=viewActiveProjects');
        break;

    case 'fillParte':
        include __DIR__ . '/views/parte.php';
        break;
    
    case 'sendPdfParte':
        $parteController->sendPdf($_POST["id_parte"]);
        break;

    case 'doneLogin':
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $resultado = $parteController->createNewParte(
                $_POST["id_proyecto"],
                $_POST["trabajadores"],
                $_POST["parteDate"],
                $_POST["hours"],
                $_POST["extraHours"],
                $_POST["festiveDay"],
                $_POST["observations"],
                $_POST["firma_base64_cliente"],
                $_POST["firma_base64_airtek"]
            );
    
            // Redirigir para evitar reinserción
            $success = $resultado ? 1 : 0;
            $token = $_GET['token'] ?? '';  // si lo estás usando
    
            header("Location: index.php?action=doneLogin&success=$success&token=$token");
            exit;
        }
    
        // Mostrar la vista sólo en GET (después de redirección)
        include __DIR__ . '/views/doneLogin.php';
        break;
        


    default:
        echo "Acción no válida";
        
         // Mostrar mensaje si la acción no existe
        break;
}
