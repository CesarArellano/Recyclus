<?php
  require '../config.php';
  header('Content-type: application/json; charset=utf-8');
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  $idUsuario = $_SESSION['idUsuario'];
  $resultadoDatosPersonales = "";
  $resultadoContribucionesT = "";
  $resultadoContribucionesD = "";
  $resultadoNotificaciones = "";
  $resultadoDireccion = 0;

  //Obtener datos del cliente
  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("SELECT nombreUsuario,apPaternoUsuario,apMaternoUsuario,telefonoUsuario, email,puntos FROM usuarios WHERE idUsuario = ?");
  $sentencia->bind_param('s',$idUsuario);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  $sentencia->close();
  $campos = $resultado->fetch_assoc();
  $resultadoPuntos = intval($campos['puntos']);

  //Obtener dirección cliente
  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("SELECT pais,provincia,municipio,colonia,calle,codigoPostal FROM direccionesUsuarios WHERE idUsuario = ?");
  $sentencia->bind_param('s',$idUsuario);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  $resultadoDatosPersonales.= "<h4>Datos personales</h4>
  <p>Nombre completo: <span class='grey-text'>".$campos['nombreUsuario']." ".$campos['apPaternoUsuario']." ".$campos['apMaternoUsuario']."</span></p>
  <p>Teléfono: <span class='grey-text'>".$campos['telefonoUsuario']."</span></p>
  <p>Correo Electrónico: <span class='grey-text'>".$campos['email']."</span></p>";
  if($resultado->num_rows == 1)
  {
    $sentencia->close();
    $resultadoDireccion = 1;
    $camposDireccion = $resultado->fetch_assoc();
    $resultadoDatosPersonales.= "<p>Dirección: <span class='grey-text'>".$camposDireccion['pais'].", ".$camposDireccion['provincia'].", ".$camposDireccion['municipio'].", ".$camposDireccion['colonia'].", ".$camposDireccion['calle'].", ".$camposDireccion['codigoPostal']."</span></p>";
  }
  else
  {
    $resultadoDatosPersonales.= "<p>Dirección: <span class='grey-text'>No hay dirección registrada</span></p>
    <center>
      <a class='waves-effect waves-light btn green' href='nuevaDireccion.php'><i class='material-icons left'>add_location</i>Agregar nueva dirección</a>
    </center>";
  }
  $resultadoNombre = "<h4>".$campos['nombreUsuario']."</h4>";
  //Obtener contribuciones tecnológicas del cliente
  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("SELECT tipoProducto,nombreProducto,marcaProducto,gamaProducto,estadoContribucion FROM contribucionesTecnologicas WHERE idUsuario = ?");
  $sentencia->bind_param('i',$idUsuario);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  $sentencia->close();
  if($resultado->num_rows > 0)
  {
    while($campos = $resultado->fetch_assoc()){
      if($campos['estadoContribucion'] == 0)
        $estado = "No aprobada";
      else
        $estado = "Aprobada";
      $resultadoContribucionesT.= "<div class='card-panel white-text blue lighten-1 hoverable'>
      <h4>Contribución</h4>
      <p><b>Tipo de producto:</b> ".$campos['tipoProducto']."</p>
      <p><b>Nombre producto:</b> ".$campos['nombreProducto']."</p>
      <p><b>Marca producto:</b> ".$campos['marcaProducto']."</p>
      <p><b>Estado de Contribucion:</b> ".$estado."</p>
      </div>";
    }
  }
  else
  {
    $resultadoContribucionesT.= "<h5 class='center-align'>No hay contribuciones</h5>";
  }
  //Obtener contribuciones desechos del cliente
  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("SELECT tipoDesecho,tipoProducto,peso,estadoContribucion FROM contribucionesDesechos WHERE idUsuario = ?");
  $sentencia->bind_param('i',$idUsuario);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  $sentencia->close();
  if($resultado->num_rows > 0)
  {
    while($campos = $resultado->fetch_assoc()){
      if($campos['estadoContribucion'] == 0)
        $estado = "No aprobada";
      else
        $estado = "Aprobada";
      $resultadoContribucionesD.= "<div class='card-panel white-text green lighten-1 hoverable'>
      <h4>Contribución</h4>
      <p><b>Tipo de desecho:</b> ".$campos['tipoDesecho']."</p>
      <p><b>Tipo producto:</b> ".$campos['tipoProducto']."</p>
      <p><b>Peso producto:</b> ".$campos['peso']."</p>
      <p><b>Estado de Contribucion:</b> ".$estado."</p>
      </div>";
    }
  }
  else
  {
    $resultadoContribucionesD.= "<h5 class='center-align'>No hay contribuciones</h5>";
  }

  //Obtener notificaciones cliente
  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("SELECT contenido,tipoContribucion,idContribucion FROM notificaciones WHERE idUsuario = ?");
  $sentencia->bind_param('s',$idUsuario);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  if($resultado->num_rows == 1)
  {
    $sentencia->close();
    while($campos = $resultado->fetch_assoc()){
      $resultadoNotificaciones.= "<h5 class='center-align'>Hay una notificacion: ".$campos['contenido']."</h5>";
    }
  }
  else
  {
    $resultadoNotificaciones.= "<h4 class='center-align grey-text'>No hay notificaciones</h4>";
  }

  $datosCliente = json_encode(array('datosPersonales' => $resultadoDatosPersonales,'nombre'=> $resultadoNombre,'puntos' => $resultadoPuntos,'contribucionesT' => $resultadoContribucionesT, 'contribucionesD' => $resultadoContribucionesD,'notificaciones' => $resultadoNotificaciones,'direccion' => $resultadoDireccion));
  echo $datosCliente;
  $conexionMySQL->close();
?>
