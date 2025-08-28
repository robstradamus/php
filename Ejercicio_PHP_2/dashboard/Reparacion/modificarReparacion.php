<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Reparacion</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/links.css">
</head>
<body>
    <?php
        include("../../conexion.php");
        //Obtener ID del Listado revision
        $idReparacion= $_GET['cod'];
        // Obtenemos los datos de Reparacion
        $sql = "SELECT * FROM reparacion WHERE cod_reparacion = '$idReparacion'";
        $res = mysqli_query($con, $sql);
        // Obtenemos los datos de Libro
        $sql_libro = "SELECT cod_libro, titulo FROM libro";
        $res_libro = mysqli_query($con,$sql_libro);

        // Array 
        $value = mysqli_fetch_assoc($res);
    ?>
    <div class="form-container">
        <form action="" method="post">
            <h2>Modificar Reparacion</h2>
            <label for="">ID Reparacion</label>
            <input type="text" name="id_reparacion" value="<?php echo $value['cod_reparacion']; ?>" readonly>

            <label for="">Fecha de Ingreso</label>
            <input type="date" name="fingreso" value="<?php echo $value['f_ingreso']; ?>">

            <label for="">Motivo</label>
            <input type="text" name="motivo" value="<?php echo $value['motivo']; ?>">

            <label for="">Fecha de Egreso</label>
            <input type="date" name="fegreso" value="<?php echo $value['f_egreso']; ?>">

            <select name="libro">
                <?php
                    while($libro = mysqli_fetch_assoc($res_libro)){
                        $selected = ($libro['cod_libro'] == $value['cod_libro']) ? "selected" : "";
                        echo "<option value='{$libro['cod_libro']}' $selected> {$libro['titulo']} </option>";
                    }
                ?>
            </select>

            <input type="submit" name="modificar" value="Modificar">
        </form>
        <div class="links-container">
            <a href="listarReparacion.php" class="btn-back">Volver al Listado</a>
        </div>
    </div>
    <?php
        if(isset($_POST['modificar'])){
            $idReparacion = $_POST['id_reparacion'];
            $fingreso = $_POST['fingreso'];
            $motivo = $_POST['motivo'];
            $fegreso = $_POST['fegreso'];
            $libro = $_POST['libro'];
            
            $f_egreso = empty($fegreso) ? "NULL" : "'$fegreso'";

            $sql_upd = "UPDATE reparacion SET cod_libro = '$libro', f_ingreso = '$fingreso', motivo = '$motivo', f_egreso = $f_egreso
                        WHERE cod_reparacion = '$idReparacion'";
            $res = mysqli_query($con,$sql_upd);
            
            if($res === true){
                if(!empty($fegreso)){
                    $sql_estado = "UPDATE libro INNER JOIN reparacion ON libro.cod_libro = reparacion.cod_libro
                            SET  libro.estado = 'En Biblioteca'
                            WHERE reparacion.cod_reparacion = '$idReparacion' AND reparacion.f_egreso IS NOT NULL";
                    mysqli_query($con,$sql_estado);
                }
                echo "Reparacion realizada correctamente. Redirigiendo...";
                header("Refresh: 3; URL=listarReparacion.php");
            }else{
                echo "Error al modificar datos". mysqli_error($con);
            }

        }

    ?>
</body>
</html>