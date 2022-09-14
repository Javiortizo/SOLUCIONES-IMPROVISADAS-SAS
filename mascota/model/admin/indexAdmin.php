
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
            <h1>GESTION DE USUARIO  <?php echo $usua['USER_TUSU']?></h1>
        </section>
    
        <nav class="navegacion">
           
            <ul class="menu wrapper" >
    
                <li class="first-item">
                    <a href="agregar-usu.php">
                        <img src="img/analisis.png" alt="" class="imagen">
                        <span class="text-item">AGREGAR TIPOS DE USUARIO</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="img/ejecucion.png" alt="" class="imagen">
                        <span class="text-item">CONSULTAR/MODIFICAR USUARIOS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="img/implementar.jpg" alt="" class="imagen">
                        <span class="text-item">CONSULTAR/MODIFICAR MASCOTAS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="img/planear.png" alt="" class="imagen">
                        <span class="text-item">CONSULTAR/MODIFICAR VISITAS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">CONSULTAR/MODIFICAR RECETAS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li class="first-item">
                    <a href="#">
                        <img src="img/analisis.png" alt="" class="imagen">
                        <span class="text-item">AGREGAR ESTADOS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">CONSULTAR/MODIFICAR MEDICAMENTOS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">CONSULTAR/MODIFICAR TIPO MASCOTA</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">ACTIVAR/DESACTIVAR USUARIO</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">OPCION 10</span>
                        <span class="down-item"></span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">OPCION 11</span>
                        <span class="down-item"></span>
                    </a>
                </li>
                
            </ul>
            
        </nav>
    </body>
</html>