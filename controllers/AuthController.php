<?php
require_once __DIR__ . '/../models/user.php';

if (!class_exists('AuthController')) {
    class AuthController {

        public function loginForm() {
            include __DIR__ . '/../views/login.php';
        }

        public function login() {
            $username = $_POST['name'];
            $password = $_POST['password'];

            $usuarioModel = new User();
            $usuario = $usuarioModel->validate($username, $password);

            if ($usuario) {
                $_SESSION['usuario'] = $usuario;
                
                header("Location: index.php?action=dashboard");
            } else {
                $error = "Credenciales incorrectas";
                include __DIR__ . '/../views/login.php';
            }
        }

        public function logout() {
            session_destroy();
            header("Location: index.php?action=loginForm");
        }
    }
}
?>
