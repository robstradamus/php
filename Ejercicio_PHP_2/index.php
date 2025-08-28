<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h2>Iniciar Sesión</h2>

            <label for="user">Usuario</label>
            <input type="text" name="user" id="user" placeholder="Usuario">

            <label for="pwd">Contraseña</label>
            <input type="password" name="pwd" id="pwd" placeholder="Contraseña">

            <input type="submit" value="Iniciar Sesión">

            <div class="links-container">
                <a href="registrar.php" class="btn-secondary">Registrarse</a>
            </div>
        </form>
    </div>

    <?php
        include("conexion.php");
        if(isset($_POST['user']) && isset($_POST['pwd']) && $_POST['pwd'] != ""){
            $user = $_POST["user"];
            $pass = $_POST["pwd"];
            
            $sql_users = "SELECT * FROM usuarios WHERE usser = '$user' AND pass = '$pass';";
            $sql_check = mysqli_query($con,$sql_users);
            if(mysqli_num_rows($sql_check) > 0){
                echo "<br>";
                echo "<h3>Inicio de Sesión exitoso. Redirigiendo...</h3>";
                header("Refresh: 3; URL=dashboard/dashboard.html");
            }else{
                echo "Usuario o contraseña incorrectos";
                header("Refresh: 2; URL=index.php");
            }
        } 
    ?>
</body>
</html>