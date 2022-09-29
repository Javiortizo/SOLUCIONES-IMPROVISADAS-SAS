
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
<!--<input type="submit" formaction="./indexAdmin.php" value="Regresar" /> "Se elimina botón porque no cumplia alguna acción lógica"-->
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
    <title>Administrador</title>
</head>
    <body>
        <section class="title">
            <h1>GESTIÓN MASCOTAS Y CITAS MÉDICAS desde <?php echo $usua['USER_TUSU']?></h1>
        </section>
    
        <nav class="navegacion">
           
            <ul class="menu wrapper" >
    
                <li class="first-item">                 
                    <a href="agregar-usuario.php">
                        <img src="img/usuario.jpg" alt="" class="imagen">
                        <span class="text-item">AGREGAR USUARIO</span>
                        <span class="down-item"></span>
                    </a>
                </li>
                         
                <li>
                    <a href="lista-usuario.php">
                        <img src="img/usuario.jpg" alt="" class="imagen">
                        <span class="text-item">CONSULTAR/ACTUALIZAR/ELIMINAR USUARIO</span>
                        <span class="down-item"></span>
                    </a>
                </li>

                <li>
                    <a href="agregar-tipoMascota.php">
                        <img src="img/tipomascota.jpg" alt="" class="imagen">
                        <span class="text-item">AGREGAR TIPO MASCOTA</span>
                        <span class="down-item"></span>
                    </a>
                </li>  
                
                <li class="first-item">
                    <a href="agregar-mascota.php">
                        <img src="img/mascota.png" alt="" class="imagen">
                        <span class="text-item">AGREGAR MASCOTA</span>
                        <span class="down-item"></span>
                    </a>
                </li>

                <li>
                    <a href="agregar-afiliacion.php">
                        <img src="img/afiliacion.png" alt="" class="imagen">
                        <span class="text-item">AGREGAR AFILIACIÓN</span>
                        <span class="down-item"></span>
                    </a>
                </li>

                <li class="first-item">
                    <a href="lista-tipomascota.php">
                        <img src="img/tipomascota.jpg" alt="" class="imagen">
                        <span class="text-item">CONSULTAR/ACTUALIZAR TIPO MASCOTA</span>
                        <span class="down-item"></span>
                    </a>
                </li>               

                <li>
                    <a href="lista-mascota.php">
                        <img src="img/mascota.png" alt="" class="imagen">
                        <span class="text-item">CONSULTAR MASCOTA</span>
                        <span class="down-item"></span>
                    </a>
                </li>               

                <li>
                    <a href="lista-afiliacion.php">
                        <img src="img/afiliacion.png" alt="" class="imagen">
                        <span class="text-item">CONSULTAR/ACTUALIZAR AFILIACIÓN</span>
                        <span class="down-item"></span>
                    </a>
                </li>
                
                <li class="first-item">
                    <a href="agregar-visita.php">
                        <img src="img/visita.png" alt="" class="imagen">
                        <span class="text-item">AGREGAR VISITA</span>
                        <span class="down-item"></span>
                    </a>
                </li>
               
                <li>
                    <a href="agregar-remedicamentos.php">
                        <img src="img/recemedica.png" alt="" class="imagen">
                        <span class="text-item">AGREGAR RECIBO DE MEDICAMENTOS</span>
                        <span class="down-item"></span>
                    </a>
                </li>

                <li class="first-item">
                    <a href="lista-visita.php">
                        <img src="img/visita.png" alt="" class="imagen">
                        <span class="text-item">CONSULTAR/ACTUALIZAR VISITA</span>
                        <span class="down-item"></span>
                    </a>
                </li>                

                <li>
                    <a href="lista-medicamentos.php">
                        <img src="img/medicamentos.png" alt="" class="imagen">
                        <span class="text-item">CONSULTAR MEDICAMENTOS</span>
                        <span class="down-item"></span>
                    </a>
                </li>               

                <li>
                    <a href="lista-recibosmed.php">
                        <img src="img/recemedica.png" alt="" class="imagen">
                        <span class="text-item">CONSULTAR/ACTUALIZAR RECIBO MEDICAMENTOS</span>
                        <span class="down-item"></span>
                    </a>
                </li>

            </ul>
            
        </nav>
    </body>
</html>