<?php
session_start();

// Si no está logueado, redirigir
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$clienteId = $_SESSION['user']['idUsuarios'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<header class="bg-orange-500 text-white py-5 shadow-md">
    <div class="max-w-5xl mx-auto flex justify-between items-center px-4">
        <h1 class="text-3xl font-bold">Mis Reservas</h1>
        <a href="indexCliente.php" class="text-white underline">Volver</a>
    </div>
</header>

<div class="flex justify-between items-center max-w-5xl mx-auto mt-6 px-4">
    <h2 class="text-2xl font-semibold text-gray-700">Reservas pendientes</h2>
    <a href="reservasC.php" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded font-semibold">
        Crear nueva reserva
    </a>
</div>

<main class="max-w-5xl mx-auto mt-6 bg-white shadow-lg rounded-lg p-6">

    <table class="w-full text-left border border-gray-300 rounded-lg overflow-hidden">
        <thead class="bg-orange-500 text-white">
            <tr>
                <th class="py-3 px-4">Fecha</th>
                <th class="py-3 px-4">Hora</th>
                <th class="py-3 px-4">Empleado</th>
                <th class="py-3 px-4">Servicios</th>
                <th class="py-3 px-4">Estado</th>
                <th class="py-3 px-4">Acciones</th> <!-- nueva columna -->
            </tr>
        </thead>
        <tbody id="tablaReservas" class="divide-y divide-gray-200 bg-white">
            <tr>
                <td colspan="6" class="py-4 text-center text-gray-400">
                    Cargando reservas...
                </td>
            </tr>
        </tbody>
    </table>

</main>

<script>
document.addEventListener("DOMContentLoaded", cargarReservas);

async function cargarReservas() {
    const clienteId = <?= json_encode($clienteId); ?>;
    const tbody = document.getElementById("tablaReservas");

    try {
        const resp = await fetch(`/DisenioWeb2/backEnd/public/reservas/cliente/${clienteId}`);

        if (!resp.ok) {
            tbody.innerHTML = `
                <tr><td colspan="6" class="py-4 text-center text-red-500">
                    Error cargando reservas (HTTP ${resp.status})
                </td></tr>`;
            return;
        }

        const reservas = await resp.json();

        if (!Array.isArray(reservas) || reservas.length === 0) {
            tbody.innerHTML = `
                <tr><td colspan="6" class="py-4 text-center text-gray-500">
                    No hiciste ninguna reserva todavía.
                </td></tr>`;
            return;
        }

        // Renderizar tabla completa
        tbody.innerHTML = reservas.map(r => `
            <tr>
                <td class="py-3 px-4">${r.fecha || '--'}</td>
                <td class="py-3 px-4">${r.hora || '--'}</td>
                <td class="py-3 px-4">${r.empleado || '—'}</td>
                <td class="py-3 px-4 text-sm text-gray-700">
                    ${Array.isArray(r.servicios) ? r.servicios.join(', ') : '—'}
                </td>
                <td class="py-3 px-4">
                    <span class="px-3 py-1 rounded-full text-white text-sm 
                        ${r.estado === 'pendiente' ? 'bg-yellow-500' :
                          r.estado === 'confirmada' ? 'bg-green-600' : 'bg-red-500'}">
                        ${r.estado}
                    </span>
                </td>
                <td class="py-3 px-4">
                    <button onclick="eliminarReserva(${r.idReservas})"
                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                        Eliminar
                    </button>
                </td>
            </tr>
        `).join("");

    } catch(err) {
        console.error(err);
        tbody.innerHTML = `
            <tr><td colspan="6" class="py-4 text-center text-red-500">
                Error cargando reservas.
            </td></tr>`;
    }
}

// ======================================================
// FUNCIÓN PARA ELIMINAR RESERVA
// ======================================================
async function eliminarReserva(id) {
    if (!confirm("¿Seguro que deseas eliminar esta reserva?")) return;

    try {
        const resp = await fetch(`/DisenioWeb2/backEnd/public/reservas/${id}`, {
            method: "DELETE"
        });

        const result = await resp.json();

        if (result.success) {
            alert("Reserva eliminada correctamente");
            cargarReservas(); // recargar tabla
        } else {
            alert("No se pudo eliminar la reserva");
        }

    } catch (err) {
        console.error(err);
        alert("Error al eliminar la reserva");
    }
}
</script>

</body>
</html>
