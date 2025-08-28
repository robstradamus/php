<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Socio</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/links.css">
</head>
<body>
    <div class="form-container">
        <h2>Registrar Socio</h2>
        <form action="" method="post">
                <label for="">Nombre y Apellido</label>
                <input type="text" name="nom">

                <label for="">Fecha de Nacimiento</label>
                <input type="date" name="fnac">

                <label for="">Direccion</label>
                <input type="text" name="direccion">

                <label for="">Telefono</label>
                <input type="number" name="telefono">

                <label for="">Email</label>
                <input type="email" name="email">

                <input type="submit" name="registrar" value="Registrar">
        </form>

        <div class="links-container">
            <a href="indexSocio.html" class="btn-back">Volver Atras</a>
        </div>
        
    </div>
    <?php
        include("../../conexion.php");
        
        if(isset($_POST["registrar"])){
            $nom = $_POST["nom"];
            $fnac = $_POST["fnac"];
            $dir = $_POST["direccion"];
            $tel = $_POST["telefono"];
            $email = $_POST["email"];

            $sql_registrar = "INSERT INTO socio(nom_socio, f_nacimiento, dir_socio, tel_socio, email)
                            VALUE('$nom','$fnac','$dir','$tel','$email');";
            $res = mysqli_query($con,$sql_registrar);

            if($res === true){
                echo "Socio registrado con Exito. Redirigiendo ....";
                header("Refresh: 3; URL=registrarSocio.php");
            }else{
                echo "Error al registrar Socio". mysqli_error($con);
            }
        }
    ?>
</body>
</html>