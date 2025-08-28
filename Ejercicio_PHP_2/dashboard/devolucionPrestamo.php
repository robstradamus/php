<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devolucion</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/tabla.css">
</head>
<body>
    <div class="table-container">
        <h2>Devolucion de Prestamo</h2>
        <a href="dashboard.html" class="btn-back">Volver Atras</a>
        <br> <br>
        <?php
            include("../conexion.php");

            //Procescar Devolucion si se hizo click en Devolver
            if(isset($_POST['devolver'])){
                $cod_detalle = $_POST['cod_detalle'];

                // Obtenemos el codigo del libro y prestamo
                $sql_detalle = "SELECT * FROM detalleprestamo WHERE cod_detalle = '$cod_detalle'";
                $res_detalle = mysqli_query($con,$sql_detalle);
                $detalle = mysqli_fetch_assoc($res_detalle);

                $cod_libro = $detalle['cod_libro'];
                $cod_prestamo = $detalle['cod_prestamo'];

                // Cambiar el estado del Libro a 'En Biblioteca'
                $sql_libro = "UPDATE libro SET estado = 'En Biblioteca' WHERE cod_libro = '$cod_libro'";
                mysqli_query($con,$sql_libro);

                // Si el prestamo no tiene Fecha de Devolucion establecemos una. Usamos la funcion CURDATE()
                // CURDATE() --> Devuelve la fecha actual del sistema.
                $sql_prestamo = "SELECT f_devolucion FROM prestamo WHERE cod_prestamo = '$cod_prestamo'";
                $res_prestamo = mysqli_query($con,$sql_prestamo);
                $prestamo = mysqli_fetch_assoc($res_prestamo);

                if(empty($prestamo['f_devolucion']) || $prestamo['f_devolucion'] === "0000-00-00"){
                    $sql_upd = "UPDATE prestamo SET f_devolucion = CURDATE() WHERE cod_prestamo ='$cod_prestamo'";
                    mysqli_query($con,$sql_upd);
                }

                echo "Libro devuelto correctamente";
                header("Refresh:3;URL=devolucionPrestamo.php");
            }
            // Listado de prestamo con libros prestados
            // Consultamos los datos de socio, prestamos y libros
            $sql_prestamo = "SELECT socio.*,prestamo.*,libro.*, detalleprestamo.cod_detalle FROM detalleprestamo
                            INNER JOIN prestamo ON detalleprestamo.cod_prestamo = prestamo.cod_prestamo
                            INNER JOIN socio ON socio.cod_socio = prestamo.cod_socio
                            INNER JOIN libro ON libro.cod_libro = detalleprestamo.cod_libro
                            WHERE libro.estado = 'Prestado'";
            $res_prestamo = mysqli_query($con,$sql_prestamo);

            if(mysqli_num_rows($res_prestamo) == 0){
                echo "No hay Prestamos registrados. Redirigiendo...";
                header("Rerfesh:3;URL=dashboard.html");
            }else{
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Nombre Socio</th>";
                echo "<th>Fecha de Prestamo</th>";
                echo "<th>Fecha de Devolucion</th>";
                echo "<th>Libro</th>";
                echo "<th>Estado</th>";
                echo "<th>Devolucion</th>";
                while($value = mysqli_fetch_assoc($res_prestamo)){
                    echo "<tr>";
                    echo "<td>{$value['nom_socio']}</td>";
                    echo "<td>{$value['f_prestamo']}</td>";
                    echo "<td>{$value['f_devolucion']}</td>";
                    echo "<td>{$value['titulo']}</td>";
                    echo "<td>{$value['estado']}</td>";
                    echo "<td>
                            <form method='post'>
                                <input type='hidden' name='cod_detalle' value='{$value['cod_detalle']}'>
                                <input type='submit' name='devolver' value='Devolver'>
                            </form>    
                        </td>";
                    echo "</tr>";
                }
                echo "</table>";
            }

        ?>
    </div>
</body>
</html>