<?php
  require "../config.php";
  header('Content-type: application/json; charset=utf-8');
  $existe = 0;
  $latitud = 0;
  $longitud = 0;
  $idUsuario = $_SESSION['idUsuario'];

  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("SELECT latitud,longitud FROM direccionesUsuarios WHERE idUsuario = ?");
  $sentencia->bind_param('s',$idUsuario);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  $sentencia->close();
  $campos = $resultado->fetch_assoc();
  if($resultado > 0){
    $existe = 1;
    $latitud = doubleval($campos['latitud']);
    $longitud = doubleval($campos['longitud']);
  }
  echo json_encode(array('existe' => $existe,'latitud' => $latitud, 'longitud' => $longitud));
  $conexionMySQL->close();
?>
