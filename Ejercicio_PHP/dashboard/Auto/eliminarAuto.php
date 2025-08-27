<?php
    include("../../conexion.php");
    $id = $_GET["cod"];
    $sqlcheck = "SELECT * FROM revision WHERE id_auto = '$id';";
    $resulCheck = mysqli_query($con,$sqlcheck);
    if(mysqli_num_rows($resulCheck) > 0){
        echo "No se puede eliminar por tener revisiones registradas. Redirigiendo ...";
        header("Refresh: 2; URL=listadoAutos.php");
    }else{
        $sql = "DELETE FROM auto WHERE cod_auto = '$id';";
        $res = mysqli_query($con,$sql);
        if($res === true){
            echo "Eliminado correctamente. Redirigiendo ...";
            header("Refresh: 2; URL=listadoAutos.php");
        }else{
            echo "Error al eliminar". mysqli_error($con);
        }
    }
?>