<?php
$mensaje = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $miConexion = new mysqli("localhost", "root", "", "proyecto");

    // Verificar conexión
    if ($miConexion->connect_errno) {
        $mensaje = "Fallo al conectar con MySQL: " . $miConexion->connect_error;
    } else {
        // Obtener los datos del formulario
        $elusuario = $_POST["categoriaa"];

        // Usar una consulta preparada para evitar inyecciones de SQL
        $stmt = $miConexion->prepare("INSERT INTO alta_categoria (Nombre_cat) VALUES (?)");
        $stmt->bind_param("s", $elusuario);

        if ($stmt->execute()) {
            $mensaje = "Categoría agregada correctamente";
            echo "<script>alert('$mensaje');</script>";
        } else {
            $mensaje = "Error al agregar categoría: " . $stmt->error;
        }

        // Cerrar la consulta preparada y la conexión
        $stmt->close();
        $miConexion->close();
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar categoría</title>
    <link rel="icon" href="images/Universidad.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="stylescategoria.css" rel="stylesheet">
</head>
<body>
    
        <div class="title">
            <h3> Agregar Categoría
     

    <br> <br> <br> <br><br>

    <form class="row g-3 needs-validation" action="" method="post" id="dataForm" novalidate>
        <div class="container">
            <div class="coolinput">
                <label for="input" class="text">Nombre de categoría</label>
                <input type="text" placeholder="..." class="input" id="validationCustom02" required name="categoriaa">
            </div>

        </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-6 text-center">
        <button class="cta" type="submit" id="agregarButton">
            <span>Agregar</span>
            <svg width="15px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
            </svg>
        </button>
    </div>
    </form>
    <div class="col-md-6 text-center">
        <a href="consulta_categorias.php"><button class="cta" href="consulta_categorias.php" role="button">
            <span>Mostrar categorías</span>
            <svg width="15px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
            </svg>
        </button></a>
    </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>
</html>