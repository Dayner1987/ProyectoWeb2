<?php
namespace Dell5480\BackEnd\Models;

use Dell5480\BackEnd\Config\Database;
use PDO;
use PDOException;

class Empresa {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Obtener la información de la empresa (suponiendo que solo hay un registro)
    public function getEmpresa() {
        $sql = "SELECT * FROM Empresa LIMIT 1";
        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar la información de la empresa
  public function updateEmpresa($data) {
    try {
        $sql = "UPDATE Empresa SET
                    nombreEmpresa = :nombre,
                    imageLogo = :logo,
                    imageQR = :qr,
                    numeroE = :telefono,
                    correoE = :correo,
                    DireccionE = :direccion
                WHERE idEmpresa = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombre', $data['nombreEmpresa']);
        $stmt->bindParam(':logo', $data['imageLogo']);
        $stmt->bindParam(':qr', $data['imageQR']);
        $stmt->bindParam(':telefono', $data['numeroE']);
        $stmt->bindParam(':correo', $data['correoE']);
        $stmt->bindParam(':direccion', $data['DireccionE']);
        $stmt->bindParam(':id', $data['idEmpresa'], \PDO::PARAM_INT);

        return $stmt->execute();
    } catch (\PDOException $e) {
        return false;
    }
}
public function insertEmpresa($data) {
    $sql = "INSERT INTO Empresa (nombreEmpresa, imageLogo, imageQR, numeroE, correoE, DireccionE)
            VALUES (:nombre, :logo, :qr, :telefono, :correo, :direccion)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':nombre', $data['nombreEmpresa']);
    $stmt->bindParam(':logo', $data['imageLogo']);
    $stmt->bindParam(':qr', $data['imageQR']);
    $stmt->bindParam(':telefono', $data['numeroE']);
    $stmt->bindParam(':correo', $data['correoE']);
    $stmt->bindParam(':direccion', $data['DireccionE']);
    return $stmt->execute();
}


}
