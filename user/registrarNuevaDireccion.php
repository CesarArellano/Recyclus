<?php
  require '../config.php';
  if(!isset($_SESSION['idUsuario']) || $_SESSION['tipoUsuario'] == 1) //isset comprueba si la variable no existe
  {
    header('location: ../index.php'); //header redirecciona a una página (no deja entrar a la página)
  }
  $inputPais = $_POST['inputPais'];
  $inputPais = $conexionMySQL->real_escape_string($inputPais);
  $inputEstado = $_POST['inputEstado'];
  $inputEstado = $conexionMySQL->real_escape_string($inputEstado);
  $inputDelegacionMunicipio = $_POST['inputDelegacionMunicipio'];
  $inputDelegacionMunicipio = $conexionMySQL->real_escape_string($inputDelegacionMunicipio);
  $inputColonia = $_POST['inputColonia'];
  $inputColonia = $conexionMySQL->real_escape_string($inputColonia);
  $inputCalle = $_POST['inputCalle'];
  $inputCodigoPostal = $_POST['inputCodigoPostal'];
  $latitud = doubleval($_POST['latitud']);
  $longitud = doubleval($_POST['longitud']);

  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("INSERT INTO direccionesUsuarios(pais,provincia,municipio,colonia,calle,codigoPostal,latitud,longitud,idUsuario) VALUES(?,?,?,?,?,?,?,?,?)");
  $sentencia->bind_param('ssssssddi',$inputPais,$inputEstado,$inputDelegacionMunicipio,$inputColonia,$inputCalle,$inputCodigoPostal,$latitud,$longitud,$_SESSION['idUsuario']);
  if(!$sentencia->execute())
  {
    echo json_encode(array('mensaje' => "Error, no se pudo agregar la dirección",'apartado'=> "registro", 'alerta' => "error"));
  }
  else
  {
    echo json_encode(array('mensaje' => "Se agregó con éxito la dirección",'apartado'=> "cuenta", 'alerta' => "success"));
  }
  $sentencia->close();
  $conexionMySQL->close();
?>
