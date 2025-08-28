<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado</title>
    <link rel="stylesheet" href="../css/listado_tablas.css">
</head>
<body>
    <div class="table-container">
        <h2>Listado</h2>
        <a href="dashboard.html">Volver al Menu</a>
        <?php
        include("../conexion.php");

        //Realizamos consulta para seleccionar un socio
        $sql_socio = "SELECT * FROM socio";
        $res_socio = mysqli_query($con, $sql_socio);

        ?>
        <!-- Listado de Socios seleccionados y menores de edad-->
        <form action="" method="post">
            <label for="">Seleccione un Socio</label>
            <select name="cod_socio">
                <option value="0">--Seleccione--</option>
                <option value="menores" <?php if (isset($_POST['cod_socio']) && $_POST['cod_socio'] == 'menores')
                    echo 'selected'; ?>>Mostrar Socios Menores de edad</option>
                <option value="no_devueltos" <?php if (isset($_POST['cod_socio']) && $_POST['cod_socio'] == 'menores')
                    echo 'selected'; ?>>Mostrar Prestamos no Devueltos</option>
                <option value="reparaciones" <?php if (isset($_POST['cod_socio']) && $_POST['cod_socio'] == 'menores')
                    echo 'selected'; ?>>Mostrar Reparaciones Sin Fecha de Egreso</option>
                <?php
                while ($value_socio = mysqli_fetch_assoc($res_socio)) {
                    echo "<option value='{$value_socio['cod_socio']}'>{$value_socio['nom_socio']}</option>";
                }
                ?>
            </select>
            <input type="submit" name="buscar_socio" value="Buscar">
        </form>
        <br>
        <!--Listado por periodos de Fecha -->
        <form method="post">
            <label for="">Fecha Inicio</label>
            <input type="date" name="f_inicio" id="">

            <label for="">Fecha Fin</label>
            <input type="date" name="f_fin" id="">

            <input type="submit" name="buscar_fecha" value="Buscar">
        </form>
        <br>
        <!-- Listado por Estado de Libro(En Biblioteca, En Reparacion, Prestado-->
        <form action="" method="post">
            <label for="">Seleccione Estado de Libro</label>
            <select name="estado">
                <option value="0">Seleccione una Opcion</option>
                <option value="En Biblioteca">En Biblioteca</option>
                <option value="En Reparacion">En Reparacion</option>
                <option value="Prestado">Prestado</option>
                <option value="sin_fecha">Reparacion sin Fecha de Egreso</option>
            </select>
            <input type="submit" name="buscar_estado" value="Buscar">
        </form>
        <br>
        <!--------------------------------------------->
        <?php
        // Listado de Libros por Estado
        if (isset($_POST['buscar_estado'])) {
            $estado = $_POST['estado'];

            if ($estado == 'sin_fecha') {
                // Listado de reparaciones sin fecha de egreso
                $sql = "SELECT reparacion.*,libro.* FROM reparacion
                        INNER JOIN libro ON libro.cod_libro = reparacion.cod_libro
                        WHERE reparacion.f_egreso IS NULL OR reparacion.f_egreso = '0000-00-00'";
            }else if($estado != '0'){
                $sql = "SELECT * FROM libro WHERE estado = '$estado'";
            }else {
                echo "Seleccione un estado valido.";
                exit;
            }
            $res = mysqli_query($con, $sql);
                
            if (mysqli_num_rows($res) == 0) {
                echo "No hay resultados para la busqueda";
                header("Refresh:3;URL=listado.php");
            } else {
                echo "<table border='1'>";
                echo "<tr>";
                if($estado == 'sin_fecha'){
                    echo "<th>Código Reparación</th>";
                    echo "<th>Fecha Ingreso</th>";
                    echo "<th>Fecha Egreso</th>";                
                }
                echo "<th>Codigo Libro</th>";
                echo "<th>Titulo</th>";
                echo "<th>Editorial</th>";
                echo "<th>Fecha de Edicion</th>";
                echo "<th>Estado</th>";
                echo "</tr>";
                while ($value = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    if ($estado == 'sin_fecha') {
                        echo "<td>{$value['cod_reparacion']}</td>";
                        echo "<td>{$value['f_ingreso']}</td>";
                        echo "<td>{$value['f_egreso']}</td>";
                    }
                    echo "<td>{$value['cod_libro']}</td>";
                    echo "<td>{$value['titulo']}</td>";
                    echo "<td>{$value['editorial']}</td>";
                    echo "<td>{$value['f_edicion']}</td>";
                    echo "<td>{$value['estado']}</td>";
                    echo "</tr>";
                }
                echo "</table>";
                }
            }
        ?>
        <?php
        // Busqueda por periodo de fechas
        if (isset($_POST['buscar_fecha'])) {
            $fecha_inicio = $_POST['f_inicio'];
            $fecha_fin = $_POST['f_fin'];

            $sql = "SELECT socio.*, libro.*, prestamo.* FROM prestamo
                        INNER JOIN socio ON prestamo.cod_socio = socio.cod_socio
                        INNER JOIN detalleprestamo ON prestamo.cod_prestamo = detalleprestamo.cod_prestamo
                        INNER JOIN libro ON libro.cod_libro = detalleprestamo.cod_libro
                        WHERE prestamo.f_prestamo BETWEEN '$fecha_inicio' AND '$fecha_fin'
                        AND libro.estado = 'Prestado'";
            $res = mysqli_query($con, $sql);
            if (mysqli_num_rows($res) == 0) {
                echo "No hay resultados para la busqueda";
                header("Refresh:3;URL=listado.php");
            } else {
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Codigo Socio</th>";
                echo "<th>Nombre Socio</th>";
                echo "<th>Titulo Libro</th>";
                echo "<th>Fecha de Prestamo</th>";
                echo "</tr>";
                while ($value = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td>{$value['cod_socio']}</td>";
                    echo "<td>{$value['nom_socio']}</td>";
                    echo "<td>{$value['titulo']}</td>";
                    echo "<td>{$value['f_prestamo']}</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
        ?>
        <?php
        // Listado de Socios y menores de edad con libros prestados.
        if (isset($_POST['buscar_socio'])) {
            $cod_socio = $_POST['cod_socio'];

            // Listado de Socios menores de edad con libros prestados
            if ($cod_socio == 'menores') {
                $sql = "SELECT socio.*, libro.*, prestamo.* FROM prestamo
                            INNER JOIN socio ON socio.cod_socio = prestamo.cod_socio
                            INNER JOIN detalleprestamo ON prestamo.cod_prestamo = detalleprestamo.cod_prestamo
                            INNER JOIN libro ON libro.cod_libro = detalleprestamo.cod_libro
                            WHERE TIMESTAMPDIFF(YEAR, socio.f_nacimiento, CURDATE()) < 18";
            }
            // Listado de Libros Prestados que no han sido devueltos
            else if ($cod_socio == 'no_devueltos') {
                $sql = "SELECT socio.*, libro.*, prestamo.* FROM prestamo
                            INNER JOIN socio ON socio.cod_socio = prestamo.cod_socio
                            INNER JOIN detalleprestamo ON prestamo.cod_prestamo = detalleprestamo.cod_prestamo
                            INNER JOIN libro ON libro.cod_libro = detalleprestamo.cod_libro
                            WHERE prestamo.f_devolucion IS NULL OR prestamo.f_devolucion = '0000-00-00'";
            }
            // Listado de Libros Prestados a un Socio Seleccionado previamente
            else {
                $sql = "SELECT socio.*, libro.*,  prestamo.* FROM prestamo
                            INNER JOIN socio ON socio.cod_socio = prestamo.cod_socio
                            INNER JOIN detalleprestamo ON prestamo.cod_prestamo = detalleprestamo.cod_prestamo
                            INNER JOIN libro ON libro.cod_libro = detalleprestamo.cod_libro
                            WHERE libro.estado = 'Prestado' AND socio.cod_socio = '$cod_socio'";
            }
            $res = mysqli_query($con, $sql);
            if (mysqli_num_rows($res) == 0) {
                echo "No hay resultados para la busqueda";
                header("Refresh:3;URL=listado.php");
            } else {
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Codigo Socio</th>";
                echo "<th>Nombre Socio</th>";
                echo "<th>Titulo Libro</th>";
                echo "<th>Fecha de Prestamo</th>";
                echo "</tr>";
                while ($value = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td>{$value['cod_socio']}</td>";
                    echo "<td>{$value['nom_socio']}</td>";
                    echo "<td>{$value['titulo']}</td>";
                    echo "<td>{$value['f_prestamo']}</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
        ?>
    </div>
</body>

</html>