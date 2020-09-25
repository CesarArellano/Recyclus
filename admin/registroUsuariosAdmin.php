<?php
  require '../config.php'; /* Si no tiene este archivo, no ejecuta nada*/
  header('Content-type: application/json; charset=utf-8'); // Se especifica el tipo de contenido a regresar al archivo JS, codificado en utf-8

  $nombreUsuario = $_POST['nombreUsuario'];
  $nombreUsuario = $conexionMySQL->real_escape_string($nombreUsuario); // Añade el caracter de escape \ si encuentra una cadena que inteta hacer inyección SQL, si no la deja tal cual
  $apPaternoUsuario = $_POST['apPaternoUsuario'];
  $apPaternoUsuario = $conexionMySQL->real_escape_string($apPaternoUsuario);
  $apMaternoUsuario = $_POST['apMaternoUsuario'];
  $apMaternoUsuario = $conexionMySQL->real_escape_string($apMaternoUsuario);
  $telefono = $_POST['telefono'];
  $telefono = $conexionMySQL->real_escape_string($telefono);
  $email = $_POST['email'];
  $email = $conexionMySQL->real_escape_string($email);
  $password = $_POST['password'];
  $password = $conexionMySQL->real_escape_string($password);
  $enc_password = password_hash($password,PASSWORD_DEFAULT); //Encriptar la contraseña (ocupa sha512 y lo ocupa 10 veces)

  $sentencia = $conexionMySQL->stmt_init();
  $sentencia->prepare("SELECT * FROM usuarios WHERE email = ?");
  $sentencia->bind_param('s',$email);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  $sentencia->close();
  if($resultado->num_rows == 1) //Si un correo ya está registrado
    {
      echo json_encode(array('mensaje' => "Error, ya se encuentra registrado este usuario", 'apartado' => "registro",'alerta' => "error"));
    }
  else
  {
    $sentencia = $conexionMySQL->stmt_init(); // Este método indica que la variable podra ocupar las siguientes consultas preparadas, retorna un objeto
    if(!$sentencia->prepare("INSERT INTO usuarios(nombreUsuario, apPaternoUsuario, apMaternoUsuario, email, password, telefonoUsuario,puntos, activo, idRol) VALUES(?,?,?,?,?,?,0,1,1)"))
    {
      echo json_encode(array('mensaje' => "Error, al procesar la información al preparar", 'apartado' => "registro",'alerta' => "error"));
    }
    $sentencia->bind_param('ssssss',$nombreUsuario,$apPaternoUsuario,$apMaternoUsuario,$email,$enc_password,$telefono); //Función que rellena los variables con la información del usuario. la password ya se pasa encriptada
    if(!$sentencia->execute()) //Función que ejecuta los comandos anteriores en la base de datos
    {
      echo json_encode(array('mensaje' => "Error, al procesar la información al ejecutar", 'apartado' => "registro",'alerta' => "error"));
    }
    else
    {
      echo json_encode(array('mensaje' => "Se registró con éxito", 'apartado' => "index",'alerta' => "success"));
    }
    $sentencia->close();
  }
  $conexionMySQL->close(); //Se cierra la conexión con la BD
?>
