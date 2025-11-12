<?php

namespace Dell5480\BackEnd\Core;

use PDO;
use PDOException;

class Database
{
    private $host = "localhost";
    private $dbname = "bdPeluqueria";
    private $user = "root";
    private $pass = "";

    public function conectar()
    {
        try {
            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4",
                $this->user,
                $this->pass
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
