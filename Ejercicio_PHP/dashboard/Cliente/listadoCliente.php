<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/tabla.css">
    <title>Listado Cliente</title>
</head>
<body>
    <div>
        <h2>Listado de Clientes</h2>
        
        <div class="volver-container">
            <a href="indexCliente.html">Volver al Inicio</a>
        </div>
        <?php
            include("../../conexion.php");
            $sql = "SELECT * FROM cliente";
            $res = mysqli_query($con,$sql);
            $cant = mysqli_num_rows($res); //Comprueba la cantidad de Registros
            if($cant > 0){
                echo "<table border='1'>";
                echo "<tr>
                    <th>ID Cliente</th>
                    <th>Nombre y Apellido</th>
                    <th>Direccion</th>
                    <th>Ciudad</th>
                    <th>Telefono</th>
                    <th>Fecha de Alta</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                    </tr>";
                while($value = mysqli_fetch_assoc($res)){ // Accede mediante el nombre de la columna
                    echo "<tr>";
                    echo "<td>{$value['cod_cliente']}</td>";
                    echo "<td>{$value['nom_cliente']}</td>";
                    echo "<td>{$value['dir_cliente']}</td>";
                    echo "<td>{$value['ciudad_cliente']}</td>";
                    echo "<td>{$value['tel_cliente']}</td>";
                    echo "<td>{$value['fecha_alta']}</td>";
                    echo "<td><a class='accion-enlace modificar' href='modificarCliente.php?cod={$value['cod_cliente']}'>Modificar Cliente</a></td>";
                    echo "<td><a class='accion-enlace eliminar' href='eliminarCliente.php?cod={$value['cod_cliente']}'>Eliminar Cliente</a> </td>";
                    echo "</tr>";
                }
                echo "</table>";
            }else{
                echo "No se encontraron registros. Redirigiendo al Inicio ...";
                header("Refresh: 2; URL=indexCliente.html");
            }
        ?>
    </div>
</body>
</html>