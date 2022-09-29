
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$tipoUsuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($tipoUsuarios);


?>
<?php
if ((isset($_POST["guardar"])) && ($_POST["guardar"] == "frm_tipUsu"))
{
    $tip_usu = $_POST['tipUsu'];
    $sql_usu = "SELECT * from tipousuario where USER_TUSU =  '$tip_usu'";
    $tip = mysqli_query($mysqli, $sql_usu);
    $row = mysqli_fetch_assoc($tip);
    if ($row){
        echo '<script>alert ("El usuario ya existe !!! Cambielo ");</script>';
        echo '<script>window.location = "agregar-tipoUsuario.php"</script>';
    }

    elseif ($_POST["tipUsu"] == ""){
        echo '<script>alert ("Campos Vacios ");</script>';
        echo '<script>window.location = "agregar-tipoUsuario.php"</script>';
    }

    else{
        $tipo = $_POST["tipUsu"];
        $sql_usu = "INSERT INTO tipousuario (USER_TUSU) values('$tipo') ";
        $tip = mysqli_query($mysqli, $sql_usu);
        echo '<script>alert ("Registro Existoso ");</script>';
        echo '<script>window.location = "agregar-tipoUsuario.php"</script>';

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
    <title>Agregar Tipo Usuario</title>
</head>
    <body>
        <section class="title">
            <h1> Formulario Agregar Tipo Usuario Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_tipUsu" method= "POST" autocomplete = "off">
                <tr>
                    <th colspan="2">CREAR TIPOS DE USUARIOS</th>
                </tr>
                <tr>
                    <th> Identificador </th>                  
                    <th> <input type= "text" readonly></th>
                </tr>
                <tr>
                    <th> Tipo de Usuario </th>                  
                    <th><input type= "text" name= "tipUsu" placeholder = "Ingresar Tipo Usuario"></th>
                </tr>
                <tr>
                    <th colspan="2">&nbsp;</th>
                </tr>
                <tr>
                    <th colspan="2"><input type= "submit" value = "Guardar" name= "btn-guardar"></th>
                    <input type= "hidden" name="guardar" value="frm_tipUsu">
            </form>
        </table>
    </body>
</html>