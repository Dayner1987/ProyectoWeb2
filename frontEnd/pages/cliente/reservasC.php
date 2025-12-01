<?php
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
<header class="bg-orange-500 text-white py-5 shadow-md">
    <div class="max-w-5xl mx-auto flex justify-between items-center px-4">
        <h1 class="text-3xl font-bold">Mis Reservas</h1>
        <a href="indexCliente.php" class="text-white underline">Volver</a>
    </div>
</header>
<main class="max-w-4xl mx-auto mt-10 bg-white shadow-xl rounded-lg p-6">

    <h2 class="text-3xl font-semibold mb-6 text-gray-700">Nueva Reserva</h2>

    <form id="reservaForm" class="space-y-5">

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
                readonly
                required
            >
        </div>

        <!-- Hora -->
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

        <!-- Método de pago (SE OCULTA HASTA QUE SELECCIONE HORA) -->
        <div id="metodoPagoSection" class="hidden border-t pt-4">
            <h3 class="text-xl font-semibold mb-2">Método de pago</h3>

            <select id="pagoSelect" class="w-full border rounded px-3 py-2">
                <option value="">-- Selecciona método de pago --</option>
                <option value="qr">Pago con QR</option>
                <option value="efectivo">Pago en efectivo</option>
            </select>

            <!-- QR dinámico -->
            <div id="qrBox" class="hidden mt-4 p-4 bg-gray-100 rounded">
                <p class="font-semibold mb-2">Escanea el código QR:</p>
                <img id="empresaQR" 
                    src=""
                    alt="QR de pago" 
                    class="mx-auto w-48 h-48 object-cover">
            </div>


            <!-- WhatsApp -->
            <a id="whatsappBtn" target="_blank"
               class="hidden mt-5 block bg-green-500 hover:bg-green-600 text-white text-center py-2 rounded font-semibold">
               Enviar comprobante por WhatsApp
            </a>
        </div>

        <!-- Botón final -->
        <button type="submit" 
            class="w-full px-6 py-3 mt-6 bg-orange-500 hover:bg-orange-600 rounded text-white font-semibold text-lg" >
            Generar Reserva
        </button>

    </form>

</main>
<script src="../../js/cliente.js"></script>

</body>
</html>
