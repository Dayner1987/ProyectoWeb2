<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peluqueria-barberia</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lightbox CSS -->
<!-- Incluir Font Awesome CDN en el <head> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" 
      integrity="sha512-vT2wFjVqw7g+X5D1LbBvG6uE+u0eZcB5P6bQ1YwHHFvRXQ2eYg2k1gGhRZVg6JlZ+pFh6s/+n5LrQxC3QkG1hg==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="gallery/dist/css/lightbox.min.css">

    <!-- Librerías adicionales -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- AOS Animations -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="css/index.css">
    <!-- CSS de la galería -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.39.0/css/blueimp-gallery.min.css">

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
                    <a href="galeria.php" class="text-orange-400 hover:text-orange-300 transition">Galeria</a>
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



      <!-- Sección de info -->
      <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20">
          <div class="bg-white rounded-2xl shadow-xl p-8 flex flex-col md:flex-row gap-10 items-center" data-aos="fade-up">
              <img src="img/image1.jpg" alt="Ejemplo" class="w-80 rounded-xl shadow-lg" data-aos="fade-right">
              <div data-aos="fade-left">
                  <h3 class="text-3xl font-bold text-orange-400 mb-4">Tu Mejor Estilo Te Espera</h3>
                  <p class="text-gray-900 leading-relaxed mb-6">
                      Nuestro equipo altamente capacitado te brinda cortes modernos, tintes profesionales y una atención personalizada.
                       Cotizamos todo tipo de servicios para Bodas, eventos, Quinceañeras y todos los cortes de varon para evento. No pierdas un seegunda mas en recibir de tus mejores servicios.
                  </p>
                 <a href="../backEnd/app/Views/login.php" 
   class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl shadow-lg transition-transform hover:scale-105 inline-block">
   Agendar Cita
</a>

              </div>
          </div>
      </section>
      <!-- ============================= -->
<!--   SECCIÓN: SERVICIOS (3 ICONOS) -->
<!-- ============================= -->
<section class="mt-20">
    <h2 class="text-4xl font-bold text-center text-orange-500 mb-10" data-aos="fade-up">
        Algunos de Nuestros Servicios
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto">

        <!-- Servicio 1 -->
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:scale-105 transition-transform"
             data-aos="fade-right">
            <i data-feather="scissors" class="w-16 h-16 text-orange-500 mx-auto mb-4"></i>
            <h3 class="text-2xl font-semibold text-gray-800">Corte de Cabello UNISEX</h3>
            <p class="text-gray-600 mt-3">Estilos modernos y clásicos adaptados tanto para Varón y para Mujer
                incluye corte junto a su peinado
            </p>
        </div>

        <!-- Servicio 2 -->
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:scale-105 transition-transform"
             data-aos="fade-up">
            <i data-feather="droplet" class="w-16 h-16 text-orange-500 mx-auto mb-4"></i>
            <h3 class="text-2xl font-semibold text-gray-800">Tinturas</h3>
            <p class="text-gray-600 mt-3">Coloración profesional con productos premium, aplicaicones, decolorados fantasia y platinado.</p>
        </div>
<!-- Servicio 3 -->
<div class="bg-white rounded-2xl shadow-lg p-8 text-center hover:scale-105 transition-transform"
     data-aos="fade-left">
    <i data-feather="user" class="w-16 h-16 text-orange-500 mx-auto mb-4"></i>
    <h3 class="text-2xl font-semibold text-gray-800">Personalizado</h3>
    <p class="text-gray-600 mt-3">Corte de cabello qeu mas se adapte atu estilo, para sacar la mejor vesión de ti.</p>
</div>



    </div>
</section>


<!-- ============================= -->
<!--   SECCIÓN: ESTILISTAS (TARJETAS) -->
<!-- ============================= -->
<section class="mt-28">
    <h2 class="text-4xl font-bold text-center text-orange-500 mb-12" data-aos="fade-up">
        Estilistas Disponibles
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-6xl mx-auto">

        <!-- Estilista 1 -->
        <div class="bg-white rounded-2xl shadow-xl p-6 text-center hover:scale-105 transition"
             data-aos="zoom-in">
            <img src="img/dayner.jpeg" class="rounded-full w-40 h-40 object-cover mx-auto shadow-lg mb-4">
            <h3 class="text-2xl font-semibold text-gray-800">Dayner Alvarez</h3>
            <p class="text-gray-600 mt-2 mb-2">Especialista en cortes de varon clasicos y modernos, 4 años de experiencia.</p>
            <i data-feather="user" class="w-10 h-10 text-orange-500 mt-2"></i>
        </div>

        <!-- Estilista 2 -->
        <div class="bg-white rounded-2xl shadow-xl p-6 text-center hover:scale-105 transition"
             data-aos="zoom-in" data-aos-delay="100">
            <img src="img/charito.jpeg" class="rounded-full w-40 h-40 object-cover mx-auto shadow-lg mb-4">
            <h3 class="text-2xl font-semibold text-gray-800">Rosario Canaviri</h3>
            <p class="text-gray-600 mt-2 mb-2">Experta en coloración, Peinados y cortes clasicos, 20 años de experiencia.</p>
            <i data-feather="user" class="w-10 h-10 text-orange-500 mt-2"></i>
        </div>

        <!-- Estilista 3 -->
        <div class="bg-white rounded-2xl shadow-xl p-6 text-center hover:scale-105 transition"
             data-aos="zoom-in" data-aos-delay="200">
            <img src="img/tonio.jpeg" class="rounded-full w-40 h-40 object-cover mx-auto shadow-lg mb-4">
            <h3 class="text-2xl font-semibold text-gray-800">Jose Alvarez</h3>
            <p class="text-gray-600 mt-2 mb-2">Especialista en barbería y perfilado de barba, 20 años de experiencia.</p>
            <i data-feather="user" class="w-10 h-10 text-orange-500 mt-2"></i>
        </div>

    </div>
</section>



<!-- ============================= -->
<!--   SECCIÓN: SERVICIOS DETALLADOS -->
<!-- ============================= -->
<section class="mt-28 mb-20 max-w-7xl mx-auto" data-aos="fade-up">
    <div class="bg-white rounded-2xl shadow-xl p-8 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

        <!-- Imagen derecha -->
        <img src="img/image2.jpg" alt="Servicio" 
             class="rounded-xl shadow-lg order-2 md:order-1" data-aos="fade-right">

        <!-- Texto -->
        <div class="order-1 md:order-2">
            <h3 class="text-3xl font-bold text-orange-500 mb-4">Corte de cabello + Barba</h3>

            <p class="text-gray-700 mb-6">
                Corte de cabello elegante, estilo recomendado o a preferencia del cliente para Varon y mujer incluye peinado, arreglo de cejas mas consejos de cuidado.
            </p>

            <!-- Ejemplo servicio + costo -->
            <div class="bg-orange-100 border-l-4 border-orange-500 p-4 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold text-orange-600">Promoción hasta 2x1</h4>
                <p class="text-gray-700 mt-1 font-bold text-lg">Costo: 60 Bs Promo 2x1: 100 Bs.</p>
            </div>
        </div>
         <!-- Texto -->
        <div class="order-1 md:order-2">
            <h3 class="text-3xl font-bold text-orange-500 mb-4">Maquillaje + peinado de Gala</h3>

            <p class="text-gray-700 mb-6">
                Peinado a gusto del cliente o eventos personaliados, para quinceañeras, matrimonios, incluye arreglo completo de rostro y peinado con su estilo y deración mas fina.
            </p>

            <!-- Ejemplo servicio + costo -->
            <div class="bg-orange-100 border-l-4 border-orange-500 p-4 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold text-orange-600">Precio de Estreno</h4>
                <p class="text-gray-700 mt-1 font-bold text-lg">Costo: 260 Bs.</p>
            </div>
        </div>
         <!-- Texto -->
        <div class="order-1 md:order-2">
            <h3 class="text-3xl font-bold text-orange-500 mb-4">Decoloracion + tinte de cabello</h3>

            <p class="text-gray-700 mb-6">
                Decoloracón de cabello incluyendo su tinte mas los protectores, contamso con tintes de cabellos platinados, fnatasia, reflejos, y naturales con su tecnisca de Balayage o californianas.
            </p>

            <!-- Ejemplo servicio + costo -->
            <div class="bg-orange-100 border-l-4 border-orange-500 p-4 rounded-lg shadow-md">
                <h4 class="text-xl font-semibold text-orange-600">En promoción hasta un 20% menos</h4>
                <p class="text-gray-700 mt-1 font-bold text-lg">Antes: 560 BS Ahora: 320 Bs.</p>
            </div>
        </div>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JS de la galería -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.39.0/js/jquery.blueimp-gallery.min.js"></script>

</body>
</html>
