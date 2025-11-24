<?php
namespace Dell5480\BackEnd\Controllers;

use Dell5480\BackEnd\Models\Empresa;

class EmpresaController {

    // Mostrar información de la empresa
    public function show() {
        $empresaModel = new Empresa();
        $empresa = $empresaModel->getEmpresa();

        header('Content-Type: application/json');
        echo json_encode($empresa ?: []);
    }

    // Actualizar o crear la empresa
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            return;
        }

        try {
            $data = $_POST;
            $uploadDir = __DIR__ . '/../../public/uploads/';

            // Manejo de logo
            if (isset($_FILES['imageLogo']) && $_FILES['imageLogo']['error'] === 0) {
                $logoName = time() . '-' . basename($_FILES['imageLogo']['name']);
                move_uploaded_file($_FILES['imageLogo']['tmp_name'], $uploadDir . $logoName);
                $data['imageLogo'] = '/uploads/' . $logoName;
            } else {
                $data['imageLogo'] = $data['currentLogo'] ?? '';
            }

            // Manejo de QR
            if (isset($_FILES['imageQR']) && $_FILES['imageQR']['error'] === 0) {
                $qrName = time() . '-' . basename($_FILES['imageQR']['name']);
                move_uploaded_file($_FILES['imageQR']['tmp_name'], $uploadDir . $qrName);
                $data['imageQR'] = '/uploads/' . $qrName;
            } else {
                $data['imageQR'] = $data['currentQR'] ?? '';
            }

            $empresaModel = new Empresa();
            $empresaExistente = $empresaModel->getEmpresa();

            if ($empresaExistente) {
                // Si ya existe, actualizamos
                $resultado = $empresaModel->updateEmpresa([
                    'idEmpresa' => $empresaExistente['idEmpresa'],
                    'nombreEmpresa' => $data['nombreEmpresa'] ?? '',
                    'imageLogo' => $data['imageLogo'],
                    'imageQR' => $data['imageQR'],
                    'numeroE' => $data['numeroE'] ?? '',
                    'correoE' => $data['correoE'] ?? '',
                    'DireccionE' => $data['DireccionE'] ?? ''
                ]);
            } else {
                // Si no existe, insertamos uno nuevo
                $resultado = $empresaModel->insertEmpresa([
                    'nombreEmpresa' => $data['nombreEmpresa'] ?? '',
                    'imageLogo' => $data['imageLogo'],
                    'imageQR' => $data['imageQR'],
                    'numeroE' => $data['numeroE'] ?? '',
                    'correoE' => $data['correoE'] ?? '',
                    'DireccionE' => $data['DireccionE'] ?? ''
                ]);
            }

            header('Content-Type: application/json');
            echo json_encode([
                'success' => $resultado,
                'message' => $resultado ? 'Empresa guardada correctamente' : 'Error al guardar empresa'
            ]);

        } catch (\PDOException $e) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Error PDO: ' . $e->getMessage()
            ]);
        }
    }
}
