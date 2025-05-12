<?php
require_once __DIR__ . '/../controllers/parteController.php';

// Configuración para la plantilla base
$pageTitle = "Parte Creado";
$basePath = "../";
$additionalCss = '';
$additionalScripts = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_proyecto = $_POST["id_proyecto"];
    $trabajadores = $_POST["trabajadores"];
    $fecha = $_POST["parteDate"];
    $horas_trabajadas = $_POST["hours"];
    $horas_extra = $_POST["extraHours"];
    $dia_festivo = $_POST["festiveDay"];
    $observaciones = $_POST["observations"];
    $firma_empresa = $_POST["firma_base64_cliente"];
    $firma_airtek = $_POST["firma_base64_airtek"];

    $controller = new ParteController();
    $resultado = $controller->createNewParte(
        $id_proyecto,
        $trabajadores,
        $fecha,
        $horas_trabajadas,
        $horas_extra,
        $dia_festivo,
        $observaciones,
        $firma_empresa,
        $firma_airtek
    );

    // GUARDAR si el insert fue bien y REDIRECCIONAR
    if ($resultado) {
        $tokenUnico = $_GET['token'] ?? ''; // Captura el token
        header('Location: done.php?token=' . urlencode($tokenUnico) . '&success=1');
        exit;
    } else {
        $tokenUnico = $_GET['token'] ?? '';
        header('Location: done.php?token=' . urlencode($tokenUnico) . '&success=0');
        exit;
    }
}

// Ahora estamos ya en GET aquí
$tokenUnico = $_GET['token'] ?? '';
$success = $_GET['success'] ?? null;

// Incluir el header
include_once __DIR__ . '/templates/headerlogin.php';
?>

<!-- Contenido específico de la página -->
<div class="bg-white rounded-lg shadow-md p-6 max-w-md mx-auto">
    <?php 
    if ($success == 1) {
        echo '<div class="text-center">
                <div class="mb-4 text-green-500">
                    <i class="fas fa-check-circle text-5xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-green-600 mb-4">¡Parte insertado correctamente!</h1>
                <a href="http://localhost:5000/views/parte.php?token=' . urlencode($tokenUnico) . '" class="btn inline-block font-medium py-2 px-4 rounded transition duration-300">
                    <i class="fa fa-repeat mr-1"></i> Agregar otro parte
                </a>
                </div>';
    } elseif ($success == 0) {
        echo '<div class="text-center">
                <div class="mb-4 text-red-500">
                    <i class="fas fa-exclamation-circle text-5xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-red-600 mb-4">Error al insertar el parte</h1>
                <p class="text-gray-600 mb-6">Ha ocurrido un error al registrar el parte de trabajo.</p>
                <a href="http://localhost:5000/views/parte.php?token=' . urlencode($tokenUnico) . '" class="btn inline-block font-medium py-2 px-4 rounded transition duration-300 bg-red-500 text-white hover:bg-red-600">
                    <i class="fa fa-repeat mr-1"></i> Volver a insertar
                </a>
                </div>';
    }
    ?>
</div>

<?php
// Incluir el footer
include_once __DIR__ . '/templates/footer.php';
?>
