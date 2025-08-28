<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h2>Registrar Usuario</h2>

            <label for="usuario">Ingrese nombre de Usuario</label>
            <input type="text" name="usuario" id="usuario" placeholder="Usuario">

            <label for="pwd">Ingrese Contraseña</label>
            <input type="password" name="pwd" id="pwd" placeholder="Contraseña">

            <input type="submit" value="Registrarse">

            <div class="links-container">
                <a href="index.php" class="btn-secondary">Volver</a>
            </div>
        </form>
    </div>
    <?php
        include("conexion.php");
        if(isset( $_POST["usuario"] ) && isset($_POST["pwd"]) && $_POST['pwd'] != ""){
            $usuario = $_POST["usuario"];
            $pass = $_POST['pwd'];

            $sql_registrar = "INSERT INTO usuarios(usser,pass)
                            VALUES('$usuario','$pass');";
            $check_register = mysqli_query($con,$sql_registrar);
            if($check_register == true){
                echo "Usuario registrado con exito";
                header("Refresh: 2; URL=index.php");
            }else{
                echo "Error al registrar Usuario. Intente nuevamente". mysqli_error($con);
            }
        }
    ?>

</body>
</html>