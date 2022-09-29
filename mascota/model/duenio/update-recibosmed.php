<?php
    session_start();
    require_once("../../db/connection.php");
    include("../../controller/validarSesion.php");
    $sql_consulta = "SELECT * FROM recibosmed where ID_RMED = '".$_GET['id']."' ";
    $query_consulta = mysqli_query($mysqli,$sql_consulta);
    $resul = mysqli_fetch_assoc($query_consulta);

?>

<?php
// Realizamos la consulta para la tabla Mascota y Usuario
// SELECT mascota.ID_MAS , mascota.ID_USU, mascota.NOM_MAS, usuario.PNOMBRE_USU, usuario.APELLIDOP_USU, usuario.IDENT_USU FROM mascota INNER JOIN usuario ON mascota.ID_USU = usuario.ID_USU;
$sql_mascota= "SELECT * FROM medicamentos";
$query_mascota = mysqli_query($mysqli,$sql_mascota);
$fila_mascota= mysqli_fetch_assoc($query_mascota);

$sql_vis = "SELECT * FROM recibosmed where ID_RMED = '".$_GET['id']."' ";
$query_vis = mysqli_query($mysqli,$sql_vis);
$resvis = mysqli_fetch_assoc($query_vis);

?>
<?php
$sql_consulta = "SELECT * FROM recibosmed,visita,usuario,mascota WHERE recibosmed.ID_VIS = visita.ID_VIS AND visita.ID_USU = usuario.ID_USU AND mascota.ID_MAS = visita.ID_MAS AND ID_RMED = '".$_GET['id']."'";
$query_consulta = mysqli_query($mysqli,$sql_consulta);
$rescon = mysqli_fetch_assoc($query_consulta)
?>


<?php
    if(isset($_POST["update"])){
        echo "Actualizar";
        $var1 = $_POST["idmed"];

        $sql_update="UPDATE recibosmed SET ID_MED='$var1' WHERE ID_RMED = '".$_GET['id']."'";
        $cs=mysqli_query($mysqli, $sql_update);
        var_dump($cs);
        echo '<script>alert (" Actualización Exitosa ");</script>';
        echo '<script>window.close();</script>';
    }

    // elseif(isset($_POST["delete"])){
    //     echo "Borrar";

    //     $sql_delete="DELETE FROM recibosmed WHERE ID_RMED = '".$_GET['id']."'";
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
    <title>Actualizar Recibo Medicamentos</title>
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
                <th>Id Rec. Med.</th>
                <td><input readonly name="idrmed" type="text" value="<?php echo $resul['ID_RMED'] ?>"></td>
            </tr>
            <tr>
                <th>Visita Mascota</th>
                <td><input readonly name="visi" type="text" value="<?php echo ($rescon['ID_VIS']." ".$rescon['FECHA_VIS']." ".$rescon['NOM_MAS']." VET: ".$rescon['PNOMBRE_USU']) ?>"></td>
            </tr>
            <tr>
                <th>Medicamento</th>                                   
                <td>
                    <select name="idmed">
                        <option value= "<?php echo $resul['ID_MED'] ?>">Medicamento</option>
                        <?php
                        // Código php ciclo
                        do{

                        ?> 
                        <option value="<?php echo ($fila_mascota['ID_MED']) ?>"><?php echo ($fila_mascota['NOMMED_MED']) ?></option>
                        <?php } while($fila_mascota=mysqli_fetch_assoc($query_mascota));
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                    <td colspan="2">&nbsp;</td>
            </tr>

            <tr>
                <td><input type="submit" name="update" value="Update"></td>
                <!-- <td><input type="submit" name="delete" value="Delete"></td>     -->
            </tr>
        </form>
    </table>  
</body>
</html>