<?php
  require '../config.php';
  if(!isset($_SESSION['idUsuario']) || $_SESSION['tipoUsuario'] == 2) //isset comprueba si la variable no existe
  {
    header('location: ../index.php'); //header redirecciona a una página (no deja entrar a la página)
  }
  $tipoContribucion = $_GET['tipo'];
  $idContribucion = $_GET['idC'];
  $datosContribucion = "";

  if($tipoContribucion == 1){
    $sentencia = $conexionMySQL->stmt_init();
    $sentencia->prepare("SELECT idUsuario,nombreUsuario,apPaternoUsuario,apMaternoUsuario, email, telefonoUsuario, puntoReciclaje,tipoProducto,nombreProducto,marcaProducto,descripcionProducto,gamaProducto,tiempoUsoProducto FROM contribucionesTecnologicas INNER JOIN usuarios USING(idUsuario) WHERE idContribucionT = ? AND estadoContribucion = 0");
    $sentencia->bind_param('s',$idContribucion);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    $sentencia->close();
    if($resultado->num_rows > 0){
      $campos = $resultado->fetch_assoc();
      $datosContribucion .= "<h4 class='center-align'>Datos de la contribución tecnológica</h4><p class='flow-text center-align'><span>Nombre usuario: ".$campos['nombreUsuario']." ".$campos['apPaternoUsuario']." ".$campos['apMaternoUsuario']."</span></p>
        <p class='flow-text center-align'><span>Email: ".$campos['email'].", Teléfono: ".$campos['telefonoUsuario']."</span></p>
        <p class='flow-text center-align'><span>Punto de reciclaje solicitado: ".$campos['puntoReciclaje'].", Tipo de producto: ".$campos['tipoProducto']."</span></p>
        <p class='flow-text center-align'><span>Nombre del producto: ".$campos['nombreProducto'].", Marca del producto: ".$campos['marcaProducto']."</span></p>
        <p class='flow-text center-align'><span>Descripción: ".$campos['descripcionProducto']."</p>
        <p class='flow-text center-align'><span>Gama de producto: ".$campos['gamaProducto'].", Tiempo de uso: ".$campos['tiempoUsoProducto']."año(s)</p>
        <form id='formAprobar'>
        <div class='card-content'>
          <div class='row'>
          <div class='input-field col l12 m12 s12'>
            <i class='material-icons prefix'>speaker_notes</i>
            <textarea name='contenidoNotificacion' class='materialize-textarea validate' pattern='[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð0-9 ]{2,50}'  maxlength='300' data-length='300' required></textarea>
            <label for='contenidoNotificacion'>Mensaje de coordinación de entrega</label>
          </div>
          <input type='hidden' name='idContribucion' value='".$idContribucion."'>
          <input type='hidden' name='tipoContribucion' value='".$tipoContribucion."'>
          <input type='hidden' name='idUsuario' value='".$campos['idUsuario']."'>
          </div>
        </div>
        <div class='card-action center-align'>
          <button class='btn-flat grey-text waves-effect' type='reset' style='margin: 10px'> Limpiar Campos</button>
          <button type='submit' class='btn waves-effect waves-light blue darken-2' style='margin: 10px'>Confirmar Cita
            <i class='material-icons right'>send</i>
          </button>
        </div>
        </form>";
    }
    else{
      $datosContribucion .= "<h4 class='flow-text center-align'>Esta solicitud ya está aprobada</h4>";
    }
  }
  elseif($tipoContribucion == 2){
    $sentencia = $conexionMySQL->stmt_init();
    $sentencia->prepare("SELECT idUsuario,nombreUsuario,apPaternoUsuario,apMaternoUsuario, email, telefonoUsuario, puntoReciclaje,tipoDesecho,tipoProducto,peso FROM contribucionesDesechos INNER JOIN usuarios USING(idUsuario) WHERE idContribucionD = ? AND estadoContribucion = 0");
    $sentencia->bind_param('s',$idContribucion);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    $sentencia->close();
    if($resultado->num_rows > 0){
      $campos = $resultado->fetch_assoc();
      $datosContribucion .= "<h4 class='center-align'>Datos de la contribución desechos</h4><p class='flow-text center-align'><span>Nombre usuario: ".$campos['nombreUsuario']." ".$campos['apPaternoUsuario']." ".$campos['apMaternoUsuario']."</span></p>
        <p class='flow-text center-align'><span>Email: ".$campos['email'].", Teléfono: ".$campos['telefonoUsuario']."</span></p>
        <p class='flow-text center-align'><span>Punto de reciclaje solicitado: ".$campos['puntoReciclaje'].", Tipo de desecho: ".$campos['tipoDesecho']."</span></p>
        <p class='flow-text center-align'><span>Tipo de producto: ".$campos['tipoProducto'].", Peso a entrefar: ".$campos['peso']." KG</span></p>
        <form id='formAprobar'>
        <div class='card-content'>
          <div class='row'>
          <div class='input-field col l12 m12 s12'>
            <i class='material-icons prefix'>speaker_notes</i>
            <textarea name='contenidoNotificacion' class='materialize-textarea validate' pattern='[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð0-9 ]{2,50}'  maxlength='300' data-length='300' required></textarea>
            <label for='contenidoNotificacion'>Mensaje de coordinación de entrega</label>
          </div>
          <input type='hidden' name='idContribucion' value='".$idContribucion."'>
          <input type='hidden' name='tipoContribucion' value='".$tipoContribucion."'>
          <input type='hidden' name='idUsuario' value='".$campos['idUsuario']."'>
          </div>
        </div>
        <div class='card-action center-align'>
          <button class='btn-flat grey-text waves-effect' type='reset' style='margin: 10px'> Limpiar Campos</button>
          <button type='submit' class='btn waves-effect waves-light blue darken-2' style='margin: 10px'>Confirmar Cita
            <i class='material-icons right'>send</i>
          </button>
        </div>
        </form>";
    }
    else{
      $datosContribucion .= "<h4 class='flow-text center-align'>Esta solicitud ya está aprobada</h4>";
    }
  }
  else{
    $datosContribucion .= "<h4 class='flow-text center-align'>No existe este tipo de contribución.</h4>";
  }

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Confirmar Cita Contribución</title>
	<meta charset="utf-8">
  <link rel="shortcut icon" href="../images/logoRecyclus.png">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.css">
  <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="../css/aprobarStyles.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.3.2/sweetalert2.js" charset="utf-8"></script>
  <script type="text/javascript" src="../js/materialize.min.js"></script>
  <script type="text/javascript" src="../js/adminScript.js"></script>
</head>
<body>
<main>
	<nav class="blue darken-3 ">
		<div class="nav-wrapper">
			<a class="brand-logo flow-text center">Recyclus</a>
			<img src="../images/logoRecyclus.png" class="brand-logo right" height="50px" id="logoNav">
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
    <div class="row">
      <br>
      <div class="card-panel hoverable">
        <?php echo $datosContribucion; ?>
        <br>
      </div>
    </div>
    <center>
      <button class="btn waves-effect waves-light orange" style="margin: 10px" onclick="window.location.href='index.php'">Regresar al menu principal
        <i class="material-icons right">arrow_back</i>
      </button>
    </center>
  </div>
</main>
</body>
</html>
