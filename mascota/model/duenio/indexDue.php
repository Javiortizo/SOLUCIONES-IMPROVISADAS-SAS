<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipousuario WHERE alias_usu = '".$_SESSION['usuario']."' AND usuario.id_tusu = tipousuario.id_tusu";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
?>

<form method="POST">
    <tr> <td colspan='2' align="center">Bienvenid@ <?php echo $usua['PNOMBRE_USU']?></td></tr>
    <tr><br>
    <td colspan='2' align="center">
        <input class="usuariosButton guardarForm" type="submit" value="Cerrar sesión" name="btncerrar"/></td>
        <!-- <input class="usuariosButton guardarForm" type="submit" formaction="./indexAdmin.php" value="Regresar" /> -->
    </tr>
    </form>

<?php 
if(isset($_POST['btncerrar'])){
	session_destroy();   
    header('location: ../../index.html');
}	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion Dueño</title>
    <link rel="shortcut icon" href="img/javier3.png" type="image/x-icon">
    <link rel="stylesheet" href="css/estilosPrueba.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&display=swap" rel="stylesheet">
</head>
    <body>
        <section class="titulo">
            <h1>GESTION DESDE <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <section class="portafolio">
            <div class="contenedor">
                <div class="galeria-port">

                    <div class="imagen-port">
                        <img src="img/usuario.jpg" alt="">
                        <div class="hover-galeria">
                        <a href="lista-usuario.php">
                            <img src="img/david1.png" alt="">
                            <p>Actualiar Datos Usuario</p>
                        </a>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/mascota.png" alt="">
                        <div class="hover-galeria">
                        <a href="lista-mascota.php">
                            <img src="img/david1.png" alt="">
                            <p>Consultar mis Mascotas</p>
                        </a>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/visita.png" alt="">
                        <div class="hover-galeria">
                        <a href="lista-visita.php">
                            <img src="img/david1.png" alt="">
                            <p>Visitas</p>
                        </a>
                        </div>
                    </div>
                    <!-- <div class="imagen-port">
                        <img src="img/recemedica.png" alt="">
                        <div class="hover-galeria">
                        <a href="lista-recibosmed.php">
                            <img src="img/david1.png" alt="">
                            <p>CRUD Receta Medica</p>
                        </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
    
        
    </body>
</html>