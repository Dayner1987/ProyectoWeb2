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
    public function store()
    {
        session_start();

        $empleadoId = $_SESSION['user']['idUsuarios'] ?? null;
        if (!$empleadoId) {
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

        // Validación simple
        if ($fin <= $inicio) {
            echo json_encode(['success' => false, 'message' => 'La hora final debe ser mayor a la inicial']);
            return;
        }

        $model = new Disponibilidad();
        $result = $model->create($empleadoId, $fecha, $inicio, $fin);

        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Disponibilidad creada correctamente' : 'Error al crear disponibilidad'
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

    $empleadoId = $_SESSION['user']['idUsuarios'] ?? null;
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

        while ($start <= $end) {

            // Mantener hora actual para mostrarla
            $horaActual = date('H:i', $start);

            // Guardar el ID real de disponibilidad
            $horas[] = [
                'idDisponibilidad' => $r['idDisponibilidad'],
                'horaInicio' => $horaActual
            ];

            $start = strtotime('+1 hour', $start);
        }
    }

    echo json_encode([
        'success' => true,
        'horas' => $horas
    ]);
}


}
