<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/formulario.css">
    <title>Inicio de Sesion</title>
</head>
<body>
    <div>
        <form action="" method="post">
            <h2>Inicio de Sesion</h2>
            <label for="">Usuario</label>
            <input type="text" name="username" required placeholder="Usuario">

            <label for="">Contraseña</label>
            <input type="password" name="password" required placeholder="Contraseña">

            <input type="submit" name="iniciar_sesion" value="Iniciar Sesion">

            <div>
                <a href="registrar.php">Registrarse</a>
            </div>
        </form>
    </div>
    <?php
        include("conexion.php");

        if (isset($_POST['iniciar_sesion'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $sql_usr = "SELECT * FROM usuario WHERE user = '$username' AND pass = '$password'";
            $result = mysqli_query($con, $sql_usr);
            if(mysqli_num_rows($result) > 0){
                echo "<br>";
                echo "Inicio de sesion exitoso. Redirigiendo ...";
                header("Refresh: 3; URL=dashboard/dashboard.html");
            }else{
                echo "<br>";
                echo "Usuario o contraseña incorrectos.";
                header("Refresh: 3; URL=index.php");
            }
        }
    ?>
</body>
</html>