<?php

$pageTitle = "Ver Proyecto";
$basePath = "../"; 
$additionalCss = ''; 
$additionalScripts = ''; 

include_once __DIR__ . '/templates/header.php';

?>

    <h1 class="m-4 text-lg flex justify-center capitalize"><?php echo $proyecto['nombre']; ?></h1>
    <div  class="ml-4 mr-4 flex-row justify-center block bg-white shadow-lg p-4 rounded-lg hover:bg-gray-100 cursor-pointer  border border-gray-300">
        <h2 class="text-center ">Link para trabajadores</h2>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down mx-auto text-red-400"><path d="m6 9 6 6 6-6"/></svg>
        <p class="text-center"><?php echo $proyecto['link_parte']; ?></p>

    </div>

    <?php 


    if($_SESSION['usuario']['rol']==0){
        $parsed_url = parse_url($proyecto['link_parte']);
        parse_str($parsed_url['query'], $query_params);
        $token = $query_params['token'] ?? null;
        if ($proyecto['is_activo'] == 0) {
            ?>
            <form class="flex justify-center mt-4" action="index.php?action=onProject" method="POST">
                <input type="hidden" name="id_proyecto" value="<?php echo $proyecto['id']; ?>">
                <button class="btn bg-sky-600 text-white  " type="submit">Activar proyecto</button>
            </form>
            
            <?php
        } else if ($proyecto['is_activo'] == 1) {
            ?>
            <form class="flex justify-center mt-4" action="index.php?action=fillParte&token=<?php echo $token ?>" method="POST">
                <input type="hidden" name="id_proyecto" value="<?php echo $proyecto['id']; ?>">
                <button class="btn bg-sky-600 text-white  " type="submit">Rellenar parte (interno)</button>
            </form>
            <form class="flex justify-center mt-4" action="index.php?action=offProject" method="POST">
                <input type="hidden" name="id_proyecto" value="<?php echo $proyecto['id']; ?>">
                <button class="btn bg-red-600 text-white  " type="submit">Inactivar proyecto</button>
            </form>
            <?php
        }
    } elseif ($_SESSION['usuario']['rol']==1) {
        
        ?>
            <form class="flex justify-center mt-4" action="index.php?action=fillParte&token=<?php echo $token ?>" method="POST">
                <input type="hidden" name="id_proyecto" value="<?php echo $proyecto['id']; ?>">
                <button class="btn bg-sky-600 text-white  " type="submit">Rellenar parte (interno)</button>
            </form>
            <?php
    }
    
    
    ?>


    <h2 class="m-4 text-lg flex justify-center">Partes</h2>

    <?php
    foreach (array_reverse($partes) as $index => $parte) {
        // Generar un ID único para cada modal
        $modal_id = "my_modal_" . $index;
    ?>
    <!-- Botón para abrir el modal -->
    <button class="btn ml-4 mr-4 mb-2 rounded-lg bg-white shadow-lg " onclick="document.getElementById('<?php echo $modal_id; ?>').showModal()"><?php echo $parte['fecha']; ?></button>

    <!-- Modal -->
    <dialog id="<?php echo $modal_id; ?>" class="modal ">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold">Parte de Trabajo - <?php echo $parte['fecha']; ?></h3>
            
            <ul class="p-2">
                <li><strong>Fecha:</strong> <?php echo $parte['fecha']; ?></li>
                
                <li><strong>Horas trabajadas:</strong> <?php echo $parte['horas_trabajadas']; ?></li>
                <li><strong>Horas extra:</strong> <?php echo $parte['horas_extra']; ?></li>
                <li><strong>Día festivo:</strong> <?php echo $parte['dia_festivo']; ?></li>
                <li><strong>Observaciones:</strong> <?php echo $parte['observaciones']; ?></li>
                
                <!-- Mostrar la firma del responsable de la empresa origen como imagen -->
                <?php if (!empty($parte['firma_responsable_empresaorigen'])): ?>
                    <li><strong>Firma del responsable de la empresa origen:</strong><br>
                        <img src="<?php echo $parte['firma_responsable_empresaorigen']; ?>" alt="Firma del responsable de la empresa origen" style="max-width: 200px; border: 1px solid #ccc;">
                    </li>
                <?php else: ?>
                    <li>No hay firma del responsable de la empresa origen</li>
                <?php endif; ?>
                
                <!-- Mostrar la firma del responsable de Airtek como imagen -->
                <?php if (!empty($parte['firma_responsable_airtek'])): ?>
                    <li ><strong>Firma del responsable de Airtek:</strong><br>
                        <img src="<?php echo $parte['firma_responsable_airtek']; ?>" alt="Firma del responsable de Airtek" style="max-width: 200px; border: 1px solid #ccc;">
                    </li>
                <?php else: ?>
                    <li>No hay firma del responsable de Airtek</li>
                <?php endif; ?>
            </ul>

            <form action="index.php?action=sendPdfParte" method="POST" class="text-center mt-4">
                <input type="hidden" name="id_parte" value="<?php echo $parte['id']; ?>">
                <button type="submit" class="btn bg-sky-600 text-white">Enviar PDF por correo</button>
            </form>


            


            <p class="text-center m-4">Presiona botón ✕ para cerrar</p>
        </div>
    </dialog>
<?php
}
?>







<?php
    include_once __DIR__ . '/templates/footer.php';
?>