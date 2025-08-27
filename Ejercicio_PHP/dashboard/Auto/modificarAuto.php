<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/formulario.css">
    <title>Modificar Auto</title>
</head>
<body>
    <?php
        include("../../conexion.php");
        $id = $_GET["cod"];
        // Datos del Auto
        $sql_auto = "SELECT * FROM auto WHERE cod_auto='$id';";
        $res = mysqli_query($con,$sql_auto);
        $value = mysqli_fetch_assoc($res);

        // Datos del Cliente
        $sql_cliente= "SELECT * FROM cliente";
        $clientes = mysqli_query($con,$sql_cliente);
    ?>
    <div>
        <form method="post">
            <h2>Modificar Auto</h2>
            <input type="hidden" name="cod_auto" value="<?php echo $value['cod_auto']; ?>">

            <select name="cliente">
                <option value="0">Seleccionar Cliente</option>
                <?php 
                    while($cli= mysqli_fetch_assoc($clientes)){
                        $seleccionar = ($cli['cod_cliente']) == $value['id_cliente'] ? "selected" : "";
                        echo "<option value='{$cli['cod_cliente']}'$seleccionar>{$cli['nom_cliente']} </option>";
                    }
                ?>
            </select>

            <label for="marca">Ingresar Marca</label>
            <input type="text" name="marca" value="<?php echo $value['marca_auto'];?>">

            <label for="modelo">Ingresar Modelo</label>
            <input type="text" name="modelo" value="<?php echo $value['modelo'];?>">

            <label for="color">Ingresar Color</label>
            <input type="text" name="color" value="<?php echo $value['color'];?>">

            <label for="precioVenta">Precio de Venta $USD</label>
            <input type="number" name="precio" required value="<?php echo $value['precio_venta'];?>">

            <input type="submit" value="Modificar Auto" name="modificar">
            <div>
                <a href="indexAuto.html">Volver Atras</a>
            </div>
        </form>
    </div> 
    
    <?php
        if(isset($_POST['modificar'])){
            $id = $_POST['cod_auto'];
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $color = $_POST['color'];
            $precio = $_POST['precio'];

            $sql = "UPDATE auto SET marca_auto = '$marca',modelo='$modelo',color='$color',precio_venta='$precio' WHERE cod_auto = '$id';";
            $res = mysqli_query($con,$sql);
            if($res === true){
                echo "Actualizacion realizada correctamente. Redirigiendo ...";
                header("Refresh: 1;URL=listadoAutos.php");
            }else{
                echo "Error al modificar datos". mysqli_error($con);
            }
        }
    ?>
</body>
</html>