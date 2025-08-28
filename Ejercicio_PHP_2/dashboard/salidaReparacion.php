<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Salida de Reparacion</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/tabla.css">
</head>
<body>
    <div class="table-container">
        <h2>Registrar salida de Reparacion</h2>
        <a href="dashboard.html" class="btn-back">Volver al Menu</a>
        <br> <br>
        <?php
            include("../conexion.php");

            // Consulta de los libros que estan 'En Reparacion'
            
            $sql_libros = "SELECT reparacion.*, libro.* FROM reparacion
                            INNER JOIN libro ON libro.cod_libro = reparacion.cod_libro
                            WHERE libro.estado = 'En Reparacion' AND (reparacion.f_egreso IS NULL OR reparacion.f_egreso = '0000-00-00')";
            $res_libros = mysqli_query($con, $sql_libros);

            if(mysqli_num_rows($res_libros)==0){
                echo "No hay libros en reparacion. Redirigiendo...";
                header("Refresh:3;URL=dashboard.html");
            } else {
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Codigo Libro</th>";
                echo "<th>Titulo</th>";
                echo "<th>Fecha de Ingreso</th>";
                echo "<th>Motivos</th>";
                echo "<th>Registrar Salida</th>";
                echo "</tr>";
                while( $value = mysqli_fetch_assoc($res_libros)){
                    echo "<tr>";
                    echo "<td>{$value['cod_libro']}</td>";
                    echo "<td>{$value['titulo']}</td>";
                    echo "<td>{$value['f_ingreso']}</td>";
                    echo "<td>{$value['motivo']}</td>";
                    echo "<td>
                            <form method='post'>
                                <input type='hidden' name='cod_reparacion' value='{$value['cod_reparacion']}'>
                                <input type='hidden' name='cod_libro' value='{$value['cod_libro']}'>
                                <input type='submit' name='salida' value='Devolver'>

                            </form>
                        </td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
        
        <?php
            if(isset($_POST['salida'])){
                $cod_reparacion = $_POST['cod_reparacion'];
                $cod_libro = $_POST['cod_libro'];

                // Registramos la fecha de egreso, usamos CURDATE()
                $sql_upd = "UPDATE reparacion SET f_egreso = CURDATE() WHERE cod_reparacion = '$cod_reparacion'";
                $res_rep = mysqli_query($con,$sql_upd);

                // Cambiamos el estado del libro a 'En Biblioteca'
                $sql_upd_libro = "UPDATE libro SET estado = 'En Biblioteca' WHERE cod_libro = '$cod_libro'";
                $res_lib = mysqli_query($con,$sql_upd_libro);

                if($res_rep && $res_lib === true){
                    echo "Salida de reparacion registrada correctamente. Redirigiendo ...";
                    header("Refresh: 3;URL=salidaReparacion.php");
                }else{
                    echo "Error al registrar salida". mysqli_error($con);
                }

            }
        ?>
    </div>
</body>
</html>