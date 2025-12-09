<?php
$error = $error ?? '';
$success = $success ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Registro - Peluquería</title>

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center">

<div class="w-full max-w-md bg-white/20 backdrop-blur-lg rounded-2xl p-10 shadow-xl animate-fadeIn">

    <h2 class="text-3xl text-white font-semibold mb-6 text-center">
        Crear Cuenta
    </h2>

    <!-- FORMULARIO -->
    <form action="/DisenioWeb2/backEnd/public/usuarios/create" method="POST">

    <div>
        <label class="text-white font-semibold">Nombre completo</label>
        <div class="relative">
            <i class="fa-solid fa-user absolute left-3 top-3 text-white/70"></i>
            <input type="text" name="nombreUsuario" placeholder="Juan Pérez"
                   class="w-full pl-10 pr-4 py-2 rounded-xl bg-white/30 text-white placeholder-white/70 focus:outline-none"
                   required>
        </div>
    </div>

    <div>
        <label class="text-white font-semibold">CI</label>
        <div class="relative">
            <i class="fa-solid fa-id-card absolute left-3 top-3 text-white/70"></i>
            <input type="text" name="ciUsuario" placeholder="12345678"
                   class="w-full pl-10 pr-4 py-2 rounded-xl bg-white/30 text-white placeholder-white/70 focus:outline-none"
                   required>
        </div>
    </div>

    <div>
        <label class="text-white font-semibold">Correo electrónico</label>
        <div class="relative">
            <i class="fa-solid fa-envelope absolute left-3 top-3 text-white/70"></i>
            <input type="email" name="mailUsuario" placeholder="usuario@gmail.com"
                   class="w-full pl-10 pr-4 py-2 rounded-xl bg-white/30 text-white placeholder-white/70 focus:outline-none"
                   required>
        </div>
    </div>

    <div>
        <label class="text-white font-semibold">Contraseña</label>
        <div class="relative">
            <i class="fa-solid fa-lock absolute left-3 top-3 text-white/70"></i>
            <input type="password" name="password" placeholder="********"
                   class="w-full pl-10 pr-4 py-2 rounded-xl bg-white/30 text-white placeholder-white/70 focus:outline-none"
                   required>
        </div>
    </div>

    <button type="submit"
            class="w-full bg-orange-700 hover:bg-orange-800 text-white py-3 rounded-xl font-semibold shadow-lg transition mt-4">
        Registrarse
    </button>
</form>

    <p class="text-white mt-6 text-center">
        ¿Ya tienes cuenta?
        <a href="/DisenioWeb2/backEnd/public/login"class="text-yellow-300 font-semibold">Inicia Sesión</a>
    </p>

</div>

<script>
// Toast elegante con SweetAlert2
function showToast(message, icon = 'success', redirectUrl = null) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: icon,
        title: message,
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didClose: () => {
            if (redirectUrl) {
                window.location.href = redirectUrl;
            }
        }
    });
}

// Mostrar error si existe
<?php if(!empty($error)) : ?>
showToast('<?= htmlspecialchars($error) ?>', 'error');
<?php endif; ?>

// Mostrar éxito y redirigir al front
<?php if(!empty($success)) : ?>
showToast('Registro exitoso. Bienvenido!', 'success', '/DisenioWeb2/frontEnd/pages/cliente/indexCliente.php');
<?php endif; ?>
</script>

</body>
</html>
