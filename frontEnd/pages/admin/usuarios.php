<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body { background-color: #0f0f0f; color: #f3f3f3; }
        .card { background-color: #1a1a1a; border: 1px solid #333; }
        .naranja { background-color: #f97316; }
        .naranja:hover { background-color: #ea580c; }
        input, select { background-color: #111; color: white; border: 1px solid #333; }
        table th { background-color: #111; color: #f97316; }
        table td { color: #ccc; }
        table tr:nth-child(even) { background-color: #1a1a1a; }
        button { transition: all 0.2s; }
    </style>
</head>

<body class="p-6">

<div class="container mx-auto">

     <!-- NAVBAR ROJO -->
    <header class="bg-orange-700 text-white py-5 shadow-md w-full">
        <div class="max-w-5xl mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Gestión de Usuarios</h1>
            <a href="../admin/indexAdmin.php" class="bg-white text-orange-600 px-4 py-2 rounded-lg font-semibold hover:bg-orange-50 transition">
                Volver
            </a>
        </div>
    </header>
    <!-- FORMULARIO PARA REGISTRAR USUARIO -->
    <div class="card shadow-md rounded p-6 mb-6">

        <h2 class="text-2xl font-bold mb-4 text-orange-500">Registrar Usuario</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div>
                <label class="block font-semibold mb-1">CI</label>
                <input id="reg_ci" type="text" class="border px-2 py-1 rounded w-full">
            </div>

            <div>
                <label class="block font-semibold mb-1">Nombre</label>
                <input id="reg_nombre" type="text" class="border px-2 py-1 rounded w-full">
            </div>

            <div>
                <label class="block font-semibold mb-1">Email</label>
                <input id="reg_email" type="email" class="border px-2 py-1 rounded w-full">
            </div>

            <div>
                <label class="block font-semibold mb-1">Contraseña</label>
                <input id="reg_pass" type="password" class="border px-2 py-1 rounded w-full">
            </div>

            <div>
                <label class="block font-semibold mb-1">Rol</label>
                <select id="reg_rol" class="border px-2 py-1 rounded w-full">
                    <option value="2">Empleado</option>
                    <option value="3">Cliente</option>
                </select>
            </div>

        </div>

        <button id="saveUserBtn" class="mt-4 naranja text-white px-4 py-2 rounded hover:bg-orange-600">
            Registrar Usuario
        </button>
    </div>

    <!-- Filtros y búsqueda -->
    <div class="flex flex-wrap items-center justify-between mb-4 gap-2">

        <div>
            <select id="roleFilter" class="border px-2 py-1 rounded">
                <option value="all">Todos</option>
                <option value="empleado">Empleados</option>
                <option value="cliente">Clientes</option>
            </select>
        </div>

        <div class="flex items-center gap-2">
            <input type="text" id="searchInput" placeholder="Buscar usuarios..." class="border px-2 py-1 rounded">
            <button id="searchBtn" class="bg-orange-500 text-white px-3 py-1 rounded hover:bg-orange-600">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <button id="addUserBtn" class="naranja text-white px-4 py-2 rounded hover:bg-orange-600">
            Nuevo Usuario
        </button>

    </div>

    <!-- Tabla de usuarios -->
    <div class="overflow-x-auto card shadow rounded">
        <table class="min-w-full divide-y divide-gray-700">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-orange-500">CI</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-orange-500">Nombre</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-orange-500">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-orange-500">Rol</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-orange-500">Acciones</th>
                </tr>
            </thead>
            <tbody id="usersBody" class="divide-y divide-gray-700">
                <!-- Aquí se cargarán los usuarios vía JS -->
            </tbody>
        </table>
    </div>

</div>

<script src="../../js/usuarios.js"></script>
</body>
</html>
