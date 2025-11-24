<?php
namespace Dell5480\BackEnd\Models;

use Dell5480\BackEnd\Config\Database;
use PDO;
use PDOException;

class Servicio {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll() {
        $sql = "SELECT * FROM Servicios";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($nombre, $costo, $descripcion = null) {
        $sql = "INSERT INTO Servicios (nombreServicio, costoServicio, descripcionServicio)
                VALUES (:nombre, :costo, :desc)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':costo', $costo);
        $stmt->bindParam(':desc', $descripcion);
        return $stmt->execute();
    }

    public function update($id, $nombre, $costo, $descripcion = null) {
        $sql = "UPDATE Servicios SET nombreServicio=:nombre, costoServicio=:costo, descripcionServicio=:desc
                WHERE idServicios=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':costo', $costo);
        $stmt->bindParam(':desc', $descripcion);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM Servicios WHERE idServicios=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
