<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/tabla.css">
    <title>Listado de Revision</title>
</head>
<body>
    <div>
        <h2>Listado de Revisiones</h2>
        <div class="volver-container">
            <a href="indexRevision.html">Volver Atras</a>
        </div>
        <?php
            include("../../conexion.php");
            $sql = "SELECT r.cod_revision, r.fecha_ingreso, r.fecha_egreso, r.estado, r.cambio_filtro, r.cambio_aceite, r.cambio_freno, r.descripcion, r.id_auto,
            c.cod_cliente, c.nom_cliente,
            a.cod_auto, a.id_cliente, a.marca_auto, a.modelo
            FROM revision r
            INNER JOIN auto a ON r.id_auto = a.cod_auto
            INNER JOIN cliente c ON a.id_cliente = c.cod_cliente;";

            $res = mysqli_query($con,$sql);
            $cant = mysqli_num_rows($res);
            if($cant > 0){
                echo "<table border='1'>";
                echo "<tr>
                    <th>Nombre Cliente</th>
                    <th>Marca de Auto</th>
                    <th>Modelo</th>
                    <th>ID Revision</th>
                    <th>Fecha de Ingreso</th>
                    <th>Fecha de Egreso</th>
                    <th>Estado</th>
                    <th>Filtro</th>
                    <th>Aceite</th>
                    <th>Freno</th>
                    <th>Descripcion</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                    </tr>";
                while($value = mysqli_fetch_assoc($res)){
                    echo "<tr>";
                    echo "<td>{$value['nom_cliente']}</td>";
                    echo "<td>{$value['marca_auto']}</td>";
                    echo "<td>{$value['modelo']}</td>";
                    echo "<td>{$value['cod_revision']}</td>";
                    echo "<td>{$value['fecha_ingreso']}</td>";
                    echo "<td>{$value['fecha_egreso']}</td>";
                    echo "<td>{$value['estado']}</td>";
                    echo "<td>{$value['cambio_filtro']}</td>";
                    echo "<td>{$value['cambio_aceite']}</td>";
                    echo "<td>{$value['cambio_freno']}</td>";
                    echo "<td>{$value['descripcion']}</td>";
                    echo "<td> <a  class='accion-enlace modificar' href='modificarRevision.php?cod={$value['cod_revision']}'>Modificar</a> </td>";
                    echo "<td> <a  class='accion-enlace eliminar' href='eliminarRevision.php?cod={$value['cod_revision']}'>Eliminar</a> </td>";
                    echo "</tr>";
                }
                echo "</table";
            }else{
                echo "No se registraron registros. ";
                header("Refresh: 2; URL=indexRevision.html");

            }
        ?>
    </div> 
</body>
</html>