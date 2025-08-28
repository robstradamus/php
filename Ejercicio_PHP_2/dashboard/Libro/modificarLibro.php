<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Libro</title>
    <link rel="stylesheet" href="../../css/base.css">ç
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/links.css">
</head>
<body>
    <?php
        include("../../conexion.php");

        $id = $_GET["cod"];

        $sql_modificar = "SELECT * FROM libro WHERE cod_libro = '$id'";
        $res = mysqli_query($con,$sql_modificar);

        $value = mysqli_fetch_assoc($res);

    ?>
    <div class="form-container"> 
        <form action="" method="post">
            <h2>Modificar Libro</h2>
            
            <label for="id_Libro">ID Libro</label>
            <input type="text" name="id" value="<?php echo $value['cod_libro']?>" readonly>

            <label for="titulo">Ingrese Titulo de Libro</label>
            <input type="text" name="titulo" value="<?php echo $value['titulo']; ?>">

            <label for="editorial">Ingrese Editorial</label>
            <input type="text" name="editorial" value="<?php echo $value['editorial']; ?>">

            <label for="fecha_edicion">Ingrese Fecha de Edicion</label>
            <input type="date" name="fedicion" value="<?php echo $value['f_edicion']; ?>">

            <label for="idioma">Idioma</label>
            <select name="idioma">
                <option value="0">Elige una Opcion</option>
                <option value="Ingles" <?php if($value['idioma'] == "Ingles") echo "selected"; ?> >Ingles</option>
                <option value="Español" <?php if($value['idioma'] == "Español") echo "selected"; ?> >Español</option>
                <option value="Frances" <?php if($value['idioma'] == "Frances") echo "selected"; ?> >Frances</option>
                <option value="Portugues" <?php if($value['idioma'] == "Portugues") echo "selected"; ?> >Portugues</option>
            </select>

            <label for="can_paginas">Cantidad de Paginas</label>
            <input type="number" name="cantpaginas" value="<?php echo $value['cant_pag']; ?>">

            <label for="estado">Estado</label>
            <select name="estado">
                <option value="0">Elige una Opcion</option>
                <option value="En Biblioteca" <?php if($value['estado'] == "En Biblioteca") echo "selected"; ?> >En Biblioteca</option>
                <option value="Prestado" <?php if($value['estado'] == "Prestado") echo "selected"; ?> >Prestado</option>
                <option value="En Reparacion" <?php if($value['estado'] == "En Reparacion") echo "selected"; ?> >En Reparacion</option>
            </select>
            <input type="submit" value="Modificar">

            <div class="links-container">
                <a href="listadoLibro.php" class="btn-back">Volver al Listado</a>
            </div>
        </form>
    </div>
    <?php
        include("../../conexion.php");
        if(isset($_POST['id'], $_POST['titulo'], $_POST['editorial'], $_POST['fedicion'], $_POST['cantpaginas']) && $_POST['idioma'] != "0" && $_POST['estado'] != "0"){
            
            $id = $_POST["id"];
            $titulo = $_POST["titulo"];
            $editorial = $_POST["editorial"];
            $fedicion = $_POST["fedicion"];
            $cantpaginas = $_POST["cantpaginas"];
            $idioma = $_POST["idioma"];
            $estado = $_POST["estado"];
            // Modificar Despues si tiene Revisiones pendientes
            $sql_modificar = "UPDATE libro SET titulo='$titulo', editorial='$editorial', f_edicion='$fedicion', idioma='$idioma', cant_pag='$cantpaginas', estado='$estado'
                            WHERE cod_libro = '$id';";

            $result_modificar = mysqli_query($con,$sql_modificar);

            if($result_modificar === true){
                echo "Modificacion realizada correctamente. Redirigiendo ...";
                header("Refresh: 2; URL=listadoLibro.php");
            }else{
                echo "Error al modificar Libro". mysqli_error($con);
            }
        } 
    ?>
</body>
</html>