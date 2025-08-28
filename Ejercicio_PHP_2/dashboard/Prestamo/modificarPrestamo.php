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

        // Obtenemos los datos de prestamo
        $sql_prestamo = "SELECT * FROM prestamo WHERE cod_prestamo = '$id'";
        $res_prestamo = mysqli_query($con,$sql_prestamo);
        // Obtenemos los datos de Socio
        $sql_socio = "SELECT * FROM socio";
        $res_socio = mysqli_query($con,$sql_socio);
        // Array
        $value = mysqli_fetch_assoc($res_prestamo);

    ?>
    <div class="form-container">
        <form action="" method="post">
            <h2>Modificar Prestamo</h2>

            <label for="">Socio</label>
            <select name="socio" required>
                <option value="0">Seleccione Socio</option>
                <?php
                    while($socio = mysqli_fetch_assoc($res_socio)){
                        $selected = ($socio['cod_socio'] == $value['cod_socio']) ? "selected" : "";
                        echo "<option value='{$socio['cod_socio']}' $selected>{$socio['nom_socio']} </option>";
                    }
                ?>
            </select>
            
            <input type="hidden" name="cod_prestamo" value="<?php echo $value['cod_prestamo']; ?>">

            <label for="">Fecha de Prestamo</label>
            <input type="date" name="fprestamo" value="<?php echo $value['f_prestamo']; ?>" required>

            <label for="">Fecha de Devolucion</label>
            <input type="date" name="fdevolucion" value="<?php echo $value['f_devolucion']; ?>">

            <label for="">Estado</label>
            <input type="text" name="estado" value="<?php echo $value['estado']; ?>" required>

            <input type="submit" name="modificar" value="Modificar">
        </form>
        <div class="links-container">
            <a href="listadoPrestamo.php" class="btn-back">Volver Atras</a>
        </div>
    </div>
    <?php
        //include("../../conexion.php");
        // Validar si el usuario ingresa Fecha de devolucion
        if(isset($_POST['modificar'])){

            $cod_prestamo = $_POST['cod_prestamo'];
            $fprestamo = $_POST['fprestamo'];
            $fdevolucion = $_POST['fdevolucion'];
            $estado = $_POST['estado'];
            $socio = $_POST['socio'];

            if(empty($fdevolucion)){
                $f_devolucion = "NULL";
            }else{
                $f_devolucion = "'$fprestamo'";
            }

            $sql_upd = "UPDATE prestamo SET f_prestamo = '$fprestamo', f_devolucion = $f_devolucion, estado = '$estado', cod_socio = '$socio'
                        WHERE cod_prestamo = '$cod_prestamo'";
            $res_upd = mysqli_query($con,$sql_upd);

            if($res_upd === true && !empty($f_devolucion)){
                echo "Prestamo Actualizado correctamente. Redirigiendo...";
                header("Refresh: 3; URL=listadoPrestamo.php");
            }else{
                echo "Error al actualizar Prestamo". mysqli_error($con);
            }

        }
    ?>
</body>
</html>