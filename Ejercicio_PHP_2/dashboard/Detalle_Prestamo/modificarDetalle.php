<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Prestamo</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/links.css">
</head>
<body>
    <?php
        include("../../conexion.php");

        $id = $_GET['cod']; 
        //Consular Detalle de Prestamo
        $sql_detalle = "SELECT * FROM detalleprestamo WHERE cod_detalle = '$id'";
        $res_detalle = mysqli_query($con,$sql_detalle);
        $value_detalle = mysqli_fetch_assoc($res_detalle);

        $cod_libro = $value_detalle['cod_libro']; // Guardamos el Libro Actual

        //Consulta Libro
        $sql_libro = "SELECT * FROM libro WHERE estado = 'En Biblioteca' OR cod_libro = '$cod_libro'";
        $res_libro = mysqli_query($con,$sql_libro);
    ?>

    <div class="form-container">
        <h2>Modificar Detalle de Prestamo</h2>
        <form action="" method="post">
            <label for="">Libro</label>
            <select name="cod_libro">
                <option value="0">Seleccione Libro</option>
                <?php
                    while($value = mysqli_fetch_assoc($res_libro)){
                        $selected = ($value['cod_libro'] == $cod_libro) ? "selected" : "";
                        echo "<option value='{$value['cod_libro']}' $selected>{$value['titulo']}</option>";
                    }
                ?>
            </select>  

            <label for="">Observaciones</label>
            <input type="text" name="obs" value="<?php echo $value_detalle['observaciones']; ?>">

            <input type="submit" name="modificar" value="Modificar Detalle">
        </form>
        <div class="links-container">
            <a href="listadoDetalle.php" class="btn-back">Volver al Listado</a>
        </div>
    </div>
    
    <?php
        if(isset($_POST['modificar'])){
            $id_libro = $_POST['cod_libro'];
            $obs = $_POST['obs'];

            if($id_libro != $cod_libro ){
                // El libro anterior vuelve a estar Disponible
                $sql_libAnt = "UPDATE libro SET estado = 'En Biblioteca' WHERE cod_libro = '$cod_libro'";
                mysqli_query($con,$sql_libAnt);
                //El nuevo Libro queda como prestado
                $sql_libNew = "UPDATE libro SET estado = 'Prestado' WHERE cod_libro='$id_libro'";
                mysqli_query($con,$sql_libNew);
            }
            // Actualizar el Detalle del prestamo
            $sql_upd = "UPDATE detalleprestamo SET cod_libro = '$id_libro', observaciones = '$obs'
                        WHERE cod_detalle = '$id'";
            $res_upd = mysqli_query($con,$sql_upd);
            if($res_upd === true){
                echo "Detalle Actualizado correctamente. Redirigiendo...";
                header("Refresh: 3; URL=listadoDetalle.php");
            }else{
                echo "Error al actualizar Detalle". mysqli_error($con);
            }
        }
    ?>
</body>
</html>