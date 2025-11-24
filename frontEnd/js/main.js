// Inicializa íconos
feather.replace();

// ----- Menú Móvil -----
const btn = document.getElementById('menu-btn');
const menu = document.getElementById('mobile-menu');
btn.addEventListener('click', () => menu.classList.toggle('hidden'));

// ----- Cambiar fondo dinámico -----
function cambiarFondo(ruta) {
    document.getElementById('fondoPersonalizado').style.backgroundImage = `url('${ruta}')`;
}
cambiarFondo('img/fondo1.jpg');

// ----- Navbar transparente → con color al hacer scroll -----
window.addEventListener("scroll", () => {
    const navbar = document.getElementById("navbar");
    if (window.scrollY > 80) {
        navbar.classList.remove("bg-transparent");
        navbar.classList.add("bg-white/70", "backdrop-blur-md", "shadow-lg");
    } else {
        navbar.classList.add("bg-transparent");
        navbar.classList.remove("bg-white/70", "backdrop-blur-md", "shadow-lg");
    }
});

// ----- Animación suave para imágenes -----
const galleryImages = document.querySelectorAll(".gallery-img");
galleryImages.forEach(img => {
    img.classList.add("transition", "duration-500", "ease-out", "hover:scale-105", "hover:shadow-2xl");
});

// ----- Cargar datos de la empresa desde backend -----
async function cargarEmpresa() {
    try {
        const response = await fetch("/DisenioWeb2/backEnd/public/empresa/show");
        const empresa = await response.json();

        if (!empresa || Object.keys(empresa).length === 0) {
            console.warn("No hay información de empresa registrada.");
            return;
        }

        // ----- Header y Navbar -----
        const nombreElem = document.getElementById("empresaNombre");
        if (nombreElem) nombreElem.textContent = empresa.nombreEmpresa;
        
 const logoElem = document.getElementById("empresaLogo");
if (logoElem && empresa.imageLogo) {
    logoElem.src = empresa.imageLogo; // ya apunta a /uploads/archivo.jpeg
}


        // ----- Footer -----
        const footerNombre = document.getElementById("footerNombre");
        if (footerNombre) footerNombre.textContent = `© 2025 ${empresa.nombreEmpresa} - Todos los derechos reservados`;
        const footerContacto = document.getElementById("footerContacto");
        if (footerContacto && empresa.numeroE) footerContacto.textContent = `Contacto: WhatsApp ${empresa.numeroE}`;

        // ----- Administración (si existen los campos) -----
        const idInput = document.getElementById('idEmpresa');
        if(idInput) idInput.value = empresa.idEmpresa;
        const nombreInput = document.getElementById('nombreEmpresa');
        if(nombreInput) nombreInput.value = empresa.nombreEmpresa || '';
        const numeroInput = document.getElementById('numeroE');
        if(numeroInput) numeroInput.value = empresa.numeroE || '';
        const correoInput = document.getElementById('correoE');
        if(correoInput) correoInput.value = empresa.correoE || '';
        const direccionInput = document.getElementById('DireccionE');
        if(direccionInput) direccionInput.value = empresa.DireccionE || '';

        const currentLogo = document.getElementById('currentLogo');
        if(currentLogo) currentLogo.value = empresa.imageLogo || '';
        const currentQR = document.getElementById('currentQR');
        if(currentQR) currentQR.value = empresa.imageQR || '';

        const previewLogo = document.getElementById('previewLogo');
        if(previewLogo && empresa.imageLogo) previewLogo.src = empresa.imageLogo;
        const previewQR = document.getElementById('previewQR');
        if(previewQR && empresa.imageQR) previewQR.src = empresa.imageQR;

    } catch (error) {
        console.error("Error cargando empresa:", error);
    }
}

// ----- Inicializar AOS y cargar empresa -----
document.addEventListener("DOMContentLoaded", function () {
    AOS.init({
        duration: 900,
        once: true,
        easing: "ease-out-cubic"
    });

    cargarEmpresa();
});
