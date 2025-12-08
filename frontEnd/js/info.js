  function setSrc(id, value) {
    const el = document.getElementById(id);
    if (el) el.src = value;
}

function setText(id, value) {
    const el = document.getElementById(id);
    if (el) el.textContent = value;
}
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
                ? `/DisenioWeb2/backEnd/public${data.imageLogo}` 
                : '/DisenioWeb2/frontEnd/img/default-logo.png';

            setSrc('empresaLogo', logoPath);
            setSrc('empresaLogo2', logoPath);

            setText('empresaNombre', data.nombreEmpresa);
            setText('empresaNombreHeader', data.nombreEmpresa);
            setText('empresaNombreFooter', data.nombreEmpresa);

            setText('footerWhatsApp', data.numeroE);
            setText('footerCorreo', data.correoE);
            setText('footerDireccion', data.DireccionE);
        }
    } catch (err) {
        console.error('Error cargando empresa:', err);
    }
}



        document.addEventListener('DOMContentLoaded', cargarEmpresa);