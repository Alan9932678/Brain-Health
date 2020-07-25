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
<h1 align="center">Brain Health</h1>
      <div id="central-content">
          <p><?= $user['name']; ?> <span>, ahora que ya eres parte de Brain Health, accediste a muchas herramientas que te ayudarán en esta emergencia sanitaria. en esta página vas a poder accedor las veces que desees, lo más importante es que estés bien y que no tengas que estar pasando emociones desagradables a causa de  la cuarentena.</span><br>
          <span>Como anteriormente lo mencionamos, tienes acceso a infografías, vídeos, cuestionarios, salas de chat y buscar el hospital más cercano.</span><br></p><br>
      </div>
      
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