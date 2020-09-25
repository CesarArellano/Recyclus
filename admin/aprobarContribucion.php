<?php
  require "../config.php";
  header('Content-type: application/json; charset=utf-8'); // Se especifica el tipo de contenido a regresar al archivo JS, codificado en utf-8

  $tipoContribucion = intval($_POST['tipoContribucion']);
  $idContribucion = intval($_POST['idContribucion']);

  $sentencia = $conexionMySQL->stmt_init();
  if($tipoContribucion == 1){
    $sentencia->prepare("UPDATE contribucionesTecnologicas SET estadoContribucion = 1 WHERE idContribucionT = ?");
  }
  else{
    $sentencia->prepare("UPDATE contribucionesDesechos SET estadoContribucion = 1 WHERE idContribucionD = ?");
  }
  $sentencia->bind_param('i',$idContribucion);
  if(!$sentencia->execute()){
    echo json_encode(array('mensaje' => "Error, no se pudo aprobar la solicitud.", 'apartado' => "sinAprobar", 'alerta' => "error"));
  }
  else{
    echo json_encode(array('mensaje' => "Se aprobó con solicitud de éxito", 'apartado' => "actualizar", 'alerta' => "success"));
  }
  $sentencia->close();
  $conexionMySQL->close(); //Se cierra la conexión con la BD
?>
