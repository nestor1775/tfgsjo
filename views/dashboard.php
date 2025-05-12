<?php
// Define las variables necesarias
$pageTitle = "Dashboard";
$basePath = "../"; // Ajusta según la ubicación de la página
$additionalCss = ''; // CSS adicional específico de la página
$additionalScripts = '<script type="module" src="../js/chart.js"></script>';// Scripts adicionales específicos de la página

// Incluir el header
include_once __DIR__ . '/templates/header.php';

?>



<!-- Contenido específico de la página -->
<div class="bg-white rounded-lg  m-4">
    
    <div class="grid grid-cols-2 gap-4 mb-6">
        <a href="index.php?action=viewActiveProjects" class="flex justify-start h-48 shadow rounded-lg bg-airtek-primary bg-opacity-20 hover:bg-opacity-10 cursor-pointer transition-all p-4 relative">
            <div class="text-white m-1">
            
                <h3 class="text-xl text-black font-semibold mb-2 "> Proyectos activos </h3>
                <p class="text-sm text-black">Hay un total de 
                <?php
                echo isset($proyectosActivos)
                    ? count(array_filter($proyectosActivos, function ($p) {
                        return isset($p['id_administrador']) && $p['id_administrador'] == 3;
                    }))
                    : 0;
                ?> proyectos activos.</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right h-6 w-6 text-black absolute bottom-4 right-4"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg>
        </a>
        <a href="index.php?action=viewFinishedProjects" class="flex justify-start h-48 shadow rounded-lg bg-airtek-secondary bg-opacity-20 hover:bg-opacity-50 cursor-pointer transition-all p-4 relative">
            <div class="text-white">
                <h3 class="text-xl text-black font-semibold mb-2">Proyectos finalizados</h3>
                <p class="text-sm text-black">Hay un total de <?php
                    echo isset($proyectosInactivos)
                        ? count(array_filter($proyectosInactivos, function ($p) {
                            return isset($p['id_administrador']) && $p['id_administrador'] == 3;
                        }))
                        : 0;
                ?> proyectos inactivos.</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right h-6 w-6 text-black absolute bottom-4 right-4"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg>
        </a>

        

    </div>
    
    
</div>



<?php
// Incluir el footer
include_once __DIR__ . '/templates/footer.php';
?>