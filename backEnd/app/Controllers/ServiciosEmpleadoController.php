<?php
namespace Dell5480\BackEnd\Controllers;

use Dell5480\BackEnd\Models\Servicios_Empleados;

class ServiciosEmpleadoController {

    public function index() {
        session_start();
        $empleadoId = $_SESSION['user']['idUsuarios'] ?? null;

        if (!$empleadoId) {
            echo json_encode([]);
            return;
        }

        $model = new Servicios_Empleados();
        echo json_encode($model->getServiciosEmpleado($empleadoId));
    }

    public function add() {
        session_start();
        $empleadoId = $_SESSION['user']['idUsuarios'] ?? null;

        $data = json_decode(file_get_contents("php://input"), true);
        $servicioId = $data['servicio_id'] ?? null;

        if (!$empleadoId || !$servicioId) {
            echo json_encode(['success' => false]);
            return;
        }

        $model = new Servicios_Empleados();
        echo json_encode(['success' => $model->addServicio($empleadoId, $servicioId)]);
    }

    public function remove($id) {
        session_start();
        $empleadoId = $_SESSION['user']['idUsuarios'] ?? null;

        if (!$empleadoId || !$id) {
            echo json_encode(['success' => false]);
            return;
        }

        $model = new Servicios_Empleados();
        echo json_encode(['success' => $model->removeServicio($empleadoId, $id)]);
    }
}
