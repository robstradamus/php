<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regsitrar Reparacion</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/links.css">
</head>
<body>  
    <?php
        include("../../conexion.php");
        // CONSULTA LIBROS
        $sql_libro = "SELECT * FROM libro WHERE estado = 'En Biblioteca'";
        $res_libro = mysqli_query($con,$sql_libro);
    ?>

    <div class="form-container">
        <form action="" method="post">
            <h2>Registrar Reparacion</h2>

            <label for="">Fecha de Ingreso</label>
            <input type="date" name="fingreso">

            <label for="">Motivo</label>
            <input type="text" name="motivo">

            <label for="">Fecha de Egreso</label>
            <input type="date" name="fegreso">

            <select name="libro">
                <option value="0">Seleccione Libro</option>
                <?php
                    while($value = mysqli_fetch_assoc($res_libro)){
                        echo "<option value='{$value['cod_libro']}'>{$value['titulo']}</option>";
                    }
                ?>
            </select>

            <input type="submit" name="registrar" value="Registrar">
        </form>

        <div class="links-container">
            <a href="indexReparacion.html" class="btn-back">Volver Atras</a>
        </div>
    </div>
    <?php
        include("../../conexion.php");

        if(isset($_POST["registrar"])){
            $fingreso = $_POST['fingreso'];
            $motivo = $_POST['motivo'];
            $fegreso = $_POST['fegreso'];
            $id_libro = $_POST['libro'];

            //validar la fecha de engreso
            if(empty($fegreso)){
                $f_egreso = "NULL";
            }else{
                $f_egreso = "'$fegreso'";
            }

            $sql_reparacion = "INSERT INTO reparacion(cod_libro, f_ingreso, f_egreso, motivo)
                            VALUES('$id_libro','$fingreso',$f_egreso,'$motivo');";
            $res = mysqli_query($con,$sql_reparacion);

            if($res === true){
                // Actualizamos el Estado del Libro seleccionado 
                $sql_libro = "UPDATE libro SET estado = 'En Reparacion' WHERE cod_libro = '$id_libro'";
                $res_libro = mysqli_query($con,$sql_libro);
                echo "Reparacion registrada correctamente. Redirigiendo...";
                header("Refresh: 3;URL=registrarReparacion.php");
            
            }
        }
    ?>
</body>
</html>