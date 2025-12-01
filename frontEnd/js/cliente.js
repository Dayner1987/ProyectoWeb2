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

    // cargar empresa QR (igual que antes)
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

    // flatpickr
    flatpickr("#fechaSelect", { dateFormat: "Y-m-d", minDate: "today", allowInput: false });

    // cargar servicios
    const respServicios = await fetch('/DisenioWeb2/backEnd/public/servicios');
    const servicios = await respServicios.json();
    servicios.forEach(s => {
        servicioSelect.innerHTML += `<option value="${s.idServicios}">${s.nombreServicio}</option>`;
    });

    // al cambiar servicio → empleados
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

    // cargar horas para el empleado+fecha
    fechaSelect.addEventListener('change', async () => {
        const empleadoId = empleadoSelect.value;
        const fecha = fechaSelect.value;
        if (!empleadoId || !fecha) return;
        horaSelect.innerHTML = '<option>Cargando...</option>';
        try {
            const resp = await fetch(`/DisenioWeb2/backEnd/public/disponibilidades/horas?empleado_id=${empleadoId}&fecha=${fecha}`);
            const data = await resp.json();

            horaSelect.innerHTML = '<option value="">-- Elige hora --</option>';

            // Aquí esperamos que data.horas sea un array de objetos {idDisponibilidad, horaInicio}
            if (data.success && Array.isArray(data.horas)) {
                data.horas.forEach(h => {
                    // Si el backend devuelve objetos, usamos la id; si devuelve string, lo mostramos pero advertimos
                    if (h.idDisponibilidad && h.horaInicio) {
                        horaSelect.innerHTML += `<option value="${h.idDisponibilidad}">${h.horaInicio}</option>`;
                    } else {
                        // fallback — mostrará la hora como value (esto provocará error en backend)
                        horaSelect.innerHTML += `<option value="${h}">${h}</option>`;
                    }
                });
            } else if (Array.isArray(data)) {
                // Si el endpoint devolvió directamente un array simple
                data.forEach(h => horaSelect.innerHTML += `<option value="${h}">${h}</option>`);
            } else {
                horaSelect.innerHTML = '<option value="">No hay horas disponibles</option>';
            }
        } catch(err) {
            console.error("Error cargando horas:", err);
            horaSelect.innerHTML = '<option value="">Error cargando horas</option>';
        }
    });

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

    // único submit handler (depurado)
    form.addEventListener('submit', async e => {
        e.preventDefault();

        const serviciosArr = [];
        const servicioId = servicioSelect.value;
        if (servicioId) serviciosArr.push(servicioId);

        const payload = {
            disponibilidad_id: horaSelect.value,
            detalle: form.querySelector('textarea[name="detalle"]').value,
            servicios: serviciosArr
        };

        // DEBUG: ver qué estamos enviando
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
