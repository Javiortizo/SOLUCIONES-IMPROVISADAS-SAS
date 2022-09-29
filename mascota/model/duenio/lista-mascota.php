
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
    <title>Consulta Mascota</title>
</head>

    <body>
        <header>
            <h1 class="tittleAdmin"> Consulta Mascotas Desde <?php echo $usua['USER_TUSU']?></h1>
            <p class="adminLabel"> Aquí también puedes ver el historial de visitas </p>
        </header>
        
        <table border="1" class="Center">
            <form name= "frm_consulta" method= "POST" autocomplete = "off">
                <!-- <tr>
                    <td colspan='2'><button type="submit" onclick="window.open('agregar-mascota.php','','width= 600,height=500, toolbar=NO');void(null);" >Agregar</button></td>
                </tr> -->

                <div class="usuariosHeaderBoldGrid">
                    <div class="nombre"> Nombre </div>
                    <div class="color"> Color  </div>
                    <div class="raza"> Raza  </div>
                    <div class="afiliacion"> Afiliación </div>
                    <div class="duenio"> Propietario </div>
                    <div class="tipoMas"> Tipo Mascota </div>
                    <div class="historia"> HC Mascota </div>
                </div>

                <?php
                    $sql_consulta = "SELECT * FROM mascota,tipomascota,usuario WHERE mascota.ID_USU = usuario.ID_USU AND mascota.ID_TMAS = tipomascota.ID_TMAS AND usuario.ID_USU = '".$usua['ID_USU']."'";
                    $i = 0;
                    $query_consulta = mysqli_query($mysqli,$sql_consulta);
                    while ($resul = mysqli_fetch_assoc($query_consulta)){
                        $i++;
                ?>
                <tr>
                <div class="usuariosHeader">
                    <!-- <div><?php echo $i ?></div> -->
                    <div><?php echo $resul['NOM_MAS'] ?></div>
                    <div><?php echo $resul['COLOR_MAS'] ?></div>
                    <div><?php echo $resul['RAZA_MAS'] ?></div>
                    <div><?php echo $resul['AFIL_MAS'] ?></div>
                    <div><?php echo ($resul['PNOMBRE_USU']." ".$resul['APELLIDOP_USU'])?></div>
                    <div><?php echo $resul['TIPO_TMAS'] ?></div>
                    <!-- <td><a href="?id=<?php echo $resul['ID_MAS'] ?>" class="boton" onclick="window.open('update-mascota.php?id=<?php echo $resul['ID_MAS'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update</a></td> -->
                    <div><a href="?id=<?php echo $resul['ID_MAS'] ?>" class="boton" onclick="window.open('lista-hiscli.php?id=<?php echo $resul['ID_MAS'] ?>','','width= 1700,height=700, toolbar=NO');void(null);">Ver Historia</a></div>
                </tr>
                    <?php
                        }
                    ?>
            </form>
        </table>
    </body>
</html>