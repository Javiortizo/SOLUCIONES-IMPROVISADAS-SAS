
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
?>

<form method="POST">

    <tr>
        <td colspan='2' align="center"><?php echo $usua['PNOMBRE_USU']?></td>
    </tr>
<tr><br>
    <td colspan='2' align="center">
    
    
        <input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
        <input type="submit" formaction="./indexVet.php" value="Regresar" />
    </tr>
</form>

<?php 

if(isset($_POST['btncerrar']))
{
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
    <meta http-equiv="refresh" content="5">
    <link rel="stylesheet" href="estilos.css">
    <title>Consulta Afiliación</title>
</head>
    <body>
        <section class="title">
            <h1> Consulta Afiliaciones Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_consulta" method= "POST" autocomplete = "off">
                <tr>
                    <td colspan='2'><button type="submit" onclick="window.open('agregar-afiliacion.php','','width= 600,height=500, toolbar=NO');void(null);" >Agregar</button></td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>ID Afiliación</th>
                    <th>Mascota Afiliación</th>
                    <th>Nombre Dueño</th>
                    <th>Documento Dueño</th>    
                    <th>Fecha Afiliación</th>
                    <!-- <th>Acción</th> -->
                </tr>
                <?php
                    $sql_consulta = "select * from mascota,usuario,afiliacion where afiliacion.ID_MAS = mascota.ID_MAS and mascota.ID_USU = usuario.ID_USU AND USUARIO.ID_EST = 1";
                    $i = 0;
                    $query_consulta = mysqli_query($mysqli,$sql_consulta);
                    while ($resul = mysqli_fetch_assoc($query_consulta)){
                        $i++;
                ?>
                <tr>
                    <th><?php echo $i ?></th>
                    <td><input name="doc" type="text" value="<?php echo $resul['ID_AFIL'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['NOM_MAS'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['PNOMBRE_USU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['IDENT_USU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['FCHINI_AFIL'] ?>"></td>
                    <!-- <td><a href="?id=<?php echo $resul['ID_AFIL'] ?>" class="boton" onclick="window.open('update-afiliacion.php?id=<?php echo $resul['ID_AFIL'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update</a></td> -->
                </tr>
                    <?php
                        }
                    ?>
            </form>
        </table>
    </body>
</html>