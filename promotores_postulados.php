<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="./styles/tailwind.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
      <script src="https://cdn.tailwindcss.com"></script>
  <title>Promotores Postulados</title>
</head>
<body>
  <div class="max-w-7xl bg-white mx-auto my-32 rounded-lg p-12">
    <h1 class="text-2xl font-bold mb-4">Promotores Nuevos</h1>
    <table class="min-w-full bg-white border border-gray-300">
      <thead>
        <tr>
          <th class="py-2 px-4 border-b">Nombre</th>
          <th class="py-2 px-4 border-b">Email</th>
          <th class="py-2 px-4 border-b">Teléfono</th>
          <th class="py-2 px-4 border-b">Mensaje</th>
          <th class="py-2 px-4 border-b">Fecha de Registro</th>
          <th class="py-2 px-4 border-b">Contacto</th>
          <th class="py-2 px-4 border-b">Borrar</th>
          <th class="py-2 px-4 border-b">Editar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include 'conexionbd.php';

        $query = "SELECT id, nombre, email, telefono, mensaje, fecha_registro FROM promotores_nuevos";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr class='hover:bg-gray-100'>";
            echo "<td class='py-2 px-6 border-b'>" . $row['nombre'] . "</td>";
            echo "<td class='py-2 px-6 border-b'>" . $row['email'] . "</td>";
            echo "<td class='py-2 px-6 border-b'>" . $row['telefono'] . "</td>";
            echo "<td class='py-2 px-6 border-b'>" . $row['mensaje'] . "</td>";
            echo "<td class='py-2 px-6 border-b'>" . date('d/m/y', strtotime($row['fecha_registro'])) . "</td>";
            echo "<td class='py-2 px-6 border-b'>";
            echo "<a href='https://wa.me/" . $row['telefono'] . "' target='_blank' class='bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600'>Contacto</a>";
            echo "<td class='py-2 px-6 border-b text-center'>
                        <form method='POST' action='eliminar.php'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' name='eliminar'
                                    class='bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600'>
                                Borrar
                            </button>
                        </form>
                      </td>";
            echo "<td class='py-2 px-6 border-b text-center'>
            <a href='editar.php?id=" . $row['id'] . "' 
               class='bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600'>
               Editar
            </a>
          </td>";

    echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='6' class='py-2 px-4 border-b text-center'>No hay promotores registrados.</td></tr>";
        }

        mysqli_close($conn); // Cierra la conexión a la base de datos
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>