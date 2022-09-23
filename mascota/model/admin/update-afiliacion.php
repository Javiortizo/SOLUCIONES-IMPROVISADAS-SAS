<?php
    session_start();
    require_once("../../db/connection.php");
    include("../../controller/validarSesion.php");
    $sql_consulta = "SELECT * FROM afiliacion where ID_AFIL = '".$_GET['id']."' ";
    $query_consulta = mysqli_query($mysqli,$sql_consulta);
    $resul = mysqli_fetch_assoc($query_consulta);

?>

<?php
// Realizamos la consulta para la tabla Mascota y Usuario
// SELECT mascota.ID_MAS , mascota.ID_USU, mascota.NOM_MAS, usuario.PNOMBRE_USU, usuario.APELLIDOP_USU, usuario.IDENT_USU FROM mascota INNER JOIN usuario ON mascota.ID_USU = usuario.ID_USU;
$sql_mascota= "SELECT mascota.ID_MAS , mascota.ID_USU, mascota.NOM_MAS, usuario.PNOMBRE_USU, usuario.APELLIDOP_USU, usuario.IDENT_USU FROM mascota INNER JOIN usuario ON mascota.ID_USU = usuario.ID_USU";
$query_mascota = mysqli_query($mysqli,$sql_mascota);
$fila_mascota= mysqli_fetch_assoc($query_mascota);
?>

<?php
    if(isset($_POST["update"])){
        echo "Actualizar";
        $var1 = $_POST["idmas"];
        $var2 = $_POST["date"];

        $sql_update="UPDATE afiliacion SET ID_MAS='$var1', FCHINI_AFIL = '$var2' WHERE ID_AFIL = '".$_GET['id']."'";
        $cs=mysqli_query($mysqli, $sql_update);
        var_dump($cs);
        echo '<script>alert (" Actualización Exitosa ");</script>';
    }

    elseif(isset($_POST["delete"])){
        echo "Borrar";

        $sql_delete="DELETE FROM afiliacion WHERE ID_AFIL = '".$_GET['id']."'";
        $cs=mysqli_query($mysqli, $sql_delete);
        var_dump($cs);
        echo '<script>alert (" Registro Eliminado Exitosamente ");</script>';
        
    }   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Act.Afil</title>
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
                <td>Identificador Afiliacion</td>
                <td><input readonly name="idafil" type="text" value="<?php echo $resul['ID_AFIL'] ?>"></td>
            </tr>

            <tr>
                    <td> Mascota - Dueño</td>                                   
                    <td>
                        <select name="idmas">
                                <option value= "">Seleccione La Mascota</option>
                                <?php
                                    // Código php ciclo
                                    do{

                                ?> 
                                <option value="<?php echo ($fila_mascota['ID_MAS']) ?>"><?php echo ($fila_mascota['NOM_MAS']. " - ". $fila_mascota['PNOMBRE_USU']. " ".$fila_mascota['APELLIDOP_USU']. " - CC".$fila_mascota['IDENT_USU']) ?></option>
                                <?php } while($fila_mascota=mysqli_fetch_assoc($query_mascota));
                                ?>
                        </select>
                    </td>
            </tr>

            <tr>
                <td>Fecha Afiliacion</td>
                <td><input name="date" type="date" value="<?php echo $resul['FCHINI_AFIL'] ?>"></td>
            </tr>

            <tr>
                    <td colspan="2">&nbsp;</td>
            </tr>

            <tr>
                <td><input type="submit" name="update" value="Update"></td>
                <td><input type="submit" name="delete" value="Delete"></td>    
            </tr>
        </form>
    </table>  
</body>
</html>