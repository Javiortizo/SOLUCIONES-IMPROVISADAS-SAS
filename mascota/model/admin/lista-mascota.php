
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
    <meta http-equiv="refresh" content="3">
    <link rel="stylesheet" href="estilos.css">
    <title>Consulta Mascota</title>
</head>
    <body>
        <section class="title">
            <h1> Consulta Mascotas Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_consulta" method= "POST" autocomplete = "off">
                <tr>
                    <th>&nbsp;</th>
                    <th>Nombre Mascota</th>
                    <th>Color Mascota</th>
                    <th>Raza Mascota</th>
                    <th>Afiliación Mascota</th>
                    <th>Dueño Mascota</th>
                    <th>Tipo Mascota</th>
                    <th>Acción</th>
                </tr>
                <?php
                    $sql_consulta = "SELECT * FROM mascota,tipomascota,usuario WHERE mascota.ID_USU = usuario.ID_USU AND mascota.ID_TMAS = tipomascota.ID_TMAS";
                    $i = 0;
                    $query_consulta = mysqli_query($mysqli,$sql_consulta);
                    while ($resul = mysqli_fetch_assoc($query_consulta)){
                        $i++;
                ?>
                <tr>
                    <th><?php echo $i ?></th>
                    <td><input name="doc" type="text" value="<?php echo $resul['NOM_MAS'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['COLOR_MAS'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['RAZA_MAS'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['AFIL_MAS'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['ALIAS_USU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['TIPO_TMAS'] ?>"></td>
                    <td><a href="?id=<?php echo $resul['ID_MAS'] ?>" class="boton" onclick="window.open('update-mascota.php?id=<?php echo $resul['ID_MAS'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update/Delete</a></td>
                </tr>
                    <?php
                        }
                    ?>
            </form>
        </table>
    </body>
</html>