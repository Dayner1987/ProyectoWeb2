<?php
namespace Dell5480\BackEnd\Models;

use Dell5480\BackEnd\Config\Database;
use PDO;

class Servicios_Empleados {

    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getServiciosEmpleado($empleadoId) {
        $sql = "SELECT servicio_id FROM Servicios_Empleados WHERE empleado_id = :emp";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':emp', $empleadoId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function addServicio($empleadoId, $servicioId) {
        $sql = "INSERT IGNORE INTO Servicios_Empleados (servicio_id, empleado_id)
                VALUES (:serv, :emp)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':serv', $servicioId);
        $stmt->bindParam(':emp', $empleadoId);
        return $stmt->execute();
    }

    public function removeServicio($empleadoId, $servicioId) {
        $sql = "DELETE FROM Servicios_Empleados 
                WHERE servicio_id = :serv AND empleado_id = :emp";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':serv', $servicioId);
        $stmt->bindParam(':emp', $empleadoId);
        return $stmt->execute();
    }
   
public function getEmpleadosPorServicio($servicioId) {
    $sql = "SELECT u.idUsuarios, u.nombreUsuario
            FROM Usuarios u
            JOIN Servicios_Empleados se ON se.empleado_id = u.idUsuarios
            WHERE se.servicio_id = :servicio";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':servicio', $servicioId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
