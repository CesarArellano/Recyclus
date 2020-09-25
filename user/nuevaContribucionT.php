<?php
  require '../config.php';
  if(!isset($_SESSION['idUsuario']) || $_SESSION['tipoUsuario'] == 1) //isset comprueba si la variable no existe
  {
    header('location: ../index.php'); //header redirecciona a una página (no deja entrar a la página)
  }
  $puntoReciclaje = $_POST['puntoReciclaje'];
  $tipoDispositivo = $_POST['tipoDispositivo'];
  $tipoDispositivo = $conexionMySQL->real_escape_string($tipoDispositivo);
  $nombreDispositivo = $_POST['nombreDispositivo'];
  $nombreDispositivo = $conexionMySQL->real_escape_string($nombreDispositivo);
  $marcaDispositivo = $_POST['marcaDispositivo'];
  $marcaDispositivo = $conexionMySQL->real_escape_string($marcaDispositivo);
  $gamaDispositivo = $_POST['gamaDispositivo'];
  $gamaDispositivo = $conexionMySQL->real_escape_string($gamaDispositivo);
  $tiempoUso = intval($_POST['tiempoUso']);
  $descripcionDispositivo = $_POST['descripcionDispositivo'];
  $descripcionDispositivo = $conexionMySQL->real_escape_string($descripcionDispositivo);

  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("INSERT INTO contribucionesTecnologicas(puntoReciclaje,tipoProducto,nombreProducto,marcaProducto,descripcionProducto,gamaProducto,tiempoUsoProducto,estadoContribucion,idUsuario) VALUES(?,?,?,?,?,?,?,0,?)");
  $sentencia->bind_param('ssssssii',$puntoReciclaje,$tipoDispositivo,$nombreDispositivo,$marcaDispositivo,$descripcionDispositivo,$gamaDispositivo,$tiempoUso,$_SESSION['idUsuario']);
  if(!$sentencia->execute())
  {
    echo json_encode(array('mensaje' => "Error, no se pudo agregar la contribución",'apartado'=> "registro", 'alerta' => "error"));
  }
  else
  {
    echo json_encode(array('mensaje' => "Has ayudado a cuidar el ambiente y has aportado a la economía circular. Te llegará un correo confirmando tu cita y luego de entregrarlo y de ser verificado recibirás tus Recypuntos.
Sigue aportando al ambiente, vas por el buen camino.",'apartado'=> "cuenta", 'alerta' => "success"));
  }
  $sentencia->close();
  $conexionMySQL->close();
?>
