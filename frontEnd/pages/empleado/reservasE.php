<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Empleado</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen">

<!-- NAVBAR -->
<header class="w-full p-4 bg-gray-800 border-b border-gray-700 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-orange-500">Panel del Empleado</h1>
</header>

<main class="max-w-6xl mx-auto mt-6 p-4 grid grid-cols-1 md:grid-cols-1 gap-6">

    <section class="bg-gray-800 border border-gray-700 rounded-xl p-6 shadow-md">
        <h2 class="text-xl font-semibold mb-4 text-orange-500">Reservas por Fecha</h2>

        <!-- Selector de fecha -->
        <div class="mb-4">
            <label for="fechaFiltro" class="block mb-1 font-semibold">Selecciona una fecha</label>
            <input type="text" id="fechaFiltro" 
                   class="w-48 p-2 rounded bg-gray-900 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-orange-500"
                   placeholder="YYYY-MM-DD">
        </div>

        <!-- Tabla de reservas -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border border-gray-700 rounded">
                <thead class="bg-gray-700 text-white">
                    <tr>
                        <th class="p-2">Cliente</th>
                        <th class="p-2">Hora</th>
                        <th class="p-2">Detalle</th>
                        <th class="p-2 text-center">Estado</th>
                    </tr>
                </thead>
                <tbody id="tablaReservas" class="text-gray-300"></tbody>
            </table>
        </div>
    </section>

</main>

<script>
    const estados = ['pendiente','confirmada','completada','cancelada'];

    // Inicializar Flatpickr
    flatpickr("#fechaFiltro", {
        dateFormat: "Y-m-d",
        defaultDate: new Date(),
        onChange: (selectedDates, dateStr) => {
            cargarReservas(dateStr);
        }
    });

    // Función para cargar reservas por fecha
    async function cargarReservas(fecha) {
        try {
            const res = await fetch(`http://localhost/DisenioWeb2/backEnd/public/reservas/fecha/${fecha}`);
            const data = await res.json();

            const tabla = document.getElementById("tablaReservas");
            tabla.innerHTML = "";

            if (!data.length) {
                tabla.innerHTML = `<tr><td colspan="4" class="p-2 text-center text-gray-400">No hay reservas para esta fecha</td></tr>`;
                return;
            }

            data.forEach(r => {
                const tr = document.createElement("tr");
                tr.classList.add("border-b", "border-gray-700");

                const opciones = estados.map(e =>
                    `<option value="${e}" ${r.estado === e ? 'selected' : ''}>${e.charAt(0).toUpperCase() + e.slice(1)}</option>`
                ).join('');

                tr.innerHTML = `
                    <td class="p-2">${r.cliente_nombre}</td>
                    <td class="p-2">${r.hora}</td>
                    <td class="p-2">${r.detalle || ''}</td>
                    <td class="p-2 text-center">
                        <select onchange="cambiarEstado(${r.idReservas}, this.value)" 
                                class="bg-gray-900 text-white border border-gray-600 rounded px-2 py-1 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            ${opciones}
                        </select>
                    </td>
                `;
                tabla.appendChild(tr);
            });

        } catch (err) {
            console.error("Error cargando reservas:", err);
            Swal.fire("Error", "No se pudieron cargar las reservas", "error");
        }
    }

    // Cambiar estado de reserva
    async function cambiarEstado(id, estado) {
        try {
            const res = await fetch(`http://localhost/DisenioWeb2/backEnd/public/reservas/update/${id}`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ estado })
            });
            const data = await res.json();
            Swal.fire("Actualizado", data.success ? "Estado actualizado" : "Error al actualizar", data.success ? "success" : "error");
        } catch (err) {
            console.error(err);
            Swal.fire("Error", "No se pudo actualizar el estado", "error");
        }
    }

    // Cargar reservas del día actual al inicio
    const hoy = new Date().toISOString().split('T')[0];
    cargarReservas(hoy);
</script>

</body>
</html>
