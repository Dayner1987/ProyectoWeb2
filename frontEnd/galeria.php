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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>

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
                    <a href="galeria.php" class="text-orange-400 hover:text-orange-300 transition">GalerÍa</a>
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
<!-- LightGallery CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery.min.css">

<section class="mt-20 max-w-7xl mx-auto px-4" data-aos="fade-up">
    <h2 class="text-4xl font-bold text-center text-orange-500 mb-10">
        Galería de Trabajos
    </h2>

    <div id="galeria" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        
        <!-- IMÁGENES -->
        <a href="img/img2/1.jpeg" class="gallery-item">
            <img src="img/img2/1.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/2.jpeg" class="gallery-item">
            <img src="img/img2/2.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/3.jpeg" class="gallery-item">
            <img src="img/img2/3.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/4.jpeg" class="gallery-item">
            <img src="img/img2/4.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/5.jpeg" class="gallery-item">
            <img src="img/img2/5.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/6.jpeg" class="gallery-item">
            <img src="img/img2/6.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/7.jpeg" class="gallery-item">
            <img src="img/img2/7.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/8.jpeg" class="gallery-item">
            <img src="img/img2/8.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/9.jpeg" class="gallery-item">
            <img src="img/img2/9.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/10.jpeg" class="gallery-item">
            <img src="img/img2/10.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/11.jpeg" class="gallery-item">
            <img src="img/img2/11.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/12.jpeg" class="gallery-item">
            <img src="img/img2/12.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/13.jpeg" class="gallery-item">
            <img src="img/img2/13.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/14.jpeg" class="gallery-item">
            <img src="img/img2/14.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>

        <a href="img/img2/15.jpeg" class="gallery-item">
            <img src="img/img2/15.jpeg" class="rounded-xl shadow-lg hover:scale-105 transition-transform">
        </a>


        <!-- VIDEOS -->
        <a 
            data-lg-size="1280-720"
            data-lg-video="true"
            data-src="img/img2/16.mp4"
            class="gallery-item">
            <video class="rounded-xl shadow-lg hover:scale-105 transition-transform" muted>
                <source src="img/img2/16.mp4" type="video/mp4">
            </video>
        </a>

        <a 
            data-lg-size="1280-720"
            data-lg-video="true"
            data-src="img/img2/17.mp4"
            class="gallery-item">
            <video class="rounded-xl shadow-lg hover:scale-105 transition-transform" muted>
                <source src="img/img2/17.mp4" type="video/mp4">
            </video>
        </a>

        <a 
            data-lg-size="1280-720"
            data-lg-video="true"
            data-src="img/img2/18.mp4"
            class="gallery-item">
            <video class="rounded-xl shadow-lg hover:scale-105 transition-transform" muted>
                <source src="img/img2/18.mp4" type="video/mp4">
            </video>
        </a>

    </div>
</section>

<!-- LightGallery Scripts -->
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/video/lg-video.min.js"></script>

<script>
    lightGallery(document.getElementById('galeria'), {
        speed: 400,
        plugins: [lgVideo],
    });
</script>

     

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
<style>
.galeria-img {
    transition: transform 0.4s ease, filter 0.4s ease;
}
.galeria-img:hover {
    transform: scale(1.06);
    filter: brightness(1.15);
}
.floating {
    animation: float 4s ease-in-out infinite;
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
    100% { transform: translateY(0px); }
}

</style>

</body>
</html>
