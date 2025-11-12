<?php

namespace Dell5480\BackEnd\Core;

use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\Key;

class JWTService
{
    private static $key = "CLAVE_SECRETA_123"; // cámbiala por algo seguro
    private static $alg = "HS256";

    public static function generar($data)
    {
        $payload = [
            "iat" => time(),
            "exp" => time() + (60 * 60 * 24), // 24 horas
            "data" => $data
        ];

        return FirebaseJWT::encode($payload, self::$key, self::$alg);
    }

    public static function verificar($token)
    {
        return FirebaseJWT::decode($token, new Key(self::$key, self::$alg));
    }
}
