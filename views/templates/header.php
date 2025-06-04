<?php
// Obtener la ruta base para los enlaces
$basePath = isset($basePath) ? $basePath : '../';
?>
<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - Air Tek System' : 'Air Tek System'; ?></title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link href="<?php echo $basePath; ?>css/output.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="<?php echo $basePath; ?>img/favicon.ico">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Scripts adicionales específicos de la página -->
    <?php if (isset($additionalCss)) echo $additionalCss; ?>
</head>
<body class="min-h-screen flex flex-col bg-base-100">
    <div class="drawer drawer-end">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Header -->
            <header class="navbar bg-base-100 shadow-md">
                <!-- Logo y título en la barra de navegación -->
                <div class="flex-1">
                    <a href="<?php echo $basePath; ?>index.php" class="btn btn-ghost normal-case text-xl">
                        <img src="<?php echo $basePath; ?>img/Logo.png" alt="Air Tek System" class="h-8">
                    </a>
                </div>
                
                <!-- Botón hamburguesa para abrir el drawer (pegado al borde derecho) -->
                <div class="flex-none navbar-right">
                    <label for="my-drawer" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </label>
                </div>
                
            </header>
            
            <!-- Contenedor principal -->
            <main class="container mx-auto p-4  ">
                <!-- El contenido específico de cada página irá aquí -->
            </main>
        </div>
        <div class="drawer-side z-20">
            
            <label for="my-drawer" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 min-h-full bg-base-200 text-base-content">
                <li>
                    <a class="mb-2" href="<?php echo $basePath; ?>index.php" class="flex items-center p-2  rounded-lg">
                        <i class="fas fa-home w-6"></i>
                        <span>Inicio</span>
                    </a>

                    <?php if (isset($_SESSION["usuario"]['rol']) && $_SESSION["usuario"]['rol'] === 0): ?>
                        
                        <a class="mb-2" href="<?php echo $basePath; ?>index.php?action=newProject" class="flex items-center p-2  rounded-lg">
                        <i class="fa fa-file-text w-6"></i>
                        <span>Crear nuevo proyecto</span>
                        </a>

                        <a class="mb-2" href="<?php echo $basePath; ?>index.php?action=viewActiveProjects" class="flex items-center p-2  rounded-lg">
                            <i class="fa fa-eye w-6"></i>
                            <span>Proyectos activos</span>
                        </a>

                        <a class="mb-2" href="<?php echo $basePath; ?>index.php?action=viewFinishedProjects" class="flex items-center p-2  rounded-lg">
                            <i class="fa fa-eye-slash w-6"></i>
                            <span>Proyectos inactivos</span>
                        </a>

                    <?php endif; ?>

                    <a class="mb-2" href="<?php echo $basePath; ?>index.php?action=insertWorker" class="flex items-center p-2  rounded-lg">
                        <i class="fa fa-user-plus w-6"></i>
                        <span>Nuevo trabajador</span>
                    </a>

                    <a class="mb-2" href="<?php echo $basePath; ?>index.php?action=deleteWorker" class="flex items-center p-2  rounded-lg">
                        <i class="fa fa-user-times w-6"></i>
                        <span>Eliminar trabajador</span>
                    </a>

                    <a class="mb-2" href="<?php echo $basePath; ?>index.php?action=logout" class="flex items-center p-2  rounded-lg">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span>Cerrar sesión</span>
                    </a>

                    


                    

                </li>
                <!-- Aquí puedes añadir más elementos del menú -->
            </ul>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</body>
</html>
