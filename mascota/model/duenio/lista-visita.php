<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);

?>

<form method="POST">
    <tr><td colspan='2' align="center">Bienvenid@ <?php echo $usua['PNOMBRE_USU']?></td></tr>
<tr><br>
    <td colspan='2' align="center">    
        <!-- <input class="usuariosButton guardarForm" type="submit" value="Cerrar sesión" name="btncerrar" /></td> -->
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
    <!-- <meta http-equiv="refresh" content="15"> -->
    <link rel="stylesheet" href="css/estilosPrueba.css">
    <title>Consulta Visita</title>
</head>
    <body>
        <header >
            <h1 class="tittleAdmin"> Consulta Visitas Desde <?php echo $usua['USER_TUSU']?></h1>
            <p class="adminLabel"> Desde aqui puedes ver las visitas asociadas a tu mascota </p>
        </header>

        <table border="1" class="">
            <form name= "frm_consultaVisita" method= "POST" autocomplete = "off">
                <!-- <tr>
                    <td colspan='2'><button type="submit" onclick="window.open('agregar-visita.php','','width= 600,height=500, toolbar=NO');void(null);" >Agregar</button></td>
                </tr> -->

                <div class="usuariosHeaderBoldCell">
                    <div class="idvis"> ID </div>
                    <div class="fechVis"> Fecha de Visita  </div>
                    <div class="horaVis"> Hora Visita  </div>
                    <div class="tempVis"> Temperatura </div>
                    <div class="pesoVis"> Peso </div>
                    <div class="freCarVis"> Frecuencia Cardiaca ppm </div>
                    <div class="freResVis"> Frecuencia Respiratoria rpm </div>
                    <div class="estVis"> Estado de Ánimo </div>
                    <div class="recomVis">Recomendaciones </div>
                    <div class="costVis">Costo Visita </div>
                    <div class="diagVis"> Diagnóstico </div>
                    <div class="idMas"> Nombre Mascota </div>
                    <div class="idUsu"> Veterinario </div>
                    <div class="idEst"> Estado  </div>
                    <div class="historia"> Recibos Med. </div>
                </div>

                <!-- <tr>
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
                    <th>Recibos Med.</th>
                </tr> -->

                <?php
                    $sql="SELECT * from visita INNER JOIN usuario ON visita.ID_USU = usuario.ID_USU inner join estados on visita.ID_EST= estados.ID_EST INNER JOIN mascota ON mascota.ID_MAS = visita.ID_MAS where mascota.ID_USU = '".$usua['ID_USU']."' ORDER BY visita.ID_VIS";
                    $i =0;
                    $query = mysqli_query($mysqli,$sql);
                    while($resul=mysqli_fetch_assoc($query)){
                        $i++;
                ?>  
                <tr>   
                <div class="usuariosHeader2">
                    <!-- <div><?php echo $i ?></div> -->
                    <div><?php echo $resul ['ID_VIS'] ?> </div>    
                    <div><?php echo $resul['FECHA_VIS'] ?> </div>    
                    <div><?php echo $resul['HORA_VIS'] ?> </div>    
                    <div><?php echo $resul['TEMP_VIS'] ?></div>    
                    <div><?php echo $resul['PESO_VIS'] ?></div>    
                    <div><?php echo $resul['FRCAR_VIS'] ?></div>                    
                    <div><?php echo $resul['FRRES_VIS'] ?></div>  
                    <div><?php echo $resul['ANIMO_VIS'] ?></div> 
                    <div><?php echo $resul['RECOM_VIS'] ?></div> 
                    <div><?php echo $resul['COSTO_VIS'] ?></div>         
                    <div><?php echo $resul['DIAG_VIS'] ?></div>
                    <div><?php echo $resul['NOM_MAS'] ?></div>
                    <div><?php echo ($resul['PNOMBRE_USU']. " ". $resul['APELLIDOP_USU']. " - CC". $resul['IDENT_USU'])?></div>
                    <div><?php echo $resul['NOM_EST'] ?></div>
                    <div><a href="?id=<?php echo $resul['ID_VIS'] ?>" class="boton" onclick="window.open('lista-recibosmed.php?id=<?php echo $resul['ID_VIS'] ?>','','width= 900,height=600, toolbar=NO');void(null);">Consultar</a></td>   
                    <!-- <td><a href="?id=<?php echo $resul['ID_VIS'] ?>" class="boton" onclick="window.open('update-visita.php?id=<?php echo $resul['ID_VIS'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update</a></td>    -->
                </tr>
                <?php
                }   
                ?>           
            </form>
        </table>
    </body>
</html>