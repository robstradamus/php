<?php
    include("../../conexion.php");
    
    $idReparacion = $_GET['cod'];
    // Obtenemos el codigo del libro 
    $sql_libro = "SELECT cod_libro FROM reparacion WHERE cod_reparacion = '$idReparacion'";
    $res_libro = mysqli_query($con,$sql_libro);
    $libro = mysqli_fetch_assoc($res_libro);
    $cod_libro = $libro['cod_libro'];
    
    //Eliminamos reparacion
    $sql_eliminar = "DELETE FROM reparacion WHERE cod_reparacion = '$idReparacion'";
    $res = mysqli_query($con,$sql_eliminar);

    if($res === true){
        // Cambiar el estado del libro
        $sql_upd = "UPDATE libro SET estado = 'En Biblioteca' WHERE cod_libro = '$cod_libro'";
        mysqli_query($con,$sql_upd);
        
        echo "Reparacion eliminada correctamente. Redirigiendo ...";
        header("Refresh: 3; URL=listarReparacion.php"); 
    }else{
        echo "Error al eliminar reparacion". mysqli_error($con);
    }

?>