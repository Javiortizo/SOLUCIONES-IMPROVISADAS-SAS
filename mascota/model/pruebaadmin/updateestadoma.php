<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql_consulta="SELECT * FROM estados WHERE estados.NOM_EST = '".$_GET['id']."'";
$query_consulta = mysqli_query($mysqli,$sql_consulta);
$result= mysqli_fetch_assoc($query_consulta);
?>

<?php
if(isset($_POST["update"]))
{
    echo "delete";
}
elseif(isset($_POST["delete"]))
{
    echo "borrar";
}
?>


<!DOCTYPE html>
<html lang="en">
<script> 
function centrar() { 
    iz=(screen.width-document.body.clientWidth) / 2; 
    de=(screen.height-document.body.clientHeight) / 2; 
    moveTo(iz,de); 
}     
</script>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
</head>

<body onload="centrar();">
    <table border="1" class="Center">
        <form name= "frm_consultaestado" method= "POST" autocomplete = "off">
            <tr>   
                <td>idestado</td>
                <td><input name="idest" type="text" value="<?php echo  $result ['ID_EST']?>"></td>
            </tr>
            <tr>   
                <td>nombreest</td>
                <td><input name="est" type="text" value="<?php echo  $result ['NOM_EST']?>"></td>
            </tr>
            <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                    <td><input type="submit" name="update" value="Update"></td>
                    

                    <td><input type="submit" name="delete" value="Delete"></td>
                    
                    
                </tr>
        </form>
    </table>
</body>
</html>