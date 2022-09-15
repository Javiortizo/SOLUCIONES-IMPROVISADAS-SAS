
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>
<?php
if ((isset($_POST["guardar"])) && ($_POST["guardar"] == "frm_usu"))
{
    $tip_usu = $_POST['tipusu'];
    $sql_usu = "SELECT * from tipousuario where USER_TUSU =  '$tip_usu'";
    $tip = mysqli_query($mysqli, $sql_usu);
    $row = mysqli_fetch_assoc($tip);
    if ($row){
        echo '<script>alert ("El usuario ya existe !!! Cambielo ");</script>';
        echo '<script>window.location = "agregar-usu.php"</script>';
    }

    elseif ($_POST["tipusu"] == ""){
        echo '<script>alert ("Campos Vacios ");</script>';
        echo '<script>window.location = "agregar-usu.php"</script>';
    }

    else{
        $tipo = $_POST["tipusu"];
        $sql_usu = "INSERT INTO tipousuario (USER_TUSU) values('$tipo') ";
        $tip = mysqli_query($mysqli, $sql_usu);
        echo '<script>alert ("Registro Existoso ");</script>';
        echo '<script>window.location = "agregar-usu.php"</script>';

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
        <input type="submit" formaction="../index.php" value="Regresar" />
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
            <h1><?php echo $usua['USER_TUSU']?> Formulario Agregar Usuario</h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_usu" method= "POST" autocomplete = "off">
                <tr>
                    <th colspan="2">CREAR USUARIOS</th>
                </tr>
                <tr>
                    <th> Documento Identificación de Usuario </th>                  
                    <th> <input type= "text" readonly></th>
                </tr>
                <tr>
                    <th> Tipo de Usuario </th>                  
                    <th><input type= "number" name= "docu" placeholder = "Ingresar Documento de Identidad"></th>
                </tr>
                <tr>
                    <th> Primer Nombre Usuario </th>                  
                    <th><input type= "txt" name= "pnombre" placeholder = "Ingresar Primer Nombre"></th>
                </tr>
                <tr>
                    <th> Segundo Nombre Usuario</th>                  
                    <th><input type= "txt" name= "snombre" placeholder = "Ingresar Segundo Nombre"></th>
                </tr>
                <tr>
                    <th> Primer Apellido Usuario</th>                  
                    <th><input type= "txt" name= "pape" placeholder = "Ingresar Primer Apellido"></th>
                </tr>
                <tr>
                    <th> Segundo Apellido Usuario</th>                  
                    <th><input type= "txt" name= "sape" placeholder = "Ingresar Segundo Apellido"></th>
                </tr>
                <tr>
                    <th> Dirección Usuario</th>                  
                    <th><input type= "txt" name= "direccion" placeholder = "Ingresar Dirección"></th>
                </tr>
                <tr>
                    <th> Teléfono Usuario</th>                  
                    <th><input type= "number" name= "telefono" placeholder = "Ingresar Teléfono"></th>
                </tr>
                <tr>
                    <th> Correo Electrónico Usuario</th>                  
                    <th><input type= "email" name= "email" placeholder = "Ingresar Correo Electrónico"></th>
                </tr>
                <tr>
                    <th> Tarjeta Profesional</th>                  
                    <th><input type= "number" name= "tprof" placeholder = "Ingresar Número Tarjeta Profesional"></th>
                </tr>
                <tr>
                    <th> Nickname Usuario</th>                  
                    <th><input type= "number" name= "nick" placeholder = "Ingresar Nickname"></th>
                </tr>
                <tr>
                    <th> Contraseña Usuario</th>                  
                    <th><input type= "password" name= "passwd" placeholder = "Ingresar Correo Electrónico"></th>
                </tr>
                <tr>
                    <th> Tipo Usuario</th>                                   
                    <th>
                    </th>
                </tr>
                <tr>
                    <th colspan="2">&nbsp;</th>
                </tr>
                <tr>
                    <th colspan="2"><input type= "submit" value = "Guargar" name= "btn-guardar"></th>
                    <input type= "hidden" name="guardar" value="frm_usu">
            </form>
        </table>
    </body>
</html>