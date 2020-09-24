<?php
  session_start();
  if(isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] == 1) //isset comprueba si la variable existe(si la sesión de un usuario ya está abierta)
    header('location: admin/index.php'); //redirecciona a una página
  if(isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] == 2)
    header('location: asesor/index.php'); //redirecciona a una página
  if(isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] == 3)
    header('location: user/index.php'); //redirecciona a una página
?>
<!DOCTYPE html> <!--HTML 5-->
<html> <!--Inicio de la página HTML-->
<head> <!--Se ponen los recursos que se utilizarán (como CSS o JS)-->
    <meta charset="UTF-8"> <!--Codificación al español-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Escala los elementos para cualquier dispositvo (celular,ordenador,etc) -->
    <title>Inicio</title> <!--Titulo de la pestaña-->
    <link rel="shortcut icon" href="images/logoRecyclus.png"> <!--icono de la pestaña-->
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.css">
    <link rel="stylesheet" href="css/animate.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/mainStyles.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script><!--Biblioteca de funciones que simplifica el usor de JS-->
    <script src="js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.js" charset="utf-8"></script>
    <script type="text/javascript" src="js/mainScript.js"></script>
</head>
<body>
  <main> <!--Usado por materialize para después implementar el footer-->
    <div class="container"> <!--Ajusta y centra los elementos de la página-->
      <center>
        <br>
        <h1 class="white-text animate__animated animate__fadeIn animate__delay-1s">Recyclus</h1>
      </center>
      <div class="row"> <!--Habilita sistema de rejilla (12 columnas) Elemento Padre / Principal-->
        <div class="card hoverable card-opacity col s12 animate__animated animate__fadeIn animate__delay-2s"> <!--Tarjeta que contiene los inputs-->
          <h3 class="center-align">Inicio de sesión</h3>
          <form method="POST" id="formLogin">
            <div class="card-content"> <!--Contenido de la tarjeta-->
              <div class="row"> <!--Habilita sistema de rejilla (12 columnas) Elementos hijo / secundarios-->
                <div class="input-field col l6 m6 s12">
                  <i class="material-icons prefix">email</i>
                  <input type="email" class="validate" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,60}" maxlength="60" required>
                  <label for="email" data-wrong="Error, email no válido" data-success="Email válido">Ingrese su email</label>
                </div>
                <div class="input-field col l6 m6 s12">
                  <i class="material-icons prefix">lock</i>
                  <input type="password" class="validate" name="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" minlength="8" maxlength="32" required>
                  <label for="password" data-success="Contraseña válida">Ingrese su contraseña</label>
                </div>
              </div>
            </div>
            <div class="card-action center-align">
              <button class="btn-flat grey-text waves-effect" type="reset" style="margin: 10px"> Limpiar Campos</button>
              <button type="submit" class="btn waves-effect waves-light blue darken-2" style="margin: 10px">Entrar
                <i class="material-icons right">send</i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <footer class="page-footer black opacity">
    <div class="container">
      <div class="row">
        <div class="col l4 m6 s12 center">
          <h5 class="white-text">Desarrollado por:</h5>
          <ul>
            <li><a class="grey-text text-lighten-3">Arellano Velásquez César Mauricio</a></li>
            <li><a class="grey-text text-lighten-3">Flores Poblete Daniela Alejandra</a></li>
            <li><a class="grey-text text-lighten-3">Gallego-Góngora García María</a></li>
            <li><a class="grey-text text-lighten-3">García Garzón Allison Giseth</a></li>
            <li><a class="grey-text text-lighten-3">Maracoff Perez Joaquín</a></li>
          </ul>
        </div>
        <center>
          <div class="col l4 m6 s12">
            <img class="responsive-img" src="images/logoRecyclus.png" width="150px"/>
          </div>
        </center>
        <div class="col l4 m12 s12 center">
          <h5>¿No tienes cuenta?</h5>
          <button class="btn waves-effect waves-light blue darken-3" onclick="location.href='registro.php'">¡Regístrate!
            <i class="material-icons right">border_color</i>
          </button>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        © 2020 Recyclus
      </div>
    </div>
  </footer>
</body>
</html>
