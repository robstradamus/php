<?php
    include("../../conexion.php");
    $id = $_GET["cod"];
    $sql = "DELETE FROM revision WHERE cod_revision = '$id';";
    $res = mysqli_query($con,$sql);
    if($res  === true){
        echo "Eliminado correctamente. Redirigiendo...";
        header("Refresh: 2; URL=listadoRevision.php");
    }else{
        echo "Error al eliminar". mysqli_error($con);
    }
?>