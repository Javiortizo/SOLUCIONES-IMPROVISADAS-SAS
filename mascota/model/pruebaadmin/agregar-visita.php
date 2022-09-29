
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>
<?php
if ((isset($_POST["guardar"])) && ($_POST["guardar"] == "frm_visita"))
{
    $fechaVisita = $_POST['fechaVisita'];
    $idMascota= $_POST['idMascota'];
    $sql_vis = "SELECT * FROM visita WHERE ID_MAS= '$idMascota'and FECHA_VIS = '$fechaVisita'";
    $con_vis = mysqli_query($mysqli, $sql_vis);
    $row = mysqli_fetch_assoc($con_vis);
    if ($row){
        echo '<script>alert ("La Visita ya se encontraba Registrada. Por favor Verificar !!!");</script>';
        echo '<script>window.location = "agregar-visita.php"</script>';
    }

    elseif ($_POST["fechaVisita"] == ""|| $_POST["tempMascota"] == ""|| $_POST["pesoMascota"] == ""|| $_POST["frecuenciaCardiaca"] == ""|| $_POST["frecuenciaRespiratoria"] == ""|| $_POST["estadoAnimo"] == ""|| $_POST["recomVisita"] == ""|| $_POST["costoVisita"] == ""|| $_POST["idMascota"] == ""|| $_POST["idVeterinario"] == ""|| $_POST["estado"] == ""){
        echo '<script>alert ("Campos Vacios ");</script>';
        echo '<script>window.location = "agregar-visita.php"</script>';
    }

    else{
        $var0 = $_POST["fechaVisita"];
        $var1 = $_POST["horaVisita"];
        $var2 = $_POST["tempMascota"];
        $var3 = $_POST["pesoMascota"];
        $var4 = $_POST["frecuenciaCardiaca"];
        $var5 = $_POST["frecuenciaRespiratoria"];
        $var6 = $_POST["estadoAnimo"];
        $var7 = $_POST["recomVisita"];
        $var8 = $_POST["costoVisita"];
        $var9 = $_POST["diagVisita"];
        $var10 = $_POST["idMascota"];
        $var11 = $_POST["idVeterinario"];
        $var12 = $_POST["estado"];
        $sql_visita = "INSERT INTO visita (ID_USU, ID_MAS, ID_EST, FECHA_VIS, HORA_VIS, TEMP_VIS, PESO_VIS, FRCAR_VIS, FRRES_VIS, ANIMO_VIS, RECOM_VIS, COSTO_VIS, DIAG_VIS) VALUES ('$var11',' $var10','$var12','$var0','$var1','$var2','$var3','$var4','$var5','$var6','$var7','$var8','$var9')";
        $query_visita = mysqli_query($mysqli, $sql_visita);
        echo '<script>alert ("Registro Existoso ");</script>';
        echo '<script>window.location = "agregar-visita.php"</script>';

    }
}

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
    <title>Agregar Visita</title>
</head>
    <body>
        <section class="title">
            <h1> Formulario Agregar Visita Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_visita" method= "POST" autocomplete = "off">
                <tr>
                    <th colspan="2">CREAR VISITA</th>
                </tr>
                <tr>
                    <th> ID Visita </th>                  
                    <th> <input type= "text" readonly></th>
                </tr>
                <tr>
                    <th> Fecha de Visita Mascota </th>                  
                    <th><input type= "date" name= "fechaVisita" placeholder = "Ingrese Fecha de Visita de la Mascota"></th>
                </tr>
                <tr>
                    <th> Hora Visita Mascota </th>                  
                    <th><input type= "text" name= "horaVisita" placeholder = "Ingrese Hora de Visita de la Mascota"></th>
                </tr>
                <tr>
                    <th> Temperatura Mascota °C</th>                  
                    <th><input type= "number" step="0.1" min="0" max="100" name= "tempMascota" placeholder = "Ingrese Temperatura de la Mascota"></th>
                </tr>
                <tr>
                    <th> Peso Mascota Kg</th>                  
                    <th><input type= "number" step="0.1" min="0" max="1000" name= "pesoMascota" placeholder = "Ingrese Peso de la Mascota"></th>
                </tr>
                <tr>
                    <th> Frecuencia Cardiaca Mascota ppm </th>                  
                    <th><input type= "number" min="0" max="200" name= "frecuenciaCardiaca" placeholder = "Ingrese Frecuencia Cardiaca de la Mascota"></th>
                </tr>
                <tr>
                    <th> Frecuencia Respiratoria Mascota rpm</th>                  
                    <th><input type= "number" min="0" max="50" name= "frecuenciaRespiratoria" placeholder = "Ingrese Frecuencia Cardiaca de la Mascota"></th>
                </tr>
                <tr>
                    <th> Estado de Ánimo Mascota </th>                  
                    <th><input type= "text" name= "estadoAnimo" placeholder = "Ingrese Estado de Ánimo de la Mascota"></th>
                </tr>
                <tr>
                    <th> Recomendaciones Visita Mascota </th>                  
                    <th><input type= "text" name= "recomVisita" placeholder = "Ingrese Recomendaciones Visita de la Mascota"></th>
                </tr>
                <tr>
                    <th> Costo Visita Mascota </th>                  
                    <th><input type= "texto" name= "costoVisita" placeholder = "Ingrese Costo de la Visita a la Mascota"></th>
                </tr>
                <tr>
                    <th> Diagnóstico Visita Mascota </th>                  
                    <th><input type= "text" name= "diagVisita" placeholder = "Ingrese Diagnóstico de la Mascota"></th>
                </tr>
                <tr>
                    <th> Mascota - Dueño</th>                                   
                    <th>
                        <select name="idMascota">
                                <option value= "">Seleccione La Mascota</option>
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
                                <option value= "">Seleccione El Veterinario</option>
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
                                <option value= "">Seleccione Estado Mascota</option>
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
                    <th colspan="2">&nbsp;</th>
                </tr>
                <tr>
                    <th colspan="2"><input type= "submit" value = "Guardar" name= "btn-guardar"></th>
                    <input type= "hidden" name="guardar" value="frm_visita">
            </form>
        </table>
    </body>
</html>