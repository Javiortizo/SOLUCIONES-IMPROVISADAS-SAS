<?php
    session_start();
    require_once("../../db/connection.php");
    include("../../controller/validarSesion.php");
    $sql_consulta = "SELECT * FROM mascota,tipomascota,usuario WHERE mascota.ID_USU = usuario.ID_USU AND mascota.ID_TMAS = tipomascota.ID_TMAS and mascota.ID_MAS = '".$_GET['id']."' ";
    $query_consulta = mysqli_query($mysqli,$sql_consulta);
    $resul = mysqli_fetch_assoc($query_consulta);

?>

<?php
// Realizamos la consulta para la tabla Tipos de Usurio
// SELECT * FROM `tipousuario`
$sql_tusu= "SELECT * FROM tipomascota";
$query_tusu = mysqli_query($mysqli,$sql_tusu);
$fila_tusu= mysqli_fetch_assoc($query_tusu);

// Realizamos la consulta para la tabla Estados
// SELECT * FROM `estados`
$sql_estados= "SELECT * FROM usuario where id_tusu = 3";
$query_estados = mysqli_query($mysqli,$sql_estados);
$fila_estados= mysqli_fetch_assoc($query_estados);
?>

<?php
    if(isset($_POST["update"])){
        echo "Actualizar";
        $var1 = $_POST["nom"];
        $var2 = $_POST["color"];
        $var3 = $_POST["raza"];
        $var4 = $_POST["afilmas"];
        $var5 = $_POST["estado"];
        $var6 = $_POST["tipousu"];

        $sql_update="UPDATE mascota SET ID_TMAS='$var6 ',ID_USU='$var5',NOM_MAS='$var1',COLOR_MAS='$var2',RAZA_MAS='$var3',AFIL_MAS='$var4' WHERE ID_MAS = '".$_GET['id']."'";
        $cs=mysqli_query($mysqli, $sql_update);
        echo '<script>alert (" Actualización Exitosa ");</script>';
        echo '<script>window.close();</script>';
    }

    // elseif(isset($_POST["delete"])){
    //     echo "Borrar";

    //     $sql_delete="DELETE FROM mascota WHERE ID_MAS = '".$_GET['id']."'";
    //     $cs=mysqli_query($mysqli, $sql_delete);
    //     var_dump($cs);
    //     echo '<script>alert (" Registro Eliminado Exitosamente ");</script>';
        
    // }   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar/Eliminar Mascota</title>
</head>
<script> 
    function centrar() { 
        iz=(screen.width-document.body.clientWidth) / 2; 
        de=(screen.height-document.body.clientHeight) / 2; 
        moveTo(iz,de); 
    }     
</script>
<body onload="centrar();">
    <table border="1" class="Center">
        <form name= "frm_consulta" method= "POST" autocomplete = "off">
            <tr>
                <th>Id Mascota</th>
                <td><input readonly name="idmas" type="text" value="<?php echo $resul['ID_MAS'] ?>"></td>
            </tr>

            <tr>
                <th>Nombre Mascota</th>
                <td><input name="nom" type="text" value="<?php echo $resul['NOM_MAS'] ?>"></td>
            </tr>
            <tr>
                <th>Color Mascota</th>
                <td><input name="color" type="text" value="<?php echo $resul['COLOR_MAS'] ?>"></td>
            </tr>
            <tr>
                <th>Raza Mascota</th>
                <td><input name="raza" type="text" value="<?php echo $resul['RAZA_MAS'] ?>"></td>
            </tr>

            <tr>
                <th>Afiliación Mascota</th>
                <td>
                    <select name="afilmas">
                        <option value="<?php echo $resul['AFIL_MAS'] ?>"><?php echo $resul['AFIL_MAS'] ?></option>
                    </select>
                </td>
            </tr> 
            <tr>
                <th>Dueño Mascota</th>
                <td><select name="estado">
                        <option value= "<?php echo $resul['ID_USU'] ?>"><?php echo $resul['ALIAS_USU'] ?></option>
                    </select>
                </td>
            </tr>

            <tr>
                <th>Tipo Mascota</th>
                <td>
                    <select name="tipousu">
                        <option value= "<?php echo $resul['ID_TMAS'] ?>"><?php echo $resul['TIPO_TMAS'] ?></option>
                        <?php
                            // Código php ciclo
                            do{

                        ?> 
                        <option value="<?php echo ($fila_tusu['ID_TMAS']) ?>"><?php echo ($fila_tusu['TIPO_TMAS']) ?></option>
                        <?php } while($fila_tusu=mysqli_fetch_assoc($query_tusu));
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                    <td colspan="2">&nbsp;</td>
            </tr>

            <tr>
                <td colspan='2'><input type="submit" name="update" value="Update"></td>
                <!-- <td><input type="submit" name="delete" value="Delete"></td>     -->
            </tr>
        </form>
    </table>  
</body>
</html>