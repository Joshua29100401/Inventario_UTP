<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">


<div class="container mt-4">
    
    <?php
        $miconexion = new mysqli("localhost", "root", "", "proyecto");
        if ($miconexion->connect_errno) {
            echo "Fallo al conectar con MySQL: " . $miconexion->connect_error;
        }

        $resultado = $miconexion->query("SELECT * FROM colaboradores1 ORDER BY id ASC");

        echo '<table class="table" id="tabla">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Nombre completo</th>';
        echo '<th>Acciones</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Generar las filas de la tabla con los datos de la consulta
        while ($fila = $resultado->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $fila["Id"] . '</td>';
            echo '<td>' . $fila["Nombre_completo"] . '</td>';
            echo '<td>';
            
            // Formulario para modificar usuario
            echo "<form action='modificarusuario.php' method='POST' style='display:inline;' >";
            echo "<input type='hidden' name='id_usr' value='" . $fila["Id"] . "'>";
            echo '<button type="submit" class="btn btn-warning btn-sm editar-btn">Editar</button>';
            echo "</form>";
        
            // Formulario para eliminar usuario
            echo "<form action='eliminarusuario.php' method='POST' style='display:inline;' onsubmit='return confirm(\"¿Estás seguro de que deseas eliminar este usuario?\");'>";
            echo "<input type='hidden' name='id_usr' value='" . $fila["Id"] . "'>";
            echo '<button type="submit" class="btn btn-danger btn-sm eliminar-btn">Eliminar</button>';
            echo "</form>";
        
            echo '</td>';
            echo '</tr>';
        }
        //
        echo '</tbody>';
        echo '</table>';
        
        // Liberar el resultado
        $resultado->free();

        // Cerrar la conexión
        $miconexion->close();
    ?>
</form>
</div>
<script>
    // Aquí se debe agregar el código JavaScript para manejar la funcionalidad de editar y eliminar
    $(document).ready(function() {
        // Evento para botón eliminar
        $('.eliminar-btn').click(function() {
            $(this).closest('tr').remove();
        });

        // Evento para botón editar (puedes implementar la lógica necesaria para editar)
        $('.editar-btn').click(function() {
            // Aquí puedes implementar el código para abrir un modal o realizar alguna acción de edición
            alert('Funcionalidad de editar aún no implementada');
        });
    });
</script>
</body>
</html>
