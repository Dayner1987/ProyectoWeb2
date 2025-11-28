<?php
namespace Dell5480\BackEnd\Controllers;

use Dell5480\BackEnd\Models\Servicio;

class ServicioController {

    // Listar todos los servicios
    public function index() {
        $model = new Servicio();
        header('Content-Type: application/json');
        echo json_encode($model->getAll());
    }

    // Crear un servicio
    public function store() {
        $nombre = $_POST['nombreServicio'] ?? null;
        $costo = $_POST['costoServicio'] ?? null;
        $descripcion = $_POST['descripcionServicio'] ?? null;

        if (!$nombre || !$costo) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios']);
            return;
        }

        $model = new Servicio();
        $result = $model->create($nombre, $costo, $descripcion);

        echo json_encode(['success' => $result, 'message' => $result ? 'Servicio creado' : 'Error al crear servicio']);
    }

    public function update($id) {
        $nombre = $_POST['nombreServicio'] ?? null;
        $costo = $_POST['costoServicio'] ?? null;
        $descripcion = $_POST['descripcionServicio'] ?? null;

        $model = new Servicio();
        $result = $model->update($id, $nombre, $costo, $descripcion);

        echo json_encode(['success' => $result, 'message' => $result ? 'Servicio actualizado' : 'Error al actualizar']);
    }

    public function destroy($id) {
        $model = new Servicio();
        $result = $model->delete($id);

        echo json_encode(['success' => $result, 'message' => $result ? 'Servicio eliminado' : 'Error al eliminar']);
    }

    // -----------------------------
// Obtener servicios de un empleado (JSON)
// -----------------------------
public function getByEmpleadoJSON() {
    session_start();
    $empleadoId = $_SESSION['user']['idUsuarios'] ?? null;

    if (!$empleadoId) {
        http_response_code(403);
        echo json_encode([]);
        return;
    }

    $model = new Servicio();
    $servicios = $model->getByEmpleado($empleadoId);
    header('Content-Type: application/json');
    echo json_encode($servicios);
}

}
