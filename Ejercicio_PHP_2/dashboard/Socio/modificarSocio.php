<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Socio</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/links.css">
</head>
<body>
    <?php
        include("../../conexion.php");
        // Obtenemos el ID del Listado
        $idSocio = $_GET["cod"];
        $sql_socio = "SELECT * FROM socio WHERE cod_socio = '$idSocio'";
        $res = mysqli_query($con,$sql_socio);

        $value = mysqli_fetch_assoc( $res);
    ?>
    <div class="form-container">
        <form action="" method="post">
            <h2>Modificar Socio</h2>

            <label for="">ID Socio</label>
            <input type="text" name="id_socio" value="<?php echo $value['cod_socio']?>" readonly>
            
            <label for="">Nombre y Apellido</label>
            <input type="text" name="nom" value="<?php echo $value['nom_socio']; ?>">

            <label for="">Fecha de Nacimiento</label>
            <input type="date" name="fnac" value="<?php echo $value['f_nacimiento']; ?>">

            <label for="">Direccion</label>
            <input type="text" name="direccion" value="<?php echo $value['dir_socio']; ?>">

            <label for="">Telefono</label>
            <input type="number" name="telefono" value="<?php echo $value['tel_socio']; ?>">

            <label for="">Email</label>
            <input type="email" name="email" value="<?php echo $value['email']; ?>">

            <input type="submit" name="modificar" value="Modificar">
            <div class="links-container">
                <a href="listadoSocio.php" class="btn-back">Volver al Listado</a>   
            </div>
        </form>
    </div>

    <?php 
        include("../../conexion.php");

        if(isset($_POST['modificar'])){
            $idSocio = $_POST['id_socio'];
            $nom = $_POST['nom'];
            $fnac = $_POST['fnac'];
            $dir = $_POST['direccion'];
            $tel = $_POST['telefono'];
            $email = $_POST['email'];

            // Validar si se requiere modificaciones

            $sql_modificar = "UPDATE socio SET nom_socio = '$nom', f_nacimiento = '$fnac', dir_socio = '$dir', tel_socio = '$tel', email = '$email'
                            WHERE cod_socio = '$idSocio';";
            $res_modificar = mysqli_query($con, $sql_modificar);

            if($res_modificar === true){
                echo "Modificacion realizada con exito. Redirigiendo ...";
                header("Refresh: 3; URL=listadoSocio.php");
            }else{
                echo "Error al modificar datos del Socio". mysqli_error($con);

            }
        }
    ?>
</body>
</html>