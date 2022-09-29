
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>
<?php
if ((isset($_POST["guardar"])) && ($_POST["guardar"] == "frm_medicamento"))
{
    $medicamento = $_POST['NOMMED_MED'];
    $sql_medicamento = "SELECT * from MEDICAMENTOS where NOMMED_MED =  '$medicamento'";
    $con_medicamento = mysqli_query($mysqli, $sql_medicamento);
    $row = mysqli_fetch_assoc($con_medicamento);
    if ($row){
        echo '<script>alert ("El medicamento ya existe !!! Cambielo ");</script>';
        echo '<script>window.location = "agregar-medicamentos.php"</script>';
    }

    elseif ($_POST["NOMMED_MED"] == ""){
        echo '<script>alert ("Campos Vacios ");</script>';
        echo '<script>window.location = "agregar-medicamentos.php"</script>';
    }

    else{
        $med = $_POST["NOMMED_MED"];
        $sql_med = "INSERT INTO MEDICAMENTOS (NOMMED_MED) values('$med') ";
        $m = mysqli_query($mysqli, $sql_med);
        echo '<script>alert ("Registro Existoso ");</script>';
        echo '<script>window.location = "agregar-medicamentos.php"</script>';

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
    <title>Agregar Medicamento</title>
</head>
    <body>
        <section class="title">
            <h1> Agregar Medicamento Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_medicamento" method= "POST" autocomplete = "off">
                <tr>
                    <th colspan="2">CREAR MEDICAMENTO</th>
                </tr>
                <tr>
                    <th> Id Medicamento </th>                  
                    <td> <input type= "text" readonly></td>
                </tr>
                <tr>
                    <th> Medicamento </th>                  
                    <td><input type= "text" name= "NOMMED_MED" placeholder = "Ingresar Medicamento"></td>
                </tr>
                <tr>
                    <th colspan="2">&nbsp;</th>
                </tr>
                <tr>
                    <th colspan="2"><input type= "submit" value = "Guardar" name= "btn-guardar"></th>
                    <input type= "hidden" name="guardar" value="frm_medicamento">
            </form>
        </table>
    </body>
</html>