<?php
  require '../config.php';
  /*if(!isset($_SESSION['tipoUsuario']) || $_SESSION['tipoUsuario'] == 1 || $_SESSION['tipoUsuario'] == 2) //isset comprueba si la variable no existe
  {
    header('location: ../index.php'); //header redirecciona a una página (no deja entrar a la página)
  }
  //Obtener datos del cliente
  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("SELECT nombreUsuario,apPaternoUsuario,apMaternoUsuario,telefono, email,fotoPerfil FROM usuarios WHERE idUsuario = ?");
  $sentencia->bind_param('s',$_SESSION['idUsuario']);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  $sentencia->close();
  $campos = $resultado->fetch_assoc();
  if($campos['fotoPerfil'] == NULL)
    $rutaFoto = '../images/avatar.png';
  else
    $rutaFoto = "../images/".$campos['fotoPerfil'];*/
?>
<!DOCTYPE html> <!--HTML 5-->
<html> <!--Inicio de la página HTML-->
<head> <!--Se ponen los recursos que se utilizarán (como CSS o JS)-->
  <meta charset="UTF-8"> <!--Codificación al español-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Escala los elementos para cualquier dispositvo (celular,ordenador,etc) -->
  <title>Inicio</title> <!--Titulo de la pestaña-->
  <link rel="shortcut icon" href="../images/logoRecyclus.png"> <!--icono de la pestaña-->
  <link rel="stylesheet" href="../css/userStyles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script><!--Biblioteca de funciones que simplifica el usor de JS-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.js" charset="utf-8"></script>
  <script type="text/javascript" src="../js/userScript.js"></script>
</head>
<body>
  <nav class="nav-extended green darken-2 center">
    <div class="nav-wrapper">
      <a class="brand-logo center flow-text">Recyclus</a>
      <a href="#" data-activates="movil" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a class="tooltipped" data-position="right" data-tooltip="" href="puntos.php" id="puntos">Puntos<i class="material-icons right">confirmation_number</i></a></li>
        <span id="textoNumProductosCarrito"></span>
      </ul>
      <ul class="side-nav" id="movil">
        <li><a href="carrito.php" id="carrito2">Carrito<i class="material-icons right">add_shopping_cart</i></a></li>
      </ul>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent">
        <li class="tab"><a class="active" href="#inicio">Inicio</a></li>
        <li class="tab"><a href="#contribuciones">Mis contribuciones</a></li>
        <li class="tab"><a href="#notificaciones">Notificaciones</a></li>
        <li class="tab"><a href="#cuenta">Mi cuenta</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div id="inicio" class="col s12">
      <h2>Inicio</h2>
      <h3 class="center-align">¿Qué quieres reciclar hoy?</h3>
      <br>
      <div class="row">
        <div class="col l4 m4 s12">
          <div class="card hoverable">
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="https://cdn.pixabay.com/photo/2017/08/10/03/48/nexus-2617873_1280.jpg" style='width: 100%; height: 200px; object-fit: cover;'>
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">Desecho electrónico<i class="material-icons right">more_vert</i></span>
              <p><a href="#">Presiona aquí</a></p>
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>Información</span>
              <p>Ganas más puntos según gama, marca y tiempo de uso de tu dispositivo.</p>
            </div>
          </div>
        </div>
        <div class="col l4 m4 s12">
          <div class="card hoverable">
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="https://fotografias-compromiso.atresmedia.com/clipping/cmsimages01/2017/01/05/53F06CDA-E08D-4829-A43E-098656466EED/58.jpg" style='width: 100%; height: 200px; object-fit: cover;'>
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">Desecho Orgánico<i class="material-icons right">more_vert</i></span>
              <p><a href="#">Presiona aquí</a></p>
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>Información</span>
              <p>Serán medidos por kilogramo, y dependiendo del peso, más puntos.</p>
            </div>
          </div>
        </div>
        <div class="col l4 m4 s12">
          <div class="card hoverable">
            <div class="card-image waves-effect waves-block waves-light">
              <img class="activator" src="https://www.ecoticias.com/userfiles/extra/WZZS_200_.jpg" style='width: 100%; height: 200px; object-fit: cover;'>
            </div>
            <div class="card-content">
              <span class="card-title activator grey-text text-darken-4">Desecho Inórganico<i class="material-icons right">more_vert</i></span>
              <p><a href="#">Presiona aquí</a></p>
            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i>Información</span>
              <p>A los desechos plásticos, de papel/cartón, y vidrio, separados por tipo y vendidos por cantidad.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="contribuciones" class="col s12">
      <h2>Contribuciones</h2>
      <div id="catologoCompras"></div>
    </div>
    <div id="notificaciones" class="col s12">
      <h2>Notificaciones</h2>
    </div>
    <div id="cuenta" class="col s12">
      <h2>Mi cuenta</h2>
      <br>
      <div class="row">
        <div class="col l6 m12 s12">
          <center>
            <img src="<?php echo $rutaFoto; ?>" height="150px">
            <h3><?php echo $campos['nombreUsuario']." ".$campos['apPaternoUsuario']; ?></h3>
            <a href="../logOut.php" class="waves-effect waves-light btn red"><i class="material-icons left">exit_to_app</i>Cerrar sesión</a>
          </center>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
