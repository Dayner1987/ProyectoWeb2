  // Navbar scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('bg-black/90');
            } else {
                navbar.classList.remove('bg-black/90');
                navbar.classList.add('bg-transparent');
            }
        });

        // Menú hamburguesa
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => menu.classList.toggle('hidden'));

        // Feather icons
        feather.replace();
        btn.addEventListener('click', () => menu.classList.toggle('hidden'));

        // Permitir cambiar tamaño del logo dinámicamente
        function cambiarTamanoLogo(px) {
            document.getElementById('empresaLogo').style.height = px + 'px';
        }

        // Fondo dinámico
        function cambiarFondo(ruta) {
            document.getElementById('fondoPersonalizado').style.backgroundImage = `url(${ruta})`;
        }
        cambiarFondo('img/fondo2.jpeg');
async function cargarEmpresa() {
    try {
        const res = await fetch('/DisenioWeb2/backEnd/public/empresa');
        const data = await res.json();

        if (data) {
            const logoPath = data.imageLogo
                ? `${window.location.origin}/DisenioWeb2/backEnd/public${data.imageLogo}`
                : 'img/default-logo.png';

            const qrPath = data.imageQR
                ? `${window.location.origin}/DisenioWeb2/backEnd/public${data.imageQR}`
                : 'img/default-qr.png';

                        // Logos
            document.getElementById('empresaLogo').src = logoPath;
            document.getElementById('empresaLogo2').src = logoPath;

            // Nombres
            document.getElementById('empresaNombre').textContent = data.nombreEmpresa || 'Mi Empresa';
            document.getElementById('empresaNombreHeader').textContent = data.nombreEmpresa || 'Reflejos';
            document.getElementById('empresaNombreFooter').textContent = data.nombreEmpresa || 'Peluquería Reflejos';

            // Datos contacto footer
            document.getElementById('footerWhatsApp').textContent = data.numeroE || '+591 77975489';
            document.getElementById('footerCorreo').textContent = data.correoE || 'info@peluqueria.com';
            document.getElementById('footerDireccion').textContent = data.DireccionE || 'Calle Falsa 123, La Paz';

            // QR final
            document.getElementById('empresaQR').src = qrPath;

            // Link WhatsApp dinámico
            document.getElementById('btnEnviarQR').href =
                `https://wa.me/${data.numeroE}?text=Hola,%20te%20envío%20el%20QR%20de%20la%20empresa.%0A${location.origin}${qrPath}`;
        }
    } catch (err) {
        console.error('Error cargando empresa:', err);
    }
}

document.addEventListener('DOMContentLoaded', cargarEmpresa);



        document.addEventListener('DOMContentLoaded', cargarEmpresa);