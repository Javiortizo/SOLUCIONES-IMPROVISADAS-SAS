<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");

$sql ="SELECT * FROM VISITA, MASCOTA, USUARIO, TIPOUSUARIO, ESTADOS WHERE VISITA.ID_MAS = MASCOTA.ID_MAS AND VISITA.ID_USU = USUARIO.ID_USU AND VISITA.ID_EST = ESTADOS.ID_EST AND USUARIO.ID_TUSU = TIPOUSUARIO.ID_TUSU and VISITA.ID_VIS = '".$_GET['id']."'";
$query = mysqli_query($mysqli,$sql);
$result = mysqli_fetch_assoc($query);

?>
<?php
// Realizamos la consulta para la tabla Mascota y Usuario
// SELECT mascota.ID_MAS , mascota.ID_USU, mascota.NOM_MAS, usuario.PNOMBRE_USU, usuario.APELLIDOP_USU, usuario.IDENT_USU FROM mascota INNER JOIN usuario ON mascota.ID_USU = usuario.ID_USU;
$sql_mascota= "SELECT mascota.ID_MAS , mascota.ID_USU, mascota.NOM_MAS, usuario.PNOMBRE_USU, usuario.APELLIDOP_USU, usuario.IDENT_USU FROM mascota INNER JOIN usuario ON mascota.ID_USU = usuario.ID_USU";
$query_mascota = mysqli_query($mysqli,$sql_mascota);
$fila_mascota= mysqli_fetch_assoc($query_mascota);

// Realizamos la consulta para la tabla Usuario y Tipo Usuario
// SELECT usuario.ID_USU, usuario.PNOMBRE_USU, usuario.APELLIDOP_USU, usuario.IDENT_USU, tipousuario.USER_TUSU FROM usuario inner join tipousuario on usuario.ID_TUSU = tipousuario.ID_TUSU WHERE tipousuario.ID_TUSU=2;
$sql_vet = "SELECT usuario.ID_USU, usuario.PNOMBRE_USU, usuario.APELLIDOP_USU, usuario.IDENT_USU, tipousuario.USER_TUSU FROM usuario inner join tipousuario on usuario.ID_TUSU = tipousuario.ID_TUSU WHERE tipousuario.ID_TUSU=2";
$query_vet = mysqli_query($mysqli,$sql_vet);
$fila_vet= mysqli_fetch_assoc($query_vet);

// Realizamos la consulta para la tabla Estado con filtro por Tipo de Estado
// SELECT * FROM `estados` WHERE `ID_EST`>2;
$sql_estados = "SELECT * FROM estados WHERE ID_EST>2";
$query_estados = mysqli_query($mysqli,$sql_estados);
$fila_estados= mysqli_fetch_assoc($query_estados);
?>
<?php
if(isset($_POST["update"]))
{
    $idVis= $_POST['idVis'];
    $fechVis= $_POST['fechVis'];
    $horaVis= $_POST['horaVis'];
    $tempVis= $_POST['tempVis'];
    $pesoVis= $_POST['pesoVis'];
    $freCarVis= $_POST['freCarVis'];
    $freResVis= $_POST['freResVis'];
    $estVis= $_POST['estVis'];
    $recomVis= $_POST['recomVis'];
    $costVis= $_POST['costVis'];
    $diagVis= $_POST['diagVis'];
    $idMascota= $_POST['idMascota'];
    $idVeterinario= $_POST['idVeterinario'];
    $estado= $_POST['estado'];
    $sql_update="UPDATE visita SET ID_USU ='$idVeterinario', ID_MAS ='$idMascota', ID_EST ='$estado', FECHA_VIS ='$fechVis', HORA_VIS ='$horaVis', TEMP_VIS ='$tempVis', PESO_VIS ='$pesoVis', FRCAR_VIS ='$freCarVis', FRRES_VIS ='$freResVis', ANIMO_VIS ='$estVis', RECOM_VIS ='$recomVis', COSTO_VIS ='$costVis', DIAG_VIS ='$diagVis' WHERE ID_VIS = '".$_GET['id']."'";
    $cs=mysqli_query($mysqli, $sql_update);
    echo '<script>alert (" Actualización Exitosa ");</script>';
    
 }
 elseif (isset($_POST["delete"])) 
 {
 
    $sql_delete="DELETE FROM VISITA WHERE ID_VIS = '".$_GET['id']."'";
    $cs=mysqli_query($mysqli, $sql_delete);
    echo '<script>alert (" Registro Eliminado Exitosamente ");</script>';
 }
?>

<!DOCTYPE html>
<html lang="en">
<script> 
function centrar() { 
    iz=(screen.width-document.body.clientWidth) / 2; 
    de=(screen.height-document.body.clientHeight) / 2; 
    moveTo(iz,de); 
}     
</script>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="centrar();">
    <table border="1" class="Center">
            <form name= "frm_consultaUsuario" method= "POST" autocomplete = "off">
                <tr>
                    <td>Id Visita</td>
                    <td><input readonly name="idVis" type="text" value="<?php echo $result ['ID_VIS'] ?>"></td>
                </tr>
                <tr>
                    <td>Fecha de Visita Mascota</td>
                    <td><input name="fechVis" type="date" value="<?php echo $result ['FECHA_VIS'] ?>"></td>
                </tr>
                <tr>
                    <td>Hora Visita Mascota</td>
                    <td><input name="horaVis" type="text" value="<?php echo $result ['HORA_VIS'] ?>"></td>
                </tr>
                <tr>
                    <td>Temperatura Mascota °C</td>
                    <td><input name="tempVis" type="text" value="<?php echo $result ['TEMP_VIS'] ?>"></td>
                </tr>
                <tr>
                    <td>Peso Mascota Kg</td>
                    <td><input name="pesoVis" type="text" value="<?php echo $result ['PESO_VIS'] ?>"></td>
                </tr>
                <tr>
                    <td>Frecuencia Cardiaca Mascota ppm</td>
                    <td><input name="freCarVis" type="text" value="<?php echo $result ['FRCAR_VIS'] ?>"></td>
                </tr>
                <tr>
                    <td>Frecuencia Respiratoria Mascota rpm</td>
                    <td><input name="freResVis" type="text" value="<?php echo $result ['FRRES_VIS'] ?>"></td>
                </tr>
                <tr>
                    <td>Estado de Ánimo Mascota</td>
                    <td><input name="estVis" type="text" value="<?php echo $result ['ANIMO_VIS'] ?>"></td>
                </tr>
                <tr>
                    <td>Recomendaciones Visita Mascota</td>
                    <td><input name="recomVis" type="text" value="<?php echo $result ['RECOM_VIS'] ?>"></td>
                </tr>
                <tr>
                    <td>Costo Visita Mascota</td>
                    <td><input name="costVis" type="text" value="<?php echo $result ['COSTO_VIS'] ?>"></td>
                </tr>
                <tr>
                    <td>Diagnóstico Visita Mascota</td>
                    <td><input name="diagVis" type="text" value="<?php echo $result ['DIAG_VIS'] ?>"></td>
                </tr>
                <tr>
                    <th> Mascota - Dueño</th>                                   
                    <th>
                        <select name="idMascota">
                                <option value= "<?php echo $result ['ID_MAS'] ?>"><?php echo $result ['NOM_MAS'] ?></option>
                                <?php
                                    // Código php ciclo
                                    do{

                                ?> 
                                <option value="<?php echo ($fila_mascota['ID_MAS']) ?>"><?php echo ($fila_mascota['NOM_MAS']. " - ". $fila_mascota['PNOMBRE_USU']. " ".$fila_mascota['APELLIDOP_USU']. " - CC".$fila_mascota['IDENT_USU']) ?></option>
                                <?php } while($fila_mascota=mysqli_fetch_assoc($query_mascota));
                                ?>
                        </select>
                    </th>
                </tr>
                <tr>
                    <th> ID Veterinario</th>                                   
                    <th>
                        <select name="idVeterinario">
                                <option value= "<?php echo $result ['ID_USU'] ?>"><?php echo ($result['PNOMBRE_USU']. " ". $result['APELLIDOP_USU']. " - CC". $result['IDENT_USU']) ?></option>
                                <?php
                                    // Código php ciclo
                                    do{

                                ?> 
                                <option value="<?php echo ($fila_vet['ID_USU']) ?>"><?php echo ($fila_vet['PNOMBRE_USU']. " ". $fila_vet['APELLIDOP_USU']. " - CC". $fila_vet['IDENT_USU']) ?></option>
                                <?php } while($fila_vet= mysqli_fetch_assoc($query_vet));
                                ?>
                        </select>
                    </th>
                </tr>
                <tr>
                    <th> Tipo Estado</th>                                   
                    <th>
                        <select name="estado">
                                <option value= "<?php echo $result ['ID_EST'] ?>"><?php echo $result ['NOM_EST'] ?></option>
                                <?php
                                    // Código php ciclo
                                    do{

                                ?> 
                                <option value="<?php echo ($fila_estados['ID_EST']) ?>"><?php echo ($fila_estados['NOM_EST']) ?></option>
                                <?php } while($fila_estados=mysqli_fetch_assoc($query_estados));
                                ?>
                        </select>
                    </th>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td><input type="submit" name="update" value="Update"></td>
                    

                    <td><input type="submit" name="delete" value="Delete"></td>
                                        
                </tr>
            </form>
    </table>
</body>
</html>