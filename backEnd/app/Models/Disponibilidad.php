<?php
namespace Dell5480\BackEnd\Models;

use Dell5480\BackEnd\Config\Database;
use PDO;
use PDOException;

class Disponibilidad
{
    private PDO $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    /**
     * Obtener todas las disponibilidades de un empleado
     */
    public function getByEmpleado($empleadoId)
    {
        try {
            $sql = "SELECT 
                        idDisponibilidad,
                        empleado_id,
                        fecha,
                        horaInicio,
                        horaFin
                    FROM Disponibilidades
                    WHERE empleado_id = :emp
                    ORDER BY fecha ASC, horaInicio ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':emp', $empleadoId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return [];
        }
    }

    /**
     * Crear disponibilidad
     */
    public function create($empleadoId, $fecha, $horaInicio, $horaFin)
    {
        try {
            $sql = "INSERT INTO Disponibilidades (empleado_id, fecha, horaInicio, horaFin)
                    VALUES (:emp, :fecha, :inicio, :fin)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':emp', $empleadoId, PDO::PARAM_INT);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':inicio', $horaInicio);
            $stmt->bindParam(':fin', $horaFin);

            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Actualizar disponibilidad
     */
    public function update($id, $fecha, $horaInicio, $horaFin)
    {
        try {
            $sql = "UPDATE Disponibilidades 
                    SET fecha = :fecha, horaInicio = :inicio, horaFin = :fin
                    WHERE idDisponibilidad = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':inicio', $horaInicio);
            $stmt->bindParam(':fin', $horaFin);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Eliminar disponibilidad
     */
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM Disponibilidades WHERE idDisponibilidad = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();

        } catch (PDOException $e) {
            return false;
        }
    }

    /**
 * Obtener disponibilidades de un empleado en una fecha específica
 */
public function getByFecha($empleadoId, $fecha)
{
    try {
        $sql = "SELECT 
                    idDisponibilidad,
                    empleado_id,
                    fecha,
                    horaInicio,
                    horaFin
                FROM Disponibilidades
                WHERE empleado_id = :emp AND fecha = :fecha
                ORDER BY horaInicio ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':emp', $empleadoId, PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        return [];
    }
}
/**
 * Obtener una disponibilidad por ID
 */
public function getById($id)
{
    try {
        $sql = "SELECT 
                    idDisponibilidad,
                    empleado_id,
                    fecha,
                    horaInicio,
                    horaFin
                FROM Disponibilidades
                WHERE idDisponibilidad = :id
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // devuelve un array asociativo o false si no existe

    } catch (\PDOException $e) {
        return false;
    }
}
public function getHorasDisponibles($empleadoId, $fecha)
{
    $sql = "SELECT 
                idDisponibilidad,
                horaInicio
            FROM Disponibilidades
            WHERE empleado_id = :empleado
            AND fecha = :fecha
            ORDER BY horaInicio ASC";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':empleado', $empleadoId, PDO::PARAM_INT);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function checkHoraReservada($disponibilidadId, $hora) {
    $sql = "SELECT COUNT(*) FROM Reservas 
            WHERE disponibilidad_id = :disp AND hora = :hora";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':disp', $disponibilidadId, PDO::PARAM_INT);
    $stmt->bindParam(':hora', $hora);
    $stmt->execute();
    return $stmt->fetchColumn() > 0; // true si ya existe reserva
}




}