
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>



<?php
// Realizamos la consulta para la tabla Tipos de Usurio
// SELECT * FROM `tipousuario`
$sql_tusu= "SELECT * FROM tipousuario";
$query_tusu = mysqli_query($mysqli,$sql_tusu);
$fila_tusu= mysqli_fetch_assoc($query_tusu);

// Realizamos la consulta para la tabla Estados
// SELECT * FROM `estados`
$sql_estados= "SELECT * FROM estados where id_est <3";
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
    <title>Agregar Usuario</title>
</head>
    <body>
        <section class="title">
            <h1> Formulario Consuta de Usuarios Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_consultaUsuario" method= "POST" autocomplete = "off">
                <tr>
                    <td>&nbsp</td>
                    <td>ID Usuario</td>                     
                    <td>Documento</td>
                    <td>Nombre</td>  
                    <td>Apellido</td>    
                    <td>Dirección</td> 
                    <td>Teléfono</td>
                    <td>E-mail</td>
                    <td>Tarjeta Profesional</td>
                    <td>Tipo Usuario</td>
                    <td>Estado</td>
                    <td>Accion</td>

                    
                </tr>
                <?php
                    $sql="SELECT * FROM USUARIO, TIPOUSUARIO, ESTADOS WHERE USUARIO.ID_TUSU = TIPOUSUARIO.ID_TUSU AND USUARIO.ID_EST = ESTADOS.ID_EST";
                    $i =0;
                    $query = mysqli_query($mysqli,$sql);
                    while($resul=mysqli_fetch_assoc($query)){
                        $i++;
                ?>  
                <tr>   
                    <td><?php echo $i ?></td>
                    <td><input name="idUsu" type="text" value= "<?php echo $resul ['ID_USU'] ?>"> </td>    
                    <td><input name="identUsu" type="text" value= "<?php echo $resul['IDENT_USU'] ?>"> </td>    
                    <td><input name="pNom" type="text" value= "<?php echo $resul['PNOMBRE_USU'] ?>"> </td>    
                    <td><input name="pApe" type="text" value= "<?php echo $resul['APELLIDOP_USU'] ?>"> </td>    
                    <td><input name="dir" type="text" value= "<?php echo $resul['DIRECCION_USU'] ?>"> </td>    
                    <td><input name="tel" type="text" value= "<?php echo $resul['TELEFONO_USU'] ?>"> </td>                    
                    <td><input name="eMail" type="text" value=  "<?php echo $resul['CORREO_USU'] ?>"> </td>  
                    <td><input name="tProf" type="text" value= "<?php echo $resul['TPROF_USU'] ?>"> </td> 
                    <td><input name="tUsu" type="text" value= "<?php echo $resul['USER_TUSU'] ?>"> </td> 
                    <td><input name="est" type="text" value= "<?php echo $resul['NOM_EST'] ?>"> </td>                  
                    <td><a href="?id=<?php echo $resul['ID_USU'] ?>" class="boton" onclick="window.open('update-usuario.php?id=<?php echo $resul['ID_USU'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update/Delete</a></td>   
                </tr>
                <?php
                }   
                ?>           
            </form>
        </table>
    </body>
</html>