<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/formulario.css">
    <title>Registrar Revision</title>
</head>
<body>
    <?php
        include("../../conexion.php");
        $sql_auto = "SELECT * FROM auto;";
        $res = mysqli_query($con, $sql_auto);     
    ?>
    <div>
        <form method="post">
            <h2>Registrar Revision</h2>
        
            <select name="idAuto">
                <option value="0">Seleccionar Auto</option>
                <?php
                    while($value = mysqli_fetch_assoc($res)){
                        echo "<option value='{$value['cod_auto']}'>{$value['marca_auto']}</option>";
                    }
                ?>
            </select>

            <label for="fecha_ingreso">Ingresar Fecha de Ingreso</label>
            <input type="date" name="fecha_ingreso"> 

            <label for="fecha_egreso">Inrgesar Fecha de Egreso</label>
            <input type="date" name="fecha_egreso">

            <label for="estado">Ingrese Estado del Auto</label>
            <select name="estado">
                <option value="0">--</option>
                <option value="En Espera">En Espera</option>
                <option value="En Revision">En Revision</option>
                <option value="Finalizado">Finalizado</option>
            </select>

            <label for="cambio_filtro">Seleccione Cambio de Filtro</label>
            <select name="filtro">
                <option value="0">--</option>
                <option value="Si">SI</option>
                <option value="No">NO</option>
            </select>

            <label for="aceite">Seleccione Cambio de Aceite</label>
            <select name="aceite">
                <option value="0">--</option>
                <option value="Si">SI</option>
                <option value="No">NO</option>
            </select>

            <label for="cambio_freno">Seleccione Cambio de Freno</label>
            <select name="freno">
                <option value="0">--</option>
                <option value="Si">SI</option>
                <option value="No">NO</option>
            </select>

            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion">

            <input type="submit" value="Registrar Revision" name="registrar">
            <div>
                <a href="indexRevision.html">Volver Atras</a>
            </div>
        </form>
    </div>
    <?php
        if(isset($_POST['registrar'])){
            $idAuto = $_POST['idAuto'];
            $f_ingreso = $_POST['fecha_ingreso'];
            $f_egreso = $_POST['fecha_egreso'];
            $estado = $_POST['estado'];
            $filtro = $_POST['filtro'];
            $aceite = $_POST['aceite'];
            $freno = $_POST['freno'];
            $descripcion = $_POST['descripcion'];

            $sql = "INSERT INTO revision(fecha_ingreso, fecha_egreso, estado, cambio_filtro, cambio_aceite, cambio_freno, descripcion,id_auto)
                    VALUES('$f_ingreso','$f_egreso','$estado','$filtro','$aceite','$freno','$descripcion','$idAuto');";
            $res = mysqli_query($con,$sql);
            
            if($res == true){
                echo "Carga realizada correctamente. Redirigiendo...";
                header("Refresh: 2; URL=registrarRevision.php");
            }else{
                echo "Error al caragar datos". mysqli_error($con);
            }
         }
    ?>    
</body>
</html>