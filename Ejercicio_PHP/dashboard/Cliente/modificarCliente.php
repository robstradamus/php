<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/formulario.css">
    <title>Modificar Cliente</title>
</head>
<body>
    <?php
        include("../../conexion.php");
        $id = $_GET["cod"];
        $sql = "SELECT * FROM cliente WHERE cod_cliente='$id';";
        $res = mysqli_query($con, $sql);
        $value = mysqli_fetch_assoc($res);
    ?>
    <div>   
        <form method="post">
            <h2>Modificar Cliente</h2>

            <label for="idCliente">ID Cliente</label>
            <input type="hidden" name="id" value="<?php echo $value['cod_cliente'] ?>">

            <label for="nombre">Nombre y Apellido del Cliente</label>
            <input type="text" name="nombre" value="<?php echo $value['nom_cliente'] ?>">

            <label for="dir">Direccion del Cliente</label>
            <input type="text" name="direccion" value="<?php echo $value['dir_cliente'] ?>">
        
            <label for="ciudad">Ciudad del Cliente</label>
            <input type="text" name="ciudad" value="<?php echo $value['ciudad_cliente'] ?>">

            <label for="tel">Telefono del Cliente</label>
            <input type="number" name="telefono" value="<?php echo $value['tel_cliente'] ?>">

            <label for="fAlta">Fecha de Alta</label>
            <input type="date" name="fAlta" value="<?php echo $value['fecha_alta'] ?>">

            <input type="submit" value="Modificar Cliente" name="modificar">

            <div>
                <a href="listadoCliente.php">Volver al Listado</a>
            </div>
        </form>
    </div>
    <?php
        include("../../conexion.php");

        if(isset($_POST['modificar'])){
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            $dir = $_POST["direccion"];
            $ciudad = $_POST["ciudad"];
            $tel = $_POST["telefono"];
            $fAlta = $_POST["fAlta"];

            $sql = "UPDATE cliente SET nom_cliente='$nombre',dir_cliente='$dir',ciudad_cliente='$ciudad',tel_cliente='$tel',fecha_alta='$fAlta'
                    WHERE cod_cliente='$id';";
            $res = mysqli_query($con,$sql);

            if($res === true){
                echo "Modificacion exitosa. Redirigiendo ...";
                header("Refresh: 2; URL=listadoCliente.php");
            }else{
                echo "Error al modificar datos". mysqli_error($con);
            }
        }
    ?>
</body>

</html>