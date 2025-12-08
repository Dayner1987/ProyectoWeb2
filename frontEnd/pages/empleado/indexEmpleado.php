<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Empleado</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        body { background: #0f0f0f; color: white; }
        .card { background: #1a1a1a; border: 1px solid #333; }
        .naranja { background: #f97316; }
    </style>
</head>
<body class="min-h-screen">

<!-- NAVBAR -->
<header class="w-full p-4 bg-[#1a1a1a] border-b border-gray-700 flex justify-between">
    <h1 class="text-2xl font-bold text-orange-500">Panel del Empleado</h1>
</header>

<main class="max-w-6xl mx-auto mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- TABLA DE SERVICIOS -->
    <div class="card p-4 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4 text-orange-500">Servicios disponibles</h2>

        <table class="w-full text-left border border-gray-700">
            <thead class="bg-[#111]">
                <tr>
                    <th class="p-2">Servicio</th>
                    <th class="p-2 text-center">¿Realiza?</th>
                </tr>
            </thead>
            <tbody id="tablaServicios" class="text-gray-300"></tbody>
            
        </table>
    </div>

    <!-- FORM DISPONIBILIDAD -->
    <div class="md:col-span-2 card p-6 rounded-xl">
        <h2 class="text-xl font-semibold mb-4 text-orange-500">Agregar disponibilidad</h2>

        <form id="formDisp" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block mb-1">Fecha</label>
                <input id="fecha" name="fecha" type="text"
                       class="w-full p-2 rounded bg-[#111] text-white border border-gray-700" required>
            </div>

            <div>
                <label class="block mb-1">Hora Inicio</label>
                <input id="horaInicio" name="horaInicio" type="text"
                       class="w-full p-2 rounded bg-[#111] text-white border border-gray-700" required>
            </div>

            <div>
                <label class="block mb-1">Hora Fin</label>
                <input id="horaFin" name="horaFin" type="text"
                       class="w-full p-2 rounded bg-[#111] text-white border border-gray-700" required>
            </div>

            <div class="md:col-span-3">
                <button class="w-full p-3 naranja text-white font-semibold rounded-lg hover:bg-orange-600">
                    Guardar disponibilidad
                </button>
            </div>
        </form>
        <p id="errorHoras" class="text-red-500 mt-2 hidden"></p>

    </div>
</main>

<!-- LISTA DE DISPONIBILIDADES -->
<section class="max-w-6xl mx-auto mt-6 card p-6 rounded-xl">
    <h2 class="text-xl font-semibold mb-4 text-orange-500">Mis disponibilidades</h2>

    <table class="w-full text-left border border-gray-700">
        <thead class="bg-[#111]">
            <tr>
                <th class="p-2">Fecha</th>
                <th class="p-2">Inicio</th>
                <th class="p-2">Fin</th>
                <th class="p-2 text-center">Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaDisp" class="text-gray-300"></tbody>
    </table>
</section>

<script src="../../js/empleado.js"></script>


</body>
</html>
