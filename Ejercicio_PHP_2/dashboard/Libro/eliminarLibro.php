<?php
    include("../../conexion.php");

    $id = $_GET["cod"];
    // Verificamos si el libro tiene reparaciones
    $sql_reparacion = "SELECT * FROM reparacion WHERE cod_libro = '$id'";
    $res_reparacion = mysqli_query($con,$sql_reparacion);
    // Verificamos si el libro esta en un prestamo
    $sql_prestamo = "SELECT * FROM detalleprestamo WHERE cod_libro = '$id'";
    $res_prestamo = mysqli_query($con,$sql_prestamo);
    // Si el libro figura en alguno no se elimina
    if(mysqli_num_rows($res_reparacion) > 0 || mysqli_num_rows($res_prestamo) > 0){
        echo "No se puede eliminar por tener préstamos/reparaciones registrados";
        header("Refresh: 3; URL=listadoLibro.php");
    }else{
        $sql = "DELETE FROM libro WHERE cod_libro = '$id'";
        $res = mysqli_query($con, $sql);
        if($res === true ){
            echo "Eliminado correctamente. Redirigiendo...";
            header("Refresh: 2; URL=listadoLibro.php");
        }else{
            echo "Error al eliminar Libro". mysqli_error($con);
        }
    }
?>