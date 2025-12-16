let disponibilidadesActuales = [];


// ======================================================
// CARGAR SERVICIOS DEL EMPLEADO + TODOS LOS SERVICIOS
// ======================================================
Promise.all([
    fetch("http://localhost/DisenioWeb2/backEnd/public/servicios").then(r => r.json()),
    fetch("http://localhost/DisenioWeb2/backEnd/public/servicio-empleado").then(r => r.json())
])
.then(([todosServicios, misServicios]) => {

    // Convertir IDs a número
    misServicios = misServicios.map(Number);

    const tabla = document.getElementById("tablaServicios");
    tabla.innerHTML = "";

    todosServicios.forEach(s => {

        const activado = misServicios.includes(Number(s.idServicios));

        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td class="p-2">${s.nombreServicio}</td>
            <td class="p-2 text-center">
                <label class="inline-flex items-center cursor-pointer">

                    <input type="checkbox" ${activado ? "checked" : ""} 
                        onchange="toggleServicio(${s.idServicios}, this.checked)"
                        class="sr-only peer">

                    <div class="w-11 h-6 rounded-full transition
                        ${activado ? "bg-green-600" : "bg-gray-300"} 
                        peer-checked:bg-green-600">
                    </div>

                </label>
            </td>
        `;
        tabla.appendChild(tr);
    });
cargarServicios();
});



// ======================================================
// CARGAR DISPONIBILIDADES REALES DESDE BD
// ======================================================
function cargarDisponibilidades() {
    fetch("http://localhost/DisenioWeb2/backEnd/public/disponibilidades")
        .then(r => r.json())
        .then(data => {
            disponibilidadesActuales = data; // ← Guardamos en memoria

            const tabla = document.getElementById("tablaDisp");
            tabla.innerHTML = "";

            data.forEach(d => {
                const tr = document.createElement("tr");

                tr.innerHTML = `
                    <td class="p-2">${d.fecha}</td>
                    <td class="p-2">${d.horaInicio}</td>
                    <td class="p-2">${d.horaFin}</td>
                    <td class="p-2 text-center">
                        <button onclick="eliminarDisp(${d.idDisponibilidad})"
                            class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-white">
                            Eliminar
                        </button>
                    </td>
                `;

                tabla.appendChild(tr);
            });
        });
}
function hayCruce(fecha, inicio, fin) {
    // Convertir a minutos
    function aMinutos(h) {
        const [H, M] = h.split(":");
        return parseInt(H) * 60 + parseInt(M);
    }

    const iniNuevo = aMinutos(inicio);
    const finNuevo = aMinutos(fin);

    return disponibilidadesActuales.some(d => {

        if (d.fecha !== fecha) return false; // solo validar fecha igual

        const iniExist = aMinutos(d.horaInicio);
        const finExist = aMinutos(d.horaFin);

        // Detectar cruce
        return iniNuevo < finExist && finNuevo > iniExist;
    });
}


cargarDisponibilidades();

// ======================================================
// ELIMINAR DISPONIBILIDAD
// ======================================================
function eliminarDisp(id) {
    Swal.fire({
        title: "¿Eliminar?",
        text: "Esta disponibilidad será eliminada definitivamente.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#f97316",
        cancelButtonColor: "#555",
        confirmButtonText: "Sí, eliminar"
    }).then(result => {
        if (result.isConfirmed) {
            fetch(`http://localhost/DisenioWeb2/backEnd/public/disponibilidades/delete/${id}`, {
                method: "POST"
            })
            .then(r => r.json())
            .then(data => {
                Swal.fire("Listo", data.message, "success");
                cargarDisponibilidades();
                cargarServicios();

            });
        }
    });
}

// ======================================================
// PICKERS
// ======================================================
flatpickr("#fecha", {
    dateFormat: "Y-m-d",
    minDate: "today",
    defaultDate: null,
    allowInput: false,
    disableMobile: true,
    disable: [
        {
            from: "1900-01-01",
            to: new Date().fp_incr(-1)
        }
    ],
    onOpen: function(selectedDates, dateStr, instance) {
        instance.clear();
    }
});


flatpickr("#horaInicio", { enableTime: true, noCalendar: true, dateFormat: "H:i" });
flatpickr("#horaFin", { enableTime: true, noCalendar: true, dateFormat: "H:i" });

// ======================================================
// GUARDAR DISPONIBILIDAD
// ======================================================
document.getElementById("formDisp").addEventListener("submit", e => {
    e.preventDefault();

    const fecha = document.getElementById("fecha").value;
    const inicio = document.getElementById("horaInicio").value;
    const fin = document.getElementById("horaFin").value;
    const error = document.getElementById("errorHoras");

    // Validación de cruce
    if (hayCruce(fecha, inicio, fin)) {
        error.textContent = "⚠ Ya existe una disponibilidad que se cruza con este horario.";
        error.classList.remove("hidden");
        return;
    }

    // Si todo ok → ocultar error
    error.classList.add("hidden");
    error.textContent = "";

    const datos = new URLSearchParams(new FormData(e.target));

    fetch("http://localhost/DisenioWeb2/backEnd/public/disponibilidades/create", {
        method: "POST",
        body: datos
    })
    .then(r => r.json())
    .then(data => {
        Swal.fire("Listo", data.message, "success");
        e.target.reset();
        cargarDisponibilidades();
        cargarServicios();
    });
});

function cargarServicios() {
    Promise.all([
        fetch("http://localhost/DisenioWeb2/backEnd/public/servicios").then(r => r.json()),
        fetch("http://localhost/DisenioWeb2/backEnd/public/servicio-empleado").then(r => r.json())
    ])
    .then(([todosServicios, misServicios]) => {
        misServicios = misServicios.map(Number);
        const tabla = document.getElementById("tablaServicios");
        tabla.innerHTML = "";

        todosServicios.forEach(s => {
            const activado = misServicios.includes(Number(s.idServicios));

            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td class="p-2">${s.nombreServicio}</td>
                <td class="p-2 text-center">
                    <label class="inline-flex items-center cursor-pointer">

                        <input type="checkbox" ${activado ? "checked" : ""}
                            onchange="toggleServicio(${s.idServicios}, this.checked)"
                            class="sr-only peer">

                        <div class="w-11 h-6 rounded-full transition
                            ${activado ? "bg-green-600" : "bg-gray-300"} 
                            peer-checked:bg-green-600">
                        </div>

                    </label>
                </td>
            `;
            tabla.appendChild(tr);
        });
    });
}

function toggleServicio(id, activo) {
    const url = activo
        ? "http://localhost/DisenioWeb2/backEnd/public/servicio-empleado/add"
        : `http://localhost/DisenioWeb2/backEnd/public/servicio-empleado/remove/${id}`;

    fetch(url, {
        method: "POST",
        body: activo ? JSON.stringify({ servicio_id: id }) : null
    })
    .then(r => r.json())
    .then(data => {

        cargarServicios();
    });
}

