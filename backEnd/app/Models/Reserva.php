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

    // Obtener todas las reservas (admin)
    public function getAll() {
        $sql = "SELECT r.*, u.nombreUsuario as cliente, d.fecha, d.horaInicio, d.horaFin
                FROM Reservas r
                INNER JOIN Usuarios u ON r.cliente_id = u.idUsuarios
                INNER JOIN Disponibilidades d ON r.disponibilidad_id = d.idDisponibilidad";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // ⭐ NUEVO: obtener reservas de un cliente
    public function getByCliente($clienteId) {
        $sql = "SELECT 
                    r.idReservas,
                    r.hora,
                    r.estado,
                    d.fecha,
                    u2.nombreUsuario AS empleado
                FROM Reservas r
                INNER JOIN Disponibilidades d ON r.disponibilidad_id = d.idDisponibilidad
                INNER JOIN Usuarios u2 ON d.empleado_id = u2.idUsuarios
                WHERE r.cliente_id = :cliente
                ORDER BY d.fecha ASC, r.hora ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":cliente", $clienteId, PDO::PARAM_INT);
        $stmt->execute();
        $reservas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Obtener servicios de cada reserva
        foreach ($reservas as &$res) {
            $sql2 = "SELECT s.nombreServicio 
                     FROM Reservas_Servicios rs
                     INNER JOIN Servicios s ON rs.servicio_id = s.idServicios
                     WHERE rs.reserva_id = :id";

            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bindParam(":id", $res['idReservas'], PDO::PARAM_INT);
            $stmt2->execute();
            $res['servicios'] = array_column($stmt2->fetchAll(PDO::FETCH_ASSOC), "nombreServicio");
        }

        return $reservas;
    }

    // Crear reserva → devuelve el ID generado
    public function create($clienteId, $disponibilidadId, $hora, $detalle = null) {
        $sql = "INSERT INTO Reservas (cliente_id, disponibilidad_id, hora, detalle)
                VALUES (:cliente, :disp, :hora, :detalle)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':cliente', $clienteId, PDO::PARAM_INT);
        $stmt->bindParam(':disp', $disponibilidadId, PDO::PARAM_INT);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':detalle', $detalle);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();  // ⭐ importante
        }
        return false;
    }

    // ⭐ NUEVO: insertar servicios asociados a una reserva
    public function addServicios($reservaId, $servicios) {
        $sql = "INSERT INTO Reservas_Servicios (reserva_id, servicio_id) 
                VALUES (:res, :serv)";

        $stmt = $this->conn->prepare($sql);

        foreach ($servicios as $s) {
            $stmt->bindParam(":res", $reservaId, PDO::PARAM_INT);
            $stmt->bindParam(":serv", $s, PDO::PARAM_INT);
            $stmt->execute();
        }

        return true;
    }

   public function updateEstado($id) {
    $input = json_decode(file_get_contents('php://input'), true);
    $estado = $input['estado'] ?? null;

    if (!in_array($estado, ['pendiente','confirmada','cancelada'])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Estado inválido']);
        return;
    }

    $model = new Reserva();
    $result = $model->updateEstado($id, $estado);

    echo json_encode(['success' => $result]);
}


    public function delete($id) {
        $sql = "DELETE FROM Reservas WHERE idReservas=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    // Verifica si ya existe reserva para esa disponibilidad y hora
public function existeReserva($disponibilidadId, $hora) {
    $hora = date('H:i:s', strtotime($hora));

    $sql = "SELECT COUNT(*) FROM Reservas 
            WHERE disponibilidad_id = :disp AND hora = :hora";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':disp', $disponibilidadId, PDO::PARAM_INT);
    $stmt->bindParam(':hora', $hora);
    $stmt->execute();

    return $stmt->fetchColumn() > 0;
}

public function checkHora($disponibilidadId, $hora) {
    $sql = "SELECT COUNT(*) FROM Reservas WHERE disponibilidad_id=:disp AND hora=:hora";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':disp', $disponibilidadId, PDO::PARAM_INT);
    $stmt->bindParam(':hora', $hora);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}
// Obtener reservas por fecha
public function getByFecha($fecha) {
    $sql = "SELECT r.idReservas, u.nombreUsuario AS cliente_nombre, d.fecha, d.horaInicio AS hora, r.detalle, r.estado
            FROM Reservas r
            INNER JOIN Usuarios u ON r.cliente_id = u.idUsuarios
            INNER JOIN Disponibilidades d ON r.disponibilidad_id = d.idDisponibilidad
            WHERE d.fecha = :fecha
            ORDER BY d.horaInicio ASC";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":fecha", $fecha);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}