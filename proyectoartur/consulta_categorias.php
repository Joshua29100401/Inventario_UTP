
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
<?php
$miconexion = new mysqli("localhost", "root", "", "proyecto");

if ($miconexion->connect_errno) {
    echo "Fallo al conectar con MySQL: " . $miconexion->connect_error;
    exit();
}

// Ejecutar la consulta SQL
$resultado = $miconexion->query("SELECT * FROM alta_categoria ORDER BY Id_categoria ASC");

if (!$resultado) {
    echo "Error en la consulta SQL: " . $miconexion->error;
    exit();
}

echo '<table class="table" id="tabla">';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Nombre categorías</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

// Generar las filas de la tabla con los datos de la consulta
while ($fila = $resultado->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $fila["Id_categoria"] . '</td>';
    echo '<td>' . $fila["Nombre_cat"] . '</td>';
    echo '<td>';

    // Formulario para eliminar usuario
    echo "<form action='eliminarcategoria.php' method='POST' style='display:inline;' onsubmit='return confirm(\"¿Estás seguro de que deseas eliminar esta categoría?\");'>";
    echo "<input type='hidden' name='id_usra' value='" . $fila["Id_categoria"] . "'>";
    echo '<button type="submit" class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>';
    echo "</form>";

    echo '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';

// Liberar el resultado
$resultado->free();

// Cerrar la conexión
$miconexion->close();
?>
