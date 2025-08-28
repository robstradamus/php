<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Prestamo</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/listado.css">
</head>
<body>
    <div class="table-container">
        <h2>Listado de Prestamos</h2>
        <a href="indexPrestamo.html" class="btn-back">Volver Atras</a>
        <br> <br>
        <?php
            include("../../conexion.php");

            $sql_prestamo = "SELECT prestamo.*, socio.*
                            FROM prestamo
                            INNER JOIN socio ON prestamo.cod_socio = socio.cod_socio"; // Validar si el estado debe cambiar
            $res_prestamo = mysqli_query($con,$sql_prestamo);

            if(mysqli_num_rows($res_prestamo) == 0){
                echo "No hay prestamos registrados. Redirigiendo...";
                header("Refresh: ");
            }else{
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Cod Prestamo</th>";
                echo "<th>Fecha de Prestamo</th>";
                echo "<th>Fecha de Devolucion</th>";
                echo "<th>Estado</th>";
                echo "<th>Nombre Socio</th>";
                echo "<th>Telefono</th>";
                echo "<th>Modificar</th>";
                echo "<th>Eliminar</th>";
                echo "</tr>";
                while($value = mysqli_fetch_assoc($res_prestamo)){
                    echo "<tr>";
                    echo "<td>{$value['cod_prestamo']}</td>";
                    echo "<td>{$value['f_prestamo']}</td>";
                    echo "<td>{$value['f_devolucion']}</td>";
                    echo "<td>{$value['estado']}</td>";
                    echo "<td>{$value['nom_socio']}</td>";
                    echo "<td>{$value['tel_socio']}</td>";
                    echo "<td> <a href='modificarPrestamo.php?cod={$value['cod_prestamo']}'>Modificar </td>";
                    echo "<td> <a href='eliminarPrestamo.php?cod={$value['cod_prestamo']}'>Eliminar </td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
    </div>
</body>
</html>