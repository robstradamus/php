<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulario.css">
    <title>Registrarse</title>
</head>
<body>
    <div>
        <form action="" method="post">
            <h2>Registrar Usuario</h2>
            <label for="">Ingrese nombre de Usuario</label>
            <input type="text" name="username" required placeholder="Usuario">

            <label for="">Ingrese Contraseña</label>
            <input type="password" name="password" required placeholder="Contraseña">

            <input type="submit" value="Registrar" name="registrar">
            <div>
                <a href="index.php">Volver Atras</a>
            </div>
        </form>
    </div>

    <?php
        include("conexion.php");

        if(isset($_POST['registrar'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql_insert = "INSERT INTO usuario(user, pass) VALUES ('$username', '$password')";
            $res_insert = mysqli_query($con, $sql_insert);
            
            if($res_insert === true){
                echo "Usuario registrado exitosamente. Redirigiendo...";
                header("Refresh: 3;URL=index.php");
            }else{
                echo "Error al registrar el usuario. Por favor, intente de nuevo.";
                header("Refresh: 3; URL=registrar.php");
            }
        }
    ?>
</body>
</html>