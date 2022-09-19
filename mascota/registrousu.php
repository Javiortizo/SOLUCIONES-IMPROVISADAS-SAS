<?php
  
  require_once("db/connection.php");

?>


<?php
    $control = "SELECT * From tipousuario WHERE ID_TUSU = 3";
    $query=mysqli_query($mysqli,$control);
    $fila=mysqli_fetch_assoc($query);
    //var_dump($fila);

    $control2 = "SELECT * From estados WHERE ID_EST < 3";
    $query2=mysqli_query($mysqli,$control2);
    $col=mysqli_fetch_assoc($query2);
    //var_dump($col);
?>



<?php
    if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
    {
        $cedula=    $_POST['doc'];
        $nombre=    $_POST['nom'];
        $apellido=    $_POST['ape'];
        $direccion=    $_POST['dir'];
        $telefono=    $_POST['tel'];
        $correo=    $_POST['mail'];
        $usuario=   $_POST['user'];
        $clave=     $_POST['pass'];
        $idusu=     $_POST['idusu'];
        $idest=    $_POST['estusu'];

        $validar ="SELECT * FROM usuario WHERE IDENT_USU='$cedula' and ID_TUSU='$idusu'";
        $queryi=mysqli_query($mysqli,$validar);
        $fila1=mysqli_fetch_assoc($queryi);
    
       if ($fila1) {
           echo '<script>alert ("DOCUMENTO O TIPO DE USUARIO EXISTEN //CAMBIELOS//");</script>';
           echo '<script>windows.location="registrousu.php"</script>';
       }
        else if ($cedula=="" || $nombre=="" || $apellido=="" || $direccion=="" || $telefono=="" || $correo==""
        || $usuario=="" || $clave=="" || $idusu=="" || $idest=="")
        {
            echo '<script>alert ("Existen datos vacios para el registro.");</script>';
           echo '<script>windows.location="registrousu.php"</script>';
        }

        else
        {

           //$insertsql="INSERT INTO usuario(cedula,nombres,user,password,id_tip_user) VALUES('$cedula','$nombre','$usuario','$clave','$idusu')";
           //INSERT INTO `usuario`(`ID_TUSU`, `ID_EST`, `IDENT_USU`, `PNOMBRE_USU`, `APELLIDOP_USU`, `DIRECCION_USU`, `TELEFONO_USU`, `CORREO_USU`, `PASSWD_USU`, `ALIAS_USU`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]')
           $insertsql="INSERT INTO usuario(ID_TUSU, ID_EST, IDENT_USU, PNOMBRE_USU, APELLIDOP_USU, DIRECCION_USU, 
           TELEFONO_USU, CORREO_USU, PASSWD_USU, ALIAS_USU) 
           VALUES ('$idusu','$idest','$cedula','$nombre','$apellido',
           '$direccion','$telefono','$correo','$clave','$usuario')";


           mysqli_query($mysqli,$insertsql) or die(mysqli_error());
           echo '<script>alert (" Registro Exitoso, Gracias");</script>';
           echo '<script>window.location="index.html"</script>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="controller/css/stilo1.css">
    <title>Registrar</title>
</head>
<body>
    <div class="login-box">
        <img src="controller/image/logo1.png" class="avatar" alt="Imagen Avar">
               
        <form method="POST" name="formreg" autocomplete="off">
            <label for="usuario"> REGISTRO DE USUARIOS </label> 
            <input type="text" name="doc" placeholder="Ingrese Documento Identidad" >
            <input type="text" name="nom" placeholder="Ingrese Nombre" >
            <input type="text" name="ape" placeholder="Ingrese Apellido" >
            <input type="text" name="dir" placeholder="Ingrese Direccion" >
            <input type="text" name="tel" placeholder="Ingrese Telefono" >
            <input type="email" name="mail" placeholder="Ingrese Correo" >
            <input type="text" name="user" placeholder="Ingrese un Usuario" >
            <input type="password" name="pass" placeholder="Ingrese Contraseña" >
            
            <!--select tipo usuario-->
            <select name="idusu">
                <option value="">Seleccione tipo usuario...</option>
               
               
               <?php
                   do {
                
                ?>
                    <option value="<?php echo($fila['ID_TUSU'])?>"> <?php echo($fila['USER_TUSU'])?>

               <?php   
                   }while($fila=mysqli_fetch_assoc($query));
               
               ?>
            </select>

            <!--select estado usuario-->
            <select name="estusu">
                <option value="">Seleccione estado...</option>
               
               
               <?php
                   do {
                
                ?>
                    <option value="<?php echo($col['ID_EST'])?>"> <?php echo($col['NOM_EST'])?>

               <?php   
                   }while($col=mysqli_fetch_assoc($query2));
               
               ?>
            </select>

            <label for="usuario">&nbsp;</label>
            <input type="submit" name="validar" value="Registrarme">
            <input type="hidden" name="MM_insert" value="formreg">
        </form>


    
    </div>
</body>
</html>