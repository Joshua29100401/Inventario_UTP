<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edificio</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="diseño.css" rel="stylesheet">
    <link href="reasignacion.css" rel="stylesheet">
    <!-- Incluir la fuente desde Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <style>
        /* Estilo para la ventana emergente */
        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 80px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: green;
            z-index: 1000;
            text-align: center;
        }
        /* Estilo para el fondo de la ventana emergente */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            /* Fondo borroso detras de de la ventana emergente */
            backdrop-filter: blur(2px);
        }
        .contenedorBtn{
            display: flex;
            padding: 20px;
            align-items: center;
            justify-content: space-between;
        }
        .form-label{
            font-size: 20px; /* Tamaño de la fuente */
            font-family: 'Roboto', sans-serif; /* Fuente desde Google Fonts */
        }
    </style>
</head>
<body>
    <div class="select-container">
        <form method="post" action="">
            <select id="lab-select" name="lab-select" class="form-control expanded">
                <option selected disabled>Categorías</option>
                <?php
                // Error reporting for development
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                // Database connection
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "proyecto";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Fetch distinct categories
                $sql = "SELECT DISTINCT Nombre_cat FROM alta_categoria";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Nombre_cat'] . "'>" . $row['Nombre_cat'] . "</option>";
                    }
                } else {
                    echo "<option>No se encontraron categorías</option>";
                }

                $conn->close();
                ?>
            </select>
            <button type="submit" class="btn btn-primary mt-2">Consultar</button>
        </form>
    </div>
    <div class="container mt-5">
        <?php
        // Reconnect to fetch properties
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $selectedLab = isset($_POST['lab-select']) && !isset($_POST['reset']) ? $_POST['lab-select'] : '';

        // Fetch properties based on selected category
        $sql = "SELECT i.Id_inmueble, i.Nombre_inmueble, i.Fecha_adquisicion, 
        i.Costo, c.Nombre_cat AS categoria, i.asignacion 
                FROM alta_inmueble i
                JOIN alta_categoria c ON i.Id_categoria = c.Id_categoria";

        if (!empty($selectedLab)) {
            $sql .= " WHERE c.Nombre_cat = '" . $conn->real_escape_string($selectedLab) . "'";
        }

        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                echo "<table class='table' id='inmuebles-table'>";
                echo "<thead><tr><th>ID</th><th>Nombre</th><th>Fecha de Adquisición</th><th>Costo</th><th>Categoría</th><th>Asignación</th><th>Reasignación</th></tr></thead>";
                echo "<tbody>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr data-laboratorio='" . $row["categoria"] . "'>
                    <td>" . $row["Id_inmueble"] . "</td>
                    <td>" . $row["Nombre_inmueble"] . "</td>
                    <td>" . $row["Fecha_adquisicion"] . "</td>
                    <td>" . $row["Costo"] . "</td>
                    <td>" . $row["categoria"] . "</td>
                    <td class='asignacion'>" . $row["asignacion"] . "</td>
                    <td>
                        <button class='openPopupBtn'>Reasignar</button>
                    </td>
                  </tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "0 resultados";
            }
        } else {
            echo "Error en la consulta de inmuebles: " . $conn->error;
        }

        $conn->close();
        ?>
    </div>
    <!-- Ventana emergente -->
    <div class="popup-overlay" id="popupOverlay"></div>
    <div class="popup" id="popup">
        <label for="asignacion" class="form-label">Asignación<br><br> <span class="text-body-secondary">(No necesaria)</span></label><br><br>
        <select id="asignacion" name="asignacion" class="form-control expanded form-select text-center">
            <option selected disabled>Asignar a...</option>
            <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "proyecto";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "SELECT Id,  Nombre_completo FROM colaboradores1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['Id'] . "'>" . $row['Nombre_completo'] . "</option>";
            }
        }
        $conn->close();
        ?>
        </select><br><br>
        <div class="contenedorBtn">
            <button id="asignarBtn">Asignar</button>
            <button id="closePopupBtn">Cerrar</button>
        </div>
    </div>

    <script src="navigation.js"></script>
    <script src="reasignacion.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Obtener elementos del DOM
        var openPopupBtns = document.querySelectorAll('.openPopupBtn');
        var closePopupBtn = document.getElementById('closePopupBtn');
        var popup = document.getElementById('popup');
        var popupOverlay = document.getElementById('popupOverlay');

        // Función para abrir la ventana emergente
        function openPopup() {
            popup.style.display = 'block';
            popupOverlay.style.display = 'block';
        }

        // Función para cerrar la ventana emergente
        function closePopup() {
            popup.style.display = 'none';
            popupOverlay.style.display = 'none';
        }

        // Añadir eventos de clic a los botones
        openPopupBtns.forEach(function(btn) {
            btn.addEventListener('click', openPopup);
        });
        closePopupBtn.addEventListener('click', closePopup);
        popupOverlay.addEventListener('click', closePopup);
    </script>
</body>
</html>
