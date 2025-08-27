<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/formulario.css">
    <title>Alta Cliente</title>
</head>
<body>
    <div >
        <form method="post">
            <h2>Alta Cliente</h2>

            <label for="nombre"> Ingrese Nombre y Apellido del Cliente</label>
            <input type="text" name="nombre">

            <label for="dir">Ingrese Direccion del Cliente</label>
            <input type="text" name="direccion">

            <label for="ciudad">Ingrese Ciudad del Cliente</label>
            <input type="text" name="ciudad">

            <label for="tel">Ingrese Telefono del Cliente</label>
            <input type="number" name="telefono">

            <label for="fAlta">Fecha de Alta</label>
            <input type="date" name="fAlta">

            <input type="submit" value="Registrar" name="registrar">
            
            <div>
                <a href="indexCliente.html">Volver</a>
            </div>
        </form>
    </div>
    
    <?php
        include("../../conexion.php");

        if(isset($_POST['registrar'])){
            $nombre = $_POST["nombre"];
            $dir = $_POST["direccion"];
            $ciudad = $_POST["ciudad"];
            $tel = $_POST["telefono"];
            $fAlta = $_POST["fAlta"];

            $sql = "INSERT INTO cliente(nom_cliente,dir_cliente,ciudad_cliente,tel_cliente,fecha_alta)
                    VALUES('$nombre','$dir','$ciudad','$tel','$fAlta');";
            $res = mysqli_query($con, $sql);
            if($res === true){
                echo "Datos cargados correctamente. Redirigiendo ....";
                header("Refresh: 2; URL=clienteAlta.php");
            }else{
                echo "Error al cargar datos: ". mysqli_error($con);
            }
        }    
    ?>
</body>
</html>
