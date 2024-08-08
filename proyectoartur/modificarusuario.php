<?php
$miconexion = new mysqli("localhost", "root", "", "proyecto");
if ($miconexion->connect_errno) {
    echo "Fallo al conectar con MySQL";
    exit();
}

// Verificar si se ha enviado un formulario para actualizar datos
if (isset($_POST['id']) && isset($_POST['usuario'])) {
    // Obtener los valores enviados por el formulario
    $id = trim($_POST["id"]);
    $usuario = trim($_POST["usuario"]);

    // Validar que los campos no estén vacíos
    if (empty($id) || empty($usuario)) {
        echo "Por favor, complete todos los campos.";
    } else {
        // Actualizar los datos en la base de datos
        $actualizar = $miconexion->prepare("UPDATE colaboradores1 SET Nombre_completo=? WHERE id=?");
        $actualizar->bind_param("si", $usuario, $id);
        $resultado = $actualizar->execute();

        if ($resultado) {
            echo "Datos actualizados correctamente.";
            $miconexion->close();
            header("Location: consulta.php");
            exit();
        } else {
            echo "Error al actualizar los datos.";
        }

        $actualizar->close();
    }
}
$miconexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
    <h1>Actualizar usuario</h1>
    <form action="" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas modificar a este usuario?')">
    <label for="clientId">ID del usuario a modificar:</label>
    <input type="text" id="clientId" name="id" required>
    <label for="newUser">Nuevo usuario:</label>
    <input type="text" id="newUser" name="usuario" required>
    <button type="submit">Actualizar datos</button>
    </form>
</div>
</body>
</html>
