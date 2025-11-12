<?php

namespace Dell5480\BackEnd\Controllers;

use Dell5480\BackEnd\Models\Usuario;

class AuthController
{
    public function register()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data) {
            http_response_code(400);
            echo json_encode(["error" => "Datos no válidos"]);
            return;
        }

        $usuario = new Usuario();

        $ok = $usuario->registrar(
            $data["nombre"],
            $data["ci"],
            $data["correo"],
            $data["password"],
            $data["rol"]
        );

        echo json_encode(["success" => $ok]);
    }

public function login()
{
    $data = json_decode(file_get_contents("php://input"), true);

    $usuario = new \Dell5480\BackEnd\Models\Usuario();

    // Buscar por correo o CI
    $user = $usuario->loginPorCorreoOCi($data["usuario"]);

    if (!$user || !password_verify($data["password"], $user["contrasenia"])) {
        http_response_code(401);
        echo json_encode(["error" => "Credenciales incorrectas"]);
        return;
    }

    // Crear token JWT
    $token = \Dell5480\BackEnd\Core\JWTService::generar([
        "id" => $user["idUsuarios"],
        "nombre" => $user["nombreUsuario"],
        "rol" => $user["Roles_idRoles"]
    ]);

    echo json_encode([
        "success" => true,
        "token" => $token
    ]);
}



}
