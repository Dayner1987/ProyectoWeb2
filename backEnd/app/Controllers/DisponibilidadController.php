<?php
namespace Dell5480\BackEnd\Controllers;

use Dell5480\BackEnd\Models\Disponibilidad;

class DisponibilidadController
{
    /**
     * Retorna las disponibilidades en formato JSON (para la tabla)
     */
    public function index()
    {
        session_start();

        $empleadoId = $_SESSION['user']['idUsuarios'] ?? null;

        if (!$empleadoId) {
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => 'No autorizado']);
            return;
        }

        $model = new Disponibilidad();
        $data = $model->getByEmpleado($empleadoId);

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /**
     * Crear una nueva disponibilidad
     */
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
    $hora = $input['hora'] ?? null; // hora seleccionada
    $detalle = $input['detalle'] ?? null;
    $servicios = $input['servicios'] ?? [];

    if (!$disponibilidadId || !$hora || empty($servicios)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Faltan datos']);
        return;
    }

    // Validar disponibilidad
    $dbDisp = new \Dell5480\BackEnd\Models\Disponibilidad();
    $disp = $dbDisp->getById($disponibilidadId);
    if (!$disp) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Disponibilidad inválida']);
        return;
    }

    // Validar que la hora esté dentro del rango de la disponibilidad
    if ($hora < $input['hora']|| $hora >= $disp['horaFin']) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Hora fuera del rango de disponibilidad']);
        return;
    }

    // Validar que la hora no esté ya reservada
    $modelReserva = new \Dell5480\BackEnd\Models\Reserva();
    if ($modelReserva->checkHora($disponibilidadId, $hora)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Esta hora ya está reservada']);
        return;
    }

    // Crear reserva
    $reservaId = $modelReserva->create($clienteId, $disponibilidadId, $hora, $detalle);
    if (!$reservaId) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al crear reserva']);
        return;
    }

    // Guardar servicios asociados
    $modelReserva->addServicios($reservaId, $servicios);

    echo json_encode(['success' => true, 'message' => 'Reserva creada con éxito', 'reservaId' => $reservaId]);
}
public function create()
{
    session_start();
    header('Content-Type: application/json');

    $empleadoId = $_SESSION['user']['idUsuarios'] ?? null;

    if (!$empleadoId) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'No autorizado']);
        return;
    }

    $fecha = $_POST['fecha'] ?? null;
    $inicio = $_POST['horaInicio'] ?? null;
    $fin = $_POST['horaFin'] ?? null;

    if (!$fecha || !$inicio || !$fin) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Faltan datos']);
        return;
    }

    if ($fin <= $inicio) {
        echo json_encode(['success' => false, 'message' => 'La hora final debe ser mayor a la inicial']);
        return;
    }

    $model = new Disponibilidad();
    $ok = $model->create($empleadoId, $fecha, $inicio, $fin);

    echo json_encode([
        'success' => $ok,
        'message' => $ok ? 'Disponibilidad guardada correctamente' : 'Error al guardar'
    ]);
}

    /**
     * Actualizar disponibilidad
     */
    public function update($id)
    {
        $fecha = $_POST['fecha'] ?? null;
        $inicio = $_POST['horaInicio'] ?? null;
        $fin = $_POST['horaFin'] ?? null;

        if (!$fecha || !$inicio || !$fin) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            return;
        }

        if ($fin <= $inicio) {
            echo json_encode(['success' => false, 'message' => 'La hora final debe ser mayor a la inicial']);
            return;
        }

        $model = new Disponibilidad();
        $result = $model->update($id, $fecha, $inicio, $fin);

        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Disponibilidad actualizada' : 'Error al actualizar'
        ]);
    }

    /**
     * Eliminar disponibilidad
     */
    public function destroy($id)
    {
        $model = new Disponibilidad();
        $result = $model->delete($id);

        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Disponibilidad eliminada' : 'Error al eliminar'
        ]);
    }

    /**
     * Endpoint para FullCalendar (formato de eventos)
     */
    public function indexJSON()
    {
        session_start();

        $empleadoId = $_SESSION['user']['idUsuarios'] ?? null;

        if (!$empleadoId) {
            http_response_code(403);
            echo json_encode([]);
            return;
        }

        $model = new Disponibilidad();
        $disp = $model->getByEmpleado($empleadoId);

        // Convertir disponibilidad a eventos compatibles con FullCalendar
        $events = array_map(function ($d) {
            return [
                'id'    => $d['idDisponibilidad'],
                'title' => 'Disponible',
                'start' => $d['fecha'] . 'T' . $d['horaInicio'],
                'end'   => $d['fecha'] . 'T' . $d['horaFin']
            ];
        }, $disp);

        header('Content-Type: application/json');
        echo json_encode($events);
    }
    /**
 * Obtener horas disponibles individuales (09:00, 10:00, 11:00...)
 */
public function horas()
{
    session_start();

    // Priorizar GET si se pasa empleado_id
    $empleadoId = $_GET['empleado_id'] ?? $_SESSION['user']['idUsuarios'] ?? null;

    if (!$empleadoId) {
        echo json_encode(['success' => false, 'message' => 'No autorizado']);
        return;
    }

    $fecha = $_GET['fecha'] ?? null;
    if (!$fecha) {
        echo json_encode(['success' => false, 'message' => 'Falta la fecha']);
        return;
    }

    $model = new Disponibilidad();
    $rangos = $model->getByFecha($empleadoId, $fecha);

    $horas = [];

    foreach ($rangos as $r) {
        $start = strtotime($r['horaInicio']);
        $end   = strtotime($r['horaFin']);

        while ($start < $end) {
            $horaActual = date('H:i', $start);

            // Verificar si ya existe reserva para este slot
            $reservaModel = new \Dell5480\BackEnd\Models\Reserva();
            $existe = $reservaModel->checkHora($r['idDisponibilidad'], $horaActual);

            if (!$existe) {
                $horas[] = [
                    'idDisponibilidad' => $r['idDisponibilidad'],
                    'horaInicio'       => $horaActual
                ];
            }

            $start = strtotime('+1 hour', $start); // intervalo de 1 hora
        }
    }

    echo json_encode([
        'success' => true,
        'horas' => $horas
    ]);
}




}