<?php
namespace Dell5480\BackEnd\Controllers;

use Dell5480\BackEnd\Models\Usuario;

class AuthController {

    public function login() {
        session_start();

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = trim($_POST['usuario'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($usuario === '' || $password === '') {
                $error = "Por favor ingresa correo/CI y contraseña";
            } else {
                $model = new Usuario();
                $user = $model->getByUsuario($usuario);

                // Validar que se encontró el usuario y que tiene la columna password
                if (!$user || !isset($user['password'])) {
                    $error = "Usuario no encontrado";
                } elseif (!password_verify($password, $user['password'])) {
                    $error = "Contraseña incorrecta";
                } else {
                    // Login correcto: guardamos info del usuario en sesión
                    $_SESSION['user'] = $user;

                    // Redirección según rol
                    $redirect = match($user['Roles_idRoles']) {
                        1 => "/DisenioWeb2/frontEnd/pages/admin/indexAdmin.html",
                        2 => "/DisenioWeb2/frontEnd/pages/empleado/indexEmpleado.html",
                        3 => "/DisenioWeb2/frontEnd/pages/cliente/indexCliente.html",
                        default => "/DisenioWeb2/frontEnd/pages/login.html"
                    };

                    header("Location: $redirect");
                    exit;
                }
            }
        }

        // Incluir la vista del login y pasar $error
        include __DIR__ . '/../Views/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /DisenioWeb2/backEnd/public/login");
        exit;
    }
    
}
