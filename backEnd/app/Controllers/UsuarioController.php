<?php
namespace Dell5480\BackEnd\Controllers;

use Dell5480\BackEnd\Models\Usuario;

class UsuarioController {

    // Listar todos los usuarios
    public function index() {
        $model = new Usuario();
        $usuarios = $model->getAll();

        header('Content-Type: application/json');
        echo json_encode($usuarios);
    }

public function store() {
    $error = '';
    $success = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombreUsuario'] ?? null;
        $ci = $_POST['ciUsuario'] ?? null;
        $mail = $_POST['mailUsuario'] ?? null;
        $password = $_POST['password'] ?? null;
        $rol = isset($_POST['rol']) ? (int) $_POST['rol'] : 3; // FORZAR INT



        if (!$nombre || !$ci || !$mail || !$password) {
            $error = 'Faltan datos';
        } else {
            $usuarioModel = new \Dell5480\BackEnd\Models\Usuario();
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $resultado = $usuarioModel->create($nombre, $ci, $mail, $passwordHash, $rol);

            if ($resultado) {
                $success = 'Usuario registrado correctamente';
            } else {
                $error = 'Error al registrar usuario';
            }
        }
    }

    include __DIR__ . '/../Views/register.php';
}

public function createUser() {
    // Forzar JSON como salida
    header('Content-Type: application/json');

    // Solo POST permitido
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        return;
    }

    // Leer datos del JSON enviado desde frontend
    $data = json_decode(file_get_contents('php://input'), true);

    // Validar campos obligatorios
    if (!isset($data['nombreUsuario'], $data['ciUsuario'], $data['mailUsuario'], $data['password'], $data['Roles_idRoles'])) {
        echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios']);
        return;
    }

    $usuarioModel = new Usuario();

    // Verificar si el usuario ya existe por email o CI
    $existingUser = $usuarioModel->getByUsuario($data['mailUsuario']);
    if ($existingUser) {
        echo json_encode(['success' => false, 'message' => 'El usuario ya existe']);
        return;
    }

    // Hashear la contraseña
    $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

    // Crear usuario
    $resultado = $usuarioModel->create(
        $data['nombreUsuario'],
        $data['ciUsuario'],
        $data['mailUsuario'],
        $passwordHash,
        (int)$data['Roles_idRoles']
    );

    // Responder según el resultado
    if ($resultado) {
        echo json_encode(['success' => true, 'message' => 'Usuario creado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al crear usuario']);
    }
}

    // Actualizar usuario
    public function update($id) {
        $data = $_POST;

        $model = new Usuario();

        header('Content-Type: application/json');
        if ($model->update($id, $data)) {
            echo json_encode(['success' => true, 'message' => 'Usuario actualizado']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar']);
        }
    }

    // Eliminar usuario
    public function destroy($id) {
        $model = new Usuario();

        header('Content-Type: application/json');
        if ($model->delete($id)) {
            echo json_encode(['success' => true, 'message' => 'Usuario eliminado']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar']);
        }
    }
}
