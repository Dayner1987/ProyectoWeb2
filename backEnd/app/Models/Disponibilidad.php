<?php
namespace Dell5480\BackEnd\Models;

use Dell5480\BackEnd\Config\Database;
use PDO;

class Disponibilidad {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getByEmpleado($empleadoId) {
        $sql = "SELECT * FROM Disponibilidades WHERE empleado_id=:emp";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':emp', $empleadoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($empleadoId, $fecha, $horaInicio, $horaFin) {
        $sql = "INSERT INTO Disponibilidades (empleado_id, fecha, horaInicio, horaFin)
                VALUES (:emp, :fecha, :inicio, :fin)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':emp', $empleadoId, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':inicio', $horaInicio);
        $stmt->bindParam(':fin', $horaFin);
        return $stmt->execute();
    }

    public function update($id, $fecha, $horaInicio, $horaFin) {
        $sql = "UPDATE Disponibilidades SET fecha=:fecha, horaInicio=:inicio, horaFin=:fin
                WHERE idDisponibilidad=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':inicio', $horaInicio);
        $stmt->bindParam(':fin', $horaFin);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM Disponibilidades WHERE idDisponibilidad=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
