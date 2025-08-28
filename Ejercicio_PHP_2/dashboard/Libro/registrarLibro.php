<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Libro</title>
    <link rel="stylesheet" href="../../css/base.css">
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/links.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h2>Registrar Libro</h2>
            
            <label for="titulo">Ingrese Título de Libro</label>
            <input type="text" name="titulo" id="titulo" placeholder="Título">

            <label for="editorial">Ingrese Editorial</label>
            <input type="text" name="editorial" id="editorial" placeholder="Editorial">

            <label for="fecha_edicion">Ingrese Fecha de Edición</label>
            <input type="date" name="fedicion" id="fecha_edicion">

            <label for="idioma">Idioma</label>
            <select name="idioma" id="idioma">
                <option value="0">Elige una opción</option>
                <option value="Ingles">Inglés</option>
                <option value="Español">Español</option>
                <option value="Frances">Francés</option>
                <option value="Portugues">Portugués</option>
            </select>

            <label for="can_paginas">Cantidad de Páginas</label>
            <input type="number" name="cantpaginas" id="can_paginas" placeholder="Cantidad de páginas">

            <label for="estado">Estado</label>
            <select name="estado" id="estado">
                <option value="0">Elige una opción</option>
                <option value="En Biblioteca">En Biblioteca</option>
                <option value="Prestado">Prestado</option>
                <option value="En Reparacion">En Reparación</option>
            </select>

            <input type="submit" value="Registrar">

            <div class="links-container">
                <a href="../dashboard.html" class="btn-back">Volver</a>
            </div>
        </form>
    </div>

    <?php
        include("../../conexion.php");
        if(isset($_POST["titulo"], $_POST["editorial"], $_POST["fedicion"],$_POST["cantpaginas"]) && $_POST["idioma"] != "0" && $_POST["estado"] != "0"){

            $titulo = $_POST["titulo"];
            $editorial = $_POST["editorial"];
            $fedicion = $_POST["fedicion"];
            $idioma = $_POST["idioma"];
            $cantpaginas = $_POST["cantpaginas"];
            $estado = $_POST["estado"];


            $sql = "INSERT INTO libro(titulo,editorial,f_edicion,idioma,cant_pag,estado)
                    VALUES('$titulo','$editorial','$fedicion','$idioma','$cantpaginas','$estado');";
            $res = mysqli_query($con,$sql);
            
            if($res == true){
                echo "Libro registrado con exito. Redirigiendo...";
                header("Refresh: 2; URL=regsitrarLibro.php");
            }else{
                echo "Error al registrar Libro". mysqli_error($con);
            }
        }
    ?>
</body>
</html>