<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Servicios</title>
    <script src="https://cdn.tailwindcss.com"></script>
     <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">

   <!-- Navbar -->
    <header class="primary-blue text-white p-4 shadow-md flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Administrar Empresa</h1>
        <a href="indexAdmin.php" class="px-4 py-2 bg-orange-500 rounded hover:bg-orange-600 transition">Volver</a>
    </header>

    <div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">

        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Gestión de Servicios</h1>

            <button onclick="abrirModalCrear()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Agregar Servicio
            </button>
        </div>

        <!-- TABLA -->
        <div class="overflow-x-auto">
            <table class="w-full bg-white shadow rounded">
                <thead>
                    <tr class="bg-gray-200">

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
    <div id="modalCrear" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
        <div class="bg-white p-6 w-96 rounded shadow">
            <h2 class="text-xl font-bold mb-3">Agregar Servicio</h2>

            <input id="crearNombre" type="text" placeholder="Nombre del servicio" class="w-full border p-2 rounded mb-2">

            <input id="crearCosto" type="number" placeholder="Costo" class="w-full border p-2 rounded mb-2">

            <textarea id="crearDescripcion" placeholder="Descripción" class="w-full border p-2 rounded mb-3"></textarea>

            <div class="flex justify-between">
                <button onclick="cerrarModalCrear()" class="px-3 py-1 bg-gray-500 text-white rounded">Cancelar</button>
                <button onclick="crearServicio()" class="px-3 py-1 bg-blue-600 text-white rounded">Guardar</button>
            </div>
        </div>
    </div>

    <!-- MODAL EDITAR -->
    <div id="modalEditar" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
        <div class="bg-white p-6 w-96 rounded shadow">
            <h2 class="text-xl font-bold mb-3">Editar Servicio</h2>

            <input id="editarId" type="hidden">

            <input id="editarNombre" type="text" class="w-full border p-2 rounded mb-2">

            <input id="editarCosto" type="number" class="w-full border p-2 rounded mb-2">

            <textarea id="editarDescripcion" class="w-full border p-2 rounded mb-3"></textarea>

            <div class="flex justify-between">
                <button onclick="cerrarModalEditar()" class="px-3 py-1 bg-gray-500 text-white rounded">Cancelar</button>
                <button onclick="actualizarServicio()" class="px-3 py-1 bg-green-600 text-white rounded">Actualizar</button>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const API_URL = "http://localhost/DisenioWeb2/backEnd/public/servicios";

async function cargarServicios() {
    const res = await fetch(API_URL);
    const data = await res.json();

    const tbody = document.getElementById("tablaServicios");
    tbody.innerHTML = "";

    data.forEach(s => {
        tbody.innerHTML += `
            <tr class="border-b">
                <td class="px-4 py-2">${s.nombreServicio}</td>
                <td class="px-4 py-2">Bs ${s.costoServicio}</td>
                <td class="px-4 py-2">${s.descripcionServicio ?? ""}</td>
                <td class="px-4 py-2">
                    <button onclick="abrirModalEditar(${s.idServicios})" class="px-2 py-1 bg-yellow-500 text-white rounded">Editar</button>
                    <button onclick="eliminarServicio(${s.idServicios})" class="px-2 py-1 bg-red-600 text-white rounded">Eliminar</button>
                </td>
            </tr>
        `;
    });
}

/* ================================
   MODALES
================================ */
function abrirModalCrear() { document.getElementById("modalCrear").classList.remove("hidden"); }
function cerrarModalCrear() { document.getElementById("modalCrear").classList.add("hidden"); }

function abrirModalEditar(id) {
    fetch(API_URL)
        .then(r => r.json())
        .then(lista => {
            const s = lista.find(x => x.idServicios == id);
            document.getElementById("editarId").value = s.idServicios;
            document.getElementById("editarNombre").value = s.nombreServicio;
            document.getElementById("editarCosto").value = s.costoServicio;
            document.getElementById("editarDescripcion").value = s.descripcionServicio;
        });

    document.getElementById("modalEditar").classList.remove("hidden");
}
function cerrarModalEditar() { document.getElementById("modalEditar").classList.add("hidden"); }

/* ================================
   CREAR
================================ */
async function crearServicio() {
    const formData = new FormData();
    formData.append("nombreServicio", document.getElementById("crearNombre").value);
    formData.append("costoServicio", document.getElementById("crearCosto").value);
    formData.append("descripcionServicio", document.getElementById("crearDescripcion").value);

    const res = await fetch(API_URL + "/create", {
        method: "POST",
        body: formData
    });

    const result = await res.json();

    Swal.fire("Éxito", result.message, "success");

    cerrarModalCrear();
    cargarServicios();
    limpiarCrear();
}

/* ================================
   ACTUALIZAR
================================ */
async function actualizarServicio() {
    const id = document.getElementById("editarId").value;

    const formData = new FormData();
    formData.append("nombreServicio", document.getElementById("editarNombre").value);
    formData.append("costoServicio", document.getElementById("editarCosto").value);
    formData.append("descripcionServicio", document.getElementById("editarDescripcion").value);

    const res = await fetch(`${API_URL}/update/${id}`, {
        method: "POST",
        body: formData
    });

    const data = await res.json();

    Swal.fire("Actualizado", data.message, "success");

    cerrarModalEditar();
    cargarServicios();
}

/* ================================
   ELIMINAR
================================ */
async function eliminarServicio(id) {

    const conf = await Swal.fire({
        title: "¿Eliminar servicio?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    });

    if (!conf.isConfirmed) return;

    const res = await fetch(`${API_URL}/delete/${id}`, { method: "POST" });
    const data = await res.json();

    Swal.fire("Eliminado", data.message, "success");

    cargarServicios();
}
function limpiarCrear() {
    document.getElementById("crearNombre").value = "";
    document.getElementById("crearCosto").value = "";
    document.getElementById("crearDescripcion").value = "";
}

cargarServicios();
</script>


</body>
</html>
