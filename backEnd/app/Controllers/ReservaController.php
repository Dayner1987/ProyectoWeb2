<?php
namespace Dell5480\BackEnd\Controllers;

use Dell5480\BackEnd\Models\Reserva;

class ReservaController {

    // ADMIN lista todas
    public function index() {
        $model = new Reserva();
        header('Content-Type: application/json');
        echo json_encode($model->getAll());
    }

    public function cliente($idCliente) {
    $model = new Reserva();
    header("Content-Type: application/json");
    echo json_encode($model->getByCliente($idCliente));
}


    // Crear reserva
    public function store() {
        session_start();
        $clienteId = $_SESSION['user']['idUsuarios'] ?? null;

        $disponibilidadId = $_POST['disponibilidad_id'] ?? null;
        $hora = $_POST['hora'] ?? null;
        $detalle = $_POST['detalle'] ?? null;
        $servicios = $_POST['servicios'] ?? [];

        if (!$clienteId || !$disponibilidadId || !$hora || empty($servicios)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Faltan datos']);
            return;
        }

        $model = new Reserva();
        $reservaId = $model->create($clienteId, $disponibilidadId, $hora, $detalle);

        if (!$reservaId) {
            echo json_encode(["success" => false, "message" => "Error al crear reserva"]);
            return;
        }

        // Guardar servicios de reserva
        $model->addServicios($reservaId, $servicios);

        echo json_encode(["success" => true, "message" => "Reserva creada con éxito"]);
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

        echo json_encode(['success' => $result]);
    }

    public function destroy($id) {
        $model = new Reserva();
        $result = $model->delete($id);

        echo json_encode(['success' => $result]);
    }
}
