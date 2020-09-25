<?php
  require '../config.php'; /*Si no tiene este archivo, no ejecuta nada*/
  header('Content-type: application/json; charset=utf-8'); // Se especifica el tipo de contenido a regresar al archivo JS, codificado en utf-8

  $contenidoNotificacion = $_POST['contenidoNotificacion'];
  $contenidoNotificacion = $conexionMySQL->real_escape_string($contenidoNotificacion);
  $idContribucion = intval($_POST['idContribucion']);
  $tipoContribucion = intval($_POST['tipoContribucion']);
  $idUsuario = intval($_POST['idUsuario']);

  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("INSERT INTO notificaciones(contenido,tipoContribucion,idContribucion,idUsuario) VALUES(?,?,?,?)");
  $sentencia->bind_param('siii',$contenidoNotificacion,$tipoContribucion,$idContribucion,$idUsuario);
  if(!$sentencia->execute()){
    echo json_encode(array('mensaje' => "Error, no se pudo confirmar la cita.", 'apartado' => "formCita", 'alerta' => "error"));
  }
  else{
    echo json_encode(array('mensaje' => "Confirmación de cita éxitosa", 'apartado' => "index", 'alerta' => "success"));
  }
  $sentencia->close();
  $conexionMySQL->close(); //Se cierra la conexión con la BD
?>
