
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>
<?php
if ((isset($_POST["guardar"])) && ($_POST["guardar"] == "frm_recimed"))
{
    if ($_POST["idVisita"] == "" || $_POST['idMedicamento'] == ""){
        echo '<script>alert ("Campos Vacios ");</script>';
        echo '<script>window.location = "agregar-remedicamentos.php"</script>';
    }

    else{
        $var0 = $_POST["idVisita"];
        $var1 = $_POST["idMedicamento"];
        $sql_remed = "INSERT INTO recibosmed(ID_MED, ID_VIS) VALUES ('$var1','$var0')";
        $query_remed = mysqli_query($mysqli, $sql_remed);
        echo '<script>alert ("Registro Existoso ");</script>';
        echo '<script>window.location = "agregar-remedicamentos.php"</script>';

    }
}

?>

<?php
// Realizamos la consulta para la tabla de visitas
// SELECT ID_VIS FROM `visita`;
$sql_vis= "SELECT visita.ID_VIS, mascota.NOM_MAS, usuario.PNOMBRE_USU, usuario.IDENT_USU, visita.FECHA_VIS, visita.ID_USU
from mascota
INNER JOIN usuario ON mascota.ID_USU = usuario.ID_USU 
INNER JOIN visita ON mascota.ID_MAS = visita.ID_MAS
ORDER BY visita.ID_VIS;";
$query_vis = mysqli_query($mysqli,$sql_vis);
$fila_vis= mysqli_fetch_assoc($query_vis);
//var_dump($fila_vis);

//Consulta a tabla de medicamentos
//SELECT * FROM `medicamentos` WHERE 1;
$sql_medi= "SELECT * FROM medicamentos";
$query_medi = mysqli_query($mysqli,$sql_medi);
$fila_medi= mysqli_fetch_assoc($query_medi);
//var_dump($fila_medi);

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
    <title>Recibo de Medicamentos</title>
</head>
    <body>
        <section class="title">
            <h1> Formulario Agregar Recibo Medicamentos <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_recimed" method= "POST" autocomplete = "off">
                <tr>
                    <th colspan="2">AGREGAR RECIBO MEDICAMENTOS</th>
                </tr>
                <tr>
                    <th>Identificador Visita</th>                                   
                    <th>
                        <select name="idVisita">
                                <option value= "">Seleccione La Visita</option>
                                <?php
                                    // Código php ciclo
                                    do{

                                ?> 
                                <option value="<?php echo ($fila_vis['ID_VIS']) ?>"><?php echo ($fila_vis['NOM_MAS']."-".$fila_vis['PNOMBRE_USU']."-".$fila_vis['IDENT_USU']."-".$fila_vis['FECHA_VIS']) ?></option>
                                <?php } while($fila_vis=mysqli_fetch_assoc($query_vis));
                                ?>
                        </select>
                    </th>
                </tr>

                <tr>
                    <th>Identificador Medicamento</th>                                   
                    <th>
                        <select name="idMedicamento">
                                <option value= "">Seleccione El Medicamento</option>
                                <?php
                                    // Código php ciclo
                                    do{

                                ?> 
                                <option value="<?php echo ($fila_medi['ID_MED']) ?>"><?php echo ($fila_medi['NOMMED_MED']) ?></option>
                                <?php } while($fila_medi=mysqli_fetch_assoc($query_medi));
                                ?>
                        </select>
                    </th>
                </tr>                

                <tr>
                    <th colspan="2">&nbsp;</th>
                </tr>
                <tr>
                    <th colspan="2"><input type= "submit" value = "Guardar" name= "btn-guardar"></th>
                    <input type= "hidden" name="guardar" value="frm_recimed">
                </tr>
            </form>
        </table>
    </body>
</html>