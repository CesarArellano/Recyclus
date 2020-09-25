<?php
  require '../config.php';
  if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] == 1) //isset comprueba si la variable no existe
  {
    header('location: ../index.php'); //header redirecciona a una página (no deja entrar a la página)
  }
?>

<!DOCTYPE html> <!--HTML 5-->
<html> <!--Inicio de la página HTML-->
<head> <!--Se ponen los recursos que se utilizarán (como CSS o JS)-->
  <meta charset="UTF-8"> <!--Codificación al español-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Escala los elementos para cualquier dispositvo (celular,ordenador,etc) -->
  <title>Sistema Recompensas</title> <!--Titulo de la pestaña-->
  <link rel="shortcut icon" href="../images/logoRecyclus.png"> <!--icono de la pestaña-->
  <link rel="stylesheet" href="../css/userStyles.css">
  <link rel="stylesheet" href="../css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script><!--Biblioteca de funciones que simplifica el usor de JS-->
  <script src="../js/materialize.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.js" charset="utf-8"></script>
</head>
<body>
  <nav>
    <div class="nav-wrapper green darken-2">
      <img class="brand-logo center logoEncabezado" src="../images/logoRecyclus.png"/>
      <a href="#" data-activates="movil" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="left hide-on-med-and-down">
        <li><a href="index.php">Menú principal</a></li>
      </ul>
      <ul class="side-nav" id="movil">
        <li><a href="index.php">Menú principal</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <h1>Sistema de recompensas</h1>
    <div id="puntos"></div>
    <div id="contenidoRecompensas"></div>
  </div>
  <script src="../js/puntosScript.js"></script>
</body>
</html>
