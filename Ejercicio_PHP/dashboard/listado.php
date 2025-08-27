<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formulario.css">
    <link rel="stylesheet" href="../css/tabla.css">
    <title>Busqueda y Listados</title>
</head>
<body>
    <div>
        <!-- Busqueda por Fecha -->
        <form action="" method="post">
            <h2>Busquedas</h2>

            <label for="fecha_desde">Fecha Desde</label>
            <input type="date" name="fecha_desde">

            <label for="fecha_hasta">Fecha Hasta</label>
            <input type="date" name="fecha_hasta">
        <!-- Busqueda Cliente-->
            <label for="">Cliente</label>
            <select name="clientes" id="">
                <option value="0">Seleccione un Cliente</option>
                <?php
                    // Cargar Clientes
                    include("../conexion.php");

                    $sql_clientes = "SELECT * FROM cliente";
                    $res_clientes = mysqli_query($con, $sql_clientes);
                    while($cliente = mysqli_fetch_assoc($res_clientes)){
                        echo "<option value='{$cliente['cod_cliente']}'>{$cliente['nom_cliente']}</option>";
                    }   
                ?>
            </select>
        <!-- Busqueda Auto-->
            <label for="">Auto</label>
            <select name="auto" id="">
                <option value="0">Seleccione un Auto</option>
                <?php
                    // Cargar Autos
                    $sql_auto = "SELECT * FROM auto";
                    $res_auto = mysqli_query($con, $sql_auto);
                    while($auto = mysqli_fetch_assoc($res_auto)){
                        echo "<option value='{$auto['cod_auto']}'>{$auto['marca_auto']} {$auto['modelo']}</option>";
                    }
                ?>
            </select>
        <!-- Busqueda No Finalizadas -->
            <label for="">Estado de Revision</label>
            <select name="estado" id="">
                <option value="">Todas</option>
                <option value="Finalizado">Finalizadas</option>
                <option value="no_finalizada">No Finalizadas</option>
            </select>

            <input type="submit" value="Buscar" name="buscar">
            <div>
                <a href="dashboard.html">Volver Atras</a>
            </div>
        </form>
        
        <?php 
            // Busqueda por Fecha
            include("../conexion.php");
            if(isset($_POST['buscar'])){
                $cliente = isset($_POST['clientes']) ? intval($_POST['clientes']) : 0;
                $auto = isset($_POST['auto']) ? intval($_POST['auto']) : 0;
                $estado = isset($_POST['estado']) ? $_POST['estado'] : ''; 
                $fecha_desde = $_POST["fecha_desde"];
                $fecha_hasta = $_POST["fecha_hasta"];

                $sql_busqueda = "SELECT revision.*, auto.marca_auto, auto.modelo
                                FROM revision 
                                INNER JOIN auto ON revision.id_auto = auto.cod_auto 
                                WHERE revision.fecha_ingreso BETWEEN '$fecha_desde' AND '$fecha_hasta';";

                if($cliente != 0){
                    $sql_busqueda = "SELECT revision.*, auto.modelo, auto.marca_auto
                                FROM revision
                                INNER JOIN auto ON revision.id_auto = auto.cod_auto
                                WHERE auto.id_cliente = $cliente";
                }
                if($auto != 0){
                    $sql_busqueda = "SELECT revision.*, auto.modelo, auto.marca_auto
                                FROM revision
                                INNER JOIN auto ON revision.id_auto = auto.cod_auto
                                WHERE revision.id_auto = $auto";
                }
                if($estado === "no_finalizada"){
                    $sql_busqueda = "SELECT revision.*, auto.marca_auto, auto.modelo, cliente.nom_cliente
                                FROM revision
                                INNER JOIN auto ON revision.id_auto = auto.cod_auto
                                INNER JOIN cliente ON auto.id_cliente = cliente.cod_cliente
                                WHERE revision.estado != 'Finalizado'";
                } else if($estado ==="Finalizado"){
                    $sql_busqueda = "SELECT revision.*, auto.marca_auto, auto.modelo, cliente.nom_cliente
                                FROM revision
                                INNER JOIN auto ON revision.id_auto = auto.cod_auto
                                INNER JOIN cliente ON auto.id_cliente = cliente.cod_cliente
                                WHERE revision.estado = 'Finalizado'";
                }
                $res_busqueda = mysqli_query($con, $sql_busqueda);

                if(!$res_busqueda){
                    echo "Error en la consulta: " . mysqli_error($con);
                    exit;
                }

                if (mysqli_num_rows($res_busqueda) == 0) {
                    // Redirección sin mostrar contenido antes
                    header("Refresh: 2; URL=listado.php");
                    echo "No hay registros. Redirigiendo ...";
                    exit;
                } else{
                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th>ID Revision</th>";
                    echo "<th> Fecha de Ingreso</th>";
                    echo "<th> Fecha de Egreso</th>";
                    echo "<th> Estado</th>";
                    echo "<th> Cambio de Filtro</th>";
                    echo "<th> Cambio de Aceite</th>";
                    echo "<th> Cambio de Freno</th>";
                    echo "<th> Descripcion</th>";
                    echo "<th> Marca</th>";
                    echo "<th> Modelo</th>";
                    echo "</tr>";
                    
                    while($value = mysqli_fetch_assoc($res_busqueda)){
                        echo "<tr>";
                        echo "<td>{$value['cod_revision']}</td>";
                        echo "<td>{$value['fecha_ingreso']}</td>";
                        echo "<td>{$value['fecha_egreso']}</td>";
                        echo "<td>{$value['estado']}</td>";
                        echo "<td>{$value['cambio_filtro']}</td>";
                        echo "<td>{$value['cambio_aceite']}</td>";
                        echo "<td>{$value['cambio_freno']}</td>";
                        echo "<td>{$value['descripcion']}</td>";
                        echo "<td>{$value['marca_auto']}</td>";
                        echo "<td>{$value['modelo']}</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }

            }
        ?> 
    </div>
</body>
</html>