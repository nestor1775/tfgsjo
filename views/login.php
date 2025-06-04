<?php
$pageTitle = "Iniciar Sesión";
$basePath = "../"; 
$additionalCss = ''; 
$additionalScripts = ''; 

include_once __DIR__ . '/templates/headerlogin.php';
?>

    <!-- Mostrar error si las credenciales son incorrectas -->
    <?php if (isset($error)): ?>
        <div style="color: red;">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    
    <div class="ml-12 mr-12 mt-5">
        <form class="flex flex-col mx-auto w-full max-w-xl" action="index.php?action=login" method="POST">

        <div class="relative mb-6">
            <input 
                type="text" 
                id="name" 
                name="name" 
                placeholder=" " 
                class="peer border-2 border-gray-200 rounded-md w-full p-3 text-base bg-gray-50 
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                    peer-placeholder-shown:pt-3 peer-focus:pt-5 peer-valid:pt-5 
                    transition-all duration-300" 
                required
            >
            <label 
                for="name" 
                class="absolute left-3 top-3 text-gray-500 text-lg transition-all duration-300 
                    peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg 
                    peer-focus:top-1 peer-focus:text-sm peer-focus:text-blue-500 
                    peer-valid:top-1 peer-valid:text-sm peer-valid:text-blue-500">
                Nombre
            </label>
        </div>

        <div class="relative mb-6">
            <input 
                type="password" 
                id="password" 
                name="password" 
                placeholder=" " 
                class="peer border-2 border-gray-200 rounded-md w-full p-3 text-base bg-gray-50 
                    focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                    peer-placeholder-shown:pt-3 peer-focus:pt-5 peer-valid:pt-5 
                    transition-all duration-300" 
                required
            >
            <label 
                for="password" 
                class="absolute left-3 top-3 text-gray-500 text-lg transition-all duration-300 
                    peer-placeholder-shown:top-3 peer-placeholder-shown:text-lg 
                    peer-focus:top-1 peer-focus:text-sm peer-focus:text-blue-500 
                    peer-valid:top-1 peer-valid:text-sm peer-valid:text-blue-500">
                Contraseña
            </label>
</div>



            <div class="flex justify-center">
                <button class="btn bg-sky-600 text-white  " type="submit">Iniciar sesión</button>
            </div>
        </form>
    </div>
    <!-- Formulario de login -->
    

<?php
include_once __DIR__ . '/templates/footer.php';
?>  