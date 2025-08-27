<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/tabla.css">
    <title>Listado de Autos</title>
</head>
<body>
    <div>
        <h2>Listado de Autos</h2>

        <div class="volver-container">
            <a href="indexAuto.html">Volver al Inicio</a>
        </div>

        <?php
            include("../../conexion.php");
            $sql = "SELECT a.cod_auto, a.marca_auto, a.modelo, a.color, a.precio_venta, c.nom_cliente, c.tel_cliente
                    FROM auto a JOIN cliente c ON a.id_cliente = c.cod_cliente;";
            $res = mysqli_query($con,$sql);
            $cant = mysqli_num_rows($res);
            if($cant > 0){
                echo "<table border='1'>";
                echo "<tr>
                    <th>ID Auto</th> 
                    <th>Marca de Auto</th>
                    <th> Modelo</th>
                    <th> Color</th>
                    <th> Precio Venta</th>
                    <th> Nombre del Cliente</th>
                    <th> Telefono del Cliente</th>
                    <th> Modificar</th>
                    <th> Eliminar </th>
                </tr>";
                while($value = mysqli_fetch_assoc($res)){
                    echo "<tr>";
                    echo "<td>{$value['cod_auto']}</td>";
                    echo "<td>{$value['marca_auto']}</td>";
                    echo "<td>{$value['modelo']}</td>";
                    echo "<td>{$value['color']}</td>";
                    echo "<td>{$value['precio_venta']}</td>";
                    echo "<td>{$value['nom_cliente']}</td>";
                    echo "<td>{$value['tel_cliente']}</td>";
                    echo "<td> <a class='accion-enlace modificar' href='modificarAuto.php?cod={$value['cod_auto']}'>Modificar Auto</a> </td>";
                    echo "<td> <a class='accion-enlace eliminar'  href='eliminarAuto.php?cod={$value['cod_auto']}'>Eliminar Auto</a> </td>";
                    echo "</tr>";
                }

            }else{
                echo "No se registraron Autos";
                header("Refresh: 2; URL=indexAuto.html");
            }
        ?>
    </div>
</body>
</html>