
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>





<form method="POST">

    <tr>
        <td colspan='2' align="center"><?php echo $usua['PNOMBRE_USU']?></td>
    </tr>
<tr><br>
    <td colspan='2' align="center">
    
    
        <input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
        <input type="submit" formaction="./indexVet.php" value="Regresar" />
    </tr>
</form>

<?php 

if(isset($_POST['btncerrar']))
{
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
    <meta http-equiv="refresh" content="5">
    <link rel="stylesheet" href="estilos.css">
    <title>Consulta Usuario</title>
</head>
    <body>
        <section class="title">
            <h1> Consuta Usuarios Desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_consultaUsuario" method= "POST" autocomplete = "off">
                <tr>
                    <td colspan='2'><button type="submit" onclick="window.open('agregar-usuario.php','','width= 600,height=500, toolbar=NO');void(null);" >Agregar</button></td>
                </tr>
                <tr>
                    <th>&nbsp</th>
                    <!-- <th>id Usuario</th>                      -->
                    <th>Doc Ident Usuario</th>
                    <th>Nombre</th>  
                    <th>Apellido</th>    
                    <th>Dirección</th> 
                    <th>Teléfono</th>
                    <th>E-mail</th>
                    <!-- <th>Tarjeta Profesional</th> -->
                    <!-- <th>Tipo Usuario</th> -->
                    <th>Estado</th>
                    <!-- <th>Acción</th> -->

                    
                </tr>
                <?php
                    $sql="SELECT * FROM USUARIO, TIPOUSUARIO, ESTADOS WHERE USUARIO.ID_TUSU = TIPOUSUARIO.ID_TUSU AND USUARIO.ID_EST = ESTADOS.ID_EST AND TIPOUSUARIO.ID_TUSU = 3 AND ESTADOS.ID_EST <3";
                    $i =0;
                    $query = mysqli_query($mysqli,$sql);
                    while($resul=mysqli_fetch_assoc($query)){
                        $i++;
                ?>  
                <tr>   
                    <th><?php echo $i ?></th>
                    <!-- <td><input name="idUsu" type="text" value= "<?php echo $resul ['ID_USU'] ?>"> </td>     -->
                    <td><input name="identUsu" type="text" value= "<?php echo $resul['IDENT_USU'] ?>"> </td>    
                    <td><input name="pNom" type="text" value= "<?php echo $resul['PNOMBRE_USU'] ?>"> </td>    
                    <td><input name="pApe" type="text" value= "<?php echo $resul['APELLIDOP_USU'] ?>"> </td>    
                    <td><input name="dir" type="text" value= "<?php echo $resul['DIRECCION_USU'] ?>"> </td>    
                    <td><input name="tel" type="text" value= "<?php echo $resul['TELEFONO_USU'] ?>"> </td>                    
                    <td><input name="eMail" type="text" value=  "<?php echo $resul['CORREO_USU'] ?>"> </td>  
                    <!-- <td><input name="tProf" type="text" value= "<?php echo $resul['TPROF_USU'] ?>"> </td> 
                    <td><input name="tUsu" type="text" value= "<?php echo $resul['USER_TUSU'] ?>"> </td>  -->
                    <td><input name="est" type="text" value= "<?php echo $resul['NOM_EST'] ?>"> </td>                  
                    <!-- <td><a href="?id=<?php echo $resul['ID_USU'] ?>" class="boton" onclick="window.open('update-usuario.php?id=<?php echo $resul['ID_USU'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update</a></td>    -->
                </tr>
                <?php
                }   
                ?>           
            </form>
        </table>
    </body>
</html>