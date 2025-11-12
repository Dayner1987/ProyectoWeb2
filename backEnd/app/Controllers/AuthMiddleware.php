<?php

namespace Dell5480\BackEnd\Core;

class AuthMiddleware
{
    public static function verificar()
    {
        $headers = getallheaders();

        if (!isset($headers["Authorization"])) {
            http_response_code(401);
            echo json_encode(["error" => "Token no enviado"]);
            exit;
        }

        $token = str_replace("Bearer ", "", $headers["Authorization"]);

        try {
            $data = JWT::verificar($token);
            return $data->data;

        } catch (\Exception $e) {
            http_response_code(401);
            echo json_encode(["error" => "Token inválido"]);
            exit;
        }
    }
}
