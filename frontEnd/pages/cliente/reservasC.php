<?php
// reservasC.php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Servicio</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>
<body class="bg-gray-100">

<main class="max-w-5xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">

    <h2 class="text-2xl font-semibold mb-4 text-gray-700">Nueva reserva</h2>

    <form id="reservaForm" class="space-y-4">

        <!-- Servicio -->
        <div>
            <label class="block font-semibold mb-1">Servicio:</label>
            <select id="servicioSelect" name="servicio_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Selecciona un servicio --</option>
            </select>
        </div>

        <!-- Empleado -->
        <div>
            <label class="block font-semibold mb-1">Empleado:</label>
            <select id="empleadoSelect" name="empleado_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Selecciona primero un servicio --</option>
            </select>
        </div>

        <!-- Fecha -->
        <div>
            <label class="block font-semibold mb-1">Fecha:</label>
            <input 
                id="fechaSelect" 
                name="fecha" 
                type="text"
                class="w-full border rounded px-3 py-2 bg-white"
                placeholder="Selecciona una fecha"
                required
            >
        </div>

        <!-- Hora disponible -->
        <div>
            <label class="block font-semibold mb-1">Hora disponible:</label>
            <select id="horaSelect" name="disponibilidad_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Selecciona fecha primero --</option>
            </select>
        </div>

        <!-- Detalle -->
        <div>
            <label class="block font-semibold mb-1">Detalle (opcional):</label>
            <textarea name="detalle" class="w-full border rounded px-3 py-2" rows="3"></textarea>
        </div>

        <button type="submit" class="px-6 py-2 bg-orange-500 hover:bg-orange-600 rounded text-white font-semibold">
            Reservar
        </button>

    </form>

</main>

<script>
document.addEventListener('DOMContentLoaded', async () => {

    const servicioSelect = document.getElementById('servicioSelect');
    const empleadoSelect = document.getElementById('empleadoSelect');
    const fechaSelect = document.getElementById('fechaSelect');
    const horaSelect = document.getElementById('horaSelect');
    const form = document.getElementById('reservaForm');

    // Inicializar calendario
    flatpickr("#fechaSelect", {
        dateFormat: "Y-m-d",
        minDate: "today"
    });

    // 1️⃣ Cargar servicios
    const respServicios = await fetch('/DisenioWeb2/backEnd/public/servicios');
    const servicios = await respServicios.json();

    servicios.forEach(s => {
        const opt = document.createElement('option');
        opt.value = s.idServicios;
        opt.textContent = s.nombreServicio;
        servicioSelect.appendChild(opt);
    });


    // 2️⃣ Al cambiar servicio → cargar empleados
    servicioSelect.addEventListener('change', async () => {

        const servicioId = servicioSelect.value;
        empleadoSelect.innerHTML = '<option value="">-- Elige un empleado --</option>';
        horaSelect.innerHTML = '<option value="">-- Selecciona fecha primero --</option>';
        fechaSelect.value = "";

        if (!servicioId) return;

        const respEmp = await fetch(`/DisenioWeb2/backEnd/public/servicio-empleado/servicio/${servicioId}`);
        const empleados = await respEmp.json();

        empleados.forEach(e => {
            const opt = document.createElement('option');
            opt.value = e.idUsuarios;
            opt.textContent = e.nombreUsuario;
            empleadoSelect.appendChild(opt);
        });
    });


    // 3️⃣ Al cambiar empleado → limpiar fecha y hora
    empleadoSelect.addEventListener('change', () => {
        fechaSelect.value = "";
        horaSelect.innerHTML = '<option value="">-- Selecciona fecha primero --</option>';
    });


    // 4️⃣ Al cambiar fecha → cargar horas disponibles según FECHA + EMPLEADO
    fechaSelect.addEventListener('change', async () => {

        const empleadoId = empleadoSelect.value;
        const fecha = fechaSelect.value;

        horaSelect.innerHTML = '<option value="">Cargando...</option>';

        if (!empleadoId || !fecha) {
            horaSelect.innerHTML = '<option value="">-- Selecciona fecha primero --</option>';
            return;
        }

        const respDisp = await fetch(`/DisenioWeb2/backEnd/public/disponibilidades?empleado_id=${empleadoId}&fecha=${fecha}`);
        const disp = await respDisp.json();

        horaSelect.innerHTML = '<option value="">-- Elige hora --</option>';

        disp.forEach(d => {
            const opt = document.createElement('option');
            opt.value = d.idDisponibilidad;
            opt.textContent = `${d.horaInicio} - ${d.horaFin}`;
            horaSelect.appendChild(opt);
        });
    });


    // 5️⃣ Enviar formulario
    form.addEventListener('submit', async e => {
        e.preventDefault();

        const formData = new FormData(form);

        const resp = await fetch('/DisenioWeb2/backEnd/public/reservas/create', {
            method: 'POST',
            body: formData
        });

        const result = await resp.json();

        if (result.success) {
            alert('Reserva creada con éxito');
            window.location.reload();
        } else {
            alert(result.message || 'Error al crear reserva');
        }
    });

});
</script>

</body>
</html>
