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
                    <a href="#nosotros" class="text-orange-400 hover:text-orange-300 transition">Información</a>
                    <a href="#servicios" class="text-orange-400 hover:text-orange-300 transition">Servicios</a>
                    <a href="#servicios" class="text-orange-400 hover:text-orange-300 transition">Galeria</a>
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
            <a href="#nosotros" class="block hover:text-orange-300">Sobre Nosotros</a>
            <a href="#servicios" class="block hover:text-orange-300">Servicios</a>
            <a href="#portafolio" class="block hover:text-orange-300">Portafolio</a>
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


      <!-- Galería -->
      <section class="gallery flex flex-wrap justify-center gap-6 mt-10">
          <a class="example-image-link" href="img/image2.jpg" data-lightbox="example-set" data-title="Corte femenino moderno">
              <img class="rounded shadow-xl hover:scale-105 transition-transform gallery-img" src="img/image1.jpg" alt="Mujer con un nuevo corte." width="260">
          </a>
          <a class="example-image-link" href="img/image3.jpg" data-lightbox="example-set" data-title="Corte masculino clásico">
              <img class="rounded shadow-xl hover:scale-105 transition-transform gallery-img" src="img/image2.jpg" alt="Corte de varón." width="260">
          </a>
          <a class="example-image-link" href="img/image1.jpg" data-lightbox="example-set" data-title="Barba premium y cuidado facial">
              <img class="rounded shadow-xl hover:scale-105 transition-transform gallery-img" src="img/image3.jpg" alt="Barba premium." width="260">
          </a>
      </section>

      <!-- Sección de info -->
      <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
          <div class="bg-white rounded-2xl shadow-xl p-8 flex flex-col md:flex-row gap-10 items-center" data-aos="fade-up">
              <img src="img/image1.jpg" alt="Ejemplo" class="w-80 rounded-xl shadow-lg" data-aos="fade-right">
              <div data-aos="fade-left">
                  <h3 class="text-3xl font-bold text-orange-400 mb-4">Tu Mejor Estilo Te Espera</h3>
                  <p class="text-gray-700 leading-relaxed mb-6">
                      Nuestro equipo altamente capacitado te brinda cortes modernos, tintes profesionales y una atención personalizada.
                  </p>
                  <button class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl shadow-lg transition-transform hover:scale-105" data-aos="zoom-in">Agendar Cita</button>
              </div>
          </div>
      </section>
    </main>

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
                    <a href="#" class="hover:text-orange-300"><i data-feather="instagram"></i></a>
                    <a href="#" class="hover:text-orange-300"><i data-feather="facebook"></i></a>
                    <a href="#" class="hover:text-orange-300"><i data-feather="twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="js/lightbox-plus-jquery.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({duration:800, once:false});</script>
    <script src="js/main.js"></script>

</body>
</html>
