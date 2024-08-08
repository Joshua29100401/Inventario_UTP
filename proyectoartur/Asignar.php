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
            header("Location: tabla.php");
            exit();
        } else {
            echo "Error al actualizar los datos.";
        }

        $actualizar->close();
    }
}
$miconexion->close();
?>