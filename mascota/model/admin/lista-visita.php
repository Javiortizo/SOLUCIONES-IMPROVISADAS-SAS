
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
    <title>CONSULTAR/ACTUALIZAR/ELIMINAR USUARIO</title>
</head>
    <body>
        <section class="title">
            <h1> Formulario Consulta Vista Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_consultaVisita" method= "POST" autocomplete = "off">
                <tr>
                    <td>&nbsp</td>
                    <td>ID Visita</td>                     
                    <td>Fecha de Visita Mascota</td>
                    <td>Hora Visita Mascota</td>  
                    <td>Temperatura Mascota °C</td>    
                    <td>Peso Mascota Kg</td> 
                    <td>Frecuencia Cardiaca Mascota ppm</td>
                    <td>Frecuencia Respiratoria Mascota rpm</td>
                    <td>Estado de Ánimo Mascota</td>
                    <td>Recomendaciones Visita Mascota</td>
                    <td>Costo Visita Mascota</td>
                    <td>Diagnóstico Visita Mascota</td>
                    <td>Mascota</td>
                    <td>Veterinario</td>
                    <td>Estado de la Mascota</td>
                    <td>Accion</td>

                    
                </tr>
                <?php
                    $sql="SELECT * FROM VISITA, MASCOTA, USUARIO, TIPOUSUARIO, ESTADOS WHERE VISITA.ID_MAS = MASCOTA.ID_MAS AND VISITA.ID_USU = USUARIO.ID_USU AND VISITA.ID_EST = ESTADOS.ID_EST AND USUARIO.ID_TUSU = TIPOUSUARIO.ID_TUSU";
                    $i =0;
                    $query = mysqli_query($mysqli,$sql);
                    while($resul=mysqli_fetch_assoc($query)){
                        $i++;
                ?>  
                <tr>   
                    <td><?php echo $i ?></td>
                    <td><input name="idVis" type="text" value= "<?php echo $resul ['ID_VIS'] ?>"> </td>    
                    <td><input name="fechVis" type="text" value= "<?php echo $resul['FECHA_VIS'] ?>"> </td>    
                    <td><input name="horaVis" type="text" value= "<?php echo $resul['HORA_VIS'] ?>"> </td>    
                    <td><input name="tempVis" type="text" value= "<?php echo $resul['TEMP_VIS'] ?>"> </td>    
                    <td><input name="pesoVis" type="text" value= "<?php echo $resul['PESO_VIS'] ?>"> </td>    
                    <td><input name="freCarVis" type="text" value= "<?php echo $resul['FRCAR_VIS'] ?>"> </td>                    
                    <td><input name="freResVis" type="text" value=  "<?php echo $resul['FRRES_VIS'] ?>"> </td>  
                    <td><input name="estVis" type="text" value= "<?php echo $resul['ANIMO_VIS'] ?>"> </td> 
                    <td><input name="recomVis" type="text" value= "<?php echo $resul['RECOM_VIS'] ?>"> </td> 
                    <td><input name="costVis" type="text" value= "<?php echo $resul['COSTO_VIS'] ?>"> </td>         
                    <td><input name="diagVis" type="text" value= "<?php echo $resul['DIAG_VIS'] ?>"> </td>
                    <td><input name="idMas" type="text" value= "<?php echo $resul['NOM_MAS'] ?>"> </td>
                    <td><input name="idUsu" type="text" value= "<?php echo ($resul['PNOMBRE_USU']. " ". $resul['APELLIDOP_USU']. " - CC". $resul['IDENT_USU'])?>"> </td>
                    <td><input name="idEst" type="text" value= "<?php echo $resul['NOM_EST'] ?>"> </td>
                    <td><a href="?id=<?php echo $resul['ID_VIS'] ?>" class="boton" onclick="window.open('update-visita.php?id=<?php echo $resul['ID_VIS'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update/Delete</a></td>   
                </tr>
                <?php
                }   
                ?>           
            </form>
        </table>
    </body>
</html>