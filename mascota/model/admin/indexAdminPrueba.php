
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Planeta Animal SISAS</title>
    <link rel="shortcut icon" href="img/javier3.png" type="image/x-icon">
    <link rel="stylesheet" href="css/estilosPrueba.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&display=swap" rel="stylesheet">
</head>
    <body>
        <section class="title">
            <h1>GESTION DE USUARIO  <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <section class="portafolio">
            <div class="contenedor">
                <h2 class="titulo">Para que lo consientas, tenemos...</h2>
                <div class="galeria-port">
                    <div class="imagen-port">
                        <img src="img/prueba1.jpg" alt="">
                        <div class="hover-galeria">
                        <a href="agregar-tipoUsuario.php">
                            <img src="img/prueba4.png" alt="">
                            <p>Alimentos Importados</p>
                        </a>                            
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/prueba2.jpg" alt="">
                        <div class="hover-galeria">
                            <img src="img/prueba4.png" alt="">
                            <p>Diseño de Imágen</p>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/prueba3.jpg" alt="">
                        <div class="hover-galeria">
                            <img src="img/prueba4.png" alt="">
                            <p>Identificación RFID</p>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/david5.jpg" alt="">
                        <div class="hover-galeria">
                            <img src="img/david1.png" alt="">
                            <p>Jornadas de Adopción</p>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/david6.jpg" alt="">
                        <div class="hover-galeria">
                            <img src="img/david1.png" alt="">
                            <p>Estudios Especializados</p>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/david7.jpg" alt="">
                        <div class="hover-galeria">
                            <img src="img/david1.png" alt="">
                            <p>Pet Hotel</p>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/david8.jpg" alt="">
                        <div class="hover-galeria">
                            <img src="img/david1.png" alt="">
                            <p>Pet Spa</p>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/david9.jpg" alt="">
                        <div class="hover-galeria">
                            <img src="img/david1.png" alt="">
                            <p>Tienda Deportiva</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        
    </body>
</html>