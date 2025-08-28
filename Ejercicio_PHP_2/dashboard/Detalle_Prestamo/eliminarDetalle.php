<?php
    include("../../conexion.php");

    $id = $_GET['cod'];

    // Obtener el codigo del libro
    $sql_libro = "SELECT cod_libro FROM detalleprestamo WHERE cod_detalle ='$id'";
    $res_libro = mysqli_query($con,$sql_libro);
    $cod = mysqli_fetch_assoc($res_libro);

    if($cod){
        $cod_libro = $cod['cod_libro'];

        //Eliminar Detalle
        $sql_del = "DELETE FROM detalleprestamo WHERE cod_detalle = '$id'";
        $res_del = mysqli_query($con,$sql_del);

        if($res_del){
            // Se actualiza el estado del Libro
            $sql_upd = "UPDATE libro SET estado = 'En Biblioteca' WHERE cod_libro = '$cod_libro'";
            mysqli_query($con,$sql_upd);
            echo "Detalle Eliminado correctamente. Redirigiendo ...";
            header("Refresh: 3; URL=listadoDetalle.php");
            
        }else{
            echo "Error al eliminar el detalle". mysqli_error($con);
            header("Refresh: 3; URL=listadoDetalle.php");
        }
    }else{
        echo "Detalle de Prestamo no encontrado. Redirigiendo...";
        header("Refresh:3;URL=listadoDetaalle.php");
    }

?>