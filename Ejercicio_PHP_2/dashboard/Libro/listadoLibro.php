<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Libro</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/listado.css">
</head>
<body>
    <div class="table-container">      
        <h2>Listado de Libros</h2> 
        <a href="indexLibro.html" class="btn-back">Volver Atras</a>
        <br> <br> 
        <?php
            include("../../conexion.php");
            $sql = "SELECT * FROM libro";
            $res = mysqli_query($con,$sql);

            if($cant = mysqli_num_rows($res) == 0){
                echo "No hay registros de Libros";
            }else{
                echo "<table>";
                echo "<tr>";
                echo "<th>ID Libro</th>";
                echo "<th>Titulo</th>";
                echo "<th>Editorial</th>";
                echo "<th>Fecha de Edicion</th>";
                echo "<th>Idioma</th>";
                echo "<th>Cantidad de Paginas</th>";
                echo "<th>Estado</th>";
                echo "<th>Modificar</th>";
                echo "<th>Eliminar</th>";
                echo "</tr>";
                while($value = mysqli_fetch_assoc($res)){
                    echo "<tr>";
                    echo "<td>{$value['cod_libro']}</td>";
                    echo "<td>{$value['titulo']}</td>";
                    echo "<td>{$value['editorial']}</td>";
                    echo "<td>{$value['f_edicion']}</td>";
                    echo "<td>{$value['idioma']}</td>";
                    echo "<td>{$value['cant_pag']}</td>";
                    echo "<td>{$value['estado']}</td>";
                    echo "<td> <a href='modificarLibro.php?cod={$value['cod_libro']}'>Modificar</td>";
                    echo "<td> <a href='eliminarLibro.php?cod={$value['cod_libro']}'>Eliminar</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
    </div>
</body>
</html>