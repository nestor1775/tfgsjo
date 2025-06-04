<?php


$pageTitle = "Eliminar trabajador";
$basePath = "../"; 
$additionalCss = ''; 
$additionalScripts = ''; 

include_once __DIR__ . '/templates/header.php';

?>


<div class="m-4">
    

    <?php foreach ($workers as $worker): ?>
        <?php if ($worker['is_active'] == 1): ?> <!-- Solo mostrar trabajadores activos -->
            <form class="flex flex-col mx-auto " action="index.php?action=deleteWorker" method="POST">
                <label class="text-lg text-center border-2 p-1 border-gray-200 rounded-md w-full" for="nombre">
                    <?php echo $worker['nombre'] . ' ' . $worker['apellido']; ?>
                </label>
                <input
                    type="hidden" id="nombre" name="id" 
                    value="<?= htmlspecialchars($worker['id']) ?>" required>
                <button class="btn text-white bg-rose-500 self-center m-4 " type="submit">Eliminar</button>
            </form>
        <?php endif; ?>
    <?php endforeach; ?>

</div>


<?php
include_once __DIR__ . '/templates/footer.php';
?>
