<?php
namespace Dell5480\BackEnd\Controllers;

use Dell5480\BackEnd\Models\Reserva;

class ReservaController {

    // ==========================
    // LISTAR TODAS LAS RESERVAS (ADMIN)
    // ==========================
    public function index() {
        $model = new Reserva();
        header('Content-Type: application/json');
        echo json_encode($model->getAll());
    }

    // ==========================
    // LISTAR RESERVAS DE UN CLIENTE
    // ==========================
    public function cliente($idCliente) {
        $model = new Reserva();
        header("Content-Type: application/json");
        echo json_encode($model->getByCliente($idCliente));
    }

    // ==========================
    // CREAR RESERVA
    // ==========================
    public function store() {
        session_start();
        header('Content-Type: application/json');
        
        $clienteId = $_SESSION['user']['idUsuarios'] ?? null;
        if (!$clienteId) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'Usuario no logueado']);
            return;
        }

        // Leer datos desde JSON
        $input = json_decode(file_get_contents('php://input'), true);
        $disponibilidadId = $input['disponibilidad_id'] ?? null;
        $detalle = $input['detalle'] ?? null;
        $servicios = $input['servicios'] ?? [];

        if (!$disponibilidadId || empty($servicios)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Faltan datos']);
            return;
        }

        // Obtener hora desde la disponibilidad
        $dbDisp = new \Dell5480\BackEnd\Models\Disponibilidad();
        $disp = $dbDisp->getById($disponibilidadId);

        if (!$disp) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Disponibilidad inválida']);
            return;
        }

        $hora = $input['hora'] ?? null;

        if (!$hora) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Hora de disponibilidad inválida']);
            return;
        }

        // Antes de crear reserva
$model = new Reserva();
if ($model->existeReserva($disponibilidadId, $hora)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Esta hora ya está reservada']);
    return;
}

// Crear reserva
        $model = new Reserva();
        $reservaId = $model->create($clienteId, $disponibilidadId, $hora, $detalle);

        if (!$reservaId) {
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Error al crear reserva"]);
            return;
        }

        // Guardar servicios asociados a la reserva
        $model->addServicios($reservaId, $servicios);

        echo json_encode(["success" => true, "message" => "Reserva creada con éxito", "reservaId" => $reservaId]);
    }

    // ==========================
    // ACTUALIZAR ESTADO DE RESERVA
    // ==========================
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

    // ==========================
    // ELIMINAR RESERVA
    // ==========================
    public function destroy($id) {
        $model = new Reserva();
        $result = $model->delete($id);

        echo json_encode(['success' => $result]);
    }
}