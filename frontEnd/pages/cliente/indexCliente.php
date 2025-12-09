<?php
session_start();

// Si no está logueado, redirigir
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

$clienteId = $_SESSION['user']['idUsuarios'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peluqueria-barberia</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lightbox CSS -->
    <link rel="stylesheet" href="css/lightbox.min.css">

    <!-- Librerías adicionales -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- AOS Animations -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/index.css">
</head>
<body class="bg-gray-50 font-sans pt-0">


    <!-- Fondo personalizable -->
    <div class="fixed inset-0 -z-10 bg-cover bg-center opacity-95" id="fondoPersonalizado"></div>

    <!-- Navbar moderno -->
    <header id="navbar" class="bg-transparent fixed w-full z-50 transition-colors duration-500 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
               
                <div class="flex items-center gap-4">
                    <span id="empresaNombre" class="text-3xl font-bold text-orange-400 drop-shadow-md">Peluquería Reflejos</span>
                </div>

               <!-- Menú escritorio -->
                <nav class="hidden md:flex items-center space-x-10 text-lg">
                    <a href="../../index.php" class="text-orange-400 hover:text-orange-300 transition">Inicio</a>
                    <a href="../../informacion.php" class="text-orange-400 hover:text-orange-300 transition">Información</a>
                    <a href="../../servicios.php" class="text-orange-400 hover:text-orange-300 transition">Servicios</a>
                    <a href="../../galeria.php" class="text-orange-400 hover:text-orange-300 transition">Galeria</a>
                    <button id="logoutBtn" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 rounded-lg text-white font-semibold transition">
  Cerrar Sesión
</button>
<script>
document.getElementById('logoutBtn').addEventListener('click', async () => {
    try {
        await fetch('/DisenioWeb2/backEnd/public/logout', { method: 'POST' });
        window.location.href = '/DisenioWeb2/backEnd/public/login';
    } catch(err) {
        console.error('Error cerrando sesión:', err);
    }
});
</script>

<script>
document.getElementById('logoutBtn').addEventListener('click', async () => {
    try {
        await fetch('/DisenioWeb2/backEnd/public/logout', { method: 'POST' });
        window.location.href = '/DisenioWeb2/backEnd/public/login';
    } catch(err) {
        console.error('Error cerrando sesión:', err);
    }
});
</script>

                </nav>

                <!-- Menú Hamburguesa -->
                <div class="md:hidden flex items-center">
                    <button id="menu-btn" class="text-white focus:outline-none">
                        <i data-feather="menu" class="w-8 h-8"></i>
                    </button>
                </div>
            </div>
        </div>

    </header>
<section class="pt-28">
    <div class="flex justify-between items-center max-w-5xl mx-auto mt-6 px-4">
        <h2 class="text-2xl font-semibold text-gray-700">Reservas pendientes</h2>
        <a href="reservasC.php" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded font-semibold">
            Crear nueva reserva
        </a>
    </div>
</section>

    

<main class="max-w-5xl mx-auto mt-6 bg-white shadow-lg rounded-lg p-6">

    <table class="w-full text-left border border-gray-300 rounded-lg overflow-hidden">
        <thead class="bg-orange-500 text-white">
            <tr>
                <th class="py-3 px-4">Fecha</th>
                <th class="py-3 px-4">Hora</th>
                <th class="py-3 px-4">Empleado</th>
                <th class="py-3 px-4">Servicios</th>
                <th class="py-3 px-4">Estado</th>
                <th class="py-3 px-4">Acciones</th> <!-- nueva columna -->
            </tr>
        </thead>
        <tbody id="tablaReservas" class="divide-y divide-gray-200 bg-white">
            <tr>
                <td colspan="6" class="py-4 text-center text-gray-400">
                    Cargando reservas...
                </td>
            </tr>
        </tbody>
    </table>

</main>

<script>
document.addEventListener("DOMContentLoaded", cargarReservas);

async function cargarReservas() {
    const clienteId = <?= json_encode($clienteId); ?>;
    const tbody = document.getElementById("tablaReservas");

    try {
        const resp = await fetch(`/DisenioWeb2/backEnd/public/reservas/cliente/${clienteId}`);

        if (!resp.ok) {
            tbody.innerHTML = `
                <tr><td colspan="6" class="py-4 text-center text-red-500">
                    Error cargando reservas (HTTP ${resp.status})
                </td></tr>`;
            return;
        }

        const reservas = await resp.json();

        if (!Array.isArray(reservas) || reservas.length === 0) {
            tbody.innerHTML = `
                <tr><td colspan="6" class="py-4 text-center text-gray-500">
                    No hiciste ninguna reserva todavía.
                </td></tr>`;
            return;
        }

        // Renderizar tabla completa
        tbody.innerHTML = reservas.map(r => `
            <tr>
                <td class="py-3 px-4">${r.fecha || '--'}</td>
                <td class="py-3 px-4">${r.hora || '--'}</td>
                <td class="py-3 px-4">${r.empleado || '—'}</td>
                <td class="py-3 px-4 text-sm text-gray-700">
                    ${Array.isArray(r.servicios) ? r.servicios.join(', ') : '—'}
                </td>
                <td class="py-3 px-4">
                    <span class="px-3 py-1 rounded-full text-white text-sm 
                        ${r.estado === 'pendiente' ? 'bg-yellow-500' :
                          r.estado === 'confirmada' ? 'bg-green-600' : 'bg-red-500'}">
                        ${r.estado}
                    </span>
                </td>
                <td class="py-3 px-4">
                    <button onclick="eliminarReserva(${r.idReservas})"
                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                        Eliminar
                    </button>
                </td>
            </tr>
        `).join("");

    } catch(err) {
        console.error(err);
        tbody.innerHTML = `
            <tr><td colspan="6" class="py-4 text-center text-red-500">
                Error cargando reservas.
            </td></tr>`;
    }
}

// ======================================================
// FUNCIÓN PARA ELIMINAR RESERVA
// ======================================================
async function eliminarReserva(id) {
    if (!confirm("¿Seguro que deseas eliminar esta reserva?")) return;

    try {
        const resp = await fetch(`/DisenioWeb2/backEnd/public/reservas/${id}`, {
            method: "DELETE"
        });

        const result = await resp.json();

        if (result.success) {
            alert("Reserva eliminada correctamente");
            cargarReservas(); // recargar tabla
        } else {
            alert("No se pudo eliminar la reserva");
        }

    } catch (err) {
        console.error(err);
        alert("Error al eliminar la reserva");
    }
}
</script>

    <!-- Footer dinámico con fondo negro y acento naranja -->
    <footer class="mt-20 bg-black text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-3 gap-6">
            <div class="flex flex-col items-start gap-2">
                <img id="empresaLogo2" src="img/default-logo.png" alt="Logo Empresa" class="w-64 rounded-xl shadow-md" data-aos="fade-right">
                <h2 id="empresaNombreFooter" class="text-xl font-bold text-orange-500">Peluquería Reflejos</h2>
            </div>
            <div class="flex flex-col gap-2">
                <h3 class="font-semibold text-orange-400 text-lg">Contacto</h3>
                <a id="footerWhatsApp" href="#" class="hover:text-orange-300 transition">WhatsApp: +591 77975489</a>
                <a id="footerCorreo" href="#" class="hover:text-orange-300 transition">Correo: info@peluqueria.com</a>
                <p id="footerDireccion" class="hover:text-orange-300 transition">Dirección: Calle Falsa 123, La Paz</p>
            </div>
            <div class="flex flex-col gap-2">
                <h3 class="font-semibold text-orange-400 text-lg">Síguenos</h3>
                <div class="flex gap-4">
                    <a href="https://www.instagram.com/antonio_barber7?igsh=MTZvMWl6ZWV5d2M3aA==" class="hover:text-orange-300"><i data-feather="instagram"></i></a>
                    <a href="https://www.facebook.com/share/16j9J4wzD6/" class="hover:text-orange-300"><i data-feather="facebook"></i></a>
                    <a href="https://api.whatsapp.com/send/?phone=59172751531&text=Hola%2C+aqu%C3%AD+est%C3%A1+el+QR+de+la+empresa.&type=phone_number&app_absent=0" class="hover:text-orange-300"><i data-feather="phone"></i></a> <!-- WhatsApp -->
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="js/lightbox-plus-jquery.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration:800, once:false});</script>
    <script src="../../js/info.js"></script>

</body>
</html>
