<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$tipo_usuario = mysqli_fetch_assoc($usuarios);

?>

<?php
if ((isset($_POST["guardar"]))&&($_POST["guardar"]=="frm_mascota"))
{
  
    try{
        
    $id_mas= $_POST["Nombre_mascota"];
    $id_usu = $_POST["ID_USU"];
    //SELECT * FROM `mascota` where NOM_MAS='Bambi' and ID_USU = 11;
    //Consulta validación usuario no registrado
    $sql_val="SELECT * FROM MASCOTA WHERE NOM_MAS = '$id_mas' and ID_USU = '$id_usu'";
    $tip = mysqli_query($mysqli, $sql_val);
    $row = mysqli_fetch_assoc($tip);

    if ($row){
        echo '<script>alert ("Esta mascota ya había sido registrada a este usuario !!! Por favor Cambiela ");</script>';
        echo '<script>window.location = "agregar-usuario.php"</script>';

    }
        elseif ($_POST["ID_USU"] == "" || $_POST["tipo_mascota"] == "" || $_POST["Nombre_mascota"] == "" || $_POST["color"] == ""
        || $_POST["raza"] == "" || $_POST["tipo_afiliacion"] == ""){
            echo '<script>alert ("Existen datos vacios");</script>';
            echo '<script>window.location="agregar-mascota.php"</script>';
        } else{
            //Asignación variables desde formulario
            $var0 =$_POST["ID_USU"]; 
            $var1 =$_POST["tipo_mascota"];
            $var2 =$_POST["Nombre_mascota"]; 
            $var3 =$_POST["color"];
            $var4 =$_POST["raza"]; 
            $var5 =$_POST["tipo_afiliacion"]; 
    
            $sql_mascota="INSERT INTO mascota (ID_USU, ID_TMAS, NOM_MAS, COLOR_MAS, RAZA_MAS, AFIL_MAS) 
            values('$var0','$var1','$var2','$var3','$var4','$var5') ";
            
            $guardar_mascota = mysqli_query($mysqli, $sql_mascota);
            echo '<script>alert ("Registro Ingresado Exitosamente");</script>';
            echo '<script>window.location="agregar-mascota.php"</script>';
        
        }
    } catch (Exception $e) {
        echo '<script>alert ("El Id usuario ingresado no existe ", );</script>';
    }

}
?>

<?php
    //Realizamos consulta de tabla tipos de mascota
    //SELECT * FROM `tipomascota`
    $sql_tipo_mascota ="SELECT * FROM tipomascota";
    $query_tipo_mascota = mysqli_query($mysqli, $sql_tipo_mascota);
    $fila_tipo_mascota = mysqli_fetch_assoc($query_tipo_mascota); 

    //Realizamos consulta de tabla usuario
    //SELECT * FROM `tipousuario`
    $sql_usu ="SELECT ID_USU, PNOMBRE_USU, APELLIDOP_USU, IDENT_USU FROM usuario WHERE ID_TUSU =3";
    $query_usu = mysqli_query($mysqli, $sql_usu);
    $fila_usu = mysqli_fetch_assoc($query_usu);
?>

<form method="POST">

    <tr>
        <td colspan='2' align="center"><?php echo $tipo_usuario['PNOMBRE_USU']?></td>
    </tr>
<tr><br>
    <td colspan='2' align="center">
    
    
        <input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
        <!-- <input type="submit" formaction="../index.php" value="Regresar" /> -->
        <input type="submit" formaction="indexAdmin.php" value="Regresar" />
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
    <title>Agregar Mascota</title>
</head>
    <body>
        <section class="title">
            <h1> Agregar Mascota Desde <?php echo $tipo_usuario['USER_TUSU']?></h1>
        </section>
    <table border="1" class="center">
        <form name="frm_mascota" method="POST" autocomplete="off">
            <tr>
                <th colspan="2">CREAR MASCOTA</th>
            </tr>

            <tr>
                <th>Asociar Dueño</th>
                <th>
                    <select name="ID_USU" >
                        <option value="">Seleccione Dueño de Mascota</option>
                            <?php
                                //Codigo php ciclo
                                do{

                            ?>
                            <option value="<?php echo ($fila_usu['ID_USU']) ?>"><?php echo ($fila_usu['PNOMBRE_USU']. " ".$fila_usu['APELLIDOP_USU']." CC".$fila_usu['IDENT_USU']) ?></option>
                            <?php    } while($fila_usu = mysqli_fetch_assoc($query_usu));
                            ?>

                    </select>
                </th>               
            </tr>

            <tr>
                <th>Tipo Mascota</th>
                <th>
                    <select name="tipo_mascota" >
                        <option value="">Seleccione Tipo de Mascota</option>
                            <?php
                                //Codigo php ciclo
                                do{

                            ?>
                            <option value="<?php echo ($fila_tipo_mascota['ID_TMAS']) ?>"><?php echo ($fila_tipo_mascota['TIPO_TMAS']) ?></option>
                            <?php    } while($fila_tipo_mascota = mysqli_fetch_assoc($query_tipo_mascota));
                            ?>

                    </select>
                </th>
            </tr>

            <tr>
                <th>Nombre Mascota</th>
                <th><input type="text" name="Nombre_mascota" placeholder="Ingresar Nombre de la Mascota" ></th>               
            </tr>

            <tr>
                <th>Color</th>
                <th><input type="text" name="color" placeholder="Ingresar Color Mascota" ></th>               
            </tr>

            <tr>
                <th>Raza</th>
                <th><input type="text" name="raza" placeholder="Ingresar Raza Macota" ></th>               
            </tr>
            
            <tr>
                <th>Mascota afiliada?</th>
                <th><select name="tipo_afiliacion"><option value="0">No</option><option value="1">Si</option></select></th>               
            </tr>

            <tr>
                <th colspan="2">&nbsp;</th>             
            </tr>
            
            <tr>
                <th colspan="2"><input type="submit" value="Guardar" name="btnguardar"></th>
                <input type="hidden" name="guardar" value="frm_mascota">                 
            </tr>

            <!-- <tr>
                <th colspan="2"><button type="submit" value="Eliminar" name="btnsalir">Eliminar</button></th>
                <input type="hidden" name="eliminar" value="frm_mascota">                 
            </tr> -->

        </form>
    </table>
    </body>
</html>