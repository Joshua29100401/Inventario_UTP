<?php
    $mensaje="";
    if($_SERVER['REQUEST_METHOD']==='POST')
    {
    $idBorrar = intval($_POST['id_usra']);
    //echo $idBorrar;

    $miconexion = new mysqli("localhost", "root", "", "proyecto");
    if ($miconexion->connect_errno) {
        echo "Fallo al conectar con MySQL";
    }

        $sql="DELETE FROM alta_categoria WHERE Id_categoria=$idBorrar";
        if($miconexion->query($sql)===TRUE)
        {
            $mensaje="Usuario eliminado correctamente";   
            $miconexion->close();
            header("Location: consulta_categorias.php");
            exit();
            //echo "alert('Usuario eliminado')";

        } 
    }
    else{
        echo "Método no permitido";
    }
?>
