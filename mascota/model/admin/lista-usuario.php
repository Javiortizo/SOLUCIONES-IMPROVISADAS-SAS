
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
    <title>Agregar Usuario</title>
</head>
    <body>
        <section class="title">
            <h1> CONSULTA USUARIOS Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_consulta" method= "POST" autocomplete = "off">
                <tr>
                    <td>&nbsp;</td>
                    <td>Documento</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>Direccion</td>
                    <td>Telefono</td>
                    <td>Correo</td>
                    <td>TarProf</td>
                    <td>Usuario</td>
                    <td>TipoUsuario</td>
                    <td>Estado</td>
                    <td>Accion</td>
                </tr>
                <?php
                    $sql_consulta = "SELECT * FROM usuario,estados,tipousuario where usuario.ID_TUSU = tipousuario.ID_TUSU and usuario.ID_EST = estados.ID_EST";
                    $i = 0;
                    $query_consulta = mysqli_query($mysqli,$sql_consulta);
                    while ($resul = mysqli_fetch_assoc($query_consulta)){
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['IDENT_USU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['PNOMBRE_USU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['APELLIDOP_USU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['DIRECCION_USU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['TELEFONO_USU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['CORREO_USU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['TPROF_USU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['ALIAS_USU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['USER_TUSU'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['NOM_EST'] ?>"></td>
                    <td><a href="?id=<?php echo $resul['ID_USU'] ?>" class="boton" onclick="window.open('update-usuario.php?id=<?php echo $resul['ID_USU'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update/Delete</a></td>
                </tr>
                    <?php
                        }
                    ?>
            </form>
        </table>
    </body>
</html>