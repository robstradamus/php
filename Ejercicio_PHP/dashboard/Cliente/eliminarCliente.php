<?php
    include("../../conexion.php");

    $id = $_GET["cod"];
    // Verificamos si el cliente tiene autos registrados
    $check = "SELECT * FROM auto WHERE id_cliente = '$id';";
    $result_check = mysqli_query($con,$check);

    if(mysqli_num_rows($result_check) > 0){
        echo "No se puede eliminar. El Cliente tiene autos registrados. Redirigiendo...";
        header("Refresh: 2; URL=listadoCliente.php");
    }else{
        //No tiene autos y se puede eliminar
        $sql = "DELETE FROM cliente WHERE cod_cliente='$id';";
        $res = mysqli_query($con,$sql);
        
        if($res === true){
            header("Refresh: 2; URL=listadoCliente.php");
            echo "Eliminado con exito. Redirigiendo ...";
        }else{
            echo "Error al eliminar Cliente". mysqli_error($con);
        }
    }

?>