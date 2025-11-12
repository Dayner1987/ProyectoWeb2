<?php

namespace Dell5480\BackEnd\Models;

use Dell5480\BackEnd\Core\Database;
use PDO;

class Usuario
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->conectar();
    }

    public function registrar($nombre, $ci, $correo, $contrasenia, $rol)
    {
        $sql = "INSERT INTO Usuarios (nombreUsuario, ciUsuario, mailUsuario, contrasenia, Roles_idRoles)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nombre, $ci, $correo, password_hash($contrasenia, PASSWORD_BCRYPT), $rol]);
    }

    public function login($correo)
    {
        $sql = "SELECT * FROM Usuarios WHERE mailUsuario = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function loginPorCorreoOCi($usuario)
{
    $sql = "SELECT * FROM Usuarios WHERE mailUsuario = ? OR ciUsuario = ? LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$usuario, $usuario]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

}
