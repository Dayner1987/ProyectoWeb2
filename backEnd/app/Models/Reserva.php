<?php
namespace Dell5480\BackEnd\Models;

use Dell5480\BackEnd\Config\Database;
use PDO;

class Reserva {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll() {
        $sql = "SELECT r.*, u.nombreUsuario as cliente, d.fecha, d.horaInicio, d.horaFin
                FROM Reservas r
                INNER JOIN Usuarios u ON r.cliente_id = u.idUsuarios
                INNER JOIN Disponibilidades d ON r.disponibilidad_id = d.idDisponibilidad";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($clienteId, $disponibilidadId, $hora, $detalle = null) {
        $sql = "INSERT INTO Reservas (cliente_id, disponibilidad_id, hora, detalle)
                VALUES (:cliente, :disp, :hora, :detalle)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cliente', $clienteId, PDO::PARAM_INT);
        $stmt->bindParam(':disp', $disponibilidadId, PDO::PARAM_INT);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':detalle', $detalle);
        return $stmt->execute();
    }

    public function updateEstado($id, $estado) {
        $sql = "UPDATE Reservas SET estado=:estado WHERE idReservas=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id) {
        $sql = "DELETE FROM Reservas WHERE idReservas=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
