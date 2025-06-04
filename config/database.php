<?php
    // Cargar variables de entorno desde el archivo .env
    function loadEnv() {
        $envFile = __DIR__ . '/../.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                // Ignorar comentarios
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }
                
                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);
                
                // Eliminar comillas si existen
                if (strpos($value, '"') === 0 || strpos($value, "'") === 0) {
                    $value = substr($value, 1, -1);
                }
                
                putenv("$name=$value");
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
    
    // Cargar variables de entorno
    loadEnv();
    
    // Configuración de la base de datos desde variables de entorno
    $host = getenv('DB_HOST') ; 
    $usuario = getenv('DB_USER') ; 
    $contraseña = getenv('DB_PASS') ; 
    $base_de_datos = getenv('DB_NAME') ;
    $puerto = getenv('DB_PORT') ;

    $conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos, $puerto);
    
    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
?>
