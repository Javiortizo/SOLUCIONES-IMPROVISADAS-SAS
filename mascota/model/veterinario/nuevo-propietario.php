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
    $id_usu = $_POST["tipoUsu"];
    $id_doc = $_POST["docu"];
    //SELECT * FROM `usuario` WHERE `IDENT_USU` = 9999999999 and `ID_TUSU`= 1;
    //Consulta validación usuario no registrado
    $sql_val="SELECT * FROM usuario WHERE IDENT_USU = '$id_doc' and ID_TUSU = '$id_usu'";
    $tip = mysqli_query($mysqli, $sql_val);
    $row = mysqli_fetch_assoc($tip);

    if ($row){
        echo '<script>alert ("El usuario ya está registrado !!! Cambielo ");</script>';
        echo '<script>window.location = "nuevo-propietario.php"</script>';

    }

    elseif ($_POST["docu"] == "" || $_POST["pnombre"] == "" || $_POST["pape"] == "" || $_POST["direccion"] == "" || $_POST["telefono"] == "" || $_POST["email"] == "" || $_POST["passwd"] == "" || $_POST["nick"] == "" || $_POST["tipoUsu"] == "" || $_POST["estado"] == "")
    {
        echo '<script>alert ("Existen Espacios Vacios ");</script>';
        echo '<script>window.location = "nuevo-propietario.php"</script>';
    }

    else{
        $var0 =$_POST["docu"];
        $var1 =$_POST["pnombre"];
        $var2 =$_POST["snombre"];
        $var3 =$_POST["pape"];
        $var4 =$_POST["sape"];
        $var5 =$_POST["direccion"];
        $var6 =$_POST["telefono"];
        $var7 =$_POST["email"];
        $var8 =$_POST["tprof"];
        $var9 =$_POST["passwd"];
        $var10 =$_POST["nick"];
        $var11 =$_POST["tipoUsu"];
        $var12 =$_POST["estado"];

        $sql_usu = "INSERT INTO usuario(ID_TUSU, ID_EST, IDENT_USU, PNOMBRE_USU, SNOMBRE_USU, APELLIDOP_USU, APELLIDOM_USU, DIRECCION_USU, TELEFONO_USU, CORREO_USU, TPROF_USU, PASSWD_USU, ALIAS_USU) VALUES ('$var11','$var12','$var0','$var1','$var2','$var3','$var4','$var5','$var6','$var7','$var8','$var9','$var10')";
        $tip = mysqli_query($mysqli, $sql_usu);
        echo '<script>alert ("Registro de Usuario Existoso ");</script>';
        echo '<script>window.location = "nuevo-propietario.php"</script>';
    }
}
?>

<?php
// Realizamos la consulta para la tabla Tipos de Usurio
// SELECT * FROM `tipousuario`
$sql_tusu= "SELECT * FROM tipousuario WHERE ID_TUSU = 3";
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
    <link rel="stylesheet" href="estilos.css">
    <title>Vista Veterinario</title>
</head>
    <body>
        <section class="title">
            <h1>Crear Nuevo Propiertario de Mascota</h1>
        </section>
        <table border="1" class="Center">
            <form name= "frm_usu" method= "POST" autocomplete = "off">
                <tr>
                    <th colspan="2">INGRESAR DATOS DEL PROPIETARIO</th>
                </tr>                           
                <tr>
                    <th> Documento Identificación</th>                  
                    <th> <input type= "number" name= "docu" placeholder = "Ingresar Documento Usuario"></th>
                </tr> 
                <tr>
                    <th> Primer Nombre</th>                  
                    <th><input type= "text" name= "pnombre" placeholder = "Ingresar Primer Nombre Usuario"></th>
                </tr>
                <tr>
                    <th> Segundo Nombre</th>                  
                    <th><input type= "text" name= "snombre" placeholder = "Ingresar Segundo Nombre Usuario"></th>
                </tr>
                <tr>
                    <th> Primer Apellido</th>                  
                    <th><input type= "text" name= "pape" placeholder = "Ingresar Primer Apellido Usuario"></th>
                </tr>
                <tr>
                    <th> Segundo Apellido</th>                  
                    <th><input type= "text" name= "sape" placeholder = "Ingresar Segundo Apellido Usuario"></th>
                </tr>
                <tr>
                    <th> Dirección</th>                  
                    <th><input type= "text" name= "direccion" placeholder = "Ingresar Dirección Usuario"></th>
                </tr>
                <tr>
                    <th> Teléfono</th>                  
                    <th><input type= "number" name= "telefono" placeholder = "Ingresar Teléfono Usuario"></th>
                </tr>
                <tr>
                    <th> Correo Electrónico</th>                  
                    <th><input type= "email" name= "email" placeholder = "Ingresar Correo Electrónico Usuario"></th>
                </tr>
                <tr>
                    <th> Contraseña</th>                  
                    <th><input type= "password" name= "passwd" placeholder = "Ingresar Contraseña Usuario"></th>
                </tr>
                <tr>                    
                    <th> Nickname</th>                  
                    <th><input type= "text" name= "nick" placeholder = "Ingresar Nickname Usuario"></th>
                </tr>
                <tr>
                    <th>Tipo Usuario</th>
                    <th>
                        <select name="tipoUsu">
                            <option value= "<?php echo ($fila_tusu['ID_TUSU']) ?>"><?php echo ($fila_tusu['USER_TUSU']) ?></option>
                        </select>
                    </th>
                </tr>
                <tr>
                    <th> Tipo Estado</th>                                   
                    <th>
                        <select name="estado">
                                <option value= "">Seleccione Estado Usuario</option>
                                <?php
                                    // Código php ciclo
                                    do{

                                ?> 
                                <option value="<?php echo ($fila_estados['ID_EST']) ?>"><?php echo ($fila_estados['NOM_EST']) ?></option>
                                <?php } while($fila_estados=mysqli_fetch_assoc($query_estados));
                                ?>
                        </select>
                    </th>
                </tr>
                <tr>
                    <th colspan="2">&nbsp;</th>
                </tr>
                <tr>
                    <th colspan="2"><input type= "submit" value = "Guardar" name= "btn-guardar"></th>
                    <input type= "hidden" name="guardar" value="frm_usu">
            </form>
        </table>
    </body>
</html>