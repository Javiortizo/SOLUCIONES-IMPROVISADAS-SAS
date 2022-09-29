
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
    <meta http-equiv="refresh" content="3">
    <link rel="stylesheet" href="estilos.css">
    <title>Consulta Visita</title>
</head>
    <body>
        <section class="title">
            <h1> Consulta Visitas Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_consultaVisita" method= "POST" autocomplete = "off">
                <tr>
                    <th>&nbsp</th>
                    <th>ID Visita</th>                     
                    <th>Fecha de Visita Mascota</th>
                    <th>Hora Visita Mascota</th>  
                    <th>Temperatura Mascota °C</th>    
                    <th>Peso Mascota Kg</td> 
                    <th>Frecuencia Cardiaca Mascota ppm</th>
                    <th>Frecuencia Respiratoria Mascota rpm</th>
                    <th>Estado de Ánimo Mascota</th>
                    <th>Recomendaciones Visita Mascota</th>
                    <th>Costo Visita Mascota</th>
                    <th>Diagnóstico Visita Mascota</th>
                    <th>Nombre Mascota</th>
                    <th>Veterinario</th>
                    <th>Estado Mascota</th>
                    <th>Acción</th>

                    
                </tr>
                <?php
                    $sql="SELECT * FROM VISITA, MASCOTA, USUARIO, TIPOUSUARIO, ESTADOS WHERE VISITA.ID_MAS = MASCOTA.ID_MAS AND VISITA.ID_USU = USUARIO.ID_USU AND VISITA.ID_EST = ESTADOS.ID_EST AND USUARIO.ID_TUSU = TIPOUSUARIO.ID_TUSU";
                    $i =0;
                    $query = mysqli_query($mysqli,$sql);
                    while($resul=mysqli_fetch_assoc($query)){
                        $i++;
                ?>  
                <tr>   
                    <th><?php echo $i ?></th>
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