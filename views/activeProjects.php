<?php
// Define las variables necesarias
$pageTitle = "Proyectos Activos";
$basePath = "../"; // Ajusta según la ubicación de la página
$additionalCss = ''; // CSS adicional específico de la página
$additionalScripts = ''; // Scripts adicionales específicos de la página

// Incluir el header
include_once __DIR__ . '/templates/header.php';
?>

<h1 class="m-4 text-lg flex justify-center">Proyectos activos</h1>
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down mx-auto text-blue-400"><path d="m6 9 6 6 6-6"/></svg>

<ul>
    <?php


    
    foreach ($proyectosActivos as $proyectoactivo) {
        if($proyectoactivo["id_administrador"] == '3') {
            echo "<li class='m-4'>
                    <a href='index.php?action=viewProject&id=" . $proyectoactivo['id'] . "'
                    class='block bg-white shadow-lg p-4 rounded-lg hover:bg-gray-100 cursor-pointer h-full w-full'>
                        <span class='text-gray-800 font-semibold'>
                            " . htmlspecialchars($proyectoactivo['nombre']) . "
                        </span>
                    </a>
                </li>";
        }
        
    }
    ?>
</ul>

<?php
// Incluir el footer
include_once __DIR__ . '/templates/footer.php';
?>