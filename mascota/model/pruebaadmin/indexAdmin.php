
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
            <h1>GESTION GENERAL DESDE <?php echo $usua['USER_TUSU']?></h1>
        </section>
        <section class="portafolio">
            <div class="contenedor">
                <div class="galeria-port">
                    <div class="imagen-port">
                        <img src="img/tipousuario.png" alt="">
                        <div class="hover-galeria">
                        <a href="lista-tipoUsuario.php">
                            <img src="img/david1.png" alt="">
                            <p>CRUD Tipo Usuario</p>
                        </a>                            
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/usuario.jpg" alt="">
                        <div class="hover-galeria">
                        <a href="lista-usuario.php">
                            <img src="img/david1.png" alt="">
                            <p>CRUD Usuario</p>
                        </a>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/tipomascota.jpg" alt="">
                        <div class="hover-galeria">
                        <a href="lista-tipomascota.php">
                            <img src="img/david1.png" alt="">
                            <p>CRUD Tipo De Mascota</p>
                        </a>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/mascota.png" alt="">
                        <div class="hover-galeria">
                        <a href="lista-mascota.php">
                            <img src="img/david1.png" alt="">
                            <p>CRUD Mascota</p>
                        </a>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/afiliacion.png" alt="">
                        <div class="hover-galeria">
                        <a href="lista-afiliacion.php">
                            <img src="img/david1.png" alt="">
                            <p>CRUD Afiliacion</p>
                        </a>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/estados.png" alt="">
                        <div class="hover-galeria">
                        <a href="lista-estado.php">
                            <img src="img/david1.png" alt="">
                            <p>CRUD Estado</p>
                        </a>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/visita.png" alt="">
                        <div class="hover-galeria">
                        <a href="lista-visita.php">
                            <img src="img/david1.png" alt="">
                            <p>CRUD Visita</p>
                        </a>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/medicamentos.png" alt="">
                        <div class="hover-galeria">
                        <a href="lista-medicamentos.php">    
                            <img src="img/david1.png" alt="">
                            <p>CRUD Medicamentos</p>
                        </a>
                        </div>
                    </div>
                    <div class="imagen-port">
                        <img src="img/recemedica.png" alt="">
                        <div class="hover-galeria">
                        <a href="lista-recibosmed.php">
                            <img src="img/david1.png" alt="">
                            <p>CRUD Receta Medica</p>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
        
    </body>
</html>