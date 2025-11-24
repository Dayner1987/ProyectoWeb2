<?php
namespace Dell5480\BackEnd\Controllers;

use Dell5480\BackEnd\Models\Reserva;

class ReservaController {

    // Listar reservas
    public function index() {
        $model = new Reserva();
        header('Content-Type: application/json');
        echo json_encode($model->getAll());
    }

    // Crear reserva
    public function store() {
        session_start();
        $clienteId = $_SESSION['user']['idUsuarios'] ?? null;

        $disponibilidadId = $_POST['disponibilidad_id'] ?? null;
        $hora = $_POST['hora'] ?? null;
        $detalle = $_POST['detalle'] ?? null;

        if (!$clienteId || !$disponibilidadId || !$hora) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Faltan datos']);
            return;
        }

        $model = new Reserva();
        $result = $model->create($clienteId, $disponibilidadId, $hora, $detalle);

        echo json_encode(['success' => $result, 'message' => $result ? 'Reserva creada' : 'Error al crear']);
    }

    public function updateEstado($id) {
        $estado = $_POST['estado'] ?? null;
        if (!in_array($estado, ['pendiente','confirmada','cancelada'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Estado inválido']);
            return;
        }

        $model = new Reserva();
        $result = $model->updateEstado($id, $estado);

        echo json_encode(['success' => $result, 'message' => $result ? 'Estado actualizado' : 'Error al actualizar']);
    }

    public function destroy($id) {
        $model = new Reserva();
        $result = $model->delete($id);

        echo json_encode(['success' => $result, 'message' => $result ? 'Reserva eliminada' : 'Error al eliminar']);
    }
}
