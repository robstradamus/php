<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Reparacion</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/listado.css">
</head>
<body>
    <div class="table-container">
        <h2>Listado de Reparaciones</h2>
        <a href="indexReparacion.html" class="btn-back">Volver al Menu</a>
        <br> <br>
        <?php
            include("../../conexion.php");
            $sql = "SELECT reparacion.*, libro.* FROM reparacion
                    INNER JOIN libro ON reparacion.cod_libro = libro.cod_libro";
            $res = mysqli_query($con, $sql);

            if(mysqli_num_rows( $res) == 0) {
                echo "No hay Libros registrados. Redirigiendo...";
                header("Refresh: 2; URL=indexReparacion.php");
            }else{
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>ID Reparacion</th>";
                echo "<th>Fecha de Ingreso</th>";
                echo "<th>Fecha de Egreso</th>";
                echo "<th>Motivo</th>";
                echo "<th>Titulo</th>";
                echo "<th>Estado</th>";
                echo "<th>Modificar</th>";
                echo "<th>Eliminare</th>";
                while($value = mysqli_fetch_assoc( $res)){
                    echo "<tr>";
                    echo "<td>{$value['cod_libro']}</td>";
                    echo "<td>{$value['f_ingreso']}</td>";
                    echo "<td>{$value['f_egreso']}</td>";
                    echo "<td>{$value['motivo']}</td>";
                    echo "<td>{$value['titulo']}</td>";
                    echo "<td>{$value['estado']}</td>";
                    echo "<td> <a href='modificarReparacion.php?cod={$value['cod_reparacion']}'> Modificar</td>";
                    echo "<td> <a href='eliminarReparacion.php?cod={$value['cod_reparacion']}'> Eliminar</td>";
                }
            }
        ?>
    </div>
</body>
</html>