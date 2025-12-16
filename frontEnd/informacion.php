<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>peluquería</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lightbox CSS -->
<!-- Lightbox CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">

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
<!-- ======================================= -->
<!-- SECCIÓN: HISTORIA DE LA EMPRESA -->
<!-- ======================================= -->
<section class="mt-20 p-6 bg-white rounded-2xl shadow-xl" data-aos="fade-up">

    <h2 class="text-4xl font-bold text-orange-500 mb-10 text-center">
        Nuestra Historia
    </h2>

    <div class="grid md:grid-cols-2 gap-10 items-center">

        <!-- Texto izquierda -->
        <div data-aos="fade-right">
            <p class="text-gray-700 text-lg leading-relaxed mb-4">
                Somos una peluquería con años de experiencia dedicados a transformar el estilo 
                de nuestros clientes. Desde nuestros inicios, hemos trabajado con pasión, dedicación 
                y profesionalismo, manteniendo siempre un trato cálido y cercano.
            </p>

            <p class="text-gray-700 text-lg leading-relaxed mb-4">
                A lo largo del tiempo, nuestras habilidades han evolucionado junto con las tendencias 
                modernas con mas desde 30 años de experiencia, convirtiéndonos en referencia local. Nuestro compromiso es ofrecer siempre 
                lo mejor, utilizando productos de alta calidad y métodos actualizados.
            </p>

            <p class="text-gray-700 text-lg leading-relaxed">
                Hoy, seguimos creciendo y ampliando nuestros servicios, manteniendo la esencia que 
                nos distingue: calidad, estilo y confianza. No te pierdas la oportunidad de visitarnos
            </p>
        </div>

        <!-- Imagen derecha -->
        <div data-aos="fade-left">
            <img src="img/lugar.jpeg" 
                 alt="Historia"
                 class="rounded-2xl shadow-lg w-full object-cover h-80">
        </div>

    </div>

</section>

<!-- ======================================= -->
<!-- SECCIÓN: UBICACIÓN -->
<!-- ======================================= -->
<section class="mt-16 p-6 bg-white rounded-2xl shadow-lg" data-aos="fade-up">

    <h2 class="text-4xl font-bold text-orange-500 mb-6 text-center">Nuestra Ubicación</h2>

    <div class="grid md:grid-cols-2 gap-6 items-center">

        <!-- Imagen de ubicación -->
        <img src="img/ubi.jpeg" 
             alt="Mapa ubicación"
             class="rounded-xl shadow-lg w-full object-cover h-80"
             data-aos="zoom-in">

        <!-- Información y enlace GPS -->
        <div class="flex flex-col gap-4">
            <p class="text-lg text-gray-700">
                Encuéntranos fácilmente en nuestra sucursal principal Z/ Pacata Baja, entre la circunvalacion y Vicente Villaroel. Frente al Joe Raque ATM Mercantil stcz.
            </p>

            <a href="https://maps.app.goo.gl/3aL3q16nmatfbWCC7" 
               target="_blank"
               class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl w-fit shadow-md transition flex items-center gap-2">
                <i data-feather="map-pin"></i> Abrir en Google Maps
            </a>
        </div>

    </div>
</section>
<section class="mt-20 p-6 bg-gradient-to-r from-orange-400 to-yellow-300 rounded-2xl shadow-lg" data-aos="fade-up">

    <div class="grid md:grid-cols-3 gap-6">

    <!-- Certificado 1 -->
    <a href="img/chariCI.jpeg" data-lightbox="certificados" data-title="Rosario Canaviri">
        <div class="bg-white rounded-2xl shadow-lg p-4 h-96 w-60 mx-auto hover:scale-105 transition-transform">
            <img src="img/chariCI.jpeg" 
                 alt="Certificado 1"
                 class="rounded-xl h-80 w-full object-cover">
            <h3 class="mt-3 text-center font-bold text-gray-700">Rosario Canaviri</h3>
        </div>
    </a>

    <!-- Certificado 2 -->
    <a href="img/DaynerCI.jpeg" data-lightbox="certificados" data-title="Dayner Alvarez">
        <div class="bg-white rounded-2xl shadow-lg p-4 h-96 w-60 mx-auto hover:scale-105 transition-transform">
            <img src="img/DaynerCI.jpeg"
                 alt="Certificado 2"
                 class="rounded-xl h-80 w-full object-cover">
            <h3 class="mt-3 text-center font-bold text-gray-700">Dayner Alvarez</h3>
        </div>
    </a>

    <!-- Certificado 3 -->
    <a href="img/TonioCI.jpeg" data-lightbox="certificados" data-title="Jose Alvarez">
        <div class="bg-white rounded-2xl shadow-lg p-4 h-96 w-60 mx-auto hover:scale-105 transition-transform">
            <img src="img/TonioCI.jpeg"
                 alt="Certificado 3"
                 class="rounded-xl h-80 w-full object-cover">
            <h3 class="mt-3 text-center font-bold text-gray-700">Jose Alvarez</h3>
        </div>
    </a>

</div>



</section>

<!-- ======================================= -->
<!-- SECCIÓN: TESTIMONIOS -->
<!-- ======================================= -->
<section class="mt-20 p-6 bg-gradient-to-r from-orange-400 to-yellow-300 rounded-2xl shadow-xl" data-aos="fade-up">

    <h2 class="text-4xl font-bold text-white mb-10 text-center">
        Lo Que Dicen Nuestros Clientes
    </h2>

    <!-- Contenedor scroll horizontal -->
    <div class="flex gap-6 overflow-x-auto pb-4 scroll-smooth"
         style="scrollbar-width: thin;"
         data-aos="zoom-in">

        <!-- Testimonio 1 -->
        <div class="min-w-[300px] bg-white p-6 rounded-2xl shadow-lg flex flex-col gap-4">
            <p class="text-gray-700 italic">
                “Excelente atención y trabajo profesional. Siempre salgo con un look increíble.”
            </p>
            <span class="font-bold text-orange-500">— Andrea M.</span>
        </div>

        <!-- Testimonio 2 -->
        <div class="min-w-[300px] bg-white p-6 rounded-2xl shadow-lg flex flex-col gap-4">
            <p class="text-gray-700 italic">
                “Ambiente agradable, personal capacitado y resultados garantizados. Recomendado.”
            </p>
            <span class="font-bold text-orange-500">— Luis R.</span>
        </div>

        <!-- Testimonio 3 -->
        <div class="min-w-[300px] bg-white p-6 rounded-2xl shadow-lg flex flex-col gap-4">
            <p class="text-gray-700 italic">
                “La mejor peluquería de la zona. Cortes modernos y muy buena atención.”
            </p>
            <span class="font-bold text-orange-500">— Carla G.</span>
        </div>

        <!-- Testimonio 4 -->
        <div class="min-w-[300px] bg-white p-6 rounded-2xl shadow-lg flex flex-col gap-4">
            <p class="text-gray-700 italic">
                “Volveré sin duda. Me encantó el servicio y la dedicación en cada detalle.”
            </p>
            <span class="font-bold text-orange-500">— Marco A.</span>
        </div>

    </div>

    <!-- Botones izquierda / derecha -->
    <div class="flex justify-center mt-6 gap-4">
        <button onclick="document.getElementById('testimonios').scrollBy({left: -300, behavior:'smooth'})"
                class="bg-black/30 hover:bg-black/50 text-white px-4 py-2 rounded-xl">
            ◄
        </button>

        <button onclick="document.getElementById('testimonios').scrollBy({left: 300, behavior:'smooth'})"
                class="bg-black/30 hover:bg-black/50 text-white px-4 py-2 rounded-xl">
            ►
        </button>
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

AOS.init({
    duration: 900,
    once: false,
    easing: 'ease-out-cubic'
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
    <!-- Lightbox JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
2️⃣ Modificar las tarjetas de certificados para abrir en Lightbox
html
Copiar código

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration:800, once:false});</script>
    <script src="js/servicios2.js"></script>
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
