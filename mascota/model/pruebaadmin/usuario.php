
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);

?>

<?php
if ((isset($_POST["guardar"]))&&($_POST["guardar"]=="frmusu"))
{
    $id_usu=$_POST["tipousu"];
    $id_doc=$_POST["docu"];
    //SELECT * FROM `usuario` WHERE `IDENT_USU` = 9999999999 AND `ID_TUSU` = 1;
    //Consulta validación usuario no registrado
    $sql_val="SELECT * FROM usuario WHERE IDENT_USU = '$id_doc' AND ID_TUSU = '$id_usu'";
    //$sql_usu="SELECT * FROM tipousuario WHERE user_tusu = '$tip_usu'";
    $tip = mysqli_query($mysqli, $sql_val);
    $row = mysqli_fetch_assoc($tip);

    if ($row){
        echo '<script>alert ("El usuario ya está registrado como admin");</script>';
        echo '<script>window.location="usuario.php"</script>';
    }
   
    elseif ($_POST["docu"] == "" || $_POST["pnombre"] == "" || $_POST["snombre"] == "" || $_POST["pape"] == ""
    || $_POST["sape"] == "" || $_POST["direccion"] == "" || $_POST["mail"] == "" || $_POST["telefono"] == ""
    || $_POST["tprof"] == "" || $_POST["nick"] == "" || $_POST["passwd"] == "" || $_POST["tipousu"] == ""
    || $_POST["idest"] == ""){
        echo '<script>alert ("Existen datos vacios");</script>';
        echo '<script>window.location="usuario.php"</script>';
    }


    else{
        //Asignación variables desde formulario
        $var0 =$_POST["docu"]; 
        $var1 =$_POST["pnombre"];
        $var2 =$_POST["snombre"]; 
        $var3 =$_POST["pape"];
        $var4 =$_POST["sape"]; 
        $var5 =$_POST["direccion"]; 
        $var6 =$_POST["mail"]; 
        $var7 =$_POST["telefono"];
        $var8 =$_POST["tprof"]; 
        $var9 =$_POST["nick"]; 
        $var10 =$_POST["passwd"]; 
        $var11 =$_POST["tipousu"];
        $var12 =$_POST["idest"];

        $sql_usu="INSERT INTO usuario (ID_TUSU, ID_EST, IDENT_USU, PNOMBRE_USU, SNOMBRE_USU, APELLIDOP_USU, 
        APELLIDOM_USU, DIRECCION_USU, TELEFONO_USU, CORREO_USU, TPROF_USU, PASSWD_USU, ALIAS_USU) 
        values('$var11','$var12','$var0','$var1','$var2','$var3','$var4','$var5','$var7','$var6','$var8','$var10','$var9') ";
        
        $tip = mysqli_query($mysqli, $sql_usu);
        echo '<script>alert ("Registro Ingresado Exitosamente");</script>';
        echo '<script>window.location="usuario.php"</script>';
    
    }


}
?>

<?php
    //Realizamos consulta de tabla tipos de usuarios
    //SELECT * FROM `tipousuario`
    $sql_tusu=" SELECT * FROM tipousuario";
    $query_tusu=mysqli_query($mysqli, $sql_tusu);
    $fila=mysqli_fetch_assoc($query_tusu);

    //Realizamos consulta de tabla estados
    //SELECT * FROM `estados`
    $sql_est="SELECT * FROM estados where ID_EST < 3 ";
    $query_est=mysqli_query($mysqli, $sql_est);
    $fila_est=mysqli_fetch_assoc($query_est);
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
            <h1>FORMULARIO AGREGAR USUARIOS DESDE <?php echo $usua['USER_TUSU']?></h1>
        </section>
    <table border="1" class="center">
        <form name="frmusu" method="POST" autocomplete="off">
            <tr>
                <th colspan="2">CREAR USUARIOS</th>
            </tr>


            <tr>
                <th>Documento Ident Usuario</th>
                <th><input type="number" name="docu" placeholder="Ingrese documento usuario"></th>
            </tr>
            
            <tr>
                <th>Primer Nombre Usuario</th>
                <th><input type="text" name="pnombre" placeholder="Ingresar primer nombre" ></th>               
            </tr>

            <tr>
                <th>Segundo Nombre Usuario</th>
                <th><input type="text" name="snombre" placeholder="Ingresar segundo nombre" ></th>               
            </tr>

            <tr>
                <th>Primer Apellido Usuario</th>
                <th><input type="text" name="pape" placeholder="Ingresar primer apellido" ></th>               
            </tr>

            <tr>
                <th>Segundo Apellido Usuario</th>
                <th><input type="text" name="sape" placeholder="Ingresar segundo apellido" ></th>               
            </tr>
            
            <tr>
                <th>Direccion Usuario</th>
                <th><input type="text" name="direccion" placeholder="Ingresar direccion usuario" ></th>               
            </tr>

            <tr>
                <th>Correo Usuario</th>
                <th><input type="email" name="mail" placeholder="Ingresar correo usuario" ></th>               
            </tr>

            <tr>
                <th>Telefono Usuario</th>
                <th><input type="number" name="telefono" placeholder="Ingresar telefono usuario" ></th>               
            </tr>

            <tr>
                <th>TProfesional Usuario</th>
                <th><input type="number" name="tprof" placeholder="Ingresar tarjeta profesional usuario" ></th>               
            </tr>

            <tr>
                <th>Defina nickname Usuario</th>
                <th><input type="text" name="nick" placeholder="Ingresar nickname usuario" ></th>               
            </tr>
            
            <tr>
                <th>Contraseña Usuario</th>
                <th><input type="password" name="passwd" placeholder="Ingresar contraseña usuario" ></th>               
            </tr>

            <tr>
                <th>Tipo Usuario</th>
                <th>
                    <select name="tipousu" >
                        <option value="">Seleccione Tipo de Usuario</option>
                            <?php
                                //Codigo php ciclo
                                do{

                            ?>
                            <option value="<?php echo ($fila['ID_TUSU']) ?>"><?php echo ($fila['USER_TUSU']) ?></option>
                            <?php    } while($fila=mysqli_fetch_assoc($query_tusu));
                            ?>

                    </select>
                </th>
            </tr>

            <tr>
                <th>Estado Usuario</th>
                <th>
                    <select name="idest" >
                        <option value="">Seleccione Estado Usuario</option>
                            <?php
                                //Codigo php ciclo
                                do{

                            ?>
                            <option value="<?php echo ($fila_est['ID_EST']) ?>"><?php echo ($fila_est['NOM_EST']) ?></option>
                            <?php    } while($fila_est=mysqli_fetch_assoc($query_est));
                            ?>

                    </select>
                </th>
            </tr>

            <tr>
                <th colspan="2">&nbsp;</th>             
            </tr>
            
            <tr>
                <th colspan="2"><input type="submit" value="Guardar" name="btnguardar"></th>
                <input type="hidden" name="guardar" value="frmusu">                 
            </tr>

            <tr>
                <th colspan="2"><button type="submit" value="Eliminar" name="btnsalir">Eliminar</button></th>
                <input type="hidden" name="eliminar" value="frmusu">                 
            </tr>

        </form>
    </table>
    </body>
</html>