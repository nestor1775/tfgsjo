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
        <a href="index.php?action=viewProject&id=44" class="flex justify-start h-24 shadow rounded-lg bg-airtek-primary bg-opacity-20 hover:bg-opacity-10 cursor-pointer transition-all p-4 relative">
            
            <h3 class="text-xl text-black font-semibold mb-2 "> STP </h3>

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right h-6 w-6 text-black absolute bottom-4 right-4"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg>
        </a>

        <a href="index.php?action=viewProject&id=39" class="flex justify-start h-24 shadow rounded-lg bg-airtek-secondary bg-opacity-20 hover:bg-opacity-10 cursor-pointer transition-all p-4 relative">
            
            <h3 class="text-xl text-black font-semibold mb-2 "> Fachadas </h3>

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right h-6 w-6 text-black absolute bottom-4 right-4"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg>
        </a>

        <a href="index.php?action=viewProject&id=39" class="flex justify-start h-24 shadow rounded-lg bg-airtek-accent bg-opacity-20 hover:bg-opacity-10 cursor-pointer transition-all p-4 relative">
            
            <h3 class="text-xl text-black font-semibold mb-2 "> Vill-anova </h3>

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right h-6 w-6 text-black absolute bottom-4 right-4"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg>
        </a>

        <a href="index.php?action=viewProject&id=39" class="flex justify-start h-24 shadow rounded-lg bg-sky-600 bg-opacity-20 hover:bg-opacity-10 cursor-pointer transition-all p-4 relative">
            
            <h3 class="text-xl text-black font-semibold mb-2 "> Marina92 </h3>

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right h-6 w-6 text-black absolute bottom-4 right-4"><path d="M18 8L22 12L18 16"/><path d="M2 12H22"/></svg>
        </a>

        
        
        
        
        
        

    </div>
    
    
</div>



<?php
// Incluir el footer
include_once __DIR__ . '/templates/footer.php';
?>