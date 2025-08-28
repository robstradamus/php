<?php
    include("../../conexion.php");

    $id = $_GET['cod'];

    $sql_prestamo = "SELECT * FROM prestamo WHERE cod_prestamo = '$id'";
    $res_prestamo = mysqli_query($con,$sql_prestamo);
    $prestamo = mysqli_fetch_assoc($res_prestamo);

    if(mysqli_num_rows($res_prestamo) == 0){
        echo "No hay prestamo Registrados";
        header("Rerfesh: 3; URL=listadoPrestamo.php");
        exit;
    }

    // Verificamos si el prestamo tiene fecha de devolucion
    if(empty($prestamo['f_devolucion']) || $prestamo['f_devolucion'] == '0000-00-00'){
        echo "Prestamo vigente. No se puede eliminar";
        header("Refresh:3; URL=listadoPrestamo.php");
        exit;
    }

    //Eliminar los detalles del prestamo pòr integridad referencial (Si tiene fecha elimina primero los registros de detalleprestamo)
    $sql_detalle = "DELETE FROM detalleprestamo WHERE cod_prestamo = '$id'";
    mysqli_query($con,$sql_detalle);

    //Eliminar el Prestamo

    $sql_del = "DELETE FROM prestamo WHERE cod_prestamo = '$id'";
    $res_del = mysqli_query($con,$sql_del);

    if($res_del === true){
        echo "Prestamo eliminado correctamente";
        header("Refresh: 3; URL=listadoPrestamo.php");
    }else{
        echo "Error al eliminar Prestamo". mysqli_error($con);
    }

?>