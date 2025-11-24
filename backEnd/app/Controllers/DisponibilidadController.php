<?php
namespace Dell5480\BackEnd\Controllers;

use Dell5480\BackEnd\Models\Disponibilidad;

class DisponibilidadController {

    // Listar disponibilidades de un empleado
    public function index() {
        session_start();
        $empleadoId = $_SESSION['user']['idUsuarios'] ?? null;

        if (!$empleadoId) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            return;
        }

        $model = new Disponibilidad();
        echo json_encode($model->getByEmpleado($empleadoId));
    }

    // Crear disponibilidad
    public function store() {
        session_start();
        $empleadoId = $_SESSION['user']['idUsuarios'] ?? null;

        $fecha = $_POST['fecha'] ?? null;
        $inicio = $_POST['horaInicio'] ?? null;
        $fin = $_POST['horaFin'] ?? null;

        if (!$fecha || !$inicio || !$fin) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Faltan datos']);
            return;
        }

        $model = new Disponibilidad();
        $result = $model->create($empleadoId, $fecha, $inicio, $fin);

        echo json_encode(['success' => $result, 'message' => $result ? 'Disponibilidad creada' : 'Error al crear']);
    }

    public function update($id) {
        $fecha = $_POST['fecha'] ?? null;
        $inicio = $_POST['horaInicio'] ?? null;
        $fin = $_POST['horaFin'] ?? null;

        $model = new Disponibilidad();
        $result = $model->update($id, $fecha, $inicio, $fin);

        echo json_encode(['success' => $result, 'message' => $result ? 'Disponibilidad actualizada' : 'Error al actualizar']);
    }

    public function destroy($id) {
        $model = new Disponibilidad();
        $result = $model->delete($id);

        echo json_encode(['success' => $result, 'message' => $result ? 'Disponibilidad eliminada' : 'Error al eliminar']);
    }
}
