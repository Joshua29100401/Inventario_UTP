
<?php
    $mensaje="";
    if($_SERVER['REQUEST_METHOD']==='POST')
    {
    $idBorrar = intval($_POST['id_usr']);
    //echo $idBorrar;

    $miconexion = new mysqli("localhost", "root", "", "proyecto");
    if ($miconexion->connect_errno) {
        echo "Fallo al conectar con MySQL";
    }

        $sql="DELETE FROM colaboradores1 WHERE Id=$idBorrar";
        if($miconexion->query($sql)===TRUE)
        {
            $mensaje="Usuario eliminado correctamente";   
            $miconexion->close();
            header("Location: consulta.php");
            exit();
            //echo "alert('Usuario eliminado')";

        } 
    }
    else{
        echo "Método no permitido";
    }
?>
