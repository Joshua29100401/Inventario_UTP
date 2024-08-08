<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyecto";

    // Captura los valores del formulario
    $nombre_inmueble = $_POST['nombre_inmueble'];
    $fecha_adquisicion = $_POST['fecha_adquisicion'];
    $costo = $_POST['costo'];
    $categoria_id = $_POST['categoria']; // ID de categoría
    $asignacion_id = $_POST['asignacion']; // ID de asignación (Id_alta)

    // Conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta para obtener el nombre de la categoría
    $sql_categoria = "SELECT Nombre_cat FROM alta_categoria WHERE Id_categoria = ?";
    $stmt_categoria = $conn->prepare($sql_categoria);
    if (!$stmt_categoria) {
        die("Error en la preparación de la consulta de categoría: " . $conn->error);
    }
    $stmt_categoria->bind_param("i", $categoria_id);
    $stmt_categoria->execute();
    $result_categoria = $stmt_categoria->get_result();
    $categoria_nombre = $result_categoria->num_rows > 0 ? $result_categoria->fetch_assoc()['Nombre_cat'] : '';

    // Consulta para obtener el nombre completo de la asignación
    $sql_asignacion = "SELECT Nombre_completo FROM colaboradores1 WHERE Id = ?";
    $stmt_asignacion = $conn->prepare($sql_asignacion);
    if (!$stmt_asignacion) {
        die("Error en la preparación de la consulta de asignación: " . $conn->error);
    }
    $stmt_asignacion->bind_param("i", $asignacion_id);
    $stmt_asignacion->execute();
    $result_asignacion = $stmt_asignacion->get_result();
    $asignacion_nombre = $result_asignacion->num_rows > 0 ? $result_asignacion->fetch_assoc()['Nombre_completo'] : '';

    // Prepara la consulta de inserción
    $stmt_insert = $conn->prepare("INSERT INTO alta_inmueble (Nombre_inmueble, Fecha_adquisicion, Costo, Categoria, Asignacion, Id_categoria, Id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt_insert) {
        die("Error en la preparación de la consulta de inserción: " . $conn->error);
    }

    // Vincular parámetros para la inserción
    $stmt_insert->bind_param("ssssssi", $nombre_inmueble, $fecha_adquisicion, $costo, $categoria_nombre, $asignacion_nombre, $categoria_id, $asignacion_id);

    // Ejecutar la consulta
    if ($stmt_insert->execute()) {
        echo "<script>alert('Nuevo inmueble agregado exitosamente.'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt_insert->error . "'); window.location.href='index.php';</script>";
    }

    // Cerrar conexiones
    $stmt_categoria->close();
    $stmt_asignacion->close();
    $stmt_insert->close();
    $conn->close();
}
?>
