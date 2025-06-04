<?php
require_once __DIR__ . '/../controllers/parteController.php';
require_once __DIR__ . '/../controllers/workerController.php';
$controller = new ParteController();
$workerController = new WorkerController();
$proyecto= $controller->mostrarPartePorToken();
$workers= $workerController->getWorkers();
$tokenUnico=$_GET['token'];


$pageTitle = "Crear Parte";
$basePath = "../"; 
$additionalCss = ''; 
$additionalScripts = '<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
<script src="../js/signature.js"></script>'; 


if(isset($_SESSION)){
    include_once __DIR__ . '/templates/header.php';
}else{include_once __DIR__ . '/templates/headerlogin.php';}

?>


<div class="m-4 p-4 overflow-x-hidden">
    <form class="flex flex-col mx-auto w-full max-w-xl" action="<?php if(isset($_SESSION)){
        echo "index.php?action=doneLogin&token=$tokenUnico";
    }else{echo "done.php?token=$tokenUnico";} ?>" method="POST">
        
    <label class="text-lg mb-1" for="id_trabajador">Seleciona a los trabajadores</label>
    <div class="w-full space-y-2  border-2 border-gray-200 rounded-md p-2">
    <?php
        $hayTrabajadoresActivos = false;

        // Verificamos si hay al menos uno activo
        foreach ($workers as $worker) {
            if ($worker["is_active"] == 1) {
                $hayTrabajadoresActivos = true;
                break;
            }
        }

        if ($hayTrabajadoresActivos) {
            foreach ($workers as $worker) {
                if ($worker["is_active"] == 1) {
                    echo '<div class="flex items-center space-x-2">';
                    echo '<input type="checkbox" id="worker_' . $worker['id'] . '" name="trabajadores[]" value="' . $worker['id'] . '" class="form-checkbox h-5 w-5 text-blue-500">';
                    echo '<label for="worker_' . $worker['id'] . '" class="text-lg font-medium text-gray-800">' .  $worker['nombre'] . ' ' . $worker['apellido'] . '</label>';
                    echo '</div>';
                }
            }
        } else {
            echo '<div class="flex items-center space-x-2">';
            echo '<h2 class="text-red-600">Se deben agregar trabajadores antes</h2>';
            echo '</div>';
        }
        ?>
    </div>


        <label class="text-lg mb-1" for="projectName">Nombre del proyecto asociado</label>
        <input class="border-2 p-1 border-gray-200 rounded-md w-full" type="text" id="projectName" value="<?php echo $proyecto["nombre"] ?>" required readonly><br>
        <input type="hidden" name="id_proyecto" value="<?= $proyecto['id'] ?>">

        <label class="text-lg mb-1" for="parteDate">Fecha del parte</label>
        <input class="border-2 p-1 border-gray-200 rounded-md w-full" type="date" id="parteDate" name="parteDate" required><br>

        <label class="text-lg mb-1" for="hours">Horas</label>
        <input class="border-2 p-1 border-gray-200 rounded-md w-full" type="number" id="hours" name="hours" min="0" max="999" required><br>

        <label class="text-lg mb-1" for="extraHours">Horas extras</label>
        <input class="border-2 p-1 border-gray-200 rounded-md w-full" type="number" id="extraHour" name="extraHours" min="0" max="999" required><br>
        

        <label class="text-lg mb-1" for="festiveDay">Día festivo</label>
        <input class="border-2 p-1 border-gray-200 rounded-md w-full" type="number" id="festiveDay" name="festiveDay" min="0" max="999" required><br>
    

        <label class="text-lg mb-1" for="observations">Observaciones</label>
        <input class="border-2 p-1 border-gray-200 rounded-md w-full" type="text" id="observations" name="observations"><br>

        <label class="text-lg mb-1" for="firmaCliente">Firma responsable (empresa origen)</label>
        <div class="border-2 border-gray-200 rounded-md p-4 w-full bg-gray-50 mb-4 flex flex-col items-center">
            <div class="w-full" style="height: 200px;">
                <canvas id="firmaCliente" class="w-full h-full max-w-full"></canvas>
            </div>
            <button type="button" onclick="borrarFirma('firmaCliente')" class="mt-2 px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">Borrar Firma</button>
        </div>
        <input type="hidden" name="firma_base64_cliente" id="firma_base64_cliente" required><br>

        <label class="text-lg mb-1" for="firmaAirtek">Firma responsable (air tek system)</label>
        <div class="border-2 border-gray-200 rounded-md p-4 w-full bg-gray-50 mb-4 flex flex-col items-center">
            <div class="w-full" style="height: 200px;">
                <canvas id="firmaAirtek" class="w-full h-full max-w-full"></canvas>
            </div>
            <button type="button" onclick="borrarFirma('firmaAirtek')" class="mt-2 px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">Borrar Firma</button>
        </div>
        <input type="hidden" name="firma_base64_airtek" id="firma_base64_airtek" required>

        <?php
        
        if ($hayTrabajadoresActivos){
            echo '<button class="btn self-center mt-4" type="submit">Crear Parte</button>';
        }else{
            echo '<h2 class="text-red-600">Se deben agregar trabajadores antes</h2>';
        }
        ?>
        
        
    </form>
</div>



<?php
include_once __DIR__ . '/templates/footer.php';
?>

