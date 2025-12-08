<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Servicios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { background-color: #0f0f0f; color: #f3f3f3; }
        .card { background-color: #1a1a1a; border: 1px solid #333; }
        .naranja { background-color: #f97316; }
        .naranja:hover { background-color: #ea580c; }
        input, textarea { background-color: #111; color: white; border: 1px solid #333; }
        table th { background-color: #111; color: #f97316; }
        table td { color: #ccc; }
        table tr:nth-child(even) { background-color: #1a1a1a; }
        button { transition: all 0.2s; }
    </style>
</head>
<!-- NAVBAR ROJO -->
    <header class="bg-orange-700 text-white py-5 shadow-md w-full">
        <div class="max-w-5xl mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Gestión de Usuarios</h1>
            <a href="../admin/indexAdmin.php" class="bg-white text-orange-600 px-4 py-2 rounded-lg font-semibold hover:bg-orange-50 transition">
                Volver
            </a>
        </div>
    </header>
<body class="p-6">

 

<div class="max-w-5xl mx-auto mt-10 card p-6 rounded-lg shadow">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-orange-500">Gestión de Servicios</h1>
        <button onclick="abrirModalCrear()" class="px-4 py-2 naranja text-white rounded hover:bg-orange-600">+ Agregar Servicio</button>
    </div>

    <!-- TABLA -->
    <div class="overflow-x-auto card rounded shadow">
        <table class="w-full border border-gray-700">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Costo</th>
                    <th class="px-4 py-2">Descripción</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaServicios">
                <!-- Aquí carga JS -->
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL CREAR -->
<div id="modalCrear" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
    <div class="bg-[#1a1a1a] text-white p-6 w-96 rounded shadow">
        <h2 class="text-xl font-bold mb-3 text-orange-500">Agregar Servicio</h2>

        <input id="crearNombre" type="text" placeholder="Nombre del servicio" class="w-full border p-2 rounded mb-2">
        <input id="crearCosto" type="number" placeholder="Costo" class="w-full border p-2 rounded mb-2">
        <textarea id="crearDescripcion" placeholder="Descripción" class="w-full border p-2 rounded mb-3"></textarea>

        <div class="flex justify-between">
            <button onclick="cerrarModalCrear()" class="px-3 py-1 bg-gray-500 rounded">Cancelar</button>
            <button onclick="crearServicio()" class="px-3 py-1 naranja rounded">Guardar</button>
        </div>
    </div>
</div>

<!-- MODAL EDITAR -->
<div id="modalEditar" class="hidden fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center z-50">
    <div class="bg-[#1a1a1a] text-white p-6 w-96 rounded shadow">
        <h2 class="text-xl font-bold mb-3 text-orange-500">Editar Servicio</h2>

        <input id="editarId" type="hidden">
        <input id="editarNombre" type="text" class="w-full border p-2 rounded mb-2">
        <input id="editarCosto" type="number" class="w-full border p-2 rounded mb-2">
        <textarea id="editarDescripcion" class="w-full border p-2 rounded mb-3"></textarea>

        <div class="flex justify-between">
            <button onclick="cerrarModalEditar()" class="px-3 py-1 bg-gray-500 rounded">Cancelar</button>
            <button onclick="actualizarServicio()" class="px-3 py-1 bg-green-600 rounded">Actualizar</button>
        </div>
    </div>
</div>

<script src="../../js/servicios.js"></script>
</body>
</html>
