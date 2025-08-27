<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/formulario.css">
    <title>Modificar Revision</title>
</head>
<body>
    <?php
        include("../../conexion.php");
        $id = $_GET["cod"];
        //Consulta Revision
        $sql = "SELECT * FROM revision WHERE cod_revision = '$id';";
        $res = mysqli_query($con,$sql);
        //
        $value = mysqli_fetch_array($res);
        //Consulta de Auto
        $sql_auto = "SELECT * FROM auto;";
        $auto = mysqli_query($con,$sql_auto);
        //Consulta Cliente
        $sql_cliente = "SELECT r.*,a.id_cliente, c.nom_cliente
                        FROM revision r
                        INNER JOIN auto a ON r.id_auto = a.cod_auto
                        INNER JOIN cliente c ON a.id_cliente = c.cod_cliente
                        WHERE r.cod_revision = '$id';";
        $cliente = mysqli_query($con,$sql_cliente);
    ?>
     <div>
        <form method="post">
            <h2>Modificar Revision</h2>

            <input type="hidden" name="cod_revision" value="<?php echo $value['cod_revision']; ?>">
            <select name="auto">
                <option value="0">Seleccionar Auto</option>
                <?php
                    while($ats = mysqli_fetch_assoc($auto)){
                        $seleccionar = ($ats['cod_auto']) == $value['id_auto'] ? "selected" : "";
                        echo "<option value='{$ats['cod_auto']}'$seleccionar>{$ats['marca_auto']} </option>";
                    }
                ?>
            </select>

            <select name="cliente">
                <option value="">Seleccione Cliente</option>
                <?php
                    while($cli = mysqli_fetch_assoc($cliente)){
                        $select = ($cli['cod_cliente']) == $value['id_cliente'] ? "selected": "";
                        echo "<option value='{$cli['cod_cliente']}' $select>{$cli['nom_cliente']} </option>";
                    }
                ?> 
            </select>

            <label for="fecha_ingreso">Ingresar Fecha de Ingreso</label>
            <input type="date" name="fecha_ingreso" value="<?php echo $value['fecha_ingreso'];?>"> 

            <label for="fecha_egreso">Inrgesar Fecha de Egreso</label>
            <input type="date" name="fecha_egreso" value="<?php echo $value['fecha_egreso'];?>">

            <label for="estado">Ingrese Estado del Auto</label>
            <select name="estado">
                <option value="0">--</option>
                <option value="En Espera" <?php if($value['estado'] == "En Espera") echo "selected"; ?>>En Espera</option>
                <option value="En Revision" <?php if($value['estado'] == "En Revision") echo "selected"; ?>>En Revision</option>
                <option value="Finalizado"<?php if($value['estado'] == "Finalizado") echo "selected"; ?>>Finalizado</option>
            </select>

            <label for="cambio_filtro">Seleccione Cambio de Filtro</label>
            <select name="filtro">
                <option value="0">--</option>
                <option value="Si" <?php if($value['cambio_filtro'] == "Si") echo "selected"; ?>>SI</option>
                <option value="No" <?php if($value['cambio_filtro'] == "No") echo "selected"; ?>>NO</option>
            </select>

            <label for="aceite">Seleccione Cambio de Aceite</label>
            <select name="aceite">
                <option value="0">--</option>
                <option value="Si" <?php if($value['cambio_aceite'] == "Si") echo "selected"; ?>>SI</option>
                <option value="No" <?php if($value['cambio_aceite'] == "No") echo "selected"; ?>>NO</option>
            </select>

            <label for="cambio_freno">Seleccione Cambio de Freno</label>
            <select name="freno">
                <option value="0">--</option>
                <option value="Si" <?php if($value['cambio_freno'] =="Si") echo "selected"; ?>>SI</option>
                <option value="No" <?php if($value['cambio_freno'] =="No") echo "selected"; ?>>NO</option>
            </select>

            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion"  value="<?php echo $value['descripcion']; ?>">

            <input type="submit" value="Modificar Revision" name="modificar">
            <div>
                <a href="listadoRevision.php">Volver Atras</a>
            </div>
        </form> 
    </div>
    <?php
        if(isset($_POST['modificar'])){
            $cod_revision = $_POST['cod_revision'];
            $idAuto = $_POST['auto'];
            $idCliente = $_POST['cliente'];
            $f_ingreso = $_POST['fecha_ingreso'];
            $f_egreso = $_POST['fecha_egreso'];
            $estado = $_POST['estado'];
            $filtro = $_POST['filtro'];
            $aceite = $_POST['aceite'];
            $freno = $_POST['freno'];
            $descripcion = $_POST['descripcion'];

            $sql_update = "UPDATE revision SET id_auto='$idAuto',fecha_ingreso='$f_ingreso',fecha_egreso='$f_egreso',estado='$estado',cambio_filtro='$filtro', cambio_aceite='$aceite',cambio_freno='$freno',descripcion='$descripcion' 
                        WHERE cod_revision='$cod_revision';";
            
            if(mysqli_query($con, $sql_update)){
                echo "Revision modificada correctamente.";
                header("Refresh: 2; URL=listadoRevision.php");
            } else {
                echo "Error al modificar la revision: " . mysqli_error($con);
            }
        }
    ?>
</body>
</html>