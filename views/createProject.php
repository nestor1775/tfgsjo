<?php
require_once __DIR__ . '/../models/user.php'; 
$user = new User();
$admins = $user->getAll();


$pageTitle = "Crear Proyecto";
$basePath = "../"; 
$additionalCss = ''; 
$additionalScripts = ''; 

include_once __DIR__ . '/templates/header.php';

?>


<div class="m-4">
    <form class="flex flex-col mx-auto " action="index.php?action=createProject" method="POST">
        <label class="text-lg mb-1" for="nombre">Nombre del Proyecto:</label>
        <input class=" border-2 p-1 border-gray-200 rounded-md w-full" type="text" id="nombre" name="nombre" required><br>

        <label class="text-lg mb-1  " for="id_administrador">ID del Administrador:</label>
        <select class=" border-2 p-1 border-gray-200 rounded-md w-full" id="id_administrador" name="id_administrador" required>
            <option  value="<?php echo $admins[0]["id"];?>" selected><?php echo $admins[0]["nombre_usuario"] ?></option>
            
        </select><br>

        <button class=" btn self-center " type="submit">Crear Proyecto</button>
    </form>
</div>


<?php
// Incluir el footer
include_once __DIR__ . '/templates/footer.php';
?>
