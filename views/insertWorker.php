<?php


$pageTitle = "Nuevo trabajador";
$basePath = "../"; 
$additionalCss = ''; 
$additionalScripts = ''; 

include_once __DIR__ . '/templates/header.php';

?>


<div class="m-4">
    <form class="flex flex-col mx-auto " action="index.php?action=insertWorker" method="POST">
        <label class="text-lg mb-1" for="nombre">Nombre:</label>
        <input class=" border-2 p-1 border-gray-200 rounded-md w-full" type="text" id="nombre" name="name" required><br>

        <label class="text-lg mb-1" for="nombre">apellido:</label>
        <input class=" border-2 p-1 border-gray-200 rounded-md w-full" type="text" id="nombre" name="apellido" required><br>

        

        <button class=" btn self-center " type="submit">Nuevo trabajador</button>
    </form>
</div>


<?php
include_once __DIR__ . '/templates/footer.php';
?>
