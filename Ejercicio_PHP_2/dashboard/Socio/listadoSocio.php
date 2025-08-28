<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Socios</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/listado.css">

</head>
<body>
    <div class="table-container">
        <h2>Listado de Socios</h2>
        <a href="indexSocio.html" class="btn-back">Volver Atras</a>
        <br> <br>
        <?php
            include("../../conexion.php");

            $sql_socio = "SELECT * FROM socio";
            $result_socio = mysqli_query($con,$sql_socio);

            if(mysqli_num_rows($result_socio)  == 0 ){
                echo "No hay Socios registrados. Redirigiendo ...";
                header("Refresh: 3; URL=indexSocio.html");
            }else{
                echo "<table>";
                echo "<tr>";
                echo "<th>ID Socio</th>";
                echo "<th>Nombre y Apellido</th>";
                echo "<th>Fecha de Nacimiento</th>";
                echo "<th>Direccion</th>";
                echo "<th>Telefono</th>";
                echo "<th>Email</th>";
                echo "<th>Modificar</th>";
                echo "<th>Eliminar</th>";
                echo "</tr>";
                while($value=mysqli_fetch_assoc($result_socio)){
                    echo "<tr>";
                    echo "<td>{$value['cod_socio']}</td>";
                    echo "<td>{$value['nom_socio']}</td>";
                    echo "<td>{$value['f_nacimiento']}</td>";
                    echo "<td>{$value['dir_socio']}</td>";
                    echo "<td>{$value['tel_socio']}</td>";
                    echo "<td>{$value['email']}</td>";
                    echo "<td><a href='modificarSocio.php?cod={$value['cod_socio']}'>Modificar</a></td>";
                    echo "<td><a href='eliminarSocio.php?cod={$value['cod_socio']}'>Eliminar</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
    </div>
</body>
</html>