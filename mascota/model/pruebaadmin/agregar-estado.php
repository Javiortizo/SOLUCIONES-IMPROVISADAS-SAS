
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>
<?php
if ((isset($_POST["guardar"])) && ($_POST["guardar"] == "frm_estado"))
{
    $estado = $_POST['nomEstado'];
    $sql_estado = "SELECT * from ESTADOS where NOM_EST =  '$estado'";
    $con_estado = mysqli_query($mysqli, $sql_estado);
    $row = mysqli_fetch_assoc($con_estado);
    if ($row){
        echo '<script>alert ("El estado ya existe !!! Cambielo ");</script>';
        echo '<script>window.location = "agregar-estado.php"</script>';
    }

    elseif ($_POST["nomEstado"] == ""){
        echo '<script>alert ("Campos Vacios ");</script>';
        echo '<script>window.location = "agregar-estado.php"</script>';
    }

    else{
        $tipoEstado = $_POST["nomEstado"];
        $sql_est = "INSERT INTO ESTADOS (NOM_EST) values('$tipoEstado') ";
        $tip = mysqli_query($mysqli, $sql_est);
        echo '<script>alert ("Registro Existoso ");</script>';
        echo '<script>window.location = "agregar-estado.php"</script>';

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
    <title>Agregar Estado</title>
</head>
    <body>
        <section class="title">
            <h1>Formulario Agregar Tipo Estado Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_estado" method= "POST" autocomplete = "off">
                <tr>
                    <th colspan="2">CREAR ESTADOS</th>
                </tr>
                <tr>
                    <th> ID Estado </th>                  
                    <th> <input type= "text" readonly></th>
                </tr>
                <tr>
                    <th> Tipo Estado </th>                  
                    <th><input type= "text" name= "nomEstado" placeholder = "Ingresar Estado"></th>
                </tr>
                <tr>
                    <th colspan="2">&nbsp;</th>
                </tr>
                <tr>
                    <th colspan="2"><input type= "submit" value = "Guardar" name= "btn-guardar"></th>
                    <input type= "hidden" name="guardar" value="frm_estado">
            </form>
        </table>
    </body>
</html>