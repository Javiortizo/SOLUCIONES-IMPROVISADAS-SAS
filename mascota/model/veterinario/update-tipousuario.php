<?php
    session_start();
    require_once("../../db/connection.php");
    include("../../controller/validarSesion.php");
    $sql_consulta = "SELECT * FROM tipousuario where ID_TUSU = '".$_GET['id']."' ";
    $query_consulta = mysqli_query($mysqli,$sql_consulta);
    $resul = mysqli_fetch_assoc($query_consulta);

?>

<?php
    if(isset($_POST["update"])){
        echo "Actualizar";
        $var1 = $_POST["nom"];

        $sql_update="UPDATE tipousuario SET USER_TUSU='$var1' WHERE ID_TUSU = '".$_GET['id']."'";
        $cs=mysqli_query($mysqli, $sql_update);
        var_dump($cs);
        echo '<script>alert (" Actualización Exitosa ");</script>';
        echo '<script>window.close();</script>';
    }

    elseif(isset($_POST["delete"])){
        echo "Borrar";

        $sql_delete="DELETE FROM tipousuario WHERE ID_TUSU = '".$_GET['id']."'";
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
    <title>Actualizar/Eliminar Tipo Usuario</title>
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
                <th>Id Tipo Usuario</th>
                <td><input readonly name="idmas" type="text" value="<?php echo $resul['ID_TUSU'] ?>"></td>
            </tr>

            <tr>
                <th>Tipo de Usuario</th>
                <td><input name="nom" type="text" value="<?php echo $resul['USER_TUSU'] ?>"></td>
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