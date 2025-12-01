document.addEventListener('DOMContentLoaded', async () => {

    const servicioSelect = document.getElementById('servicioSelect');
    const empleadoSelect = document.getElementById('empleadoSelect');
    const fechaSelect = document.getElementById('fechaSelect');
    const horaSelect = document.getElementById('horaSelect');
    const pagoSelect = document.getElementById('pagoSelect');
    const metodoPagoSection = document.getElementById('metodoPagoSection');
    const qrBox = document.getElementById('qrBox');
    const whatsappBtn = document.getElementById('whatsappBtn');
    const form = document.getElementById('reservaForm');

    // =========================
    // Cargar QR de empresa
    // =========================
    let empresaQR = null;
    async function cargarEmpresaCliente() {
        try {
            const res = await fetch('/DisenioWeb2/backEnd/public/empresa');
            const data = await res.json();
            empresaQR = data?.imageQR ? `/DisenioWeb2/backEnd/public${data.imageQR}` : 'img/default-qr.png';
        } catch(err) {
            console.error("Error cargando empresa:", err);
            empresaQR = 'img/default-qr.png';
        }
    }
    await cargarEmpresaCliente();

    // =========================
    // Flatpickr para fecha
    // =========================
    flatpickr("#fechaSelect", { dateFormat: "Y-m-d", minDate: "today", allowInput: false });

    // =========================
    // Cargar servicios
    // =========================
    const respServicios = await fetch('/DisenioWeb2/backEnd/public/servicios');
    const servicios = await respServicios.json();
    servicios.forEach(s => {
        servicioSelect.innerHTML += `<option value="${s.idServicios}">${s.nombreServicio}</option>`;
    });

    // =========================
    // Cambiar servicio → cargar empleados
    // =========================
    servicioSelect.addEventListener('change', async () => {
        const servicioId = servicioSelect.value;
        empleadoSelect.innerHTML = '<option value="">-- Elige un empleado --</option>';
        horaSelect.innerHTML = '<option value="">-- Selecciona fecha primero --</option>';
        fechaSelect.value = "";
        metodoPagoSection.classList.add('hidden');
        if (!servicioId) return;

        const respEmp = await fetch(`/DisenioWeb2/backEnd/public/servicio-empleado/servicio/${servicioId}`);
        const empleados = await respEmp.json();
        empleados.forEach(e => {
            empleadoSelect.innerHTML += `<option value="${e.idUsuarios}">${e.nombreUsuario}</option>`;
        });
    });

    empleadoSelect.addEventListener('change', () => {
        fechaSelect.value = "";
        horaSelect.innerHTML = '<option value="">-- Selecciona fecha primero --</option>';
        metodoPagoSection.classList.add('hidden');
    });

    // =========================
    // Cargar horas disponibles para empleado+fecha
    // =========================
    fechaSelect.addEventListener('change', async () => {
        const empleadoId = empleadoSelect.value;
        const fecha = fechaSelect.value;
        if (!empleadoId || !fecha) return;

        horaSelect.innerHTML = '<option>Cargando...</option>';

        try {
            const resp = await fetch(`/DisenioWeb2/backEnd/public/disponibilidades/horas?empleado_id=${empleadoId}&fecha=${fecha}`);
            const data = await resp.json();

            horaSelect.innerHTML = '<option value="">-- Elige hora --</option>';

            if (data.success && Array.isArray(data.horas)) {
                data.horas.forEach(h => {
                    if (h.idDisponibilidad && h.horaInicio) {
                        // Guardamos valor como "hora|idDisponibilidad"
                        horaSelect.innerHTML += `<option value="${h.horaInicio}|${h.idDisponibilidad}">${h.horaInicio}</option>`;
                    }
                });
            } else {
                horaSelect.innerHTML = '<option value="">No hay horas disponibles</option>';
            }
        } catch(err) {
            console.error("Error cargando horas:", err);
            horaSelect.innerHTML = '<option value="">Error cargando horas</option>';
        }
    });

    // =========================
    // Mostrar método de pago
    // =========================
    horaSelect.addEventListener('change', () => {
        metodoPagoSection.classList.toggle('hidden', !horaSelect.value);
    });

    pagoSelect.addEventListener('change', () => {
        qrBox.classList.add('hidden');
        whatsappBtn.classList.add('hidden');
        const metodo = pagoSelect.value;
        if (metodo === "qr") {
            document.getElementById('empresaQR').src = empresaQR;
            qrBox.classList.remove('hidden');
        }
        if (metodo !== "") {
            const mensaje = encodeURIComponent("Hola, envío el comprobante de mi reserva. Gracias!");
            whatsappBtn.href = `https://wa.me/+59177975489?text=${mensaje}`;
            whatsappBtn.classList.remove('hidden');
        }
    });

    // =========================
    // Submit reserva
    // =========================
    form.addEventListener('submit', async e => {
        e.preventDefault();

        const serviciosArr = [];
        const servicioId = servicioSelect.value;
        if (servicioId) serviciosArr.push(servicioId);

        if (!horaSelect.value) {
            alert("Debes seleccionar una hora válida");
            return;
        }

        // separar horaExacta y idDisponibilidad
        let [hora, disponibilidadId] = horaSelect.value.split('|');

     

        const payload = {
            disponibilidad_id: disponibilidadId,
            hora: hora,
            detalle: form.querySelector('textarea[name="detalle"]').value,
            servicios: serviciosArr
        };

        console.log("payload reserva:", payload);

        try {
            const resp = await fetch('/DisenioWeb2/backEnd/public/reservas/create', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            const result = await resp.json();
            console.log("respuesta server:", result);

            if (result.success) {
                alert('Reserva creada con éxito');
                window.location.reload();
            } else {
                alert(result.message || 'Error al crear reserva');
            }
        } catch(err) {
            console.error(err);
            alert('Error al enviar la reserva');
        }
    });

});
