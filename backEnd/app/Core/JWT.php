<?php

namespace Dell5480\BackEnd\Core;

use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\Key;

class JWT
{
    private static $key = "CLAVE_SUPER_SECRETA_123"; // cámbiala por una más segura
    private static $alg = "HS256";

    public static function generar($data)
    {
        $payload = [
            "iss" => "backend-peluqueria",
            "iat" => time(),
            "exp" => time() + (60 * 60 * 24), // expira en 24 horas
            "data" => $data
        ];

        return FirebaseJWT::encode($payload, self::$key, self::$alg);
    }

    public static function verificar($token)
    {
        return FirebaseJWT::decode($token, new Key(self::$key, self::$alg));
    }
}
