<?php
$mensaje = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $miConexion = new mysqli("localhost", "root", "", "proyecto");

    // Verificar conexión
    if ($miConexion->connect_errno) {
        $mensaje = "Fallo al conectar con MySql";
    } else {
        // Obtener los datos del formulario
        $id = $_POST["id"];
        $elusuario = $_POST["usuario"];

        // Insertar datos en la base de datos
        $query = "INSERT INTO colaboradores1 (id,Nombre_completo) VALUES ('$id', '$elusuario')";
        
        if ($miConexion->query($query)) {
            $mensaje = "Usuario agregado correctamente";
        } else {
            $mensaje = "Error al agregar usuario: " . $miConexion->error;
        }

        // Cerrar la conexión
        $miConexion->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar usuarios</title>
    <link rel="icon" href="images/Universidad.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <style>
        .container1 {
            width: 600px; /* Ajusta este valor al tamaño que desees */
            overflow: hidden;
            white-space: nowrap;
            box-sizing: border-box;
        }

        .moving-text {
            display: inline-block;
            padding-left: 100%; /* Hace que el texto empiece fuera del contenedor */
            animation: move-text 10s linear forwards;
        }

        @keyframes move-text {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100%);
            }
        }
    </style>
    </style>
</head>
<body>
    <div class="container">
         <center><h1>Agregar usuarios</h1>
        <div class="container1">
        <?php echo "<h3><div class='moving-text'>$mensaje</div>"; ?>
        </div>
        </h3>
        </center>
        <form class="row g-3 needs-validation" method="post" id="dataForm" novalidate>
        <div class="col-md-6">
            <label for="validationCustom01" class="form-label">ID</label>
            <input type="text" class="form-control" id="validationCustom01" required name="id">
            <div class="invalid-feedback">Por favor, ingrese un ID válido.</div>
        </div>
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" id="validationCustom02" required name="usuario">
            <div class="invalid-feedback">Por favor, ingrese un nombre completo.</div>
        </div>
        <div class="col-md-6">
            <center><button class="btn btn-primary" type="submit" id="agregarButton"><h6>Agregar a la tabla</h6></button></center>
        </div>
        <div class="col-md-6">
            <center><a class="btn btn-lg btn-primary" href="consulta.php" role="button"><h6>Mostrar usuarios agregados</h6></a></center>
        </div>
    </form>
    <script>
        // JavaScript para la validación del formulario
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Obtener el formulario
                var form = document.getElementById('dataForm');
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            }, false);
        })();
    </script>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
