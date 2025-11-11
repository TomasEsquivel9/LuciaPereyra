<?php
include 'conexionbd.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $query = "DELETE FROM promotores_nuevos WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        // Eliminación exitosa → redirigir con mensaje
        header("Location: promotores_postulados.php?msg=eliminado");
        exit();
    } else {
        echo "Error al eliminar: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
<?php
if (isset($_GET['msg']) && $_GET['msg'] == 'eliminado') {
    echo "<div class='bg-red-200 text-red-700 p-3 rounded mb-4'>
            Registro eliminado correctamente.
          </div>";
}
?>
