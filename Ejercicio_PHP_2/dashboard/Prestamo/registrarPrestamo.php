<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Prestamo</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/links.css">
</head>
<body>
    <?php
        include("../../conexion.php");
        // Consulta de para elegir socio
        $sql_socio = "SELECT * FROM socio";
        $res_socio = mysqli_query($con,$sql_socio);
    ?>
    <div class="form-container">
        <form action="" method="post">
            <h2>Registrar Prestamo</h2>

            <label for="">Socio</label>
            <select name="socio">
                <option value="0">Seleccione Socio</option>
                <?php
                    while($value = mysqli_fetch_assoc($res_socio)){
                        echo "<option value='{$value['cod_socio']}'>{$value['nom_socio']} </option>";
                    }
                ?>
            </select>

            <label for="">Fecha de Prestamo</label>
            <input type="date" name="fprestamo">

            <label for="">Fecha de Devolucion</label>
            <input type="date" name="fdevolucion">

            <label for="">Estado</label>
            <input type="text" name="estado">

            <input type="submit" name="registrar" value="Registrar">
        </form>
        <div class="links-container">
            <a href="indexPrestamo.html" class="btn-back">Volver Atras</a>
        </div>
    </div>
    <?php
        //include("../../conexion.php");

        if(isset($_POST['registrar'])){
            $socio = $_POST['socio'];
            $fprestamo = $_POST['fprestamo'];
            $fdevolucion = $_POST['fdevolucion'];
            $estado = $_POST['estado'];

            if(empty($fdevolucion)){
                $f_devolucion = "NULL";
            }else{
                $f_devolucion = "'$fdevolucion'";
            }

            $sql_prestamo = "INSERT INTO prestamo(f_prestamo,f_devolucion,estado,cod_socio)
                            VALUES('$fprestamo',$f_devolucion,'$estado','$socio')";
            $res_prestamo = mysqli_query($con,$sql_prestamo);

            if($res_prestamo === true){
                echo "Prestamo registrado correctamente. Recargando";
                header("Refresh: 3; URL=indexPrestamo.html");
            }else{
                echo "Error al registrar prestamo". mysqli_error($con);
            }
        }
    ?>
</body>
</html>