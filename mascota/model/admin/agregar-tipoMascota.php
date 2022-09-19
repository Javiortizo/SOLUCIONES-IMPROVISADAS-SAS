
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>

<?php
if ((isset($_POST["guardar"]))&&($_POST["guardar"]=="frm_tmas"))
{
    $tip_mas=$_POST["tipmas"];
    $sql_usu="SELECT * FROM tipomascota WHERE tipo_tmas = '$tip_mas'";
    $tip = mysqli_query($mysqli, $sql_usu);
    $row = mysqli_fetch_assoc($tip);

    if ($row){
        echo '<script>alert ("El tipo de mascota ya existe cambielo");</script>';
        echo '<script>window.location="agregar-tipoMascota.php"</script>';
    }
   

    elseif ($_POST["tipmas"] == ""){
        echo '<script>alert ("Campos vacios");</script>';
        echo '<script>window.location="agregar-tipoMascota.php"</script>';
    }

    else{
        $tip_mas=$_POST["tipmas"];
        $sql_usu="INSERT INTO tipomascota (TIPO_TMAS) values('$tip_mas') ";
        $tip = mysqli_query($mysqli, $sql_usu);
        echo '<script>alert ("Registro Ingresado Exitosamente");</script>';
        echo '<script>window.location="agregar-tipoMascota.php"</script>';
    
    }


}
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
    <title>taller</title>
</head>
    <body>
        <section class="title">
            <h1>FORMULARIO AGREGAR TIPO DE MASCOTA DESDE <?php echo $usua['USER_TUSU']?></h1>
        </section>
    <table border="1" class="center">
        <form name="frm_tmas" method="POST" autocomplete="off">
            <tr>
                <th colspan="2">CREAR TIPO DE MASCOTA</th>
            </tr>


            <tr>
                <th>Ident. Tipo Mascota</th>
                <th><input type="text" readonly></th>
            </tr>
            
            <tr>
                <th>Tipo Mascota</th>
                <th><input type="text" name="tipmas" placeholder="Ingresar tipo mascota" ></th>               
            </tr>
            
            <tr>
                <th colspan="2">&nbsp;</th>             
            </tr>
            
            <tr>
                <th colspan="2"><input type="submit" value="Guardar" name="btnguardar"></th>
                <input type="hidden" name="guardar" value="frm_tmas">                 
            </tr>

           <!--  <tr>
                <th colspan="2"><button type="submit" value="Eliminar" name="btnsalir">Eliminar</button></th>
                <input type="hidden" name="eliminar" value="frm_tmas">                 
            </tr> -->

        </form>
    </table>
    </body>
</html>