
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
$sql_tusu= "SELECT * FROM tipousuario";
$query_tusu = mysqli_query($mysqli,$sql_tusu);
$fila_tusu= mysqli_fetch_assoc($query_tusu);

// Realizamos la consulta para la tabla Estados
// SELECT * FROM `estados`
$sql_estados= "SELECT * FROM estados where id_est <3";
$query_estados = mysqli_query($mysqli,$sql_estados);
$fila_estados= mysqli_fetch_assoc($query_estados);
?>

<form method="POST">

    <tr>
        <td colspan='2' align="center"><?php echo $usua['PNOMBRE_USU']?></td>
    </tr>
<tr><br>
    <td colspan='2' align="center">
    
    
        <input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
        <input type="submit" formaction="./indexAdmin.php" value="Regresar" />
    </tr>
</form>

<?php 

if(isset($_POST['btncerrar']))
{
	session_destroy();

   
    header('location: ../../index.html');
}
	
?>

</div>

</div>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Tipo Mascota</title>
</head>
    <body>
        <section class="title">
            <h1> CONSULTAR AFILIACION Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_consulta" method= "POST" autocomplete = "off">
                <tr>
                    <td>&nbsp;</td>
                    <td>ID Afiliacion</td>
                    <td>Mascota Afiliacion</td>
                    <td>Nombre Dueño</td>
                    <td>Ident. Dueño</td>
                    <td>Fecha Afiliacion</td>
                    <td>Accion</td>
                </tr>
                <?php
                    $sql_consulta = "select * from mascota,usuario,afiliacion where afiliacion.ID_MAS = mascota.ID_MAS and mascota.ID_USU = usuario.ID_USU";
                    $i = 0;
                    $query_consulta = mysqli_query($mysqli,$sql_consulta);
                    while ($resul = mysqli_fetch_assoc($query_consulta)){
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['ID_AFIL'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['NOM_MAS'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['PNOMBRE_USU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['IDENT_USU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['FCHINI_AFIL'] ?>"></td>
                    <td><a href="?id=<?php echo $resul['ID_AFIL'] ?>" class="boton" onclick="window.open('update-afiliacion.php?id=<?php echo $resul['ID_AFIL'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update/Delete</a></td>
                </tr>
                    <?php
                        }
                    ?>
            </form>
        </table>
    </body>
</html>