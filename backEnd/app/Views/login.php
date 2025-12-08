<?php
$error = $error ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Login - Peluquería</title>

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-orange-500 to-orange-600 flex flex-col items-center">

    <!-- NAVBAR ROJO -->
    <header class="bg-orange-700 text-white py-5 shadow-md w-full">
        <div class="max-w-5xl mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Login Peluquería</h1>
            <a href="/DisenioWeb2/frontEnd/index.php" class="bg-white text-orange-600 px-4 py-2 rounded-lg font-semibold hover:bg-orange-50 transition">
                Volver
            </a>
        </div>
    </header>

    <!-- LOGIN FORMULARIO -->
    <div class="w-full max-w-md bg-white/20 backdrop-blur-lg rounded-2xl p-10 shadow-2xl mt-10">

        <h2 class="text-3xl text-white font-semibold mb-6 text-center">
            Iniciar Sesión
        </h2>

        <form action="/DisenioWeb2/backEnd/public/login" method="POST">

            <div class="mb-4">
                <label class="text-white font-semibold">Correo o CI</label>
                <div class="relative">
                    <i class="fa-solid fa-user absolute left-3 top-3 text-white/70"></i>
                    <input 
                        type="text" 
                        name="usuario"
                        value="<?= htmlspecialchars($_POST['usuario'] ?? '') ?>" 
                        placeholder="Ej: usuario@gmail.com o 12345678" 
                        class="w-full pl-10 pr-4 py-2 rounded-xl bg-white/30 text-white placeholder-white/70 focus:outline-none"
                        required
                    >
                </div>
            </div>

            <div class="mb-4">
                <label class="text-white font-semibold">Contraseña</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-3 top-3 text-white/70"></i>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="********"
                        class="w-full pl-10 pr-4 py-2 rounded-xl bg-white/30 text-white placeholder-white/70 focus:outline-none"
                        required
                    >
                </div>
            </div>

            <button 
                type="submit"
                class="w-full bg-orange-700 hover:bg-orange-800 text-white py-3 rounded-xl font-semibold shadow-lg transition">
                Ingresar
            </button>
        </form>

        <p class="text-white mt-6 text-center">
            ¿No tienes cuenta?
            <a href="/DisenioWeb2/backEnd/public/register" class="text-yellow-300 font-semibold">Regístrate</a>
        </p>
    </div>

    <?php if(!empty($error)) : ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= htmlspecialchars($error) ?>'
            });
        });
    </script>
    <?php endif; ?>

</body>
</html>
