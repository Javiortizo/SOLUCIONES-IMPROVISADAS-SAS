
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>
<?php
if ((isset($_POST["guardar"])) && ($_POST["guardar"] == "frm_afiliacion"))
{
    $mas = $_POST['idMascota'];
    $sql_mas = "SELECT * from AFILIACION where ID_MAS =  '$mas'";
    $con_mas = mysqli_query($mysqli, $sql_mas);
    $row = mysqli_fetch_assoc($con_mas);
    if ($row){
        echo '<script>alert ("La mascota ya se encontraba afiliada !!!");</script>';
        echo '<script>window.location = "agregar-afiliacion.php"</script>';
    }

    elseif ($_POST["idMascota"] == ""||$POST['fechaAfiliacion']){
        echo '<script>alert ("Campos Vacios ");</script>';
        echo '<script>window.location = "agregar-afiliacion.php"</script>';
    }

    else{
        $var0 = $_POST["idMascota"];
        $var1 = $_POST["fechaAfiliacion"];
        $sql_afiliacion = "INSERT INTO AFILIACION(ID_MAS, FCHINI_AFIL) VALUES ('$var0','$var1')";
        $query_afiliacion = mysqli_query($mysqli, $sql_afiliacion);
        echo '<script>alert ("Registro Existoso ");</script>';
        echo '<script>window.location = "agregar-afiliacion.php"</script>';

    }
}

?>

<?php
// Realizamos la consulta para la tabla Mascota y Usuario
// SELECT mascota.ID_MAS , mascota.ID_USU, mascota.NOM_MAS, usuario.PNOMBRE_USU, usuario.APELLIDOP_USU, usuario.IDENT_USU FROM mascota INNER JOIN usuario ON mascota.ID_USU = usuario.ID_USU;
$sql_mascota= "SELECT mascota.ID_MAS , mascota.ID_USU, mascota.NOM_MAS, usuario.PNOMBRE_USU, usuario.APELLIDOP_USU, usuario.IDENT_USU FROM mascota INNER JOIN usuario ON mascota.ID_USU = usuario.ID_USU";
$query_mascota = mysqli_query($mysqli,$sql_mascota);
$fila_mascota= mysqli_fetch_assoc($query_mascota);


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
    <title>Agregar Afiliación</title>
</head>
    <body>
        <section class="title">
            <h1> Formulario Agregar Afiliación Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_afiliacion" method= "POST" autocomplete = "off">
                <tr>
                    <th colspan="2">CREAR AFILIACIÓN</th>
                </tr>
                <tr>
                    <th> ID Afiliación </th>                  
                    <th> <input type= "text" readonly></th>
                </tr>
                <tr>
                    <th> Fecha de Afiliación Mascota </th>                  
                    <th><input type= "date" name= "fechaAfiliacion" placeholder = "Ingrese Fecha de Afiliación de la Mascota"></th>
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
                    <th colspan="2">&nbsp;</th>
                </tr>
                <tr>
                    <th colspan="2"><input type= "submit" value = "Guardar" name= "btn-guardar"></th>
                    <input type= "hidden" name="guardar" value="frm_afiliacion">
            </form>
        </table>
    </body>
</html>