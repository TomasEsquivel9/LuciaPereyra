<?php

include 'conexionbd.php';

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de campos esperados
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $mensaje = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';
    $telefono_extra = isset($_POST['telefono_extra']) ? $_POST['telefono_extra'] : '';

    // Antispam - campo oculto
    if (!empty($telefono_extra)) {
        die("Error: Detected as spam.");
    }

    // Validación de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Email inválido.");
    }

    // Validación de contenido (blacklist)
    $blacklist = ['casino', 'viagra', 'bitcoin', 'dinero rápido'];
    foreach ($blacklist as $word) {
        if (stripos($mensaje, $word) !== false) {
            die("Error: Contenido bloqueado por spam.");
        }
    }

    // Inserción en la base de datos
    $sql = "INSERT INTO promotores_nuevos (nombre, email, telefono, mensaje) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $email, $telefono, $mensaje);

    if ($stmt->execute()) {
        $success_message = "Tu mensaje ha sido enviado. Nos pondremos en contacto contigo a la brevedad.";
    } else {
        $error_message = "Error al enviar el mensaje.";
    }

    $stmt->close();
}

mysqli_close($conn);
?>
<head>
      <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-700">
<div class="">
    <div style="background-image: url('./assets/home/bgYellow.webp')" data-aos="fade-right"
        class="bg-banner bg-cover bg-center mt-24 py-16">
        <h1 style="text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.8);"
            class="text-center text-5xl text-white font-extrabold ">Ser promotor</h1>
    </div>
    <section data-aos="fade-up">
        <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-x-16 gap-y-8 lg:grid-cols-5">
                <div class="lg:col-span-2 lg:py-12">
                    <h1 class="text-3xl font-extrabold mb-2 text-yellow-custom">Aumentá tus ingresos</h1>
                    <p class="max-w-xl text-lg text-white">
                        Vos también podés ser promotor de La Gran Promoción.
                        Completa el formulario que figura a continuación y envíalo. Te llegará un mail confirmando
                        su recepción e información adicional para evacuar tus dudas.
                        Sumate a nuestro equipo de promotores. Emprendé tu propio negocio!
                    </p>

                    <div class="mt-8">
                        <a href="#" class="text-2xl font-bold text-yellow-custom">3564 200809</a>
                        <address class="mt-2 not-italic text-white">Bv. San Martin 231° - Devoto - Córdoba -
                            Argentina</address>
                    </div>
                </div>

                <div class="rounded-lg bg-white p-8 shadow-lg lg:col-span-3 lg:p-12">
                    <?php if (!empty($success_message)): ?>
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert">
                            <?php echo $success_message; ?>
                        </div>
                    <?php elseif (!empty($error_message)): ?>
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="contacto.php" class="space-y-4 bg-white">
                        <div>
                            <label for="nombre" class="sr-only">Nombre y Apellido</label>
                            <input class="w-full rounded-lg border border-gray-300 p-3 text-sm" type="text"
                                id="nombre" name="nombre" placeholder="Nombre y Apellido" required />
                        </div>

                        <div style="display:none;">
                            <input type="text" name="telefono_extra" value="">
                        </div>


                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="email" class="sr-only">Email</label>
                                <input class="w-full rounded-lg border border-gray-300 p-3 text-sm" type="email"
                                    id="email" name="email" placeholder="Email" required />
                            </div>

                            <div>
                                <label for="telefono" class="sr-only">Teléfono</label>
                                <input class="w-full rounded-lg border border-gray-300 p-3 text-sm" type="tel"
                                    id="telefono" name="telefono" placeholder="Teléfono" required />
                            </div>
                        </div>

                        <div>
                            <label for="mensaje" class="sr-only">Escribe tu consulta...</label>
                            <textarea class="w-full rounded-lg border border-gray-300 p-3 text-sm" id="mensaje"
                                name="mensaje" placeholder="Tu mensaje" rows="8" required></textarea>
                        </div>

                        <div class="mt-4">
                            <button type="submit"
                                class="inline-block w-full rounded-lg bg-yellow-600 px-5 py-3 font-bold text-white sm:w-auto">
                                Enviar Mensaje
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>    
</body>