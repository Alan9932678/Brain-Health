<?php
    session_start();
    require 'dbconnect.php';

    if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password,name FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    
    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE  html>
<html lang="es">
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
    
        <title>Brain Health | Principal</title>
        
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="icon" type="image/png" href="brain.png">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<style>
    iframe{
        display:block;
        position:center;
        
    }
    @media only screen and (max-width: 600px) {
  #video{
      width:298;
      height:167;
  }
}
.dropdown a {
    color:#000;
    text-decoration:none;
}
</style>

    </head>
    <body>
   <?php if(!empty($user)): ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
       
        <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <span>Welcome. <?= $user['name']; ?></span>
  </button>
  <div class="dropdown-menu " style="display:center;" >
      <button class="dropdown-item" type="button"><li class="nav-item"><a class="dropdown" href="index.php">Principal</a></li></button>
 <button class="dropdown-item" type="button"><li class="nav-item"><a class="dropdown" href="chat3.php">Chat</a></li></button>
 <button class="dropdown-item" type="button"><li class="nav-item"><a class="dropdown" href="">Buscar Hospital</a></li></button>
    <button class="dropdown-item" type="button"><li class="nav-item"><a class="dropdown" href="logout.php">Cerrar Sesion</a></li></button>
    
  </div>
</div>
    </ul>
  </div>
</nav>
<style>
   #denied{
       display:none;
   }
</style>
 <audio autoplay src="mensaje.mp3" id="denied"></audio>
<div id="contenedor" class="container">
    <div id="caja-chat">
        <div id="chat">
            <?php
            $consulta="SELECT * FROM chat ORDER BY id DESC";
            
            $ejecutar=$conn->query($consulta);
            while($fila=$ejecutar->fetch(PDO::FETCH_ASSOC)):
                
                
            ?>
            <div id="datos-chat">
                <span id="user"><?php echo $fila['nombre'];?> :</span>
                <span id="msg"><?php echo $fila['mensaje'];?></span>
                <span id="time"><?php echo  formatearfecha( $fila['fecha']);?></span>
            </div>
            <?php endwhile;?>
        </div>
    </div>
    <form  method="POST" action="chat3.php">
        <input type="text" name="name" value="<?= $user['name']; ?>" readonly>
        <textarea name="mensaje" placeholder ="Ingresa el Mensaje"></textarea> 
            <input type="submit" name="enviar" value="Enviar" >
    </form>
    <?php 
    if(isset($_POST['enviar'])){
        $nombre=$_POST['name'];
        $mensaje=$_POST['mensaje'];
        $consulta="INSERT INTO chat(nombre, mensaje) VALUES('$nombre','$mensaje')";
            
            $ejecutar=$conn->query($consulta);
            if($ejecutar){
                echo "<embed loop='false' src='mensaje.mp3' hidden='true' autoplay='true'";
            }

    }
     
    ?>
</div>
    <style>
        *{
            padding:0;
            margin:0;
        }
        body{
            background-color:rgb(186, 225, 255);
        }
        #contenedor{
            width:40%;
            background-color:#fff;
            margin:0 auto;
            padding:20px;
            border-radius:12px;
            moz-border-radius:12px;
            o-border-radius:12px;
            webkit-border-radius:12px;
            overflow-y:scroll;
        }
      #caja-chat{
          width:90%;
          height:400px;
          
      }
        #datos-chat{
            width:100%;
            padding:5px;
            margin-bottom:5px;
            border-bottom:1px solid gray;
            font-weight:bold;
        
        }
        input[type='text']{
            width:100%;
            height:40px;
            border:1px solid blue;
            border-radius:5px;
            webkit-border-radius:5px;
            moz-border-radius:5px;
            o-border-radius:5px;
        }
         input[type='submit']{
            width:100%;
            height:40px;
            border:1px solid blue;
            border-radius:5px;
            webkit-border-radius:5px;
            moz-border-radius:5px;
            o-border-radius:5px;
            cursor:pointer;
        }
        textarea{
             border:1px solid blue;
            width:100%;
            height:40px;
            border-radius:5px;
            webkit-border-radius:5px;
            moz-border-radius:5px;
            o-border-radius:5px;
        }
        input, textarea{
            margin-bottom:3px;
        }
        #user{
            color:#1c62c4;
        }
        #msg{
            color:gray;
        }
        #time{
            float:right;
        }
    </style>
    <?php else: ?>
       <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item loguearse" style="display:block;">
        <a class="nav-link text-white " href="login.php">Iniciar Sesion</a>
      </li>
      <li class="nav-item loguearse" style="display:block;">
        <a class="nav-link text-white" href="signup.php" >Registrarse</a>
      </li>
    </ul>
  </div>
</nav>
      <h1 align="center">Bienvenidos a Brain Health</h1>
        <div id="central-content">
        <p>
        La ansiedad en tiempos de crisis sanitaria como la actual pandemia del covid - 19 es algo muy común en las personas, por lo que en Brain Health te ofrecemos asesoría psicológica para garantizar tu bienestar físico y emocional de manera gratuita.
        </p><br>
        <p>
    Brain Health es un sitio en donde vas a tener oportunidad de recibir orientación respecto a los síntomas de Covid -19 y técnicas para calmar a la ansiedad; Sabemos que la situación actual está afectando a miles de personas a nivel internacional, y queremos aportar nuestro granito de arena para ayudar a las personas.
        </p><br>
        <p>
    Dentro de nuestros servicios ofrecemos salas de chat, vídeos informativos, infografías, cuestionarios, gráficas estadísticas, soporte técnico en caso de necesitar ayuda, entre otras herramientas como buscar el hospital más cercano donde atiendan casos de covid - 19 o pedir ayuda en caso de tener síntomas 
    graves.
        </p><br>
        <p>
    Brain Health se preocupa por tu salud y por tu seguridad, por lo que puedes estar en calma. Tus datos personales estarán protegidos y cifrados, estamos comprometidos con proteger tu información ante cualquir ataque a nuestros sistemas.
        </p><br>
        <p>
            Este sitio web es un proyecto final escolar para la materia de Trazabilidad y Configuración del Software impartida en formato online por la Universidad Tecnológica de México UNITEC.
        </p><br>
        <p>Los integrantes del equipo somos :</p><br>
        <p>Ochoa Guerrero Bruno Domauri</p><br>
        <p>Pérez Pérez Alain Geourshoua</p><br>
        <p>Rangel Mercado Alan Eduardo</p><br>
        <p>Rodríguez Abríz Evelyn Astrid</p><br>
        <p>A continuación del dejamos un vídeo sobre Brain Health :</p>
                    <br><br>
                    <div class="embed-responsive embed-responsive-16by9">
 <iframe id="video" src="https://www.youtube.com/embed/q7fdNNI4IyI?rel=0" frameborder="3" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                      </div>
    </div>
  </div><br><br<
    <?php endif; ?>
  </body>
</html>
    </body>
</html>
