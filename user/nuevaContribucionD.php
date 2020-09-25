<?php
  require '../config.php';
  if(!isset($_SESSION['idUsuario']) || $_SESSION['tipoUsuario'] == 1) //isset comprueba si la variable no existe
  {
    header('location: ../index.php'); //header redirecciona a una página (no deja entrar a la página)
  }
  $puntoReciclaje = $_POST['puntoReciclaje'];
  $tipoProducto = $_POST['tipoProducto'];
  $pesoProducto = doubleval($_POST['pesoProducto']);
  $tipoDesecho = $_POST['tipoDesecho'];

  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("INSERT INTO contribucionesDesechos(puntoReciclaje,tipoDesecho,tipoProducto,peso,estadoContribucion,idUsuario) VALUES(?,?,?,?,0,?)");
  $sentencia->bind_param('sssdi',$puntoReciclaje,$tipoDesecho,$tipoProducto,$pesoProducto,$_SESSION['idUsuario']);
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
