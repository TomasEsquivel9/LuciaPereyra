<?php
include 'conexionbd.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM promotores_nuevos WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>
<?php
include 'conexionbd.php';

$mensaje = '';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM promotores_nuevos WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}

// Procesar actualización
if (isset($_POST['actualizar'])) {
    $id = intval($_POST['id']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $mensaje_form = mysqli_real_escape_string($conn, $_POST['mensaje']);

    $query = "UPDATE promotores_nuevos 
              SET nombre='$nombre', email='$email', telefono='$telefono', mensaje='$mensaje_form'
              WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        // Redirigir con mensaje de éxito
        header("Location: promotores_postulados.php?msg=editado");
        exit();
    } else {
        $mensaje = "❌ Error al actualizar: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Promotor</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  
  <div class="bg-white p-10 rounded-xl shadow-xl w-full max-w-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Editar Promotor</h1>

    <?php if ($mensaje): ?>
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center">
        <?php echo $mensaje; ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="editar.php" class="space-y-5">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

      <div>
        <label class="block text-gray-700 font-medium mb-1">Nombre</label>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>"
               class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <div>
        <label class="block text-gray-700 font-medium mb-1">Email</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"
               class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <div>
        <label class="block text-gray-700 font-medium mb-1">Teléfono</label>
        <input type="text" name="telefono" value="<?php echo htmlspecialchars($row['telefono']); ?>"
               class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <div>
        <label class="block text-gray-700 font-medium mb-1">Mensaje</label>
        <textarea name="mensaje" rows="3"
                  class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlspecialchars($row['mensaje']); ?></textarea>
      </div>

      <div class="flex justify-between items-center pt-4">
        <a href="promotores_postulados.php" 
           class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">
          Cancelar
        </a>
        <button type="submit" name="actualizar"
                class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
          Guardar Cambios
        </button>
      </div>
    </form>
  </div>

</body>
</html>
