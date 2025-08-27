<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/formulario.css">
    <title>Registrar Auto</title>
</head>
<body>
    <?php
        include("../../conexion.php");
        $sql = "SELECT * FROM cliente;";
        $res = mysqli_query($con, $sql);
    ?>
    <div>
        <form method="post">
            <h2>Registrar Auto</h2>

            <select name="cliente">
                <option value="0">Cliente</option>
                <?php
                while ($value = mysqli_fetch_assoc($res)) {
                    echo "<option value='{$value['cod_cliente']}'>{$value['nom_cliente']} </option>";
                }
                ?>
            </select>

            <label for="marca">Ingresar Marca</label>
            <input type="text" name="marca">

            <label for="modelo">Ingresar Modelo</label>
            <input type="text" name="modelo">

            <label for="color">Ingresar Color</label>
            <input type="text" name="color">

            <label for="precioVenta">Precio de Venta $USD</label>
            <input type="number" name="precio" required>

            <input type="submit" value="Registrar Auto" name="registrar">

            <div>
                <a href="indexAuto.html">Volver Atras</a>
            </div>
        </form>
    </div>
    <?php
        if(isset($_POST['registrar'])){

            $idCliente = $_POST["cliente"];
            $marca = $_POST["marca"];
            $modelo = $_POST["modelo"];
            $color = $_POST["color"];
            $precio = $_POST["precio"];
            
            $sql = "INSERT INTO auto(marca_auto,modelo,color,precio_venta,id_cliente)
                    VALUES('$marca','$modelo','$color','$precio','$idCliente');";
            $res = mysqli_query($con,$sql);

            if($res === true){
                echo "Carga realizada correctamente. Redirigiendo ...";
                header("Refresh: 2; URL=indexAuto.html");
            }else{
                echo "Error al cargar datos". mysqli_error($con);
            }
        }
    ?>    
</body>

</html>