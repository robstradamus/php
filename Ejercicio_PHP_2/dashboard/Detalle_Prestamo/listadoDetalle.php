<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Detalles</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/listado.css">
</head>
<body>
    <div class="table-container">
        <h2>Listado de Detalles de Prestamos</h2>
        <a href="indexDetalle.html" class="btn-back">Volver Atras</a>
        <br> <br>
        <?php
            include("../../conexion.php");

            $sql = "SELECT detalleprestamo.*, socio.*, libro.*, prestamo.* FROM detalleprestamo
                    INNER JOIN prestamo ON detalleprestamo.cod_prestamo = prestamo.cod_prestamo
                    INNER JOIN socio ON prestamo.cod_socio = socio.cod_socio
                    INNER JOIN libro ON detalleprestamo.cod_libro = libro.cod_libro";
            $res = mysqli_query($con,$sql);

            if(mysqli_num_rows($res) == 0){
                echo "No hay Detalles registrados. Redirigiendo...";
                header("Refresh: 3;URL=indexDetalle.html");
            }else{
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>ID Detalle</th>";
                echo "<th>Fecha Prestamo</th>";
                echo "<th>Fecha Devolucion</th>";
                echo "<th>Nombre y Apellido</th>";
                echo "<th>Titulo</th>";
                echo "<th>Observaciones</th>";
                echo "<th>Modificar</th>";
                echo "<th>Eliminar</th>";
                while($value = mysqli_fetch_assoc($res)){
                    echo "<tr>";
                    echo "<td>{$value['cod_detalle']}</td>";
                    echo "<td>{$value['f_prestamo']}</td>";
                    echo "<td>{$value['f_devolucion']}</td>";
                    echo "<td>{$value['nom_socio']}</td>";
                    echo "<td>{$value['titulo']}</td>";
                    echo "<td>{$value['observaciones']}</td>";
                    echo "<td> <a href='modificarDetalle.php?cod={$value['cod_detalle']}'>Modificar </td>";
                    echo "<td> <a href='eliminarDetalle.php?cod={$value['cod_detalle']}'>Eliminar </td>";
                }
            }
        ?>
    </div>
</body>
</html>