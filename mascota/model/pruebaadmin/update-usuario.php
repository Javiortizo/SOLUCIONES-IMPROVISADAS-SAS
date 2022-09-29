<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");

$sql ="SELECT * FROM USUARIO, TIPOUSUARIO, ESTADOS WHERE USUARIO.ID_TUSU = TIPOUSUARIO.ID_TUSU AND USUARIO.ID_EST = ESTADOS.ID_EST and USUARIO.ID_USU = '".$_GET['id']."'";
$query = mysqli_query($mysqli,$sql);
$result = mysqli_fetch_assoc($query);

// Realizamos la consulta para la tabla Tipos de Usurio
// SELECT * FROM `tipousuario`
$sql_tusu= "SELECT * FROM tipousuario";
$query_tusu = mysqli_query($mysqli,$sql_tusu);
$fila_tusu= mysqli_fetch_assoc($query_tusu);

// Realizamos la consulta para la tabla Estados
// SELECT * FROM `estados`
$sql_estados= "SELECT * FROM estados where id_est <3";
$query_estados = mysqli_query($mysqli,$sql_estados);
$fila_estados= mysqli_fetch_assoc($query_estados);

?>
<?php
if(isset($_POST["update"]))
{
    $idUsu= $_POST['idUsu'];
    $identUsu= $_POST['identUsu'];
    $pNombreUsu= $_POST['pNombreUsu'];
    $sNombreUsu= $_POST['sNombreUsu'];
    $apellidoPUsu= $_POST['apellidoPUsu'];
    $apellidoMUsu= $_POST['apellidoMUsu'];
    $dir= $_POST['dir'];
    $tel= $_POST['tel'];
    $eMail= $_POST['eMail'];
    $tProf= $_POST['tProf'];
    $passwd= $_POST['passwd'];
    $nickname= $_POST['nickname'];
    $tipoUsu= $_POST['tipoUsu'];
    $estado= $_POST['estado'];
    $sql_update="UPDATE usuario SET ID_USU ='$idUsu', ID_TUSU='$tipoUsu', ID_EST ='$estado', IDENT_USU='$identUsu', PNOMBRE_USU='$pNombreUsu', SNOMBRE_USU='$sNombreUsu', APELLIDOP_USU='$apellidoPUsu', APELLIDOM_USU='$apellidoMUsu', DIRECCION_USU='$dir', TELEFONO_USU='$tel', CORREO_USU='$eMail', TPROF_USU='$tProf', PASSWD_USU='$passwd', ALIAS_USU='$nickname' WHERE ID_USU = '".$_GET['id']."'";
    $cs=mysqli_query($mysqli, $sql_update);
    echo '<script>alert (" Actualización Exitosa ");</script>';
    
 }
 elseif (isset($_POST["delete"])) 
 {
 
    $sql_delete="DELETE FROM USUARIO WHERE ID_USU = '".$_GET['id']."'";
    $cs=mysqli_query($mysqli, $sql_delete);
    echo '<script>alert (" Registro Eliminado Exitosamente ");</script>';
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
    <title>Document</title>
</head>
<body onload="centrar();">
    <table border="1" class="Center">
            <form name= "frm_consultaUsuario" method= "POST" autocomplete = "off">
                <tr>
                    <td>Id Usuario</td>
                    <td><input readonly name="idUsu" type="text" value="<?php echo $result ['ID_USU'] ?>"></td>
                </tr>
                <tr>
                    <td>Identificación Usuario</td>
                    <td><input name="identUsu" type="text" value="<?php echo $result ['IDENT_USU'] ?>"></td>
                </tr>
                <tr>
                    <td>Primer Nombre</td>
                    <td><input name="pNombreUsu" type="text" value="<?php echo $result ['PNOMBRE_USU'] ?>"></td>
                </tr>
                <tr>
                    <td>Segundo Nombre</td>
                    <td><input name="sNombreUsu" type="text" value="<?php echo $result ['SNOMBRE_USU'] ?>"></td>
                </tr>
                <tr>
                    <td>Primer Apellido</td>
                    <td><input name="apellidoPUsu" type="text" value="<?php echo $result ['APELLIDOP_USU'] ?>"></td>
                </tr>
                <tr>
                    <td>Segundo Apellido</td>
                    <td><input name="apellidoMUsu" type="text" value="<?php echo $result ['APELLIDOM_USU'] ?>"></td>
                </tr>
                <tr>
                    <td>Dirección</td>
                    <td><input name="dir" type="text" value="<?php echo $result ['DIRECCION_USU'] ?>"></td>
                </tr>
                <tr>
                    <td>Teléfono</td>
                    <td><input name="tel" type="text" value="<?php echo $result ['TELEFONO_USU'] ?>"></td>
                </tr>
                <tr>
                    <td>Correo</td>
                    <td><input name="eMail" type="email" value="<?php echo $result ['CORREO_USU'] ?>"></td>
                </tr>
                <tr>
                    <td>Tarjeta Profesional</td>
                    <td><input name="tProf" type="text" value="<?php echo $result ['TPROF_USU'] ?>"></td>
                </tr>
                <tr>
                    <td>Contraseña</td>
                    <td><input name="passwd" type="password" value="<?php echo $result ['PASSWD_USU'] ?>"></td>
                </tr>
                <tr>
                    <td>Nickname</td>
                    <td><input name="nickname" type="text" value="<?php echo $result ['ALIAS_USU'] ?>"></td>
                </tr>
                <tr>
                    <td>Tipo de Usuario</td>
                    <td> 
                        <select name="tipoUsu">
                            <option value= "<?php echo $result ['ID_TUSU'] ?>"><?php echo $result ['USER_TUSU'] ?></option>
                            <?php
                                 // Código php ciclo
                                do{

                            ?> 
                            <option value="<?php echo ($fila_tusu['ID_TUSU']) ?>"><?php echo ($fila_tusu['USER_TUSU']) ?></option>
                            <?php } while($fila_tusu=mysqli_fetch_assoc($query_tusu));
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <th> Tipo Estado</th>                                   
                    <th>
                        <select name="estado">
                                <option value= "<?php echo $result ['ID_EST'] ?>"><?php echo ($fila_estados['NOM_EST']) ?></option>
                                <?php
                                    // Código php ciclo
                                    do{

                                ?> 
                                <option value="<?php echo ($fila_estados['ID_EST']) ?>"><?php echo ($fila_estados['NOM_EST']) ?></option>
                                <?php } while($fila_estados=mysqli_fetch_assoc($query_estados));
                                ?>
                        </select>
                    </th>
                </tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                    <td><input type="submit" name="update" value="Update"></td>
                    

                    <td><input type="submit" name="delete" value="Delete"></td>
                    
                    
                </tr>
            </form>
    </table>
</body>
</html>