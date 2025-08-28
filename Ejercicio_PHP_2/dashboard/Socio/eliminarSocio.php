<?php
    include("../../conexion.php");

    $idSocio = $_GET["cod"];

    // Verificar si el socio tiene prestamos activos

    $sql_prestamo = "SELECT * FROM prestamo WHERE cod_socio = '$idSocio'";
    $res_prestamo = mysqli_query($con,$sql_prestamo);
    
    if(mysqli_num_rows($res_prestamo) > 0){
        echo "No se puede eliminar por tener préstamos registrados. Redirigiendo";
        header("Refresh: 3; URL=listadoSocio.php");
    }else{
            
        $sql_eliminar = "DELETE FROM socio WHERE cod_socio = '$idSocio';";
        $res = mysqli_query($con,$sql_eliminar);

        if($res === true){
            echo "Socio eliminado correctamente. Redirigiendo...";
            header("Refresh: 3; URL=listadoSocio.php");
        }else{
            echo "Error al eliminar Socio". mysqli_error($con);
        }
    }
?>