
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
    <tr><td colspan='2' align="center"><?php echo $usua['PNOMBRE_USU']?></td></tr>
        <tr><br>
        <td colspan='2' align="center">
        <input class="usuariosButton guardarForm" type="submit" onclick="window.close();" value="Regresar" />
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
    <meta http-equiv="refresh" content="25">
    <link rel="stylesheet" href="css/estilosPrueba.css">
    <title>Consulta Recibo Medicamentos</title>
</head>
    <body>
        <header>
            <h1 class="tittleAdmin"> Recibos Medicamentos Desde <?php echo $usua['USER_TUSU']?></h1>
        </header>

        <table border="1" class="Center">
            <form name= "frm_consulta" method= "POST" autocomplete = "off">
                <!-- <tr>
                    <td colspan='2'><button type="submit" onclick="window.open('agregar-remedicamentos.php','','width= 600,height=500, toolbar=NO');void(null);" >Agregar</button></td>
                </tr> -->

                <div class="usuariosHeaderBoldGrid">                
                    <!-- <div>&nbsp;</div> -->
                    <div>ID Rec. Med.</div>
                    <div>ID Visita</div>
                    <div>Mascota</div>
                    <div>ID Medicamento</div>
                    <div>Medicamento</div>
                </div>
                
                <?php
                    $sql_consulta = "select * from recibosmed,visita,mascota,medicamentos where recibosmed.ID_MED = medicamentos.ID_MED AND recibosmed.ID_VIS = visita.ID_VIS AND visita.ID_MAS = mascota.ID_MAS and visita.ID_VIS = '".$_GET['id']."'";
                    $i = 0;
                    $query_consulta = mysqli_query($mysqli,$sql_consulta);
                    while ($resul = mysqli_fetch_assoc($query_consulta)){
                        $i++;
                ?>
                <tr>
                <div class="usuariosHeader"> 
                    <!-- <th><?php echo $i ?></th> -->
                    <div><?php echo $resul['ID_RMED'] ?></div>
                    <div><?php echo $resul['ID_VIS'] ?></div>
                    <div><?php echo $resul['NOM_MAS'] ?></div>
                    <div><?php echo $resul['ID_MED'] ?></div>
                    <div><?php echo $resul['NOMMED_MED'] ?></div>
                    <!-- <td><a href="?id=<?php echo $resul['ID_RMED'] ?>" class="boton" onclick="window.open('update-recibosmed.php?id=<?php echo $resul['ID_RMED'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update</a></td> -->
                </tr>
                    <?php
                        }
                    ?>
            </form>
        </table>
    </body>
</html>