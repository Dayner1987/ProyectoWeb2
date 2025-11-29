<?php
namespace Dell5480\BackEnd\Controllers;

use Dell5480\BackEnd\Models\Servicios_Empleados;

class ServiciosEmpleadoController {

    // Devuelve empleados que hacen un servicio específico
  public function index() {
    session_start();
    $empleadoId = $_SESSION['user']['idUsuarios'] ?? null;

    if (!$empleadoId) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'No hay usuario']);
        return;
    }

    $servicios = (new Servicios_Empleados())->getServiciosEmpleado($empleadoId);
    echo json_encode($servicios);
}



    // --- Métodos para que un empleado agregue/quitar servicios (solo sesión) ---
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

public function getByServicio($servicioId) {
    $model = new \Dell5480\BackEnd\Models\Servicios_Empleados();
    $empleados = $model->getEmpleadosPorServicio($servicioId);

    header('Content-Type: application/json');
    echo json_encode($empleados);
}

}
