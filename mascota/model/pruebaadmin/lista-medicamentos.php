
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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Medicamentos</title>
</head>
    <body>
        <section class="title">
            <h1> CONSULTAR MEDICAMENTOS Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_consulta" method= "POST" autocomplete = "off">
                <tr>
                    <td>&nbsp;</td>
                    <td>ID Medicamento</td>
                    <td>Medicamento</td>
                    <td>Accion</td>
                </tr>
                <?php
                    $sql_consulta = "SELECT * FROM medicamentos";
                    $i = 0;
                    $query_consulta = mysqli_query($mysqli,$sql_consulta);
                    while ($resul = mysqli_fetch_assoc($query_consulta)){
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['ID_MED'] ?>"></td>
                    <td><input name="doc" type="text" value="<?php echo $resul['NOMMED_MED'] ?>"></td>
                    <td><a href="?id=<?php echo $resul['ID_MED'] ?>" class="boton" onclick="window.open('update-medicamentos.php?id=<?php echo $resul['ID_MED'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update/Delete</a></td>
                </tr>
                    <?php
                        }
                    ?>
            </form>
        </table>
    </body>
</html>