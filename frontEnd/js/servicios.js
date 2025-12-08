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