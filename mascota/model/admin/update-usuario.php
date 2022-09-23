<?php
    session_start();
    require_once("../../db/connection.php");
    include("../../controller/validarSesion.php");
    $sql_consulta = "SELECT * FROM usuario,estados,tipousuario where usuario.ID_TUSU = tipousuario.ID_TUSU and usuario.ID_EST = estados.ID_EST and usuario.ID_USU = '".$_GET['id']."' ";
    $query_consulta = mysqli_query($mysqli,$sql_consulta);
    $resul = mysqli_fetch_assoc($query_consulta);

?>

<?php
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
    if(isset($_POST["update"])){
        echo "Actualizar";
        $var0 = $_POST["doc"];
        $var1 = $_POST["nom"];
        $var2 = $_POST["ape"];
        $var3 = $_POST["dir"];
        $var4 = $_POST["tel"];
        $var5 = $_POST["mail"];
        $var6 = $_POST["tprof"];
        $var7 = $_POST["alias"];
        $var8 = $_POST["pass"];
        $var9 = $_POST["estado"];
        $var10 = $_POST["tipousu"];
        $var11 = $_POST["idusu"];

        $sql_update="UPDATE usuario SET ID_TUSU='$var10',ID_EST='$var9',IDENT_USU='$var0',PNOMBRE_USU='$var1',APELLIDOP_USU='$var2',DIRECCION_USU='$var3',TELEFONO_USU='$var4',CORREO_USU='$var5',TPROF_USU='$var6',PASSWD_USU='$var8',ALIAS_USU='$var7' WHERE ID_USU = '".$_GET['id']."'";
        $cs=mysqli_query($mysqli, $sql_update);
        echo '<script>alert (" Actualización Exitosa ");</script>';
    }

    elseif(isset($_POST["delete"])){
        echo "Borrar";

        $sql_delete="DELETE FROM usuario WHERE ID_USU = '".$_GET['id']."'";
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
    <title>Act.User</title>
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
                <td>Identificador Usuario</td>
                <td><input readonly name="idusu" type="text" value="<?php echo $resul['ID_USU'] ?>"></td>
            </tr>

            <tr>
                <td>Documento Ident Usuario</td>
                <td><input readonly name="doc" type="text" value="<?php echo $resul['IDENT_USU'] ?>"></td>
            </tr>

            <tr>
                <td>Nombre Usuario</td>
                <td><input name="nom" type="text" value="<?php echo $resul['PNOMBRE_USU'] ?>"></td>
            </tr>
            <tr>
                <td>Apellido Usuario</td>
                <td><input name="ape" type="text" value="<?php echo $resul['APELLIDOP_USU'] ?>"></td>
            </tr>
            <tr>
                <td>Direccion Usuario</td>
                <td><input name="dir" type="text" value="<?php echo $resul['DIRECCION_USU'] ?>"></td>
            </tr>

            <tr>
                <td>Telefono Usuario</td>
                <td><input name="tel" type="text" value="<?php echo $resul['TELEFONO_USU'] ?>"></td>
            </tr>

            <tr>
                <td>Correo Usuario</td>
                <td><input name="mail" type="email" value="<?php echo $resul['CORREO_USU'] ?>"></td>
            </tr>

            <tr>
                <td>Tarjeta Profesional Usuario</td>
                <td><input name="tprof" type="text" value="<?php echo $resul['TPROF_USU'] ?>"></td>
            </tr>

            <tr>
                <td>Alias Usuario</td>
                <td><input name="alias" type="text" value="<?php echo $resul['ALIAS_USU'] ?>"></td>
            </tr>

            <tr>
                <td>Password Usuario</td>
                <td><input name="pass" type="password" value="<?php echo $resul['PASSWD_USU'] ?>"></td>
            </tr> 
            <tr>
                <td>Estado de Usuario</td>
                <td><select name="estado">
                        <option value= "<?php echo $resul['ID_EST'] ?>"><?php echo $resul['NOM_EST'] ?></option>
                            <?php
                                // Código php ciclo
                                do{

                            ?> 
                        <option value="<?php echo ($fila_estados['ID_EST']) ?>"><?php echo ($fila_estados['NOM_EST']) ?></option>
                            <?php } while($fila_estados=mysqli_fetch_assoc($query_estados));
                            ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Tipo de Usuario</td>
                <td>
                    <select name="tipousu">
                        <option value= "<?php echo $resul['ID_TUSU'] ?>"><?php echo $resul['USER_TUSU'] ?></option>
                        <?php
                            // Código php ciclo
                            do{

                        ?> 
                        <option value="<?php echo ($fila_tusu['ID_TUSU']) ?>"><?php echo ($fila_tusu['USER_TUSU']) ?></option>
                        <?php } while($fila_tusu=mysqli_fetch_assoc($query_tusu));
                        ?>
                    </select>
                </td>
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