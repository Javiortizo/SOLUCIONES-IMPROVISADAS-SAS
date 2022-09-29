
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
?>

<?php
// Realizamos la consulta para la tabla Tipos de Usurio
// SELECT * FROM `tipousuario`
$sql_tusu= "SELECT * FROM tipousuario WHERE ID_TUSU = 3";
$query_tusu = mysqli_query($mysqli,$sql_tusu);
$fila_tusu= mysqli_fetch_assoc($query_tusu);

// Realizamos la consulta para la tabla Estados
// SELECT * FROM `estados`
$sql_estados= "SELECT * FROM estados where id_est = 1";
$query_estados = mysqli_query($mysqli,$sql_estados);
$fila_estados= mysqli_fetch_assoc($query_estados);

//Consulta para datos de form
$sql ="SELECT * FROM USUARIO, TIPOUSUARIO, ESTADOS WHERE USUARIO.ID_TUSU = TIPOUSUARIO.ID_TUSU AND USUARIO.ID_EST = ESTADOS.ID_EST and USUARIO.ID_USU = '".$usua['ID_USU']."'";
$query = mysqli_query($mysqli,$sql);
$result = mysqli_fetch_assoc($query);
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
    $sql_update="UPDATE usuario SET ID_USU ='$idUsu', ID_TUSU='$tipoUsu', ID_EST ='$estado', IDENT_USU='$identUsu', PNOMBRE_USU='$pNombreUsu', SNOMBRE_USU='$sNombreUsu', APELLIDOP_USU='$apellidoPUsu', APELLIDOM_USU='$apellidoMUsu', DIRECCION_USU='$dir', TELEFONO_USU='$tel', CORREO_USU='$eMail', TPROF_USU='$tProf', PASSWD_USU='$passwd', ALIAS_USU='$nickname' WHERE ID_USU = '".$usua['ID_USU']."'";
    $cs=mysqli_query($mysqli, $sql_update);
    echo '<script>alert (" Actualización Exitosa ");</script>';
    
 }
//  elseif (isset($_POST["delete"])) 
//  {
 
//     $sql_delete="DELETE FROM USUARIO WHERE ID_USU = '".$_GET['id']."'";
//     $cs=mysqli_query($mysqli, $sql_delete);
//     echo '<script>alert (" Registro Eliminado Exitosamente ");</script>';
//  }
?>

<form method="POST">
    <tr><td colspan='2' align="center"><?php echo $usua['PNOMBRE_USU']?></td></tr>
    <tr><br>
    <td colspan='2' align="center">
        <!-- <input class="usuariosButton guardarForm" type="submit" formaction="./indexDue.php" value="Cerrar sesión" name="btncerrar"/></td> -->
        <input class="usuariosButton guardarForm" type="submit" formaction="./indexDue.php" value="Regresar" />
    </tr>
</form>

<?php 

if(isset($_POST['btncerrar'])){
	session_destroy();   
    header('location: ../../index.html');
}
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="15">
    <link rel="stylesheet" href="css/estilosPrueba.css">
    <title>Consulta Usuario</title>
</head>

<header>
    <h1 class="tittleAdmin"> Actualizar mis datos: <?php echo $usua['ALIAS_USU']?> </h1>
    <p class="adminLabel"> Desde aqui puedes editar tus datos </p>
</header>

    <body>

        <table border="1" class="Center">
            <form name= "frm_consultaUsuario" method= "POST" autocomplete = "off">
            
                <tr>
                    <th>Id Usuario</td>
                    <td><input readonly name="idUsu" type="text" value="<?php echo $result ['ID_USU'] ?>"></td>
                </tr>
                <tr>
                    <th>Identificación Usuario</th>
                    <td><input readonly name="identUsu" type="text" value="<?php echo $result ['IDENT_USU'] ?>"></td>
                </tr>
                <tr>
                    <th>Primer Nombre</th>
                    <td><input readonly name="pNombreUsu" type="text" value="<?php echo $result ['PNOMBRE_USU'] ?>"></td>
                </tr>
                <tr>
                    <th>Segundo Nombre</th>
                    <td><input readonly name="sNombreUsu" type="text" value="<?php echo $result ['SNOMBRE_USU'] ?>"></td>
                </tr>
                <tr>
                    <th>Primer Apellido</th>
                    <td><input readonly name="apellidoPUsu" type="text" value="<?php echo $result ['APELLIDOP_USU'] ?>"></td>
                </tr>
                <tr>
                    <th>Segundo Apellido</th>
                    <td><input readonly name="apellidoMUsu" type="text" value="<?php echo $result ['APELLIDOM_USU'] ?>"></td>
                </tr>
                <tr>
                    <th>Dirección</th>
                    <td><input name="dir" type="text" value="<?php echo $result ['DIRECCION_USU'] ?>"></td>
                </tr>
                <tr>
                    <th>Teléfono</th>
                    <td><input name="tel" type="text" value="<?php echo $result ['TELEFONO_USU'] ?>"></td>
                </tr>
                <tr>
                    <th>Correo</th>
                    <td><input name="eMail" type="email" value="<?php echo $result ['CORREO_USU'] ?>"></td>
                </tr>
                <tr>
                    <th>Tarjeta Profesional</th>
                    <td><input readonly name="tProf" type="text" value="<?php echo $result ['TPROF_USU'] ?>"></td>
                </tr>
                <tr>
                    <th>Contraseña</th>
                    <td><input name="passwd" type="password" value="<?php echo $result ['PASSWD_USU'] ?>"></td>
                </tr>
                <tr>
                    <th>Nickname</th>
                    <td><input readonly name="nickname" type="text" value="<?php echo $result ['ALIAS_USU'] ?>"></td>
                </tr>
                <tr>
                    <th>Tipo de Usuario</th>
                    <td> 
                        <select name="tipoUsu">
                            <option value= "<?php echo $result ['ID_TUSU'] ?>"><?php echo $result ['USER_TUSU'] ?></option>
                        </select></td>
                </tr>
                <tr>
                    <th> Tipo Estado</th>                                   
                    <td>
                        <select name="estado">
                                <option value= "<?php echo $result ['ID_EST'] ?>"><?php echo ($fila_estados['NOM_EST']) ?></option>
                        </select>
                    </td>
                </tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                    <td colspan="2"><input class="usuariosButton guardarForm" type="submit" name="update" value="Update"></td>
                    <!-- <td><input type="submit" name="delete" value="Delete"></td> -->
                </tr>
            </form>
    </table>
    </body>
</html>