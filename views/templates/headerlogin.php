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
            <header class=" bg-base-100 shadow-md flex justify-center items-center h-16">
                <!-- Logo y título en la barra de navegación -->
                <div>
                    
                        <img src="<?php echo $basePath; ?>img/Logo.png" alt="Air Tek System" class="h-8">
                    
                </div>
                
                <!-- Botón hamburguesa para abrir el drawer (pegado al borde derecho) -->
                
            </header>

            <!-- Contenedor principal -->
            <main class="container mx-auto p-4   ">
                <!-- El contenido específico de cada página irá aquí -->
            </main>
        </div>
        
    </div>
</body>
</html>
