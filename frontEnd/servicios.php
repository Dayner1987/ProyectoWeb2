<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>peluquería</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lightbox CSS -->

  <link rel="stylesheet" href="gallery/dist/css/lightbox.min.css">

    <!-- Librerías adicionales -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- AOS Animations -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/index.css">
</head>
<body class="bg-gray-50 font-sans">

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
                    <a href="index.php" class="text-orange-400 hover:text-orange-300 transition">Inicio</a>
                    <a href="informacion.php" class="text-orange-400 hover:text-orange-300 transition">Información</a>
                    <a href="servicios.php" class="text-orange-400 hover:text-orange-300 transition">Servicios</a>
                    <a href="galeria.php" class="text-orange-400 hover:text-orange-300 transition">Galería</a>
                    <a href="/DisenioWeb2/backEnd/public/login" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 rounded-lg text-white font-semibold transition">Iniciar Sesión</a>
                </nav>

                <!-- Menú Hamburguesa -->
                <div class="md:hidden flex items-center">
                    <button id="menu-btn" class="text-white focus:outline-none">
                        <i data-feather="menu" class="w-8 h-8"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menú móvil -->
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-4 space-y-2 text-orange-400 text-lg">
            <a href="#inicio" class="block hover:text-orange-300">Inicio</a>
            <a href="#nosotros" class="block hover:text-orange-300">Informaciion</a>
            <a href="#servicios" class="block hover:text-orange-300">Servicios</a>
           
            <a href="/DisenioWeb2/backEnd/public/login" class="block hover:text-orange-300 font-semibold">Iniciar Sesión</a>
        </div>
    </header>

    <!-- Contenido principal -->
    <main class="pt-32 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="rounded-2xl shadow-xl p-6 flex flex-col md:flex-row gap-6 items-center 
            bg-gradient-to-r from-orange-400 via-orange-300 to-yellow-200" 
     data-aos="fade-up">
    <!-- Logo dinámico de la empresa -->
    <img id="empresaLogo" src="img/default-logo.png" alt="Logo Empresa" class="w-64 rounded-xl shadow-md" data-aos="fade-right">

    <div data-aos="fade-left">
        <h2 class="text-4xl font-bold text-white mb-4">
            Bienvenidos a <span id="empresaNombreHeader">Reflejos</span>
        </h2>
        <p class="text-white/90 mb-6">
            Transformamos tu estilo con cortes modernos y atención profesional.
        </p>
    </div>
</div>

<section class="mt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
    <h2 class="text-4xl font-bold text-center text-orange-500 mb-10">Nuestros Servicios</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Servicio 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-lg hover:scale-105 transition transform" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-2xl font-bold text-orange-400 mb-2">Corte de cabello</h3>
            <p class="text-gray-700">Corte d ecabello para Varón y mujer a gusto del cliente o con referencia de consejos y reocmendaciones.</p>
        </div>

        <!-- Servicio 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-lg hover:scale-105 transition transform" data-aos="fade-up" data-aos-delay="200">
            <h3 class="text-2xl font-bold text-orange-400 mb-2">Maquillaje + Peinado</h3>
            <p class="text-gray-700">Maquillaje a gusto del cliente con su toque especial de genialidad para el cuidado personal.</p>
        </div>

        <!-- Servicio 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-lg hover:scale-105 transition transform" data-aos="fade-up" data-aos-delay="300">
            <h3 class="text-2xl font-bold text-orange-400 mb-2">Tinte de cabello</h3>
            <p class="text-gray-700">Con las ultimas tendencias de la colorimetria con su tecnica de balayage, californianas, degradado o aplicaión de retoque.</p>
        </div>
    </div>
</section>
<section class="mt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
    <h2 class="text-4xl font-bold text-center text-orange-600 mb-10 tracking-wide drop-shadow-md">
        Precios de Nuestros Servicios
    </h2>

    <div class="overflow-x-auto rounded-2xl shadow-xl bg-white">
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gradient-to-r from-orange-500 to-yellow-400 text-white">
                <tr>
                    <th class="px-6 py-4 text-left text-lg font-semibold tracking-wide">Servicio</th>
                    <th class="px-6 py-4 text-left text-lg font-semibold tracking-wide">Precio</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 text-gray-700 text-base">
                
                <!-- 1 -->
                <tr class="hover:bg-orange-50 transition-all">
                    <td class="px-6 py-3 font-medium">Corte de Cabello</td>
                    <td class="px-6 py-3">50 Bs.</td>
                </tr>

                <!-- 2 -->
                <tr class="hover:bg-orange-50 transition-all">
                    <td class="px-6 py-3 font-medium">Coloración</td>
                    <td class="px-6 py-3">80 Bs.</td>
                </tr>

                <!-- 3 -->
                <tr class="hover:bg-orange-50 transition-all">
                    <td class="px-6 py-3 font-medium">Peinado</td>
                    <td class="px-6 py-3">40 Bs.</td>
                </tr>

                <!-- 4 -->
                <tr class="hover:bg-orange-50 transition-all">
                    <td class="px-6 py-3 font-medium">Barbería Premium</td>
                    <td class="px-6 py-3">45 Bs.</td>
                </tr>

                <!-- 5 -->
                <tr class="hover:bg-orange-50 transition-all">
                    <td class="px-6 py-3 font-medium">Planchado Profesional</td>
                    <td class="px-6 py-3">35 Bs.</td>
                </tr>

                <!-- 6 -->
                <tr class="hover:bg-orange-50 transition-all">
                    <td class="px-6 py-3 font-medium">Tratamiento Capilar Hidratante</td>
                    <td class="px-6 py-3">60 Bs.</td>
                </tr>

                <!-- 7 -->
                <tr class="hover:bg-orange-50 transition-all">
                    <td class="px-6 py-3 font-medium">Keratina</td>
                    <td class="px-6 py-3">120 Bs.</td>
                </tr>

                <!-- 8 -->
                <tr class="hover:bg-orange-50 transition-all">
                    <td class="px-6 py-3 font-medium">Permanente</td>
                    <td class="px-6 py-3">95 Bs.</td>
                </tr>

                <!-- 9 -->
                <tr class="hover:bg-orange-50 transition-all">
                    <td class="px-6 py-3 font-medium">Depilación Facial</td>
                    <td class="px-6 py-3">25 Bs.</td>
                </tr>

                <!-- 10 -->
                <tr class="hover:bg-orange-50 transition-all">
                    <td class="px-6 py-3 font-medium">Maquillaje Social</td>
                    <td class="px-6 py-3">110 Bs.</td>
                </tr>

                <!-- 11 -->
                <tr class="hover:bg-orange-50 transition-all">
                    <td class="px-6 py-3 font-medium">Manicure</td>
                    <td class="px-6 py-3">30 Bs.</td>
                </tr>

                <!-- 12 -->
                <tr class="hover:bg-orange-50 transition-all">
                    <td class="px-6 py-3 font-medium">Pedicure</td>
                    <td class="px-6 py-3">35 Bs.</td>
                </tr>

                <!-- 13 -->
                <tr class="hover:bg-orange-50 transition-all">
                    <td class="px-6 py-3 font-medium">Masaje Relajante</td>
                    <td class="px-6 py-3">90 Bs.</td>
                </tr>

            </tbody>
        </table>
    </div>
</section>



<!-- Sección Últimas Novedades -->
<section class="mt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up">
    <h2 class="text-4xl font-bold text-center text-orange-500 mb-10">Servicios Novedosos</h2>

    <div class="relative overflow-hidden">
        
        <div id="carruselNovedades" class="flex gap-6 transition-transform duration-500">
            <!-- Se cargan dinámicamente -->
        </div>

        <!-- Botones -->
        <button id="prevNovedades"
            class="absolute left-0 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white px-3 py-2 rounded-full shadow-xl">
            ◄
        </button>

        <button id="nextNovedades"
            class="absolute right-0 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white px-3 py-2 rounded-full shadow-xl">
            ►
        </button>
    </div>
</section>

<script>
const API_URL = "http://localhost/DisenioWeb2/backEnd/public/servicios";

const carrusel = document.getElementById('carruselNovedades');
let index = 0;
let serviciosData = [];

async function cargarServiciosNovedades() {
    try {
        const res = await fetch(API_URL);
        const data = await res.json();

        // Obtener solo LOS 4 MÁS RECIENTES
        serviciosData = data.slice(-4);

        carrusel.innerHTML = serviciosData.map(s => `
            <div class="min-w-[300px] bg-white p-5 rounded-2xl shadow-lg hover:scale-105 transition transform">
                <h3 class="text-xl font-bold text-orange-400 mb-2">${s.nombreServicio}</h3>
                <p class="text-gray-700">${s.descripcionServicio ?? 'Descripción breve...'}</p>
            </div>
        `).join('');

    } catch (err) {
        console.error("Error al cargar los servicios:", err);
    }
}

document.getElementById('nextNovedades').addEventListener('click', () => {
    if (index < serviciosData.length - 1) index++;
    carrusel.style.transform = `translateX(-${index * 320}px)`;
});

document.getElementById('prevNovedades').addEventListener('click', () => {
    if (index > 0) index--;
    carrusel.style.transform = `translateX(-${index * 320}px)`;
});

cargarServiciosNovedades();
</script>

<section class="mt-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
    <h2 class="text-4xl font-bold text-orange-500 mb-6">Código QR de la Empresa</h2>

    <div class="text-center mt-10">
<section class="py-10 flex justify-center">
    <img src="img/QrEjemplo.jpg" 
         class="w-72 h-72 rounded-xl shadow-2xl border"
         alt="QR">
</section>


    </div>
<div class="mt-6">
    <a id="btnEnviarQR"
       href="https://wa.me/59172751531?text=Hola,%20aquí%20está%20el%20QR%20de%20la%20empresa."
       target="_blank"
       class="px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded-xl shadow-lg font-bold text-lg">
        Enviar QR por WhatsApp
    </a>
</div>

</section>



    </main>
<!-- Botón Scroll Top -->
<button id="scrollTopBtn"
    class="fixed bottom-6 right-6 bg-orange-600 text-white w-12 h-12 rounded-full
           shadow-xl flex items-center justify-center text-2xl font-bold
           opacity-0 pointer-events-none transition-all duration-300 z-50">
    ↑
</button>
<script>
    const scrollBtn = document.getElementById("scrollTopBtn");

    window.addEventListener("scroll", () => {
        if (window.scrollY > 300) {
            scrollBtn.classList.remove("opacity-0", "pointer-events-none");
        } else {
            scrollBtn.classList.add("opacity-0", "pointer-events-none");
        }
    });

    scrollBtn.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
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
    <script src="gallery/dist/js/lightbox-plus-jquery.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration:800, once:false});</script>
    <script src="js/main.js"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'fadeDuration': 200,
        'imageFadeDuration': 200,
        'wrapAround': true,
        'alwaysShowNavOnTouchDevices': true,
        'fitImagesInViewport': true,
        'showImageNumberLabel': true,
        'positionFromTop': 50
    });
</script>

</body>
</html>
