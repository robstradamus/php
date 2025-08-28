<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Detalle de Prestamo</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/links.css">
</head>
<body>
    <?php
        include("../../conexion.php");
        
        // Consulta Socio
        $sql_socio = "SELECT socio.cod_socio, socio.nom_socio
                    FROM prestamo
                    INNER JOIN socio ON prestamo.cod_socio = socio.cod_socio";
        $res_socio = mysqli_query($con,$sql_socio);

        // Consulta Libro
        $sql_libro = "SELECT * FROM libro WHERE estado = 'En Biblioteca'";
        $res_libro = mysqli_query($con,$sql_libro);

    ?>

    <div class="form-container">
        <form action="" method="post">
            <h2>Registrar Detalle de Prestamo</h2>
            <label for="">Socio</label>

            <select name="cod_socio">
                <option value="0">Seleccione Socio</option>
                <?php
                    while($value_socio = mysqli_fetch_assoc($res_socio)){
                        echo "<option value='{$value_socio['cod_socio']}'>{$value_socio['nom_socio']}</option>";
                    }
                ?>
            </select>

            <label for="">Libro</label>
            <select name="cod_libro">
                <option value="0">Seleccione Libro</option>
                <?php
                    while($value_libro = mysqli_fetch_assoc($res_libro)){
                        echo "<option value='{$value_libro['cod_libro']}'>{$value_libro['titulo']}</option>";
                    }
                ?>
            </select>

            <label for="">Observaciones</label>
            <input type="text" name="obs">

            <input type="submit" name="registrar" value="Registrar Detalle">
        </form>
        <div class="links-container">
            <a href="indexDetalle.html" class="btn-back">Volver Atras</a>
        </div>
    </div>    
    <?php
        //include("../../conexion.php");

        if(isset($_POST['registrar'])){

            $socio = $_POST['cod_socio'];
            $libro = $_POST['cod_libro'];
            $obs = $_POST['obs'];

            // Se verifica que este seleccionado un socio y un libro
            if($socio == '0' || $libro == '0'){
                echo "Debe seleccionar un Socio y un Libro";
                exit;
            }
            // Buscamos el ultimo prestamo del socio seleccionado
            $sql_prestamo = "SELECT cod_prestamo FROM prestamo WHERE cod_socio = '$socio'
                            ORDER BY cod_prestamo DESC LIMIT 1";
            $res_prestamo = mysqli_query($con,$sql_prestamo);
            if($row = mysqli_fetch_assoc($res_prestamo)){
                $cod_prestamo = $row['cod_prestamo'];
            }else{
                echo "El socio seleccionado no tiene prestamos registrados.";
                exit;
            }

            // Insertamos el detalle del prestamo
            $sql = "INSERT INTO detalleprestamo (cod_prestamo,cod_libro,observaciones)
                    VALUES('$cod_prestamo','$libro','$obs')";
            $res = mysqli_query($con,$sql);

            // Cambiamos el estado del libro a 'Prestado'
            if($res === true){
                $sql_upd = "UPDATE libro SET estado = 'Prestado' WHERE cod_libro = '$libro'";
                $res_upd = mysqli_query($con,$sql_upd);
                echo "Detalles de Prestamos registrados correctamente... Redirigiendo...";
                header("Refresh: 3; URL=indexDetalle.html");
            }else{
                echo "Error al registrar Detalles". mysqli_error($con);
            }
        }
    ?>
</body>
</html>