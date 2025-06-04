<?php
require_once __DIR__ . '/../controllers/parteController.php';

$pageTitle = "Parte Creado";
$basePath = "../";
$additionalCss = '';
$additionalScripts = '';


include_once __DIR__ . '/templates/header.php';
?>

<!-- Contenido específico de la página -->
<div class="bg-white rounded-lg shadow-md p-6 max-w-md mx-auto">
<?php

    $success = $_GET['success'] ?? null;
    $tokenUnico=$_GET['token'] ?? null;
    if ($success == 1) {
        echo '<div class="text-center">
                <div class="mb-4 text-green-500">
                    <i class="fas fa-check-circle text-5xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-green-600 mb-4">¡Parte insertado correctamente!</h1>
                <a href="index.php?action=fillParte&token=' . urlencode($tokenUnico) . '" class="btn inline-block font-medium py-2 px-4 rounded transition duration-300">
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
                <a href="index.php?action=fillParte&token=' . urlencode($tokenUnico) . '" class="btn inline-block font-medium py-2 px-4 rounded transition duration-300 bg-red-500 text-white hover:bg-red-600">
                    <i class="fa fa-repeat mr-1"></i> Volver a insertar
                </a>
                </div>';
    }
    ?>


</div>

<?php
include_once __DIR__ . '/templates/footer.php';
?>
