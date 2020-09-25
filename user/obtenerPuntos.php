<?php
  require '../config.php';
  header('Content-type: application/json; charset=utf-8');

  $idUsuario = $_SESSION['idUsuario'];
  $resultadoContenidoPuntos = "";
  $resultadoContenidoRecompensas = "";

  //Obtener datos del cliente
  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("SELECT puntos FROM usuarios WHERE idUsuario = ?");
  $sentencia->bind_param('s',$idUsuario);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  $sentencia->close();
  $campos = $resultado->fetch_assoc();
  $resultadoPuntos = intval($campos['puntos']);

  if($resultadoPuntos > 0){
    $resultadoContenidoPuntos .= "<h5>Puntos obtenidos: ".$campos['puntos']."</h5>";
    $resultadoContenidoRecompensas .= "<div class='row'><div class='col l6 m6 s12'>
      <div class='card hoverable'>
        <div class='card-image waves-effect waves-block waves-light'>
          <img class='activator' src='https://www.bbva.com/wp-content/uploads/2018/10/BBVA-efectivo-tarjeta-1920x1180.jpg' style='width: 100%; height: 250px; object-fit: cover;'>
        </div>
        <div class='card-content'>
          <span class='card-title activator grey-text text-darken-4'>Dinero<i class='material-icons right'>more_vert</i></span>
          <center><button class='waves-effect waves-light btn blue darken-1' onclick='formDO()'>Reclamar recompensa<i class='material-icons right'>arrow_forward</i></button></center>
        </div>
        <div class='card-reveal'>
          <span class='card-title grey-text text-darken-4'><i class='material-icons right'>close</i>Información</span>
          <p>En esta opción usted podrá retirar dinero a través de una tarjeta de crédito o débito, entre más puntos más dinero obtendrá.</p>
          <p>Sigue aportando al ambiente.</p>
        </div>
      </div>
    </div>
    <div class='col l6 m6 s12'>
      <div class='card hoverable'>
        <div class='card-image waves-effect waves-block waves-light'>
          <img class='activator' src='https://marketing4ecommerce.net/wp-content/uploads/2018/02/cupones-descuento.jpg' style='width: 100%; height: 250px; object-fit: cover;'>
        </div>
        <div class='card-content' disabled>
          <span class='card-title activator grey-text text-darken-4'>Descuentos<i class='material-icons right'>more_vert</i></span>
          <center><button class='waves-effect waves-light btn orange darken-3' onclick='formDO()'>Reclamar recompensa<i class='material-icons right'>arrow_forward</i></button></center>
        </div>
        <div class='card-reveal'>
          <span class='card-title grey-text text-darken-4'><i class='material-icons right'>close</i>Información</span>
          <p>En esta opción obtedrá descuentos en.</p>
        </div>
      </div>
    </div>
    </div>";
  }
  else{
    $resultadoContenidoPuntos .= "<center>
    <h5 class='grey-text'>No hay puntos disponibles, realice alguna contribución y regrese más tarde</h5>
    <br>
      <a class='btn waves-effect waves-light cyan' href='index.php'>Regresar<i class='material-icons left'>arrow_back</i></a>
    </center>";
  }
  echo json_encode(array('contenidoPuntos' => $resultadoContenidoPuntos,'contenidoRecompensas' => $resultadoContenidoRecompensas));
  $conexionMySQL->close();
?>
